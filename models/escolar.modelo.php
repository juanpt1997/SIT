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
        $stmt = Conexion::conectar()->prepare("INSERT INTO e_rutas (idinstitucion, numruta, sector,idvehiculo, idconductor, user_created, user_updated)
        VALUES (:idinstitucion, :numruta, :sector, :idvehiculo, :idconductor, :user_created, :user_updated)");
        $stmt->bindParam(":idinstitucion", $datos['idinstitucion'], PDO::PARAM_INT);
        $stmt->bindParam(":numruta", $datos['numruta'], PDO::PARAM_STR);
        $stmt->bindParam(":sector", $datos['sector'], PDO::PARAM_STR);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos['idconductor'], PDO::PARAM_INT);
        $stmt->bindParam(":user_created", $datos['user_created'], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos['user_updated'], PDO::PARAM_INT);


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
        $stmt = Conexion::conectar()->prepare("UPDATE e_rutas SET 
        idinstitucion = :idinstitucion, 
        numruta = :numruta, 
        sector = :sector, 
        idvehiculo = :idvehiculo,
        idconductor = :idconductor,
        user_updated = :user_updated
        WHERE idruta = :idruta");

        $stmt->bindParam(":idinstitucion", $datos['idinstitucion'], PDO::PARAM_INT);
        $stmt->bindParam(":numruta", $datos['numruta'], PDO::PARAM_STR);
        $stmt->bindParam(":sector", $datos['sector'], PDO::PARAM_STR);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor", $datos['idconductor'], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos['user_updated'], PDO::PARAM_INT);

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
        ESTUDIANTES X RUTA 
    ===================================================*/
    static public function mdlEstudiantesxRuta($ruta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT  * FROM e_pasajeros WHERE idruta = :idruta ORDER BY orden ");

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
        $stmt = Conexion::conectar()->prepare("UPDATE e_pasajeros set 
                                                idruta = :idruta,
                                                orden = :orden
                                                WHERE idpasajero = :idpasajero");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":orden", $datos['orden'], PDO::PARAM_INT);
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
        GUARDAR RECORRIDO
    ===================================================*/
    static public function mdlGuardarRecorrido($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO e_re_recorridos (idruta, fecha, auxiliar_recoge, observaciones_recoge, auxiliar_entrega, observaciones_entrega, user_created, user_updated) 
                                                VALUES (:idruta, :fecha, :auxiliar_recoge, :observaciones_recoge, :auxiliar_entrega, :observaciones_entrega, :user_created, :user_updated)");

        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":auxiliar_recoge", $datos['auxiliar'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_recoge", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":auxiliar_entrega", $datos['auxiliar2'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_entrega", $datos['observaciones2'], PDO::PARAM_STR);
        $stmt->bindParam(":user_created", $datos['user_created'], PDO::PARAM_STR);
        $stmt->bindParam(":user_updated", $datos['user_updated'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }


        $stmt->closeCursor();
        $stmt = null;

        return $id;
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

    /* ===================================================
        ACTUALIZAR CAMPO ORDENADO 
    ===================================================*/
    static public function mdlActualizarOrdenadoRuta($idruta)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_rutas SET ordenado = 1 WHERE idruta = :idruta");

        $stmt->bindParam(":idruta", $idruta, PDO::PARAM_INT);
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
        RECORRIDO POR FECHA Y RUTA 
    ===================================================*/
    static public function mdlRecorridoxFechaxRuta($idruta, $fecha)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM e_re_recorridos WHERE idruta = :idruta AND fecha = :fecha");

        $stmt->bindParam(":idruta", $idruta, PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        EDITAR RECORRIDO
    ===================================================*/
    static public function mdlEditarRecorrido($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_re_recorridos SET 
                                            auxiliar_entrega = :auxiliar_entrega, 
                                            observaciones_entrega = :observaciones_entrega,
                                            user_updated = :user_updated
                                            WHERE idruta = :idruta");

        $stmt->bindParam(":auxiliar_entrega", $datos['auxiliar2'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones_entrega", $datos['observaciones2'], PDO::PARAM_STR);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos['user_updated'], PDO::PARAM_INT);

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
        DATOS DEL RECORRIDO
    ===================================================*/
    static public function mdlDatosRecorrido($idrecorrido)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM e_re_recorridos WHERE idrecorrido = :idrecorrido");

        $stmt->bindParam(":idrecorrido", $idrecorrido, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        SEGUIMIENTO POR PASAJERO Y FECHA 
    ===================================================*/
    static public function mdlSeguimientoxPasajeroxFecha($idpasajero, $fecha)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM e_re_seguimiento_pasajeros WHERE idpasajero = :idpasajero AND fecha = :fecha");

        $stmt->bindParam(":idpasajero", $idpasajero, PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        GUARDAR SEGUIMIENTO RECOGE 
    ===================================================*/
    static public function mdlGuardarSeguimientoRecoge($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO e_re_seguimiento_pasajeros (idpasajero, fecha, hora_recogida, idrecorrido_recogida, user_created)
                                                VALUES (:idpasajero, :fecha, :hora_recogida, :idrecorrido_recogida, :user_created)");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":hora_recogida", $datos['hora'], PDO::PARAM_STR);
        $stmt->bindParam(":idrecorrido_recogida", $datos['idrecorrido'], PDO::PARAM_INT);
        $stmt->bindParam(":user_created", $datos['user_created'], PDO::PARAM_INT);

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
        GUARDAR SEGUIMIENTO ENTREGA 
    ===================================================*/
    static public function mdlGuardarSeguimientoEntrega($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO e_re_seguimiento_pasajeros (idpasajero, fecha, hora_entrega, idrecorrido_entrega, user_created)
                                                VALUES (:idpasajero, :fecha, :hora_entrega, :idrecorrido_entrega, :user_created)");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":hora_entrega", $datos['hora'], PDO::PARAM_STR);
        $stmt->bindParam(":idrecorrido_entrega", $datos['idrecorrido'], PDO::PARAM_INT);
        $stmt->bindParam(":user_created", $datos['user_created'], PDO::PARAM_INT);

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
        INSERTAR ENTREGA 
    ===================================================*/
    static public function mdlInsertarEntrega($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_re_seguimiento_pasajeros SET 
        hora_entrega = :hora_entrega,
        idrecorrido_entrega = :idrecorrido_entrega,
        user_updated = :user_updated
        WHERE idseguimiento = :idseguimiento");

        $stmt->bindParam(":hora_entrega", $datos['hora'], PDO::PARAM_STR);
        $stmt->bindParam(":idrecorrido_entrega", $datos['idrecorrido'], PDO::PARAM_INT);
        $stmt->bindParam(":idseguimiento", $datos['idseguimiento'], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos['user_updated'], PDO::PARAM_INT);

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
        INSERTAR RECOGIDA 
    ===================================================*/
    static public function mdlInsertarRecogida($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_re_seguimiento_pasajeros SET 
        hora_recogida = :hora_recogida,
        idrecorrido_recogida = :idrecorrido_recogida,
        user_updated = :user_updated
        WHERE idseguimiento = :idseguimiento");

        $stmt->bindParam(":hora_recogida", $datos['hora'], PDO::PARAM_STR);
        $stmt->bindParam(":idrecorrido_recogida", $datos['idrecorrido'], PDO::PARAM_INT);
        $stmt->bindParam(":idseguimiento", $datos['idseguimiento'], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos['user_updated'], PDO::PARAM_INT);

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
        ASOCIAR ESTUDIANTE TEMPORAL A RUTA
    ===================================================*/
    static public function mdlAsociarEstudianteTemporalRuta($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO e_ruta_temporal (idpasajero, idruta) VALUES (:idpasajero, :idruta)");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
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
        MODELO LISTAR ESTUDIANTES TEMPORALES X RUTA
    ===================================================*/
    static public function mdlListarEstudiantesTemporalesxRuta($idruta)
    {
        $stmt = Conexion::conectar()->prepare("SELECT rt.*, p.* FROM e_ruta_temporal rt
                                                INNER JOIN e_pasajeros p ON rt.idpasajero = p.idpasajero 
                                                WHERE rt.idruta = :idruta");

        $stmt->bindParam(":idruta", $idruta, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }


    /* ===================================================
        DESVINCULAR ESTUDIANTE DE RUTAS
    ===================================================*/
    static public function mdlDesvincularEstudianteRuta($idpasajero)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_pasajeros set idruta = NULL WHERE idpasajero = :idpasajero ");

        $stmt->bindParam(":idpasajero", $idpasajero, PDO::PARAM_INT);

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
        DESVINCULAR ESTUDIANTE DE RUTA TEMP
    ===================================================*/
    static public function mdlDesvincularEstudianteRutaTemp($idpasajero)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_ruta_temporal set idruta = NULL WHERE idpasajero = :idpasajero ");

        $stmt->bindParam(":idpasajero", $idpasajero, PDO::PARAM_INT);

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
        HISTORIAL DE RECORRIDO 
    ===================================================*/
    static public function mdlHistorialRecorrido()
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.*, DATE_FORMAT(r.fecha, '%d/%m/%Y') AS Ffecha,  rt.*, i.nombre, v.placa,p.Nombre AS nombre_conductor  FROM e_re_recorridos r
        INNER JOIN e_rutas rt ON r.idruta = rt.idruta
        INNER JOIN e_instituciones i ON rt.idinstitucion = i.idinstitucion
        INNER JOIN v_vehiculos v ON rt.idvehiculo = v.idvehiculo
        INNER JOIN gh_personal p ON p.idPersonal = rt.idvehiculo  
        ");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        PASAJEROS POR RECORRIDO 
    ===================================================*/
    static public function mdlPasajerosxRecorrido($idrecorrido)
    {
        $stmt = Conexion::conectar()->prepare("SELECT s.*, p.* FROM e_re_seguimiento_pasajeros s
        INNER JOIN e_pasajeros p ON s.idpasajero = p.idpasajero 
        WHERE s.idrecorrido_recogida = :idrecorrido OR s.idrecorrido_entrega = :idrecorrido ");

        $stmt->bindParam(":idrecorrido", $idrecorrido, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        ELIMINAR SEGUIMIENTO ENTREGA 
    ===================================================*/
    static public function mdlEliminarSeguimientoEntrega($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_re_seguimiento_pasajeros set idrecorrido_entrega = NULL, hora_entrega = NULL
                                                WHERE idpasajero = :idpasajero AND fecha = :fecha");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);

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
        ELIMINAR SEGUIMIENTO RECOGE
    ===================================================*/
    static public function mdlEliminarSeguimientoRecoge($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE e_re_seguimiento_pasajeros set idrecorrido_recogida = NULL, hora_recogida = NULL
                                             WHERE idpasajero = :idpasajero AND fecha = :fecha");

        $stmt->bindParam(":idpasajero", $datos['idpasajero'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);

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
