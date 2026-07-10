<?php
require 'c:/xampp/htdocs/SIGPA/Proyecto/config/config.php';
require 'c:/xampp/htdocs/SIGPA/Proyecto/config/Database.php';
$db = Database::getInstance();
$db->query('SHOW KEYS FROM asistencia');
print_r($db->resultSet());
