<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();
$id = 2; // Asumiendo que el ID del programa a borrar es 2 (o cualquier id que tenga). Voy a buscar uno.
$db->query("SELECT id_programa FROM programa LIMIT 1");
$prog = $db->single();
if ($prog) {
    try {
        $db->query("DELETE FROM programa WHERE id_programa = :id");
        $db->bind(':id', $prog->id_programa);
        $db->execute();
        echo "Borrado con éxito";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
