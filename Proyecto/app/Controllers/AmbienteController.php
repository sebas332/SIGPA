<?php
/**
 * Controlador AmbienteController
 * Gestiona el catálogo de ambientes, disponibilidad y reporte de novedades.
 */
class AmbienteController extends BaseController {
    private $ambienteModel;
    private $novedadModel;
    private $fotoModel;

    public function __construct() {
        $this->ambienteModel = $this->model('Ambiente');
        $this->novedadModel = $this->model('NovedadAmbiente');
        $this->fotoModel = $this->model('FotoAmbiente');
    }

    /**
     * Muestra el catálogo de ambientes y su estado
     */
    public function index() {
        $this->requireLogin();
        $ambientes = $this->ambienteModel->all();

        // Obtener fotos de cada ambiente para pasarlas a la vista
        $fotos = [];
        foreach ($ambientes as $a) {
            $fotos[$a->id_numero_ambiente] = $this->fotoModel->getByAmbiente($a->id_numero_ambiente);
        }

        $this->render('ambientes/index', [
            'titulo' => 'Catálogo y Disponibilidad de Ambientes',
            'ambientes' => $ambientes,
            'fotos' => $fotos,
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz'
        ]);
    }

    /**
     * Reportar o ver novedades de un ambiente
     */
    public function novedad() {
        $this->requireLogin();
        $id_numero_ambiente = $_GET['id'] ?? 0;

        $ambiente = $this->ambienteModel->find($id_numero_ambiente);
        if (!$ambiente) {
            $_SESSION['flash_error'] = 'El ambiente solicitado no existe.';
            $this->redirect('ambientes/index');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_numero_ambiente' => $id_numero_ambiente,
                'id_usuario' => $_SESSION['user_id'],
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'fecha_reporte' => date('Y-m-d')
            ];

            if (!empty($data['descripcion'])) {
                if ($this->novedadModel->create($data)) {
                    $_SESSION['flash_success'] = 'Novedad reportada exitosamente.';
                    $this->redirect('ambientes/novedad&id=' . $id_numero_ambiente);
                } else {
                    $error = 'Error al reportar la novedad.';
                }
            } else {
                $error = 'La descripción es obligatoria.';
            }
        }

        $novedades = $this->novedadModel->getByAmbiente($id_numero_ambiente);

        $this->render('ambientes/novedad', [
            'titulo' => 'Novedades y Reportes: ' . $ambiente->nombre,
            'ambiente' => $ambiente,
            'novedades' => $novedades,
            'error' => $error ?? '',
            'current_role' => $_SESSION['current_role'] ?? 'Aprendiz'
        ]);
    }

    /**
     * Crear un nuevo ambiente (Coordinador)
     */
    public function create() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'tipo' => $_POST['tipo'] ?? '',
                'capacidad' => $_POST['capacidad'] ?? 0,
                'aire' => isset($_POST['aire']) ? 1 : 0,
                'ventilador' => isset($_POST['ventilador']) ? 1 : 0,
                'tablero' => isset($_POST['tablero']) ? 1 : 0,
                'tv' => isset($_POST['tv']) ? 1 : 0,
                'computadores' => $_POST['computadores'] ?? 0,
                'especialidad_ambiente' => $_POST['especialidad_ambiente'] ?? '',
                'disponibilidad' => isset($_POST['disponibilidad']) ? 1 : 0
            ];

            if ($this->ambienteModel->create($data)) {
                $_SESSION['flash_success'] = 'Ambiente registrado exitosamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al registrar el ambiente.';
            }
        }
        $this->redirect('dashboard/index#pills-ambientes');
    }

    /**
     * Alternar la disponibilidad de un ambiente (Coordinador)
     */
    public function toggleDisponibilidad() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        $ambiente = $this->ambienteModel->find($id);

        if ($ambiente) {
            $nuevoEstado = $ambiente->disponibilidad == 1 ? 0 : 1;
            // Guardar con update
            $data = (array)$ambiente;
            $data['disponibilidad'] = $nuevoEstado;
            if ($this->ambienteModel->update($id, $data)) {
                $_SESSION['flash_success'] = 'Disponibilidad actualizada correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar disponibilidad.';
            }
        }
        $this->redirect('dashboard/index#pills-ambientes');
    }

    /**
     * Actualizar un ambiente existente (Coordinador)
     */
    public function update() {
        $this->requireRol('Coordinador');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_numero_ambiente'] ?? 0;
            $data = [
                'nombre' => $_POST['nombre'] ?? '',
                'tipo' => $_POST['tipo'] ?? '',
                'capacidad' => $_POST['capacidad'] ?? 0,
                'aire' => isset($_POST['aire']) ? 1 : 0,
                'ventilador' => isset($_POST['ventilador']) ? 1 : 0,
                'tablero' => isset($_POST['tablero']) ? 1 : 0,
                'tv' => isset($_POST['tv']) ? 1 : 0,
                'computadores' => $_POST['computadores'] ?? 0,
                'especialidad_ambiente' => $_POST['especialidad_ambiente'] ?? '',
                'disponibilidad' => isset($_POST['disponibilidad']) ? 1 : 0
            ];

            if ($this->ambienteModel->update($id, $data)) {
                $_SESSION['flash_success'] = 'Ambiente actualizado exitosamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar el ambiente.';
            }
        }
        $this->redirect('dashboard/index#pills-ambientes');
    }

    /**
     * Eliminar un ambiente (Coordinador)
     */
    public function delete() {
        $this->requireRol('Coordinador');
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            // Eliminar fotos/novedades en cascada manual si es necesario, o depender de la BD
            if ($this->ambienteModel->delete($id)) {
                $_SESSION['flash_success'] = 'Ambiente eliminado correctamente.';
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar el ambiente. Puede que tenga programaciones activas.';
            }
        }
        $this->redirect('dashboard/index#pills-ambientes');
    }
}
