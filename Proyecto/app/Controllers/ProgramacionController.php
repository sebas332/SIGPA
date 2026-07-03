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

        $resultados = $this->resultadoModel->getByCompetencia($idCompetencia);

        echo json_encode([
            'success' => true,
            'resultados' => $resultados
        ]);
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
}
