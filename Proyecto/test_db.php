<?php require "config/Database.php"; $db = Database::getInstance(); $db->query("SHOW COLUMNS FROM usuarios"); print_r($db->resultSet()); 
