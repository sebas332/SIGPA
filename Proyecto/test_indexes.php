<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$db = Database::getInstance();

try {
    $db->query("SHOW INDEXES FROM programacion_academica");
    $res = $db->resultSet();
    $out = print_r($res, true);
    
    file_put_contents('output.txt', $out);
} catch (Exception $e) {
    file_put_contents('output.txt', $e->getMessage());
}
