<?php
/**
 * Controlador AsistenciaController
 * Gestiona el proceso de selección de programación, toma de asistencia y generación de reportes.
 */
class AsistenciaController extends BaseController {
    private $programacionModel;
    private $asistenciaModel;
    private $fichaAprendizModel;

    public function __construct() {
        $this->programacionModel = $this->model('ProgramacionAcademica');
        $this->asistenciaModel = $this->model('Asistencia');
        $this->fichaAprendizModel = $this->model('FichaAprendiz');
    }

    /**
     * Paso 1: El instructor selecciona la programación y la fecha para tomar asistencia
     */
    public function seleccionar() {
        $this->requireRol('Instructor');
        $user_id = $_SESSION['user_id'];

        // Obtener la programación asignada a este instructor
        $programacion = $this->programacionModel->getByInstructor($user_id);

        $this->render('asistencias/seleccionar', [
            'titulo' => 'Seleccionar Sesión para Asistencia',
            'programacion' => $programacion,
            'current_role' => $_SESSION['current_role'] ?? 'Instructor'
        ]);
    }

    /**
     * Paso 2: Interfaz para tomar/guardar la asistencia de los aprendices de una ficha
     */
    public function tomar() {
        $this->requireRol('Instructor');
        $id_programacion = $_GET['programacion'] ?? 0;
        $fecha = $_GET['fecha'] ?? date('Y-m-d');

        $programacion = $this->programacionModel->find($id_programacion);
        if (!$programacion || $programacion->id_usuario != $_SESSION['user_id']) {
            $_SESSION['flash_error'] = 'No tienes permiso para tomar asistencia en esta programación.';
            $this->redirect('asistencias/seleccionar');
        }

        // Obtener los aprendices de la ficha asociada
        $aprendices = $this->fichaAprendizModel->getAprendicesPorFicha($programacion->numero_ficha);

        // Si se envió el formulario POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $asistencias = $_POST['asistencia'] ?? [];
            $observaciones = $_POST['observacion'] ?? [];

            $exito = true;
            $errores = [];

            foreach ($aprendices as $aprendiz) {
                $id_aprendiz = $aprendiz->id_usuario_aprendiz;
                $asistio = isset($asistencias[$id_aprendiz]) ? 1 : 0;
                $obs = trim($observaciones[$id_aprendiz] ?? '');

                try {
                    $this->asistenciaModel->guardar($id_programacion, $id_aprendiz, $fecha, $asistio, $obs);
                } catch (Exception $e) {
                    $exito = false;
                    $errores[] = $e->getMessage();
                }
            }

            if ($exito) {
                $_SESSION['flash_success'] = 'Asistencia registrada exitosamente para la fecha ' . $fecha . '.';
                
                // Auditoría de Asistencia
                AuditLogger::log('Registro de Asistencia', 'asistencia', $id_programacion, 'Guardó planilla de asistencia para la fecha: ' . $fecha . ', Programación ID: ' . $id_programacion);
                
                $this->redirect('asistencias/seleccionar');
            } else {
                $error = 'Ocurrieron errores al registrar: ' . implode(', ', array_unique($errores));
            }
        }

        // Obtener asistencias previas si ya se habían tomado en esta fecha
        $asistenciaPreviaObj = $this->asistenciaModel->getPorProgramacionYFecha($id_programacion, $fecha);
        $asistenciaPrevia = [];
        foreach ($asistenciaPreviaObj as $ap) {
            $asistenciaPrevia[$ap->id_usuario_aprendiz] = $ap;
        }

        $this->render('asistencias/tomar', [
            'titulo' => 'Tomar Asistencia: Ficha ' . $programacion->numero_ficha . ' (' . $fecha . ')',
            'programacion' => $programacion,
            'aprendices' => $aprendices,
            'fecha' => $fecha,
            'asistenciaPrevia' => $asistenciaPrevia,
            'error' => $error ?? '',
            'current_role' => $_SESSION['current_role'] ?? 'Instructor'
        ]);
    }

    /**
     * Guarda la planilla de asistencia (AJAX o normal)
     */
    public function guardarPlanilla() {
        $this->requireRol('Instructor');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_programacion = $_POST['id_programacion'] ?? 0;
            $fecha = $_POST['fecha_asistencia'] ?? date('Y-m-d');
            $asistencias = $_POST['asistencia'] ?? [];

            if (empty($id_programacion) || empty($asistencias)) {
                $_SESSION['flash_error'] = 'Debe seleccionar una sesión y asegurar que la ficha tenga aprendices.';
                $this->redirect('dashboard/index#pills-inst-asistencia');
                return;
            }

            $exito = true;
            $errores_db = [];
            foreach ($asistencias as $id_aprendiz => $dataAsistencia) {
                $asistio = $dataAsistencia['estado'] ?? 0;
                $obs = trim($dataAsistencia['observacion'] ?? '');
                
                try {
                    $this->asistenciaModel->guardar($id_programacion, $id_aprendiz, $fecha, $asistio, $obs);
                } catch (Exception $e) {
                    $exito = false;
                    $errores_db[] = $e->getMessage();
                }
            }

            if ($exito) {
                $_SESSION['flash_success'] = '¡Planilla Digital de Asistencia guardada y notificada con éxito!';
                AuditLogger::log('Registro de Asistencia', 'asistencia', $id_programacion, 'Guardó planilla de asistencia para la fecha: ' . $fecha);
            } else {
                $error_str = implode(" | ", array_unique($errores_db));
                $_SESSION['flash_error'] = 'Ocurrieron errores al registrar: ' . $error_str;
            }
        }
        $this->redirect('dashboard/index#pills-inst-asistencia');
    }

    /**
     * Ver reportes e historial de asistencia
     */
    public function reporte() {
        $this->requireLogin();
        $current_role = $_SESSION['current_role'] ?? 'Aprendiz';
        $user_id = $_SESSION['user_id'];

        if ($current_role === 'Coordinador') {
            $asistencias = $this->asistenciaModel->all();
        } elseif ($current_role === 'Aprendiz') {
            $asistencias = $this->asistenciaModel->getPorAprendiz($user_id);
        } else {
            // Instructor
            $_SESSION['flash_error'] = 'Usa la opción de seleccionar sesión para gestionar asistencia.';
            $this->redirect('asistencias/seleccionar');
        }

        $this->render('asistencias/reporte', [
            'titulo' => 'Historial y Reporte de Asistencia',
            'asistencias' => $asistencias,
            'current_role' => $current_role
        ]);
    }
}
