<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

class ModeloEscolar
{

    /* ===================================================
        LISTA INSTITUCIONES 
    ===================================================*/
    static public function mdlListaInstituciones()
    {
        $stmt = Conexion::conectar()->prepare("SELECT i.* FROM e_instituciones i WHERE i.estado = 1");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }


    /* ===================================================
        GUARDAR RUTA
    ===================================================*/
    static public function mdlGuardarRuta($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO e_rutas (idinstitucion, numruta, sector,idvehiculo) VALUES (:idinstitucion, :numruta, :sector, :idvehiculo)");
        $stmt->bindParam(":idinstitucion", $datos['idinstitucion'], PDO::PARAM_INT);
        $stmt->bindParam(":numruta", $datos['numruta'], PDO::PARAM_STR);
        $stmt->bindParam(":sector", $datos['sector'], PDO::PARAM_STR);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /* ===================================================
        LISTAR RUTAS
    ===================================================*/
    static public function mdlListarRutas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.*, i.nombre, v.placa, v.capacidad FROM e_rutas r
        INNER JOIN e_instituciones i on r.idinstitucion = i.idinstitucion
        INNER JOIN v_vehiculos v ON r.idvehiculo = v.idvehiculo");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }


    /* ===================================================
        RUTAS POR IDRUTA
    ===================================================*/
    static public function mdlRutaxId($idruta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.*, i.nombre, v.placa, v.capacidad FROM e_rutas r
        INNER JOIN e_instituciones i on r.idinstitucion = i.idinstitucion
        INNER JOIN v_vehiculos v ON r.idvehiculo = v.idvehiculo 
		WHERE r.idruta = :idruta");

        $stmt->bindParam(":idruta", $idruta, PDO::PARAM_INT);


        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        EDITAR RUTA
    ===================================================*/
    static public function mdlEditarRuta($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_rutas SET idinstitucion = :idinstitucion, numruta = :numruta, 
        sector = :sector, idvehiculo = :idvehiculo
        WHERE idruta = :idruta");

        $stmt->bindParam(":idinstitucion", $datos['idinstitucion'], PDO::PARAM_INT);
        $stmt->bindParam(":numruta", $datos['numruta'], PDO::PARAM_STR);
        $stmt->bindParam(":sector", $datos['sector'], PDO::PARAM_STR);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
}
