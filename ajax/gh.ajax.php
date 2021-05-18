<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/gh.controlador.php';
require_once '../models/gh.modelo.php';

class AjaxPersonal
{
    /* ===================================================
       GUARDAR DATOS DEL PERSONAL
    ===================================================*/
    static public function ajaxGuardarPersonal($formData)
    {
        $respuesta = ControladorGH::ctrGuardarPersonal($formData);
        echo $respuesta;
    }

    /* ===================================================
       CARGAR DATOS DEL EMPLEADO
    ===================================================*/
    static public function ajaxDatosEmpleado($idPersonal)
    {
        $respuesta = ControladorGH::ctrDatosEmpleado($idPersonal);
        echo json_encode($respuesta);
    }

    /* ===================================================
       ACTIVAR/DESACTIVAR PERSONAL
    ===================================================*/
    static public function ajaxCambiarEstado($idPersonal, $estadoActual)
    {
        $respuesta = ControladorGH::ctrCambiarEstado($idPersonal, $estadoActual);
        echo $respuesta;
    }
}

/* ===================================================
   LLAMADOS
===================================================*/
if (isset($_POST['GuardarPersonal']) && $_POST['GuardarPersonal'] == "ok"){
    AjaxPersonal::ajaxGuardarPersonal($_POST);
}

if (isset($_POST['DatosEmpleado']) && $_POST['DatosEmpleado'] == "ok"){
    AjaxPersonal::ajaxDatosEmpleado($_POST['idPersonal']);
}

if (isset($_POST['CambiarActivo']) && $_POST['CambiarActivo'] == "ok"){
    AjaxPersonal::ajaxCambiarEstado($_POST['idPersonal'], $_POST['estadoActual']);
}