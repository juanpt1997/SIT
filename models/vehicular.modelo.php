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

            $stmt->bindParam(":cedula",  $value, PDO::PARAM_INT);
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
}

/* ===================================================
   * CONVENIOS
===================================================*/
class ModeloConvenios
{
    static public function mdlMostrar($value)
    {

        if ($value != null) {

            $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad FROM convenios C
                                                   LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                   WHERE C.nit = :nit");

            $stmt->bindParam(":nit",  $value, PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad FROM convenios C
                                                   LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregar($datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO convenios(nit,nombre,direccion,telefono1,telefono2,idciudad)
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

        $stmt = Conexion::conectar()->prepare("UPDATE convenios set nit=:nit,nombre=:nombre,direccion=:direccion,
                                                      telefono1=:telefono1,telefono2=:telefono2,idciudad=:idciudad
                                               WHERE nit = :nit");

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
                                                FROM v_marcas");

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
        $sql = "SELECT v.*, t.tipovehiculo, m.marca, s.sucursal, c.nombre AS convenio FROM v_vehiculos v
                LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
                LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
                LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
                LEFT JOIN convenios c ON c.idxc = v.idconvenio;";
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

        $stmt = Conexion::conectar()->prepare("SELECT v.*, t.tipovehiculo, m.marca, s.sucursal, c.nombre AS convenio FROM v_vehiculos v
                                                LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
                                                LEFT JOIN v_marcas m ON m.idmarca = v.idmarca
                                                LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
                                                LEFT JOIN convenios c ON c.idxc = v.idconvenio
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

    /* ===================================================
       AGREGAR VEHICULO
    ===================================================*/
    static public function mdlAgregarVehiculo($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO v_vehiculos (placa, numinterno, fechavinculacion, chasis, numeromotor, modelo, color, capacidad, cilindraje, tipovinculacion, fechaimportacion, potenciahp, limitacion, activo, declaracionimpor, fechamatricula, fechaexpedicion, transito, tipocarroceria, fechafinconvenio, claveapp, fechadesvinculacion, observaciones, idsucursal, idmarca, idconvenio, idtipovehiculo) VALUES 
                                    (:placa, :numinterno, :fechavinculacion, :chasis, :numeromotor, :modelo, :color, :capacidad, :cilindraje, :tipovinculacion, :fechaimportacion, :potenciahp, :limitacion, :activo, :declaracionimpor, :fechamatricula, :fechaexpedicion, :transito, :tipocarroceria, :fechafinconvenio, :claveapp, :fechadesvinculacion, :observaciones, :idsucursal, :idmarca, :idconvenio, :idtipovehiculo)");

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
        $fechafinconvenio = $datos['fechafinconvenio'] == "" ? null : $datos['fechafinconvenio'];
        $stmt->bindParam(":fechafinconvenio", $fechafinconvenio, PDO::PARAM_STR);
        $stmt->bindParam(":claveapp", $datos['claveapp'], PDO::PARAM_STR);
        $fechadesvinculacion = $datos['fechadesvinculacion'] == "" ? null : $datos['fechadesvinculacion'];
        $stmt->bindParam(":fechadesvinculacion", $fechadesvinculacion, PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $idsucursal = $datos['idsucursal'] == "" ? null : $datos['idsucursal'];
        $stmt->bindParam(":idsucursal", $idsucursal, PDO::PARAM_INT);
        $idmarca = $datos['idmarca'] == "" ? null : $datos['idmarca'];
        $stmt->bindParam(":idmarca", $idmarca, PDO::PARAM_INT);
        $idconvenio = $datos['idconvenio'] == "" ? null : $datos['idconvenio'];
        $stmt->bindParam(":idconvenio", $idconvenio, PDO::PARAM_INT);
        $idtipovehiculo = $datos['idtipovehiculo'] == "" ? null : $datos['idtipovehiculo'];
        $stmt->bindParam(":idtipovehiculo", $idtipovehiculo, PDO::PARAM_INT);

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
        $stmt = $conexion->prepare("UPDATE v_vehiculos SET placa = :placa, numinterno = :numinterno, fechavinculacion = :fechavinculacion, chasis = :chasis, numeromotor = :numeromotor, modelo = :modelo, color = :color, capacidad = :capacidad, cilindraje = :cilindraje, tipovinculacion = :tipovinculacion, fechaimportacion = :fechaimportacion, potenciahp = :potenciahp, limitacion = :limitacion, activo = :activo, declaracionimpor = :declaracionimpor, fechamatricula = :fechamatricula, fechaexpedicion = :fechaexpedicion, transito = :transito, tipocarroceria = :tipocarroceria, fechafinconvenio = :fechafinconvenio, claveapp = :claveapp, fechadesvinculacion = :fechadesvinculacion, observaciones = :observaciones, idsucursal = :idsucursal, idmarca = :idmarca, idconvenio = :idconvenio, idtipovehiculo = :idtipovehiculo
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
        $fechafinconvenio = $datos['fechafinconvenio'] == "" ? null : $datos['fechafinconvenio'];
        $stmt->bindParam(":fechafinconvenio", $fechafinconvenio, PDO::PARAM_STR);
        $stmt->bindParam(":claveapp", $datos['claveapp'], PDO::PARAM_STR);
        $fechadesvinculacion = $datos['fechadesvinculacion'] == "" ? null : $datos['fechadesvinculacion'];
        $stmt->bindParam(":fechadesvinculacion", $fechadesvinculacion, PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $idsucursal = $datos['idsucursal'] == "" ? null : $datos['idsucursal'];
        $stmt->bindParam(":idsucursal", $idsucursal, PDO::PARAM_INT);
        $idmarca = $datos['idmarca'] == "" ? null : $datos['idmarca'];
        $stmt->bindParam(":idmarca", $idmarca, PDO::PARAM_INT);
        $idconvenio = $datos['idconvenio'] == "" ? null : $datos['idconvenio'];
        $stmt->bindParam(":idconvenio", $idconvenio, PDO::PARAM_INT);
        $idtipovehiculo = $datos['idtipovehiculo'] == "" ? null : $datos['idtipovehiculo'];
        $stmt->bindParam(":idtipovehiculo", $idtipovehiculo, PDO::PARAM_INT);

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
                                                WHERE pv.idvehiculo = :idvehiculo");

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
        $stmt = Conexion::conectar()->prepare("SELECT cv.*, c.nombre AS conductor
                                                FROM v_re_conductoresvehiculos cv
                                                INNER JOIN gh_personal c ON c.idPersonal = cv.idconductor
                                                WHERE cv.idvehiculo = :idvehiculo");

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
                                                WHERE d.idvehiculo = :idvehiculo");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       TIPOS DE DOCUMENTACIÓN VEHICULAR
    ===================================================*/
    static public function mdlTiposDocumentacion()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM v_tipodocumento");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       GUARDAR OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO, CONDUCTOR O DOCUMENTOS
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
}

/* ===================================================
   * BLOQUEO DE PERSONAL
===================================================*/
class ModeloBloqueoP
{

    static public function mdlUltimoBloqueo($value){

        if($value != null){

            $stmt = Conexion::conectar()->prepare(" SELECT p.Nombre AS conductor, b.motivo, b.estado, b.fecha, b.idbloqueo, p.idPersonal ,u.Nombre AS nomUsuario 
                                                    FROM v_bloqueopersonal b
                                                        INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                                        INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                        INNER JOIN 
                                                            (SELECT MAX(idbloqueo) AS idbloqueo FROM v_bloqueopersonal GROUP BY idPersonal) 
                                                                T ON b.idbloqueo = T.idbloqueo 
                                                                WHERE p.idPersonal = :personal");

            $stmt->bindParam(":personal",  $value, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();

        }else {

            $stmt = Conexion::conectar()->prepare(" SELECT p.Nombre AS conductor, b.motivo, b.estado, b.fecha, b.idbloqueo, p.idPersonal ,u.Nombre AS nomUsuario 
                                                    FROM v_bloqueopersonal b
                                                        INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                                        INNER JOIN l_usuarios u ON u.Cedula = b.usuario
                                                        INNER JOIN 
                                                            (SELECT MAX(idbloqueo) AS idbloqueo FROM v_bloqueopersonal GROUP BY idPersonal) 
                                                                T ON b.idbloqueo = T.idbloqueo");

            $stmt->execute();
            $retorno = $stmt->fetchAll();            
        }

        $stmt->closeCursor();
            return $retorno;      
    }


    static public function mdlHistorial($value){

        $stmt = Conexion::conectar()->prepare("SELECT p.Nombre AS conductor, b.motivo, b.estado, b.fecha, b.idbloqueo, 
                                                      u.Nombre AS nomUsuario 
                                                FROM v_bloqueopersonal b
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

    static public function mdlMostrarConductor($value){

        $stmt = Conexion::conectar()->prepare("SELECT p.nombre AS conductor 
                                               FROM v_bloqueopersonal b
                                                    INNER JOIN gh_personal p ON p.idPersonal = b.idPersonal
                                               WHERE b.idPersonal = :idper
                                               GROUP BY b.idPersonal");
        
        $stmt->bindParam(":idper",  $value, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlNuevoBloqueo($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO v_bloqueopersonal(idPersonal,motivo,estado,fecha,usuario)
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
    static public function mdlUltimoBloqueoV($value){

        if($value != null){

            $stmt = Conexion::conectar()->prepare(" SELECT b.*, v.placa
                                                    FROM v_bloqueovehiculo b
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
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

        }else {

            $stmt = Conexion::conectar()->prepare(" SELECT b.*, v.placa
                                                    FROM v_bloqueovehiculo b
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
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

    static public function mdlMostrarPlaca($value){

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

    static public function mdlNuevoBloqueoV($datos){

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

    static public function mdlHistorialV($value){

        $stmt = Conexion::conectar()->prepare("     SELECT b.*, v.placa AS placa
                                                    FROM v_bloqueovehiculo b
                                                    INNER JOIN v_vehiculos v ON v.idvehiculo = b.idvehiculo
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