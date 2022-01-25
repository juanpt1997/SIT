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
    static public function ajaxCargarSelect($nombre){
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

        $option = "<option value='' selected>Seleccione {$nombre} </option>";

        if($nombre != "placa"){

            $respuesta = ModeloConceptosGenerales::mdlVer($datos);
            foreach ($respuesta as $key => $value) {
                $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]}</option>";
                var_dump($respuesta);
            }
        }else{
            $respuesta = ModeloConceptosGenerales::mdlVerRegistro($datos);
            foreach ($respuesta as $key => $value) {
                $option .= "<option value='{$value['idvehiculo']}'>{$value['placa']} - {$value['numinterno']}</option>";
            }
        }
        
        

        
        echo $option;
    }

    /* ===================================================
        GUARDAR RUTA 
    ===================================================*/
    static public function ajaxGuardarRuta($datos){
        $respuesta = ControladorEscolar::ctrGuardarEditarRuta($datos);
        echo $respuesta;
    }

    /* ===================================================
        TABLA RUTAS
    ===================================================*/
    static public function ajaxTablaRutas(){
        $respuesta = ModeloEscolar::mdlListarRutas();
        $tr = "";

        foreach ($respuesta as $key => $value) {
            $tr .= "
            <tr>
            <td>
                <div class='btn-group' role='group' aria-label='Button group'>
                    <button class='btn btn-info btn-editarRuta' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modalRuta'><i class='fas fa-edit'></i></button>
                    <button class='btn btn-success' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modal-listar'><i class='fas fa-user-check'></i></button>
                    <button class='btn btn-warning' idruta='{$value['idruta']}' data-toggle='modal' data-target='#modal-seguimiento'><i class='fas fa-clipboard-check'></i></button>
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
    static public function ajaxDatosRuta($idruta){
        $respuesta = ModeloEscolar::mdlRutaxId($idruta);
        echo json_encode($respuesta);
    }
}



/* ===================================================
    LLAMADOS
===================================================*/

#Llamado a cargar select
if(isset($_POST['cargarselect']) && $_POST['cargarselect'] == "ok") {
    AjaxEscolar::ajaxCargarSelect($_POST['nombreSelect']);
}

#LLAMADO A GUARDAR RUTA
if(isset($_POST['GuardarRuta']) && $_POST['GuardarRuta'] == "ok"){
    AjaxEscolar::ajaxGuardarRuta($_POST);
}

#LLAMADO A CARGAR TABLA RUTAS 
if(isset($_POST['TablaRutas']) && $_POST['TablaRutas'] == "ok"){
    AjaxEscolar::ajaxTablaRutas();
}

#LLAMADO A DATOS DE RUTA
if(isset($_POST['datosRuta']) && $_POST['datosRuta'] == "ok"){
    AjaxEscolar::ajaxDatosRuta($_POST['idruta']);
}