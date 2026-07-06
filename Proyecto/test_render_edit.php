<?php
// Iniciar sesión simulada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['user_id'] = 5;
$_SESSION['current_role'] = 'Coordinador';
$_SESSION['user_roles'] = ['Coordinador'];

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/app/Controllers/BaseController.php';
require_once __DIR__ . '/app/Controllers/ProgramaController.php';
require_once __DIR__ . '/app/Models/Programa.php';
require_once __DIR__ . '/app/Models/TipoPrograma.php';
require_once __DIR__ . '/app/Models/Competencia.php';
require_once __DIR__ . '/app/Models/ResultadoAprendizaje.php';
require_once __DIR__ . '/app/Libraries/AuditLogger.php';

// Obtener todos los programas
$db = Database::getInstance();
$db->query("SELECT id_programa, nombre FROM programa");
$programas = $db->resultSet();

echo "Encontrados " . count($programas) . " programas:\n";
foreach ($programas as $p) {
    echo "- ID: {$p->id_programa}, Nombre: {$p->nombre}\n";
}

// Probar renderizar para cada programa
foreach ($programas as $p) {
    echo "\n-------------------------------------\n";
    echo "Probando renderizar para ID {$p->id_programa}...\n";
    
    $_GET['id'] = $p->id_programa;
    $_GET['ajax'] = 1;

    try {
        ob_start();
        $controller = new ProgramaController();
        $controller->editarCompleto();
        $html = ob_get_clean();
        echo "Renderizado exitoso! Longitud HTML: " . strlen($html) . "\n";
        // Busquemos si hay algún error o json_encode roto
        if (strpos($html, 'null') !== false) {
            echo "Advertencia: Contiene 'null'\n";
        }
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
    }
}
