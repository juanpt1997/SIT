<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';


/* ===================================================
   * PROPIETARIOS
===================================================*/
class ModeloPropietarios
{
    /*===========================
        MOSTRAR PROPIETARIO
    ============================*/
    static public function mdlMostrar($value)
    {

        if ($value != null) {

            $stmt = Conexion::conectar()->prepare("SELECT P.*, M.municipio AS ciudad FROM propietario P
												   LEFT JOIN gh_municipios M ON P.idciudad = M.idmunicipio
												   WHERE P.documento = :cedula");

            $stmt->bindParam(":cedula",  $value, PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT P.*, M.municipio AS ciudad FROM propietario P
									   			   LEFT JOIN gh_municipios M ON P.idciudad = M.idmunicipio
									   			   WHERE P.estado = 1");
            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    /*===========================
        AGREGAR PROPIETARIO
    ============================*/
    static public function mdlAgregar($datos)
    {


        $docum = $datos["documento"];

        $stmt = Conexion::conectar()->prepare("INSERT INTO propietario(tipodoc,documento,nombre,telef,direccion,email,idciudad)
                                                VALUES(:tipodoc,:documento,:nombre,:telef,:direccion,:email,:idciudad)");

        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipodoc", $datos["tdocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telef", $datos["telpro"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirpro"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["emailp"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadpro"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /*===========================
        EDITAR PROPIETARIO
    ============================*/
    static public function mdlEditar($datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE propietario set documento = :documento, tipodoc=:tipodoc,nombre=:nombre,telef=:telef,direccion=:direccion,
                                                      email=:email,idciudad=:idciudad
											   -- WHERE documento = :documento
                                               where idxp = :idxp");

        $stmt->bindParam(":idxp", $datos["idxp"], PDO::PARAM_INT);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipodoc", $datos["tdocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telef", $datos["telpro"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirpro"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["emailp"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadpro"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /* ==================================
        BORRADO LÓGICO PROPIETARIO
    ==================================== */

    static public function mdlEliminarPropietario($idxp)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE propietario set estado = 0 
                                               where idxp = :idxp");

        $stmt->bindParam(":idxp", $idxp, PDO::PARAM_INT);

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

/* ===================================================
   * CONVENIOS
===================================================*/
class ModeloConvenios
{
    static public function mdlMostrar($value)
    {

        if ($value != null) {

            $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad FROM v_empresas_convenios C
                                                   LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                   WHERE C.nit = :nit");

            $stmt->bindParam(":nit",  $value, PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad FROM v_empresas_convenios C
                                                   LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                   WHERE C.estado = 1");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregar($datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO v_empresas_convenios(nit,nombre,direccion,telefono1,telefono2,idciudad)
                                               VALUES(:nit,:nombre,:direccion,:telefono1,:telefono2,:idciudad)");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono1", $datos["telco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telco2"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcon"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditar($datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE v_empresas_convenios set nit=:nit,nombre=:nombre,direccion=:direccion,
                                                      telefono1=:telefono1,telefono2=:telefono2,idciudad=:idciudad
                                               WHERE idxc = :idxc");

        $stmt->bindParam(":idxc", $datos["idxc"], PDO::PARAM_INT);
        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono1", $datos["telco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telco2"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcon"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /*===================================
        Listado convenios
        ================================ */
    static public function mdlMostrarConvenios()
    {
        // $stmt = Conexion::conectar()->prepare("SELECT c.*, 
        // e.nombre AS nomContratante, e.nit AS nitContratante, 
        // e2.nombre AS nomContratista, e2.nit AS nitContratista, 
        // s.sucursal AS sucursal, 
        // v.placa AS placa, v.numinterno AS numinterno,
        // tv.tipovehiculo AS tipovehiculo
        // FROM v_convenios c 
        // INNER JOIN v_empresas_convenios e ON c.idcontratante = e.idxc
        // INNER JOIN v_empresas_convenios e2 ON c.idcontratista = e2.idxc
        // INNER JOIN gh_sucursales s ON c.idsucursal = s.ids
        // LEFT JOIN v_vehiculos v ON c.idvehiculo = v.idvehiculo
        // LEFT JOIN v_tipovehiculos tv ON v.idtipovehiculo = tv.idtipovehiculo
        // WHERE c.activo = 1   
        // ");
        $stmt = Conexion::conectar()->prepare("SELECT rec.idVehiculo,v.numinterno,
                                                v.placa,
                                                c.*, 
                                                e.nombre AS nomContratante, e.nit AS nitContratante, 
                                                e2.nombre AS nomContratista, e2.nit AS nitContratista, 
                                                s.sucursal AS sucursal
                                                FROM v_convenios c 
                                                INNER JOIN v_empresas_convenios e ON c.idcontratante = e.idxc
                                                INNER JOIN v_empresas_convenios e2 ON c.idcontratista = e2.idxc
                                                INNER JOIN gh_sucursales s ON c.idsucursal = s.ids
                                                LEFT JOIN v_re_convenios rec ON rec.idconvenio = c.idconvenio
                                                LEFT JOIN v_vehiculos v ON v.idvehiculo = rec.idvehiculo
                                                WHERE c.activo = 1   
                                                ORDER BY c.idconvenio
        ");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }


    /* ===================================================
        LISTADO DE PLACAS POR CONVENIO
    ===================================================*/

    


    /*===================================
        Listado convenios por Id 
        ================================ */
    static public function mdlDatosConvenios($idconvenio)
    {
        $stmt = Conexion::conectar()->prepare("SELECT c.*,
		e.nombre AS nomContratante, e.nit AS nitContratante, 
        e2.nombre AS nomContratista, e2.nit AS nitContratista, 
        s.sucursal AS sucursal,
		(SELECT v.placa 
		FROM v_re_convenios vrc
		INNER JOIN v_vehiculos v ON v.idvehiculo = vrc.idvehiculo
		LIMIT 1) AS placa 
      
		
        FROM v_convenios c
        INNER JOIN v_empresas_convenios e ON c.idcontratante = e.idxc
        INNER JOIN v_empresas_convenios e2 ON c.idcontratista = e2.idxc
        INNER JOIN gh_sucursales s ON c.idsucursal = s.ids
        LEFT JOIN v_vehiculos v ON v.idvehiculo = c.idvehiculo
        WHERE c.idconvenio = :idconvenio");

        $stmt->bindParam(":idconvenio", $idconvenio, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
        AGREGAR LISTA DE VEHICULOS
    ===================================================*/

    static public function mdlAgregarVehiculos($idConvenio, $idvehiculo)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO v_re_convenios (idconvenio, idvehiculo) VALUES (:idConvenio, :idvehiculo)");
        $stmt->bindParam(":idConvenio", $idConvenio, PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

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
       DATOS VEHICULOS POR CONVENIO
    ===================================================*/

    static public function mdlDatosVehiculosxConvenios($idconvenio)
    {
        $stmt = Conexion::conectar()->prepare("SELECT vrc.*, v.placa AS placa FROM v_re_convenios vrc
        LEFT JOIN v_vehiculos v ON vrc.idvehiculo = v.idvehiculo
        WHERE vrc.idconvenio = :idconvenio");

        $stmt->bindParam(":idconvenio", $idconvenio, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }


    /* ===================================================
       ELIMINAR LISTA DE VEHICULOS DE UN CONVENIO
    ===================================================*/

    static public function mdlEliminarVehiculos($idConvenio)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM v_re_convenios re WHERE idconvenio = :idConvenio");

        $stmt->bindParam(":idConvenio", $idConvenio, PDO::PARAM_INT);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /*===================================
        AGREGAR CONVENIO 
        ================================ */
    static public function mdlAgregarConvenio($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO v_convenios (idcontratante, idcontratista, contrato, idsucursal, estado, num_radicado, observacion, fecha_inicio, fecha_terminacion, fecha_radicado) 
                                                VALUES (:idcontratante, :idcontratista, :contrato, :idsucursal, :estado, :num_radicado, :observacion,:fecha_inicio,:fecha_terminacion,:fecha_radicado )");

        $stmt->bindParam(":idcontratante", $datos['idcontratante'], PDO::PARAM_INT);
        $stmt->bindParam(":idcontratista", $datos['idcontratista'], PDO::PARAM_INT);
        $stmt->bindParam(":contrato", $datos['contrato'], PDO::PARAM_STR);
        $stmt->bindParam(":idsucursal", $datos['idsucursal'], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":num_radicado", $datos['num_radicado'], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos['fecha_inicio'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_terminacion", $datos['fecha_terminacion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_radicado", $datos['fecha_radicado'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $id;
    }

    /* ===================================
        EDITAR CONVENIO
        ==================================== */
    static public function mdlEditarConvenio($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE v_convenios SET idcontratante = :idcontratante, idcontratista = :idcontratista, contrato = :contrato, idsucursal = :idsucursal, idvehiculo =:idvehiculo, 
                                                                    estado = :estado, num_radicado = :num_radicado, observacion = :observacion, fecha_inicio = :fecha_inicio, 
                                                                    fecha_terminacion = :fecha_terminacion, fecha_radicado = :fecha_radicado WHERE idConvenio = :idConvenio");

        $stmt->bindParam(":idConvenio", $datos['idConvenio'], PDO::PARAM_INT);
        $stmt->bindParam(":idcontratante", $datos['idcontratante'], PDO::PARAM_INT);
        $stmt->bindParam(":idcontratista", $datos['idcontratista'], PDO::PARAM_INT);
        $stmt->bindParam(":contrato", $datos['contrato'], PDO::PARAM_STR);
        $stmt->bindParam(":idsucursal", $datos['idsucursal'], PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":num_radicado", $datos['num_radicado'], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos['fecha_inicio'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_terminacion", $datos['fecha_terminacion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_radicado", $datos['fecha_radicado'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /* =======================================
        BORRAR CONVENIO 
        ====================================== */

    static public function mdlBorradoConvenios($idConvenio)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE v_convenios SET activo = 0 WHERE idConvenio = :idConvenio");
        $stmt->bindParam(":idConvenio", $idConvenio, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }


    /* =================================================
        BORRADO LÓGICO EMPRESA
    =================================================== */

    static public function mdlEliminarEmpresa($idxc)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE v_empresas_convenios SET estado = 0 WHERE idxc = :idxc");
        $stmt->bindParam(":idxc", $idxc, PDO::PARAM_INT);

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

/* ===================================================
   * VEHICULOS
===================================================*/
class ModeloVehiculos
{
    static public function mdlMostrarTipoVehiculo()
    {

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM v_tipovehiculos");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlMostrarMarca()
    {

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM v_marcas WHERE estado = 1");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       MOSTRAR VEHICULOS
    ===================================================*/
    static public function mdlVehiculos()
    {
        # todos los vehiculos
        // $sql = "SELECT v.*, t.tipovehiculo, m.marca, s.sucursal, vc.idconvenio, vc.idcontratante, vc.idcontratista, vc.fecha_inicio, vc.fecha_terminacion, c.nombre AS nom_contratante, co.nombre AS nom_contratista 
        // FROM v_vehiculos v
        // LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
        // LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
        // LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
        // LEFT JOIN v_convenios vc ON vc.idconvenio = v.idvehiculo
        // LEFT JOIN v_empresas_convenios c ON c.idxc = vc.idcontratante
        // LEFT JOIN v_empresas_convenios co ON co.idxc = vc.idcontratista ";
        $sql = "SELECT v.*,t.tipovehiculo,m.marca, s.sucursal,                    
                (SELECT cv.fecha_terminacion FROM v_convenios cv
                INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                WHERE rec.idvehiculo = v.idvehiculo
        ORDER BY cv.fecha_terminacion DESC
        LIMIT 1) AS fecha_terminacion,
        
        (SELECT cv.fecha_inicio FROM v_convenios cv
        INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
        WHERE rec.idvehiculo = v.idvehiculo
        ORDER BY cv.fecha_terminacion DESC 
        LIMIT 1) AS fecha_inicio,
        
        (SELECT emv.nombre FROM v_convenios cv
        INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
        INNER JOIN v_empresas_convenios emv ON cv.idcontratante = emv.idxc
        WHERE rec.idvehiculo = v.idvehiculo
        ORDER BY cv.fecha_terminacion DESC 
        LIMIT 1) AS nom_contratante,
        
        (SELECT emv.nombre FROM v_convenios cv
        INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
        INNER JOIN v_empresas_convenios emv ON cv.idcontratista = emv.idxc
        WHERE rec.idvehiculo = v.idvehiculo
        ORDER BY cv.fecha_terminacion DESC 
        LIMIT 1) AS nom_contratista
 
        FROM v_vehiculos v
        LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
        LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
        LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();


        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       DATOS DE UN VEHICULO
    ===================================================*/
    static public function mdlDatosVehiculo($datos)
    {

        // $stmt = Conexion::conectar()->prepare("SELECT v.*, t.tipovehiculo, m.marca, s.sucursal, c.nombre AS convenio FROM v_vehiculos v
        //                                         LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
        //                                         LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
        //                                         LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
        //                                         LEFT JOIN v_empresas_convenios c ON c.idxc = v.idconvenio
        //                                         WHERE v.{$datos['item']} = :{$datos['item']};");
        $stmt = Conexion::conectar()->prepare("SELECT v.*, t.tipovehiculo, m.marca, s.sucursal,
                                                    (SELECT cv.fecha_terminacion FROM v_convenios cv
                                                            INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                                                            WHERE rec.idvehiculo = v.idvehiculo
                                                    ORDER BY cv.fecha_terminacion DESC
                                                    LIMIT 1) AS fecha_terminacion,
                                                    
                                                    (SELECT cv.fecha_inicio FROM v_convenios cv
                                                    INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                                                    WHERE rec.idvehiculo = v.idvehiculo
                                                    ORDER BY cv.fecha_terminacion DESC 
                                                    LIMIT 1) AS fecha_inicio,
                                                    
                                                    (SELECT emv.idxc FROM v_convenios cv
                                                    INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                                                    INNER JOIN v_empresas_convenios emv ON cv.idcontratante = emv.idxc
                                                    WHERE rec.idvehiculo = v.idvehiculo
                                                    ORDER BY cv.fecha_terminacion DESC 
                                                    LIMIT 1) AS idcontratante,
                                                    
                                                    (SELECT emv.idxc FROM v_convenios cv
                                                    INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                                                    INNER JOIN v_empresas_convenios emv ON cv.idcontratista = emv.idxc
                                                    WHERE rec.idvehiculo = v.idvehiculo
                                                    ORDER BY cv.fecha_terminacion DESC 
                                                    LIMIT 1) AS idcontratista
                                                FROM v_vehiculos v
                                                LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
                                                LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
                                                LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
                                                WHERE v.{$datos['item']} = :{$datos['item']};");
        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       CARGAR FOTOS DEL VEHICULO
    ===================================================*/
    static public function mdlFotosVehiculo($datos)
    {
        if ($datos['item'] == "placa") {
            $sql = "SELECT f.* FROM v_fotosvehiculos f
                    INNER JOIN v_vehiculos v ON v.idvehiculo = f.idvehiculo
                    WHERE v.{$datos['item']} = :{$datos['item']}";
        } else {
            $sql = "SELECT f.* FROM v_fotosvehiculos f
                    WHERE f.{$datos['item']} = :{$datos['item']};";
        }

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ==================================================
        CARGAR SERVICIOS 
    ====================================================*/
    static public function mdlServiciosVehiculo($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT sm.*, s.*, v.idvehiculo, DATE_FORMAT(sm.fecha, '%Y-%m-%d') AS Ffecha  FROM m_re_serviciosvehiculos sm 
            INNER JOIN m_serviciosmenores s ON sm.idservicio =  s.idservicio
            INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo
            WHERE v.{$datos['item']} = :{$datos['item']}
            ORDER BY sm.fecha DESC;");

        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /*====================================================
        LISTADO DE SERVICIOS MENORES
    =====================================================*/

    static public function mdlHistoricoServiciosMenores()
    {
        $stmt = Conexion::conectar()->prepare("SELECT sm.*, s.*, v.* FROM m_re_serviciosvehiculos sm 
        INNER JOIN m_serviciosmenores s ON sm.idservicio =  s.idservicio
        INNER JOIN v_vehiculos v ON sm.idvehiculo = v.idvehiculo");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }


    /* ===================================================
       AGREGAR VEHICULO
    ===================================================*/
    static public function mdlAgregarVehiculo($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO v_vehiculos (placa, numinterno, fechavinculacion, chasis, numeromotor, modelo, color, capacidad, cilindraje, tipovinculacion, fechaimportacion, potenciahp, limitacion, activo, declaracionimpor, fechamatricula, fechaexpedicion, transito, tipocarroceria, 
        -- fechafinconvenio, 
        claveapp, fechadesvinculacion, observaciones, idsucursal, idmarca, 
        -- idconvenio, 
        idtipovehiculo, tipocombustible) VALUES 
                                    (:placa, :numinterno, :fechavinculacion, :chasis, :numeromotor, :modelo, :color, :capacidad, :cilindraje, :tipovinculacion, :fechaimportacion, :potenciahp, :limitacion, :activo, :declaracionimpor, :fechamatricula, :fechaexpedicion, :transito, :tipocarroceria, 
                                    -- :fechafinconvenio, 
                                    :claveapp, :fechadesvinculacion, :observaciones, :idsucursal, :idmarca, 
                                    -- :idconvenio, 
                                    :idtipovehiculo, :tipocombustible)");

        $stmt->bindParam(":placa", $datos['placa'], PDO::PARAM_STR);
        $stmt->bindParam(":numinterno", $datos['numinterno'], PDO::PARAM_STR);
        $stmt->bindParam(":fechavinculacion", $datos['fechavinculacion'], PDO::PARAM_STR);
        $stmt->bindParam(":chasis", $datos['chasis'], PDO::PARAM_STR);
        $stmt->bindParam(":numeromotor", $datos['numeromotor'], PDO::PARAM_STR);
        $stmt->bindParam(":modelo", $datos['modelo'], PDO::PARAM_STR);
        $stmt->bindParam(":color", $datos['color'], PDO::PARAM_STR);
        $stmt->bindParam(":capacidad", $datos['capacidad'], PDO::PARAM_STR);
        $stmt->bindParam(":cilindraje", $datos['cilindraje'], PDO::PARAM_STR);
        $stmt->bindParam(":tipovinculacion", $datos['tipovinculacion'], PDO::PARAM_STR);
        $fechaimportacion = $datos['fechaimportacion'] == "" ? null : $datos['fechaimportacion'];
        $stmt->bindParam(":fechaimportacion", $fechaimportacion, PDO::PARAM_STR);
        $stmt->bindParam(":potenciahp", $datos['potenciahp'], PDO::PARAM_STR);
        $stmt->bindParam(":limitacion", $datos['limitacion'], PDO::PARAM_STR);
        $stmt->bindParam(":activo", $datos['activo'], PDO::PARAM_STR);
        $stmt->bindParam(":declaracionimpor", $datos['declaracionimpor'], PDO::PARAM_STR);
        $fechamatricula = $datos['fechamatricula'] == "" ? null : $datos['fechamatricula'];
        $stmt->bindParam(":fechamatricula", $fechamatricula, PDO::PARAM_STR);
        $fechaexpedicion = $datos['fechaexpedicion'] == "" ? null : $datos['fechaexpedicion'];
        $stmt->bindParam(":fechaexpedicion", $fechaexpedicion, PDO::PARAM_STR);
        $stmt->bindParam(":transito", $datos['transito'], PDO::PARAM_STR);
        $stmt->bindParam(":tipocarroceria", $datos['tipocarroceria'], PDO::PARAM_STR);
        //$fechafinconvenio = $datos['fechafinconvenio'] == "" ? null : $datos['fechafinconvenio'];
        //$stmt->bindParam(":fechafinconvenio", $fechafinconvenio, PDO::PARAM_STR);
        $stmt->bindParam(":claveapp", $datos['claveapp'], PDO::PARAM_STR);
        $fechadesvinculacion = $datos['fechadesvinculacion'] == "" ? null : $datos['fechadesvinculacion'];
        $stmt->bindParam(":fechadesvinculacion", $fechadesvinculacion, PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $idsucursal = $datos['idsucursal'] == "" ? null : $datos['idsucursal'];
        $stmt->bindParam(":idsucursal", $idsucursal, PDO::PARAM_INT);
        $idmarca = $datos['idmarca'] == "" ? null : $datos['idmarca'];
        $stmt->bindParam(":idmarca", $idmarca, PDO::PARAM_INT);
        //$idconvenio = $datos['idconvenio'] == "" ? null : $datos['idconvenio'];
        //$stmt->bindParam(":idconvenio", $idconvenio, PDO::PARAM_INT);
        $idtipovehiculo = $datos['idtipovehiculo'] == "" ? null : $datos['idtipovehiculo'];
        $stmt->bindParam(":idtipovehiculo", $idtipovehiculo, PDO::PARAM_INT);
        $stmt->bindParam(":tipocombustible", $datos['tipocombustible'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
        EDITAR VEHICULO
    ===================================================*/
    static public function mdlEditarVehiculo($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE v_vehiculos SET placa = :placa, numinterno = :numinterno, fechavinculacion = :fechavinculacion, chasis = :chasis, numeromotor = :numeromotor, modelo = :modelo, color = :color, capacidad = :capacidad, cilindraje = :cilindraje, tipovinculacion = :tipovinculacion, fechaimportacion = :fechaimportacion, potenciahp = :potenciahp, limitacion = :limitacion, activo = :activo, declaracionimpor = :declaracionimpor, fechamatricula = :fechamatricula, fechaexpedicion = :fechaexpedicion, transito = :transito, tipocarroceria = :tipocarroceria, 
        -- fechafinconvenio = :fechafinconvenio, 
        claveapp = :claveapp, fechadesvinculacion = :fechadesvinculacion, observaciones = :observaciones, idsucursal = :idsucursal, idmarca = :idmarca, 
        -- idconvenio = :idconvenio, 
        idtipovehiculo = :idtipovehiculo, tipocombustible = :tipocombustible
                                    WHERE idvehiculo = :idvehiculo");

        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":placa", $datos['placa'], PDO::PARAM_STR);
        $stmt->bindParam(":numinterno", $datos['numinterno'], PDO::PARAM_STR);
        $stmt->bindParam(":fechavinculacion", $datos['fechavinculacion'], PDO::PARAM_STR);
        $stmt->bindParam(":chasis", $datos['chasis'], PDO::PARAM_STR);
        $stmt->bindParam(":numeromotor", $datos['numeromotor'], PDO::PARAM_STR);
        $stmt->bindParam(":modelo", $datos['modelo'], PDO::PARAM_STR);
        $stmt->bindParam(":color", $datos['color'], PDO::PARAM_STR);
        $stmt->bindParam(":capacidad", $datos['capacidad'], PDO::PARAM_STR);
        $stmt->bindParam(":cilindraje", $datos['cilindraje'], PDO::PARAM_STR);
        $stmt->bindParam(":tipovinculacion", $datos['tipovinculacion'], PDO::PARAM_STR);
        $fechaimportacion = $datos['fechaimportacion'] == "" ? null : $datos['fechaimportacion'];
        $stmt->bindParam(":fechaimportacion", $fechaimportacion, PDO::PARAM_STR);
        $stmt->bindParam(":potenciahp", $datos['potenciahp'], PDO::PARAM_STR);
        $stmt->bindParam(":limitacion", $datos['limitacion'], PDO::PARAM_STR);
        $stmt->bindParam(":activo", $datos['activo'], PDO::PARAM_STR);
        $stmt->bindParam(":declaracionimpor", $datos['declaracionimpor'], PDO::PARAM_STR);
        $fechamatricula = $datos['fechamatricula'] == "" ? null : $datos['fechamatricula'];
        $stmt->bindParam(":fechamatricula", $fechamatricula, PDO::PARAM_STR);
        $fechaexpedicion = $datos['fechaexpedicion'] == "" ? null : $datos['fechaexpedicion'];
        $stmt->bindParam(":fechaexpedicion", $fechaexpedicion, PDO::PARAM_STR);
        $stmt->bindParam(":transito", $datos['transito'], PDO::PARAM_STR);
        $stmt->bindParam(":tipocarroceria", $datos['tipocarroceria'], PDO::PARAM_STR);
        //$fechafinconvenio = $datos['fechafinconvenio'] == "" ? null : $datos['fechafinconvenio'];
        //$stmt->bindParam(":fechafinconvenio", $fechafinconvenio, PDO::PARAM_STR);
        $stmt->bindParam(":claveapp", $datos['claveapp'], PDO::PARAM_STR);
        $fechadesvinculacion = $datos['fechadesvinculacion'] == "" ? null : $datos['fechadesvinculacion'];
        $stmt->bindParam(":fechadesvinculacion", $fechadesvinculacion, PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $idsucursal = $datos['idsucursal'] == "" ? null : $datos['idsucursal'];
        $stmt->bindParam(":idsucursal", $idsucursal, PDO::PARAM_INT);
        $idmarca = $datos['idmarca'] == "" ? null : $datos['idmarca'];
        $stmt->bindParam(":idmarca", $idmarca, PDO::PARAM_INT);
        //$idconvenio = $datos['idconvenio'] == "" ? null : $datos['idconvenio'];
        //$stmt->bindParam(":idconvenio", $idconvenio, PDO::PARAM_INT);
        $idtipovehiculo = $datos['idtipovehiculo'] == "" ? null : $datos['idtipovehiculo'];
        $stmt->bindParam(":idtipovehiculo", $idtipovehiculo, PDO::PARAM_INT);
        $stmt->bindParam(":tipocombustible", $datos['tipocombustible'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta = $datos['idvehiculo'];
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ===================== 
        ACTUALIZAR UN UNICO CAMPO DEL VEHICULO
	========================= */
    static public function mdlActualizarVehiculo($datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE {$datos['tabla']} SET {$datos['item1']} = :{$datos['item1']} WHERE {$datos['item2']} = :{$datos['item2']}");

        $stmt->bindParam(":" . $datos['item1'], $datos['valor1'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $datos['item2'], $datos['valor2'], PDO::PARAM_STR);

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
       AGREGAR FOTO DEL VEHICULO
    ===================================================*/
    static public function mdlAgregarFotoVehiculo($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO v_fotosvehiculos (idvehiculo, ruta_foto) VALUES 
                                    (:idvehiculo, :ruta_foto)");

        $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":ruta_foto", $datos['ruta_foto'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
       ! ELIMINAR REGISTRO
    ===================================================*/
    static public function mdlEliminarRegistro($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("DELETE
                                    FROM {$datos['tabla']}
                                    WHERE {$datos['item']} = :{$datos['item']}");
        $stmt->bindParam(":" . $datos['item'], $datos['valor'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $retorno;
    }

    /* ===================================================
	   ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
	===================================================*/
    /* ===================================================
       MOSTRAR PROPIETARIOSxVEHICULO
    ===================================================*/
    static public function mdlPropietariosxVehiculo($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT pv.*, p.nombre AS propietario FROM v_re_propietariosvehiculos pv
                                                INNER JOIN propietario p ON p.idxp = pv.idpropietario
                                                WHERE pv.idvehiculo = :idvehiculo
                                                ORDER BY pv.fechacreacion DESC");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       MOSTRAR CONDUCTORESxVEHICULO
    ===================================================*/
    static public function mdlConductoresxVehiculo($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT cv.*, c.nombre AS conductor, c.Documento
                                                FROM v_re_conductoresvehiculos cv
                                                INNER JOIN gh_personal c ON c.idPersonal = cv.idconductor
                                                WHERE cv.idvehiculo = :idvehiculo
                                                ORDER BY cv.fechacreacion DESC");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       MOSTRAR DOCUMENTOSxVEHICULO
    ===================================================*/
    static public function mdlDocumentosxVehiculo($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT d.*, t.tipodocumento, DATE_FORMAT(fechafin, '%d/%m/%Y') AS Ffechafin
                                                FROM v_re_documentosvehiculos d
                                                INNER JOIN v_tipodocumento t ON t.idtipo = d.idtipodocumento
                                                WHERE d.idvehiculo = :idvehiculo
                                                ORDER BY d.fechacreacion DESC, d.fechafin DESC");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       VER DATOS DE UN REGISTRO EN ESPECIFICIO DE PROPIETARIOS O CONDUCTORES
    ===================================================*/
    static public function mdlVerDetalleVehiculo($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT *
                                    FROM {$datos['tabla']}
                                    WHERE {$datos['item']} = :{$datos['item']}");
        $stmt->bindParam(":" . $datos['item'], $datos['valor'], PDO::PARAM_INT);


        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        $conexion = null;
        return $retorno;
    }

    /* ===================================================
       TIPOS DE DOCUMENTACIÓN VEHICULAR
    ===================================================*/
    static public function mdlTiposDocumentacion()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM v_tipodocumento WHERE estado = 1");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       GUARDAR(agregar) OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO, CONDUCTOR O DOCUMENTOS
    ===================================================*/
    static public function mdlGuardarDetallesVehiculo($datos)
    {
        $conexion = Conexion::conectar();

        if (isset($datos['idpropietario'])) {
            $stmt = $conexion->prepare("INSERT INTO v_re_propietariosvehiculos (idvehiculo, idpropietario, participacion, observacion) 
                                        VALUES (:idvehiculo, :idpropietario, :participacion, :observacion)");

            $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
            $stmt->bindParam(":idpropietario", $datos['idpropietario'], PDO::PARAM_INT);
            $stmt->bindParam(":participacion", $datos['participacion'], PDO::PARAM_STR);
            $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);
        } else {
            if (isset($datos['idconductor'])) {
                $stmt = $conexion->prepare("INSERT INTO v_re_conductoresvehiculos (idvehiculo, idconductor, observacion) 
                                        VALUES (:idvehiculo, :idconductor, :observacion)");

                $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
                $stmt->bindParam(":idconductor", $datos['idconductor'], PDO::PARAM_INT);
                $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);
            } else {
                if (isset($datos['idtipodocumento'])) {
                    $stmt = $conexion->prepare("INSERT INTO v_re_documentosvehiculos (idvehiculo, idtipodocumento, nrodocumento, fechainicio, fechafin, tarifa) 
                                        VALUES (:idvehiculo, :idtipodocumento, :nrodocumento, :fechainicio, :fechafin, :tarifa)");

                    $stmt->bindParam(":idvehiculo", $datos['idvehiculo'], PDO::PARAM_INT);
                    $stmt->bindParam(":idtipodocumento", $datos['idtipodocumento'], PDO::PARAM_INT);
                    $stmt->bindParam(":nrodocumento", $datos['nrodocumento'], PDO::PARAM_STR);
                    $stmt->bindParam(":fechainicio", $datos['fechainicio'], PDO::PARAM_STR);
                    $stmt->bindParam(":fechafin", $datos['fechafin'], PDO::PARAM_STR);
                    $stmt->bindParam(":tarifa", $datos['tarifa'], PDO::PARAM_STR);
                }
            }
        }

        if (isset($stmt) && $stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
       EDITAR OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO O CONDUCTOR
    ===================================================*/
    static public function mdlEditarDetalleVehiculo($datos)
    {
        $conexion = Conexion::conectar();

        switch ($datos['tabla']) {
            case 'v_re_propietariosvehiculos':
                $sql = "";
                break;

            case 'v_re_conductoresvehiculos':
                $sql = "";
                break;

            default:

                break;
        }

        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":idregistro", $datos['idregistro'], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);

        if (isset($stmt) && $stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    /* ===================================================
		REPORTE COMPLETO DOCUMENTOS VEHICULOS
	===================================================*/
    static public function mdlReporteDocumentos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                v.placa, v.numinterno, v.tipovinculacion, v.activo, 
                                                date_format(d.fechainicio, '%Y/%m/%d') as fechainicio, date_format(MAX(d.fechafin), '%Y/%m/%d') AS fechafin, 
                                                t.tipodocumento, t.idtipo,
                                                s.sucursal,
                                                p.nombre, p.documento, p.telef, p.email
                                                FROM v_vehiculos v
                                                INNER JOIN v_re_documentosvehiculos d ON v.idvehiculo = d.idvehiculo
                                                LEFT JOIN v_tipodocumento t ON t.idtipo = d.idtipodocumento
                                                LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
                                                LEFT JOIN v_re_propietariosvehiculos pv ON pv.idvehiculo = v.idvehiculo
                                                LEFT JOIN propietario p ON p.idxp = pv.idpropietario
                                                GROUP BY d.idtipodocumento, v.idvehiculo
                                                ORDER BY v.placa, t.idtipo");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       REPORTE DOCUMENTOS X VEHICULO
    ===================================================*/
    // static public function mdlReporteDocumentosxVehiculo($idvehiculo)
    // {
    //     $stmt = Conexion::conectar()->prepare("SELECT t.tipodocumento, MAX(d.fechafin) AS fechafin
    //                                             FROM v_tipodocumento t
    //                                             LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
    //                                             WHERE d.idvehiculo = :idvehiculo
    //                                             GROUP BY t.idtipo UNION ALL
    //                                             SELECT t.tipodocumento, NULL AS fechafin
    //                                             FROM v_tipodocumento t
    //                                             LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
    //                                             WHERE t.tipodocumento NOT IN (
    //                                             SELECT t.tipodocumento
    //                                             FROM v_tipodocumento t
    //                                             LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
    //                                             WHERE d.idvehiculo = :idvehiculo
    //                                             GROUP BY t.idtipo)
    //                                             GROUP BY t.idtipo;");
    //     $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

    //     $stmt->execute();
    //     $retorno = $stmt->fetchAll();
    //     $stmt->closeCursor();
    //     return $retorno;
    // }
}

/* ===================================================
   * BLOQUEO DE PERSONAL
===================================================*/
class ModeloBloqueoP
{

    static public function mdlUltimoBloqueo($value)
    {

        if ($value != null) {

            $stmt = Conexion::conectar()->prepare(" SELECT p.Nombre AS conductor, b.motivo, b.estado, b.fecha, b.idbloqueo, p.idPersonal ,u.Nombre AS nomUsuario 
                                                    FROM gh_bloqueopersonal b
                                                        INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                                        INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                        INNER JOIN 
                                                            (SELECT MAX(idbloqueo) AS idbloqueo FROM gh_bloqueopersonal GROUP BY idPersonal) 
                                                                T ON b.idbloqueo = T.idbloqueo 
                                                                WHERE p.idPersonal = :personal");

            $stmt->bindParam(":personal",  $value, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare(" SELECT p.Nombre AS conductor, b.motivo, b.estado, b.fecha, b.idbloqueo, p.idPersonal ,u.Nombre AS nomUsuario 
                                                    FROM gh_bloqueopersonal b
                                                        INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                                        INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                        INNER JOIN 
                                                            (SELECT MAX(idbloqueo) AS idbloqueo FROM gh_bloqueopersonal GROUP BY idPersonal) 
                                                                T ON b.idbloqueo = T.idbloqueo");

            $stmt->execute();
            $retorno = $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }


    static public function mdlHistorial($value)
    {

        $stmt = Conexion::conectar()->prepare("SELECT p.Nombre AS conductor, b.motivo, b.estado, b.fecha, b.idbloqueo, 
                                                      u.Nombre AS nomUsuario 
                                                FROM gh_bloqueopersonal b
                                                    INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                                    INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                WHERE b.idPersonal = :idper
                                                ORDER BY b.idbloqueo DESC
                                                ");

        $stmt->bindParam(":idper",  $value, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlMostrarConductor($value)
    {

        $stmt = Conexion::conectar()->prepare("SELECT p.nombre AS conductor 
                                               FROM gh_bloqueopersonal b
                                                    INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                               WHERE b.idPersonal = :idper
                                               GROUP BY b.idPersonal");

        $stmt->bindParam(":idper",  $value, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlNuevoBloqueo($datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO gh_bloqueopersonal(idPersonal,motivo,estado,fecha,usuario)
                                                VALUES(:idPersonal,:motivo,:estado,:fecha,:usuario)");

        $stmt->bindParam(":idPersonal", $datos["conductorB"], PDO::PARAM_INT);
        $stmt->bindParam(":motivo", $datos["motivob"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estadobloqueo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha_vin"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["cedula"], PDO::PARAM_INT);

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

/* ===================================================
   * BLOQUEO DE VEHICULOS
===================================================*/
class ModeloBloqueoV
{
    static public function mdlUltimoBloqueoV($value)
    {

        if ($value != null) {

            $stmt = Conexion::conectar()->prepare(" SELECT b.*, v.placa, u.nombre AS nomUsuario
                                                    FROM v_bloqueovehiculo b
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
                                                    INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                    INNER JOIN 
                                                     (
                                                    SELECT MAX(idbloqueov) AS idbloqueov
                                                    FROM v_bloqueovehiculo
                                                    GROUP BY idvehiculo) 
                                                     T ON b.idbloqueov = T.idbloqueov
                                                     WHERE v.idvehiculo = :vehiculo");

            $stmt->bindParam(":vehiculo",  $value, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT b.*, v.placa, u.nombre AS nomUsuario
                                                    FROM v_bloqueovehiculo b
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
                                                    INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                    INNER JOIN 
                                                    (
                                                    SELECT MAX(idbloqueov) AS idbloqueov
                                                    FROM v_bloqueovehiculo
                                                    GROUP BY idvehiculo) 
                                                    T ON b.idbloqueov = T.idbloqueov");

            $stmt->execute();
            $retorno = $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlMostrarPlaca($value)
    {

        $stmt = Conexion::conectar()->prepare("SELECT v.placa AS placa 
                                                FROM v_bloqueovehiculo b
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
                                                WHERE b.idvehiculo = :idve
                                                GROUP BY b.idvehiculo");

        $stmt->bindParam(":idve",  $value, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlNuevoBloqueoV($datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO v_bloqueovehiculo(idvehiculo,motivo,estado,fecha,usuario)
                                                VALUES(:idvehiculo,:motivo,:estado,:fecha,:usuario)");

        $stmt->bindParam(":idvehiculo", $datos["vehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":motivo", $datos["motivobv"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estadobloqueov"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos["fecha_des"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["cedula"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            $retorno = "ok";
        } else {

            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlHistorialV($value)
    {

        $stmt = Conexion::conectar()->prepare("     SELECT b.*, v.placa AS placa, u.nombre AS nomUsuario
                                                    FROM v_bloqueovehiculo b
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
                                                    INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                    WHERE b.idvehiculo = :vehiculo
                                                    ORDER BY b.idvehiculo DESC
                                                ");

        $stmt->bindParam(":vehiculo",  $value, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }
}
