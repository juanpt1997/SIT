<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/compras.controlador.php';
require_once '../models/compras.modelo.php';
require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';
require_once '../models/conceptos.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

class AjaxProveedores
{
    static public function ajaxDatosProveedor($documento)
    {
        $respuesta = ModeloProveedores::mdlListarProveedores($documento);
        echo json_encode($respuesta);
    }

    static public function ajaxEliminarProveedor($id)
    {
        $datos = array(
            "tabla" => "c_proveedores",
            "item" => "estado",
            "valor" => "0",
            "id_tabla" => "id",
            "id" => $id
        );

        $respuesta = ModeloConceptosGH::mdlEliminar($datos);
        echo $respuesta;
    }

    static public function cargarSelectProveedor()
    {
        
        $respuesta = ModeloProveedores::mdlListarProveedores(null);
        $option = "<option value='' selected>Seleccione un proveedor </option>";

        foreach ($respuesta as $key => $value) {
            $option .= "<option value='{$value["id"]}'>{$value["razon_social"]} - {$value["documento"]}</option>";
        }
        echo $option;
    }

    static public function ajaxCargarDatosProveedor($id)
    {
        $respuesta = ModeloProveedores::mdlDatosproveedor($id);
        echo json_encode($respuesta);
    }
}

/* ===================================================
            LLAMADOS AJAX PROVEEDORES
====================================================*/
if (isset($_POST['DatosProveedor']) && $_POST['DatosProveedor'] == "ok") {
    AjaxProveedores::ajaxDatosProveedor($_POST['documento']);
}

if (isset($_POST['EliminarProveedor']) && $_POST['EliminarProveedor'] == "ok") {
    AjaxProveedores::ajaxEliminarProveedor($_POST['id']);
}

if (isset($_POST['cargarselectProveedor']) && $_POST['cargarselectProveedor'] == "ok") {
    AjaxProveedores::cargarSelectProveedor();
}

if (isset($_POST['cargarDatosProveedor']) && $_POST['cargarDatosProveedor'] == "ok") {
    AjaxProveedores::ajaxCargarDatosProveedor($_POST['id']);
}