<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/usuarios.controlador.php';
require_once '../models/usuarios.modelo.php';

class AjaxUsuarios
{
    /* ===================================================
        VISUALIZAR DATOS DE UN USUARIO
    ===================================================*/
    static public function ajaxDatosUsuario($value)
    {
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($value);
        echo json_encode($respuesta);
    }

    /* ===================================================
       ACTIVAR USUARIO
    ===================================================*/
    static public function ajaxActivarUsuario($idUsuario, $value)
    {
        $tabla = "l_usuarios";

        $item1 = "estado"; //columna de la base de datos
        $valor1 = $value;

        $item2 = "UsuariosID";
        $valor2 = $idUsuario;

        # SOLICITAMOS DIRECTAMENTE AL MODELO 
        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

        echo $respuesta;
    }

     /* ===================================================
        RESTABLECER CONTRASEÑA
    ===================================================*/
    static public function ajaxRestablecerPswd($value)
    {
        $item = "Cedula";
        $respuesta = ControladorUsuarios::ctrRestablecerPswd($item, $value);
        echo $respuesta;
    }

     /* ===================================================
        CAMBIAR CONTRASEÑA
    ===================================================*/
    static public function AjaxCambiarPass($datos)
    {
        $respuesta = ControladorUsuarios::ctrCambiarPswd($datos);
        echo $respuesta;
    }
}

if (isset($_POST['DatosUsuario']) && $_POST['DatosUsuario'] == "ok") {
    AjaxUsuarios::ajaxDatosUsuario($_POST['value']);
}

/* ===================== 
  ACTIVAR USUARIO 
========================= */
if (isset($_POST['activarUsuario'])) {
    AjaxUsuarios::ajaxActivarUsuario($_POST['idUsuario'], $_POST['activarUsuario']);
}

/* ===================================================
   RESTABLECER CONTRASEÑA
===================================================*/
if (isset($_POST['RestablecerPswd']) && $_POST['RestablecerPswd'] == "ok"){
    AjaxUsuarios::ajaxRestablecerPswd($_POST['value']);
}

/* ===================================================
   CAMBIAR PASSWORD
===================================================*/
if (isset($_POST['CambiarPass']) && $_POST['CambiarPass'] == "ok"){
    $datos = array(
                'cedulaUsuario' => $_SESSION['cedula'],
                'passAnterior' => $_POST['passAnterior'],
                'passNueva' => $_POST['passNueva'],
                'confirmPass' => $_POST['confirmPass']
                );
    AjaxUsuarios::AjaxCambiarPass($datos);
}