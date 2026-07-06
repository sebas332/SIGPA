<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$db->query('SHOW CREATE TABLE programacion_academica');
print_r($db->resultSet());
