<?php
require_once 'config/config.php';
require_once 'config/Database.php';
$db = Database::getInstance();
try {
    $db->query("SHOW CREATE TABLE programacion_academica");
    $res = $db->single();
    file_put_contents('output_data2.txt', print_r($res, true));
} catch (Exception $e) {}
