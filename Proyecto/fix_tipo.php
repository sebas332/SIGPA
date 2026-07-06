<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();

try {
    echo "Agregando PK a tipo_programa...\n";
    $db->query("ALTER TABLE tipo_programa ADD PRIMARY KEY (id_tipo_programa)");
    $db->execute();
} catch (Exception $e) { echo "Error PK tipo_programa: " . $e->getMessage() . "\n"; }

try {
    echo "Haciendo AI a tipo_programa...\n";
    $db->query("ALTER TABLE tipo_programa MODIFY id_tipo_programa INT(11) NOT NULL AUTO_INCREMENT");
    $db->execute();
} catch (Exception $e) { echo "Error AI tipo_programa: " . $e->getMessage() . "\n"; }

try {
    echo "Agregando FK a programa (tipo)...\n";
    $db->query("ALTER TABLE programa ADD CONSTRAINT fk_programa_tipo FOREIGN KEY (id_tipo_programa) REFERENCES tipo_programa(id_tipo_programa) ON DELETE RESTRICT ON UPDATE CASCADE");
    $db->execute();
} catch (Exception $e) { echo "Error FK programa_tipo: " . $e->getMessage() . "\n"; }

echo "Script finalizado.\n";
