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
     * Muestra el detalle de un programa de formación
     */
    public function show() {
        $this->requireLogin();
        $id = $_GET['id'] ?? 0;
        
        $programa = $this->programaModel->find($id);
        if (!$programa) {
            $_SESSION['flash_error'] = 'Programa no encontrado.';
            $this->redirect('dashboard/index#pills-programas');
            return;
        }

        $competencias = $this->competenciaModel->getByPrograma($id);
        $resultados = [];
        foreach ($competencias as $comp) {
            $resultados[$comp->id_competencia] = $this->resultadoModel->getByCompetencia($comp->id_competencia);
        }

        $tipos = $this->tipoProgramaModel->all();

        $todasLasCompetencias = $this->competenciaModel->all();
        $asociadasIds = array_map(function($c) { return $c->id_competencia; }, $competencias);
        $competenciasDisponibles = array_filter($todasLasCompetencias, function($c) use ($asociadasIds) {
            return !in_array($c->id_competencia, $asociadasIds);
        });

        $this->render('programas/show', [
            'titulo' => 'Detalle del Programa',
            'programa' => $programa,
            'competencias' => $competencias,
            'resultados' => $resultados,
            'tipos' => $tipos,
            'competenciasDisponibles' => $competenciasDisponibles,
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

            // Validar que el código no exista
            if ($this->programaModel->findByCodigo($data['codigo'])) {
                $_SESSION['flash_error'] = 'Ya existe un programa registrado con ese código.';
                $this->redirect('dashboard/index#pills-programas');
                return;
            }

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

            // Validar que el código no exista en OTRO programa
            $existente = $this->programaModel->findByCodigo($data['codigo']);
            if ($existente && $existente->id_programa != $id) {
                $_SESSION['flash_error'] = 'El código ingresado ya está siendo utilizado por otro programa.';
                $this->redirect('dashboard/index#pills-programas');
                return;
            }

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
            try {
                // El modelo ya maneja la transacción y la eliminación en cascada (competencias y resultados)
                if ($this->programaModel->delete($id)) {
                    $_SESSION['flash_success'] = 'Programa eliminado correctamente junto con sus competencias y resultados.';
                    
                    // Auditoría de Eliminación de Programa
                    AuditLogger::log('Eliminación de Programa', 'programa', $id, 'Eliminó programa ID: ' . $id);
                } else {
                    $_SESSION['flash_error'] = 'Error al eliminar el programa.';
                }
            } catch (PDOException $e) {
                // Si ocurre una excepción aquí, usualmente es por llaves foráneas (ej. fichas o clases activas)
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
     * Crear una competencia junto con sus resultados de aprendizaje (Modal Completo)
     */
    public function createCompetenciaCompleta() {
        $this->requireRol('Coordinador');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = Database::getInstance();
            
            $id_programa = $_POST['id_programa'] ?? 0;
            $compData = $_POST['competencia'] ?? [];
            $rapsData = $_POST['raps'] ?? [];

            try {
                $db->beginTransaction();

                // 1. Crear Competencia
                $competenciaInput = [
                    'id_programa' => $id_programa,
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
                    // Validar que al menos venga el código
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

                // Confirmar transacción
                $db->commit();
                $_SESSION['flash_success'] = 'Competencia y sus Resultados de Aprendizaje registrados exitosamente.';
                
                // Auditoría
                AuditLogger::log('Creación Competencia Completa', 'competencias', $id_competencia, 'Programa ID: ' . $id_programa . ', RAPs creados: ' . count($rapsData));

            } catch (Exception $e) {
                // Revertir todo en caso de error (ej: validaciones de Triggers en MariaDB)
                $db->rollBack();
                $_SESSION['flash_error'] = 'Error al registrar la competencia y resultados: ' . $e->getMessage();
            }
        }
        
        $this->redirect('dashboard/index#pills-programas');
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
            try {
                $db->beginTransaction();

                // 1. Actualizar Programa
                if (!$this->programaModel->update($id_programa, $progData)) {
                    throw new Exception("Error al actualizar el programa.");
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

        if (isset($_POST['from_show']) && $_POST['from_show'] == '1') {
            $this->redirect('programas/show&id=' . $id_programa);
        } else {
            $this->redirect('dashboard/index#pills-programas');
        }
    }

    /**
     * Asocia competencias a un programa (vía AJAX)
     */
    public function asociarCompetencias() {
        $this->requireRol('Coordinador');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_programa = $_POST['id_programa'] ?? 0;
            $competencias_ids = $_POST['competencias'] ?? [];

            if (empty($id_programa)) {
                echo json_encode(['success' => false, 'message' => 'ID de programa no válido.']);
                exit;
            }

            if (empty($competencias_ids)) {
                echo json_encode(['success' => false, 'message' => 'No se seleccionaron competencias.']);
                exit;
            }

            $db = Database::getInstance();
            try {
                $db->beginTransaction();

                foreach ($competencias_ids as $id_competencia) {
                    // Verificar que no esté asociada ya
                    $db->query("SELECT 1 FROM programa_competencia WHERE id_programa = :id_programa AND id_competencia = :id_competencia");
                    $db->bind(':id_programa', $id_programa);
                    $db->bind(':id_competencia', $id_competencia);
                    if (!$db->single()) {
                        $db->query("INSERT INTO programa_competencia (id_programa, id_competencia) VALUES (:id_programa, :id_competencia)");
                        $db->bind(':id_programa', $id_programa);
                        $db->bind(':id_competencia', $id_competencia);
                        $db->execute();
                    }
                }

                $db->commit();
                echo json_encode(['success' => true, 'message' => 'Competencias asociadas correctamente.']);
                // Opcional: AuditLogger
                // AuditLogger::log('Asociar Competencias', 'programa_competencia', $id_programa, 'Asociadas ' . count($competencias_ids) . ' competencias.');
            } catch (Exception $e) {
                $db->rollBack();
                echo json_encode(['success' => false, 'message' => 'Error en base de datos: ' . $e->getMessage()]);
            }
            exit;
        }
    }

    /**
     * Desvincula una competencia de un programa (vía AJAX)
     */
    public function desvincularCompetencia() {
        $this->requireRol('Coordinador');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_programa = $_POST['id_programa'] ?? 0;
            $id_competencia = $_POST['id_competencia'] ?? 0;

            if (empty($id_programa) || empty($id_competencia)) {
                echo json_encode(['success' => false, 'message' => 'Datos insuficientes para desvincular.']);
                exit;
            }

            $db = Database::getInstance();
            try {
                $db->query("DELETE FROM programa_competencia WHERE id_programa = :id_programa AND id_competencia = :id_competencia");
                $db->bind(':id_programa', $id_programa);
                $db->bind(':id_competencia', $id_competencia);
                if ($db->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Competencia desvinculada correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No se pudo desvincular la competencia.']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Error en base de datos: ' . $e->getMessage()]);
            }
            exit;
        }
    }
}
