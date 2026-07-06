<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$db->query('SHOW CREATE TABLE fichas');
print_r($db->resultSet());
