<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION Y DE LAS VARIABLES GLOBALES
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/vehicular.controlador.php';
require_once '../models/vehicular.modelo.php';

/**
 * 
 */
class AjaxPropietarios
{

    static public function ajaxDatosPropietarios($cedula)
    {
        $respuesta = ModeloPropietarios::mdlMostrar($cedula);
        echo json_encode($respuesta);
    }
}

class AjaxConvenios
{
    static public function ajaxDatosConvenios($nit)
    {
        $respuesta = ModeloConvenios::mdlMostrar($nit);
        echo json_encode($respuesta);
    }
}

/* ===================================================
   * VEHICULOS
===================================================*/
class AjaxVehiculos
{
    /* ===================================================
       CARGAR DATOS DEL VEHICULO
    ===================================================*/
    static public function ajaxDatosVehiculo($item, $valor)
    {
        $datosVehiculo = ControladorVehiculos::ctrDatosVehiculo($item, $valor);
        $fotosVehiculo = ControladorVehiculos::ctrFotosVehiculo($item, $valor);
        $datos = [
            'datosVehiculo' => $datosVehiculo,
            'fotosVehiculo' => $fotosVehiculo
        ];
        echo json_encode($datos);
    }

    /* ===================================================
       GUARDAR DATOS DEL VEHICULO
    ===================================================*/
    static public function ajaxGuardarVehiculo($formData, $tarjetapropiedad, $foto_vehiculo)
    {
        $respuesta = ControladorVehiculos::ctrGuardarVehiculo($formData, $tarjetapropiedad, $foto_vehiculo);
        echo $respuesta;
    }

    /* ===================================================
       ELIMINAR UNA FOTO DEL VEHICULO
    ===================================================*/
    static public function ajaxEliminarFotoVehiculo($idfoto)
    {
        $datos = array(
            'tabla' => "v_fotosvehiculos",
            'item' => "idfoto",
            'valor' => $idfoto
        );
        $respuesta = ControladorVehiculos::ctrEliminarRegistro($datos);
        echo $respuesta;
    }

    /* ===================================================
	   ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
	===================================================*/
    /* ===================================================
       TABLA PROPIETARIOS
    ===================================================*/
    static public function ajaxTablaPropietarios($idvehiculo)
    {
        $Respuesta = ControladorVehiculos::ctrPropietariosxVehiculo($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarRegistro' tabla='v_re_propietariosvehiculos' idregistro='{$value['idpropietariovehiculo']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";

            $tr .= "
                <tr>
                        <td>" . $value['propietario'] . "</td>
                        <td>" . $value['participacion'] . "</td>
                        <td>" . $value['observacion'] . "</td>
                        <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       TABLA CONDUCTORES
    ===================================================*/
    static public function ajaxTablaConductores($idvehiculo)
    {
        $Respuesta = ControladorVehiculos::ctrConductoresxVehiculo($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarRegistro' tabla='v_re_conductoresvehiculos' idregistro='{$value['idconductorvehiculo']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";

            $tr .= "
                <tr>
                        <td>" . $value['conductor'] . "</td>
                        <td>" . $value['observacion'] . "</td>
                        <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       TABLA DOCUMENTOS
    ===================================================*/
    static public function ajaxTablaDocumentos($idvehiculo)
    {
        $Respuesta = ControladorVehiculos::ctrDocumentosxVehiculo($idvehiculo);
        $tr = "";
        foreach ($Respuesta as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarRegistro' tabla='v_re_documentosvehiculos' idregistro='{$value['iddocumento']}' idvehiculo='{$value['idvehiculo']}'><i class='fas fa-trash-alt'></i></button>";

            # Documento
            if ($value['ruta_documento'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
                $btnEliminarDoc = "<button class='btn btn-sm btn-danger m-1 btnEliminarDocVehiculo' idvehiculo='{$idvehiculo}' idregistro='{$value['iddocumento']}' type='button'><i class='fas fa-ban'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . $btnEliminarDoc . "</div>";
            } else {
                $btnSubirDoc = "<button class='btn btn-sm btn-secondary m-1 btnSubirDocVehiculo' idvehiculo='{$idvehiculo}' idregistro='{$value['iddocumento']}' type='button'><i class='fas fa-file-upload'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnSubirDoc . "</div>";
            }
            $tr .= "
                <tr>
                        <td>" . $value['tipodocumento'] . "</td>
                        <td>" . $value['nrodocumento'] . "</td>
                        <td>" . $value['fechainicio'] . "</td>
                        <td>" . $value['fechafin'] . "</td>
                        <td>" . $value['tarifa'] . "</td>
                        <td>$btnAccionesDoc</td>
                        <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       GUARDAR OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO, CONDUCTOR O DOCUMENTOS
    ===================================================*/
    static public function ajaxGuardarDetallesVehiculo($formData)
    {
        $respuesta = ControladorVehiculos::ctrGuardarDetallesVehiculo($formData);
        echo $respuesta;
    }

    /* ===================================================
       ELIMINAR REGISTRO DE PROPIETARIO, CONDUCTOR O DOCUMENTOS
    ===================================================*/
    static public function ajaxEliminarRegistro($idregistro, $tabla)
    {
        switch ($tabla) {
            case 'v_re_propietariosvehiculos':
                $item = "idpropietariovehiculo";
                break;

            case 'v_re_conductoresvehiculos':
                $item = "idconductorvehiculo";
                break;

            case 'v_re_documentosvehiculos':
                $item = "iddocumento";
                break;

            default:
                $item = "";
                break;
        }

        $datos = array(
            'tabla' => $tabla,
            'item' => $item,
            'valor' => $idregistro
        );
        $eliminarRegistro = ControladorVehiculos::ctrEliminarRegistro($datos);
        echo $eliminarRegistro;
    }

    /* ===================================================
       CARGAR DOCUMENTO DEL VEHICULO
    ===================================================*/
    static public function ajaxCargarDocumento($idvehiculo, $documento, $idregistro)
    {
        $response = "";

        $Vehiculo = ControladorVehiculos::ctrDatosVehiculo("idvehiculo", $idvehiculo);

        /* ===================== 
            CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ========================= */
        $anioActual = date("Y");

        # Verificar Directorio
        $directorio = DIR_APP . "views/docs/docsVehiculos/{$Vehiculo['placa']}";
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
        $GuardarArchivo->ruta = $directorio . "/{$idregistro}_{$fecha}_{$hora}";

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

            $datosRutaDoc = array(
                'tabla' => "v_re_documentosvehiculos",
                'item1' => 'ruta_documento',
                'valor1' => $rutaDoc,
                'item2' => "iddocumento",
                'valor2' => $idregistro
            );
            $actualizarRutaDoc = ModeloVehiculos::mdlActualizarVehiculo($datosRutaDoc);

            echo $actualizarRutaDoc;
        } else {
            echo "error";
        }
    }

    /* ===================================================
       ELIMINAR DOCUMENTO (Lo que hacemos es eliminar la ruta)
    ===================================================*/
    static public function ajaxEliminarDocumento($idregistro)
    {
        $tabla = "v_re_documentosvehiculos";
        $item2 = "iddocumento";
        # Actualizar el campo de documento como vacio
        $datosRutaDoc = array(
            'tabla' => $tabla,
            'item1' => 'ruta_documento',
            'valor1' => "",
            'item2' => $item2,
            'valor2' => $idregistro
        );
        $respuesta = ModeloVehiculos::mdlActualizarVehiculo($datosRutaDoc);
        echo $respuesta;
    }
}



# LLAMADOS A AJAX PROPIETARIOS
if (isset($_POST['DatosPropietarios']) && $_POST['DatosPropietarios'] == "ok") {
    AjaxPropietarios::ajaxDatosPropietarios($_POST['value']);
}
# LLAMADOS A AJAX CONVENIOS
if (isset($_POST['DatosConvenios']) && $_POST['DatosConvenios'] == "ok") {
    AjaxConvenios::ajaxDatosConvenios($_POST['value']);
}

# LLAMADOS A AJAX VEHICULOS
if (isset($_POST['GuardarVehiculo']) && $_POST['GuardarVehiculo'] == "ok") {
    $tarjetapropiedad = isset($_FILES['tarjetapropiedad']) ? $_FILES['tarjetapropiedad'] : "";
    $foto_vehiculo = isset($_FILES['foto_vehiculo']) ? $_FILES['foto_vehiculo'] : "";
    AjaxVehiculos::ajaxGuardarVehiculo($_POST, $tarjetapropiedad, $foto_vehiculo);
}

if (isset($_POST['DatosVehiculo']) && $_POST['DatosVehiculo'] == "ok") {
    AjaxVehiculos::ajaxDatosVehiculo($_POST['item'], $_POST['valor']);
}

if (isset($_POST['EliminarFotoVehiculo']) && $_POST['EliminarFotoVehiculo'] == "ok") {
    AjaxVehiculos::ajaxEliminarFotoVehiculo($_POST['idfoto']);
}

// ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
if (isset($_POST['TablaPropietarios']) && $_POST['TablaPropietarios'] == "ok") {
    AjaxVehiculos::ajaxTablaPropietarios($_POST['idvehiculo']);
}

if (isset($_POST['TablaConductores']) && $_POST['TablaConductores'] == "ok") {
    AjaxVehiculos::ajaxTablaConductores($_POST['idvehiculo']);
}

if (isset($_POST['TablaDocumentos']) && $_POST['TablaDocumentos'] == "ok") {
    AjaxVehiculos::ajaxTablaDocumentos($_POST['idvehiculo']);
}

if (isset($_POST['GuardarDetallesVehiculo']) && $_POST['GuardarDetallesVehiculo'] == "ok") {
    AjaxVehiculos::ajaxGuardarDetallesVehiculo($_POST);
}

if (isset($_POST['EliminarRegistro']) && $_POST['EliminarRegistro'] == "ok") {
    AjaxVehiculos::ajaxEliminarRegistro($_POST['idregistro'], $_POST['tabla']);
}

if (isset($_POST['CargarDocumentoVehiculo']) && $_POST['CargarDocumentoVehiculo'] == "ok") {
    if (isset($_FILES['documento'])) {
        AjaxVehiculos::ajaxCargarDocumento($_POST['idvehiculo'], $_FILES['documento'], $_POST['idregistro']);
    } else {
        echo "vacio";
    }
}

if (isset($_POST['EliminarDocumentoVehiculo']) && $_POST['EliminarDocumentoVehiculo'] == "ok") {
    AjaxVehiculos::ajaxEliminarDocumento($_POST['idregistro']);
}
