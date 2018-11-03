<?php

require 'Definiciones.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $definiciones = Definiciones::getAll();
    if ($definiciones) {
        $datos["estado"] = 1;
        $datos["definiciones"] = $definiciones;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}