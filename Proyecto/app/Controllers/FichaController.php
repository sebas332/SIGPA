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

    public function __construct() {
        $this->fichaModel = $this->model('Ficha');
        $this->fichaAprendizModel = $this->model('FichaAprendiz');
        $this->programacionModel = $this->model('ProgramacionAcademica');
        $this->programaModel = $this->model('Programa');
        $this->jornadaModel = $this->model('Jornada');
        $this->usuarioModel = $this->model('Usuario');
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

        $this->render('fichas/index', [
            'titulo' => 'Listado de Fichas',
            'fichas' => $fichas,
            'programas' => $programas,
            'jornadas' => $jornadas,
            'instructores' => $instructores,
            'candidatos' => $candidatos,
            'current_role' => $current_role
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
            $this->redirect('fichas/index');
        }

        $aprendices = $this->fichaAprendizModel->getAprendicesPorFicha($numero_ficha);
        $programacion = $this->programacionModel->getByFicha($numero_ficha);

        // Obtener todos los aprendices y datos para los modales (Coordinador)
        $programas = $this->programaModel->all();
        $jornadas = $this->jornadaModel->all();
        
        $todosUsuarios = $this->usuarioModel->all();
        $candidatos = [];
        $instructores = [];
        foreach ($todosUsuarios as $u) {
            $roles = $this->usuarioModel->getRoles($u->id_usuario);
            foreach ($roles as $r) {
                if ($r->nombre_rol === 'Aprendiz') {
                    $candidatos[] = $u;
                }
                if ($r->nombre_rol === 'Instructor') {
                    $instructores[] = $u;
                }
            }
        }

        $this->render('fichas/show', [
            'titulo' => 'Detalle de Ficha: ' . $ficha->numero_ficha,
            'ficha' => $ficha,
            'aprendices' => $aprendices,
            'programacion' => $programacion,
            'candidatos' => $candidatos,
            'programas' => $programas,
            'jornadas' => $jornadas,
            'instructores' => $instructores,
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz'
        ]);
    }

    /**
     * Crear una ficha nueva (Coordinador)
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'numero_ficha' => $_POST['numero_ficha'] ?? 0,
                'cantidad_estudiantes' => $_POST['cantidad_estudiantes'] ?? 0,
                'fecha_inicio' => $_POST['fecha_inicio'] ?? '',
                'fecha_practicas' => $_POST['fecha_practicas'] ?? '',
                'fecha_fin' => $_POST['fecha_fin'] ?? '',
                'id_usuario_instructor_lider' => $_POST['id_usuario_instructor_lider'] ?? 0,
                'id_programa' => $_POST['id_programa'] ?? 0,
                'id_jornada' => $_POST['id_jornada'] ?? 0
            ];

            if ($this->fichaModel->create($data)) {
                $nuevaFicha = $this->fichaModel->find($data['numero_ficha']);
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'data' => $nuevaFicha]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Error al crear la ficha en la base de datos.']);
                exit;
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

            if ($this->fichaAprendizModel->create($id_usuario_aprendiz, $numero_ficha)) {
                $_SESSION['flash_success'] = 'Aprendiz matriculado exitosamente en la ficha.';
            } else {
                $_SESSION['flash_error'] = 'El aprendiz ya se encuentra matriculado en esta ficha.';
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
            $_SESSION['flash_success'] = 'Aprendiz removido de la ficha exitosamente.';
        } else {
            $_SESSION['flash_error'] = 'Error al remover al aprendiz.';
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
            $data = [
                'numero_ficha' => $_POST['numero_ficha'] ?? 0,
                'cantidad_estudiantes' => $_POST['cantidad_estudiantes'] ?? 0,
                'fecha_inicio' => $_POST['fecha_inicio'] ?? '',
                'fecha_practicas' => $_POST['fecha_practicas'] ?? '',
                'fecha_fin' => $_POST['fecha_fin'] ?? '',
                'id_usuario_instructor_lider' => $_POST['id_usuario_instructor_lider'] ?? 0,
                'id_programa' => $_POST['id_programa'] ?? 0,
                'id_jornada' => $_POST['id_jornada'] ?? 0
            ];

            if ($this->fichaModel->update($numero_ficha_antiguo, $data)) {
                $fichaActualizada = $this->fichaModel->find($data['numero_ficha']);
                header('Content-Type: application/json');
                echo json_encode(['status' => 'success', 'data' => $fichaActualizada]);
                exit;
            } else {
                header('Content-Type: application/json');
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la base de datos.']);
                exit;
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
            if ($this->fichaModel->delete($id)) {
                $_SESSION['flash_success'] = 'Ficha eliminada correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar la ficha. Asegúrese de que no tenga aprendices matriculados o sesiones programadas.';
            }
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
                $_SESSION['flash_error'] = 'El aprendiz ya se encuentra matriculado en esta ficha.';
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
                        throw new Exception("El aprendiz con documento $documento ya se encuentra inscrito o hubo un error (Fila $fila).");
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

