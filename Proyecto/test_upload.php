<?php
$_SERVER["REQUEST_METHOD"] = "POST";
$_POST["rol_carga"] = 2;
$_FILES["archivo_csv"] = [
    "tmp_name" => "test.csv",
    "name" => "test.csv",
    "error" => 0,
    "size" => 100
];
file_put_contents("test.csv", "Documento;Nombres;Apellidos;Telefono;Correo;Titulacion\n1234567891;carmen;lopez;5555555555;carmen@gma;Bachiller");

require_once "config/config.php";
require_once "config/Database.php";
require_once "app/Controllers/BaseController.php";

class TestUsuarioController extends BaseController {
    public function __construct() {}
    public function requireRol($rol) {} // Mock to prevent redirect
}

$content = file_get_contents("app/Controllers/UsuarioController.php");
$content = str_replace("extends BaseController", "extends TestUsuarioController", $content);
file_put_contents("TempUsuarioController.php", $content);
require_once "TempUsuarioController.php";

$controller = new UsuarioController();
$controller->importarMasivoCSV();

