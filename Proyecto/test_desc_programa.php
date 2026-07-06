<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();

$db->query('SHOW CREATE TABLE competencias');
print_r($db->resultSet());

$db->query('SHOW CREATE TABLE resultado_aprendizaje');
print_r($db->resultSet());
