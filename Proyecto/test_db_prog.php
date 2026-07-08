<?php require 'config/config.php'; require 'config/Database.php'; $db = Database::getInstance(); $db->query('DESCRIBE programacion_academica'); print_r($db->resultSet()); ?>
