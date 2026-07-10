<?php
/**
 * Controlador ProgramacionController
 * Gestiona el listado y programación de clases/sesiones académicas.
 */
class ProgramacionController extends BaseController {
    private $programacionModel;
    private $fichaModel;
    private $usuarioModel;
    private $ambienteModel;
    private $diaModel;
    private $resultadoModel;

    public function __construct() {
        $this->programacionModel = $this->model('ProgramacionAcademica');
        $this->fichaModel = $this->model('Ficha');
        $this->usuarioModel = $this->model('Usuario');
        $this->ambienteModel = $this->model('Ambiente');
        $this->diaModel = $this->model('Dia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
    }

    /**
     * Muestra el calendario / listado de la programación académica según el rol
     */
    public function index() {
        $this->requireRol('Coordinador');
        $current_role = $_SESSION['current_role'] ?? 'Aprendiz';
        $user_id = $_SESSION['user_id'];

        $programacion = $this->programacionModel->all();

        // Datos para el formulario de creación (Coordinador)
        $fichas = $this->fichaModel->all();
        $ambientes = $this->ambienteModel->disponibles();
        $dias = $this->diaModel->all();
        $resultados = $this->resultadoModel->all();

        // Filtrar instructores
        $todosUsuarios = $this->usuarioModel->all();
        $instructores = [];
        foreach ($todosUsuarios as $u) {
            $roles = $this->usuarioModel->getRoles($u->id_usuario);
            foreach ($roles as $r) {
                if ($r->nombre_rol === 'Instructor') {
                    $instructores[] = $u;
                    break;
                }
            }
        }

        $this->render('programacion/index', [
            'titulo' => 'Programar Nueva Sesión Académica',
            'programacion' => $programacion,
            'fichas' => $fichas,
            'ambientes' => $ambientes,
            'dias' => $dias,
            'resultados' => $resultados,
            'instructores' => $instructores,
            'current_role' => $current_role
        ]);
    }

    /**
     * Crear una nueva programación (Coordinador)
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'numero_ficha' => $_POST['numero_ficha'] ?? 0,
                'id_usuario' => $_POST['id_usuario'] ?? 0, // Instructor
                'id_numero_ambiente' => $_POST['id_numero_ambiente'] ?? 0,
                'id_dias' => $_POST['id_dias'] ?? 0,
                'hora_inicio' => $_POST['hora_inicio'] ?? '',
                'hora_fin' => $_POST['hora_fin'] ?? '',
                'id_resultado_aprendizaje' => $_POST['id_resultado_aprendizaje'] ?? 0,
                'fecha_inicio' => $_POST['fecha_inicio'] ?? date('Y-m-d')
            ];
            
            // Forzar el id_dias basado en la fecha_inicio para que sea atómico (1=Lunes..7=Domingo)
            $data['id_dias'] = date('N', strtotime($data['fecha_inicio']));

            // Validar conflictos
            $conflictMessage = $this->programacionModel->getConflictMessage($data);
            if ($conflictMessage) {
                $_SESSION['flash_error'] = $conflictMessage;
                $this->redirect('programacion/index');
                return;
            }

            try {
                if ($this->programacionModel->create($data)) {
                    $db_inst = Database::getInstance();
                    $new_prog_id = $db_inst->lastInsertId();
                    
                    $_SESSION['flash_success'] = 'Programación académica registrada exitosamente.';
                    
                    // Auditoría de Programación
                    AuditLogger::log('Asignación de Horario', 'programacion_academica', $new_prog_id, 'Ficha: ' . $data['numero_ficha'] . ', Instructor ID: ' . $data['id_usuario'] . ', Ambiente ID: ' . $data['id_numero_ambiente']);
                } else {
                    $_SESSION['flash_error'] = 'Error al registrar la programación.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error en validación de base de datos / triggers: ' . $e->getMessage();
            }
        }
        $this->redirect('programacion/index');
    }

    /**
     * Eliminar una programación (Coordinador)
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;

        try {
            if ($this->programacionModel->delete($id)) {
                $_SESSION['flash_success'] = 'Programación eliminada correctamente.';
                
                // Auditoría de Eliminación
                AuditLogger::log('Eliminación de Horario', 'programacion_academica', $id, 'ID: ' . $id);
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar la programación.';
            }
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'No se puede eliminar la programación porque tiene registros de asistencia asociados.';
        }
        $this->redirect('dashboard/index#pills-programacion');
    }

    /**
     * Eliminar programación vía AJAX
     */
    public function delete_ajax() {
        header('Content-Type: application/json');
        try {
            $this->requireRol('Coordinador');
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'No autorizado.']);
            exit;
        }

        $id = $_GET['id'] ?? 0;

        try {
            if ($this->programacionModel->delete($id)) {
                // Auditoría de Eliminación vía AJAX
                AuditLogger::log('Eliminación de Horario', 'programacion_academica', $id, 'Eliminado vía AJAX. ID: ' . $id);
                
                echo json_encode(['success' => true, 'message' => 'Sesión eliminada correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar en la base de datos.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'No se puede eliminar la sesión porque tiene registros asociados (ej. asistencia).']);
        }
        exit;
    }

    /**
     * Obtener competencias asociadas a la ficha de formación (AJAX)
     */
    public function get_competencias_por_ficha() {
        header('Content-Type: application/json');
        $fichaNum = $_GET['ficha'] ?? 0;
        
        $ficha = $this->fichaModel->find($fichaNum);
        if (!$ficha) {
            echo json_encode(['success' => false, 'message' => 'Ficha no encontrada.']);
            exit;
        }

        $competenciaModel = $this->model('Competencia');
        $competencias = $competenciaModel->getByPrograma($ficha->id_programa);

        echo json_encode([
            'success' => true,
            'programa' => [
                'id_programa' => $ficha->id_programa,
                'nombre' => $ficha->programa_nombre
            ],
            'competencias' => $competencias
        ]);
        exit;
    }

    /**
     * Obtener resultados de aprendizaje asociados a una competencia (AJAX)
     */
    public function get_resultados_por_competencia() {
        header('Content-Type: application/json');
        $idCompetencia = $_GET['id_competencia'] ?? 0;
        $numeroFicha = $_GET['ficha'] ?? 0; // Extra: pasamos la ficha si está disponible

        $resultados = $this->resultadoModel->getByCompetencia($idCompetencia);
        
        // Si hay una ficha, buscamos su configuración específica para los límites
        if ($numeroFicha) {
            $db = Database::getInstance();
            foreach ($resultados as &$r) {
                $db->query("SELECT sesiones_asignadas_ajustadas FROM ficha_resultado_config WHERE numero_ficha = :ficha AND id_resultado = :res");
                $db->bind(':ficha', $numeroFicha);
                $db->bind(':res', $r->id_resultado);
                $configRow = $db->single();
                if ($configRow && $configRow->sesiones_asignadas_ajustadas !== null) {
                    $r->limite_sesiones = (int) $configRow->sesiones_asignadas_ajustadas;
                } else {
                    $r->limite_sesiones = (int) $r->sesiones_asignadas;
                }
            }
        } else {
            foreach ($resultados as &$r) {
                $r->limite_sesiones = (int) $r->sesiones_asignadas;
            }
        }

        echo json_encode([
            'success' => true,
            'resultados' => $resultados
        ]);
        exit;
    }

    /**
     * Programar un lote de sesiones masivamente
     */
    public function programarMasivo() {
        header('Content-Type: application/json');
        try {
            $this->requireRol('Coordinador');
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'No autorizado.']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
            exit;
        }

        $fechas = $input['fechas'] ?? [];
        if (empty($fechas)) {
            echo json_encode(['status' => 'error', 'message' => 'No hay fechas para programar.']);
            exit;
        }

        $db = Database::getInstance();
        $id_lote = bin2hex(random_bytes(8)); // UUID corto para el lote

        try {
            $db->beginTransaction();

            $errores_conflicto = [];
            $sesiones_creadas = 0;

            foreach ($fechas as $fecha) {
                $data = [
                    'numero_ficha' => $input['numero_ficha'],
                    'id_usuario' => $input['id_usuario'],
                    'id_numero_ambiente' => $input['id_ambiente'] ?? $input['id_numero_ambiente'] ?? 0,
                    'hora_inicio' => $input['hora_inicio'],
                    'hora_fin' => $input['hora_fin'],
                    'id_resultado_aprendizaje' => $input['id_resultado'],
                    'fecha_inicio' => $fecha,
                    'id_dias' => date('N', strtotime($fecha))
                ];

                // Validar conflictos para esta fecha específica
                $conflictMessage = $this->programacionModel->getConflictMessage($data);
                if ($conflictMessage) {
                    $errores_conflicto[] = "Conflicto en {$fecha}: {$conflictMessage}";
                    continue; // Skip or we could abort entire batch. Let's abort entire batch for atomic integrity.
                }

                // Insert manual logic or use model's create
                // Since model->create() uses its own queries, we just call it.
                // Wait! To add id_lote we need a custom query or add it to Model.
                // If ProgramacionAcademica model doesn't have id_lote yet, we should inject it here:
                $sql = "INSERT INTO programacion_academica 
                        (numero_ficha, id_usuario, id_numero_ambiente, id_dias, hora_inicio, hora_fin, id_resultado_aprendizaje, fecha_inicio, id_lote) 
                        VALUES 
                        (:ficha, :inst, :amb, :dias, :hi, :hf, :ra, :fech, :lote)";
                
                $db->query($sql);
                $db->bind(':ficha', $data['numero_ficha']);
                $db->bind(':inst', $data['id_usuario']);
                $db->bind(':amb', $data['id_numero_ambiente']);
                $db->bind(':dias', $data['id_dias']);
                $db->bind(':hi', $data['hora_inicio']);
                $db->bind(':hf', $data['hora_fin']);
                $db->bind(':ra', $data['id_resultado_aprendizaje']);
                $db->bind(':fech', $data['fecha_inicio']);
                $db->bind(':lote', $id_lote);

                if (!$db->execute()) {
                    throw new Exception("Error al insertar la fecha {$fecha}");
                }
                $sesiones_creadas++;
            }

            if (!empty($errores_conflicto)) {
                $db->rollBack();
                echo json_encode([
                    'status' => 'error', 
                    'message' => 'Lote revertido por conflictos de horario. Detalles: ' . implode(" | ", $errores_conflicto)
                ]);
                exit;
            }

            $db->commit();
            
            // Audit
            AuditLogger::log('Programación Masiva', 'programacion_academica', null, "Ficha: {$input['numero_ficha']}, Lote: {$id_lote}, Sesiones: {$sesiones_creadas}");

            echo json_encode([
                'status' => 'success',
                'message' => "Se han programado correctamente {$sesiones_creadas} sesiones en el lote."
            ]);

        } catch (Exception $e) {
            $db->rollBack();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        exit;
    }

    /**
     * Crear una nueva programación académica mediante AJAX (Fetch)
     */
    public function create_ajax() {
        header('Content-Type: application/json');
        try {
            $this->requireRol('Coordinador');
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'No autorizado.']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        $data = [
            'numero_ficha' => $input['numero_ficha'] ?? 0,
            'id_usuario' => $input['id_usuario'] ?? 0, // Instructor
            'id_numero_ambiente' => $input['id_numero_ambiente'] ?? 0,
            'id_dias' => $input['id_dias'] ?? 0,
            'hora_inicio' => $input['hora_inicio'] ?? '',
            'hora_fin' => $input['hora_fin'] ?? '',
            'id_resultado_aprendizaje' => $input['id_resultado_aprendizaje'] ?? 0,
            'fecha_inicio' => $input['fecha_inicio'] ?? date('Y-m-d')
        ];

        // Forzar el id_dias basado en la fecha_inicio para que sea atómico (1=Lunes..7=Domingo)
        $data['id_dias'] = date('N', strtotime($data['fecha_inicio']));

        // Validar conflictos
        $conflictMessage = $this->programacionModel->getConflictMessage($data);
        if ($conflictMessage) {
            echo json_encode(['success' => false, 'message' => $conflictMessage]);
            exit;
        }

        try {
            if ($this->programacionModel->create($data)) {
                $db = Database::getInstance();
                $newId = $db->lastInsertId();
                $insertedRow = $this->programacionModel->find($newId);
                echo json_encode([
                    'success' => true,
                    'message' => 'Programación registrada exitosamente.',
                    'data' => $insertedRow
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al registrar la programación en la base de datos.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }

    /**
     * Obtener programación en tiempo real según el rol del usuario logueado (AJAX)
     */
    public function get_programacion_ajax() {
        header('Content-Type: application/json');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'No autorizado.']);
            exit;
        }

        $requested_role = $_GET['role'] ?? '';
        $current_role = $_SESSION['current_role'] ?? 'Aprendiz';
        if ($requested_role !== '' && isset($_SESSION['user_roles']) && in_array($requested_role, $_SESSION['user_roles'])) {
            $current_role = $requested_role;
        }
        $user_id = $_SESSION['user_id'];

        if ($current_role === 'Coordinador') {
            $programacion = $this->programacionModel->all();
        } elseif ($current_role === 'Instructor') {
            $programacion = $this->programacionModel->getByInstructor($user_id);
        } else {
            $programacion = $this->programacionModel->getByAprendiz($user_id);
        }

        $novedadModel = $this->model('NovedadAmbiente');
        $excepciones = $novedadModel->getExcepcionesProgramacion();

        echo json_encode([
            'success' => true,
            'data' => $programacion,
            'excepciones' => $excepciones
        ]);
        exit;
    }

    /**
     * Obtener el detalle diario agrupado por jornadas (AJAX)
     */
    public function detalle_dia() {
        header('Content-Type: application/json');
        $fecha = $_GET['fecha'] ?? '';
        if (empty($fecha)) {
            echo json_encode(['success' => false, 'message' => 'Fecha requerida.']);
            exit;
        }

        $programaciones = $this->programacionModel->getByFechaDetalle($fecha);

        // Agrupar por jornada
        $jornadas = [
            'Mañana' => [],
            'Tarde' => [],
            'Nocturna' => []
        ];

        foreach ($programaciones as $p) {
            $jKey = 'Mañana';
            if (stripos($p->jornada_nombre, 'tarde') !== false) {
                $jKey = 'Tarde';
            } elseif (stripos($p->jornada_nombre, 'noc') !== false || stripos($p->jornada_nombre, 'nocturna') !== false) {
                $jKey = 'Nocturna';
            }
            $jornadas[$jKey][] = $p;
        }

        echo json_encode([
            'success' => true,
            'fecha' => $fecha,
            'jornadas' => $jornadas
        ]);
        exit;
    }

    /**
     * Liberar ambiente para una fecha específica (Novedad)
     */
    public function liberar_ajax() {
        header('Content-Type: application/json');
        try {
            $this->requireRol('Coordinador');
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'No autorizado.']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        
        $id_programacion = $input['id_programacion'] ?? 0;
        $fecha = $input['fecha'] ?? '';
        $motivo = $input['motivo'] ?? '';
        $id_ambiente = $input['id_ambiente'] ?? 0;

        if (!$id_programacion || !$fecha || !$motivo || !$id_ambiente) {
            echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios.']);
            exit;
        }

        $descripcion = "[LIBERADO_PROG:{$id_programacion}] Motivo: {$motivo}";
        
        $dataNovedad = [
            'id_numero_ambiente' => $id_ambiente,
            'id_usuario' => $_SESSION['user_id'],
            'descripcion' => $descripcion,
            'fecha_reporte' => $fecha
        ];

        $novedadModel = $this->model('NovedadAmbiente');
        
        try {
            if ($novedadModel->create($dataNovedad)) {
                AuditLogger::log('Ambiente Liberado', 'novedad_ambiente', null, "ProgID: {$id_programacion}, Fecha: {$fecha}");
                echo json_encode(['success' => true, 'message' => 'Ambiente liberado correctamente para esta fecha.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al guardar la novedad.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
        exit;
    }
}
