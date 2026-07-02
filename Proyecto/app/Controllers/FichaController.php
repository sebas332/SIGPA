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
        
        // Filtrar instructores para asignar como líderes
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

        $this->render('fichas/index', [
            'titulo' => 'Listado de Fichas',
            'fichas' => $fichas,
            'programas' => $programas,
            'jornadas' => $jornadas,
            'instructores' => $instructores,
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

        // Obtener todos los aprendices del sistema para poder matricularlos (Coordinador)
        $todosUsuarios = $this->usuarioModel->all();
        $candidatos = [];
        foreach ($todosUsuarios as $u) {
            $roles = $this->usuarioModel->getRoles($u->id_usuario);
            foreach ($roles as $r) {
                if ($r->nombre_rol === 'Aprendiz') {
                    $candidatos[] = $u;
                    break;
                }
            }
        }

        $this->render('fichas/show', [
            'titulo' => 'Detalle de Ficha: ' . $ficha->numero_ficha,
            'ficha' => $ficha,
            'aprendices' => $aprendices,
            'programacion' => $programacion,
            'candidatos' => $candidatos,
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
                $_SESSION['flash_success'] = 'Ficha creada exitosamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al crear la ficha.';
            }
        }
        $this->redirect('fichas/index');
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
                $_SESSION['flash_success'] = 'Ficha actualizada exitosamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar la ficha.';
            }
        }
        $this->redirect('dashboard/index#pills-fichas');
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
}
