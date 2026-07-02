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
        $this->requireLogin();
        $current_role = $_SESSION['current_role'] ?? 'Aprendiz';
        $user_id = $_SESSION['user_id'];

        if ($current_role === 'Coordinador') {
            $programacion = $this->programacionModel->all();
        } elseif ($current_role === 'Instructor') {
            $programacion = $this->programacionModel->getByInstructor($user_id);
        } else {
            $programacion = $this->programacionModel->getByAprendiz($user_id);
        }

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
            'titulo' => 'Programación Académica y Horarios',
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

            try {
                if ($this->programacionModel->create($data)) {
                    $_SESSION['flash_success'] = 'Programación académica registrada exitosamente.';
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
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar la programación.';
            }
        } catch (Exception $e) {
            $_SESSION['flash_error'] = 'No se puede eliminar la programación porque tiene registros de asistencia asociados.';
        }
        $this->redirect('programacion/index');
    }
}
