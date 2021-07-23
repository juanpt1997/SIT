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
      $stmt = Conexion::conectar()->prepare("INSERT INTO cont_clientes(nombre,tipo_doc,Documento,telefono,direccion,idciudad,tipo_docrespons,Documentorespons,
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
         $retorno = "ok";
      } else {
         $retorno = "error";
      }

      $stmt->closeCursor();
      $stmt = null;

      return $retorno;
   }

   static public function mdlVerCliente($valor)
   {
      if ($valor != null) {
         $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida
                                                FROM cont_clientes C
                                                LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                LEFT JOIN gh_municipios Mr ON C.idciudadrespons = Mr.idmunicipio
                                                LEFT JOIN gh_municipios Mc ON C.cedula_expedidaen = Mc.idmunicipio
                                                WHERE C.Documento = :documento");


         $stmt->bindParam(":documento",  $valor, PDO::PARAM_STR);
         $stmt->execute();
         $retorno =  $stmt->fetch();
      } else {

         $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad, Mr.municipio AS ciudadres, Mc.municipio AS expedida
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

   static public function mdlEditarCliente($datos)
   {
      $stmt = Conexion::conectar()->prepare("UPDATE cont_clientes set nombre = :nombre, tipo_doc=:tipo_doc,Documento=:Documento,telefono=:telefono,direccion=:direccion,
                                                      idciudad=:idciudad,tipo_docrespons=:tipo_docrespons,Documentorespons=:Documentorespons,cedula_expedidaen=:cedula_expedidaen,
                                                      nombrerespons=:nombrerespons,idciudadrespons=:idciudadrespons
											            WHERE idcliente = :idcliente");

      $stmt->bindParam(":idcliente", $datos["idcliente"], PDO::PARAM_INT);
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
      $stmt = Conexion::conectar()->prepare("INSERT INTO cont_cotizaciones(nomcontratante,Documento,direccion,telefono1,telefono2,nomcontacto,empresa,idsucursal,
      origen,destino,descripcion,fecha_solicitud,fecha_solucion,fecha_inicio,fecha_fin,duracion,hora_salida,hora_recogida,idtipovehiculo,nro_vehiculos,
      capacidad,valorxvehiculo,valortotal,cotizacion,clasificacion,musica,aire,wifi,silleriareclinable,bano,bodega,otro,realiza_viaje,porque)
      VALUES(:nomcontratante,:Documento,:direccion,:telefono1,:telefono2,:nomcontacto,:empresa,:idsucursal,
      :origen,:destino,:descripcion,:fecha_solicitud,:fecha_solucion,:fecha_inicio,:fecha_fin,:duracion,:hora_salida,:hora_recogida,:idtipovehiculo,:nro_vehiculos,
      :capacidad,:valorxvehiculo,:valortotal,:cotizacion,:clasificacion,:musica,:aire,:wifi,:silleriareclinable,:bano,:bodega,:otro,:realiza_viaje,:porque)");

      $stmt->bindParam(":nomcontratante", $datos["nom_contrata"], PDO::PARAM_STR);
      $stmt->bindParam(":Documento", $datos["document"], PDO::PARAM_STR);
      $stmt->bindParam(":direccion", $datos["direcci"], PDO::PARAM_STR);
      $stmt->bindParam(":telefono1", $datos["tel1"], PDO::PARAM_STR);
      $stmt->bindParam(":telefono2", $datos["tel2"], PDO::PARAM_STR);
      $stmt->bindParam(":nomcontacto", $datos["nom_contact"], PDO::PARAM_STR);
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
         $stmt = Conexion::conectar()->prepare("SELECT C.*, S.sucursal AS sucursal, V.tipovehiculo AS tipo  FROM cont_cotizaciones C
         LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
         LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo
         WHERE  C.Documento = :cedula");


         $stmt->bindParam(":cedula",  $valor, PDO::PARAM_STR);
         $stmt->execute();
         $retorno =  $stmt->fetch();
      } else {

         $stmt = Conexion::conectar()->prepare("SELECT C.*, S.sucursal AS sucursal, V.tipovehiculo AS tipo  FROM cont_cotizaciones C
         LEFT JOIN gh_sucursales S ON C.idsucursal = S.ids
         LEFT JOIN v_tipovehiculos V ON C.idtipovehiculo = V.idtipovehiculo");

         $stmt->execute();
         $retorno =  $stmt->fetchAll();
      }
      $stmt->closeCursor();
      return $retorno;
   }

   static public function mdlEditarCotizacion($datos)
   {
      $stmt = Conexion::conectar()->prepare("UPDATE cont_cotizaciones set nomcontratante=:nomcontratante,Documento=:Documento,direccion=:direccion,telefono1=:telefono1,telefono2=:telefono2,nomcontacto=:nomcontacto,
      empresa=:empresa,idsucursal=:idsucursal,origen=:origen,destino=:destino,descripcion=:descripcion,fecha_solicitud=:fecha_solicitud,fecha_solucion=:fecha_solucion,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,duracion=:duracion,
      hora_salida=:hora_salida,hora_recogida=:hora_recogida,idtipovehiculo=:idtipovehiculo,nro_vehiculos=:nro_vehiculos,capacidad=:capacidad,valorxvehiculo=:valorxvehiculo,valortotal=:valortotal,cotizacion=:cotizacion,clasificacion=:clasificacion,
      musica=:musica,aire=:aire,wifi=:wifi,silleriareclinable=:silleriareclinable,bano=:bano,bodega=:bodega,otro=:otro,realiza_viaje=:realiza_viaje,porque=:porque

		WHERE idcotizacion = :idcotizacion");

      $stmt->bindParam(":idcotizacion", $datos["id_cot"], PDO::PARAM_INT);
      $stmt->bindParam(":nomcontratante", $datos["nom_contrata"], PDO::PARAM_STR);
      $stmt->bindParam(":Documento", $datos["document"], PDO::PARAM_STR);
      $stmt->bindParam(":direccion", $datos["direcci"], PDO::PARAM_STR);
      $stmt->bindParam(":telefono1", $datos["tel1"], PDO::PARAM_STR);
      $stmt->bindParam(":telefono2", $datos["tel2"], PDO::PARAM_STR);
      $stmt->bindParam(":nomcontacto", $datos["nom_contact"], PDO::PARAM_STR);
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
