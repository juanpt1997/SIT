<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
// require_once '../controllers/almacen.controlador.php';
// require_once '../models/almacen.modelo.php';
// require_once '../controllers/conceptos.controlador.php';
require_once '../models/conceptos.modelo.php';

// if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
//     echo "<script>window.location = 'inicio';</script>";
//     die();
// }

class AjaxAlmacen
{
    static public function cargarSelect($nombre)
    {
        switch ($nombre) {

            case 'categoria':

                $tabla = "a_categorias";
                $item = "categoria";
                $id = "idcategorias";
                break;

            case 'medida':

                $tabla = "a_medidas";
                $item = "medida";
                $id = "idmedidas";
                break;

            case 'marca':

                $tabla = "a_marcas";
                $item = "marca";
                $id = "idmarca";
                break;

            default:
                # code...
                break;
        }

        $datos = array(
            "tabla" => $tabla,
            "item"  => $item,
            "id" => $id
        );

        $respuesta = ModeloConceptosGH::mdlVer($datos);
        $option = "<option value='' selected>Seleccione una {$nombre} </option>";

        foreach ($respuesta as $key => $value) {
            $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]}</option>";
        }
        echo $option;
    }
}

/* ===================================================
            LLAMADOS AJAX EN PRODUCTOS
====================================================*/
if (isset($_POST['cargarselect']) && $_POST['cargarselect'] == "ok") {
    AjaxAlmacen::cargarSelect($_POST['nombreSelect']);
}


