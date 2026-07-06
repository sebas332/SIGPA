<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$db = Database::getInstance();

try {
    $db->query("SHOW CREATE TABLE programacion_academica");
    $res = $db->single();
    $out = print_r($res, true);

    $db->query("SHOW TRIGGERS LIKE 'programacion_academica'");
    $triggers = $db->resultSet();
    $out .= print_r($triggers, true);
    
    file_put_contents('output.txt', $out);
} catch (Exception $e) {
    file_put_contents('output.txt', $e->getMessage());
}
