<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/gerencial.controlador.php';
require_once '../models/gerencial.modelo.php';
if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

/* ===================================================
   * GERENCIAL
===================================================*/
class AjaxGerencial
{
    /* ===================================================
       GESTION HUMANA - INGRESOS PERSONAL
    ===================================================*/
    static public function ajaxIngresosPersonal()
    {
        $respuesta = ControladorGerencial::ctrIngresosPersonal();
        echo json_encode($respuesta);
    }

    /* ===================================================
       VEHICULAR - TIPOS VEHICULOS
    ===================================================*/
    static public function ajaxTiposVehiculos()
    {
        $respuesta = ControladorGerencial::ctrTiposVehiculos();
        echo json_encode($respuesta);
    }

    /* ===================================================
       VIAJES OCASIONALES (por mes)
    ===================================================*/
    static public function ajaxViajesOcasionales()
    {
        $respuesta = ControladorGerencial::ctrViajesOcasionales();
        echo json_encode($respuesta);
    }

    /* ===================================================
       TIPOS CONTRATO (OCASIONAL O FIJO)
    ===================================================*/
    static public function ajaxTiposContrato()
    {
        $respuesta = ControladorGerencial::ctrTiposContrato();
        echo json_encode($respuesta);
    }
}

if (isset($_POST['IngresosPersonal']) && $_POST['IngresosPersonal'] == "ok") {
    AjaxGerencial::ajaxIngresosPersonal();
}

if (isset($_POST['TiposVehiculos']) && $_POST['TiposVehiculos'] == "ok") {
    AjaxGerencial::ajaxTiposVehiculos();
}

if (isset($_POST['ViajesOcasionales']) && $_POST['ViajesOcasionales'] == "ok") {
    AjaxGerencial::ajaxViajesOcasionales();
}

if (isset($_POST['TiposContrato']) && $_POST['TiposContrato'] == "ok") {
    AjaxGerencial::ajaxTiposContrato();
}