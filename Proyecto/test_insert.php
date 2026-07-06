<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$db = Database::getInstance();
try {
    $db->query("INSERT INTO programacion_academica (numero_ficha, id_usuario, id_numero_ambiente, id_dias, hora_inicio, hora_fin, id_resultado_aprendizaje, fecha_inicio) 
                          VALUES (2670000, 1, 1, 1, '08:00', '10:00', 1, '2026-07-06')");
    $db->execute();
    echo "Success: " . $db->lastInsertId();
} catch (Exception $e) {
    echo "Exception: " . $e->getMessage();
}
