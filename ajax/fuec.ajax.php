<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/fuec.controlador.php';
require_once '../models/fuec.modelo.php';


if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "<script>window.location = 'inicio';</script>";
	die();
}

/* ===================================================
   * FUEC
===================================================*/
class AjaxFuec
{
    
}
/* ===================================================
   # LLAMADOS A AJAX FUEC
===================================================*/
