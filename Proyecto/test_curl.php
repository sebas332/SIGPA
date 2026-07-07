<?php require 'config/config.php'; require 'config/Database.php'; $db = Database::getInstance(); $db->query('SELECT * FROM novedad_ambiente'); print_r($db->resultSet()); ?>
