<?php
/**
 * Controlador ProgramaController
 * Gestiona los programas de formación, competencias y resultados de aprendizaje.
 */
class ProgramaController extends BaseController {
    private $programaModel;
    private $tipoProgramaModel;
    private $competenciaModel;
    private $resultadoModel;

    public function __construct() {
        $this->programaModel = $this->model('Programa');
        $this->tipoProgramaModel = $this->model('TipoPrograma');
        $this->competenciaModel = $this->model('Competencia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
    }

    /**
     * Muestra el listado de programas, competencias y resultados
     */
    public function index() {
        $this->requireLogin();
        $programas = $this->programaModel->all();
        $tipos = $this->tipoProgramaModel->all();
        $competencias = $this->competenciaModel->all();
        $resultados = $this->resultadoModel->all();

        $this->render('programas/index', [
            'titulo' => 'Administración de Programas y Competencias',
            'programas' => $programas,
            'tipos' => $tipos,
            'competencias' => $competencias,
            'resultados' => $resultados,
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz'
        ]);
    }

    /**
     * Crear un nuevo programa de formación (Coordinador)
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'version' => $_POST['version'] ?? '',
                'vigencia' => $_POST['vigencia'] ?? '',
                'duracion_lectiva' => $_POST['duracion_lectiva'] ?? 0,
                'duracion_practica' => $_POST['duracion_practica'] ?? 0,
                'id_tipo_programa' => $_POST['id_tipo_programa'] ?? 0
            ];

            if ($this->programaModel->create($data)) {
                $new_id_programa = $this->programaModel->getLastInsertId();
                $_SESSION['flash_success'] = 'Programa de formación creado exitosamente.';
                
                // Auditoría de Creación de Programa
                AuditLogger::log('Creación de Programa', 'programa', $new_id_programa, 'Nombre: ' . $data['nombre'] . ', Código: ' . $data['codigo']);

                // Registrar competencia inicial si se rellenaron los campos
                $comp_nombre = $_POST['comp_nombre'] ?? '';
                $comp_codigo = $_POST['comp_codigo'] ?? '';
                if (!empty($comp_nombre) && !empty($comp_codigo)) {
                    $compData = [
                        'id_programa' => $new_id_programa,
                        'nombre' => $comp_nombre,
                        'codigo' => $comp_codigo,
                        'horas_totales' => $_POST['comp_horas_totales'] ?? 0,
                        'resultados_totales' => $_POST['comp_resultados_totales'] ?? 0,
                        'porcentaje' => $_POST['comp_porcentaje'] ?? 100
                    ];

                    try {
                        if ($this->competenciaModel->create($compData)) {
                            $_SESSION['flash_success'] = 'Programa de formación y su competencia inicial creados exitosamente.';
                        } else {
                            $_SESSION['flash_error'] = 'Programa de formación creado, pero no se pudo registrar la competencia inicial.';
                        }
                    } catch (Exception $e) {
                        $_SESSION['flash_error'] = 'Programa de formación creado, pero la competencia inicial no superó las validaciones del Trigger: ' . $e->getMessage();
                    }
                }
            } else {
                $_SESSION['flash_error'] = 'Error al crear el programa.';
            }
        }
        $this->redirect('dashboard/index#pills-programas');
    }

    /**
     * Actualizar un programa de formación (Coordinador)
     */
    public function update() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_programa'] ?? 0;
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'version' => $_POST['version'] ?? '',
                'vigencia' => $_POST['vigencia'] ?? '',
                'duracion_lectiva' => $_POST['duracion_lectiva'] ?? 0,
                'duracion_practica' => $_POST['duracion_practica'] ?? 0,
                'id_tipo_programa' => $_POST['id_tipo_programa'] ?? 0
            ];

            if ($this->programaModel->update($id, $data)) {
                $_SESSION['flash_success'] = 'Programa actualizado exitosamente.';
                
                // Auditoría de Actualización de Programa
                AuditLogger::log('Actualización de Programa', 'programa', $id, 'Nombre: ' . $data['nombre'] . ', Código: ' . $data['codigo']);
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar el programa.';
            }
        }
        $this->redirect('dashboard/index#pills-programas');
    }

    /**
     * Eliminar un programa de formación (Coordinador)
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $db = Database::getInstance();
            try {
                $db->beginTransaction();
                
                // 1. Obtener todas las competencias del programa
                $competencias = $this->competenciaModel->getByPrograma($id);
                
                // 2. Para cada competencia, eliminar sus resultados de aprendizaje
                foreach ($competencias as $comp) {
                    $db->query("DELETE FROM resultado_aprendizaje WHERE id_competencia = :id_comp");
                    $db->bind(':id_comp', $comp->id_competencia);
                    $db->execute();
                }
                
                // 3. Eliminar todas las competencias del programa
                $db->query("DELETE FROM competencias WHERE id_programa = :id_prog");
                $db->bind(':id_prog', $id);
                $db->execute();
                
                // 4. Eliminar el programa
                if ($this->programaModel->delete($id)) {
                    $db->commit();
                    $_SESSION['flash_success'] = 'Programa eliminado correctamente junto con sus competencias y resultados.';
                    
                    // Auditoría de Eliminación de Programa
                    AuditLogger::log('Eliminación de Programa', 'programa', $id, 'Eliminó programa ID: ' . $id);
                } else {
                    $db->rollBack();
                    $_SESSION['flash_error'] = 'Error al eliminar el programa.';
                }
            } catch (PDOException $e) {
                if ($db->getConnection()->inTransaction()) {
                    $db->rollBack();
                }
                $_SESSION['flash_error'] = 'No se puede eliminar el programa porque tiene fichas asignadas o clases programadas asociadas.';
            }
        }
        $this->redirect('dashboard/index#pills-programas');
    }

    /**
     * Crear una competencia (Coordinador)
     */
    public function createCompetencia() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_programa' => $_POST['id_programa'] ?? 0,
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'horas_totales' => $_POST['horas_totales'] ?? 0,
                'resultados_totales' => $_POST['resultados_totales'] ?? 0,
                'porcentaje' => $_POST['porcentaje'] ?? 100
            ];

            try {
                if ($this->competenciaModel->create($data)) {
                    $db_inst = Database::getInstance();
                    $new_comp_id = $db_inst->lastInsertId();
                    
                    $_SESSION['flash_success'] = 'Competencia registrada exitosamente.';
                    
                    // Auditoría de Competencia
                    AuditLogger::log('Creación de Competencia', 'competencias', $new_comp_id, 'Nombre: ' . $data['nombre'] . ', Código: ' . $data['codigo'] . ', Programa ID: ' . $data['id_programa']);
                } else {
                    $_SESSION['flash_error'] = 'Error al registrar la competencia.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error en validación por Triggers: ' . $e->getMessage();
            }
        }
        $redirect = $_POST['redirect'] ?? 'programas/index';
        $this->redirect($redirect);
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
                    
                    // Auditoría de Resultado
                    AuditLogger::log('Creación de Resultado', 'resultado_aprendizaje', $new_res_id, 'Descripción: ' . $data['descripcion'] . ', Código: ' . $data['codigo'] . ', Competencia ID: ' . $data['id_competencia']);
                } else {
                    $_SESSION['flash_error'] = 'Error al registrar el resultado.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error en validación por Triggers: ' . $e->getMessage();
            }
        }
        $redirect = $_POST['redirect'] ?? 'programas/index';
        $this->redirect($redirect);
    }

    /**
     * Valida las sesiones de una competencia mediante el procedimiento almacenado sp_validar_sesiones_competencia
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
        $this->redirect('programas/index');
    }

    /**
     * Formulario completo multinivel para registrar programa, competencias y resultados de aprendizaje (Coordinador)
     */
    public function crearCompleto() {
        $this->requireRol('Coordinador');
        $tipos = $this->tipoProgramaModel->all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getInstance();

            // Datos del programa
            $progData = [
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'version' => $_POST['version'] ?? '',
                'vigencia' => $_POST['vigencia'] ?? '',
                'duracion_lectiva' => $_POST['duracion_lectiva'] ?? 0,
                'duracion_practica' => $_POST['duracion_practica'] ?? 0,
                'id_tipo_programa' => $_POST['id_tipo_programa'] ?? 0
            ];

            $competencias = $_POST['competencias'] ?? [];

            try {
                // Iniciar Transacción
                $db->beginTransaction();

                // 1. Insertar el Programa
                if (!$this->programaModel->create($progData)) {
                    throw new Exception("Error al guardar los datos básicos del programa.");
                }
                
                $id_programa = $this->programaModel->getLastInsertId();
                if (!$id_programa) {
                    throw new Exception("No se pudo obtener el ID del programa creado.");
                }

                // 2. Insertar cada Competencia
                foreach ($competencias as $comp) {
                    $compData = [
                        'id_programa' => $id_programa,
                        'nombre' => $comp['nombre'] ?? '',
                        'codigo' => $comp['codigo'] ?? '',
                        'horas_totales' => $comp['horas_totales'] ?? 0,
                        'resultados_totales' => $comp['resultados_totales'] ?? 0,
                        'porcentaje' => $comp['porcentaje'] ?? 100
                    ];

                    if (!$this->competenciaModel->create($compData)) {
                        throw new Exception("Error al guardar la competencia: " . ($comp['nombre'] ?? ''));
                    }

                    $id_competencia = $this->competenciaModel->getLastInsertId();
                    if (!$id_competencia) {
                        throw new Exception("No se pudo obtener el ID de la competencia creada.");
                    }

                    // 3. Insertar los Resultados de Aprendizaje de esta Competencia
                    $resultados = $comp['resultados'] ?? [];
                    foreach ($resultados as $ra) {
                        $raData = [
                            'id_competencia' => $id_competencia,
                            'codigo' => $ra['codigo'] ?? '',
                            'descripcion' => $ra['descripcion'] ?? '',
                            'sesiones_asignadas' => ($ra['sesiones_asignadas'] !== '') ? $ra['sesiones_asignadas'] : null
                        ];

                        if (!$this->resultadoModel->create($raData)) {
                            throw new Exception("Error al guardar el resultado de aprendizaje: " . ($ra['codigo'] ?? ''));
                        }
                    }
                }

                // Confirmar transacción
                $db->commit();

                $_SESSION['flash_success'] = 'Programa de Formación, Competencias y Resultados registrados exitosamente en una sola transacción.';
                
                // Auditoría de Registro de Currículo Completo
                AuditLogger::log('Registro de Currículo Completo', 'programa', $id_programa, 'Nombre: ' . $progData['nombre'] . ', Código: ' . $progData['codigo']);
                
                $this->redirect('dashboard/index#pills-programas');

            } catch (Exception $e) {
                // Revertir todo en caso de error
                $db->rollBack();
                $_SESSION['flash_error'] = 'Error al registrar el currículo: ' . $e->getMessage();
                
                // Volver a mostrar la vista manteniendo los datos ingresados
                $this->render('programas/crear_completo', [
                    'titulo' => 'Registrar Programa Completo',
                    'tipos' => $tipos,
                    'oldData' => $_POST
                ]);
            }
        } else {
            $this->render('programas/crear_completo', [
                'titulo' => 'Registrar Programa Completo',
                'tipos' => $tipos,
                'oldData' => []
            ]);
        }
    }

    /**
     * Vista para editar programa completo (vía Modal Iframe)
     */
    public function editarCompleto() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        
        $programa = $this->programaModel->find($id);
        if (!$programa) {
            die('Programa no encontrado.');
        }

        $competencias = $this->competenciaModel->getByPrograma($id);
        $resultados = [];
        foreach ($competencias as $comp) {
            $resultados[$comp->id_competencia] = $this->resultadoModel->getByCompetencia($comp->id_competencia);
        }

        $tipos = $this->tipoProgramaModel->all();

        // Si viene con modal=1, usamos el layout_modal
        // Si viene con ajax=1, no usamos layout (para inyectar en el DOM)
        $layout = 'layout';
        if (isset($_GET['modal'])) {
            $layout = 'layout_modal';
        }
        if (isset($_GET['ajax'])) {
            $layout = false;
        }

        $this->render('programas/editar_completo', [
            'titulo' => 'Editar Programa',
            'programa' => $programa,
            'competencias' => $competencias,
            'resultados' => $resultados,
            'tipos' => $tipos,
            'isModal' => isset($_GET['modal']) || isset($_GET['ajax'])
        ], $layout);
    }

    /**
     * Procesar la actualización completa
     */
    public function updateCompleto() {
        $this->requireRol('Coordinador');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getInstance();
            $id_programa = $_POST['id_programa'] ?? 0;
            
            $progData = [
                'nombre' => $_POST['nombre'] ?? '',
                'codigo' => $_POST['codigo'] ?? '',
                'version' => $_POST['version'] ?? '',
                'vigencia' => $_POST['vigencia'] ?? '',
                'duracion_lectiva' => $_POST['duracion_lectiva'] ?? 0,
                'duracion_practica' => $_POST['duracion_practica'] ?? 0,
                'id_tipo_programa' => $_POST['id_tipo_programa'] ?? 0
            ];

            $competenciasData = $_POST['competencias'] ?? [];

            try {
                $db->beginTransaction();

                // 1. Actualizar Programa
                if (!$this->programaModel->update($id_programa, $progData)) {
                    throw new Exception("Error al actualizar el programa.");
                }

                // 2. Para simplificar la actualización compleja:
                // Eliminamos las competencias existentes (los RAPs se eliminan en cascada por BD o los eliminamos manual)
                // Wait! Si eliminamos competencias, se pueden romper llaves foráneas en programación.
                // En su lugar, vamos a actualizar las que tienen ID y crear las nuevas. Las que no vengan, se eliminan.
                
                $competenciasViejas = $this->competenciaModel->getByPrograma($id_programa);
                $idsViejosComp = array_column($competenciasViejas, 'id_competencia');
                $idsNuevosComp = [];

                foreach ($competenciasData as $comp) {
                    $id_comp = !empty($comp['id_competencia']) ? $comp['id_competencia'] : 0;
                    
                    $cData = [
                        'id_programa' => $id_programa,
                        'nombre' => $comp['nombre'] ?? '',
                        'codigo' => $comp['codigo'] ?? '',
                        'horas_totales' => $comp['horas_totales'] ?? 0,
                        'resultados_totales' => $comp['resultados_totales'] ?? 0,
                        'porcentaje' => $comp['porcentaje'] ?? 100
                    ];

                    if ($id_comp > 0) {
                        // Actualizar
                        $this->competenciaModel->update($id_comp, $cData);
                        $idsNuevosComp[] = $id_comp;
                    } else {
                        // Crear
                        $this->competenciaModel->create($cData);
                        $id_comp = $this->competenciaModel->getLastInsertId();
                    }

                    // Resultados de esta competencia
                    $resultadosData = $comp['resultados'] ?? [];
                    $resultadosViejos = $this->resultadoModel->getByCompetencia($id_comp);
                    $idsViejosRes = array_column($resultadosViejos, 'id_resultado');
                    $idsNuevosRes = [];

                    foreach ($resultadosData as $ra) {
                        $id_res = !empty($ra['id_resultado']) ? $ra['id_resultado'] : 0;
                        $rData = [
                            'id_competencia' => $id_comp,
                            'codigo' => $ra['codigo'] ?? '',
                            'descripcion' => $ra['descripcion'] ?? '',
                            'sesiones_asignadas' => ($ra['sesiones_asignadas'] !== '') ? $ra['sesiones_asignadas'] : null
                        ];

                        if ($id_res > 0) {
                            $this->resultadoModel->update($id_res, $rData);
                            $idsNuevosRes[] = $id_res;
                        } else {
                            $this->resultadoModel->create($rData);
                        }
                    }

                    // Eliminar RAPs huérfanos
                    $resABorrar = array_diff($idsViejosRes, $idsNuevosRes);
                    foreach ($resABorrar as $rDel) {
                        $this->resultadoModel->delete($rDel);
                    }
                }

                // Eliminar competencias huérfanas
                $compABorrar = array_diff($idsViejosComp, $idsNuevosComp);
                foreach ($compABorrar as $cDel) {
                    $this->competenciaModel->delete($cDel);
                }

                $db->commit();
                $_SESSION['flash_success'] = 'Programa formativo actualizado correctamente.';
                
                // Auditoría de Actualización de Currículo Completo
                AuditLogger::log('Actualización de Currículo Completo', 'programa', $id_programa, 'Nombre: ' . $progData['nombre'] . ', Código: ' . $progData['codigo']);
                
            } catch (Exception $e) {
                $db->rollBack();
                $_SESSION['flash_error'] = 'Error al actualizar el programa: ' . $e->getMessage();
            }
        }

        $this->redirect('dashboard/index#pills-programas');
    }
}
