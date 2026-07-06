<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/Database.php';

$db = Database::getInstance();

$db->query("SELECT * FROM programa");
$programas = $db->resultSet();

foreach ($programas as $p) {
    echo "PROGRAMA ID: {$p->id_programa} - {$p->nombre}\n";
    
    // Competencias
    $db->query("SELECT * FROM competencias WHERE id_programa = :id");
    $db->bind(':id', $p->id_programa);
    $competencias = $db->resultSet();
    
    echo "  Competencias (" . count($competencias) . "):\n";
    foreach ($competencias as $c) {
        echo "    - ID: {$c->id_competencia}, Nombre: {$c->nombre}, Horas: {$c->horas_totales}, Porcentaje: {$c->porcentaje}\n";
        
        // Resultados
        $db->query("SELECT * FROM resultado_aprendizaje WHERE id_competencia = :id");
        $db->bind(':id', $c->id_competencia);
        $resultados = $db->resultSet();
        echo "      Resultados (" . count($resultados) . "):\n";
        foreach ($resultados as $r) {
            echo "        * ID: {$r->id_resultado}, Codigo: {$r->codigo}, Sesiones: " . ($r->sesiones_asignadas ?? 'NULL') . ", Desc: {$r->descripcion}\n";
        }
    }
    echo "\n";
}
