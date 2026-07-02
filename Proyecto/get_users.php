<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$db->query('SELECT * FROM usuarios');
print_r($db->resultSet());
