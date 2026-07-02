<?php
/**
 * Configuración del Sistema
 * Define constantes globales para la conexión a la base de datos y estructura de rutas.
 */

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
