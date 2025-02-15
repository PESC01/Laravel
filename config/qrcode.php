<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Configuración General de QR Code
    |--------------------------------------------------------------------------
    |
    | Define el driver a utilizar para la generación del QR. Se recomienda gd para
    | evitar depender de la extensión Imagick.
    |
    */
    'driver' => 'gd',
    'format' => 'png',
    'size'   => 200,
];
