<?php require 'config/config.php'; require 'config/Database.php'; $db = Database::getInstance(); $db->query('SELECT id_usuario FROM usuarios WHERE id_usuario = 11'); print_r($db->resultSet()); ?>
