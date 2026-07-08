<?php
$_SESSION['user_name'] = 'Hasler';
$_SESSION['user_id'] = 1;
$current_role = 'Instructor';
$usuario = (object)['nombre'=>'Hasler', 'apellido'=>'Palacio', 'documento'=>'123'];
$fichas = [];
$ambientes = [];
$programacion = [];
$asistencias = [];
$novedades = [];
$competencias = [];
$resultados = [];
$aprendices = [];
$programas_fichas = [];
$aprendicesPorProgramacion = [];

ob_start();
include 'Proyecto/app/Views/dashboard/index.php';
$html = ob_get_clean();

preg_match_all('/<script>(.*?)<\/script>/s', $html, $matches);
file_put_contents('test_script.js', implode("\n", $matches[1]));
