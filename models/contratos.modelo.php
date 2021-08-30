<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
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
      cedula_expedidaen,nombrerespons,idciudadrespons,tipo,telefono2)
      VALUES(:nombre,:tipo_doc,:Documento,:telefono,:direccion,:idciudad,:tipo_docrespons,:Documentorespons,:cedula_expedidaen,:nombrerespons,:idciudadrespons,:tipo,:telefono2)");

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

      if ($stmt->execute()) {
         $id = $conexion->lastInsertId();
      } else {
         $id = "error";
      }
      $stmt->closeCursor();
      $conexion = null;
      return $id;
   }

   static public function mdlVerCliente($datos, $tipo = "todos")
   {
      if ($tipo == "clientes") {
         $sqlExtra = "WHERE C.tipo = 'CLIENTE'";
      } else {
         $sqlExtra = "";
      }

      # VER DATOS DE UN SOLO CLIENTE
      if ($datos != null) {
         $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida, Co.*
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
                                                LEFT JOIN cont_cotizaciones Co ON C.idcliente = Co.idcliente
                                                WHERE C.{$datos['item']} = :{$datos['item']};");


         $stmt->bindParam(":{$datos['item']}",  $datos['valor']);
         $stmt->execute();
         $retorno =  $stmt->fetch();
      }
      # VER LISTA DE CLIENTES
      else {

         $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida, CONCAT(C.nombre, ' - ', C.Documento) AS clientexist
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
                                                $sqlExtra");

         $stmt->execute();
         $retorno =  $stmt->fetchAll();
      }
      $stmt->closeCursor();
      return $retorno;
   }

   static public function mdlEditarCliente($datos)
   {
      $stmt = Conexion::conectar()->prepare("UPDATE cont_clientes set nombre = :nombre, tipo_doc=:tipo_doc,Documento=:Documento,telefono=:telefono,direccion=:direccion,
                                                      idciudad=:idciudad,tipo_docrespons=:tipo_docrespons,Documentorespons=:Documentorespons,cedula_expedidaen=:cedula_expedidaen,
                                                      nombrerespons=:nombrerespons,idciudadrespons=:idciudadrespons,telefono2=:telefono2
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

   static public function mdlVerClienteExistente($valor)
   {
      if ($valor != null) {
         $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
                                                WHERE C.idcliente = :id");


         $stmt->bindParam(":id",  $valor, PDO::PARAM_STR);
         $stmt->execute();
         $retorno =  $stmt->fetch();
      } else {

         $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida, CONCAT(C.nombre, ' - ', C.Documento) AS clientexist
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio");

         $stmt->execute();
         $retorno =  $stmt->fetchAll();
      }
      $stmt->closeCursor();
      return $retorno;
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
      capacidad,valorxvehiculo,valortotal,cotizacion,clasificacion,musica,aire,wifi,silleriareclinable,bano,bodega,otro,realiza_viaje,porque,nombre_con,documento_con,tipo_doc_con,tel_1,direccion_con,nombre_respo,tipo_doc_respo,cedula_expedicion,documento_res,ciudad_con,ciudad_res,tel_2)
      VALUES(:idcliente,:empresa,:idsucursal,:origen,:destino,:descripcion,:fecha_solicitud,:fecha_solucion,:fecha_inicio,:fecha_fin,:duracion,:hora_salida,:hora_recogida,:idtipovehiculo,:nro_vehiculos,:capacidad,:valorxvehiculo,:valortotal,:cotizacion,:clasificacion,:musica,:aire,:wifi,:silleriareclinable,:bano,:bodega,:otro,:realiza_viaje,:porque,:nombre_con,:documento_con,:tipo_doc_con,:tel_1,:direccion_con,:nombre_respo,:tipo_doc_respo,:cedula_expedicion,:documento_res,:ciudad_con,:ciudad_res,:tel_2)");

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



      $stmt->bindParam(":idcliente", $datos["id_cliente"], PDO::PARAM_INT);
      $stmt->bindParam(":nombre_con", $datos["nom_contact"], PDO::PARAM_STR);
      $stmt->bindParam(":empresa", $datos["empres"], PDO::PARAM_STR);
      $stmt->bindParam(":idsucursal", $datos["sucursalcot"], PDO::PARAM_INT);
      $stmt->bindParam(":origen", $datos["origin"], PDO::PARAM_STR);
      $stmt->bindParam(":destino", $datos["destin"], PDO::PARAM_STR);
      $stmt->bindParam(":descripcion", $datos["des_sol"], PDO::PARAM_STR);
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
         $stmt = Conexion::conectar()->prepare("SELECT C.*, S.sucursal AS sucursal, V.tipovehiculo AS tipo, Cl.*  FROM cont_cotizaciones C
         LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
         LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
         INNER JOIN cont_clientes Cl ON C.idcliente = Cl.idcliente
         WHERE  C.idcotizacion = :id_cot");


         $stmt->bindParam(":id_cot",  $valor, PDO::PARAM_INT);
         $stmt->execute();
         $retorno =  $stmt->fetch();
      } else {

         $stmt = Conexion::conectar()->prepare("SELECT C.*, S.sucursal AS sucursal, V.tipovehiculo AS tipo, Cl.*, CONCAT('ID: ',C.idcotizacion, ' - ',C.nombre_con) AS clientexist  FROM cont_cotizaciones C
         LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
         LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
         INNER JOIN cont_clientes Cl ON C.idcliente = Cl.idcliente");

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
      silleriareclinable=:silleriareclinable,bano=:bano,bodega=:bodega,otro=:otro,realiza_viaje=:realiza_viaje,porque=:porque,nombre_con=:nombre_con,documento_con=:documento_con,tipo_doc_con=:tipo_doc_con,tel_1=:tel_1,direccion_con=:direccion_con,nombre_respo=:nombre_respo,tipo_doc_respo=:tipo_doc_respo,cedula_expedicion=:cedula_expedicion,documento_res=:documento_res,ciudad_con=:ciudad_con,ciudad_res=:ciudad_res,tel_2=:tel_2
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
      $stmt->bindParam(":descripcion", $datos["des_sol"], PDO::PARAM_STR);
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
         $stmt = Conexion::conectar()->prepare("SELECT F.*, C.nombre as nombre_cliente  FROM cont_fijos F
         INNER JOIN cont_clientes C ON F.idcliente = C.idcliente
         WHERE  F.idfijos = :idfjos");


         $stmt->bindParam(":idfjos",  $valor, PDO::PARAM_INT);
         $stmt->execute();
         $retorno =  $stmt->fetch();
      } else {

         $stmt = Conexion::conectar()->prepare("SELECT F.*, C.nombre as nombre_cliente  FROM cont_fijos F
         INNER JOIN cont_clientes C ON F.idcliente = C.idcliente
         ORDER BY F.idfijos");

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
}
/* ===================================================
   * ORDEN DE SERVICIO
===================================================*/
class ModeloOrdenServicio
{
   static public function mdlAgregarOrden($datos)
   {
      $stmt = Conexion::conectar()->prepare("INSERT INTO cont_ordenservicio(idcotizacion,nro_contrato,nro_factura,fecha_facturacion,cancelada,cod_autoriz)
      VALUES(:idcotizacion,:nro_contrato,:nro_factura,:fecha_facturacion,:cancelada,:cod_autoriz)");

      $stmt->bindParam(":idcotizacion", $datos["idcotizacion"], PDO::PARAM_INT);
      $stmt->bindParam(":nro_contrato", $datos["nro_contrato"], PDO::PARAM_INT);
      $stmt->bindParam(":nro_factura", $datos["nro_factura"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_facturacion", $datos["fecha_facturacion"], PDO::PARAM_STR);
      $stmt->bindParam(":cancelada", $datos["cancelada"], PDO::PARAM_STR);
      $stmt->bindParam(":cod_autoriz", $datos["cod_autoriz"], PDO::PARAM_STR);

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

      $stmt = Conexion::conectar()->prepare("SELECT C.*, O.idorden, O.nro_contrato, O.nro_factura, O.fecha_facturacion, O.cancelada, O.cod_autoriz, C.nombre_con, C.documento_con, C.direccion_con, C.tel_1, C.tel_2, C.nombre_respo, C.documento_res, C.cedula_expedicion, cr.municipio AS ciudadrespons, exped.municipio AS ciudad_cedula_expedidaen
                                             FROM cont_ordenservicio O
                                             LEFT JOIN cont_cotizaciones C ON O.idcotizacion = C.idcotizacion
                                             LEFT JOIN cont_clientes CL ON CL.idcliente = C.idcliente
                                             LEFT JOIN gh_municipios cr ON cr.idmunicipio = CL.idciudadrespons
                                             LEFT JOIN gh_municipios exped ON exped.idmunicipio = CL.cedula_expedidaen
                                             WHERE O.idorden = :idorden");

      $stmt->bindParam(":idorden",  $valor, PDO::PARAM_INT);
      $stmt->execute();
      $retorno =  $stmt->fetch();
      $stmt->closeCursor();
      return $retorno;
   }

   static public function mdlVerListaOrden()
   {
      $stmt = Conexion::conectar()->prepare("SELECT C.*, O.idorden, O.nro_contrato, O.nro_factura, O.fecha_facturacion, O.cancelada, O.cod_autoriz, C.nombre_con AS nomContrata, C.documento_con AS doContrata, C.direccion_con, C.tel_1, C.tel_2, C.nombre_respo  FROM cont_ordenservicio O
                                             LEFT JOIN cont_cotizaciones C ON O.idcotizacion = C.idcotizacion
                                             LEFT JOIN cont_clientes CL ON CL.idcliente = C.idcliente");

      $stmt->execute();
      $retorno =  $stmt->fetchAll();
      $stmt->closeCursor();
      return $retorno;
   }

   static public function mdlEditarOrden($datos)
   {
      $stmt = Conexion::conectar()->prepare("UPDATE cont_ordenservicio set nro_contrato=:nro_contrato, nro_factura=:nro_factura, fecha_facturacion=:fecha_facturacion, cancelada=:cancelada, cod_autoriz=:cod_autoriz
											            WHERE idorden = :idorden");

      $stmt->bindParam(":idorden", $datos["idorden"], PDO::PARAM_INT);
      $stmt->bindParam(":nro_contrato", $datos["nro_contrato"], PDO::PARAM_INT);
      $stmt->bindParam(":nro_factura", $datos["nro_factura"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_facturacion", $datos["fecha_facturacion"], PDO::PARAM_STR);
      $stmt->bindParam(":cancelada", $datos["cancelada"], PDO::PARAM_STR);
      $stmt->bindParam(":cod_autoriz", $datos["cod_autoriz"], PDO::PARAM_STR);

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
