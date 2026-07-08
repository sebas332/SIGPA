<?php
/**
 * Configuración del Sistema
 * Define constantes globales para la conexión a la base de datos y estructura de rutas.
 */

// Configuración de Zona Horaria (Colombia)
date_default_timezone_set('America/Bogota');

// Credenciales de la Base de Datos
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bd_proyecto_final');
define('DB_CHARSET', 'utf8mb4');

// Rutas de la Aplicación
define('APPROOT', dirname(__FILE__, 2) . '/app');

// Generación dinámica de URLROOT para compatibilidad absoluta en XAMPP (detecta puerto y host automáticamente)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$scriptDir = str_replace(['/public', '\\'], ['', '/'], $scriptDir);
$scriptDir = rtrim($scriptDir, '/');
define('URLROOT', $protocol . $host . $scriptDir);
// Recursos públicos (CSS, imágenes subidas y scripts propios).
define('ASSETROOT', URLROOT . '/public');

define('SITENAME', 'Sistema de Gestión Académica');

// Configuracion SMTP para Recuperacion de Contrasenas (PHPMailer)
// Puedes crear Proyecto/config/smtp.local.php con tus credenciales reales de Gmail.
$smtpLocalConfig = __DIR__ . '/smtp.local.php';
$smtpLocal = [];

if (is_file($smtpLocalConfig)) {
    $smtpLocal = require $smtpLocalConfig;
    $smtpLocal = is_array($smtpLocal) ? $smtpLocal : [];
}

$smtpValue = function ($key, $envName, $default) use ($smtpLocal) {
    if (isset($smtpLocal[$key]) && $smtpLocal[$key] !== '') {
        return $smtpLocal[$key];
    }

    $envValue = getenv($envName);
    return ($envValue !== false && $envValue !== '') ? $envValue : $default;
};

define('SMTP_HOST', $smtpValue('host', 'SIGPA_SMTP_HOST', 'smtp.gmail.com'));
define('SMTP_USER', $smtpValue('user', 'SIGPA_SMTP_USER', 'tu_correo@gmail.com'));
define('SMTP_PASS', $smtpValue('pass', 'SIGPA_SMTP_PASS', 'tu_contraseña_de_aplicación'));
define('SMTP_PORT', (int) $smtpValue('port', 'SIGPA_SMTP_PORT', 587));
define('SMTP_SECURE', $smtpValue('secure', 'SIGPA_SMTP_SECURE', 'tls')); // 'ssl' o 'tls'
define('SMTP_FROM_NAME', $smtpValue('from_name', 'SIGPA_SMTP_FROM_NAME', 'SGA - Sistema de Gestión Académica'));
