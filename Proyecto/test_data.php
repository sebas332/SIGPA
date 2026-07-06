<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$db = Database::getInstance();

try {
    $db->query("SELECT id_programacion, id_usuario, id_dias, fecha_inicio FROM programacion_academica LIMIT 10");
    $res = $db->resultSet();
    $out = print_r($res, true);
    
    file_put_contents('output_data.txt', $out);
} catch (Exception $e) {
    file_put_contents('output_data.txt', $e->getMessage());
}
