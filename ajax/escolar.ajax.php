<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
require_once '../models/conceptos.modelo.php';
require_once '../models/vehicular.modelo.php';
require_once '../controllers/escolar.controlador.php';
require_once '../models/escolar.modelo.php';
date_default_timezone_set('America/Bogota');


class AjaxEscolar
{
    /* ===================================================
        CARGAR SELECT
    ===================================================*/
    static public function ajaxCargarSelect($nombre)
    {

        switch ($nombre) {

            case 'institucion':

                $tabla = "e_instituciones";
                $item = "nombre";
                $item2 = "";
                $id = "idinstitucion";
                break;

            case 'placa':

                $tabla = "v_vehiculos";
                $item = "placa";
                $item2 = "numinterno";
                $id = "idvehiculo";
                break;

            case 'ruta':
                $tabla = "e_rutas";
                $item = "numruta";
                $item2 = "sector";
                $id = "idruta";
                break;

            case 'ruta2':
                $tabla = "e_rutas";
                $item = "numruta";
                $item2 = "sector";
                $id = "idruta";
                break;

            case 'estudiante':
                $tabla = "e_pasajeros";
                $item = "nombre";
                $item2 = "codigo";
                $id = "idpasajero";
                break;

            case 'estudiante2':
                $tabla = "e_pasajeros";
                $item = "nombre";
                $item2 = "codigo";
                $id = "idpasajero";
                break;

            case 'estudiante3':
                $tabla = "e_pasajeros";
                $item = "nombre";
                $item2 = "codigo";
                $id = "idpasajero";
                break;

            case 'ruta3':
                $tabla = "e_rutas";
                $item = "numruta";
                $item2 = "sector";
                $id = "idruta";
                break;

            default:
                # code...
                break;
        }

        $datos = array(
            "tabla" => $tabla,
            "item"  => $item,
            "item2" => $item2,
            "id" => $id
        );

        if ($nombre == "ruta2" || $nombre == "ruta3") {
            $option = "<option value='' selected>-- Seleccione ruta --</option>";
        } else if ($nombre == "estudiante2" || $nombre == "estudiante3") {
            $option = "<option value='' selected>-- Seleccione estudiante --</option>";
        } else {
            $option = "<option value='' selected>-- Seleccione {$nombre} --</option>";
        }


        if ($nombre != "placa" && $nombre != "ruta" && $nombre != "ruta2" && $nombre != "estudiante" && $nombre != "estudiante2" && $nombre != "estudiante3" && $nombre != "ruta3") {

            $respuesta = ModeloConceptosGenerales::mdlVer($datos);
            foreach ($respuesta as $key => $value) {
                $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]}</option>";
            }
        } else {
            $respuesta = ModeloConceptosGenerales::mdlVerRegistro($datos);
            foreach ($respuesta as $key => $value) {
                $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]} - {$value["{$datos['item2']}"]}</option>";
            }
        }




        echo $option;
    }

    /* ===================================================
        GUARDAR RUTA 
    ===================================================*/
    static public function ajaxGuardarRuta($datos)
    {
        $respuesta = ControladorEscolar::ctrGuardarEditarRuta($datos);
        echo $respuesta;
    }

    /* ===================================================
        TABLA RUTAS
    ===================================================*/
    static public function ajaxTablaRutas()
    {
        $respuesta = ModeloEscolar::mdlListarRutas();
        $tr = "";

        foreach ($respuesta as $key => $value) {

            $fecha = date("Y/m/d");

            $recorrido = ModeloEscolar::mdlRecorridoxFechaxRuta($value['idruta'], $fecha);

            if ($recorrido != false) {
                $idrecorrido = $recorrido['idrecorrido'];
            } else {
                $idrecorrido = "";
            }

            $tr .= "
            <tr>
            <td>
                <div class='btn-group' role='group' aria-label='Button group'>
                    <button class='btn btn-info btn-editarRuta' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modalRuta'><i class='fas fa-edit'></i></button>
                    <button class='btn btn-success btn-listar' idruta='{$value['idruta']}' ordenado='{$value['ordenado']}' data-toggle='modal' data-target='#modal-listar'><i class='fas fa-user-check'></i></button>
                    <button class='btn btn-warning btn-seguimiento' idruta='{$value['idruta']}' idrecorrido='{$idrecorrido}' data-toggle='modal' data-target='#modal-seguimiento'><i class='fas fa-clipboard-check'></i></button>
                </div>
            </td>
            <td>{$value['numruta']}</td>
            <td>{$value['sector']}</td>
            <td>{$value['placa']}</td>
            <td>{$value['capacidad']}</td>
            <td>{$value['nombre']}</td>
            </tr>
            ";
        }

        echo $tr;
    }

    /* ===================================================
        CARGAR DATOS DE UNA RUTA
    ===================================================*/
    static public function ajaxDatosRuta($idruta)
    {
        $respuesta = ModeloEscolar::mdlRutaxId($idruta);
        echo json_encode($respuesta);
    }

    /* ===================================================
        CREAR ESTUDIANTE
    ===================================================*/
    static public function ajaxGuardarEstudiante($datos)
    {
        $respuesta = ControladorEscolar::ctrGuardarEstudiante($datos);
        echo $respuesta;
    }

    /* ===================================================
        TABLA ESTUDIANTES X RUTA 
    ===================================================*/
    static public function ajaxTablaEstudiantesxRuta($ruta)
    {
        $respuesta = ModeloEscolar::mdlEstudiantesxRuta($ruta);

        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .= "
                <tr>
                <td> " . $value['codigo']  . " </td>
                <td> " . $value['ano']  . " </td>
                <td> " . $value['grado']  . " </td>
                <td> " . $value['grupo']  . " </td>
                <td> " . $value['nombre']  . " </td>
                <td> " . $value['nivel']  . " </td>
                <td> " . $value['barrio']  . " </td>
                <td> " . $value['direccion']  . " </td>
                <td> " . $value['nombre_acudiente1']  . " </td>
                <td> " . $value['celular_acudiente1']  . " </td>
                <td> " . $value['nombre_acudiente2']  . " </td>
                <td> " . $value['celular_acudiente2']  . " </td>
                </tr>

            ";
        }

        echo $tr;
    }

    /* ===================================================
        ASOCIAR ESTUDIANTE A RUTA 
    ===================================================*/
    static public function ajaxEstudianteaRuta($datos)
    {
        $respuesta = ControladorEscolar::ctrAsociarEstudianteRuta($datos);
        echo $respuesta;
    }

    /* ===================================================
        TABLA SEGUIMIENTO X RUTA 
    ===================================================*/
    static public function ajaxSeguimientoxRuta($ruta)
    {
        $respuesta = ModeloEscolar::mdlEstudiantesxRuta($ruta);

        $datos = array(
            "fecha" => date("Y/m/d"),
            "idruta" => $ruta
        );

        $recorrido = ModeloEscolar::mdlRecorridoxRutaxDia($datos);



        $tr = "";

        foreach ($respuesta as $key => $value) {
            date_default_timezone_set('America/Bogota');

            $fecha = date("Y/m/d");
            $seguimiento = ModeloEscolar::mdlSeguimientoxPasajeroxFecha($value['idpasajero'], $fecha);



            if ($recorrido != false) {
                $boton_entrega = "
                <button class='btn btn-danger btn-entrega' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}' ><i class='fas fa-sign-out-alt'></i></button>
                ";
                $boton_recoge = "
                <button class='btn btn-success btn-recoge' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}'><i class='fas fa-sign-in-alt'></i></button>
                ";
                    
                $boton_eliminar = "<td><button class='btn btn-sm btn-danger btn-eliminar' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}' ><i class='fas fa-minus'></i></button></td>";
            } else {
                $boton_entrega = "
                <button class='btn btn-danger btn-entrega' idpasajero='{$value['idpasajero']}' idrecorrido='' ><i class='fas fa-sign-out-alt'></i></button>
                ";
                $boton_recoge = "
                <button class='btn btn-success btn-recoge' idpasajero='{$value['idpasajero']}' idrecorrido=''> <i class='fas fa-sign-in-alt'></i></button>
                ";

                $boton_eliminar = "<td><button class='btn btn-sm btn-danger btn-eliminar' idpasajero='{$value['idpasajero']}' idrecorrido='' ><i class='fas fa-minus'></i></button></td>";
                
            }

            if ($seguimiento != false) {

                if ($seguimiento['hora_recogida'] != "") {
                    $boton_recoge = "<span>{$seguimiento['hora_recogida']}</span>";
                }

                if ($seguimiento['hora_entrega'] != "") {
                    $boton_entrega = "<span>{$seguimiento['hora_entrega']}</span>";
                }
            }

            $tr .= "
            <tr>
                    <td>
                        {$boton_recoge}
                    </td>
                    <td>
                        {$boton_entrega}
                    </td>
                    <td> {$value['codigo']} </td>
                    <td> {$value['nombre']} </td>
                    <td> {$value['nivel']} </td>
                    <td> {$value['barrio']} </td>
                    <td> {$value['direccion']} </td>
                    {$boton_eliminar}
                    
                </tr>
            
            ";
        }

        echo $tr;
    }


    /* ===================================================
        GUARDAR RECORRIDO
    ===================================================*/
    static public function ajaxGuardarRecorrido($datos)
    {
        $respuesta = ControladorEscolar::ctrGuardarRecorrido($datos);
        echo $respuesta;
    }

    /* ===================================================
        CARGAR SELECT ESTUDIANTES ORDEN
    ===================================================*/
    static public function ajaxSelectOrden($ruta)
    {
        $respuesta = ModeloEscolar::mdlEstudiantesxRuta($ruta);

        //OBTENEMOS EL ORDEN DEL PRIMER ESTUDIANTE Y LO DIVIDIMOS SOBRE 2 PARA TENER EL ORDEN EN CASO TAL QUE SE ESTABLEZCA COMO PRIMERO
        // $val_primero = $respuesta[0]['orden'] / 2;
        // var_dump($val_primero);

        $option = "<option value=''>-- Seleccione el orden--</option>
                   <option value='0'>Establecer como primero</option>";
        foreach ($respuesta as $key => $value) {
            $option .= "<option value='{$value['idpasajero']}'> {$value['nombre']} - {$value['codigo']}</option>";
        }

        echo $option;
    }

    /* ===================================================
        DATOS DEL RECORRIDO 
    ===================================================*/
    static public function ajaxDatosRecorrido($idrecorrido)
    {
        $respuesta = ModeloEscolar::mdlDatosRecorrido($idrecorrido);
        echo json_encode($respuesta);
    }

    /* ===================================================
        GUARDAMOS SEGUIMIENTO RECOGE
    ===================================================*/
    static public function ajaxGuardarSeguimientoRecoge($idrecorrido, $idpasajero)
    {
        $respuesta = ControladorEscolar::ctrGuardarSeguimientoRecoge($idrecorrido, $idpasajero);
        echo $respuesta;
    }

    /* ===================================================
        GUARDAMOS SEGUIMIENTO ENTREGA 
    ===================================================*/
    static public function ajaxGuardarSeguimientoEntrega($idrecorrido, $idpasajero)
    {
        $respuesta = ControladorEscolar::ctrGuardarSeguimientoEntrega($idrecorrido, $idpasajero);
        echo $respuesta;
    }

    /* ===================================================
        ASOCIAR ESTUDIANTE TEMPORAL A RUTA 
    ===================================================*/
    static public function ajaxAsociarEstudianteTemporalRuta($datos)
    {
        $respuesta = ControladorEscolar::ctrAsociarEstudianteTemporalRuta($datos);
        echo $respuesta;
    }

    /* ===================================================
        TABLA ESTUDIANTES TEMPORAL X RUTA 
    ===================================================*/
    static public function ajaxTablaEstudiantesTemporalxRuta($idruta)
    {
        $respuesta = ModeloEscolar::mdlListarEstudiantesTemporalesxRuta($idruta);
        $tr = "";


        foreach ($respuesta as $key => $value) {
            $tr .= "
                <tr>
                <td> " . $value['codigo']  . " </td>
                <td> " . $value['ano']  . " </td>
                <td> " . $value['grado']  . " </td>
                <td> " . $value['grupo']  . " </td>
                <td> " . $value['nombre']  . " </td>
                <td> " . $value['nivel']  . " </td>
                <td> " . $value['barrio']  . " </td>
                <td> " . $value['direccion']  . " </td>
                <td> " . $value['nombre_acudiente1']  . " </td>
                <td> " . $value['celular_acudiente1']  . " </td>
                <td> " . $value['nombre_acudiente2']  . " </td>
                <td> " . $value['celular_acudiente2']  . " </td>
                </tr>

            ";
        }

        echo $tr;
    }

    /* ===================================================
        TABLA SEGUIMIENTO ESTUDIANTES TEMPORAL X RUTA
    ===================================================*/
    static public function ajaxtablaSeguimientoEstudiantesTemporalxRuta($idruta)
    {
        $respuesta = ModeloEscolar::mdlListarEstudiantesTemporalesxRuta($idruta);

        $datos = array(
            "fecha" => date("Y/m/d"),
            "idruta" => $idruta
        );

        $recorrido = ModeloEscolar::mdlRecorridoxRutaxDia($datos);



        $tr = "";

        foreach ($respuesta as $key => $value) {
            date_default_timezone_set('America/Bogota');

            $fecha = date("Y/m/d");
            $seguimiento = ModeloEscolar::mdlSeguimientoxPasajeroxFecha($value['idpasajero'], $fecha);



            if ($recorrido != false) {
                $boton_entrega = "
                <button class='btn btn-danger btn-entrega' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}' ><i class='fas fa-sign-out-alt'></i></button>
                ";
                $boton_recoge = "
                <button class='btn btn-success btn-recoge' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}'><i class='fas fa-sign-in-alt'></i></button>
                ";
            } else {
                $boton_entrega = "
                <button class='btn btn-danger btn-entrega' idpasajero='{$value['idpasajero']}' idrecorrido='' ><i class='fas fa-sign-out-alt'></i></button>
                ";
                $boton_recoge = "
                <button class='btn btn-success btn-recoge' idpasajero='{$value['idpasajero']}' idrecorrido=''> <i class='fas fa-sign-in-alt'></i></button>
                ";
            }

            if ($seguimiento != false) {

                if ($seguimiento['hora_recogida'] != "") {
                    $boton_recoge = "<span>{$seguimiento['hora_recogida']}</span>";
                }

                if ($seguimiento['hora_entrega'] != "") {
                    $boton_entrega = "<span>{$seguimiento['hora_entrega']}</span>";
                }
            }

            $tr .= "
            <tr>
                    <td>
                        {$boton_recoge}
                    </td>
                    <td>
                        {$boton_entrega}
                    </td>
                    <td> {$value['codigo']} </td>
                    <td> {$value['nombre']} </td>
                    <td> {$value['nivel']} </td>
                    <td> {$value['barrio']} </td>
                    <td> {$value['direccion']} </td>
                    <td><button class='btn btn-sm btn-danger btn-eliminar' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}' ><i class='fas fa-minus'></i></button></td>
                </tr>
            
            ";
        }

        echo $tr;
    }

    /* ===================================================
        DESVINCULAR ESTUDIANTE DE RUTA 
    ===================================================*/
    static public function ajaxDesvincularEstudianteRuta($idpasajero)
    {
        $respuesta = ModeloEscolar::mdlDesvincularEstudianteRuta($idpasajero);
        echo $respuesta;
    }

    /* ===================================================
        DESVINCULAR ESTUDIANTE DE RUTA TEMPORAL
    ===================================================*/
    static public function ajaxDesvincularEstudianteRutaTemp($idpasajero)
    {
        $respuesta = ModeloEscolar::mdlDesvincularEstudianteRutaTemp($idpasajero);
        echo $respuesta; 
    }


    /* ===================================================
        TABLA HISTORIAL RECORRIDOS
    ===================================================*/
    static public function ajaxHistorialRecorridos()
    {
        $respuesta = ModeloEscolar::mdlHistorialRecorrido();

        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .= "
            <tr>
                <td>
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <button class='btn btn-warning pasajerosxrecorrido' idrecorrido='{$value['idrecorrido']}' data-toggle='modal' data-target='#modalHistorialRecorrido'><i class='fas fa-clipboard-check'></i></button>
                    </div>
                </td>
                <td>{$value['numruta']}</td>
                <td>{$value['sector']}</td>
                <td>{$value['placa']}</td>
                <td>{$value['nombre_conductor']}</td>
                <td>{$value['nombre']}</td>
                <td>{$value['Ffecha']}</td>
            </tr>
            ";
        }

        echo $tr;

    }


    /* ===================================================
        TABLA PASAJEROS X RECORRIDO
    ===================================================*/
    static public function ajaxTablaPasajerosxRecorrido($idrecorrido)
    {
        $respuesta = ModeloEscolar::mdlPasajerosxRecorrido($idrecorrido);

        $tr = "";

        foreach ($respuesta as $key => $value) {

            if($value['hora_recogida'] == null) $value['hora_recogida'] = "";
            if($value['hora_entrega'] == null) $value['hora_entrega'] = "";

            $tr .= "
            
            <tr>
            <td>{$value['codigo']}</td>
            <td>{$value['nombre']}</td>
            <td>{$value['hora_recogida']}</td>
            <td>{$value['hora_entrega']}</td>
            <td>{$value['nivel']}</td>
            <td>{$value['barrio']}</td>
            <td>{$value['direccion']}</td>
            </tr>

            ";
        }

        echo $tr;
    }


    /* ===================================================
        ELIMINAR SEGUIMIENTO PASAJERO 
    ===================================================*/
    static public function ajaxEliminarSeguimientoEstudiante($datos)
    {
        $respuesta = ControladorEscolar::ctrEliminarSeguimientoEstudiante($datos);
        echo $respuesta;
    }
}




/* ===================================================
    LLAMADOS
===================================================*/

#Llamado a cargar select
if (isset($_POST['cargarselect']) && $_POST['cargarselect'] == "ok") {
    AjaxEscolar::ajaxCargarSelect($_POST['nombreSelect']);
}

#LLAMADO A GUARDAR RUTA
if (isset($_POST['GuardarRuta']) && $_POST['GuardarRuta'] == "ok") {
    AjaxEscolar::ajaxGuardarRuta($_POST);
}

#LLAMADO A CARGAR TABLA RUTAS 
if (isset($_POST['TablaRutas']) && $_POST['TablaRutas'] == "ok") {
    AjaxEscolar::ajaxTablaRutas();
}

#LLAMADO A DATOS DE RUTA
if (isset($_POST['datosRuta']) && $_POST['datosRuta'] == "ok") {
    AjaxEscolar::ajaxDatosRuta($_POST['idruta']);
}

#LLAMADO A GUARDAR ESTUDIANTE NUEVO
if (isset($_POST['CrearEstudiante']) && $_POST['CrearEstudiante'] == "ok") {
    AjaxEscolar::ajaxGuardarEstudiante($_POST);
}

#LLAMADO A TABLA ESTUDIANTES X RUTA 
if (isset($_POST['TablaEstudiantesxRuta']) && $_POST['TablaEstudiantesxRuta'] == "ok") {
    AjaxEscolar::ajaxTablaEstudiantesxRuta($_POST['idruta']);
}

#LLAMADO A ASOCIAR ESTUDIANTE A RUTA
if (isset($_POST['estudianteARuta']) && $_POST['estudianteARuta'] == "ok") {
    AjaxEscolar::ajaxEstudianteaRuta($_POST);
}

#LLAMADO A TABLA SEGUIMIENTO X RUTA
if (isset($_POST['TablaSeguimientosxRuta']) && $_POST['TablaSeguimientosxRuta'] == "ok") {
    AjaxEscolar::ajaxSeguimientoxRuta($_POST['idruta']);
}

#LLAMADO A GUARDAR RECORRIDO
if (isset($_POST['guardarRecorrido']) && $_POST['guardarRecorrido'] == "ok") {
    AjaxEscolar::ajaxGuardarRecorrido($_POST);
}

#LLAMADO A CARGAR SELECT ORDEN ESTUDIANTE
if (isset($_POST['cargarselectOrden']) && $_POST['cargarselectOrden'] == "ok") {
    AjaxEscolar::ajaxSelectOrden($_POST['idruta']);
}

#LLAMADO A TRAER DATOS DEL RECORRIDO
if (isset($_POST['DatosRecorrido']) && $_POST['DatosRecorrido'] == "ok") {
    AjaxEscolar::ajaxDatosRecorrido($_POST['idrecorrido']);
}

#LLAMADO A GUARDAR SEGUIMIENTO RECOGE 
if (isset($_POST['GuardarSeguimientoRecoge']) && $_POST['GuardarSeguimientoRecoge'] == "ok") {
    AjaxEscolar::ajaxGuardarSeguimientoRecoge($_POST['idrecorrido'], $_POST['idpasajero']);
}

#LLAMADO A GUARDAR SEGUIMIENTO ENTREGA
if (isset($_POST['GuardarSeguimientoEntrega']) && $_POST['GuardarSeguimientoEntrega'] == "ok") {
    AjaxEscolar::ajaxGuardarSeguimientoEntrega($_POST['idrecorrido'], $_POST['idpasajero']);
}

#LLAMADO A ASOCIAR ESTUDIANTE TEMPORAL A RUTA
if (isset($_POST['estudianteTemporalRuta']) && $_POST['estudianteTemporalRuta'] == "ok") {
    AjaxEscolar::ajaxAsociarEstudianteTemporalRuta($_POST);
}

#LLAMADO A TABLA ESTUDIANTES TEMPORAL X RUTA 
if (isset($_POST['TablaEstudiantesTemporalxRuta']) && $_POST['TablaEstudiantesTemporalxRuta'] == "ok") {
    AjaxEscolar::ajaxTablaEstudiantesTemporalxRuta($_POST['idruta']);
}

#LLAMADO A TABLA SEGUIMIENTO ESTUDIANTES TEMPORAL X RUTA 
if (isset($_POST['tablaSeguimientoEstudiantesTemporalxRuta']) && $_POST['tablaSeguimientoEstudiantesTemporalxRuta'] == "ok") {
    AjaxEscolar::ajaxtablaSeguimientoEstudiantesTemporalxRuta($_POST['idruta']);
}

#LLAMADO A DESVINCULAR ESTUDIANTE X RUTA 
if(isset($_POST['desvincularEstudianteRuta']) && $_POST['desvincularEstudianteRuta'] == "ok")
{
    AjaxEscolar::ajaxDesvincularEstudianteRuta($_POST['idpasajero']);
    AjaxEscolar::ajaxDesvincularEstudianteRutaTemp($_POST['idpasajero']);
}

#LLAMADO A TABLA HISTORIAL RECORRIDO
if(isset($_POST['HistorialRecorridos']) && $_POST['HistorialRecorridos'] == "ok")
{
    AjaxEscolar::ajaxHistorialRecorridos();
}

#LLAMADO A TABLA PASAJEROS X RECORRIDO
if(isset($_POST['PasajerosxRecorrido']) && $_POST['PasajerosxRecorrido'] == "ok")
{
    AjaxEscolar::ajaxTablaPasajerosxRecorrido($_POST['idrecorrido']);
}

#LLAMADO A ELIMINAR SEGUIMIENTO PASAJERO
if(isset($_POST['eliminarSeguimientoEstudiante']) && $_POST['eliminarSeguimientoEstudiante'] == "ok")
{
    AjaxEscolar::ajaxEliminarSeguimientoEstudiante($_POST);
}