<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$db->query('SHOW CREATE TABLE tipo_programa');
print_r($db->resultSet());
