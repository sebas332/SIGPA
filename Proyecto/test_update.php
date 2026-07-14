<?php
require __DIR__ . '/app/config/config.php';
require __DIR__ . '/app/Libraries/Database.php';
require __DIR__ . '/app/Libraries/Controller.php';
require __DIR__ . '/app/Controllers/BaseController.php';
require __DIR__ . '/app/Controllers/UsuarioController.php';
session_start();
$_SESSION['current_role'] = 'Coordinador';
$controller = new UsuarioController();
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST['id_usuario'] = 5; // Replace with an Aprendiz ID
$_POST['nombre'] = 'Test';
$_POST['apellido'] = 'User';
$_POST['documento'] = '12345678';
$_POST['telefono'] = '1234567890';
$_POST['correo'] = 'test@test.com';
$_POST['titulacion'] = 'Test';
$_POST['id_rol'] = 1; // Coordinador
$controller->update();
print_r($_SESSION);
