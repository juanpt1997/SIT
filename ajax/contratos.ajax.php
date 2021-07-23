<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/contratos.controlador.php';
require_once '../models/contratos.modelo.php';


if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
   echo "larguese hacker, te estoy observando";
   die();
}

/* ===================================================
   * CLIENTES
===================================================*/
class AjaxClientes
{
   static public function ajaxDatosClientes($documento)
   {
      $respuesta = ModeloClientes::mdlVerCliente($documento);
      echo json_encode($respuesta);
   }
}
/* ===================================================
   # LLAMADOS A AJAX CLIENTES
===================================================*/
if (isset($_POST['DatosClientes']) && $_POST['DatosClientes'] == "ok") {
   AjaxClientes::ajaxDatosClientes($_POST['value']);
}
/* ===================================================
   * COTIZACIONES
===================================================*/
class AjaxCotizaciones
{
   static public function ajaxDatosCotizaciones($documento)
   {
      $respuesta = ModeloCotizaciones::mdlVerCotizacion($documento);
      echo json_encode($respuesta);
   }
}
/* ===================================================
   # LLAMADOS A AJAX COTIZACIONES
===================================================*/
if (isset($_POST['DatosCotizaciones']) && $_POST['DatosCotizaciones'] == "ok") {
   AjaxCotizaciones::ajaxDatosCotizaciones($_POST['value']);
}