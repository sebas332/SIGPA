<?php
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

$_GET['id'] = 1;
$_GET['ajax'] = 1;

ob_start();
$controller = new ProgramaController();
$controller->editarCompleto();
$html = ob_get_clean();

file_put_contents('edit_html_out.txt', $html);
echo "HTML written to edit_html_out.txt\n";
