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

    public function __construct() {
        $this->fichaModel = $this->model('Ficha');
        $this->fichaAprendizModel = $this->model('FichaAprendiz');
        $this->programacionModel = $this->model('ProgramacionAcademica');
        $this->programaModel = $this->model('Programa');
        $this->jornadaModel = $this->model('Jornada');
        $this->usuarioModel = $this->model('Usuario');
        $this->competenciaModel = $this->model('Competencia');
        $this->resultadoModel = $this->model('ResultadoAprendizaje');
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

        // Métricas resumidas
        $total_sesiones_programadas = 0;
        $sesiones_realizadas = 0;
        foreach ($programacion as $prog) {
            $total_sesiones_programadas += (int) ($prog->total_sesiones ?? 0);
            $sesiones_realizadas += (int) ($prog->sesiones_realizadas ?? 0);
        }
        $sesiones_pendientes = max(0, $total_sesiones_programadas - $sesiones_realizadas);
        $porcentaje_avance = $total_sesiones_programadas > 0 ? round(($sesiones_realizadas / $total_sesiones_programadas) * 100) : 0;

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
    public function inscribirAprendiz() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero_ficha = $_POST['numero_ficha'] ?? 0;
            $id_usuario_aprendiz = $_POST['id_usuario_aprendiz'] ?? 0;

            // Validar existencia de la ficha
            $ficha = $this->fichaModel->find($numero_ficha);
            if (!$ficha) {
                $_SESSION['flash_error'] = 'La ficha no existe.';
                $this->redirect('dashboard/index#pills-fichas');
            }

            // Validar cupo
            $aprendices = $this->fichaAprendizModel->getAprendicesPorFicha($numero_ficha);
            if (count($aprendices) >= $ficha->cantidad_estudiantes) {
                $_SESSION['flash_error'] = 'No se pueden matricular más aprendices. Se ha alcanzado el límite de cupos autorizados (' . $ficha->cantidad_estudiantes . ').';
                $this->redirect('fichas/show&id=' . $numero_ficha);
            }

            if ($this->fichaAprendizModel->create($id_usuario_aprendiz, $numero_ficha)) {
                // Auditoría de Matrícula de Aprendiz
                AuditLogger::log('Matrícula de Aprendiz', 'ficha_aprendiz', $numero_ficha, 'Aprendiz ID: ' . $id_usuario_aprendiz);
                $_SESSION['flash_success'] = 'Aprendiz matriculado exitosamente en la ficha.';
            } else {
                $_SESSION['flash_error'] = 'El aprendiz ya se encuentra matriculado en una ficha activa.';
            }
            $this->redirect('fichas/show&id=' . $numero_ficha);
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
}

