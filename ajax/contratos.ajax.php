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
   static public function ajaxDatosClientes($item,$valor)
   {
      $datos = array(
			'item' => $item,
			'valor' => $valor
		);
      $respuesta = ModeloClientes::mdlVerCliente($datos);
      echo json_encode($respuesta);
   }

   static public function ajaxConvertirCliente($id)
   {
      $respuesta = ControladorClientes::ctrActualizarCampo($id);
      echo $respuesta;
   }

}
/* ===================================================
   # LLAMADOS A AJAX CLIENTES
===================================================*/
if (isset($_POST['DatosClientes']) && $_POST['DatosClientes'] == "ok") {
   AjaxClientes::ajaxDatosClientes($_POST['item'],$_POST['valor']);
}
if (isset($_POST['ConvertirCliente']) && $_POST['ConvertirCliente'] == "ok") {
   AjaxClientes::ajaxConvertirCliente($_POST['value']);
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

/* ===================================================
   * FIJOS
===================================================*/
class AjaxFijos
{
   static public function ajaxDatosFijos($idfijos)
   {
      $respuesta = ModeloFijos::mdlVerFijos($idfijos);
      echo json_encode($respuesta);
   }
}
/* ===================================================
   # LLAMADOS A AJAX FIJOS
===================================================*/
if (isset($_POST['DatosFijos']) && $_POST['DatosFijos'] == "ok") {
   AjaxFijos::ajaxDatosFijos($_POST['value']);
}
/* ===================================================
   * ORDEN DE SERVICIO
===================================================*/
class AjaxOrdenServico
{
   static public function ajaxDatosOrden($idorden)
   {
      $respuesta = ModeloOrdenServicio::mdlVerOrden($idorden);
      echo json_encode($respuesta);
   }  
}
/* ===================================================
   # LLAMADOS A AJAX ORDENES DE SERVICIO
===================================================*/
if (isset($_POST['DatosOrden']) && $_POST['DatosOrden'] == "ok") {
   AjaxOrdenServico::ajaxDatosOrden($_POST['value']);
}

