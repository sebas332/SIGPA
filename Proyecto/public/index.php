<?php
/**
 * FRONT CONTROLLER (index.php)
 * Punto único de entrada de la aplicación MVC.
 */

// Iniciar sesión
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cargar configuración global y base de datos
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/Controllers/BaseController.php';
require_once __DIR__ . '/../app/Libraries/AuditLogger.php';

// Obtener parámetro de ruta (por defecto auth/login si no está logueado, o dashboard/index si ya inició sesión)
$defaultRoute = isset($_SESSION['user_id']) ? 'dashboard/index' : 'auth/login';
$route = $_GET['route'] ?? $defaultRoute;

$parts = explode('/', $route);
$controllerSlug = $parts[0] ?? 'Auth';
$methodName = $parts[1] ?? 'index';

// Convertir kebab-case a camelCase para el nombre del método (ej. 'reset-password' -> 'resetPassword')
$methodName = str_replace(' ', '', lcfirst(ucwords(str_replace('-', ' ', $methodName))));

$controllerName = ucfirst($controllerSlug) . 'Controller';
$controllerFile = __DIR__ . '/../app/Controllers/' . $controllerName . '.php';

// Fallback Inteligente (De-pluralización): 
// Si la ruta viene en plural (ej. 'fichas') pero el controlador está en singular ('FichaController')
if (!file_exists($controllerFile) && substr($controllerSlug, -1) === 's') {
    $singularSlug = substr($controllerSlug, 0, -1);
    $controllerNameAlt = ucfirst($singularSlug) . 'Controller';
    $controllerFileAlt = __DIR__ . '/../app/Controllers/' . $controllerNameAlt . '.php';
    if (file_exists($controllerFileAlt)) {
        $controllerName = $controllerNameAlt;
        $controllerFile = $controllerFileAlt;
    }
}

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $methodName)) {
            // Invocar el método del controlador
            $controller->$methodName();
        } else {
            die("Error: El método '{$methodName}' no existe en el controlador '{$controllerName}'.");
        }
    } else {
        die("Error: La clase '{$controllerName}' no fue encontrada.");
    }
} else {
    die("Error: El controlador '{$controllerName}' no existe en la ruta '{$controllerFile}'.");
}
