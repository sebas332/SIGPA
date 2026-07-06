<?php
require_once 'config/config.php';
require_once 'config/Database.php';

$db = Database::getInstance();

try {
    $db->query("ALTER TABLE programacion_academica ADD PRIMARY KEY (id_programacion)");
    $db->execute();
    echo "PK added\n";
} catch (Exception $e) {
    echo "PK Error: " . $e->getMessage() . "\n";
}

try {
    $db->query("ALTER TABLE programacion_academica MODIFY id_programacion INT(11) NOT NULL AUTO_INCREMENT");
    $db->execute();
    echo "AI added\n";
} catch (Exception $e) {
    echo "AI Error: " . $e->getMessage() . "\n";
}
