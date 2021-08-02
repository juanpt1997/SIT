<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';


/* ===================================================
   * FUEC
===================================================*/
class ModeloFuec
{
    /* ===================================================
       LISTA DE FUEC
    ===================================================*/
    static public function mdlListaFUEC()
    {
        $stmt = Conexion::conectar()->prepare("SELECT f.*, cl.nombre AS nomContratante, cl.Documento AS docContratante, cl.direccion AS direccion, cl.telefono AS telContratante, cl.nombrerespons, cl.Documentorespons, cl.telefono2 AS telrespons, v.placa, v.numinterno, v.tipovinculacion, oc.objetocontrato, c1.Nombre AS conductor1, c1.Documento AS docConductor1, c2.Nombre AS conductor2, c2.Documento AS docConductor2, c3.Nombre AS conductor3, c3.Documento AS docConductor3, fc.nombre AS ClienteFijo, u.Nombre AS usuarioCreacion
                                                FROM fuec f
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = f.idvehiculo
                                                INNER JOIN v_objetocontrato oc ON oc.idobjeto = f.idobjeto_contrato
                                                LEFT JOIN cont_ordenservicio o ON o.idorden = f.contratante
                                                LEFT JOIN cont_cotizaciones c ON c.idcotizacion = o.idcotizacion
                                                LEFT JOIN cont_clientes cl ON cl.idcliente = c.idcliente
                                                LEFT JOIN gh_personal c1 ON c1.idPersonal = f.idconductor1
                                                LEFT JOIN gh_personal c2 ON c2.idPersonal = f.idconductor2
                                                LEFT JOIN gh_personal c3 ON c3.idPersonal = f.idconductor3
                                                LEFT JOIN cont_fijos fj ON f.contratofijo = fj.idfijos
                                                LEFT JOIN cont_clientes fc ON fc.idcliente = fj.idcliente
                                                INNER JOIN l_usuarios u ON u.Cedula = f.usuario_creacion");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       DATOS DEL FUEC
    ===================================================*/
    static public function mdlDatosFUEC($datos)
    {

        $stmt = Conexion::conectar()->prepare("SELECT f.*, cl.Documento AS docContratante, cl.direccion AS direccion, cl.telefono AS telContratante, cl.nombrerespons, cl.Documentorespons, cl.telefono2 AS telrespons, cr.municipio AS ciudadrespons, exped.municipio AS ciudad_cedula_expedidaen
                                                FROM fuec f
                                                LEFT JOIN cont_ordenservicio o ON o.idorden = f.contratante
                                                LEFT JOIN cont_cotizaciones c ON c.idcotizacion = o.idcotizacion
                                                LEFT JOIN cont_clientes cl ON cl.idcliente = c.idcliente
                                                LEFT  JOIN gh_municipios cr ON cr.idmunicipio = CL.idciudadrespons
                                                LEFT JOIN gh_municipios exped ON exped.idmunicipio = CL.cedula_expedidaen
                                                WHERE f.{$datos['item']} = :{$datos['item']};");
        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       DATOS PDF FUEC
    ===================================================*/
    static public function mdlDatosPDFFUEC($idfuec)
    {

        $stmt = Conexion::conectar()->prepare("SELECT f.*, cl.nombre AS nomContratante, cl.Documento AS docContratante, cl.direccion AS direccion, cl.telefono AS telContratante, cl.nombrerespons, cl.Documentorespons, cl.telefono2 AS telrespons, v.placa, v.numinterno, v.tipovinculacion, v.modelo, vm.marca, tv.tipovehiculo, oc.objetocontrato, c1.Nombre AS conductor1, c1.Documento AS docConductor1, c2.Nombre AS conductor2, c2.Documento AS docConductor2, c3.Nombre AS conductor3, c3.Documento AS docConductor3, fc.nombre AS ClienteFijo, u.Nombre AS usuarioCreacion
                                                FROM fuec f
                                                INNER JOIN v_vehiculos v ON v.idvehiculo = f.idvehiculo
                                                INNER JOIN v_objetocontrato oc ON oc.idobjeto = f.idobjeto_contrato
                                                LEFT JOIN cont_ordenservicio o ON o.idorden = f.contratante
                                                LEFT JOIN cont_cotizaciones c ON c.idcotizacion = o.idcotizacion
                                                LEFT JOIN cont_clientes cl ON cl.idcliente = c.idcliente
                                                LEFT JOIN gh_personal c1 ON c1.idPersonal = f.idconductor1
                                                LEFT JOIN gh_personal c2 ON c2.idPersonal = f.idconductor2
                                                LEFT JOIN gh_personal c3 ON c3.idPersonal = f.idconductor3
                                                LEFT JOIN cont_fijos fj ON f.contratofijo = fj.idfijos
                                                LEFT JOIN cont_clientes fc ON fc.idcliente = fj.idcliente
                                                INNER JOIN l_usuarios u ON u.Cedula = f.usuario_creacion
                                                LEFT JOIN v_tipovehiculos tv ON tv.idtipovehiculo = v.idtipovehiculo
                                                LEFT JOIN v_marcas vm ON vm.idmarca = v.idmarca
                                                WHERE f.idfuec = $idfuec");
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       INSERTAR FUEC
    ===================================================*/
    static public function mdlAgregarFUEC($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO fuec (tipocontrato, contratofijo, contratante, idvehiculo, idconductor1, idconductor2, idconductor3, fecha_inicial, fecha_vencimiento, idobjeto_contrato, origen, destino, observaciones, precio, listado_pasajeros, estado_pago, valor_neto, estado_fuec, ruta_contrato, usuario_creacion) VALUES 
        (:tipocontrato, :contratofijo, :contratante, :idvehiculo, :idconductor1, :idconductor2, :idconductor3, :fecha_inicial, :fecha_vencimiento, :idobjeto_contrato, :origen, :destino, :observaciones, :precio, :listado_pasajeros, :estado_pago, :valor_neto, :estado_fuec, :ruta_contrato, :usuario_creacion)");

        $stmt->bindParam(":tipocontrato", $datos['tipocontrato'], PDO::PARAM_STR);
        $stmt->bindParam(":contratofijo", $datos['contratofijo'], PDO::PARAM_INT);
        $stmt->bindParam(":contratante", $datos['contratante'], PDO::PARAM_INT);
        $stmt->bindParam(":idvehiculo", $datos['vehiculofuec'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor1", $datos['conductor1'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor2", $datos['conductor2'], PDO::PARAM_INT);
        $stmt->bindParam(":idconductor3", $datos['conductor3'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicial", $datos['fechaini'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos['fechafin'], PDO::PARAM_STR);
        $stmt->bindParam(":idobjeto_contrato", $datos['objetocontrato'], PDO::PARAM_INT);
        $stmt->bindParam(":origen", $datos['origen'], PDO::PARAM_STR);
        $stmt->bindParam(":destino", $datos['destino'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observacionescontr'], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos['precio'], PDO::PARAM_INT);
        $stmt->bindParam(":listado_pasajeros", $datos['pasajeros'], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pago", $datos['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":valor_neto", $datos['valorneto'], PDO::PARAM_INT);
        $stmt->bindParam(":estado_fuec", $datos['estado_fuec'], PDO::PARAM_STR);
        $stmt->bindParam(":ruta_contrato", $datos['contratoadjunto'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_creacion", $datos['usuario_creacion'], PDO::PARAM_INT);

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
       DOCUMENTOS VENCIDOS DEL VEHICULO, esta consulta en realidad trae todos los documentos que puede tener un vehiculo (sin repetir) sin importar si está vencido o no
    ===================================================*/
    static public function mdlDocumentosVencidos($idvehiculo)
    {
        // $sql = "SELECT t.tipodocumento, IF(MAX(d.fechafin) >= CURDATE(), MAX(d.fechafin), NULL) AS fechafin FROM v_tipodocumento t
        //                                         LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
        //                                         WHERE d.idvehiculo = :idvehiculo OR d.idvehiculo IS NULL
        //                                         GROUP BY t.idtipo";
        $sql = "SELECT t.tipodocumento, IF(MAX(d.fechafin) >= CURDATE(), MAX(d.fechafin), NULL) AS fechafin
                FROM v_tipodocumento t
                LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                WHERE d.idvehiculo = :idvehiculo
                GROUP BY t.idtipo
                UNION ALL
                SELECT t.tipodocumento, NULL AS fechafin
                FROM v_tipodocumento t
                LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                WHERE t.tipodocumento NOT IN (
                                            SELECT t.tipodocumento
                                            FROM v_tipodocumento t
                                            LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                                            WHERE d.idvehiculo = :idvehiculo
                                            GROUP BY t.idtipo)
                GROUP BY t.idtipo;";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":idvehiculo",  $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       VERIFICAR PAGO SEGURIDAD SOCIAL DEL CONDUCTOR
    ===================================================*/
    static public function mdlConductorPagoSS($idpersonal)
    {
        $sql = "SELECT * FROM gh_fechas_segursoc f
                    INNER JOIN gh_re_personalsegursoc s ON s.idFechas = f.idFechas
                    WHERE CURDATE() BETWEEN f.fechaini AND f.fechafin AND idPersonal = :idpersonal";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":idpersonal",  $idpersonal, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       OBJETO DE CONTRATO
    ===================================================*/
    static public function mdlObjetosContrato()
    {
        $sql = "SELECT * FROM v_objetocontrato";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

}
