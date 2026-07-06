<?php
/**
 * Controlador AuditoriaController
 * Gestiona la lectura y visualización de logs de auditoría en tiempo real.
 */
class AuditoriaController extends BaseController {

    public function __construct() {
        $this->requireLogin();
    }

    /**
     * Vista principal del registro de auditoría
     */
    public function index() {
        $this->requireRol('Coordinador');

        $logFile = APPROOT . '/logs/audit.json';
        $logs = [];

        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            $logs = json_decode($content, true);
            if (!is_array($logs)) {
                $logs = [];
            }
        }

        $this->render('auditoria/index', [
            'titulo' => 'Auditoría del Sistema',
            'logs' => $logs,
            'current_role' => $_SESSION['current_role'] ?? 'Coordinador'
        ]);
    }
}
