<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
require_once '../models/conceptos.modelo.php';
require_once '../models/vehicular.modelo.php';
require_once '../controllers/escolar.controlador.php';
require_once '../models/escolar.modelo.php';


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

        if($nombre == "ruta2"){
            $option = "<option value='' selected>Seleccione ruta </option>";
        }else{
            $option = "<option value='' selected>Seleccione {$nombre} </option>";
        }


        if ($nombre != "placa" && $nombre != "ruta" && $nombre != "ruta2" && $nombre != "estudiante" ) {

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
            $tr .= "
            <tr>
            <td>
                <div class='btn-group' role='group' aria-label='Button group'>
                    <button class='btn btn-info btn-editarRuta' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modalRuta'><i class='fas fa-edit'></i></button>
                    <button class='btn btn-success btn-listar' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modal-listar'><i class='fas fa-user-check'></i></button>
                    <button class='btn btn-warning btn-seguimiento' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modal-seguimiento'><i class='fas fa-clipboard-check'></i></button>
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

            if($recorrido != false){
                $botones = "<div class='btn-group'>
                <button class='btn btn-success btn-entrega' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}' ><i class='fas fa-sign-in-alt'></i></button>
                <button class='btn btn-danger btn-recoge' idpasajero='{$value['idpasajero']}' idrecorrido='{$recorrido['idrecorrido']}'><i class='fas fa-sign-out-alt'></i></button>
        </div>";
            }else{
                $botones = "<div class='btn-group'>
                <button class='btn btn-success btn-entrega' idpasajero='{$value['idpasajero']}'  idrecorrido=''><i class='fas fa-sign-in-alt'></i></button>
                <button class='btn btn-danger btn-recoge' idpasajero='{$value['idpasajero']}'  idrecorrido='' ><i class='fas fa-sign-out-alt'></i></button>
                </div>";
            }

            $tr .= "
            <tr>
                    <td>
                        {$botones}
                    </td>
                    <td> {$value['codigo']} </td>
                    <td> {$value['nombre']} </td>
                    <td> {$value['nivel']} </td>
                    <td> {$value['barrio']} </td>
                    <td> {$value['direccion']} </td>
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
if(isset($_POST['TablaEstudiantesxRuta']) && $_POST['TablaEstudiantesxRuta'] == "ok"){
    AjaxEscolar::ajaxTablaEstudiantesxRuta($_POST['idruta']);
}

#LLAMADO A ASOCIAR ESTUDIANTE A RUTA
if(isset($_POST['estudianteARuta']) && $_POST['estudianteARuta'] == "ok"){
    AjaxEscolar::ajaxEstudianteaRuta($_POST);
}

#LLAMADO A TABLA SEGUIMIENTO X RUTA
if(isset($_POST['TablaSeguimientosxRuta']) && $_POST['TablaSeguimientosxRuta'] == "ok")
{
    AjaxEscolar::ajaxSeguimientoxRuta($_POST['idruta']);
}

#LLAMADO A GUARDAR RECORRIDO
if(isset($_POST['guardarRecorrido']) && $_POST['guardarRecorrido'] == "ok"){
    AjaxEscolar::ajaxGuardarRecorrido($_POST);
}