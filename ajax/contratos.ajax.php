<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/conceptos.controlador.php';
require_once '../models/conceptos.modelo.php';


if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "larguese hacker, te estoy observando";
	die();
}

/* ===================================================
   * CLIENTES
===================================================*/
class AjaxClientes
{
    
}
/* ===================================================
   # LLAMADOS A AJAX CLIENTES
===================================================*/


/* ===================================================
   * COTIZACIONES
===================================================*/
class AjaxCotizaciones
{
    
}
/* ===================================================
   # LLAMADOS A AJAX COTIZACIONES
===================================================*/
