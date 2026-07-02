<?php
require 'config/config.php';
require 'config/Database.php';
require 'app/Controllers/BaseController.php';

$controllers = ['UsuarioController', 'FichaController', 'AmbienteController', 'ProgramaController'];
foreach ($controllers as $c) {
    if (file_exists("app/Controllers/$c.php")) {
        require_once "app/Controllers/$c.php";
        echo "Controller: $c\n";
        $ref = new ReflectionClass($c);
        foreach ($ref->getMethods() as $method) {
            if ($method->class === $c) {
                echo " - " . $method->getName() . "\n";
            }
        }
    } else {
        echo "Controller $c not found.\n";
    }
}
