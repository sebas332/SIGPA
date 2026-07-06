<?php
require 'config/config.php';
require 'config/Database.php';
$db = Database::getInstance();

try {
    // Eliminar datos corruptos (con id=0) antes de alterar
    $db->query("DELETE FROM resultado_aprendizaje WHERE id_resultado = 0");
    $db->execute();
    
    $db->query("DELETE FROM competencias WHERE id_competencia = 0");
    $db->execute();
    
    $db->query("DELETE FROM programa WHERE id_programa = 0");
    $db->execute();
} catch (Exception $e) { echo "Limpieza ignorada: " . $e->getMessage() . "\n"; }

try {
    // 1. Programa
    echo "Agregando PK a programa...\n";
    $db->query("ALTER TABLE programa ADD PRIMARY KEY (id_programa)");
    $db->execute();
} catch (Exception $e) { echo "Error PK programa: " . $e->getMessage() . "\n"; }

try {
    echo "Haciendo AI a programa...\n";
    $db->query("ALTER TABLE programa MODIFY id_programa INT(11) NOT NULL AUTO_INCREMENT");
    $db->execute();
} catch (Exception $e) { echo "Error AI programa: " . $e->getMessage() . "\n"; }

try {
    // 2. Competencias
    echo "Haciendo AI a competencias...\n";
    $db->query("ALTER TABLE competencias MODIFY id_competencia INT(11) NOT NULL AUTO_INCREMENT");
    $db->execute();
} catch (Exception $e) { echo "Error AI competencias: " . $e->getMessage() . "\n"; }

try {
    // 3. Resultado de aprendizaje
    echo "Agregando PK a resultado_aprendizaje...\n";
    $db->query("ALTER TABLE resultado_aprendizaje ADD PRIMARY KEY (id_resultado)");
    $db->execute();
} catch (Exception $e) { echo "Error PK resultado_aprendizaje: " . $e->getMessage() . "\n"; }

try {
    echo "Haciendo AI a resultado_aprendizaje...\n";
    $db->query("ALTER TABLE resultado_aprendizaje MODIFY id_resultado INT(11) NOT NULL AUTO_INCREMENT");
    $db->execute();
} catch (Exception $e) { echo "Error AI resultado_aprendizaje: " . $e->getMessage() . "\n"; }

try {
    // 4. Llaves Foráneas que faltan
    echo "Agregando FK a programa (tipo)...\n";
    $db->query("ALTER TABLE programa ADD CONSTRAINT fk_programa_tipo FOREIGN KEY (id_tipo_programa) REFERENCES tipo_programa(id_tipo_programa) ON DELETE RESTRICT ON UPDATE CASCADE");
    $db->execute();
} catch (Exception $e) { echo "Error FK programa_tipo: " . $e->getMessage() . "\n"; }

try {
    echo "Agregando FK a resultado_aprendizaje (competencia)...\n";
    $db->query("ALTER TABLE resultado_aprendizaje ADD CONSTRAINT fk_resultado_competencia FOREIGN KEY (id_competencia) REFERENCES competencias(id_competencia) ON DELETE CASCADE ON UPDATE CASCADE");
    $db->execute();
} catch (Exception $e) { echo "Error FK resultado_competencia: " . $e->getMessage() . "\n"; }

echo "Script finalizado.\n";
