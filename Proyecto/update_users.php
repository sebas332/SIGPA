<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$hash = password_hash('Sena2026*', PASSWORD_BCRYPT);
$db->query("UPDATE usuarios SET contraseña = :hash");
$db->bind(':hash', $hash);
$db->execute();
echo "Usuarios actualizados a contraseña real.";
