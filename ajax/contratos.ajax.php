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

   static public function ajaxCargarSelect($nombre)
   {

      switch ($nombre) {

         case 'listaclientes':

            $tabla = "cont_clientes";
            $item = "nombre";
            $item2 = "Documento";
            $id = "idcliente";
            break;

         case 'listaclientes2':

            $tabla = "cont_clientes";
            $item = "nombre";
            $item2 = "Documento";
            $id = "idcliente";
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

      if ($nombre == "listaclientes" || $nombre == "listaclientes2") {
         $option = "<option value='' selected>-- Seleccione un cliente --</option>";
      } else {
         $option = "<option value='' selected>-- Seleccione {$nombre} --</option>";
      }




      if ($nombre == "listaclientes" || $nombre == "listaclientes2") {

         $respuesta = ModeloClientes::mdlVerCliente(null, "todos");
         foreach ($respuesta as $key => $value) {
            $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]} - {$value["{$datos['item2']}"]}</option>";
         }
         var_dump($respuesta);
      } else if ($nombre == "institucion") {
         $respuesta = ModeloEscolar::mdlClientes();
         foreach ($respuesta as $key => $value) {
            // $option .= "<option value='{$value["{$datos['id']}"]}'> {$value["{$datos['item']}"]} </option> "
            $option .= "<option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]} - {$value["{$datos['item2']}"]}</option>";
         }
      } else {
         $respuesta = ModeloConceptosGenerales::mdlVerRegistro($datos);
         foreach ($respuesta as $key => $value) {

            $option .= " <option value='{$value["{$datos['id']}"]}'>{$value["{$datos['item']}"]} - {$value["{$datos['item2']}"]}</option>";
         }
      }




      echo $option;
   }

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

   /* ===================================================
      GUARDAR CLIENTE
   ===================================================*/
   static public function ajaxGuardarCliente($datos)
   {
      $respuesta = ControladorClientes::ctrAgregarEditar($datos);
      echo $respuesta;
   }

   /* ===================================================
      GUARDAR SEGUIMIENTO CLIENTE
   ===================================================*/
   static public function ajaxGuardarSeguimientoCliente($datos)
   {
      $respuesta = ControladorClientes::ctrGuardarSeguimientoCliente($datos);
      echo $respuesta;
   }

   /* ===================================================
      TABLA VISITAS CLIENTES 
   ===================================================*/
   static public function ajaxTablaVisitasClientes()
   {
      $respuesta = ControladorClientes::ctrVisitasClientes();
      $tr = "";

      foreach ($respuesta as $key => $value) {

         if ($value['idtipificacion'] == 2) { //CLIENTE PROSPECTO

            $estado = '<span class="badge badge-warning btn-tipificacionCliente" idcliente=' . $value['idcliente'] .'  style="cursor:pointer">Cliente prospecto</span>';
        } else if ($value['idtipificacion'] == 1) { //CLIENTE ACTUAL

            $estado = '<span class="badge badge-success btn-tipificacionCliente" idcliente=' . $value['idcliente'] . ' style="cursor:pointer">Cliente</span>';
        } else if ($value['idtipificacion'] == 3) //CLIENTE OCASIONAL
        {
            $estado = '<span class="badge badge-info btn-tipificacionCliente" idcliente=' . $value['idcliente'].' style="cursor:pointer">Cliente ocasional</span>';
        } else if ($value['idtipificacion'] == 4) //CLIENTE NO CUMPLE EL PERFIL
        {
            $estado = '<span class="badge badge-danger btn-tipificacionCliente" idcliente=' . $value['idcliente'].' style="cursor:pointer">Cliente no cumple con el perfil</span>';
        } else if ($value['idtipificacion'] == null) {
            $estado = "Sin tipificación";
        }

        
        $btn_vehiculo = "<button class='btn btn-xs btn-success btnVehiculo' data-toggle='tooltip' data-placement='top' title='Ver tipo de vehículos' idseguimiento='  {$value['idseguimiento']}'><i class='fas fa-bus'></i></button>";

         $tr .= "<tr>
         <td>
         <div class='btn-group' role='group' aria-label='Button group'>
            <button data-toggle='modal' data-target='#SeguimientoClientes' data-placement='top' title='Editar visita' idseguimientoCliente ='{$value['idseguimiento']}' class='btn btn-sm btn-info btn-editarSeguimiento m-1'><i class='far fa-edit'></i></button>
            <button data-toggle='tooltip' data-placement='top' title='Borrar visita' idseguimientoCliente ='{$value['idseguimiento']}' class='btn btn-sm btn-danger btn-eliminarSeguimiento m-1'><i class='fas fa-trash-alt'></i></button>
         </div>
                    </td>
         <td>{$value['Ffecha_visita']}</td>
         <td>{$value['nombre']}</td>
         <td>{$value['contacto']}</td>
         <td>{$value['telefono']}</td>
         <td>{$value['correo']}</td>
         <td>{$btn_vehiculo}</td>
         <td>{$value['sector']}</td>
         <td>{$value['promedio_vehiculos']}</td>
         <td>{$value['promedio_tarifa']}</td>
         <td>{$value['proveedor']}</td>
         <td>{$value['satisfacion']}</td>
         <td>{$estado}</td>
         <td>{$value['Ffecha_proxima']}</td>
         <td>{$value['observaciones']}</td>
         </tr>";
      }

      echo $tr;
   }

   /* ===================================================
      DATOS SEGUIMIENTO CLIENTES 
   ===================================================*/
   static public function ajaxDatosSeguimientoCliente($datos)
   {
      $respuesta = ControladorClientes::ctrDatosSeguimientoClientes($datos);
      echo json_encode($respuesta);
   }

   /* ===================================================
      ELIMINAR SEGUIMIENTO CLIENTES 
   ===================================================*/
   static public function ajaxEliminarSeguimientoCliente($idseguimiento)
   {
      $respuesta = ModeloClientes::mdlEliminarSeguimientoCliente($idseguimiento);
      echo $respuesta;
   }

   /* ===================================================
      GUARDAR LLAMADA CLIENTE 
   ===================================================*/
   static public function ajaxGuardarLlamada($datos)
   {
      $respuesta = ControladorClientes::ctrGuardarLlamada($datos);
      echo $respuesta;
   }

   /* ===================================================
      TABLA DE LLAMADAS 
   ===================================================*/
   static public function ajaxTablaLlamadas()
   {
      $respuesta = ModeloClientes::mdlListaLlamadas();
      $tr = "";

      foreach ($respuesta as $key => $value) {
         $tr .= "<tr>
            <td> 
               <div class='btn-group' role='group' aria-label='Button group'>
                  <button data-toggle='modal' data-target='#modalLlamadas' data-placement='top' title='Editar llamada' idseguimiento_llamada ='{$value['idseguimiento_llamada']}' class='btn btn-sm btn-info btn-editarLlamada m-1'><i class='far fa-edit'></i></button>
                  <button data-toggle='tooltip' data-placement='top' title='Borrar visita' idseguimiento_llamada ='{$value['idseguimiento_llamada']}' class='btn btn-sm btn-danger btn-eliminarLlamada m-1'><i class='fas fa-trash-alt'></i></button>
               </div>
            </td>
            <td>{$value['Ffecha']}</td>
            <td>{$value['nombre']}</td>
            <td>{$value['telefono']}</td>
            <td>{$value['contacto']}</td>
            <td>{$value['Ffecha_cita']}</td>
            <td>{$value['hora']}</td>
            <td>{$value['nombre_recibe']}</td>
            <td>{$value['telefono_recibe']}</td>
            <td>{$value['observacion']}</td>
         </tr>";
      }


      echo $tr;
   }

   /* ===================================================
      DATOS DE LA LLAMADA POR ID
   ===================================================*/
   static public function ajaxDatosLlamada($idseguimiento_llamada)
   {
      $respuesta = ModeloClientes::mdlDatosLlamada($idseguimiento_llamada);
      echo json_encode($respuesta);
   }

   /* ===================================================
      ELIMINAR LLAMADA
   ===================================================*/
   static public function ajaxEliminarLlamada($idseguimiento_llamada)
   {
      $respuesta = ModeloClientes::mdlEliminarLlamda($idseguimiento_llamada);
      echo $respuesta;
   }

   /* ===================================================
      ACTUALIZAR TIPIFICACION DEL CLIENTE 
   ===================================================*/
   static public function ajaxActualizarTipificacion($datos)
   {
      // $respuesta = ModeloClientes::mdlActualizarTipificacion($datos);
      $respuesta = ControladorClientes::ctrActualizarTipificacion($datos);
      echo $respuesta;
   }

   /* ===================================================
      LSITA DE VEHÍCULOS POR ID SEGUIMIENTO
   ===================================================*/
   static public function ajaxListaVehiculos($idseguimiento)
   {
      $respuesta = ModeloClientes::mdlVehiculosxIdseguimiento($idseguimiento);
      echo json_encode($respuesta);
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
#LLAMADO A GUARDAR CLIENTE
if (isset($_POST['GuardarCliente']) && $_POST['GuardarCliente'] == "ok") {
   AjaxClientes::ajaxGuardarCliente($_POST);
}

#LLAMADO A CARGAR SELECTS 
if (isset($_POST['cargarselect']) && $_POST['cargarselect'] == "ok") {
   AjaxClientes::ajaxCargarSelect($_POST['nombreSelect']);
}

#LLAMADO A GUARDAR SEGUIMIENTO
if (isset($_POST['GuardarSeguimiento']) && $_POST['GuardarSeguimiento'] == "ok") {
   AjaxClientes::ajaxGuardarSeguimientoCliente($_POST);
}

#LLAMADO A CARGAR TABLA DE VISITAS CLIENTES 
if (isset($_POST['TablaVisitasClientes']) && $_POST['TablaVisitasClientes'] == "ok") {
   AjaxClientes::ajaxTablaVisitasClientes();
}

#LLAMADO A DATOS DEL SEGUIMIENTO CLIENTES 
if (isset($_POST['datosSeguimientoCliente']) && $_POST['datosSeguimientoCliente'] == "ok") {
   AjaxClientes::ajaxDatosSeguimientoCliente($_POST);
}

#LLAMADO A ELIMINAR SEGUIMIENTO CLIENTES 
if (isset($_POST['EliminarSeguimientoCliente']) && $_POST['EliminarSeguimientoCliente'] == "ok") {
   AjaxClientes::ajaxEliminarSeguimientoCliente($_POST['idseguimiento']);
}

#LLAMADO A GUARDAR LLAMADA CLIENTE
if (isset($_POST['GuardarLlamada']) && $_POST['GuardarLlamada'] == "ok") {
   AjaxClientes::ajaxGuardarLlamada($_POST);
}

#LLAMADO A TABLA DE LLAMADAS 
if (isset($_POST['TablaLlamadas']) && $_POST['TablaLlamadas'] == "ok") {
   AjaxClientes::ajaxTablaLlamadas();
}

#LLAMADO A DATOS DE LA LLAMADA
if (isset($_POST['DatosLlamada']) && $_POST['DatosLlamada'] == "ok") {
   AjaxClientes::ajaxDatosLlamada($_POST['idseguimiento_llamada']);
}

#LLAMADO A ELIMINAR LLAMADA
if (isset($_POST['EliminarLlamada']) && $_POST['EliminarLlamada'] == "ok") {
   AjaxClientes::ajaxEliminarLlamada($_POST['idseguimiento_llamada']);
}

#LLAMADO A CAMBIAR TIPIFICACION 
if(isset($_POST['ActualizarTipificacion']) && $_POST['ActualizarTipificacion'] == "ok")
{
   AjaxClientes::ajaxActualizarTipificacion($_POST);
}

#LLAMADO A CARGAR LISTA DE VEHÍCULOS 
if(isset($_POST['DatosVehiculoxidseguimiento']) && $_POST['DatosVehiculoxidseguimiento'] == "ok")
{
   AjaxClientes::ajaxListaVehiculos($_POST['idseguimiento']);
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
         <td> " . $value['placa']  . "</td>
         <td> " . $value['numinterno']  . "</td>
         <td> " . $value['nombre']  . "</td>
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
if (isset($_POST['Guardar_VehiculoCliente']) && $_POST['Guardar_VehiculoCliente'] == "ok") {
   AjaxFijos::ajaxGuardarVehiculoCliente($_POST['idcliente'], $_POST['idvehiculo_contrutas']);
}

#LLAMADO A CARGAR TABLA DE VEHICULOS POR CLIENTE
if (isset($_POST['CargarTablaVehiculosClientes']) && $_POST['CargarTablaVehiculosClientes'] == "ok") {
   AjaxFijos::AjaxCargarTablaVehiculosClientes($_POST['idcliente']);
}

#LLAMADO A ELIMINAR VEHICULO DE UN CLIENTE
if (isset($_POST['EliminarVehiculoCliente']) && $_POST['EliminarVehiculoCliente'] == "ok") {
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
