<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/usuarios.controlador.php';
require_once '../models/usuarios.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "<script>window.location = 'inicio';</script>";
	die();
}

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

    // /* ===================================================
    //     VISUALIZAR DATOS DE UN PERFIL
    // ===================================================*/

    // static public function ajaxDatosPerfiles($value)
    // {
    //     $respuesta =ModeloUsuarios::mdlListadoPerfiles();
    //     echo json_encode($respuesta);
    // }

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

     /* ===================================================
        DATOS DEL PERFIL
    ===================================================*/
    static public function AjaxDatosPerfil($idPerfil)
    {
        $respuesta = ControladorUsuarios::ctrDatosPerfil($idPerfil);
        echo json_encode($respuesta);
    }

    /* ===================================================
        ACTIVAR PERFIL
    ===================================================*/

    static public function AjaxActivarPerfil($idPerfil,$activo)
    {
        $respuesta = ControladorUsuarios::ctrActualizarPerfil($idPerfil, $activo);
        echo $respuesta;
    }

    /* ===================================================
        BORRAR PERFIL
    ===================================================*/

    static public function AjaxBorrarPerfil($idPerfil)
    {
        $respuesta = controladorUsuarios::ctrBorrarPerfil($idPerfil);
        echo $respuesta;
    }

     /* ===================================================
        AGREGAR PERMISOS DEL PERFIL
    ===================================================*/

    static public function AjaxAgregarPermisosRol($idPerfil)
    {
        $respuesta = ControladorUsuarios::ctrAgregarPermisosRol($idPerfil);
        echo $respuesta;
    }

    /* ===================================================
        CARGAR DATOS PERMISOS DEL PERFIL
    ===================================================*/

    static public function AjaxDatosPermisosRol($idPerfil)
    {
        $respuesta = ControladorUsuarios::ctrDatosPermisosRol($idPerfil);
        echo json_encode($respuesta);
        // echo $respuesta;
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

/* ===================================================
        CAPTURAR DATOS PARA EDITAR EL PERFIL
    ===================================================*/

if (isset($_POST['DatosPerfil']) && $_POST['DatosPerfil'] == "ok"){
    AjaxUsuarios::ajaxDatosPerfil($_POST['idPerfil']);
}

/* ===================================================
        ACTIVAR PERFIL
    ===================================================*/

if (isset($_POST['ActivarPerfil']) && $_POST['ActivarPerfil'] == "ok"){
    //AjaxUsuarios::ajaxDatosPerfil($_POST['idPerfil']);
    // echo $_POST['activo'];
    AjaxUsuarios::AjaxActivarPerfil($_POST['idPerfil'], $_POST['activo']);
}

/* ===================================================
        BORRADO LOGICO
    ===================================================*/

if(isset($_POST['Borrado']) && $_POST['Borrado'] == "ok"){
    AjaxUsuarios::AjaxBorrarPerfil($_POST['idPerfil']);
}


/* ===================================================
       PERMISOS ROL
    ===================================================*/

if(isset($_POST['permisosrol']) && $_POST['permisosrol'] == "ok"){
    AjaxUsuarios::AjaxAgregarPermisosRol($_POST['idPerfil']);
    // AjaxUsuarios::AjaxDatosPermisosRol($_POST['idPerfil']);
}

if(isset($_POST['Datosrol'])&& $_POST['Datosrol'] == "ok"){
    AjaxUsuarios::AjaxDatosPermisosRol($_POST['idPerfil']);
}