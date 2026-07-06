<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=bd_proyecto_final;charset=utf8mb4', 'root', '');
$q = $db->query('DESCRIBE usuarios');
print_r($q->fetchAll(PDO::FETCH_ASSOC));
