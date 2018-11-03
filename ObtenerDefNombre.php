<?php

require 'Definiciones.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   
    if (isset($_GET['def']) && isset($_GET['lang'])) {

        
        // Obtener par�metro idusuario
        $nombre = $_GET['def'];
        $idioma = $_GET['lang'];

        // Tratar retorno
        $retorno = Definiciones::getByNombre($nombre,$idioma);


        if ($retorno) {

            $usuario["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $usuario["usuario"] = $retorno;
            // Enviar objeto json del usuario
            print json_encode($usuario);
            
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesitan dos parametros. El idioma y la definicion'
            )
        );
    }
}

