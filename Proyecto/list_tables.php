<?php require 'config/config.php'; require 'config/Database.php'; $db = Database::getInstance(); $db->query('SHOW TABLES'); print_r($db->resultSet()); ?>
