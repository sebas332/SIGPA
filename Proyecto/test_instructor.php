<?php
session_start();
$_SESSION['user_id'] = 2; // Darwin Cordero
$_SESSION['current_role'] = 'Instructor';
$_SESSION['user_name'] = 'Darwin Cordero';
$_SESSION['user_roles'] = ['Instructor'];

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/app/Controllers/BaseController.php';

// Mock routing
$_GET['route'] = 'dashboard/index';

ob_start();
$controllerName = 'DashboardController';
require_once __DIR__ . '/app/Controllers/' . $controllerName . '.php';
$controller = new $controllerName();
$controller->index();
$output = ob_get_clean();

if (strpos($output, 'Panel del Instructor Líder') !== false) {
    echo "INSTRUCTOR DASHBOARD RENDERS CORRECTLY.\n";
} else {
    echo "ERROR: Instructor dashboard not found in output.\n";
    if (empty(trim($output))) {
         $error = error_get_last();
         echo "Fatal Error: " . print_r($error, true);
    }
}
