<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
try {
    $db->beginTransaction();
    echo "First OK\n";
    $db->beginTransaction();
    echo "Second OK\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
