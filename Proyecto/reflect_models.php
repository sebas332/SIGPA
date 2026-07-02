<?php
require 'config/config.php';
require 'config/Database.php';

$models = ['Usuario', 'Ficha', 'Ambiente', 'Programa'];
foreach ($models as $m) {
    if (file_exists("app/Models/$m.php")) {
        require_once "app/Models/$m.php";
        echo "Model: $m\n";
        $ref = new ReflectionClass($m);
        foreach ($ref->getMethods() as $method) {
            echo " - " . $method->getName() . "\n";
        }
    } else {
        echo "Model $m not found.\n";
    }
}
