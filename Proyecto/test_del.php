<?php
require __DIR__ . '/app/Config/config.php';
require __DIR__ . '/app/Libraries/Database.php';
require __DIR__ . '/app/Models/UsuarioRol.php';

$model = new UsuarioRol();
print_r($model->getRolesByUsuario(5));
