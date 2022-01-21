<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../models/mail.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

class AjaxCorreos
{
    static public function ajaxTablaCorreo($modulo)
    {
        $respuesta = ModeloCorreos::mdlListarCorreos($modulo);
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>  
				<td>{$value["idcorreo"]}</td>
				<td>{$value["correo"]}</td>
                <td>{$value["usuarioCrea"]}</td>
                <td>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Editar correo electrónico' idcorreo='{$value["idcorreo"]}' class='btn btn-sm bg-gradient-info btnEditarCorreo'><i class='fas fa-edit'></i></button>
                    </div>
                    <div class='btn-group' role='group' aria-label='Button group'>
                    <button title='Eliminar correo electrónico' idcorreo='{$value["idcorreo"]}' class='btn btn-sm bg-gradient-danger btnEliminarCorreo'><i class='fas fa-trash'></i></button>
                    </div>
                </td>
			</tr>
			";
		}
		echo $tr;
    }

    static public function ajaxDatosCorreo($idcorreo)
    {
        $respuesta = ModeloCorreos::mdlDatosCorreos($idcorreo);
        echo json_encode($respuesta);
    }

    static public function ajaxAgregarCorreo($correo,$modulo)
    {
        $datos = [
            'correo' => $correo,
            'modulo' => $modulo,
            'usuario' => $_SESSION['cedula']
        ];

        $respuesta = ModeloCorreos::mdlAgregarCorreo($datos);

        echo $respuesta;
    }

    static public function ajaxEditarCorreo($idcorreo,$correo)
    {
        $datos = [
            'correo' => $correo,
            'idcorreo' => $idcorreo,
            'usuario' => $_SESSION['cedula']
        ];

        $respuesta = ModeloCorreos::mdlEditarCorreo($datos);

        echo $respuesta;
    }

    static public function ajaxEliminarCorreo($idcorreo)
    {
        $datos = [
            'idcorreo' => $idcorreo,
            'usuario' => $_SESSION['cedula']
        ];

        $respuesta = ModeloCorreos::mdlEliminarCorreo($datos);

        echo $respuesta;
    }
}

if (isset($_POST['cargarTablaCorreos']) && $_POST['cargarTablaCorreos'] == "ok") {
    AjaxCorreos::ajaxTablaCorreo($_POST['modulo']);
}

if (isset($_POST['datosCorreo']) && $_POST['datosCorreo'] == "ok") {
    AjaxCorreos::ajaxDatosCorreo($_POST['id']);
}

if (isset($_POST['agregarCorreo']) && $_POST['agregarCorreo'] == "ok") {
    AjaxCorreos::ajaxAgregarCorreo($_POST['correo'],$_POST['modulo']);
}

if (isset($_POST['editarCorreo']) && $_POST['editarCorreo'] == "ok") {
    AjaxCorreos::ajaxEditarCorreo($_POST['id'],$_POST['correo']);
}

if (isset($_POST['eliminarCorreo']) && $_POST['eliminarCorreo'] == "ok") {
    AjaxCorreos::ajaxEliminarCorreo($_POST['id']);
}
