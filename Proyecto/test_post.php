<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['user_roles'] = ['Coordinador'];
$_GET['route'] = 'programas/updateCompleto';
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST['is_modal'] = 1;
$_POST['id_programa'] = 1;
$_POST['nombre'] = 'Test';
$_POST['competencias'] = [['id_competencia' => 1, 'nombre' => 'Test Comp', 'resultados' => [['id_resultado' => 0, 'codigo' => 'RA-NEW', 'descripcion' => 'Desc', 'sesiones_asignadas' => 10]]]];
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'public/index.php';
