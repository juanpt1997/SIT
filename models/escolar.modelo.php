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

    /* ===================================================
        ESTUDIANTE X DOCUMENTO
    ===================================================*/
    static public function mdlEstudiantexDocumento($codigo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT  * FROM e_pasajeros WHERE codigo = :codigo");

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;

    }

    /* ===================================================
        GUARDAR ESTUDIANTE
    ===================================================*/
    static public function mdlGuardarEstudiante($datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO e_pasajeros 
                (codigo, nombre, idruta, ano, grado, grupo, nivel, barrio, direccion, nombre_acudiente1, celular_acudiente1, nombre_acudiente2, celular_acudiente2) 
        VALUES (:codigo, :nombre, :idruta, :ano, :grado, :grupo, :nivel, :barrio, :direccion, :nombre_acudiente1, :celular_acudiente1, :nombre_acudiente2, :celular_acudiente2)");

        $stmt->bindParam(":codigo", $datos['documentoEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos['nombreEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":ano", $datos['anoEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":grado", $datos['gradoEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":grupo", $datos['grupoEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":nivel", $datos['nivelEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":barrio", $datos['barrioEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos['direccionEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_acudiente1", $datos['nombrePAcudienteEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":celular_acudiente1", $datos['celularPAcudienteEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_acudiente2", $datos['nombreSAcudienteEstudiante'], PDO::PARAM_STR);
        $stmt->bindParam(":celular_acudiente2", $datos['celularSAcudienteEstudiante'], PDO::PARAM_STR);
        
        if($stmt->execute()){
            $retorno = "ok";
        }else{
            $retorno = "error";
        }


        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /* ===================================================
        ESTUDIANTES X RUTA 
    ===================================================*/
    static public function mdlEstudiantesxRuta($ruta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT  * FROM e_pasajeros WHERE idruta = :idruta");

        $stmt->bindParam(":idruta", $ruta, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        ESTUDIANTE POR ID PASAJERO
    ===================================================*/
    static public function mdlEstudiantexId($idpasajero)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM e_pasajeros WHERE idpasajero = :idpasajero");

        $stmt->bindParam(":idpasajero", $idpasajero, PDO::PARAM_INT);

       
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;

    }

    /* ===================================================
        ASOCIAR ESTUDIANTE A RUTA
    ===================================================*/
    static public function mdlAsociarEstudianteRuta($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_pasajeros set idruta = :idruta
                                                WHERE idpasajero = :idpasajero");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);

        if($stmt->execute()){
            $retorno = "ok";
        }else{
            $retorno = "error";
        }


        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }


    /* ===================================================
        GUARDAR RECORRIDO
    ===================================================*/
    static public function mdlGuardarRecorrido($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO e_re_recorridos (idruta, fecha, auxiliar, observaciones) 
                                                VALUES (:idruta, :fecha, :auxiliar, :observaciones)");

        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":auxiliar", $datos['auxiliar'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);

        if($stmt->execute()){
            $retorno = "ok";
        }else{
            $retorno = "error";
        }


        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }


    /* ==========================================================
        CONSULTAR SI HAY RECORRIDO PARA ESA RUTA EN EL MISMO DÍA 
    ============================================================*/
    static public function mdlRecorridoxRutaxDia($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM e_re_recorridos WHERE fecha = :fecha AND idruta = :idruta");

        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);


        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;

    }

}
