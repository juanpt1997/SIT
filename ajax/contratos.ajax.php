<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/contratos.controlador.php';
require_once '../models/contratos.modelo.php';


if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
   echo "<script>window.location = 'inicio';</script>";
   die();
}

/* ===================================================
   * CLIENTES
===================================================*/
class AjaxClientes
{
   static public function ajaxDatosClientes($item, $valor)
   {
      $datos = array(
         'item' => $item,
         'valor' => $valor
      );
      $respuesta = ModeloClientes::mdlVerClienteid($datos);
      echo json_encode($respuesta);
   }

   static public function ajaxConvertirCliente($id)
   {
      $respuesta = ControladorClientes::ctrActualizarCampo($id);
      echo $respuesta;
   }

   /* ===================================================
      GUARDAR RUTA DEL CLIENTE
   ===================================================*/
   static public function AjaxGuardarRutaCliente($formdata)
   {
      $respuesta = ControladorClientes::ctrGuardarRutaCliente($formdata);
      echo $respuesta;
   }

   /* ===================================================
        TABLA RUTAS X CLIENTE
    ===================================================*/
   static public function ajaxRutasxCliente($idcliente)
   {
      $Datos = ControladorClientes::ctrRutasxCliente($idcliente);
      $tr = "";
      foreach ($Datos as $key => $value) {
         // /* Permiso de usuario */
         // if (validarPermiso('M_CONTRATOS', 'D')) {
         //    $btnEliminar = "<button type='button' class='btn btn-danger eliminarHijo' idhijo='{$value['idhijo']}' idPersonal='{$value['idPersonal']}'><i class='fas fa-trash-alt'></i></button>";
         // } else {
         //    $btnEliminar = "";
         // }

         $btnEditar = "<button type='button' class='btn btn-secondary btn-sm mx-1 editarRuta' idregistro='{$value['idrutacliente']}' title='Editar ruta'><i class='fas fa-edit'></i></button>";
         $btnEliminar = "<button type='button' class='btn btn-danger btn-sm mx-1 eliminarRuta' idregistro='{$value['idrutacliente']}' title='Eliminar ruta'><i class='fas fa-trash-alt'></i></button>";
         $btnAcciones = "<div class='row d-flex flex-nowrap justify-content-center'>" . $btnEditar . $btnEliminar . "</div>";


         $tr .= "
                <tr>
                        <td>" . $value['cliente'] . "</td>
                        <td>" . $value['origen'] . "</td>
                        <td>" . $value['destino'] . "</td>
                        <td>" . $value['descripcion'] . "</td>
                        <td>" . $value['tipovehiculo'] . "</td>
                        <td>" . $value['valor_recorrido'] . "</td>
                        <td>$btnAcciones</td>
                </tr>
            ";
      }

      echo $tr;
   }

   /* ===================================================
      DATOS DE UNA RUTA ASOCIADA A UN CLIENTE
   ===================================================*/
   static public function ajaxDatosRutaCliente($idrutacliente)
   {
      $respuesta = ControladorClientes::ctrDatosRutaCliente($idrutacliente);
      echo json_encode($respuesta);
   }

   /* ===================================================
      ELIMINAR RUTA ASOCIADA
   ===================================================*/
   static public function ajaxEliminarRutaCliente($idrutacliente)
   {
      $respuesta = ControladorClientes::ctrEliminarRutaCliente($idrutacliente);
      echo $respuesta;
   }
}
/* ===================================================
   # LLAMADOS A AJAX CLIENTES
===================================================*/
if (isset($_POST['DatosClientes']) && $_POST['DatosClientes'] == "ok") {
   AjaxClientes::ajaxDatosClientes($_POST['item'], $_POST['valor']);
}
if (isset($_POST['ConvertirCliente']) && $_POST['ConvertirCliente'] == "ok") {
   AjaxClientes::ajaxConvertirCliente($_POST['value']);
}
if (isset($_POST['GuardarRutaCliente']) && $_POST['GuardarRutaCliente'] == "ok") {
   AjaxClientes::ajaxGuardarRutaCliente($_POST);
}
if (isset($_POST['TablaRutasxCliente']) && $_POST['TablaRutasxCliente'] == "ok") {
   AjaxClientes::ajaxRutasxCliente($_POST['idcliente']);
}
if (isset($_POST['DatosRutaCliente']) && $_POST['DatosRutaCliente'] == "ok") {
   AjaxClientes::ajaxDatosRutaCliente($_POST['idrutacliente']);
}
if (isset($_POST['EliminarRutaCliente']) && $_POST['EliminarRutaCliente'] == "ok") {
   AjaxClientes::ajaxEliminarRutaCliente($_POST['idrutacliente']);
}
/* ===================================================
   * COTIZACIONES
===================================================*/
class AjaxCotizaciones
{
   static public function ajaxDatosCotizaciones($documento)
   {
      $respuesta = ModeloCotizaciones::mdlVerCotizacion($documento);
      echo json_encode($respuesta);
   }
}
/* ===================================================
   # LLAMADOS A AJAX COTIZACIONES
===================================================*/
if (isset($_POST['DatosCotizaciones']) && $_POST['DatosCotizaciones'] == "ok") {
   AjaxCotizaciones::ajaxDatosCotizaciones($_POST['value']);
}

/* ===================================================
   * FIJOS
===================================================*/
class AjaxFijos
{
   static public function ajaxDatosFijos($idfijos)
   {
      $respuesta = ModeloFijos::mdlVerFijos($idfijos);
      echo json_encode($respuesta);
   }

   /* ===================================================
      GUARDAR / ASOCIAR VEHICULO A CLIENTE 
   ===================================================*/
   static public function ajaxGuardarVehiculoCliente($idcliente, $idvehiculo)
   {
      $respuesta = ControladorFijos::ctrAgregarVehiculoCliente($idcliente, $idvehiculo);
      
      echo $respuesta;
   }

   /* ===================================================
      TABLA / LISTADO DE VEHICULOS POR CLIENTE
   ===================================================*/

   static public function AjaxCargarTablaVehiculosClientes($idcliente)
   {
      $respuesta = ControladorFijos::ctrVehiculosxCliente($idcliente);

      $tr = "";

      foreach ($respuesta as $key => $value) {
         $tr .= " 
         <tr>
         <td> 
            <div class='btn-group' role='group' aria-label='Button group'>
               <button class='btn btn-xs btn-danger btnEliminarVehiculoRuta' idcliente='{$value["idcliente"]}' idvehiculo='{$value["idvehiculo"]}' > <i class='fas fa-trash'></i> </button>
            </div>
         </td>
         <td> ". $value['placa']  ."</td>
         <td> ". $value['numinterno']  ."</td>
         <td> ". $value['nombre']  ."</td>
         </tr>
         ";
      }



      echo json_encode($tr);
   }

   static public function AjaxEliminarVehiculoxCliente($idcliente, $idvehiculo)
   {
      $respuesta = ModeloFijos::mdlEliminarVehiculoxCliente($idcliente, $idvehiculo);
      echo $respuesta;
   }
}
/* ===================================================
   # LLAMADOS A AJAX FIJOS
===================================================*/
if (isset($_POST['DatosFijos']) && $_POST['DatosFijos'] == "ok") {
   AjaxFijos::ajaxDatosFijos($_POST['value']);
}

#LLAMADO A GUARDAR VEHICULO CLIENTE
if (isset($_POST['Guardar_VehiculoCliente']) && $_POST['Guardar_VehiculoCliente'] == "ok")
{
   AjaxFijos::ajaxGuardarVehiculoCliente($_POST['idcliente'], $_POST['idvehiculo_contrutas']);
}

#LLAMADO A CARGAR TABLA DE VEHICULOS POR CLIENTE
if (isset($_POST['CargarTablaVehiculosClientes']) && $_POST['CargarTablaVehiculosClientes'] == "ok")
{
   AjaxFijos::AjaxCargarTablaVehiculosClientes($_POST['idcliente']);
}

#LLAMADO A ELIMINAR VEHICULO DE UN CLIENTE
if (isset($_POST['EliminarVehiculoCliente']) && $_POST['EliminarVehiculoCliente'] == "ok")
{
   AjaxFijos::AjaxEliminarVehiculoxCliente($_POST['idcliente'], $_POST['idvehiculo']);
}
/* ===================================================
   * ORDEN DE SERVICIO
===================================================*/
class AjaxOrdenServico
{
   static public function ajaxDatosOrden($idorden)
   {
      $respuesta = ModeloOrdenServicio::mdlVerOrden($idorden);
      echo json_encode($respuesta);
   }
}
/* ===================================================
   # LLAMADOS A AJAX ORDENES DE SERVICIO
===================================================*/
if (isset($_POST['DatosOrden']) && $_POST['DatosOrden'] == "ok") {
   AjaxOrdenServico::ajaxDatosOrden($_POST['value']);
}
