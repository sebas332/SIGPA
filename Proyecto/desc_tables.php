<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
foreach(['fichas', 'ambientes', 'programa', 'usuarios'] as $table) {
    echo "Table: $table\n";
    $db->query("DESCRIBE $table");
    print_r($db->resultSet());
    echo "\n";
}
