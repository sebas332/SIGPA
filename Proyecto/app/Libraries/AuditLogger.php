<?php
/**
 * Clase Helper AuditLogger
 * Registra acciones de usuario en tiempo real en un archivo JSON local.
 */
class AuditLogger {
    
    public static function log($accion, $tabla, $registro_id, $detalles = '') {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $logFile = APPROOT . '/logs/audit.json';
        $logDir = dirname($logFile);
        
        // Crear directorio si no existe
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $entry = [
            'id' => uniqid('audit_', true),
            'timestamp' => date('Y-m-d H:i:s'),
            'usuario_id' => $_SESSION['user_id'] ?? 0,
            'usuario_nombre' => $_SESSION['user_name'] ?? 'Sistema / Cron',
            'usuario_login' => $_SESSION['user_user'] ?? 'system',
            'rol' => $_SESSION['current_role'] ?? 'Sistema',
            'ip' => self::getIPAddress(),
            'accion' => strtoupper($accion),
            'tabla' => $tabla,
            'registro_id' => $registro_id,
            'detalles' => $detalles
        ];

        // Leer archivo existente
        $logs = [];
        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            $logs = json_decode($content, true);
            if (!is_array($logs)) {
                $logs = [];
            }
        }

        // Agregar al inicio del arreglo para ver las más recientes primero
        array_unshift($logs, $entry);

        // Limitar a los últimos 500 registros para evitar que crezca indefinidamente
        if (count($logs) > 500) {
            $logs = array_slice($logs, 0, 500);
        }

        file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    private static function getIPAddress() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        }
    }
}
