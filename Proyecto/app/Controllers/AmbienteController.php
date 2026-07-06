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
                    $db_inst = Database::getInstance();
                    $new_nov_id = $db_inst->lastInsertId();
                    
                    $_SESSION['flash_success'] = 'Novedad reportada exitosamente.';
                    
                    // Auditoría de Novedad
                    AuditLogger::log('Reporte de Novedad', 'novedad_ambiente', $new_nov_id, 'Ambiente ID: ' . $id_numero_ambiente . ', Detalle: ' . $data['descripcion']);
                    
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
     * Procesar subida de múltiples fotos
     */
    private function procesarFotos($id_numero_ambiente) {
        if (!empty($_FILES['fotos']['name'][0])) {
            $uploadDir = dirname(__DIR__, 2) . '/public/uploads/ambientes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            foreach ($_FILES['fotos']['name'] as $key => $name) {
                if ($_FILES['fotos']['error'][$key] === 0) {
                    $tmpName = $_FILES['fotos']['tmp_name'][$key];
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $newName = 'amb_' . $id_numero_ambiente . '_' . uniqid() . '.' . $ext;
                    $dest = $uploadDir . $newName;
                    if (move_uploaded_file($tmpName, $dest)) {
                        $url = ASSETROOT . '/uploads/ambientes/' . $newName;
                        $this->fotoModel->create([
                            'id_numero_ambiente' => $id_numero_ambiente,
                            'url' => $url,
                            'fecha_recarga' => date('Y-m-d')
                        ]);
                    }
                }
            }
        }
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
                $db = Database::getInstance();
                $lastId = $db->lastInsertId();
                $this->procesarFotos($lastId);
                $_SESSION['flash_success'] = 'Ambiente registrado exitosamente.';
                
                // Auditoría de Creación de Ambiente
                AuditLogger::log('Creación de Ambiente', 'ambientes', $lastId, 'Nombre: ' . $data['nombre'] . ', Tipo: ' . $data['tipo']);
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
                
                // Auditoría de Cambio de Disponibilidad
                AuditLogger::log('Disponibilidad de Ambiente', 'ambientes', $id, 'Cambió disponibilidad a: ' . ($nuevoEstado ? 'Disponible' : 'No Disponible'));
            } else {
                $_SESSION['flash_error'] = 'Error al actualizar disponibilidad.';
            }
        }
        $this->redirect('dashboard/index#pills-ambientes');
    }

    public function liberar() {
        $this->requireRol('Coordinador');
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_programacion = $_POST['id_programacion'] ?? 0;
            $fecha = $_POST['fecha'] ?? '';
            
            if ($id_programacion && $fecha) {
                $db = Database::getInstance();
                $db->query("SELECT id_numero_ambiente FROM programacion_academica WHERE id_programacion = :id");
                $db->bind(':id', $id_programacion);
                $prog = $db->single();
                
                if ($prog) {
                    $descripcion = "ESPACIO_LIBERADO|ID_PROG:" . $id_programacion;
                    
                    $db->query("SELECT id_novedad FROM novedad_ambiente WHERE descripcion = :desc AND fecha_reporte = :fecha LIMIT 1");
                    $db->bind(':desc', $descripcion);
                    $db->bind(':fecha', $fecha);
                    if ($db->single()) {
                        echo json_encode(['status' => 'success']);
                        exit;
                    }

                    $db->query("INSERT INTO novedad_ambiente (id_numero_ambiente, id_usuario, descripcion, fecha_reporte) 
                                VALUES (:id_ambiente, :id_usuario, :descripcion, :fecha)");
                    $db->bind(':id_ambiente', $prog->id_numero_ambiente);
                    $db->bind(':id_usuario', $_SESSION['user_id'] ?? 1);
                    $db->bind(':descripcion', $descripcion);
                    $db->bind(':fecha', $fecha);
                    
                    if ($db->execute()) {
                        echo json_encode(['status' => 'success']);
                        exit;
                    }
                }
            }
        }
        
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos o error en el servidor.']);
        exit;
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
                if (!empty($_FILES['fotos']['name'][0])) {
                    $fotosAntiguas = $this->fotoModel->getByAmbiente($id);
                    foreach ($fotosAntiguas as $foto) {
                        $basename = basename($foto->url);
                        if (strpos($foto->url, 'uploads/ambientes') !== false) {
                            $filePath = dirname(__DIR__, 2) . '/public/uploads/ambientes/' . $basename;
                            if (file_exists($filePath)) {
                                unlink($filePath);
                            }
                        }
                        $this->fotoModel->delete($foto->id_foto_ambiente);
                    }
                }
                $this->procesarFotos($id);
                $_SESSION['flash_success'] = 'Ambiente actualizado exitosamente.';
                
                // Auditoría de Actualización de Ambiente
                AuditLogger::log('Actualización de Ambiente', 'ambientes', $id, 'Nombre: ' . $data['nombre'] . ', Tipo: ' . $data['tipo']);
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
            // Eliminar fotos del sistema de archivos antes de borrar (en caso de que la BD haga cascade, los archivos quedarían huérfanos)
            $fotos = $this->fotoModel->getByAmbiente($id);
            foreach ($fotos as $foto) {
                $basename = basename($foto->url);
                // Evitamos borrar las fotos por defecto de Unsplash eliminando sólo las locales
                if (strpos($foto->url, 'uploads/ambientes') !== false) {
                    $filePath = dirname(__DIR__, 2) . '/public/uploads/ambientes/' . $basename;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            // Eliminar fotos/novedades en cascada manual si es necesario, o depender de la BD
            if ($this->ambienteModel->delete($id)) {
                $_SESSION['flash_success'] = 'Ambiente eliminado correctamente.';
                
                // Auditoría de Eliminación de Ambiente
                AuditLogger::log('Eliminación de Ambiente', 'ambientes', $id, 'Eliminó ambiente ID: ' . $id);
            } else {
                $_SESSION['flash_error'] = 'Error al eliminar el ambiente. Puede que tenga programaciones activas.';
            }
        }
        $this->redirect('dashboard/index#pills-ambientes');
    }

    /**
     * Obtener programación académica para un ambiente específico (AJAX)
     */
    public function get_programacion() {
        header('Content-Type: application/json');
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'No autorizado.']);
            exit;
        }

        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $programacionModel = $this->model('ProgramacionAcademica');
            $data = $programacionModel->getByAmbiente($id);
            echo json_encode([
                'success' => true,
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'ID de ambiente no válido.'
            ]);
        }
        exit;
    }
}
