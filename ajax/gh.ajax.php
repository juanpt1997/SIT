<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/files.controlador.php';
require_once '../controllers/gh.controlador.php';
require_once '../models/gh.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "<script>window.location = 'inicio';</script>";
	die();
}

/* ===================================================
   * PERSONAL
===================================================*/
class AjaxPersonal
{
    /* ===================================================
       TABLA PERSONAL
    ===================================================*/
    static public function ajaxTablaPersonal()
    {
        $respuestaBD = ControladorGH::ctrListaPersonal();
        $tr = "";
        foreach ($respuestaBD as $key => $value) {
            # Activo
            if ($value['activo'] == 'S') {
                $activo = "<button class='btn btn-sm btn-success btnActivarPersonal' idPersonal='{$value['idPersonal']}' estado='S'>Activo</button>";
            } else {
                $activo = "<button class='btn btn-sm btn-danger btnActivarPersonal' idPersonal='{$value['idPersonal']}' estado='N'>Inactivo</button>";
            }

            # Foto
            if ($value['foto'] != '') {
                $foto = '<img src="' . $value['foto'] . '" class="img-fluid" width="35"></td>';
            } else {
                $foto = '<img src="views/img/fotosUsuarios/default/anonymous.png" class="img-fluid" width="35">';
            }

            # Botón Acciones
            $btnEditar = "<button type='button' class='btn btn-info btn-sm m-1 btn-editarPersonal' idPersonal='{$value['idPersonal']}' data-toggle='modal' data-target='#PersonalModal'><i class='fas fa-edit'></i></button>";
            $btnFichaTecnica = "<button type='button' class='btn btn-secondary btn-sm m-1 btn-FTConductor' idPersonal='{$value['idPersonal']}'><i class='fas fa-book'></i></button>";
            $botonAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnFichaTecnica . "</div>";

            /* <tr>
                                    <td><?= $value['idPersonal'] ?></td>
                                    <td><?= $foto ?></td>
                                    <td><?= $value['Nombre'] ?></td>
                                    <td><?= $value['Documento'] ?></td>
                                    <td><?= $value['direccion'] ?></td>
                                    <td><?= $value['telefono1'] ?></td>
                                    <td><?= $value['telefono2'] ?></td>
                                    <td><?= $value['correo'] ?></td>
                                    <td><?= $value['tipo_sangre'] ?></td>
                                    <td><?= $activo ?></td>
                                    <td><?= $botonAcciones ?></td>
                                </tr> */

            $tr .= "
                <tr>
                    <td>" . $value['idPersonal'] . "</td>
                    <td>$foto</td>
                    <td>" . $value['Nombre'] . "</td>
                    <td>" . $value['Documento'] . "</td>
                    <td>" . $value['direccion'] . "</td>
                    <td>" . $value['telefono1'] . "</td>
                    <td>" . $value['telefono2'] . "</td>
                    <td>" . $value['correo'] . "</td>
                    <td>" . $value['tipo_sangre'] . "</td>
                    <td>$activo</td>
                    <td>$botonAcciones</td>
                </tr>
            ";
        }

        echo $tr;
    }

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
    static public function ajaxDatosEmpleado($item, $valor)
    {
        $respuesta = ControladorGH::ctrDatosEmpleado($item, $valor);
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
                        <td>" . $value['edadCalculada'] . "</td>
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
if (isset($_POST['TablaPersonal']) && $_POST['TablaPersonal'] == "ok") {
    AjaxPersonal::ajaxTablaPersonal();
}

if (isset($_POST['GuardarPersonal']) && $_POST['GuardarPersonal'] == "ok") {
    $foto = isset($_FILES['foto']) ? $_FILES['foto'] : "";
    AjaxPersonal::ajaxGuardarPersonal($_POST, $foto);
}

if (isset($_POST['DatosEmpleado']) && $_POST['DatosEmpleado'] == "ok") {
    AjaxPersonal::ajaxDatosEmpleado($_POST['item'], $_POST['valor']);
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
   * PERFIL SOCIODEMOGRAFICO
===================================================*/
class AjaxPerfilSD
{
    /* ===================================================
       TABLA PERFIL SOCIODEMOGRAFICO
    ===================================================*/
    static public function ajaxTablaPerfilSD()
    {
        $respuestaBD = ControladorGH::ctrMostrarPerfilSD();
        $CantidadColumnasHijos = ControladorGH::ctrMayorCantidadHijos()['cantidad'];
        $tr = "";
        foreach ($respuestaBD as $key => $value) {
            /* ===================================================
                ACTIVO
            ===================================================*/
            $activo = $value['activo'] == "S" ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>";
            /* ===================================================
                CONSENTIMIENTO
            ===================================================*/
            $consentimiento = $value['consentimiento_informado'] == "S" ? "<span class='badge badge-success'>Si</span>" : "<span class='badge badge-secondary'>No</span>";
            /* ===================================================
                HIJOS
            ===================================================*/
            $tdHijos = "";
            $contadorHijos = 0;
            if (!empty($value['hijos'])) {
                foreach ($value['hijos'] as $key2 => $hijo) {
                    $tdHijos .= "<td>{$hijo['Nombre']}</td>";
                    $tdHijos .= "<td>{$hijo['fecha_nacimiento']}</td>";
                    $tdHijos .= "<td>{$hijo['edadCalculada']}</td>";
                    $tdHijos .= "<td>{$hijo['genero']}</td>";
                    $contadorHijos++;
                }
            }
            // Completar los demas campos vacios
            for ($i = $contadorHijos; $i < $CantidadColumnasHijos; $i++) {
                $tdHijos .= "<td></td>
                            <td></td>
                            <td></td>
                            <td></td>";
            }
            /* <tr>
                                    <td><?= $empleado['idPersonal'] ?></td>
                                    <td class="text-lg"><?= $consentimiento ?></td>
                                    <td><?= $empleado['Nombre'] ?></td>
                                    <td><?= $empleado['fecha_ingreso'] ?></td>
                                    <td><?= $empleado['tipo_doc'] ?></td>
                                    <td><?= $empleado['Documento'] ?></td>
                                    <td><?= $empleado['lugarExpedicion'] ?></td>
                                    <td><?= $empleado['fecha_nacimiento'] ?></td>
                                    <td><?= $empleado['lugarNacimiento'] ?></td>
                                    <td><?= $empleado['edadCalculada'] ?></td>
                                    <td><?= $empleado['lugarResidencia'] ?></td>
                                    <td><?= $empleado['direccion'] ?></td>
                                    <td><?= $empleado['barrio'] ?></td>
                                    <td><?= $empleado['estrato_social'] ?></td>
                                    <td><?= $empleado['telefono1'] ?></td>
                                    <td><?= $empleado['telefono2'] ?></td>
                                    <td><?= $empleado['correo'] ?></td>
                                    <td><?= $empleado['Eps'] ?></td>
                                    <td><?= $empleado['Afp'] ?></td>
                                    <td><?= $empleado['Arl'] ?></td>
                                    <td><?= $empleado['nivel_escolaridad'] ?></td>
                                    <td><?= $empleado['raza'] ?></td>
                                    <td><?= $empleado['pago_seguridadsocial'] ?></td>
                                    <td><?= $empleado['Cargo'] ?></td>
                                    <td><?= $empleado['turno_trabajo'] ?></td>
                                    <td><?= $empleado['Proceso'] ?></td>
                                    <td><?= $empleado['genero'] ?></td>
                                    <td><?= $empleado['tipo_sangre'] ?></td>
                                    <td><?= $empleado['salario_basico'] ?></td>
                                    <td><?= $empleado['beneficio_fijo'] ?></td>
                                    <td><?= $empleado['bonificacion_variable'] ?></td>
                                    <td><?= $empleado['tipo_contrato'] ?></td>
                                    <td><?= $empleado['tipo_vinculacion'] ?></td>
                                    <td><?= $empleado['antiguedad'] ?></td>
                                    <td><?= $empleado['anios_experiencia'] ?></td>
                                    <td><?= $empleado['tipo_vivienda'] ?></td>
                                    <td><?= $empleado['estado_civil'] ?></td>
                                    <td><?= $empleado['dependientes'] ?></td>
                                    <td><?= $empleado['Ciudad'] ?></td>
                                    <td><?= $empleado['Departamento'] ?></td>
                                    <td><?= $empleado['Sucursal'] ?></td>
                                    <td><?= $empleado['nro_licencia'] ?></td>
                                    <td><?= $empleado['categoria'] ?></td>
                                    <td><?= $empleado['fecha_vencimiento'] ?></td>
                                    <?= $tdHijos ?>
                                    <td class="text-lg"><?= $activo ?></td>
                                </tr> */

            // Llenado de la tabla
            $tr .= "
                <tr>
                    <td>" . $value['idPersonal'] . "</td>
                    <td class='text-lg'>$consentimiento</td>
                    <td>" . $value['Nombre'] . "</td>
                    <td>" . $value['fecha_ingreso'] . "</td>
                    <td>" . $value['tipo_doc'] . "</td>
                    <td>" . $value['Documento'] . "</td>
                    <td>" . $value['lugarExpedicion'] . "</td>
                    <td>" . $value['fecha_nacimiento'] . "</td>
                    <td>" . $value['lugarNacimiento'] . "</td>
                    <td>" . $value['edadCalculada'] . "</td>
                    <td>" . $value['lugarResidencia'] . "</td>
                    <td>" . $value['direccion'] . "</td>
                    <td>" . $value['barrio'] . "</td>
                    <td>" . $value['estrato_social'] . "</td>
                    <td>" . $value['telefono1'] . "</td>
                    <td>" . $value['telefono2'] . "</td>
                    <td>" . $value['correo'] . "</td>
                    <td>" . $value['Eps'] . "</td>
                    <td>" . $value['Afp'] . "</td>
                    <td>" . $value['Arl'] . "</td>
                    <td>" . $value['nivel_escolaridad'] . "</td>
                    <td>" . $value['raza'] . "</td>
                    <td>" . $value['pago_seguridadsocial'] . "</td>
                    <td>" . $value['Cargo'] . "</td>
                    <td>" . $value['turno_trabajo'] . "</td>
                    <td>" . $value['Proceso'] . "</td>
                    <td>" . $value['genero'] . "</td>
                    <td>" . $value['tipo_sangre'] . "</td>
                    <td>" . $value['salario_basico'] . "</td>
                    <td>" . $value['beneficio_fijo'] . "</td>
                    <td>" . $value['bonificacion_variable'] . "</td>
                    <td>" . $value['tipo_contrato'] . "</td>
                    <td>" . $value['tipo_vinculacion'] . "</td>
                    <td>" . $value['antiguedad'] . "</td>
                    <td>" . $value['anios_experiencia'] . "</td>
                    <td>" . $value['tipo_vivienda'] . "</td>
                    <td>" . $value['estado_civil'] . "</td>
                    <td>" . $value['dependientes'] . "</td>
                    <td>" . $value['Ciudad'] . "</td>
                    <td>" . $value['Departamento'] . "</td>
                    <td>" . $value['Sucursal'] . "</td>
                    <td>" . $value['nro_licencia'] . "</td>
                    <td>" . $value['categoria'] . "</td>
                    <td>" . $value['fecha_vencimiento'] . "</td>
                    $tdHijos
                    <td class='text-lg'>$activo</td>
                </tr>
            ";
        }

        echo $tr;
    }
}

if (isset($_POST['TablaPerfilSD']) && $_POST['TablaPerfilSD'] == "ok") {
    AjaxPerfilSD::ajaxTablaPerfilSD();
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
                        <td>" . $value['cedula'] . "</td>
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

    /* ===================================================
       LISTA PERSONAL QUE NO ESTÁ INCLUIDO EN LA FECHA DE PAGO SEGURIDAD SOCIAL
    ===================================================*/
    static public function ajaxPersonalFaltante($idFechas)
    {
        $respuesta = ModeloPagoSS::mdlPersonalFaltante($idFechas);
        echo json_encode($respuesta);
    }

    /* ===================================================
       AGREGAR UN SOLO EMPLEADO AL PAGO DE SEGURIDAD SOCIAL
    ===================================================*/
    static public function ajaxAgregarEmpleado($idPersonal, $idFechas)
    {
        $respuesta = ControladorPagoSS::ctrAgregarEmpleado($idPersonal, $idFechas);
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

if (isset($_POST['PersonalFaltanteSS']) && $_POST['PersonalFaltanteSS'] == "ok") {
    AjaxPagoSS::ajaxPersonalFaltante($_POST['idFechas']);
}

if (isset($_POST['ajaxAgregarEmpleadoPagoSS']) && $_POST['ajaxAgregarEmpleadoPagoSS'] == "ok") {
    AjaxPagoSS::ajaxAgregarEmpleado($_POST['idPersonal'], $_POST['idFechas']);
}

/* ===================================================
   * AJAX CONTROL AUSENTISMO
===================================================*/
class AjaxAusentismo
{
    static public function ajaxDatosAusentismo($idAusentismo)
    {
        $respuesta = ControladorAusentismo::ctrDatosAusentismo($idAusentismo);
        echo json_encode($respuesta);
    }
}


/* ===================================================
   ! LLAMADOS PAGO SEGURIDAD SOCIAL
===================================================*/
if (isset($_POST['DatosAusentismo']) && $_POST['DatosAusentismo'] == "ok") {
    AjaxAusentismo::ajaxDatosAusentismo($_POST['idAusentismo']);
}
