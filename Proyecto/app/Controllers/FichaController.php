<?php
/**
 * Controlador FichaController
 * Gestiona el listado y administración de las fichas de formación.
 */
class FichaController extends BaseController {
    private $fichaModel;
    private $fichaAprendizModel;
    private $programacionModel;
    private $programaModel;
    private $jornadaModel;
    private $usuarioModel;
    private $competenciaModel;
    private $resultadoModel;
    private $fichaConfigModel;

    public function __construct() {
        $this->fichaModel = $this->model('Ficha');
        $this->fichaAprendizModel = $this->model('FichaAprendiz');
        $this->programacionModel = $this->model('ProgramacionAcademica');
        $this->programaModel = $this->model('Programa');
        $this->jornadaModel = $this->model('Jornada');
        $this->usuarioModel = $this->model('Usuario');
        $this->competenciaModel = $this->model('Competencia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
        $this->fichaConfigModel = $this->model('FichaResultadoConfig');
    }

    /**
     * Listado de fichas según el rol
     */
    public function index() {
        $this->requireLogin();
        $current_role = $_SESSION['current_role'] ?? 'Aprendiz';
        $user_id = $_SESSION['user_id'];

        if ($current_role === 'Coordinador') {
            $fichas = $this->fichaModel->all();
        } elseif ($current_role === 'Instructor') {
            $fichas = $this->fichaModel->getByInstructor($user_id);
        } else {
            $fichas = $this->fichaModel->getByAprendiz($user_id);
        }

        // Obtener listas para el modal de creación (sólo útil para el Coordinador)
        $programas = $this->programaModel->all();
        $jornadas = $this->jornadaModel->all();
        
        // Filtrar instructores para asignar como líderes y aprendices para gestión
        $todosUsuarios = $this->usuarioModel->all();
        $instructores = [];
        $candidatos = [];
        foreach ($todosUsuarios as $u) {
            $roles = $this->usuarioModel->getRoles($u->id_usuario);
            foreach ($roles as $r) {
                if ($r->nombre_rol === 'Instructor') {
                    $instructores[] = $u;
                }
                if ($r->nombre_rol === 'Aprendiz') {
                    $candidatos[] = $u;
                }
            }
        }

        // Calcular aprendices matriculados por ficha para mostrar los cupos ocupados
        $matriculados_counts = [];
        foreach ($fichas as $f) {
            $matriculados_counts[$f->numero_ficha] = count($this->fichaAprendizModel->getAprendicesPorFicha($f->numero_ficha));
        }

        $this->render('fichas/index', [
            'titulo' => 'Listado de Fichas',
            'fichas' => $fichas,
            'programas' => $programas,
            'jornadas' => $jornadas,
            'instructores' => $instructores,
            'candidatos' => $candidatos,
            'current_role' => $current_role,
            'matriculados_counts' => $matriculados_counts
        ]);
    }

    /**
     * Mostrar detalles de una ficha específica
     */
    public function show() {
        $this->requireLogin();
        $numero_ficha = $_GET['id'] ?? 0;

        $ficha = $this->fichaModel->find($numero_ficha);
        if (!$ficha) {
            $_SESSION['flash_error'] = 'La ficha solicitada no existe.';
            $this->redirect('dashboard/index#pills-fichas');
        }

        $aprendices = $this->fichaAprendizModel->getAprendicesPorFicha($numero_ficha);
        $programacion = $this->programacionModel->getByFicha($numero_ficha);

        // Obtener todos los aprendices y datos para los modales (Coordinador)
        $programas = $this->programaModel->all();
        $jornadas = $this->jornadaModel->all();
        
        $todosUsuarios = $this->usuarioModel->all();

        // Obtener IDs de los aprendices ya matriculados
        $matriculadosIds = array_map(function($ap) {
            return (int) $ap->id_usuario_aprendiz;
        }, $aprendices);

        $candidatos = [];
        $instructores = [];
        foreach ($todosUsuarios as $u) {
            $roles = $this->usuarioModel->getRoles($u->id_usuario);
            foreach ($roles as $r) {
                if ($r->nombre_rol === 'Aprendiz') {
                    // Filtrar: únicamente aprendices que aún no pertenezcan a esa ficha
                    if (!in_array((int)$u->id_usuario, $matriculadosIds)) {
                        $candidatos[] = $u;
                    }
                }
                if ($r->nombre_rol === 'Instructor') {
                    $instructores[] = $u;
                }
            }
        }

        // Métricas resumidas y Extracción de progreso por RAP
        $total_sesiones_programadas = 0;
        $sesiones_realizadas = 0;
        $total_horas_programadas = 0;
        $horas_realizadas = 0;
        
        $progreso_raps = [];

        foreach ($programacion as $prog) {
            $id_ra = (int) $prog->id_resultado_aprendizaje;
            
            // Calcular el progreso global (Una sola vez por RAP)
            if (!isset($progreso_raps[$id_ra])) {
                $progreso_raps[$id_ra] = [
                    'sesiones_realizadas' => (int)($prog->sesiones_realizadas ?? 0),
                    'total_sesiones' => (int)($prog->total_sesiones ?? 0),
                    'horas_realizadas' => (int)($prog->horas_realizadas ?? 0),
                    'total_horas' => (int)($prog->total_horas ?? 0)
                ];
                $total_sesiones_programadas += $progreso_raps[$id_ra]['total_sesiones'];
                $sesiones_realizadas += $progreso_raps[$id_ra]['sesiones_realizadas'];
                $total_horas_programadas += $progreso_raps[$id_ra]['total_horas'];
                $horas_realizadas += $progreso_raps[$id_ra]['horas_realizadas'];
            }
        }
        $sesiones_pendientes = max(0, $total_sesiones_programadas - $sesiones_realizadas);
        $porcentaje_avance = $total_horas_programadas > 0 ? round(($horas_realizadas / $total_horas_programadas) * 100) : 0;

        // Extraer competencias y resultados asociados únicos (de programaciones existentes)
        $competencias_asociadas = [];
        $resultados_asociados = [];
        foreach ($programacion as $prog) {
            if (!empty($prog->competencia_nombre)) {
                $competencias_asociadas[$prog->competencia_nombre] = true;
            }
            if (!empty($prog->ra_codigo)) {
                $resultados_asociados[$prog->ra_codigo] = $prog->ra_descripcion;
            }
        }

        // Obtener el programa de la ficha
        $programa = $this->programaModel->find($ficha->id_programa);
        
        // Obtener TODAS las competencias asociadas al programa de la ficha (Nuevo Requerimiento)
        $competencias_programa = $this->competenciaModel->getByPrograma($ficha->id_programa);
        $resultados_programa = [];
        foreach ($competencias_programa as $comp) {
            $resultados_programa[$comp->id_competencia] = $this->resultadoModel->getByCompetencia($comp->id_competencia);
        }

        $this->render('fichas/show', [
            'titulo' => 'Detalle de Ficha: ' . $ficha->numero_ficha,
            'ficha' => $ficha,
            'programa' => $programa,
            'aprendices' => $aprendices,
            'programacion' => $programacion,
            'candidatos' => $candidatos,
            'programas' => $programas,
            'jornadas' => $jornadas,
            'instructores' => $instructores,
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz',
            // Métricas
            'total_sesiones_programadas' => $total_sesiones_programadas,
            'sesiones_realizadas' => $sesiones_realizadas,
            'sesiones_pendientes' => $sesiones_pendientes,
            'porcentaje_avance' => $porcentaje_avance,
            'total_horas_programadas' => $total_horas_programadas,
            'horas_realizadas' => $horas_realizadas,
            'progreso_raps' => $progreso_raps,
            'competencias_asociadas' => array_keys($competencias_asociadas),
            'resultados_asociados' => $resultados_asociados,
            // Curriculum completo
            'competencias_programa' => $competencias_programa,
            'resultados_programa' => $resultados_programa
        ]);
    }

    /**
     * Crear una ficha nueva (Coordinador)
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_ficha = $_POST['numero_ficha'] ?? 0;
            $cantidad_estudiantes = $_POST['cantidad_estudiantes'] ?? 0;
            $fecha_inicio = $_POST['fecha_inicio'] ?? '';
            $fecha_practicas = $_POST['fecha_practicas'] ?? '';
            $fecha_fin = $_POST['fecha_fin'] ?? '';
            $id_usuario_instructor_lider = $_POST['id_usuario_instructor_lider'] ?? 0;
            $id_programa = $_POST['id_programa'] ?? 0;
            $id_jornada = $_POST['id_jornada'] ?? 0;

            $errors = [];
            if (empty($numero_ficha) || $numero_ficha <= 0) {
                $errors[] = "El número de ficha debe ser mayor a cero.";
            } else {
                if ($this->fichaModel->find($numero_ficha)) {
                    $errors[] = "El número de ficha ya se encuentra registrado.";
                }
            }

            if ($cantidad_estudiantes <= 0) {
                $errors[] = "La cantidad de cupos debe ser mayor a cero.";
            }

            if (empty($id_programa)) {
                $errors[] = "Debe seleccionar un programa de formación.";
            } else {
                if (!$this->programaModel->find($id_programa)) {
                    $errors[] = "El programa de formación seleccionado no existe.";
                }
            }

            if (empty($id_usuario_instructor_lider)) {
                $errors[] = "Debe asignar un instructor líder.";
            } else {
                $roles_instructor = $this->usuarioModel->getRoles($id_usuario_instructor_lider);
                $is_instructor = false;
                foreach ($roles_instructor as $rol) {
                    if ($rol->nombre_rol === 'Instructor') {
                        $is_instructor = true;
                        break;
                    }
                }
                if (!$is_instructor) {
                    $errors[] = "El usuario seleccionado como líder no tiene el rol de Instructor.";
                }
            }

            if (empty($id_jornada)) {
                $errors[] = "Debe seleccionar la jornada.";
            } else {
                if (!$this->jornadaModel->find($id_jornada)) {
                    $errors[] = "La jornada seleccionada no existe.";
                }
            }

            // Automatización del cálculo de fechas para programas de tipo 'Tecnólogo'
            if (!empty($id_programa) && !empty($fecha_inicio)) {
                $programaInfo = $this->programaModel->find($id_programa);
                if ($programaInfo && strcasecmp($programaInfo->tipo_nombre, 'Tecnólogo') === 0) {
                    try {
                        $dtInicio = new DateTime($fecha_inicio);
                        
                        $dtPracticas = clone $dtInicio;
                        $dtPracticas->modify('+21 months');
                        $fecha_practicas = $dtPracticas->format('Y-m-d');
                        
                        $dtFin = clone $dtInicio;
                        $dtFin->modify('+27 months');
                        $fecha_fin = $dtFin->format('Y-m-d');
                    } catch (Exception $e) {
                        $errors[] = "Formato de fecha de inicio inválido.";
                    }
                }
            }

            if (empty($fecha_inicio) || empty($fecha_practicas) || empty($fecha_fin)) {
                $errors[] = "Todas las fechas son obligatorias.";
            } else {
                if ($fecha_inicio > $fecha_practicas) {
                    $errors[] = "La fecha de inicio de prácticas no puede ser menor a la fecha de inicio.";
                }
                if ($fecha_practicas > $fecha_fin) {
                    $errors[] = "La fecha de finalización no puede ser menor a la de prácticas.";
                }
            }

            $is_ajax = isset($_POST['is_ajax']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');

            if (!empty($errors)) {
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => implode("<br>", $errors)]);
                    exit;
                } else {
                    $_SESSION['flash_error'] = implode("<br>", $errors);
                    $this->redirect('dashboard/index#pills-fichas');
                }
            }

            $data = [
                'numero_ficha' => $numero_ficha,
                'cantidad_estudiantes' => $cantidad_estudiantes,
                'fecha_inicio' => $fecha_inicio,
                'fecha_practicas' => $fecha_practicas,
                'fecha_fin' => $fecha_fin,
                'id_usuario_instructor_lider' => $id_usuario_instructor_lider,
                'id_programa' => $id_programa,
                'id_jornada' => $id_jornada
            ];

            if ($this->fichaModel->create($data)) {
                // Auditoría de Creación de Ficha
                AuditLogger::log('Creación de Ficha', 'fichas', $data['numero_ficha'], 'Programa ID: ' . $id_programa . ', Cupos: ' . $cantidad_estudiantes);
                
                $nuevaFicha = $this->fichaModel->find($data['numero_ficha']);
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'data' => $nuevaFicha]);
                    exit;
                } else {
                    $_SESSION['flash_success'] = 'Ficha creada exitosamente.';
                    $this->redirect('dashboard/index#pills-fichas');
                }
            } else {
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'Error al guardar en la base de datos.']);
                    exit;
                } else {
                    $_SESSION['flash_error'] = 'Error al crear la ficha en la base de datos.';
                    $this->redirect('dashboard/index#pills-fichas');
                }
            }
        }
    }

    /**
     * Matricular un aprendiz en una ficha (Coordinador)
     */
    public function asociarAprendices() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            
            $numero_ficha = $_POST['numero_ficha'] ?? 0;
            $aprendices_ids = $_POST['aprendices'] ?? [];

            if (empty($aprendices_ids) || !$numero_ficha) {
                echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
                exit;
            }

            // Validar existencia de la ficha
            $ficha = $this->fichaModel->find($numero_ficha);
            if (!$ficha) {
                echo json_encode(['success' => false, 'message' => 'La ficha no existe.']);
                exit;
            }

            // Validar cupos
            $actuales = $this->fichaAprendizModel->getAprendicesPorFicha($numero_ficha);
            $cupos_disponibles = $ficha->cantidad_estudiantes - count($actuales);
            
            if (count($aprendices_ids) > $cupos_disponibles) {
                echo json_encode(['success' => false, 'message' => "Cupos insuficientes. Intentas asociar " . count($aprendices_ids) . " pero solo quedan $cupos_disponibles cupos."]);
                exit;
            }

            $exitos = 0;
            foreach ($aprendices_ids as $id_aprendiz) {
                if ($this->fichaAprendizModel->create($id_aprendiz, $numero_ficha)) {
                    $exitos++;
                }
            }

            if ($exitos > 0) {
                if (class_exists('AuditLogger')) {
                    AuditLogger::log('Matrícula Masiva', 'ficha_aprendiz', $numero_ficha, "Asociados $exitos aprendices");
                }
                echo json_encode(['success' => true, 'message' => "$exitos aprendiz(ces) asociados exitosamente."]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo asociar a los aprendices seleccionados (posiblemente ya están matriculados en una ficha activa).']);
            }
            exit;
        }
    }

    /**
     * Eliminar la matrícula de un aprendiz en una ficha
     */
    public function removerAprendiz() {
        $this->requireRol('Coordinador');
        $id_ficha_aprendiz = $_GET['id'] ?? 0;
        $numero_ficha = $_GET['ficha'] ?? 0;

        if ($this->fichaAprendizModel->delete($id_ficha_aprendiz)) {
            // Auditoría de Desvinculación de Aprendiz
            AuditLogger::log('Desvinculación de Aprendiz', 'ficha_aprendiz', $numero_ficha, 'ID Relación Ficha Aprendiz: ' . $id_ficha_aprendiz);
            $_SESSION['flash_success'] = 'Aprendiz desvinculado de la ficha exitosamente.';
        } else {
            $_SESSION['flash_error'] = 'Error al desvincular al aprendiz.';
        }
        $this->redirect('fichas/show&id=' . $numero_ficha);
    }

    /**
     * Actualizar una ficha existente (Coordinador)
     */
    public function update() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_ficha_antiguo = $_POST['numero_ficha_original'] ?? 0;
            $cantidad_estudiantes = $_POST['cantidad_estudiantes'] ?? 0;
            $fecha_inicio = $_POST['fecha_inicio'] ?? '';
            $fecha_practicas = $_POST['fecha_practicas'] ?? '';
            $fecha_fin = $_POST['fecha_fin'] ?? '';
            $id_usuario_instructor_lider = $_POST['id_usuario_instructor_lider'] ?? 0;
            $id_programa = $_POST['id_programa'] ?? 0;
            $id_jornada = $_POST['id_jornada'] ?? 0;

            $errors = [];

            if ($cantidad_estudiantes <= 0) {
                $errors[] = "La cantidad de cupos debe ser mayor a cero.";
            } else {
                // Validar que no se reduzcan los cupos por debajo de los aprendices ya matriculados
                $aprendices = $this->fichaAprendizModel->getAprendicesPorFicha($numero_ficha_antiguo);
                if ($cantidad_estudiantes < count($aprendices)) {
                    $errors[] = "No se puede reducir el cupo a $cantidad_estudiantes porque ya hay " . count($aprendices) . " aprendices matriculados.";
                }
            }

            if (empty($id_programa)) {
                $errors[] = "Debe seleccionar un programa de formación.";
            } else {
                if (!$this->programaModel->find($id_programa)) {
                    $errors[] = "El programa de formación seleccionado no existe.";
                }
            }

            if (empty($id_usuario_instructor_lider)) {
                $errors[] = "Debe asignar un instructor líder.";
            } else {
                $roles_instructor = $this->usuarioModel->getRoles($id_usuario_instructor_lider);
                $is_instructor = false;
                foreach ($roles_instructor as $rol) {
                    if ($rol->nombre_rol === 'Instructor') {
                        $is_instructor = true;
                        break;
                    }
                }
                if (!$is_instructor) {
                    $errors[] = "El usuario seleccionado como líder no tiene el rol de Instructor.";
                }
            }

            if (empty($id_jornada)) {
                $errors[] = "Debe seleccionar la jornada.";
            } else {
                if (!$this->jornadaModel->find($id_jornada)) {
                    $errors[] = "La jornada seleccionada no existe.";
                }
            }

            if (empty($fecha_inicio) || empty($fecha_practicas) || empty($fecha_fin)) {
                $errors[] = "Todas las fechas son obligatorias.";
            } else {
                if ($fecha_inicio > $fecha_practicas) {
                    $errors[] = "La fecha de inicio de prácticas no puede ser menor a la fecha de inicio.";
                }
                if ($fecha_practicas > $fecha_fin) {
                    $errors[] = "La fecha de finalización no puede ser menor a la de prácticas.";
                }
            }

            $is_ajax = isset($_POST['is_ajax']) || (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest');
            $from_show = isset($_POST['from_show']) && $_POST['from_show'] == '1';

            if (!empty($errors)) {
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => implode("<br>", $errors)]);
                    exit;
                } else {
                    $_SESSION['flash_error'] = implode("<br>", $errors);
                    if ($from_show) {
                        $this->redirect('fichas/show&id=' . $numero_ficha_antiguo);
                    } else {
                        $this->redirect('dashboard/index#pills-fichas');
                    }
                }
            }

            $data = [
                'numero_ficha' => $numero_ficha_antiguo,
                'cantidad_estudiantes' => $cantidad_estudiantes,
                'fecha_inicio' => $fecha_inicio,
                'fecha_practicas' => $fecha_practicas,
                'fecha_fin' => $fecha_fin,
                'id_usuario_instructor_lider' => $id_usuario_instructor_lider,
                'id_programa' => $id_programa,
                'id_jornada' => $id_jornada
            ];

            if ($this->fichaModel->update($numero_ficha_antiguo, $data)) {
                // Auditoría de Actualización de Ficha
                AuditLogger::log('Actualización de Ficha', 'fichas', $numero_ficha_antiguo, 'Cupos: ' . $cantidad_estudiantes . ', Programa: ' . $id_programa);
                
                $fichaActualizada = $this->fichaModel->find($numero_ficha_antiguo);
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'success', 'data' => $fichaActualizada]);
                    exit;
                } else {
                    $_SESSION['flash_success'] = 'Ficha actualizada exitosamente.';
                    if ($from_show) {
                        $this->redirect('fichas/show&id=' . $numero_ficha_antiguo);
                    } else {
                        $this->redirect('dashboard/index#pills-fichas');
                    }
                }
            } else {
                if ($is_ajax) {
                    header('Content-Type: application/json');
                    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la ficha.']);
                    exit;
                } else {
                    $_SESSION['flash_error'] = 'Error al actualizar la ficha.';
                    if ($from_show) {
                        $this->redirect('fichas/show&id=' . $numero_ficha_antiguo);
                    } else {
                        $this->redirect('dashboard/index#pills-fichas');
                    }
                }
            }
        }
    }

    /**
     * Eliminar una ficha
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            // 1. Validar si tiene aprendices matriculados
            $aprendices = $this->fichaAprendizModel->getAprendicesPorFicha($id);
            if (count($aprendices) > 0) {
                $_SESSION['flash_error'] = 'No se puede eliminar la ficha porque tiene ' . count($aprendices) . ' aprendices matriculados.';
                $this->redirect('dashboard/index#pills-fichas');
            }

            // 2. Validar si tiene programaciones académicas activas
            $programacion = $this->programacionModel->getByFicha($id);
            if (count($programacion) > 0) {
                $_SESSION['flash_error'] = 'No se puede eliminar la ficha porque tiene programaciones académicas activas.';
                $this->redirect('dashboard/index#pills-fichas');
            }

            // 3. Validar si tiene asistencias registradas
            $db = Database::getInstance();
            $db->query("SELECT COUNT(*) as total FROM asistencia a 
                        INNER JOIN programacion_academica pa ON a.id_programacion = pa.id_programacion 
                        WHERE pa.numero_ficha = :numero_ficha");
            $db->bind(':numero_ficha', $id);
            $res = $db->single();
            if ($res && $res->total > 0) {
                $_SESSION['flash_error'] = 'No se puede eliminar la ficha porque tiene asistencias registradas.';
                $this->redirect('dashboard/index#pills-fichas');
            }

            if ($this->fichaModel->delete($id)) {
                // Auditoría de Eliminación de Ficha
                AuditLogger::log('Eliminación de Ficha', 'fichas', $id, 'Ficha número: ' . $id);
                $_SESSION['flash_success'] = 'Ficha eliminada correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar la ficha en la base de datos.';
            }
        } else {
            $_SESSION['flash_error'] = 'ID de ficha no válido.';
        }
        $this->redirect('dashboard/index#pills-fichas');
    }

    /**
     * Crear un usuario aprendiz y matricularlo directamente en la ficha
     */
    public function crearYMatricular() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_ficha = $_POST['numero_ficha'] ?? 0;
            $nombre = $_POST['nombre'] ?? '';
            $apellido = $_POST['apellido'] ?? '';
            $documento = trim($_POST['documento'] ?? '');
            $telefono = $_POST['telefono'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $contrasena = trim($_POST['contrasena'] ?? '');
            
            // Validaciones básicas
            if (empty($nombre) || empty($apellido) || empty($documento) || empty($correo)) {
                $_SESSION['flash_error'] = 'Por favor, complete todos los campos obligatorios.';
                $this->redirect('dashboard/index#pills-fichas');
                return;
            }

            // Crear el usuario
            $data = [
                'nombre' => $nombre,
                'apellido' => $apellido,
                'documento' => $documento,
                'telefono' => $telefono,
                'correo' => $correo,
                'titulacion' => 'Aprendiz', // Por defecto para aprendices creados aquí
                'usuario' => $documento,
                'contrasena' => !empty($contrasena) ? password_hash($contrasena, PASSWORD_BCRYPT) : ''
            ];

            if ($this->usuarioModel->create($data)) {
                $db = Database::getInstance();
                $id_usuario = $db->lastInsertId();
                
                // Buscar el ID del rol "Aprendiz"
                $rolModel = $this->model('Rol');
                $roles = $rolModel->all();
                $id_rol_aprendiz = 0;
                foreach ($roles as $r) {
                    if ($r->nombre_rol === 'Aprendiz') {
                        $id_rol_aprendiz = $r->id_rol;
                        break;
                    }
                }
                
                // Asignar rol
                if ($id_rol_aprendiz > 0) {
                    $usuarioRolModel = $this->model('UsuarioRol');
                    $usuarioRolModel->create($id_usuario, $id_rol_aprendiz);
                }
                
                // Matricular en la ficha
                if ($this->fichaAprendizModel->create($id_usuario, $numero_ficha)) {
                    $_SESSION['flash_success'] = 'Aprendiz creado y matriculado exitosamente en la ficha.';
                } else {
                    $_SESSION['flash_error'] = 'Usuario creado, pero hubo un error al matricularlo en la ficha.';
                }
            } else {
                $_SESSION['flash_error'] = 'Error al registrar el usuario en el sistema. Es posible que el documento ya exista.';
            }
            $this->redirect('dashboard/index#pills-fichas');
        }
    }

    /**
     * Matricular un aprendiz individualmente desde el index
     */
    public function inscribirAprendizIndex() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_ficha = $_POST['numero_ficha'] ?? 0;
            $id_usuario_aprendiz = $_POST['id_usuario_aprendiz'] ?? 0;

            if ($this->fichaAprendizModel->create($id_usuario_aprendiz, $numero_ficha)) {
                $_SESSION['flash_success'] = 'Aprendiz matriculado exitosamente en la ficha.';
            } else {
                $_SESSION['flash_error'] = 'El aprendiz ya se encuentra matriculado en una ficha activa.';
            }
            $this->redirect('dashboard/index#pills-fichas');
        }
    }

    /**
     * Carga masiva de aprendices vía CSV
     */
    public function inscribirMasivoCSV() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_csv'])) {
            $numero_ficha = $_POST['numero_ficha'] ?? 0;
            $file = $_FILES['archivo_csv']['tmp_name'];
            
            if (!$file) {
                $_SESSION['flash_error'] = 'Debe subir un archivo CSV.';
                $this->redirect('dashboard/index#pills-fichas');
            }

            $handle = fopen($file, 'r');
            if ($handle === false) {
                $_SESSION['flash_error'] = 'No se pudo leer el archivo CSV.';
                $this->redirect('dashboard/index#pills-fichas');
            }

            $db = Database::getInstance();
            $db->beginTransaction();

            try {
                $fila = 0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $fila++;
                    $documento = trim($data[0]);
                    if (empty($documento)) continue;

                    $usuario = $this->usuarioModel->findByDocumento($documento);
                    
                    if (!$usuario) {
                        throw new Exception("El aprendiz con documento $documento no existe en el sistema (Fila $fila).");
                    }

                    $inscrito = $this->fichaAprendizModel->create($usuario->id_usuario, $numero_ficha);
                    if (!$inscrito) {
                        throw new Exception("El aprendiz con documento $documento ya se encuentra matriculado en otra ficha activa (Fila $fila).");
                    }
                }
                fclose($handle);
                $db->commit();
                $_SESSION['flash_success'] = 'Carga masiva completada con éxito.';
            } catch (Exception $e) {
                $db->rollBack();
                if ($handle) fclose($handle);
                $_SESSION['flash_error'] = 'Carga Masiva Cancelada: ' . $e->getMessage();
            }
            
            $this->redirect('dashboard/index#pills-fichas');
        }
    }

    /**
     * Ajuste Inteligente de Competencias (Masivo)
     */
    public function guardarAjusteMasivo() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_ficha = $_POST['numero_ficha'] ?? null;
            $raps = $_POST['raps'] ?? [];

            if (!$numero_ficha || empty($raps)) {
                $_SESSION['flash_error'] = 'Datos insuficientes para el ajuste.';
                $this->redirect('fichas/show&id=' . ($numero_ficha ?? ''));
                return;
            }

            $db = Database::getInstance();
            $db->beginTransaction();

            try {
                $sql = "INSERT INTO ficha_resultado_config 
                        (numero_ficha, id_resultado, porcentaje_ajustado, horas_a_ejecutar_ajustadas, sesiones_asignadas_ajustadas) 
                        VALUES (:ficha, :id_resultado, :porcentaje, :horas, :sesiones)
                        ON DUPLICATE KEY UPDATE 
                        porcentaje_ajustado = VALUES(porcentaje_ajustado),
                        horas_a_ejecutar_ajustadas = VALUES(horas_a_ejecutar_ajustadas),
                        sesiones_asignadas_ajustadas = VALUES(sesiones_asignadas_ajustadas)";

                // Calcular horas base por defecto a partir de la competencia
                $id_comp = $_POST['id_competencia'] ?? 0;
                $horas_base_default = 0;
                if ($id_comp > 0) {
                    $competencia = $this->competenciaModel->find($id_comp);
                    $raps_db = $this->resultadoModel->getByCompetencia($id_comp);
                    if ($competencia && count($raps_db) > 0) {
                        $horas_base_default = $competencia->horas_totales / count($raps_db);
                    }
                }

                foreach ($raps as $rap) {
                    $sesiones_finales = (int)$rap['sesiones'];
                    $porcentaje_final = (float)$rap['porcentaje'];
                    
                    // Si horas_base viene en 0, usar el default calculado
                    $horas_base = (float)($rap['horas_base'] ?? 0);
                    if ($horas_base <= 0) $horas_base = $horas_base_default;
                    
                    $horas_finales = $horas_base * ($porcentaje_final / 100);

                    $db->query($sql);
                    $db->bind(':ficha', $numero_ficha);
                    $db->bind(':id_resultado', $rap['id_resultado']);
                    $db->bind(':porcentaje', $porcentaje_final);
                    $db->bind(':horas', $horas_finales);
                    $db->bind(':sesiones', $sesiones_finales);
                    $db->execute();
                }

                $db->commit();
                $_SESSION['flash_success'] = 'Configuración de la competencia guardada correctamente.';
                
                if (class_exists('AuditLogger')) {
                    AuditLogger::log('Ajuste Masivo de Competencia', 'ficha_resultado_config', $numero_ficha, "Ajustados " . count($raps) . " RAPs");
                }
            } catch (Exception $e) {
                $db->rollBack();
                $_SESSION['flash_error'] = 'Error al guardar configuración: ' . $e->getMessage();
            }

            $this->redirect('fichas/show&id=' . $numero_ficha);
        }
    }

    /**
     * Endpoint Fetch para obtener RAPs y sus configuraciones actuales
     */
    public function getAjustesCompetencia() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            
            $id_competencia = $data['id_competencia'] ?? null;
            $numero_ficha = $data['numero_ficha'] ?? null;

            if (!$id_competencia || !$numero_ficha) {
                echo json_encode(['status' => 'error', 'message' => 'Faltan datos requeridos.']);
                exit;
            }

            $raps = $this->resultadoModel->getByCompetencia($id_competencia);
            $competencia = $this->competenciaModel->find($id_competencia);
            $horas_base_default = ($competencia && count($raps) > 0) ? ($competencia->horas_totales / count($raps)) : 0;
            
            $db = Database::getInstance();
            $db->query("SELECT id_resultado, porcentaje_ajustado, sesiones_asignadas_ajustadas FROM ficha_resultado_config WHERE numero_ficha = :ficha");
            $db->bind(':ficha', $numero_ficha);
            $configs = $db->resultSet();
            
            $config_map = [];
            foreach ($configs as $cfg) {
                $config_map[$cfg->id_resultado] = $cfg;
            }

            $response_raps = [];
            foreach ($raps as $rap) {
                // Si no existe horas_base, lo deducimos de sesiones_asignadas o del promedio de la competencia
                if (isset($rap->horas_base) && $rap->horas_base > 0) {
                    $horas_base = (float)$rap->horas_base;
                } elseif (isset($rap->sesiones_asignadas) && $rap->sesiones_asignadas > 0) {
                    $horas_base = (int)$rap->sesiones_asignadas * 6;
                } else {
                    $horas_base = $horas_base_default;
                }

                $porcentaje = 100;
                $sesiones = isset($rap->sesiones_asignadas) && $rap->sesiones_asignadas > 0 ? (int)$rap->sesiones_asignadas : ceil($horas_base / 6);
                
                if (isset($config_map[$rap->id_resultado])) {
                    $porcentaje = (float)$config_map[$rap->id_resultado]->porcentaje_ajustado;
                    $sesiones = (int)$config_map[$rap->id_resultado]->sesiones_asignadas_ajustadas;
                }

                $response_raps[] = [
                    'id_resultado' => $rap->id_resultado,
                    'codigo' => $rap->codigo,
                    'descripcion' => $rap->descripcion,
                    'horas_base' => $horas_base,
                    'porcentaje_ajustado' => $porcentaje,
                    'sesiones_asignadas_ajustadas' => $sesiones
                ];
            }

            echo json_encode(['status' => 'success', 'raps' => $response_raps]);
            exit;
        }
    }

    /**
     * Endpoint Fetch para guardar los ajustes masivos
     */
    public function guardarAjusteMasivoFetch() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            $numero_ficha = $data['numero_ficha'] ?? null;
            $id_competencia = $data['id_competencia'] ?? null;
            $raps = $data['raps'] ?? [];

            if (!$numero_ficha || !$id_competencia || empty($raps)) {
                echo json_encode(['status' => 'error', 'message' => 'Datos insuficientes para el ajuste.']);
                exit;
            }

            $db = Database::getInstance();
            $db->beginTransaction();

            try {
                $sql = "INSERT INTO ficha_resultado_config 
                        (numero_ficha, id_resultado, porcentaje_ajustado, sesiones_asignadas_ajustadas) 
                        VALUES (:ficha, :id_resultado, :porcentaje, :sesiones)
                        ON DUPLICATE KEY UPDATE 
                        porcentaje_ajustado = VALUES(porcentaje_ajustado),
                        sesiones_asignadas_ajustadas = VALUES(sesiones_asignadas_ajustadas)";

                foreach ($raps as $rap) {
                    $sesiones_finales = (int)$rap['sesiones'];
                    $porcentaje_final = (float)$rap['porcentaje'];

                    $db->query($sql);
                    $db->bind(':ficha', $numero_ficha);
                    $db->bind(':id_resultado', $rap['id_resultado']);
                    $db->bind(':porcentaje', $porcentaje_final);
                    $db->bind(':sesiones', $sesiones_finales);
                    $db->execute();
                }

                $db->commit();
                echo json_encode(['status' => 'success']);
                
                if (class_exists('AuditLogger')) {
                    AuditLogger::log('Ajuste Masivo Fetch', 'ficha_resultado_config', $numero_ficha, "Ajustados " . count($raps) . " RAPs");
                }
            } catch (Exception $e) {
                $db->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'Error al guardar configuración: ' . $e->getMessage()]);
            }
            exit;
        }
    }

    /**
     * Obtiene el progreso detallado por RAP de una competencia específica para un aprendiz
     */
    public function getProgresoCompetencia() {
        header('Content-Type: application/json');
        
        $this->requireLogin();
        $id_competencia = $_GET['id_competencia'] ?? 0;
        $id_estudiante = $_SESSION['user_id'];
        
        // El aprendiz solo puede ver su propio progreso, necesitamos obtener su ficha activa
        $db = Database::getInstance();
        $db->query("SELECT numero_ficha FROM ficha_aprendiz WHERE id_usuario_aprendiz = :id_estudiante AND estado = 'Activo' LIMIT 1");
        $db->bind(':id_estudiante', $id_estudiante);
        $fichaRow = $db->single();
        
        if (!$fichaRow) {
            echo json_encode(['status' => 'error', 'message' => 'No estás asignado a una ficha activa.']);
            exit;
        }
        
        $numero_ficha = $fichaRow->numero_ficha;

        try {
            $sql = "
                SELECT 
                    c.id_competencia,
                    c.nombre AS competencia_nombre,
                    ra.id_resultado,
                    ra.descripcion AS rap_descripcion,
                    
                    -- Horas Totales Permitidas (Límite configurado en Ficha o Límite base)
                    COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) AS sesiones_totales_rap,
                    COALESCE(frc.sesiones_asignadas_ajustadas, ra.sesiones_asignadas) * 6 AS horas_totales_rap,
                    
                    -- Horas Ejecutadas por el ESTUDIANTE (Asistencias efectivas)
                    COALESCE((
                        SELECT COUNT(DISTINCT asi.fecha_asistencia)
                        FROM asistencia asi
                        INNER JOIN programacion_academica pa ON asi.id_programacion = pa.id_programacion
                        WHERE pa.id_resultado_aprendizaje = ra.id_resultado
                          AND pa.numero_ficha = :numero_ficha
                          AND asi.id_usuario_aprendiz = :id_estudiante
                          AND asi.asistio = 1
                    ), 0) AS sesiones_asistidas_estudiante,
                    
                    COALESCE((
                        SELECT COUNT(DISTINCT asi.fecha_asistencia)
                        FROM asistencia asi
                        INNER JOIN programacion_academica pa ON asi.id_programacion = pa.id_programacion
                        WHERE pa.id_resultado_aprendizaje = ra.id_resultado
                          AND pa.numero_ficha = :numero_ficha
                          AND asi.id_usuario_aprendiz = :id_estudiante
                          AND asi.asistio = 1
                    ), 0) * 6 AS horas_ejecutadas_estudiante
                    
                FROM competencias c
                INNER JOIN resultado_aprendizaje ra ON c.id_competencia = ra.id_competencia
                LEFT JOIN ficha_resultado_config frc ON ra.id_resultado = frc.id_resultado AND frc.numero_ficha = :numero_ficha
                WHERE c.id_competencia = :id_competencia
                ORDER BY c.id_competencia, ra.id_resultado;
            ";
            
            $db->query($sql);
            $db->bind(':numero_ficha', $numero_ficha);
            $db->bind(':id_estudiante', $id_estudiante);
            $db->bind(':id_competencia', $id_competencia);
            
            $resultados = $db->resultSet();
            
            echo json_encode([
                'status' => 'success',
                'resultados' => $resultados
            ]);
            
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error en el servidor: ' . $e->getMessage()]);
        }
        exit;
    }
}

