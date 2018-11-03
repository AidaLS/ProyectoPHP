<?php

/**
 * Representa el la estructura de las usuarioss
 * almacenadas en la base de datos
 */
require 'Database.php';

class Usuarios {

    function __construct() {
        
    }

    //devolver si esta o no registrado el usuario
    public static function getByNombre($usuario) {
        // Consulta de la tabla usuarios
        $consulta = "SELECT usuario,
                            pass
                             FROM usuarios
                             WHERE usuario = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($nombre));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    //igual pongo un ajustes??
    public static function update(
    $id, $nombre, $direccion
    ) {
        // Creando consulta UPDATE
        $consulta = "UPDATE usuarios" .
                " SET usuario=?, pass=? " .
                "WHERE id=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre, $direccion, $id));

        return $cmd;
    }

    //insertar usuario cuando se registra
    public static function insert(
    $usuario, $direccion
    ) {
        // Sentencia INSERT
        $comando = "INSERT INTO usuarios ( " .
                "nombre," .
                " direccion)" .
                " VALUES( ?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
                        array(
                            $nombre,
                            $direccion
                        )
        );
    }

    //eliminar usuario?
    public static function delete($id) {
        // Sentencia DELETE
        $comando = "DELETE FROM usuarios WHERE id=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id));
    }

}

?>