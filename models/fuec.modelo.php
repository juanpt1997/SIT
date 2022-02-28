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
        // $stmt = Conexion::conectar()->prepare("SELECT f.*, 
        //                                         cl.nombre AS nomContratante, cl.Documento AS docContratante, cl.direccion AS direccion, cl.telefono AS telContratante, cl.nombrerespons, cl.Documentorespons, cl.telefono2 AS telrespons, 
        //                                         v.placa, v.numinterno, v.tipovinculacion, 
        //                                         s.sucursal,
        //                                         oc.objetocontrato, 
        //                                         c1.Nombre AS conductor1, c1.Documento AS docConductor1, 
        //                                         c2.Nombre AS conductor2, c2.Documento AS docConductor2, 
        //                                         c3.Nombre AS conductor3, c3.Documento AS docConductor3, 
        //                                         fc.nombre AS ClienteFijo, 
        //                                         u.Nombre AS usuarioCreacion
        //                                         FROM fuec f
        //                                         INNER JOIN v_vehiculos v ON v.idvehiculo = f.idvehiculo
        //                                         INNER JOIN v_objetocontrato oc ON oc.idobjeto = f.idobjeto_contrato
        //                                         LEFT JOIN cont_ordenservicio o ON o.idorden = f.contratante
        //                                         LEFT JOIN cont_cotizaciones c ON c.idcotizacion = o.idcotizacion
        //                                         LEFT JOIN cont_clientes cl ON cl.idcliente = c.idcliente
        //                                         LEFT JOIN gh_personal c1 ON c1.idPersonal = f.idconductor1
        //                                         LEFT JOIN gh_personal c2 ON c2.idPersonal = f.idconductor2
        //                                         LEFT JOIN gh_personal c3 ON c3.idPersonal = f.idconductor3
        //                                         LEFT JOIN cont_fijos fj ON f.contratofijo = fj.idfijos
        //                                         LEFT JOIN cont_clientes fc ON fc.idcliente = fj.idcliente
        //                                         LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
        //                                         INNER JOIN l_usuarios u ON u.Cedula = f.usuario_creacion");
        $stmt = Conexion::conectar()->prepare("SELECT f.idfuec, f.tipocontrato, f.contratofijo, f.contratante, f.idvehiculo, f.idconductor1, f.idconductor2, f.idconductor3, f.fecha_inicial, f.fecha_vencimiento, f.idobjeto_contrato, f.anotObjetoContrato,
                                                -- IF (f.idruta IS NULL, f.origen, ori.municipio) AS origen,
                                                f.origen,
                                                -- IF (f.idruta IS NULL, f.destino, des.municipio) AS destino,
                                                f.destino,
                                                -- IF (f.idruta IS NULL, f.observaciones, rt.nombreruta) AS observaciones,
                                                IF (f.observaciones = '', rt.nombreruta, f.observaciones) AS observaciones,
                                                f.precio, f.listado_pasajeros, f.estado_pago, f.valor_neto, f.estado_fuec, f.ruta_contrato, f.usuario_creacion, f.fecha_creacion, f.nro_contrato, f.idruta,
                                                cl.nombre AS nomContratante, cl.Documento AS docContratante, cl.direccion AS direccion, cl.telefono AS telContratante, cl.nombrerespons, cl.Documentorespons, cl.telefono2 AS telrespons, 
                                                v.placa, v.numinterno, v.tipovinculacion, 
                                                s.sucursal,
                                                oc.objetocontrato, 
                                                c1.Nombre AS conductor1, c1.Documento AS docConductor1, 
                                                c2.Nombre AS conductor2, c2.Documento AS docConductor2, 
                                                c3.Nombre AS conductor3, c3.Documento AS docConductor3, 
                                                fc.nombre AS ClienteFijo, 
                                                u.Nombre AS usuarioCreacion
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
                                                LEFT JOIN gh_sucursales s ON s.ids = v.idsucursal
                                                INNER JOIN l_usuarios u ON u.Cedula = f.usuario_creacion
                                                LEFT JOIN v_rutas rt ON rt.id = f.idruta
                                                LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                                                LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                                                order by fecha_creacion desc");
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
    static public function mdlDatosFUEC2($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT f.*
                                                FROM fuec f
                                                WHERE f.{$datos['item']} = :{$datos['item']};");
        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $FUEC = $stmt->fetch();
        $stmt->closeCursor();

        if ($FUEC === false) {
            return false;
        }

        $tipocontrato = $FUEC['tipocontrato'];

        if ($tipocontrato == "OCASIONAL") {
            $sql = "SELECT f.idfuec, f.tipocontrato, f.contratofijo, f.contratante, f.idvehiculo, f.idconductor1, f.idconductor2, f.idconductor3, f.fecha_inicial, f.fecha_vencimiento, f.idobjeto_contrato, f.anotObjetoContrato,
                        -- IF (f.idruta IS NULL, f.origen, ori.municipio) AS origen,
                        f.origen,
                        -- IF (f.idruta IS NULL, f.destino, des.municipio) AS destino,
                        f.destino,
                        -- IF (f.idruta IS NULL, f.observaciones, rt.nombreruta) AS observaciones,
                        IF (f.observaciones = '', rt.nombreruta, f.observaciones) AS observaciones,
                        f.precio, f.listado_pasajeros, f.estado_pago, f.valor_neto, f.estado_fuec, f.ruta_contrato, f.usuario_creacion, f.fecha_creacion, f.nro_contrato, f.idruta,
                        c.nombre_con AS nomContratante, c.documento_con AS docContratante, c.direccion_con AS direccion, c.tel_1 AS telContratante, c.nombre_respo AS nombrerespons, c.documento_res AS Documentorespons, c.tel_2 AS telrespons, 
                        v.placa, v.numinterno, v.tipovinculacion, v.modelo, 
                        vm.marca, 
                        tv.tipovehiculo,
                        (SELECT dv.nrodocumento FROM v_re_documentosvehiculos dv WHERE dv.idvehiculo = v.idvehiculo AND dv.idtipodocumento = 3 ORDER BY dv.fechacreacion DESC, dv.fechafin DESC LIMIT 1) AS tarjetaOperacion,
                        oc.objetocontrato, 
                        -- (SELECT ecn.nombre
                        --    FROM v_convenios cnv
                        --    INNER JOIN v_empresas_convenios ecn ON ecn.idxc = cnv.idcontratista
                        --    WHERE cnv.idvehiculo = v.idvehiculo
                        --    ORDER BY cnv.fecha_terminacion DESC
                        --    LIMIT 1) AS nomconvenio,

                        (SELECT emv.nombre FROM v_convenios cv
                            INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                            INNER JOIN v_empresas_convenios emv ON cv.idcontratista = emv.idxc
                            WHERE rec.idvehiculo = v.idvehiculo
                            ORDER BY cv.fecha_terminacion DESC 
                            LIMIT 1) AS nomconvenio,


                        c1.Nombre AS conductor1, c1.Documento AS docConductor1, 
                        lic1.nro_licencia AS licencia1, MAX(lic1.fecha_vencimiento) AS vigenciaLic1,
                        c2.Nombre AS conductor2, c2.Documento AS docConductor2, 
                        lic2.nro_licencia AS licencia2, MAX(lic2.fecha_vencimiento) AS vigenciaLic2,
                        c3.Nombre AS conductor3, c3.Documento AS docConductor3, 
                        lic3.nro_licencia AS licencia3, MAX(lic3.fecha_vencimiento) AS vigenciaLic3,
                        u.Nombre AS usuarioCreacion
                    FROM fuec f
                    INNER JOIN v_vehiculos v ON v.idvehiculo = f.idvehiculo
                    LEFT JOIN v_tipovehiculos tv ON tv.idtipovehiculo = v.idtipovehiculo
                    LEFT JOIN v_marcas vm ON vm.idmarca = v.idmarca
                    INNER JOIN v_objetocontrato oc ON oc.idobjeto = f.idobjeto_contrato
                    LEFT JOIN gh_personal c1 ON c1.idPersonal = f.idconductor1
                    LEFT JOIN gh_re_personallicencias lic1 ON lic1.idPersonal = c1.idPersonal
                    LEFT JOIN gh_personal c2 ON c2.idPersonal = f.idconductor2
                    LEFT JOIN gh_re_personallicencias lic2 ON lic2.idPersonal = c2.idPersonal
                    LEFT JOIN gh_personal c3 ON c3.idPersonal = f.idconductor3
                    LEFT JOIN gh_re_personallicencias lic3 ON lic3.idPersonal = c3.idPersonal
                    INNER JOIN l_usuarios u ON u.Cedula = f.usuario_creacion
                    LEFT JOIN cont_ordenservicio o ON o.idorden = f.contratante
                    LEFT JOIN cont_cotizaciones c ON c.idcotizacion = o.idcotizacion
                    LEFT JOIN cont_clientes cl ON cl.idcliente = c.idcliente
                    LEFT JOIN v_rutas rt ON rt.id = f.idruta
                    LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                    LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                    WHERE f.{$datos['item']} = :{$datos['item']}
                    GROUP BY idfuec";
        } else {
            $sql = "SELECT f.idfuec, f.tipocontrato, f.contratofijo, f.contratante, f.idvehiculo, f.idconductor1, f.idconductor2, f.idconductor3, f.fecha_inicial, f.fecha_vencimiento, f.idobjeto_contrato, f.anotObjetoContrato,
                        -- IF (f.idruta IS NULL, f.origen, ori.municipio) AS origen,
                        f.origen,
                        -- IF (f.idruta IS NULL, f.destino, des.municipio) AS destino,
                        f.destino,
                        -- IF (f.idruta IS NULL, f.observaciones, rt.nombreruta) AS observaciones,
                        IF (f.observaciones = '', rt.nombreruta, f.observaciones) AS observaciones,
                        f.precio, f.listado_pasajeros, f.estado_pago, f.valor_neto, f.estado_fuec, f.ruta_contrato, f.usuario_creacion, f.fecha_creacion, f.nro_contrato, f.idruta,
                        cl.nombre AS nomContratante, cl.Documento AS docContratante, cl.direccion AS direccion, cl.telefono AS telContratante, cl.nombrerespons, cl.Documentorespons, cl.telefono2 AS telrespons, 
                        v.placa, v.numinterno, v.tipovinculacion, v.modelo, 
                        vm.marca, 
                        tv.tipovehiculo,
                        (SELECT dv.nrodocumento FROM v_re_documentosvehiculos dv WHERE dv.idvehiculo = v.idvehiculo AND dv.idtipodocumento = 3 ORDER BY dv.fechacreacion DESC, dv.fechafin DESC LIMIT 1) AS tarjetaOperacion,
                        oc.objetocontrato, 
                        -- (SELECT ecn.nombre
                        --    FROM v_convenios cnv
                        --    INNER JOIN v_empresas_convenios ecn ON ecn.idxc = cnv.idcontratista
                        --    WHERE cnv.idvehiculo = v.idvehiculo
                        --    ORDER BY cnv.fecha_terminacion DESC
                        --    LIMIT 1) AS nomconvenio,                    
                        (SELECT emv.nombre FROM v_convenios cv
                            INNER JOIN v_re_convenios rec ON cv.idconvenio = rec.idconvenio
                            INNER JOIN v_empresas_convenios emv ON cv.idcontratista = emv.idxc
                            WHERE rec.idvehiculo = v.idvehiculo
                            ORDER BY cv.fecha_terminacion DESC 
                            LIMIT 1) AS nomconvenio,
                        c1.Nombre AS conductor1, c1.Documento AS docConductor1, 
                        lic1.nro_licencia AS licencia1, MAX(lic1.fecha_vencimiento) AS vigenciaLic1,
                        c2.Nombre AS conductor2, c2.Documento AS docConductor2, 
                        lic2.nro_licencia AS licencia2, MAX(lic2.fecha_vencimiento) AS vigenciaLic2,
                        c3.Nombre AS conductor3, c3.Documento AS docConductor3, 
                        lic3.nro_licencia AS licencia3, MAX(lic3.fecha_vencimiento) AS vigenciaLic3,
                        u.Nombre AS usuarioCreacion
                    FROM fuec f
                    INNER JOIN v_vehiculos v ON v.idvehiculo = f.idvehiculo
                    LEFT JOIN v_tipovehiculos tv ON tv.idtipovehiculo = v.idtipovehiculo
                    LEFT JOIN v_marcas vm ON vm.idmarca = v.idmarca
                    INNER JOIN v_objetocontrato oc ON oc.idobjeto = f.idobjeto_contrato
                    LEFT JOIN gh_personal c1 ON c1.idPersonal = f.idconductor1
                    LEFT JOIN gh_re_personallicencias lic1 ON lic1.idPersonal = c1.idPersonal
                    LEFT JOIN gh_personal c2 ON c2.idPersonal = f.idconductor2
                    LEFT JOIN gh_re_personallicencias lic2 ON lic2.idPersonal = c2.idPersonal
                    LEFT JOIN gh_personal c3 ON c3.idPersonal = f.idconductor3
                    LEFT JOIN gh_re_personallicencias lic3 ON lic3.idPersonal = c3.idPersonal
                    INNER JOIN l_usuarios u ON u.Cedula = f.usuario_creacion
                    LEFT JOIN cont_fijos fj ON fj.idfijos = f.contratofijo
                    LEFT JOIN cont_clientes cl ON cl.idcliente = fj.idcliente
                    LEFT JOIN v_rutas rt ON rt.id = f.idruta
                    LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                    LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                    WHERE f.{$datos['item']} = :{$datos['item']}
                    GROUP BY idfuec";
        }
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
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
        $stmt = $conexion->prepare("INSERT INTO fuec (tipocontrato, contratofijo, contratante, idvehiculo, idconductor1, idconductor2, idconductor3, fecha_inicial, fecha_vencimiento, idobjeto_contrato, anotObjetoContrato, origen, destino, observaciones, precio, listado_pasajeros, estado_pago, valor_neto, estado_fuec, usuario_creacion, nro_contrato, idruta, consecutivo) VALUES 
        (:tipocontrato, :contratofijo, :contratante, :idvehiculo, :idconductor1, :idconductor2, :idconductor3, :fecha_inicial, :fecha_vencimiento, :idobjeto_contrato, :anotObjetoContrato, :origen, :destino, :observaciones, :precio, :listado_pasajeros, :estado_pago, :valor_neto, :estado_fuec, :usuario_creacion, :nro_contrato, :idruta, :consecutivo)");

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
        $stmt->bindParam(":anotObjetoContrato", $datos['anotObjetoContrato'], PDO::PARAM_STR);
        $stmt->bindParam(":origen", $datos['origen'], PDO::PARAM_STR);
        $stmt->bindParam(":destino", $datos['destino'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observacionescontr'], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos['precio'], PDO::PARAM_INT);
        $stmt->bindParam(":listado_pasajeros", $datos['pasajeros'], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pago", $datos['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":valor_neto", $datos['valorneto'], PDO::PARAM_INT);
        $stmt->bindParam(":estado_fuec", $datos['estado_fuec'], PDO::PARAM_STR);
        //$stmt->bindParam(":ruta_contrato", $datos['contratoadjunto'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_creacion", $datos['usuario_creacion'], PDO::PARAM_INT);
        $stmt->bindParam(":nro_contrato", $datos['nro_contrato'], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":consecutivo", $datos['consecutivo'], PDO::PARAM_INT);

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
       EDITAR FUEC
    ===================================================*/
    static public function mdlEditarFUEC($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE fuec SET tipocontrato = :tipocontrato, contratofijo = :contratofijo, contratante = :contratante, idvehiculo = :idvehiculo, idconductor1 = :idconductor1, idconductor2 = :idconductor2, idconductor3 = :idconductor3, fecha_inicial = :fecha_inicial, fecha_vencimiento = :fecha_vencimiento, idobjeto_contrato = :idobjeto_contrato, anotObjetoContrato = :anotObjetoContrato, origen = :origen, destino = :destino, observaciones = :observaciones, precio = :precio, listado_pasajeros = :listado_pasajeros, estado_pago = :estado_pago, valor_neto = :valor_neto, estado_fuec = :estado_fuec, usuario_creacion = :usuario_creacion, nro_contrato = :nro_contrato, idruta = :idruta, consecutivo = :consecutivo
                                    WHERE idfuec = :idfuec");

        $stmt->bindParam(":idfuec", $datos['idfuec'], PDO::PARAM_INT);
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
        $stmt->bindParam(":anotObjetoContrato", $datos['anotObjetoContrato'], PDO::PARAM_STR);
        $stmt->bindParam(":origen", $datos['origen'], PDO::PARAM_STR);
        $stmt->bindParam(":destino", $datos['destino'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observacionescontr'], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos['precio'], PDO::PARAM_INT);
        $stmt->bindParam(":listado_pasajeros", $datos['pasajeros'], PDO::PARAM_STR);
        $stmt->bindParam(":estado_pago", $datos['estado'], PDO::PARAM_STR);
        $stmt->bindParam(":valor_neto", $datos['valorneto'], PDO::PARAM_INT);
        $stmt->bindParam(":estado_fuec", $datos['estado_fuec'], PDO::PARAM_STR);
        //$stmt->bindParam(":ruta_contrato", $datos['contratoadjunto'], PDO::PARAM_STR);
        $stmt->bindParam(":usuario_creacion", $datos['usuario_creacion'], PDO::PARAM_INT);
        $stmt->bindParam(":nro_contrato", $datos['nro_contrato'], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos['idruta'], PDO::PARAM_INT);
        $stmt->bindParam(":consecutivo", $datos['consecutivo'], PDO::PARAM_INT);


        if ($stmt->execute()) {
            $respuesta = $datos['idfuec'];
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    /* ===================================================
       DOCUMENTOS VENCIDOS DEL VEHICULO, esta consulta en realidad trae todos los documentos que puede tener un vehiculo (sin repetir) sin importar si está vencido o no
    ===================================================*/
    static public function mdlDocumentosVencidos($idvehiculo)
    {
        // $sql = "SELECT t.tipodocumento, IF(MAX(d.fechafin) >= CURDATE(), MAX(d.fechafin), NULL) AS fechafin
        //         FROM v_tipodocumento t
        //         LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
        //         WHERE d.idvehiculo = :idvehiculo
        //         GROUP BY t.idtipo
        //         UNION ALL
        //         SELECT t.tipodocumento, NULL AS fechafin
        //         FROM v_tipodocumento t
        //         LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
        //         WHERE t.tipodocumento NOT IN (
        //                                     SELECT t.tipodocumento
        //                                     FROM v_tipodocumento t
        //                                     LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
        //                                     WHERE d.idvehiculo = :idvehiculo
        //                                     GROUP BY t.idtipo)
        //         GROUP BY t.idtipo;";
        $sql = "SELECT t.tipodocumento, MAX(d.fechafin) AS fechafin, IF(MAX(d.fechafin) >= CURDATE(), 'bien', 'vencido') AS estado
                FROM v_tipodocumento t
                LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                WHERE d.idvehiculo = :idvehiculo
                GROUP BY t.idtipo
                UNION ALL
                SELECT t.tipodocumento, NULL AS fechafin, 'vencido' AS estado
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
       VERIFICAR PAGO SEGURIDAD SOCIAL DEL CONDUCTOR
    ===================================================*/
    static public function mdlConductorLicencia($idpersonal)
    {
        $sql = "SELECT IF(MAX(l.fecha_vencimiento) >= CURDATE(), MAX(l.fecha_vencimiento), NULL) AS fecha_vencimiento FROM gh_re_personallicencias l 
                WHERE l.idPersonal = :idpersonal";
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
        $sql = "SELECT * FROM v_objetocontrato WHERE estado = 1";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       NUMERO SIGUIENTE DE CONTRATO DEL FUEC CUANDO ES OCASIONAL
    ===================================================*/
    static public function mdlNumeroContrato($tipocontrato)
    {
        $sql = "SELECT MAX(f.nro_contrato) AS nro_contrato FROM fuec f 
                WHERE f.tipocontrato = :tipocontrato";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipocontrato",  $tipocontrato, PDO::PARAM_STR);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================== 
        ACTUALIZAR UN UNICO CAMPO DEL FUEC
	========================= */
    static public function mdlActualizarFUEC($datos)
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
        SE TRAE EL ÚLTIMO CONSECUTIVO DE UN FIJO
    ===================================================*/
    static public function mdlConsecutivo($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT f.consecutivo FROM fuec f
        WHERE f.contratofijo = :contratofijo AND f.tipocontrato = 'FIJO' 
        ORDER BY f.consecutivo DESC
        LIMIT 1");

        $stmt->bindParam(":contratofijo", $datos['contratofijo'], PDO::PARAM_INT);

        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();

        return $respuesta;
    }


     /* ===================================================
      SE TRAE EL MAYOR NÚMERO DE CONTRATO POR ID FIJO
    ===================================================*/
    static public function mdlMaxNumeroContratoxId($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT MAX(numcontrato) AS numcontrato FROM cont_fijos WHERE idfijos = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
        SE TRAE LOS NÚMEROS DE CONTRATO 
    ===================================================*/
    static public function mdlNumerosContrato()
    {
        $stmt = Conexion::conectar()->prepare("SELECT nro_contrato FROM fuec ");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    
}
