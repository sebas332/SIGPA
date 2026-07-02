<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$updates = [
    1 => '1000000001',
    2 => '1000000002',
    3 => '1000000003',
    4 => '1000000004',
    5 => '1000000005',
    6 => '1000000006'
];

foreach ($updates as $id => $doc) {
    $db->query("UPDATE usuarios SET documento = :doc, usuario = :usu WHERE id_usuario = :id");
    $db->bind(':doc', $doc);
    $db->bind(':usu', $doc);
    $db->bind(':id', $id);
    $db->execute();
}
echo "Documentos actualizados correctamente.";
