<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/gh.controlador.php';
require_once '../models/gh.modelo.php';


/* ===================================================
   * PERSONAL
===================================================*/
class AjaxPersonal
{
    /* ===================================================
       GUARDAR DATOS DEL PERSONAL
    ===================================================*/
    static public function ajaxGuardarPersonal($formData, $foto)
    {
        $respuesta = ControladorGH::ctrGuardarPersonal($formData, $foto);
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

    /* ===================================================
       ? HIJOS
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR HIJOS
    ===================================================*/
    static public function ajaxGuardarHijos($formData)
    {
        $respuesta = ControladorGH::ctrGuardarHijos($formData);
        echo $respuesta;
    }

    /* ===================================================
        TABLA HIJOS
    ===================================================*/
    static public function ajaxTablaHijos($idPersonal)
    {
        $hijos = ControladorGH::ctrMostrarHijos($idPersonal);
        $tr = "";
        foreach ($hijos as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarHijo' idhijo='{$value['idhijo']}' idPersonal='{$value['idPersonal']}'><i class='fas fa-trash-alt'></i></button>";

            $tr .= "
                <tr>
                        <td>" . $value['Nombre'] . "</td>
                        <td>" . $value['fecha_nacimiento'] . "</td>
                        <td>" . $value['edad'] . "</td>
                        <td>" . $value['genero'] . "</td>
                        <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       ELIMINAR HIJO
    ===================================================*/
    static public function ajaxEliminarHijo($idhijo)
    {
        $datos = array(
            'tabla' => "gh_re_personalhijos",
            'item' => "idhijo",
            'valor' => $idhijo
        );
        $eliminarRegistro = ControladorGH::ctrEliminarRegistro($datos);
        echo $eliminarRegistro;
    }

    /* ===================================================
       ? CONTRATOS Y PRORROGAS
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR CONTRATOS Y PRORROGAS
    ===================================================*/
    static public function ajaxGuardarProrrogas($formData)
    {
        $respuesta = ControladorGH::ctrGuardarProrrogas($formData);
        echo $respuesta;
    }

    /* ===================================================
       TABLA CONTRATOS Y PRORROGAS
    ===================================================*/
    static public function ajaxTablaProrrogas($idPersonal)
    {
        $prorrogas = ControladorGH::ctrMostrarProrrogas($idPersonal);
        $tr = "";
        foreach ($prorrogas as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarProrroga' idprorroga='{$value['idprorroga']}' idPersonal='{$value['idPersonal']}'><i class='fas fa-trash-alt'></i></button>";

            # Documento
            if ($value['ruta_documento'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
                $btnEliminarDoc = "<button class='btn btn-sm btn-danger m-1 btnEliminarDoc' idPersonal='{$idPersonal}' idregistro='{$value['idprorroga']}' tipoDoc='contratos' type='button'><i class='fas fa-ban'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . $btnEliminarDoc . "</div>";
            } else {
                $btnSubirDoc = "<button class='btn btn-sm btn-secondary m-1 btnSubirDoc' idPersonal='{$idPersonal}' idregistro='{$value['idprorroga']}' tipoDoc='contratos' type='button'><i class='fas fa-file-upload'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnSubirDoc . "</div>";
            }

            $tr .= "
                <tr>
                    <td>" . $value['contrato'] . "</td>
                    <td>$btnAccionesDoc</td>
                    <td>" . $value['fecha_inicial'] . "</td>
                    <td>" . $value['fecha_fin'] . "</td>
                    <td>" . $value['meses_prorroga'] . "</td>
                    <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       ELIMINAR PRORROGA
    ===================================================*/
    static public function ajaxEliminarProrroga($idprorroga)
    {
        $datos = array(
            'tabla' => "gh_re_personalprorrogas",
            'item' => "idprorroga",
            'valor' => $idprorroga
        );
        $eliminarRegistro = ControladorGH::ctrEliminarRegistro($datos);
        echo $eliminarRegistro;
    }

    /* ===================================================
       ? LICENCIAS DE CONDUCCION
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR LICENCIAS DE CONDUCCION
    ===================================================*/
    static public function ajaxGuardarLicencias($formData)
    {
        $respuesta = ControladorGH::ctrGuardarLicencias($formData);
        echo $respuesta;
    }

    /* ===================================================
       TABLA LICENCIAS DE CONDUCCION
    ===================================================*/
    static public function ajaxTablaLicencias($idPersonal)
    {
        $Licencias = ControladorGH::ctrMostrarLicencias($idPersonal);
        $tr = "";
        foreach ($Licencias as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarLicencia' idlicencia='{$value['idlicencia']}' idPersonal='{$value['idPersonal']}'><i class='fas fa-trash-alt'></i></button>";

            # Documento
            if ($value['ruta_documento'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
                $btnEliminarDoc = "<button class='btn btn-sm btn-danger m-1 btnEliminarDoc' idPersonal='{$idPersonal}' idregistro='{$value['idlicencia']}' tipoDoc='licencias' type='button'><i class='fas fa-ban'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . $btnEliminarDoc . "</div>";
            } else {
                $btnSubirDoc = "<button class='btn btn-sm btn-secondary m-1 btnSubirDoc' idPersonal='{$idPersonal}' idregistro='{$value['idlicencia']}' tipoDoc='licencias' type='button'><i class='fas fa-file-upload'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnSubirDoc . "</div>";
            }

            $tr .= "
                <tr>
                    <td>" . $value['nro_licencia'] . "</td>
                    <td>" . $btnAccionesDoc . "</td>
                    <td>" . $value['fecha_expedicion'] . "</td>
                    <td>" . $value['fecha_vencimiento'] . "</td>
                    <td>" . $value['categoria'] . "</td>
                    <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       ELIMINAR LICENCIA
    ===================================================*/
    static public function ajaxEliminarLicencia($idlicencia)
    {
        $datos = array(
            'tabla' => "gh_re_personallicencias",
            'item' => "idlicencia",
            'valor' => $idlicencia
        );
        $eliminarRegistro = ControladorGH::ctrEliminarRegistro($datos);
        echo $eliminarRegistro;
    }

    /* ===================================================
       ? EXÁMENES MÉDICOS
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR EXÁMENES MÉDICOS
    ===================================================*/
    static public function ajaxGuardarExamenes($formData)
    {
        $respuesta = ControladorGH::ctrGuardarExamenes($formData);
        echo $respuesta;
    }

    /* ===================================================
       TABLA EXÁMENES MÉDICOS
    ===================================================*/
    static public function ajaxTablaExamenes($idPersonal)
    {
        $Examenes = ControladorGH::ctrMostrarExamenes($idPersonal);
        $tr = "";
        foreach ($Examenes as $key => $value) {
            $btnEliminar = "<button type='button' class='btn btn-danger eliminarExamen' idexamen='{$value['idexamen']}' idPersonal='{$value['idPersonal']}'><i class='fas fa-trash-alt'></i></button>";

            # Documento
            if ($value['ruta_documento'] != null) {
                $btnVerDoc = "<a href='" . URL_APP . $value['ruta_documento'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
                $btnEliminarDoc = "<button class='btn btn-sm btn-danger m-1 btnEliminarDoc' idPersonal='{$idPersonal}' idregistro='{$value['idexamen']}' tipoDoc='examenes' type='button'><i class='fas fa-ban'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnVerDoc . $btnEliminarDoc . "</div>";
            } else {
                $btnSubirDoc = "<button class='btn btn-sm btn-secondary m-1 btnSubirDoc' idPersonal='{$idPersonal}' idregistro='{$value['idexamen']}' tipoDoc='examenes' type='button'><i class='fas fa-file-upload'></i></button>";
                $btnAccionesDoc = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnSubirDoc . "</div>";
            }

            $tr .= "
                <tr>
                    <td>" . $btnAccionesDoc . "</td>
                    <td>" . $value['tipo_examen'] . "</td>
                    <td>" . $value['fecha_inicial'] . "</td>
                    <td>" . $value['fecha_final'] . "</td>
                    <td>$btnEliminar</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       ELIMINAR EXAMEN
    ===================================================*/
    static public function ajaxEliminarExamen($idexamen)
    {
        $datos = array(
            'tabla' => "gh_re_personalexamenes",
            'item' => "idexamen",
            'valor' => $idexamen
        );
        $eliminarRegistro = ControladorGH::ctrEliminarRegistro($datos);
        echo $eliminarRegistro;
    }

    /* ===================================================
       ? CARGAR DOCUMENTO
    ===================================================*/
    static public function ajaxCargarDocumento($idPersonal, $documento, $tipoDoc, $idregistro)
    {
        $response = "";

        //$Empleado = ControladorGH::ctrDatosEmpleado($idPersonal);

        /* ===================== 
            CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR EL ARCHIVO
        ========================= */
        $anioActual = date("Y");

        # Verificar Directorio
        $directorio = DIR_APP . "views/docs/personal/$tipoDoc/" . strval($idPersonal);
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

            # Escoger la tabla en la que va
            switch ($tipoDoc) {
                case 'examenes':
                    $tabla = "gh_re_personalexamenes";
                    $item2 = "idexamen";
                    break;

                case 'licencias':
                    $tabla = "gh_re_personallicencias";
                    $item2 = "idlicencia";
                    break;

                case 'contratos':
                    $tabla = "gh_re_personalprorrogas";
                    $item2 = "idprorroga";
                    break;

                default:
                    $tabla = "";
                    $item2 = "";
                    break;
            }
            $datosRutaDoc = array(
                'tabla' => $tabla,
                'item1' => 'ruta_documento',
                'valor1' => $rutaDoc,
                'item2' => $item2,
                'valor2' => $idregistro
            );
            $actualizarRutaDoc = ModeloGH::mdlActualizarEmpleado($datosRutaDoc);

            echo $actualizarRutaDoc;
        } else {
            echo "error";
        }
    }

    /* ===================================================
       ELIMINAR DOCUMENTO
    ===================================================*/
    static public function ajaxEliminarDocumento($idregistro, $tipoDoc)
    {
        # Escoger la tabla en la que va
        switch ($tipoDoc) {
            case 'examenes':
                $tabla = "gh_re_personalexamenes";
                $item2 = "idexamen";
                break;

            case 'licencias':
                $tabla = "gh_re_personallicencias";
                $item2 = "idlicencia";
                break;

            case 'contratos':
                $tabla = "gh_re_personalprorrogas";
                $item2 = "idprorroga";
                break;

            default:
                $tabla = "";
                $item2 = "";
                break;
        }

        # Actualizar el campo de documento como vacio
        $datosRutaDoc = array(
            'tabla' => $tabla,
            'item1' => 'ruta_documento',
            'valor1' => "",
            'item2' => $item2,
            'valor2' => $idregistro
        );
        $respuesta = ModeloGH::mdlActualizarEmpleado($datosRutaDoc);
        echo $respuesta;
    }
}

/* ===================================================
   LLAMADOS
===================================================*/
if (isset($_POST['GuardarPersonal']) && $_POST['GuardarPersonal'] == "ok") {
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : "";
    AjaxPersonal::ajaxGuardarPersonal($_POST, $foto);
}

if (isset($_POST['DatosEmpleado']) && $_POST['DatosEmpleado'] == "ok") {
    AjaxPersonal::ajaxDatosEmpleado($_POST['idPersonal']);
}

if (isset($_POST['CambiarActivo']) && $_POST['CambiarActivo'] == "ok") {
    AjaxPersonal::ajaxCambiarEstado($_POST['idPersonal'], $_POST['estadoActual']);
}

/* ===================================================
   ? HIJOS
===================================================*/
if (isset($_POST['GuardarHijos']) && $_POST['GuardarHijos'] == "ok") {
    AjaxPersonal::ajaxGuardarHijos($_POST);
}

if (isset($_POST['TablaHijos']) && $_POST['TablaHijos'] == "ok") {
    AjaxPersonal::ajaxTablaHijos($_POST['idPersonal']);
}

if (isset($_POST['EliminarHijo']) && $_POST['EliminarHijo'] == "ok") {
    AjaxPersonal::ajaxEliminarHijo($_POST['idhijo']);
}

/* ===================================================
   ? CONTRATOS Y PRORROGAS
===================================================*/
if (isset($_POST['GuardarProrroga']) && $_POST['GuardarProrroga'] == "ok") {
    AjaxPersonal::ajaxGuardarProrrogas($_POST);
}

if (isset($_POST['TablaProrrogas']) && $_POST['TablaProrrogas'] == "ok") {
    AjaxPersonal::ajaxTablaProrrogas($_POST['idPersonal']);
}

if (isset($_POST['EliminarProrroga']) && $_POST['EliminarProrroga'] == "ok") {
    AjaxPersonal::ajaxEliminarProrroga($_POST['idprorroga']);
}

/* ===================================================
   ? LICENCIAS DE CONDUCCION
===================================================*/
if (isset($_POST['GuardarLicencia']) && $_POST['GuardarLicencia'] == "ok") {
    AjaxPersonal::ajaxGuardarLicencias($_POST);
}

if (isset($_POST['TablaLicencias']) && $_POST['TablaLicencias'] == "ok") {
    AjaxPersonal::ajaxTablaLicencias($_POST['idPersonal']);
}

if (isset($_POST['EliminarLicencia']) && $_POST['EliminarLicencia'] == "ok") {
    AjaxPersonal::ajaxEliminarLicencia($_POST['idlicencia']);
}

/* ===================================================
   ? EXÁMENES MÉDICOS
===================================================*/
if (isset($_POST['GuardarExamen']) && $_POST['GuardarExamen'] == "ok") {
    AjaxPersonal::ajaxGuardarExamenes($_POST);
}

if (isset($_POST['TablaExamenes']) && $_POST['TablaExamenes'] == "ok") {
    AjaxPersonal::ajaxTablaExamenes($_POST['idPersonal']);
}

if (isset($_POST['EliminarExamen']) && $_POST['EliminarExamen'] == "ok") {
    AjaxPersonal::ajaxEliminarExamen($_POST['idexamen']);
}

/* ===================================================
   ? DOCUMENTOS
===================================================*/
if (isset($_POST['CargarDocumento']) && $_POST['CargarDocumento'] == "ok") {
    if (isset($_FILES['documento'])) {
        AjaxPersonal::ajaxCargarDocumento($_POST['idPersonal'], $_FILES['documento'], $_POST['tipoDoc'], $_POST['idregistro']);
    } else {
        echo "vacio";
    }
}

if (isset($_POST['EliminarDocumento']) && $_POST['EliminarDocumento'] == "ok") {
    AjaxPersonal::ajaxEliminarDocumento($_POST['idregistro'], $_POST['tipoDoc']);
}

/* ===================================================
   * AJAX PAGO SEGURIDAD SOCIAL
===================================================*/
class AjaxPagoSS
{
    /* ===================================================
       GUARDAR FECHAS PARA PAGO SEGURIDAD SOCIAL
    ===================================================*/
    static public function ajaxGuardarFechas($datos)
    {
        echo ControladorPagoSS::ctrGuardarFechas($datos);
    }

    /* ===================================================
        TABLA PAGO SEGURIDAD SOCIAL
    ===================================================*/
    static public function ajaxTablaPagoSS($idFecha)
    {
        $PagoSS = ControladorPagoSS::ctrMostrarPagoSS($idFecha);
        $tr = "";
        foreach ($PagoSS as $key => $value) {
            # PAGO
            if ($value['pago'] == 'N') {
                $pago = '<button class="btn btn-sm btn-danger btnPago" idsegursoc="' . $value["idsegursoc"] . '" pago="N">NO</button>';
            } else {
                $pago = '<button class="btn btn-sm btn-success btnPago" idsegursoc="' . $value["idsegursoc"] . '" pago="S">SI</button>';
            }
            $tr .= "
                <tr>
                        <td>" . $value['Nombre'] . "</td>
                        <td>" . $value['pago_seguridadsocial'] . "</td>
                        <td>" . $pago . "</td>
                        <td>" . $value['eps'] . "</td>
                        <td>" . $value['arl'] . "</td>
                        <td>" . $value['afp'] . "</td>
                        <td>" . $value['cargo'] . "</td>
                        <td>" . $value['sucursal'] . "</td>
                </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
       CAMBIAR PAGO DEL EMPLEADO
    ===================================================*/
    static public function ajaxActualizarPago($idsegursoc, $estadoActual)
    {
        $respuesta = ControladorPagoSS::ctrActualizarPago($idsegursoc, $estadoActual);
        echo $respuesta;
    }
}

/* ===================================================
   ! LLAMADOS PAGO SEGURIDAD SOCIAL
===================================================*/
if (isset($_POST['GuardarFechasPagoSS']) && $_POST['GuardarFechasPagoSS'] == "ok") {
    $datos = array(
        'idFechas' => $_POST['idFechas'],
        'fechaini' => $_POST['fechaini'],
        'fechafin' => $_POST['fechafin'],
        'observaciones' => $_POST['observaciones']
    );
    AjaxPagoSS::ajaxGuardarFechas($datos);
}

if (isset($_POST['TablaPagoSS']) && $_POST['TablaPagoSS'] == "ok") {
    AjaxPagoSS::ajaxTablaPagoSS($_POST['idFechas']);
}

if (isset($_POST['CambiarPagoSS']) && $_POST['CambiarPagoSS'] == "ok") {
    AjaxPagoSS::ajaxActualizarPago($_POST['idsegursoc'], $_POST['estadoActual']);
}