<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO

use PhpOffice\PhpSpreadsheet\Writer\Ods\Content;

include_once DIR_APP . 'config/conexion.php';


/* ===================================================
   * CLIENTES
===================================================*/
class ModeloClientes
{
    static public function mdlAgregarCliente($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO cont_clientes(nombre,tipo_doc,Documento,telefono,direccion,idciudad,tipo_docrespons,Documentorespons,
      cedula_expedidaen,nombrerespons,idciudadrespons,tipo,telefono2, correo, idsector, idtipificacion)
      VALUES(:nombre,:tipo_doc,:Documento,:telefono,:direccion,:idciudad,:tipo_docrespons,:Documentorespons,:cedula_expedidaen,:nombrerespons,:idciudadrespons,:tipo,:telefono2, :correo, :idsector, :idtipificacion)");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nom_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["t_document_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":Documento", $datos["docum_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telclient"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telclient2"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_docrespons", $datos["t_document_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":Documentorespons", $datos["docum_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":cedula_expedidaen", $datos["expedicion"], PDO::PARAM_INT);
        $stmt->bindParam(":nombrerespons", $datos["nom_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudadrespons", $datos["ciudadresponsable"], PDO::PARAM_INT);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idsector", $datos["tipo_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":idtipificacion", $datos["tipificacion"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    static public function mdlVerClienteid($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT C.*,  M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
                                                LEFT JOIN cont_cotizaciones Co ON C.idcliente = Co.idcliente
                                                WHERE C.{$datos['item']} = :{$datos['valor']}");


        /* $stmt->bindParam(":docum_empre", $datos['valor']);  */
        $stmt->bindParam(":{$datos['valor']}", $datos['valor']);
        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlVerCliente($datos, $tipo = "todos")
    {
        if ($tipo == "clientes") {
            $sqlExtra = "WHERE C.tipo = 'CLIENTE'";
        } else {
            $sqlExtra = "";
        }

        # VER DATOS DE UN SOLO CLIENTE
        // if ($datos != null) {
        //    $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida, Co.*
        //                                           FROM cont_clientes C
        //                                           LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
        //                                           LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
        //                                           LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
        //                                           LEFT JOIN cont_cotizaciones Co ON C.idcliente = Co.idcliente
        //                                           WHERE C.{$datos['item']} = :{$datos['valor']}");


        //    $stmt->bindParam(":{$datos['valor']}", $datos['valor']); 
        //    $stmt->execute();
        //    $retorno = $stmt->fetch();
        // }
        # VER LISTA DE CLIENTES

        $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida, CONCAT(C.nombre, ' - ', C.Documento) AS clientexist
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
                                                $sqlExtra");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarCliente($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_clientes set nombre = :nombre, tipo_doc=:tipo_doc,Documento=:Documento,telefono=:telefono,direccion=:direccion,
                                                      idciudad=:idciudad,tipo_docrespons=:tipo_docrespons,Documentorespons=:Documentorespons,cedula_expedidaen=:cedula_expedidaen,
                                                      nombrerespons=:nombrerespons,idciudadrespons=:idciudadrespons,telefono2=:telefono2, idsector = :idsector
											            WHERE idcliente = :idcliente");

        $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nom_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["t_document_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":Documento", $datos["docum_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telclient"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telclient2"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_docrespons", $datos["t_document_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":Documentorespons", $datos["docum_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":cedula_expedidaen", $datos["expedicion"], PDO::PARAM_INT);
        $stmt->bindParam(":nombrerespons", $datos["nom_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudadrespons", $datos["ciudadresponsable"], PDO::PARAM_INT);
        $stmt->bindParam(":idsector", $datos["tipo_cliente"], PDO::PARAM_INT);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /*---------------------------------------------
   -----------Agregar cliente desde cotizacion----
   ---------------------------------------------*/

    static public function mdlNuevoCliente($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO cont_clientes(nombre,tipo_doc,Documento,telefono,direccion,idciudad,tipo_docrespons,Documentorespons,
      cedula_expedidaen,nombrerespons,idciudadrespons)
      VALUES(:nombre,:tipo_doc,:Documento,:telefono,:direccion,:idciudad,:tipo_docrespons,:Documentorespons,:cedula_expedidaen,:nombrerespons,:idciudadrespons)");

        $stmt->bindParam(":nombre", $datos["nom_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["t_document_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":Documento", $datos["docum_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telclient"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_docrespons", $datos["t_document_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":Documentorespons", $datos["docum_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":cedula_expedidaen", $datos["expedicion"], PDO::PARAM_INT);
        $stmt->bindParam(":nombrerespons", $datos["nom_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudadrespons", $datos["ciudadresponsable"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $id;
    }

    static public function mdlActualizarCampo($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE {$datos['tabla']} SET {$datos['campo1']} = :{$datos['campo1']}
                                  WHERE {$datos['campo2']} = :{$datos['campo2']}");

        $stmt->bindParam(":" . $datos['campo1'], $datos['valor'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $datos['campo2'], $datos["id"], PDO::PARAM_INT);

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
      DATOS RUTA EXISTENTE
   ===================================================*/
    static public function mdlDatosRutaCliente($sql)
    {
        $stmt = Conexion::conectar()->prepare("SELECT rc.*, 
                                             r.idorigen, r.iddestino, r.nombreruta,
                                             m1.municipio AS origen,
                                             m2.municipio AS destino
                                             FROM o_re_rutasclientes rc
                                             INNER JOIN v_rutas r ON r.id = rc.idruta
                                             INNER JOIN gh_municipios m1 ON m1.idmunicipio = r.idorigen
                                             INNER JOIN gh_municipios m2 ON m2.idmunicipio = r.iddestino
                                                WHERE {$sql}");

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       TABLA RUTAS X CLIENTE
    ===================================================*/
    static public function mdlRutasxCliente($idcliente)
    {
        $stmt = Conexion::conectar()->prepare("SELECT rc.*, 
                                                c.nombre AS cliente,
                                                r.idorigen, r.iddestino, r.nombreruta,
                                                m1.municipio AS origen,
                                                m2.municipio AS destino,
                                                tv.tipovehiculo
                                                FROM o_re_rutasclientes rc
                                                INNER JOIN v_rutas r ON r.id = rc.idruta
                                                INNER JOIN cont_clientes c ON c.idcliente = rc.idcliente
                                                INNER JOIN gh_municipios m1 ON m1.idmunicipio = r.idorigen
                                                INNER JOIN gh_municipios m2 ON m2.idmunicipio = r.iddestino
                                                INNER JOIN v_tipovehiculos tv ON tv.idtipovehiculo = rc.idtipovehiculo
                                                WHERE rc.idcliente = :idcliente AND rc.estado = 1");

        $stmt->bindParam(":idcliente", $idcliente, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
      AGREGAR RUTA CLIENTE
   ===================================================*/
    static public function mdlAgregarRutaCliente($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO o_re_rutasclientes(idcliente,idruta,descripcion,idtipovehiculo, valor_recorrido)
                                             VALUES(:idcliente,:idruta,:descripcion,:idtipovehiculo, :valor_recorrido)");

        $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":idruta", $datos["idruta"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":idtipovehiculo", $datos["idtipovehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":valor_recorrido", $datos["valor_recorrido"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = $conexion->lastInsertId();
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }
    /* ===================================================
      EDITAR RUTA CLIENTE
   ===================================================*/
    static public function mdlEditarRutaCliente($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE o_re_rutasclientes SET idruta = :idruta, descripcion = :descripcion, idtipovehiculo = :idtipovehiculo, valor_recorrido = :valor_recorrido, estado = 1
                                 WHERE idrutacliente = :idrutacliente");

        $stmt->bindParam(":idrutacliente", $datos["idrutacliente"], PDO::PARAM_INT);
        /* $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT); */
        $stmt->bindParam(":idruta", $datos["idruta"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":idtipovehiculo", $datos["idtipovehiculo"], PDO::PARAM_INT);
        $stmt->bindParam(":valor_recorrido", $datos["valor_recorrido"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = $datos["idrutacliente"];
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }

    /* ===================================================
      ELIMINAR RUTA ASOCIADA
   ===================================================*/
    static public function mdlEliminarRutaCliente($idrutacliente)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE o_re_rutasclientes SET estado = 0
                                  WHERE idrutacliente = :idrutacliente");

        $stmt->bindParam(":idrutacliente", $idrutacliente, PDO::PARAM_INT);

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
      LISTAR TIPO DE CLIENTES 
   ===================================================*/
    static public function mdlTiposClientes()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM cont_sector WHERE estado = 1");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
      GUARDAR SEGUIMIENTO CLIENTE 
   ===================================================*/
    static public function mdlGuardarSeguimientoCliente($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO 
      cont_seguimiento_clientes(fecha_visita,idcliente,contacto,promedio_vehiculos,promedio_tarifa,proveedor,satisfacion,fecha_proxima,observaciones) 
      VALUES (:fecha_visita,:idcliente,:contacto,:promedio_vehiculos,:promedio_tarifa,:proveedor,:satisfacion,:fecha_proxima,:observaciones)");

        $stmt->bindParam(":fecha_visita", $datos['fecha_visita'], PDO::PARAM_STR);
        $stmt->bindParam(":idcliente", $datos['idcliente'], PDO::PARAM_INT);
        $stmt->bindParam(":contacto", $datos['contacto'], PDO::PARAM_STR);
        // $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
        // $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        // $stmt->bindParam(":correo", $datos['correo'], PDO::PARAM_STR);
        // $stmt->bindParam(":idtipo_vehiculo", $datos['idtipo_vehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":promedio_vehiculos", $datos['promedio_vehiculo'], PDO::PARAM_STR);
        $stmt->bindParam(":promedio_tarifa", $datos['promedio_tarifa'], PDO::PARAM_STR);
        $stmt->bindParam(":proveedor", $datos['proveedor'], PDO::PARAM_STR);
        $stmt->bindParam(":satisfacion", $datos['satisfacion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_proxima", $datos['fecha_proxima'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = $conexion->lastInsertId();
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /* ===================================================
      LISTA DE TIPIFICACION
   ===================================================*/
    static public function mdlListaTipificacion()
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM cont_tipificacion");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
      LISTA VISITAS CLIENTES 
   ===================================================*/
    static public function mdlVisitasClientes()
    {
        $stmt = Conexion::conectar()->prepare("SELECT v.*,DATE_FORMAT(v.fecha_visita,'%d/%m/%Y') AS Ffecha_visita,DATE_FORMAT(v.fecha_proxima,'%d/%m/%Y') AS Ffecha_proxima, c.*, s.tipo AS sector, ct.tipo AS tipificacion
      FROM cont_seguimiento_clientes v
      INNER JOIN cont_clientes c ON v.idcliente = c.idcliente
      -- INNER JOIN v_tipovehiculos tv ON v.idtipo_vehiculo = tv.idtipovehiculo
      LEFT JOIN cont_sector s ON s.id = c.idsector
      LEFT JOIN cont_tipificacion ct ON c.idtipificacion = ct.id 
      WHERE v.estado = 1
      ORDER BY v.fecha_proxima DESC");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
      DATOS SEGUIMIENTO CLIENTES X IDSEGUIMIENTO
   ===================================================*/
    static public function mdlDatosSeguimientoClientes($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT s.*, c.* FROM cont_seguimiento_clientes s
      INNER JOIN cont_clientes c ON s.idcliente = c.idcliente
      -- LEFT JOIN v_tipovehiculos vt ON s.idtipo_vehiculo = vt.idtipovehiculo
      WHERE s.idseguimiento = :idseguimiento");

        $stmt->bindParam(":idseguimiento", $datos['idseguimientoCliente'], PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
      EDITAR SEGUIMIENTO CLIENTES 
   ===================================================*/
    static public function mdlEditarSeguimientoCliente($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_seguimiento_clientes SET 
      fecha_visita =:fecha_visita,
      idcliente = :idcliente, contacto = :contacto,
      promedio_vehiculos = :promedio_vehiculos, promedio_tarifa = :promedio_tarifa, 
      proveedor =:proveedor, satisfacion = :satisfacion, fecha_proxima =:fecha_proxima, observaciones = :observaciones
      WHERE idseguimiento = :idseguimiento
      ");

        $stmt->bindParam(":fecha_visita", $datos['fecha_visita'], PDO::PARAM_STR);
        $stmt->bindParam(":idcliente", $datos['idcliente'], PDO::PARAM_INT);
        $stmt->bindParam(":contacto", $datos['contacto'], PDO::PARAM_STR);
        // $stmt->bindParam(":telefono", $datos['telefono'], PDO::PARAM_STR);
        // $stmt->bindParam(":direccion", $datos['direccion'], PDO::PARAM_STR);
        // $stmt->bindParam(":correo", $datos['correo'], PDO::PARAM_STR);
        // $stmt->bindParam(":idtipo_vehiculo", $datos['idtipo_vehiculo'], PDO::PARAM_INT);
        $stmt->bindParam(":promedio_vehiculos", $datos['promedio_vehiculo'], PDO::PARAM_STR);
        $stmt->bindParam(":promedio_tarifa", $datos['promedio_tarifa'], PDO::PARAM_STR);
        $stmt->bindParam(":proveedor", $datos['proveedor'], PDO::PARAM_STR);
        $stmt->bindParam(":satisfacion", $datos['satisfacion'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_proxima", $datos['fecha_proxima'], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos['observaciones'], PDO::PARAM_STR);
        $stmt->bindParam(":idseguimiento", $datos['idseguimiento'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      ELIMINAR SEGUIMIENTO CLIENTE 
   ===================================================*/
    static public function mdlEliminarSeguimientoCliente($idseguimiento)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_seguimiento_clientes SET estado = 0 WHERE idseguimiento = :idseguimiento");

        $stmt->bindParam(":idseguimiento", $idseguimiento, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      GUARDAR LLAMADA CLIENTE 
   ===================================================*/
    static public function mdlGuardarLlamada($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO cont_llamadas(fecha,idcliente,contacto,fecha_cita,hora,nombre_recibe,telefono_recibe,observacion) 
                                             VALUES(:fecha,:idcliente,:contacto,:fecha_cita,:hora,:nombre_recibe,:telefono_recibe,:observacion)");

        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":idcliente", $datos['idcliente'], PDO::PARAM_INT);
        // $stmt->bindParam(":telefono", $datos['telefono1'], PDO::PARAM_STR);
        $stmt->bindParam(":contacto", $datos['contacto'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_cita", $datos['fecha_cita'], PDO::PARAM_STR);
        $stmt->bindParam(":hora", $datos['hora'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_recibe", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_recibe", $datos['telefono2'], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      LISTA LLAMADAS CLIENTES 
   ===================================================*/
    static public function mdlListaLlamadas()
    {
        $stmt = Conexion::conectar()->prepare("SELECT l.*, c.*, DATE_FORMAT(l.fecha,'%d/%m/%Y') AS Ffecha, DATE_FORMAT(l.fecha_cita,'%d/%m/%Y') AS Ffecha_cita FROM cont_llamadas l 
      INNER JOIN cont_clientes c ON l.idcliente = c.idcliente
      WHERE l.estado = 1
      ORDER BY l.fecha DESC ");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
      DATOS DE LLAMADA POR ID 
   ===================================================*/
    static public function mdlDatosLlamada($id)
    {
        $stmt = Conexion::conectar()->prepare("SELECT l.*, c.idcliente, c.nombre, DATE_FORMAT(l.fecha,'%d/%m/%Y') AS Ffecha, DATE_FORMAT(l.fecha_cita,'%d/%m/%Y') AS Ffecha_cita FROM cont_llamadas l 
      INNER JOIN cont_clientes c ON l.idcliente = c.idcliente
      WHERE l.idseguimiento_llamada = :idseguimiento_llamada");

        $stmt->bindParam(":idseguimiento_llamada", $id, PDO::PARAM_INT);

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }

    /* ===================================================
      ELIMINAR LLAMADA 
   ===================================================*/
    static public function mdlEliminarLlamda($id)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_llamadas SET estado = 0 WHERE idseguimiento_llamada = :idseguimiento_llamada");

        $stmt->bindParam(":idseguimiento_llamada", $id, PDO::PARAM_INT);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      EDITAR LLAMADA
   ===================================================*/
    static public function mdlActualizarLlamada($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_llamadas SET fecha = :fecha,
      idcliente = :idcliente, contacto = :contacto, fecha_cita = :fecha_cita, hora = :hora,
      nombre_recibe = :nombre_recibe, telefono_recibe = :telefono_recibe, observacion = :observacion
      WHERE idseguimiento_llamada = :idseguimiento_llamada");

        $stmt->bindParam(":idseguimiento_llamada", $datos['idllamada'], PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(":idcliente", $datos['idcliente'], PDO::PARAM_INT);
        // $stmt->bindParam(":telefono", $datos['telefono1'], PDO::PARAM_STR);
        $stmt->bindParam(":contacto", $datos['contacto'], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_cita", $datos['fecha_cita'], PDO::PARAM_STR);
        $stmt->bindParam(":hora", $datos['hora'], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_recibe", $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_recibe", $datos['telefono2'], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos['observacion'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      ACTUALIZAR TIPIFICACION DEL CLIENTE 
   ===================================================*/
    static public function mdlActualizarTipificacion($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_clientes SET idtipificacion = :idtipificacion 
      WHERE idcliente = :idcliente");

        $stmt->bindParam(":idcliente", $datos['idcliente'], PDO::PARAM_INT);
        $stmt->bindParam(":idtipificacion", $datos['estado'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      ELIMINAMOS LOS VEHICULOS DE LA TABLA RELACIONAL 
   ===================================================*/
    static public function mdlEliminarTipoVehiculoxIdSeguimiento($id)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM cont_re_tipovehiculo v WHERE v.idseguimiento = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      AGREGAMOS VEHÍCULOS A LA TABLA RELACIONAL
   ===================================================*/
    static public function mdlGuardarTipoVehiculo($id, $vehiculo)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO cont_re_tipovehiculo(idseguimiento,idtipo_vehiculo) VALUES(:idseguimiento, :idtipo_vehiculo)");

        $stmt->bindParam(":idseguimiento", $id, PDO::PARAM_INT);
        $stmt->bindParam(":idtipo_vehiculo", $vehiculo, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
      LISTA DE VEHÍCULOS POR ID SEGUIMIENTO 
   ===================================================*/
    static public function mdlVehiculosxIdseguimiento($idseguimiento)
    {
        $stmt = Conexion::conectar()->prepare("SELECT r.*, v.* FROM cont_re_tipovehiculo r
      INNER JOIN v_tipovehiculos v ON r.idtipo_vehiculo = v.idtipovehiculo 
      WHERE r.idseguimiento = :idseguimiento");

        $stmt->bindParam(":idseguimiento", $idseguimiento, PDO::PARAM_INT);


        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();

        return $retorno;
    }
}

/* ===================================================
   * COTIZACIONES
===================================================*/
class ModeloCotizaciones
{
    static public function mdlAgregarCotizacion($datos)
    {
        //nomcontratante,Documento,direccion,telefono1,telefono2,nomcontacto,
        $stmt = Conexion::conectar()->prepare("INSERT INTO cont_cotizaciones(idcliente,empresa,idsucursal,
      origen,destino,descripcion,fecha_solicitud,fecha_solucion,fecha_inicio,fecha_fin,duracion,hora_salida,hora_recogida,idtipovehiculo,nro_vehiculos,
      capacidad,valorxvehiculo,valortotal,cotizacion,clasificacion,musica,aire,wifi,silleriareclinable,bano,bodega,otro,realiza_viaje,porque,nombre_con,documento_con,tipo_doc_con,tel_1,direccion_con,nombre_respo,tipo_doc_respo,cedula_expedicion,documento_res,ciudad_con,ciudad_res,tel_2,otro_v, idruta, viaje_ocasional,user_created,user_updated)
      VALUES(:idcliente,:empresa,:idsucursal,:origen,:destino,:descripcion,:fecha_solicitud,:fecha_solucion,:fecha_inicio,:fecha_fin,:duracion,:hora_salida,:hora_recogida,:idtipovehiculo,:nro_vehiculos,:capacidad,:valorxvehiculo,:valortotal,:cotizacion,:clasificacion,:musica,:aire,:wifi,:silleriareclinable,:bano,:bodega,:otro,:realiza_viaje,:porque,:nombre_con,:documento_con,:tipo_doc_con,:tel_1,:direccion_con,:nombre_respo,:tipo_doc_respo,:cedula_expedicion,:documento_res,:ciudad_con,:ciudad_res,:tel_2,:otro_v, :idruta, :viaje_ocasional,:user_created,:user_updated)");

        $stmt->bindParam(":documento_con", $datos["document"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc_con", $datos["t_document_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":tel_1", $datos["tel1"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_con", $datos["direcci"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_respo", $datos["nom_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc_respo", $datos["t_document_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":cedula_expedicion", $datos["expedicion"], PDO::PARAM_INT);
        $stmt->bindParam(":documento_res", $datos["docum_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad_con", $datos["ciudadcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":ciudad_res", $datos["ciudadresponsable"], PDO::PARAM_INT);
        $stmt->bindParam(":tel_2", $datos["tel2"], PDO::PARAM_STR);
        $stmt->bindParam(":otro_v", $datos["otro_v"], PDO::PARAM_STR);


        $stmt->bindParam(":idcliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_con", $datos["nom_contrata"], PDO::PARAM_STR);
        $stmt->bindParam(":empresa", $datos["empres"], PDO::PARAM_STR);
        $stmt->bindParam(":idsucursal", $datos["sucursalcot"], PDO::PARAM_INT);
        $stmt->bindParam(":origen", $datos["origin"], PDO::PARAM_STR);
        $stmt->bindParam(":destino", $datos["destin"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descrip"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_solicitud", $datos["f_sol"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_solucion", $datos["f_resuelve"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["f_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["f_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":duracion", $datos["durac"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_salida", $datos["h_salida"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_recogida", $datos["h_recog"], PDO::PARAM_STR);
        $stmt->bindParam(":idtipovehiculo", $datos["tipovehiculocot"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_vehiculos", $datos["n_vehiculos"], PDO::PARAM_INT);
        $stmt->bindParam(":capacidad", $datos["capaci"], PDO::PARAM_INT);
        $stmt->bindParam(":valorxvehiculo", $datos["valor_vel"], PDO::PARAM_INT);
        $stmt->bindParam(":valortotal", $datos["vtotal"], PDO::PARAM_INT);
        $stmt->bindParam(":cotizacion", $datos["cotiz"], PDO::PARAM_STR);
        $stmt->bindParam(":clasificacion", $datos["clasi_cot"], PDO::PARAM_STR);
        $stmt->bindParam(":musica", $datos["music"], PDO::PARAM_STR);
        $stmt->bindParam(":aire", $datos["air"], PDO::PARAM_STR);
        $stmt->bindParam(":wifi", $datos["wi_fi"], PDO::PARAM_STR);
        $stmt->bindParam(":silleriareclinable", $datos["silleteriar"], PDO::PARAM_STR);
        $stmt->bindParam(":bano", $datos["baño"], PDO::PARAM_STR);
        $stmt->bindParam(":bodega", $datos["bodeg"], PDO::PARAM_STR);
        $stmt->bindParam(":otro", $datos["another"], PDO::PARAM_STR);
        $stmt->bindParam(":realiza_viaje", $datos["realizav"], PDO::PARAM_STR);
        $stmt->bindParam(":porque", $datos["porque"], PDO::PARAM_STR);

        $stmt->bindParam(":idruta", $datos["idruta"], PDO::PARAM_INT);

        $stmt->bindParam(":viaje_ocasional", $datos["viaje_ocasional"], PDO::PARAM_STR);
        $stmt->bindParam(":user_created", $datos["usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos["usuario"], PDO::PARAM_INT);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlVerCotizacion($valor)
    {
        if ($valor != null) {
            // $stmt = Conexion::conectar()->prepare("SELECT C.*, S.sucursal AS sucursal, V.tipovehiculo AS tipo, Cl.*  FROM cont_cotizaciones C
            // LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
            // LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
            // INNER JOIN cont_clientes Cl ON C.idcliente = Cl.idcliente
            // WHERE  C.idcotizacion = :id_cot");
            $stmt = Conexion::conectar()->prepare("SELECT C.idcotizacion, C.idcliente, C.empresa, C.idsucursal, 
                                                ori.municipio AS origen,
                                                des.municipio AS destino,
                                                -- rt.nombreruta AS descripcion,
                                                IF (C.descripcion = '', rt.nombreruta, C.descripcion) AS descripcion,
                                                C.fecha_solicitud, C.fecha_solucion, C.fecha_inicio, C.fecha_fin, C.duracion, C.hora_salida, C.hora_recogida, C.idtipovehiculo, C.nro_vehiculos, C.capacidad, C.valorxvehiculo, C.valortotal, C.cotizacion, C.clasificacion, C.musica, C.aire, C.wifi, C.silleriareclinable, C.bano, C.bodega, C.otro, C.realiza_viaje, C.porque, C.nombre_con, C.documento_con, C.tipo_doc_con, C.tel_1, C.direccion_con, C.nombre_respo, C.tipo_doc_respo, C.cedula_expedicion, C.documento_res, C.ciudad_con, C.ciudad_res, C.tel_2, C.otro_v, C.idruta, C.viaje_ocasional,
                                                S.sucursal AS sucursal, 
                                                V.tipovehiculo AS tipo, 
                                                Cl.*
                                                FROM cont_cotizaciones C
                                                LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
                                                LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
                                                INNER JOIN cont_clientes Cl ON C.idcliente = Cl.idcliente
                                                LEFT JOIN v_rutas rt ON rt.id = C.idruta
                                                LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                                                LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                                                WHERE  C.idcotizacion = :id_cot");


            $stmt->bindParam(":id_cot",  $valor, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            // $stmt = Conexion::conectar()->prepare("SELECT C.*, S.sucursal AS sucursal, V.tipovehiculo AS tipov, Cl.*, CONCAT('ID: ',C.idcotizacion, ' - ',C.nombre_con) AS clientexist, m1.municipio AS ciudadcon, m2.municipio AS ciudadres, m3.municipio AS cedulaexpe
            // FROM cont_cotizaciones C
            // LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
            // LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
            // LEFT JOIN gh_municipios m1 ON C.ciudad_con = m1.idmunicipio
            // LEFT JOIN gh_municipios m2 ON C.ciudad_res = m2.idmunicipio
            // LEFT JOIN gh_municipios m3 ON C.cedula_expedicion = m3.idmunicipio
            // INNER JOIN cont_clientes Cl ON C.idcliente = Cl.idcliente");
            $stmt = Conexion::conectar()->prepare("SELECT C.idcotizacion, C.idcliente, 
                                                -- C.empresa, 
                                                e.razon_social AS empresa, 
                                                C.idsucursal, 
                                                -- ori.municipio AS origen,
                                                IF (C.idruta IS NULL, C.origen, ori.municipio) AS origen,
                                                -- des.municipio AS destino,
                                                IF (C.idruta IS NULL, C.destino, des.municipio) AS destino,
                                                -- rt.nombreruta AS descripcion,
                                                -- IF (C.idruta IS NULL, C.descripcion, rt.nombreruta) AS descripcion,
                                                IF (C.descripcion = '', rt.nombreruta, C.descripcion) AS descripcion,
                                                C.fecha_solicitud, C.fecha_solucion, C.fecha_inicio, C.fecha_fin, C.duracion, C.hora_salida, C.hora_recogida, C.idtipovehiculo, C.nro_vehiculos, C.capacidad, C.valorxvehiculo, C.valortotal, C.cotizacion, C.clasificacion, C.musica, C.aire, C.wifi, C.silleriareclinable, C.bano, C.bodega, C.otro, C.realiza_viaje, C.porque, C.nombre_con, C.documento_con, C.tipo_doc_con, C.tel_1, C.direccion_con, C.nombre_respo, C.tipo_doc_respo, C.cedula_expedicion, C.documento_res, C.ciudad_con, C.ciudad_res, C.tel_2, C.otro_v, C.idruta, C.viaje_ocasional,
                                                S.sucursal AS sucursal, V.tipovehiculo AS tipov, Cl.*, CONCAT('ID: ',C.idcotizacion, ' - ',C.nombre_con) AS clientexist, m1.municipio AS ciudadcon, m2.municipio AS ciudadres, m3.municipio AS cedulaexpe,
                                                u.Nombre AS usuarioCreacion
                                                FROM cont_cotizaciones C
                                                LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
                                                LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
                                                LEFT JOIN gh_municipios m1 ON C.ciudad_con = m1.idmunicipio
                                                LEFT JOIN gh_municipios m2 ON C.ciudad_res = m2.idmunicipio
                                                LEFT JOIN gh_municipios m3 ON C.cedula_expedicion = m3.idmunicipio
                                                LEFT JOIN v_rutas rt ON rt.id = C.idruta
                                                LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                                                LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                                                INNER JOIN cont_clientes Cl ON C.idcliente = Cl.idcliente
                                                LEFT JOIN l_usuarios u ON u.Cedula = C.user_created
                                                inner join empresa e on e.id = C.empresa
                                                ORDER BY C.user_created DESC");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarCotizacion($datos)
    {
        // nomcontratante=:nomcontratante,Documento=:Documento,direccion=:direccion,telefono1=:telefono1,telefono2=:telefono2,nomcontacto=:nomcontacto,
        $stmt = Conexion::conectar()->prepare("UPDATE cont_cotizaciones set 
      empresa=:empresa,idsucursal=:idsucursal,origen=:origen,destino=:destino,descripcion=:descripcion,fecha_solicitud=:fecha_solicitud,fecha_solucion=:fecha_solucion,fecha_inicio=:fecha_inicio,
      fecha_fin=:fecha_fin,duracion=:duracion,idcliente =:idcliente,hora_salida=:hora_salida,hora_recogida=:hora_recogida,idtipovehiculo=:idtipovehiculo,nro_vehiculos=:nro_vehiculos,
      capacidad=:capacidad,valorxvehiculo=:valorxvehiculo,valortotal=:valortotal,cotizacion=:cotizacion,clasificacion=:clasificacion,musica=:musica,aire=:aire,wifi=:wifi,
      silleriareclinable=:silleriareclinable,bano=:bano,bodega=:bodega,otro=:otro,realiza_viaje=:realiza_viaje,porque=:porque,nombre_con=:nombre_con,documento_con=:documento_con,tipo_doc_con=:tipo_doc_con,tel_1=:tel_1,direccion_con=:direccion_con,nombre_respo=:nombre_respo,tipo_doc_respo=:tipo_doc_respo,cedula_expedicion=:cedula_expedicion,documento_res=:documento_res,ciudad_con=:ciudad_con,ciudad_res=:ciudad_res,tel_2=:tel_2,otro_v=:otro_v,idruta=:idruta, viaje_ocasional=:viaje_ocasional, user_updated=:user_updated
		WHERE idcotizacion = :idcotizacion");

        $stmt->bindParam(":idcotizacion", $datos["id_cot"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_con", $datos["nom_contrata"], PDO::PARAM_STR);

        $stmt->bindParam(":documento_con", $datos["document"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc_con", $datos["t_document_empre"], PDO::PARAM_STR);
        $stmt->bindParam(":tel_1", $datos["tel1"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion_con", $datos["direcci"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_respo", $datos["nom_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc_respo", $datos["t_document_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":cedula_expedicion", $datos["expedicion"], PDO::PARAM_INT);
        $stmt->bindParam(":documento_res", $datos["docum_respo"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad_con", $datos["ciudadcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":ciudad_res", $datos["ciudadresponsable"], PDO::PARAM_INT);
        $stmt->bindParam(":tel_2", $datos["tel2"], PDO::PARAM_STR);

        $stmt->bindParam(":idcliente", $datos["id_cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":empresa", $datos["empres"], PDO::PARAM_STR);
        $stmt->bindParam(":idsucursal", $datos["sucursalcot"], PDO::PARAM_INT);
        $stmt->bindParam(":origen", $datos["origin"], PDO::PARAM_STR);
        $stmt->bindParam(":destino", $datos["destin"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descrip"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_solicitud", $datos["f_sol"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_solucion", $datos["f_resuelve"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["f_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["f_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":duracion", $datos["durac"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_salida", $datos["h_salida"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_recogida", $datos["h_recog"], PDO::PARAM_STR);
        $stmt->bindParam(":idtipovehiculo", $datos["tipovehiculocot"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_vehiculos", $datos["n_vehiculos"], PDO::PARAM_INT);
        $stmt->bindParam(":capacidad", $datos["capaci"], PDO::PARAM_INT);
        $stmt->bindParam(":valorxvehiculo", $datos["valor_vel"], PDO::PARAM_INT);
        $stmt->bindParam(":valortotal", $datos["vtotal"], PDO::PARAM_INT);
        $stmt->bindParam(":cotizacion", $datos["cotiz"], PDO::PARAM_STR);
        $stmt->bindParam(":clasificacion", $datos["clasi_cot"], PDO::PARAM_STR);
        $stmt->bindParam(":musica", $datos["music"], PDO::PARAM_STR);
        $stmt->bindParam(":aire", $datos["air"], PDO::PARAM_STR);
        $stmt->bindParam(":wifi", $datos["wi_fi"], PDO::PARAM_STR);
        $stmt->bindParam(":silleriareclinable", $datos["silleteriar"], PDO::PARAM_STR);
        $stmt->bindParam(":bano", $datos["baño"], PDO::PARAM_STR);
        $stmt->bindParam(":bodega", $datos["bodeg"], PDO::PARAM_STR);
        $stmt->bindParam(":otro", $datos["another"], PDO::PARAM_STR);
        $stmt->bindParam(":realiza_viaje", $datos["realizav"], PDO::PARAM_STR);
        $stmt->bindParam(":porque", $datos["porque"], PDO::PARAM_STR);
        $stmt->bindParam(":otro_v", $datos["otro_v"], PDO::PARAM_STR);

        $stmt->bindParam(":idruta", $datos["idruta"], PDO::PARAM_INT);

        $stmt->bindParam(":viaje_ocasional", $datos["viaje_ocasional"], PDO::PARAM_STR);
        $stmt->bindParam(":user_updated", $datos["usuario"], PDO::PARAM_INT);


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
   * FIJOS
===================================================*/
class ModeloFijos
{
    static public function mdlAgregarFijo($datos)
    {
        //,documento_escaneado//,:documento_escaneado
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO cont_fijos(idcliente,numcontrato,fecha_inicial,fecha_final, observaciones)
                                             VALUES(:idcliente,:numcontrato,:fecha_inicial,:fecha_final, :observaciones)");

        $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":numcontrato", $datos["numcontrato"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicial", $datos["fecha_inicial"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
        //$stmt->bindParam(":documento_escaneado", $datos["documento_escaneado"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = $conexion->lastInsertId();
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }

    static public function mdlVerFijos($valor)
    {
        if ($valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT F.*, C.nombre as nombre_cliente, C.Documento, C.telefono, C.direccion  FROM cont_fijos F
         INNER JOIN cont_clientes C ON F.idcliente = C.idcliente
         WHERE  F.idfijos = :idfjos");


            $stmt->bindParam(":idfjos",  $valor, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT F.*, C.nombre as nombre_cliente, C.Documento as nit  FROM cont_fijos F
         INNER JOIN cont_clientes C ON F.idcliente = C.idcliente
         ORDER BY F.created_at desc");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarFijos($datos)
    {
        //documento_escaneado=:documento_escaneado
        $stmt = Conexion::conectar()->prepare("UPDATE cont_fijos set idcliente = :idcliente, numcontrato=:numcontrato,fecha_inicial=:fecha_inicial,fecha_final=:fecha_final, documento_escaneado=:documento_escaneado, observaciones=:observaciones
											            WHERE idfijos = :idfijos");

        $stmt->bindParam(":idfijos", $datos["idfijos"], PDO::PARAM_INT);
        $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
        $stmt->bindParam(":numcontrato", $datos["numcontrato"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_inicial", $datos["fecha_inicial"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_final", $datos["fecha_final"], PDO::PARAM_STR);
        $stmt->bindParam(":documento_escaneado", $datos["documento_escaneado"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

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
      AGREGAR/ASOCIAR VEHICULO A CLIENTES
   ===================================================*/

    static public function mdlAgregarVehiculoCliente($idcliente, $idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO cont_clientesvehiculos (idcliente, idvehiculo) VALUES (:idcliente, :idvehiculo)");

        $stmt->bindParam(":idcliente", $idcliente, PDO::PARAM_INT);
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
      CONSULTAR LOS VEHÍCULOS  
   ===================================================*/
    static public function mdlConsultarVehiculoCliente($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT cv.* FROM cont_clientesvehiculos cv
      WHERE cv.idvehiculo = :idvehiculo");

        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);

        $stmt->execute();
        $respuesta = $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
      VEHICULOS PARA UN CLIENTE 
   ===================================================*/
    static public function mdlVehiculosxCliente($idcliente)
    {
        $stmt = Conexion::conectar()->prepare("SELECT vc.*, v.placa, v.numinterno, c.nombre FROM cont_clientesvehiculos vc
                                             INNER JOIN v_vehiculos v ON vc.idvehiculo = v.idvehiculo
                                             INNER JOIN cont_clientes c ON vc.idcliente = c.idcliente
                                             WHERE vc.idcliente = :idcliente");

        $stmt->bindParam(":idcliente", $idcliente, PDO::PARAM_INT);
        $stmt->execute();
        $respuesta = $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    /* ===================================================
      ELIMINAR VEHICULO X CLIENTE
   ===================================================*/
    static public function mdlEliminarVehiculoxCliente($idcliente, $idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM cont_clientesvehiculos cv WHERE cv.idcliente = :idcliente AND cv.idvehiculo = :idvehiculo;");

        $stmt->bindParam(":idcliente", $idcliente, PDO::PARAM_INT);
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

    /* ======================================================================
        SE TRAE EL MAYOR NÚMERO DE CONTRATO ENTRE FIJOS Y OCASIONALES 
    ======================================================================*/
    static public function mdlMaxNumeroContrato()
    {
        $stmt = Conexion::conectar()->prepare("SELECT MAX(numcontrato) AS numcontrato FROM(
         SELECT numcontrato FROM cont_fijos 
         		WHERE YEAR(fecha_inicial) =  YEAR(CURDATE())
                 UNION 
         SELECT nro_contrato AS numcontrato FROM cont_ordenservicio
         WHERE YEAR(fechacreacion) =  YEAR(CURDATE())
         ) AS numcontrato");

        $stmt->execute();
        $retorno = $stmt->fetch();
        $stmt->closeCursor();

        return $retorno;
    }
}
/* ===================================================
   * ORDEN DE SERVICIO
===================================================*/
class ModeloOrdenServicio
{
    static public function mdlAgregarOrden($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO cont_ordenservicio(idcotizacion,nro_contrato,nro_factura,fecha_facturacion,cancelada,cod_autoriz,user_created,user_updated)
      VALUES(:idcotizacion,:nro_contrato,:nro_factura,:fecha_facturacion,:cancelada,:cod_autoriz,:user_created,:user_updated)");

        $stmt->bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_contrato", $datos["nro_contrato"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_factura", $datos["nro_factura"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_facturacion", $datos["fecha_facturacion"], PDO::PARAM_STR);
        $stmt->bindParam(":cancelada", $datos["cancelada"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_autoriz", $datos["cod_autoriz"], PDO::PARAM_STR);
        $stmt->bindParam(":user_created", $datos["usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos["usuario"], PDO::PARAM_INT);
        //$stmt->bindParam(":viaje_ocasional", $datos["viaje_ocasional"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }

    static public function mdlVerOrden($valor)
    {

        // $stmt = Conexion::conectar()->prepare("SELECT C.*, 
        //                                           O.idorden, O.nro_contrato, O.nro_factura, O.fecha_facturacion, O.cancelada, O.cod_autoriz, 
        //                                           -- C.nombre_con, C.documento_con, C.direccion_con, C.tel_1, C.tel_2, C.nombre_respo, C.documento_res, C.cedula_expedicion, 
        //                                           cr.municipio AS ciudadrespons, 
        //                                           exped.municipio AS ciudad_cedula_expedidaen
        //                                        FROM cont_ordenservicio O
        //                                        LEFT JOIN cont_cotizaciones C ON O.idcotizacion = C.idcotizacion
        //                                        LEFT JOIN cont_clientes CL ON CL.idcliente = C.idcliente
        //                                        LEFT JOIN gh_municipios cr ON cr.idmunicipio = C.ciudad_res
        //                                        LEFT JOIN gh_municipios exped ON exped.idmunicipio = C.cedula_expedicion
        //                                        WHERE O.idorden = :idorden");
        $stmt = Conexion::conectar()->prepare("SELECT C.idcotizacion, C.idcliente, C.empresa, C.idsucursal, 
                                             -- ori.municipio AS origen,
                                             IF (C.idruta IS NULL, C.origen, ori.municipio) AS origen,
                                             -- des.municipio AS destino,
                                             IF (C.idruta IS NULL, C.destino, des.municipio) AS destino,
                                             -- rt.nombreruta AS descripcion,
                                             -- IF (C.idruta IS NULL, C.descripcion, rt.nombreruta) AS descripcion,
                                             IF (C.descripcion = '', rt.nombreruta, C.descripcion) AS descripcion,
                                             C.fecha_solicitud, C.fecha_solucion, C.fecha_inicio, C.fecha_fin, C.duracion, C.hora_salida, C.hora_recogida, C.idtipovehiculo, C.nro_vehiculos, C.capacidad, C.valorxvehiculo, C.valortotal, C.cotizacion, C.clasificacion, C.musica, C.aire, C.wifi, C.silleriareclinable, C.bano, C.bodega, C.otro, C.realiza_viaje, C.porque, C.nombre_con, C.documento_con, C.tipo_doc_con, C.tel_1, C.direccion_con, C.nombre_respo, C.tipo_doc_respo, C.cedula_expedicion, C.documento_res, C.ciudad_con, C.ciudad_res, C.tel_2, C.otro_v, C.idruta, 
                                             O.idorden, O.nro_contrato, O.nro_factura, O.fecha_facturacion, O.cancelada, O.cod_autoriz, C.viaje_ocasional, C.idcliente,
                                             -- C.nombre_con, C.documento_con, C.direccion_con, C.tel_1, C.tel_2, C.nombre_respo, C.documento_res, C.cedula_expedicion, 
                                             cr.municipio
                                             AS ciudadrespons, 
                                             exped.municipio AS ciudad_cedula_expedidaen
                                             FROM cont_ordenservicio O
                                             LEFT JOIN cont_cotizaciones C ON O.idcotizacion = C.idcotizacion
                                             LEFT JOIN cont_clientes CL ON CL.idcliente = C.idcliente
                                             LEFT JOIN gh_municipios cr ON cr.idmunicipio = C.ciudad_res
                                             LEFT JOIN gh_municipios exped ON exped.idmunicipio = C.cedula_expedicion
                                             LEFT JOIN v_rutas rt ON rt.id = C.idruta
                                             LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                                             LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                                             WHERE O.idorden = :idorden");

        $stmt->bindParam(":idorden",  $valor, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlVerListaOrden()
    {
        // $stmt = Conexion::conectar()->prepare("SELECT C.*, 
        //                                        O.idorden, O.nro_contrato, O.nro_factura, O.fecha_facturacion, O.cancelada, O.cod_autoriz, 
        //                                        C.nombre_con AS nomContrata, C.documento_con AS doContrata
        //                                        -- C.direccion_con, C.tel_1, C.tel_2, C.nombre_respo  
        //                                        FROM cont_ordenservicio O
        //                                        LEFT JOIN cont_cotizaciones C ON O.idcotizacion = C.idcotizacion
        //                                        LEFT JOIN cont_clientes CL ON CL.idcliente = C.idcliente");
        $stmt = Conexion::conectar()->prepare("SELECT C.idcotizacion, C.idcliente, C.empresa, C.idsucursal, 
                                             -- ori.municipio AS origen,
                                             IF (C.idruta IS NULL, C.origen, ori.municipio) AS origen,
                                             -- des.municipio AS destino,
                                             IF (C.idruta IS NULL, C.destino, des.municipio) AS destino,
                                             -- rt.nombreruta AS descripcion,
                                             IF (C.idruta IS NULL, C.descripcion, rt.nombreruta) AS descripcion,
                                             C.fecha_solicitud, C.fecha_solucion, C.fecha_inicio, C.fecha_fin, C.duracion, C.hora_salida, C.hora_recogida, C.idtipovehiculo, C.nro_vehiculos, C.capacidad, C.valorxvehiculo, C.valortotal, C.cotizacion, C.clasificacion, C.musica, C.aire, C.wifi, C.silleriareclinable, C.bano, C.bodega, C.otro, C.realiza_viaje, C.porque, C.nombre_con, C.documento_con, C.tipo_doc_con, C.tel_1, C.direccion_con, C.nombre_respo, C.tipo_doc_respo, C.cedula_expedicion, C.documento_res, C.ciudad_con, C.ciudad_res, C.tel_2, C.otro_v, C.idruta, 
                                             CL.correo,
                                             O.idorden, O.nro_contrato, O.nro_factura, O.fecha_facturacion, O.cancelada, O.cod_autoriz, C.viaje_ocasional,
                                             C.nombre_con AS nomContrata, C.documento_con AS doContrata,
                                             -- C.direccion_con, C.tel_1, C.tel_2, C.nombre_respo
                                             u.Nombre AS usuarioCreacion
                                             FROM cont_ordenservicio O
                                             LEFT JOIN cont_cotizaciones C ON O.idcotizacion = C.idcotizacion
                                             LEFT JOIN cont_clientes CL ON CL.idcliente = C.idcliente
                                             LEFT JOIN v_rutas rt ON rt.id = C.idruta
                                             LEFT JOIN gh_municipios AS ori ON ori.idmunicipio=rt.idorigen
                                             LEFT JOIN gh_municipios AS des ON des.idmunicipio=rt.iddestino
                                             LEFT JOIN l_usuarios u ON u.Cedula = O.user_created
                                             ORDER BY O.fechacreacion DESC");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarOrden($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE cont_ordenservicio set idcotizacion=:idcotizacion, nro_contrato=:nro_contrato, nro_factura=:nro_factura, fecha_facturacion=:fecha_facturacion, cancelada=:cancelada, cod_autoriz=:cod_autoriz,user_updated=:user_updated
											            WHERE idorden = :idorden");

        $stmt->bindParam(":idorden", $datos["idorden"], PDO::PARAM_INT);
        $stmt->bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_contrato", $datos["nro_contrato"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_factura", $datos["nro_factura"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_facturacion", $datos["fecha_facturacion"], PDO::PARAM_STR);
        $stmt->bindParam(":cancelada", $datos["cancelada"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_autoriz", $datos["cod_autoriz"], PDO::PARAM_STR);
        $stmt->bindParam(":user_updated", $datos["usuario"], PDO::PARAM_INT);
        //$stmt->bindParam(":viaje_ocasional", $datos["viaje_ocasional"], PDO::PARAM_STR);

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
