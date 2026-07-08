<?php require 'config/config.php'; require 'config/Database.php'; $db = Database::getInstance(); $db->query('DESCRIBE ambientes'); print_r($db->resultSet()); ?>
