<?php

/**
 * Representa el la estructura de las definicioness
 * almacenadas en la base de datos
 */
require 'Database.php';

class Definiciones {

    function __construct() {
        
    }

    //devuelve todas las deficiones
    public static function getAll() {
        $consulta = "SELECT * FROM definiciones";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    //devuleve una deficion
    public static function getById($id) {
        // Consulta de la tabla definiciones
        $consulta = "SELECT esp,
                            eng
                             FROM definiciones
                             WHERE id = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($id));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    public static function getByNombre($nombre, $idioma) {
        // Consulta de la tabla definiciones
        if ($idioma == "esp") {
            $consulta = "SELECT esp
                             FROM definiciones
                             WHERE esp like '" . $nombre . "'";

        }else{
            $consulta = "SELECT eng
                             FROM definiciones
                             WHERE eng like '" . $nombre . "'";

        }
        
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
    
    //cambia definiciones de usuario????
    public static function update(
    $esp, $eng, $id
    ) {
        // Creando consulta UPDATE
        $consulta = "UPDATE definiciones" .
                " SET esp=?, eng=? " .
                "WHERE id=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($esp, $eng, $id));

        return $cmd;
    }

    //crea nueva deficiones
    public static function insert(
    $esp, $eng
    ) {
        // Sentencia INSERT
        $comando = "INSERT INTO definiciones ( " .
                "esp," .
                " eng)" .
                " VALUES( ?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
                        array(
                            $esp,
                            $eng
                        )
        );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $id identificador de la tabla definiciones
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($id) {
        // Sentencia DELETE
        $comando = "DELETE FROM definiciones WHERE id=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($id));
    }

}

?>