<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$db->query("SHOW TRIGGERS");
print_r($db->resultSet());
