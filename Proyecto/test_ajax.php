<?php
session_start();
$_GET['route'] = 'programas/editarCompleto';
$_GET['id'] = 1;
$_GET['ajax'] = 1;
$_SESSION['user_id'] = 1;
$_SESSION['user_roles'] = ['Coordinador'];
require 'public/index.php';
