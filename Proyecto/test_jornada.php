<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$db = Database::getInstance();
$db->query("SELECT * FROM jornada");
$jornadas = $db->resultSet();
print_r($jornadas);
