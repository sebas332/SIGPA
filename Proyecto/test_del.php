<?php
require __DIR__ . '/config/config.php';
require __DIR__ . '/config/Database.php';
$db = Database::getInstance();
$db->query("SELECT * FROM competencias");
$res = $db->resultSet();
foreach($res as $r) {
    echo $r->codigo . " - " . $r->nombre . "\n";
}
