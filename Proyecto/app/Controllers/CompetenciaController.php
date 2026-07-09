<?php
/**
 * Controlador CompetenciaController
 * Gestiona las competencias y sus resultados de aprendizaje.
 */
class CompetenciaController extends BaseController {
    private $programaModel;
    private $competenciaModel;
    private $resultadoModel;

    public function __construct() {
        $this->programaModel = $this->model('Programa');
        $this->competenciaModel = $this->model('Competencia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
    }

    /**
     * Muestra el listado de competencias y resultados
     */
    public function index() {
        $this->requireLogin();
        $this->requireRol('Coordinador');
        
        $programas = $this->programaModel->all();
        $competencias = $this->competenciaModel->all();
        $resultados = $this->resultadoModel->all();

        $this->render('competencias/index', [
            'titulo' => 'Administración de Competencias y Resultados',
            'programas' => $programas,
            'competencias' => $competencias,
            'resultados' => $resultados,
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz'
        ]);
    }

    /**
     * Crear una competencia junto con sus resultados de aprendizaje (Modal Completo)
     */
    public function createCompetenciaCompleta() {
        $this->requireRol('Coordinador');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getInstance();
            
            $compData = $_POST['competencia'] ?? [];
            $rapsData = $_POST['raps'] ?? [];

            try {
                $db->beginTransaction();

                // 1. Crear Competencia
                $competenciaInput = [
                    'nombre' => $compData['nombre'] ?? '',
                    'codigo' => $compData['codigo'] ?? '',
                    'horas_totales' => $compData['horas_totales'] ?? 0,
                    'resultados_totales' => $compData['resultados_totales'] ?? 0,
                    'porcentaje' => $compData['porcentaje'] ?? 100
                ];

                if (!$this->competenciaModel->create($competenciaInput)) {
                    throw new Exception("Error al guardar la competencia.");
                }

                $id_competencia = $this->competenciaModel->getLastInsertId();
                if (!$id_competencia) {
                    throw new Exception("No se pudo obtener el ID de la competencia creada.");
                }

                // 2. Crear los Resultados de Aprendizaje (RAP)
                foreach ($rapsData as $rap) {
                    if (empty($rap['codigo'])) continue;

                    $rapInput = [
                        'id_competencia' => $id_competencia,
                        'codigo' => $rap['codigo'],
                        'descripcion' => $rap['descripcion'] ?? '',
                        'sesiones_asignadas' => (isset($rap['sesiones_asignadas']) && $rap['sesiones_asignadas'] !== '') ? $rap['sesiones_asignadas'] : null
                    ];

                    if (!$this->resultadoModel->create($rapInput)) {
                        throw new Exception("Error al guardar el resultado de aprendizaje: " . $rap['codigo']);
                    }
                }

                $db->commit();
                $_SESSION['flash_success'] = 'Competencia y sus Resultados de Aprendizaje registrados exitosamente.';
                AuditLogger::log('Creación Competencia Completa', 'competencias', $id_competencia, 'RAPs creados: ' . count($rapsData));

            } catch (Exception $e) {
                $db->rollBack();
                $_SESSION['flash_error'] = 'Error al registrar la competencia y resultados: ' . $e->getMessage();
            }
        }
        
        $this->redirect('competencias/index');
    }

    /**
     * Crear un resultado de aprendizaje (Coordinador)
     */
    public function createResultado() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_competencia' => $_POST['id_competencia'] ?? 0,
                'codigo' => $_POST['codigo'] ?? '',
                'descripcion' => $_POST['descripcion'] ?? '',
                'sesiones_asignadas' => $_POST['sesiones_asignadas'] !== '' ? $_POST['sesiones_asignadas'] : null
            ];

            try {
                if ($this->resultadoModel->create($data)) {
                    $db_inst = Database::getInstance();
                    $new_res_id = $db_inst->lastInsertId();
                    $_SESSION['flash_success'] = 'Resultado de aprendizaje registrado exitosamente.';
                    AuditLogger::log('Creación de Resultado', 'resultado_aprendizaje', $new_res_id, 'Descripción: ' . $data['descripcion'] . ', Código: ' . $data['codigo'] . ', Competencia ID: ' . $data['id_competencia']);
                } else {
                    $_SESSION['flash_error'] = 'Error al registrar el resultado.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error en validación por Triggers: ' . $e->getMessage();
            }
        }
        $redirect = $_POST['redirect'] ?? 'competencias/index';
        $this->redirect($redirect);
    }

    /**
     * Valida las sesiones de una competencia mediante el procedimiento almacenado
     */
    public function validarSesiones() {
        $this->requireRol('Coordinador');
        $id_competencia = $_GET['id'] ?? 0;

        $resultado = $this->competenciaModel->validarSesiones($id_competencia);
        if ($resultado['success']) {
            $_SESSION['flash_success'] = $resultado['message'];
        } else {
            $_SESSION['flash_error'] = 'Error en validación (SP): ' . $resultado['message'];
        }
        $this->redirect('competencias/index');
    }

    /**
     * Vista para editar competencia y sus RAPs (vía AJAX)
     */
    public function editarCompleto() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        
        $competencia = $this->competenciaModel->find($id);
        if (!$competencia) {
            die('Competencia no encontrada.');
        }

        $resultados = $this->resultadoModel->getByCompetencia($id);

        $layout = 'layout';
        if (isset($_GET['modal']) || isset($_GET['ajax'])) {
            $layout = false;
        }

        $this->render('competencias/editar_completo', [
            'titulo' => 'Editar Competencia',
            'competencia' => $competencia,
            'resultados' => $resultados,
            'isModal' => isset($_GET['modal']) || isset($_GET['ajax'])
        ], $layout);
    }

    /**
     * Procesar actualización completa de competencia y RAPs
     */
    public function updateCompleto() {
        $this->requireRol('Coordinador');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getInstance();
            $id_competencia = $_POST['id_competencia'] ?? 0;
            
            $compData = $_POST['competencia'] ?? [];
            $rapsData = $_POST['raps'] ?? [];

            try {
                $db->beginTransaction();

                // 1. Actualizar Competencia
                $competenciaInput = [
                    'nombre' => $compData['nombre'] ?? '',
                    'codigo' => $compData['codigo'] ?? '',
                    'horas_totales' => $compData['horas_totales'] ?? 0,
                    'resultados_totales' => $compData['resultados_totales'] ?? 0,
                    'porcentaje' => $compData['porcentaje'] ?? 100
                ];
                if (!$this->competenciaModel->update($id_competencia, $competenciaInput)) {
                    throw new Exception("Error al actualizar la competencia.");
                }

                // 2. Gestionar RAPs (Eliminar antiguos y crear nuevos)
                // Primero obtenemos los RAPs actuales
                $rapsActuales = $this->resultadoModel->getByCompetencia($id_competencia);
                $idsA_Mantener = [];
                
                // Actualizar o Crear
                foreach ($rapsData as $rap) {
                    if (empty($rap['codigo'])) continue;

                    if (!empty($rap['id_resultado'])) {
                        // Actualizar existente
                        $rapInput = [
                            'id_competencia' => $id_competencia,
                            'codigo' => $rap['codigo'],
                            'descripcion' => $rap['descripcion'] ?? '',
                            'sesiones_asignadas' => (isset($rap['sesiones_asignadas']) && $rap['sesiones_asignadas'] !== '') ? $rap['sesiones_asignadas'] : null
                        ];
                        if (!$this->resultadoModel->update($rap['id_resultado'], $rapInput)) {
                            throw new Exception("Error al actualizar RAP: " . $rap['codigo']);
                        }
                        $idsA_Mantener[] = $rap['id_resultado'];
                    } else {
                        // Crear nuevo
                        $rapInput = [
                            'id_competencia' => $id_competencia,
                            'codigo' => $rap['codigo'],
                            'descripcion' => $rap['descripcion'] ?? '',
                            'sesiones_asignadas' => (isset($rap['sesiones_asignadas']) && $rap['sesiones_asignadas'] !== '') ? $rap['sesiones_asignadas'] : null
                        ];
                        if (!$this->resultadoModel->create($rapInput)) {
                            throw new Exception("Error al crear RAP: " . $rap['codigo']);
                        }
                        $idsA_Mantener[] = $this->resultadoModel->getLastInsertId();
                    }
                }

                // Eliminar RAPs que fueron borrados en el form
                foreach ($rapsActuales as $ra) {
                    if (!in_array($ra->id_resultado, $idsA_Mantener)) {
                        $this->resultadoModel->delete($ra->id_resultado);
                    }
                }

                $db->commit();
                $_SESSION['flash_success'] = 'Competencia y resultados actualizados correctamente.';
                AuditLogger::log('Actualización', 'competencias', $id_competencia, 'Competencia actualizada completamente');
                
            } catch (Exception $e) {
                $db->rollBack();
                $_SESSION['flash_error'] = 'Error al actualizar: ' . $e->getMessage();
            }
        }

        $this->redirect('competencias/index');
    }

    /**
     * Eliminar una competencia
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;

        try {
            if ($this->competenciaModel->delete($id)) {
                $_SESSION['flash_success'] = 'Competencia eliminada exitosamente.';
                AuditLogger::log('Eliminación de Competencia', 'competencias', $id, 'ID Competencia: ' . $id);
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar la competencia.';
            }
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'No se puede eliminar porque existen registros dependientes.';
        }
        $this->redirect('competencias/index');
    }
}
