<?php
/**
 * Copia este archivo como smtp.local.php y reemplaza los valores.
 *
 * Importante para Gmail:
 * - No uses la clave normal de tu correo.
 * - Activa la verificacion en 2 pasos.
 * - Genera una "contrasena de aplicacion" de 16 caracteres.
 */
return [
    'host' => 'smtp.gmail.com',
    'user' => 'tu_correo@gmail.com',
    'pass' => 'tu_contrasena_de_aplicacion_de_16_caracteres',
    'port' => 587,
    'secure' => 'tls',
    'from_name' => 'SIGPA - Sistema de Gestion Academica',
];
