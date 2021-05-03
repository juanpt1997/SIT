<?php
   # ZONA HORARIA
   date_default_timezone_set('America/Bogota');
   ob_start();

   /* ===================== 
   INCLUIMOS LA CONFIGURACION DE LAS SESIONES 
   ========================= */
   include  __DIR__ .  '/config.php';

/* ===================================================
       INDEX: Mostraremos la salida de las vistas al usuario y tambien a traves de el enviaremos las distintas acciones que el usuario envíe al controlador
    ===================================================*/

/* ===================================================
   CONTROLADORES DEL PROYECTO QUE REQUERIMOS
===================================================*/
require_once 'controllers/plantilla.controlador.php';
require_once 'controllers/usuarios.controlador.php';
require_once 'controllers/files.controlador.php';

/* ===================================================
   MODELOS DEL PROYECTO QUE REQUERIMOS
===================================================*/
require_once 'models/usuarios.modelo.php';

$plantilla = new ControladorPlantilla();
$plantilla->ctrTraerPlantilla();
