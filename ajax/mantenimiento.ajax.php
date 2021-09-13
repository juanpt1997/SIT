<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';

require_once '../controllers/mantenimiento.controlador.php';
require_once '../models/mantenimiento.modelo.php';

require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';

require_once '../models/conceptos.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

/* ===================================================
   * PROTOCOLO DE ALISTAMIENTO
===================================================*/
class AjaxAlistamiento
{
    /* ===================================================
       TABLA PROTOCOLO DE ALISTAMIENTO
    ===================================================*/
    static public function ajaxTablaAlistamiento()
    {
        # code...
    }

    /* ===================================================
       GUARDAR DATOS DEL ALISTAMIENTO
    ===================================================*/
    static public function ajaxGuardarAlistamiento($formData)
    {
        $respuesta = ControladorAlistamiento::ctrGuardarAlistamiento($formData);
        echo $respuesta;
        //echo json_encode($respuesta);
    }

    /* ===================================================
        TABLA DE EVIDENCIAS
    ===================================================*/
    static public function ajaxTablaEvidencias($idvehiculo)
    {
        $Respuesta = ControladorAlistamiento::ctrListaEvidencias($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            if ($value['ruta_foto'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_foto'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
            }
            $btnEditar = "<button type='button' class='btn btn-info btn-sm m-1 btn-editarRegistro' idregistro='{$value['idevidencia']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-edit'></i></button>";
            $btnEliminar = "<button type='button' class='btn btn-danger btn-sm m-1 eliminarRegistro' idregistro='{$value['idevidencia']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";
            $botonAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnEliminar . "</div>";

            $tr .= "
                <tr>
                        <td>" . $value['fecha'] . "</td>
                        <td>" . $btnVerDoc . "</td>
                        <td>" . $value['observaciones'] . "</td>
                        <td>" . $value['estado'] . "</td>
                        <td>" . $value['autor'] . "</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       GUARDAR EVIDENCIA
    ===================================================*/
    static public function ajaxGuardarEvidencia($formData, $documento)
    {
        $response = "";

        $Vehiculo = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $formData['idvehiculo']);

        /* ===================== 
            CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ========================= */
        # Verificar Directorio imagenes mantenimiento
        $directorio = DIR_APP . "views/img/imgMantenimiento";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        # Verificar Directorio Evidencias
        $directorio .= "/evidencias";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        # Verificar Directorio vehículo
        $directorio .= "/{$Vehiculo['placa']}";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755);
        }

        $fecha = date('Y-m-d');
        $hora = date('His');

        /* ===================================================
            GUARDAMOS EL ARCHIVO
        ===================================================*/
        $GuardarArchivo = new FilesController();
        $GuardarArchivo->file = $documento;
        $aleatorio = mt_rand(100, 999);
        $GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

        # Si es pdf
        if ($documento['type'] == "application/pdf") {
            $response = $GuardarArchivo->ctrPDFFiles();
        } else {
            # Si es una imagen
            if ($documento['type'] == "image/jpeg" || $documento['type'] == "image/png") {
                $response = $GuardarArchivo->ctrImages(null, null);
            }
        }

        # Actualizar el campo de la base de datos donde queda la ruta del archivo
        if ($response != "") {
            $rutaDoc = str_replace(DIR_APP, "", $response);

            //$actualizarRutaDoc = ModeloVehiculos::mdlActualizarVehiculo($datosRutaDoc);
            $datos = array(
                            'idvehiculo' => $formData['idvehiculo'],
                            'ruta_foto' => $rutaDoc,
                            'observaciones' => $formData['observaciones'],
                            'autor' => $_SESSION['cedula']
                            );
            $guardarEvidencia = ModeloAlistamiento::mdlGuardarEvidencia($datos);

            echo $guardarEvidencia;
        } else {
            echo "error";
        }
    }
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
            "tabla" => "m_proveedores",
            "item" => "estado",
            "valor" => "0",
            "id_tabla" => "id",
            "id" => $id
        );

        $respuesta = ModeloConceptosGH::mdlEliminar($datos);
        echo $respuesta;
    }
}

#Llamados ajax alistamiento
if (isset($_POST['GuardarAlistamiento']) && $_POST['GuardarAlistamiento'] == "ok") {
    AjaxAlistamiento::ajaxGuardarAlistamiento($_POST);
}

if (isset($_POST['TablaEvidencias']) && $_POST['TablaEvidencias'] == "ok") {
    AjaxAlistamiento::ajaxTablaEvidencias($_POST['idvehiculo']);
}

if (isset($_POST['GuardarEvidencia']) && $_POST['GuardarEvidencia'] == "ok") {
    AjaxAlistamiento::ajaxGuardarEvidencia($_POST, $_FILES['fotoEvidencia']);
}

#Llamados ajax proveedores
if (isset($_POST['DatosProveedor']) && $_POST['DatosProveedor'] == "ok") {
    AjaxProveedores::ajaxDatosProveedor($_POST['documento']);
}

if (isset($_POST['EliminarProveedor']) && $_POST['EliminarProveedor'] == "ok") {
    AjaxProveedores::ajaxEliminarProveedor($_POST['id']);
}
