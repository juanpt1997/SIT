<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/conceptos.controlador.php';
require_once '../models/conceptos.modelo.php';
require_once '../models/gh.modelo.php';
require_once '../controllers/files.controlador.php';
/**
 * 
 */

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
	echo "<script>window.location = 'inicio';</script>";
	die();
}

/*=============================================================
=====================AJAX CONCEPTOS GENERALES==================
============================================================?*/
class AjaxConceptosGenerales
{
	//Ajax NUEVO registro 1 campo general
	static public function ajaxNuevo($concepto, $dato)
	{

		switch ($concepto) {
				//GESTION HUMANA
			case 'Tipo de ausentismo':
				$tabla = "gh_tipoausentismo";
				$item = "descripcion";
				break;

			case 'Sucursales':
				$tabla = "gh_sucursales";
				$item = "sucursal";
				break;

			case 'Procesos':
				$tabla = "gh_procesos";
				$item = "proceso";
				break;

			case 'ARL':
				$tabla = "gh_arl";
				$item = "arl";
				break;

			case 'AFP':
				$tabla = "gh_fondospension";
				$item = "fondo";
				break;

			case 'Departamentos':
				$tabla = "gh_departamentos";
				$item = "nombre";
				break;

			case 'EPS':
				$tabla = "gh_eps";
				$item = "eps";
				break;
			case 'cargo':
				$tabla = "gh_cargos";
				$item = "cargo";
				break;
				//VEHICULAR
				// case 'Tipos de vehiculos':
				// 	$tabla = "v_tipovehiculos";
				// 	$item = "tipovehiculo";
				// 	break;

			case 'Marcas de vehículos':
				$tabla = "v_marcas";
				$item = "marca";
				break;

			case 'Objeto de contrato':
				$tabla = "v_objetocontrato";
				$item = "objetocontrato";
				break;

				//MANTENIMIENTO
			case 'Descripción de actividades':
				$tabla = "m_actividades";
				$item = "actividad";
				break;

			case 'Mantenimiento diagnostico':
				$tabla = "m_diagnosticos";
				$item = "diagnostico";
				break;

			case 'Repuestos':
				$tabla = "m_repuestos";
				$item = "repuesto";
				break;

			case 'Medidas':
				$tabla = "a_medidas";
				$item = "medida";
				break;

			case 'Marcas productos':
				$tabla = "a_marcas";
				$item = "marca";
				break;

			case 'Categorias':
				$tabla = "a_categorias";
				$item = "categoria";
				break;

			case 'Tipo de proveedor':
				$tabla = "c_tipo_proveedor";
				$item = "tipo";
				break;

			case 'Servicios externos':
				$tabla = "m_serviciosexternos";
				$item = "nombre";
				break;
			case 'Tamaños llantas':
				$tabla = "a_tamanios";
				$item = "tamanio";
				break;
			case 'Trabajos llantas':
				$tabla = "m_trabajos_llantas";
				$item = "trabajo";
				break;

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item,
			"valor" => $dato
		);

		$validacion = ControladorExistencia::ctrValidarExistencia($datos);

		if ($validacion == 'ok') {

			$respuesta = 'ok';
			echo $respuesta;
		} else if ($validacion == 'existe') {

			$respuesta = 'existe';
			echo $respuesta;
		} else if ($validacion == 'no_existe') {

			$respuesta = ModeloConceptosGenerales::mdlNuevo($datos);
			echo $respuesta;
		}

		//echo $respuesta;
	}
	//AJAX LISTAR todos los registros de 1 campo
	static public function ajaxVerTodos($concepto)
	{
		switch ($concepto) {

			case 'Tipo de ausentismo':
				$conceptoE = "Tipo de ausentismo";
				$tabla = "gh_tipoausentismo";
				$item = "descripcion";
				$id = "idtipo";
				break;

			case 'Sucursales':
				$conceptoE = "Sucursales";
				$tabla = "gh_sucursales";
				$item = "sucursal";
				$id = "ids";
				break;

			case 'Procesos':
				$conceptoE = "Procesos";
				$tabla = "gh_procesos";
				$item = "proceso";
				$id = "idProceso";
				break;

			case 'ARL':
				$tabla = "gh_arl";
				$item = "arl";
				$id = "idarl";
				break;

			case 'AFP':
				$tabla = "gh_fondospension";
				$item = "fondo";
				$id = "idfondo";
				break;

			case 'Departamentos':
				$tabla = "gh_departamentos";
				$item = "nombre";
				$id = "iddepartamento";
				break;

			case 'EPS':
				$tabla = "gh_eps";
				$item = "eps";
				$id = "ideps";
				break;
			case 'cargo':
				$tabla = "gh_cargos";
				$item = "cargo";
				$id = "idCargo";
				break;

				//VEHICULAR
				// case 'Tipos de vehiculos':
				// 	$tabla = "v_tipovehiculos";
				// 	$item = "tipovehiculo";
				// 	$id = "idtipovehiculo";
				// 	break;

			case 'Marcas de vehículos':
				$tabla = "v_marcas";
				$item = "marca";
				$id = "idmarca";
				break;

			case 'Objeto de contrato':
				$tabla = "v_objetocontrato";
				$item = "objetocontrato";
				$id = "idobjeto";
				break;

				//MANTENIMIENTO
			case 'Descripción de actividades':
				$tabla = "m_actividades";
				$item = "actividad";
				$id = "idactividad";
				break;

			case 'Mantenimiento diagnostico':
				$tabla = "m_diagnosticos";
				$item = "diagnostico";
				$id = "iddiagnostico";
				break;

			case 'Repuestos':
				$tabla = "m_repuestos";
				$item = "repuesto";
				$id = "idrepuesto";
				break;

			case 'Medidas':
				$tabla = "a_medidas";
				$item = "medida";
				$id = "idmedidas";
				break;

			case 'Marcas productos':
				$tabla = "a_marcas";
				$item = "marca";
				$id = "idmarca";
				break;

			case 'Categorias':
				$tabla = "a_categorias";
				$item = "categoria";
				$id = "idcategorias";
				break;

			case 'Tipo de proveedor':
				$tabla = "c_tipo_proveedor";
				$item = "tipo";
				$id = "id";
				break;

			case 'Servicios externos':
				$tabla = "m_serviciosexternos";
				$item = "nombre";
				$id = "idservicio_externo";
				break;
			case 'Tamaños llantas':
				$tabla = "a_tamanios";
				$item = "tamanio";
				$id = "idtamanio";
				break;
			case 'Trabajos llantas':
				$tabla = "m_trabajos_llantas";
				$item = "trabajo";
				$id = "idtrabajo";
				break;

			default:
				// code...
				break;
		}

		$datos = array(
			"tabla" => $tabla,
			"item"  => $item,
			"id" => $id
		);

		$respuesta = ModeloConceptosGenerales::mdlVer($datos);
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["{$datos['id']}"]}</td>
			<td>{$value["{$datos['item']}"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["{$datos['id']}"]}' concepto = '{$concepto}' dato='{$value["{$datos['item']}"]}' class='btn btn-sm btn-warning btnEditar'><i class='fas fa-edit'></i></button>
			</div>
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["{$datos['id']}"]}' valor-cambio = '0' concepto = '{$concepto}' class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}

		echo $tr;
	}
	//Ajax editar datos de un concepto segun su id
	static public function ajaxEditar($concepto, $id, $dato)
	{
		switch ($concepto) {

			case 'Tipo de ausentismo':
				$tabla = "gh_tipoausentismo";
				$item = "descripcion";
				$idtabla = "idtipo";
				break;

			case 'Sucursales':
				$tabla = "gh_sucursales";
				$item = "sucursal";
				$idtabla = "ids";
				break;

			case 'Procesos':
				$tabla = "gh_procesos";
				$item = "proceso";
				$idtabla = "idProceso";
				break;

			case 'ARL':
				$tabla = "gh_arl";
				$item = "arl";
				$idtabla = "idarl";
				break;

			case 'AFP':
				$tabla = "gh_fondospension";
				$item = "fondo";
				$idtabla = "idfondo";
				break;

			case 'Departamentos':
				$tabla = "gh_departamentos";
				$item = "nombre";
				$idtabla = "iddepartamento";
				break;

			case 'EPS':
				$tabla = "gh_eps";
				$item = "eps";
				$idtabla = "ideps";
				break;
			case 'cargo':
				$tabla = "gh_cargos";
				$item = "cargo";
				$idtabla = "idCargo";
				break;

				//VEHICULAR
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$item = "tipovehiculo";
				$idtabla = "idtipovehiculo";
				break;

			case 'Marcas de vehículos':
				$tabla = "v_marcas";
				$item = "marca";
				$idtabla = "idmarca";
				break;

			case 'Objeto de contrato':
				$tabla = "v_objetocontrato";
				$item = "objetocontrato";
				$idtabla = "idobjeto";
				break;

				//MANTENIMIENTO
			case 'Descripción de actividades':
				$tabla = "m_actividades";
				$item = "actividad";
				$idtabla = "idactividad";
				break;

			case 'Mantenimiento diagnostico':
				$tabla = "m_diagnosticos";
				$item = "diagnostico";
				$idtabla = "iddiagnostico";
				break;

			case 'Repuestos':
				$tabla = "m_repuestos";
				$item = "repuesto";
				$idtabla = "idrepuesto";
				break;

			case 'Medidas':
				$tabla = "a_medidas";
				$item = "medida";
				$idtabla = "idmedidas";
				break;

			case 'Marcas productos':
				$tabla = "a_marcas";
				$item = "marca";
				$idtabla = "idmarca";
				break;

			case 'Categorias':
				$tabla = "a_categorias";
				$item = "categoria";
				$idtabla = "idcategorias";
				break;

			case 'Tipo de proveedor':
				$tabla = "c_tipo_proveedor";
				$item = "tipo";
				$idtabla = "id";
				break;

			case 'Servicios externos':
				$tabla = "m_serviciosexternos";
				$item = "nombre";
				$idtabla = "idservicio_externo";
				break;
			case 'Tamaños llantas':
				$tabla = "a_tamanios";
				$item = "tamanio";
				$idtabla = "idtamanio";
				break;
			case 'Trabajos llantas':
				$tabla = "m_trabajos_llantas";
				$item = "trabajo";
				$idtabla = "idtrabajo";
				break;
			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item,
			"idtabla" => $idtabla,
			"id" => $id,
			"valor" => $dato
		);
		$respuesta = ModeloConceptosGenerales::mdlEditar($datos);

		echo $respuesta;
	}
	//Ajax para visualizar datos de un concepto por su ID
	static public function ajaxVerRegistro($concepto, $id)
	{
		switch ($concepto) {

			case 'Tipo de ausentismo':
				$tabla = "gh_tipoausentismo";
				$item = "descripcion";
				break;

			case 'Sucursales':
				$tabla = "gh_sucursales";
				$item = "sucursal";
				break;

			case 'Procesos':
				$tabla = "gh_procesos";
				$item = "proceso";
				break;

			case 'ARL':
				$tabla = "gh_arl";
				$item = "arl";
				break;

			case 'AFP':
				$tabla = "gh_fondospension";
				$item = "fondo";
				break;

			case 'Departamentos':
				$tabla = "gh_departamentos";
				$item = "nombre";
				break;

			case 'EPS':
				$tabla = "gh_eps";
				$item = "eps";
				break;
			case 'cargo':
				$tabla = "gh_cargos";
				$item = "cargo";
				break;

				//VEHICULAR
			case 'Tipos de vehículos':
				$tabla = "v_tipovehiculos";
				$item = "tipovehiculo";
				break;

			case 'Marcas de vehículos':
				$tabla = "v_marcas";
				$item = "marca";
				break;

			case 'Objeto de contrato':
				$tabla = "v_objetocontrato";
				$item = "objetocontrato";
				break;

				//MANTENIMIENTO
			case 'Descripción de actividades':
				$tabla = "m_actividades";
				$item = "actividad";
				break;

			case 'Mantenimiento diagnostico':
				$tabla = "m_diagnosticos";
				$item = "diagnostico";
				break;

			case 'Repuestos':
				$tabla = "m_repuestos";
				$item = "repuesto";
				break;

			case 'Medidas':
				$tabla = "a_medidas";
				$item = "medida";
				break;

			case 'Marcas productos':
				$tabla = "a_marcas";
				$item = "marca";
				break;

			case 'Categorias':
				$tabla = "a_categorias";
				$item = "categoria";
				break;

			case 'Tipo de proveedor':
				$tabla = "c_tipo_proveedor";
				$item = "tipo";
				break;

			case 'Servicios externos':
				$tabla = "m_serviciosexternos";
				$item = "nombre";
				break;
			case 'Tamaños llantas':
				$tabla = "a_tamanios";
				$item = "tamanio";
				break;
			case 'Trabajos llantas':
				$tabla = "m_trabajos_llantas";
				$item = "trabajo";
				break;

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item,
			"id" => $id
		);
		$respuesta = ModeloConceptosGenerales::mdlVerUnConcepto($datos);
	}
	//Ajax para el contador de registros de las maestras
	static public function ajaxContarRegistro($concepto)
	{
		switch ($concepto) {
				//GESTION HUMANA
			case 'Tipo de ausentismo':
				$tabla = "gh_tipoausentismo";
				$item = "descripcion";
				break;

			case 'Sucursales':
				$tabla = "gh_sucursales";
				$item = "sucursal";
				break;

			case 'Procesos':
				$tabla = "gh_procesos";
				$item = "proceso";
				break;

			case 'ARL':
				$tabla = "gh_arl";
				$item = "arl";
				break;

			case 'AFP':
				$tabla = "gh_fondospension";
				$item = "fondo";
				break;

			case 'Departamentos':
				$tabla = "gh_departamentos";
				$item = "nombre";
				break;

			case 'EPS':
				$tabla = "gh_eps";
				$item = "eps";
				break;
			case 'cargo':
				$tabla = "gh_cargos";
				$item = "cargo";
				break;
				//VEHICULAR
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$item = "tipovehiculo";
				break;

			case 'Marcas de vehículos':
				$tabla = "v_marcas";
				$item = "marca";
				break;

			case 'Objeto de contrato':
				$tabla = "v_objetocontrato";
				$item = "objetocontrato";
				break;

			case 'Documento vehicular':
				$tabla = "v_tipodocumento";
				$item = "tipodocumento";
				break;

			case 'Categorias de licencias':
				$tabla = "v_categoria_licencias";
				$item = "tipo";
				break;

			case 'Tipos de identificación':
				$tabla = "documentosidentificacion";
				$item = "tipo";
				break;

				//MANTENIMIENTO
			case 'Descripción de actividades':
				$tabla = "m_actividades";
				$item = "actividad";
				break;

			case 'Mantenimiento diagnostico':
				$tabla = "m_diagnosticos";
				$item = "diagnostico";
				break;

			case 'Repuestos':
				$tabla = "m_repuestos";
				$item = "repuesto";
				break;

			case 'Rutas y recorridos':
				$tabla = "v_rutas";
				$item = "id";
				break;

			case 'Ciudades':
				$tabla = "gh_municipios";
				$item = "municipio";
				break;

			case 'Servicios menores':
				$tabla = "m_serviciosmenores";
				$item = "servicio";
				break;

			case 'Medidas':
				$tabla = "a_medidas";
				$item = "medida";
				break;

			case 'Marcas productos':
				$tabla = "a_marcas";
				$item = "marca";
				break;

			case 'Categorias':
				$tabla = "a_categorias";
				$item = "categoria";
				break;

			case 'Tipo de proveedor':
				$tabla = "c_tipo_proveedor";
				$item = "tipo";
				break;

			case 'Servicios externos':
				$tabla = "m_serviciosexternos";
				$item = "nombre";
				break;
			case 'Cuentas contables':
				$tabla = "li_cuentas_contables";
				$item = "num_cuenta";
				break;
			case 'Tamaños llantas':
				$tabla = "a_tamanios";
				$item = "tamanio";
				break;
			case 'Trabajos llantas':
				$tabla = "m_trabajos_llantas";
				$item = "trabajo";
				break;

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item
		);

		$respuesta = ModeloConceptosGenerales::mdlContarRegistros($datos);

		echo json_encode($respuesta);
	}
	//Agregar nuevo Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxNuevoDos($concepto, $dato1, $dato2)
	{
		switch ($concepto) {
			case 'Documento vehicular':
				$tabla = "v_tipodocumento";
				$item1 = "tipodocumento";
				$item2 = "diasalerta";
				break;

			case 'Categorias de licencias':
				$tabla = "v_categoria_licencias";
				$item1 = "tipo";
				$item2 = "descripcion";
				break;

			case 'Tipos de identificación':
				$tabla = "documentosidentificacion";
				$item1 = "tipo";
				$item2 = "descripcion";
				break;

			case 'Cuentas contables':
				$tabla = "li_cuentas_contables";
				$item1 = "num_cuenta";
				$item2 = "nombre_cuenta";
				break;
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$item1 = "tipovehiculo";
				$item2 = "categoria";
				break;


			default:
				# code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item1" => $item1,
			"item2" => $item2,
			"valor1" => $dato1,
			"valor2" => $dato2
		);

		$respuesta = ModeloConceptosGenerales::mdlNuevoDosCampos($datos);

		echo $respuesta;
	}
	//Ajax Editar datos de Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxEditarDos($concepto, $id, $dato1, $dato2)
	{
		switch ($concepto) {
			case 'Documento vehicular':
				$tabla = "v_tipodocumento";
				$item1 = "tipodocumento";
				$item2 = "diasalerta";
				$idtabla = "idtipo";
				break;

			case 'Categorias de licencias':
				$tabla = "v_categoria_licencias";
				$item1 = "tipo";
				$item2 = "descripcion";
				$idtabla = "idlicencia";
				break;

			case 'Tipos de identificación':
				$tabla = "documentosidentificacion";
				$item1 = "tipo";
				$item2 = "descripcion";
				$idtabla = "iddocumento";
				break;

			case 'Cuentas contables':
				$tabla = "li_cuentas_contables";
				$item1 = "num_cuenta";
				$item2 = "nombre_cuenta";
				$idtabla = "id";
				break;
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$item1 = "tipovehiculo";
				$item2 = "categoria";
				$idtabla = "idtipovehiculo";
				break;



			default:
				# code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item1" => $item1,
			"item2" => $item2,
			"valor1" => $dato1,
			"valor2" => $dato2,
			"idtabla" => $idtabla,
			"id" => $id
		);

		$respuesta = ModeloConceptosGenerales::mdlEditarDosCampos($datos);

		echo $respuesta;
	}
	//Ajax Visualizar datos de un registro de Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxVerRegistroDos($concepto, $id)
	{
		switch ($concepto) {

			case 'Documento vehicular':
				$tabla = "v_tipodocumento";
				$item1 = "tipodocumento";
				$item2 = "diasalerta";
				break;

			case 'Categorias de licencias':
				$tabla = "v_categoria_licencias";
				$item1 = "tipo";
				$item2 = "descripcion";
				break;

			case 'Tipos de identificación':
				$tabla = "documentosidentificacion";
				$item1 = "tipo";
				$item2 = "descripcion";
				break;

			case 'Cuentas contables':
				$tabla = "li_cuentas_contables";
				$item1 = "num_cuenta";
				$item2 = "nombre_cuenta";
				break;

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item1" => $item1,
			"item2" => $item2,
			"id" => $id
		);

		$respuesta = ModeloConceptosGenerales::mdlListarRegistroDosCampos($datos);
	}
	//Ajax Listar todos los registros de Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxVerTodosDos($concepto)
	{
		switch ($concepto) {

			case 'Documento vehicular':
				$tabla = "v_tipodocumento";
				$item1 = "tipodocumento";
				$item2 = "diasalerta";
				$id = "idtipo";
				break;

			case 'Categorias de licencias':
				$tabla = "v_categoria_licencias";
				$item1 = "tipo";
				$item2 = "descripcion";
				$id = "idlicencia";
				break;

			case 'Tipos de identificación':
				$tabla = "documentosidentificacion";
				$item1 = "tipo";
				$item2 = "descripcion";
				$id = "iddocumento";
				break;

			case 'Cuentas contables':
				$tabla = "li_cuentas_contables";
				$item1 = "num_cuenta";
				$item2 = "nombre_cuenta";
				$id = "id";
				break;
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$item1 = "tipovehiculo";
				$item2 = "categoria";
				$id = "idtipovehiculo";
				break;

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item1" => $item1,
			"item2" => $item2,
			"id" => $id
		);

		$respuesta = ModeloConceptosGenerales::mdlListarDosCampos($datos);
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["{$datos['id']}"]}</td>
			<td>{$value["{$datos['item1']}"]}</td>
			<td>{$value["{$datos['item2']}"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["{$datos['id']}"]}' concepto = '{$concepto}' dato1 ='{$value["{$datos['item1']}"]}' dato2 ='{$value["{$datos['item2']}"]}' class='btn btn-sm btn-warning btnEditarV2'><i class='fas fa-edit'></i></button>
			</div>
			<div class='btn-group' role='group' aria-label='Button group'>
			<button  idregistro = '{$value["{$datos['id']}"]}' valor-cambio = '0' concepto = '{$concepto}' class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}

		echo $tr;
	}
	//Ajax para el borrado logico de los registros de conceptos generales
	static public function ajaxEliminar($id, /*$valor_cambio,*/ $concepto)
	{
		switch ($concepto) {
				//GESTION HUMANA
			case 'Tipo de ausentismo':
				$tabla = "gh_tipoausentismo";
				$id_tabla = "idtipo";
				break;

			case 'Sucursales':
				$tabla = "gh_sucursales";
				$id_tabla = "ids";
				break;

			case 'Procesos':
				$tabla = "gh_procesos";
				$id_tabla = "idProceso";
				break;

			case 'ARL':
				$tabla = "gh_arl";
				$id_tabla = "idarl";
				break;

			case 'AFP':
				$tabla = "gh_fondospension";
				$id_tabla = "idfondo";
				break;

			case 'Departamentos':
				$tabla = "gh_departamentos";
				$id_tabla = "iddepartamento";
				break;

			case 'EPS':
				$tabla = "gh_eps";
				$id_tabla = "ideps";
				break;
			case 'cargo':
				$tabla = "gh_cargos";
				$id_tabla = "idCargo";
				break;
				//VEHICULAR
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$id_tabla = "idtipovehiculo";
				break;

			case 'Marcas de vehículos':
				$tabla = "v_marcas";
				$id_tabla = "idmarca";
				break;

			case 'Objeto de contrato':
				$tabla = "v_objetocontrato";
				$id_tabla = "idobjeto";
				break;

				//MANTENIMIENTO
			case 'Descripción de actividades':
				$tabla = "m_actividades";
				$id_tabla = "idactividad";
				break;

			case 'Mantenimiento diagnostico':
				$tabla = "m_diagnosticos";
				$id_tabla = "iddiagnostico";
				break;

			case 'Repuestos':
				$tabla = "m_repuestos";
				$id_tabla = "idrepuesto";
				break;

			case 'Ciudades':
				$tabla = "gh_municipios";
				$id_tabla = "idmunicipio";
				break;

			case 'Rutas y recorridos':
				$tabla = "v_rutas";
				$id_tabla = "id";
				break;

			case 'Documento vehicular':
				$tabla = "v_tipodocumento";
				$id_tabla = "idtipo";
				break;

			case 'Categorias de licencias':
				$tabla = "licencias";
				$id_tabla = "idlicencia";
				break;

			case 'Tipos de identificación':
				$tabla = "documentosidentificacion";
				$id_tabla = "iddocumento";
				break;

			case 'Servicios menores':
				$tabla = "m_serviciosmenores";
				$id_tabla = "idservicio";
				break;

			case 'Medidas':
				$tabla = "a_medidas";
				$id_tabla = "idmedidas";
				break;

			case 'Marcas productos':
				$tabla = "a_marcas";
				$id_tabla = "idmarca";
				break;

			case 'Categorias':
				$tabla = "a_categorias";
				$id_tabla = "idcategorias";
				break;

			case 'Tipo de proveedor':
				$tabla = "c_tipo_proveedor";
				$id_tabla = "id";
				break;

			case 'Servicios externos':
				$tabla = "m_serviciosexternos";
				$id_tabla = "idservicio_externo";
				break;
			case 'Cuentas contables':
				$tabla = "li_cuentas_contables";
				$id_tabla = "id";
				break;
			case 'Tamaños llantas':
				$tabla = "a_tamanios";
				$id_tabla = "idtamanio";
				break;
			case 'Trabajos llantas':
				$tabla = "m_trabajos_llantas";
				$id_tabla = "idtrabajo";
				break;

			default:
				// code...
				break;
		}

		$datos = array(
			"tabla" => $tabla,
			// "item" => "estado",
			// "valor" => $valor_cambio,
			"id_tabla" => $id_tabla,
			"id" => $id
		);

		$respuesta = ModeloConceptosGenerales::mdlEliminar($datos);

		echo $respuesta;
	}

	static public function ValidarExistencia($datos)
	{
		$respuesta = ModeloConceptosGenerales::mdlVerificarExistencia($datos);

		if (is_array($respuesta)) {
			$retorno = true;
			return $retorno;
		} else if ($respuesta === false) {
			$retorno = false;
			return $retorno;
		}
	}
}
/*=============================================================
=====================AJAX CIUDADES=============================
============================================================?*/
class AjaxCiudades
{
	//Ajax apra agregar una nueva ciudad
	static public function AgregarCiudad($dato1, $dato2)
	{
		$datos = array(
			"iddepartamento" => $dato1,
			"municipio" => $dato2
		);

		$respuesta = ModeloCiudades::mdlAgregarCiudad($datos);
		echo $respuesta;
	}
	//Ajax para editar los datos de una ciudad segun su ID
	static public function EditarCiudad($dato1, $dato2, $id)
	{
		$datos = array(
			"iddepartamento" => $dato1,
			"municipio" => $dato2,
			"idmunicipio" => $id
		);

		$respuesta = ModeloCiudades::mdlEditarCiudad($datos);
		echo $respuesta;
	}
	//Ajax para listar todas las ciudadas
	static public function VerCiudades()
	{
		$respuesta = ModeloCiudades::mdlDeparMunicipios();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["idmunicipio"]}</td>
			<td>{$value["departamento"]}</td>
			<td>{$value["municipio"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["idmunicipio"]}' dato1='{$value["departamento"]}' dato2='{$value["municipio"]}' class='btn btn-sm btn-warning btnEditarCiudad' data-toggle='modal' data-target='#EditarCiudad'><i class='fas fa-edit'></i></button>
			</div>
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["idmunicipio"]}' valor-cambio = '0' concepto = 'Ciudades' class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}
		echo $tr;
	}
	//Ajax para visualizar los datos de una ciudad segun su ID
	static public function DatosCiudad($id)
	{
		$respuesta = ControladorCiudades::ctrVerCiudad($id);
		echo json_encode($respuesta);
	}
}
/*=============================================================
=====================AJAX RUTAS================================
============================================================?*/
class AjaxRutas
{
	//Ajax Agregar una nueva ruta
	static public function AgregarRuta($dato1, $dato2, $dato3)
	{
		$datos = array(
			"ruta" => $dato1,
			"origen" => $dato2,
			"destino" => $dato3
		);

		$respuesta = ModeloRutas::mdlAgregarRuta($datos);
		echo $respuesta;
	}
	//Ajax Editar datos de una ruta segun su id
	static public function EditarRuta($dato3, $id)
	{
		$datos = array(
			"ruta" => $dato3,
			"idruta" => $id
		);

		$respuesta = ModeloRutas::mdlEditarRuta($datos);
		echo $respuesta;
	}
	//Ajax Visualizar todas las rutas en la tabla
	static public function VerRutas()
	{

		$respuesta = ControladorRutas::ctrListarRutas();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["id"]}</td>
			<td>{$value["orig"]}</td>
			<td>{$value["dest"]}</td>
			<td>{$value["nombreruta"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["id"]}' dato1='{$value["orig"]}' dato2='{$value["dest"]}' dato3='{$value["nombreruta"]}' class='btn btn-sm btn-warning btnEditarRuta '><i class='fas fa-edit'></i></button>
			</div>
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["id"]}' valor-cambio = '0' concepto = 'Rutas y recorridos' class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}

		echo $tr;
	}
	//Ajax para visualizar y seleccionar las rutas en otra vista diferente a conceptos generales
	static public function ajaxTablaRutasGeneral()
	{

		$respuesta = ControladorRutas::ctrListarRutas();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["id"]}</td>
			<td>{$value["orig"]}</td>
			<td>{$value["dest"]}</td>
			<td>{$value["nombreruta"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button data-toggle='tooltip' data-placement='top' title='Seleccionar ruta' idregistro = '{$value["id"]}' origen='{$value["orig"]}' destino='{$value["dest"]}' descripcion='{$value["nombreruta"]}' class='btn btn-sm btn-success btnSeleccionarRuta '><i class='fas fa-check'></i></button>
			</div>
			</td>
			</tr>
			";
		}

		echo $tr;
	}
}
/*=============================================================
=====================AJAX EMPRESA==============================
============================================================?*/
class AjaxConceptoEmpresa
{
	//Ajax visualizar datos de una empresa segun su ID
	static public function ajaxDatosEmpresa($id)
	{
		$respuesta = ModeloEmpresaRaiz::mdlUnaEmpresa($id);
		echo json_encode($respuesta);
	}
	//Ajax editar empresa
	static public function ajaxEditarEmpresa($formData, $imagen)
	{
		$respuesta = ControladorEmpresa::ctrAgregarEditarEmpresa($formData, $imagen);
		echo $respuesta;
		//echo json_encode($respuesta);
	}
	//Ajax para listar todas las empresas en la tabla (Limitado a una empresa)
	static public function ajaxVerEmpresa()
	{
		$respuesta = ModeloEmpresaRaiz::mdlListaEmpresa();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			if ($value['ruta_firma'] != null) {
				$btnVerFoto = "<a href='" . URL_APP . $value['ruta_firma'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
			} else {
				$btnVerFoto = "";
			}

			$tr .= "
			<tr>
			<td>{$value['id']}</td>
			<td>{$value['razon_social']}</td>
			<td>{$value['nit']}</td>
			<td>{$value['nro_resolucion']}</td>
			<td>{$value['anio_resolucion']}</td>
			<td>{$value['dir_territorial']}</td>
			<td>" . $btnVerFoto . "</td>
			<td>{$value['sitio_web']}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button id = '{$value['id']}' razon ='{$value['razon_social']}' class='btn btn-sm btn-warning btnEditarEmpresa'><i class='fas fa-edit'></i></button>
			</div>
			</td>
			</tr>
			";
		}
		echo $tr;
	}
}
/*=============================================================
=====================AJAX SERVICIOS MENORES====================
============================================================?*/
class AjaxConceptoServicios
{
	//Ajax para agregar un nuevo servicio
	static public function ajaxNuevoServicio($servicio, $kilometraje, $dias)
	{
		$datos = array(
			"servicio" => $servicio,
			"kilometraje_cambio" => $kilometraje,
			"dias_cambio" => $dias
		);

		$respuesta = ModeloServiciosMenores::mdlAgregarServicio($datos);
		echo $respuesta;
	}

	//AJAX para listar todos los servicios
	static public function ajaxVerServicios()
	{
		$respuesta = ModeloServiciosMenores::mdlVerServicios(null);
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["idservicio"]}</td>
			<td>{$value["servicio"]}</td>
			<td>{$value["kilometraje_cambio"]}</td>
			<td>{$value["dias_cambio"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["idservicio"]}' concepto = 'Servicios menores' dato1 = '{$value["servicio"]}' dato2 = '{$value["kilometraje_cambio"]}' dato3 = '{$value["dias_cambio"]}' class='btn btn-sm btn-warning btnEditarS'><i class='fas fa-edit'></i></button>
			</div>
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["idservicio"]}' concepto = 'Servicios menores' class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}
		echo $tr;
	}

	//Ajax editar datos de un concepto segun su id
	static public function ajaxEditarServicio($id, $dato1, $dato2, $dato3)
	{
		$datos = array(
			"idservicio" => $id,
			"servicio" => $dato1,
			"kilometraje_cambio" => $dato2,
			"dias_cambio" => $dato3,
		);

		$respuesta = ModeloServiciosMenores::mdlEditarServicio($datos);

		echo $respuesta;
	}
}
/*=============================================================
=====================AJAX TIPO DOCUMENTO VEHICULAR====================
============================================================?*/
class AjaxTipoDocumentoVehicular
{
	//Ajax apra agregar una nuevo documento vehicular
	static public function AgregarTipoDocumento($datos)
	{
		$respuesta = ModeloTipoDocumentoVehicular::mdlAgregar($datos);
		echo $respuesta;
	}
	//Ajax para editar los datos de un documento vehicular
	static public function EditarTipoDocumento($datos)
	{
		$respuesta = ModeloTipoDocumentoVehicular::mdlEditar($datos);
		echo $respuesta;
	}
	//Ajax para visualizar los datos de una ciudad segun su ID
	static public function DatosTipoDocumento($id)
	{
		$respuesta = ModeloTipoDocumentoVehicular::mdlDatosRegistro($id);
		echo json_encode($respuesta);
	}
}

/*=============================================================
=====================LLAMADOS conceptos generales==============
============================================================?*/
if (isset($_POST['Nuevo']) && $_POST['Nuevo'] == "ok") {
	AjaxConceptosGenerales::ajaxNuevo($_POST['concepto'], $_POST['dato']);
}
if (isset($_POST['VerTodos']) && $_POST['VerTodos'] == "ok") {
	AjaxConceptosGenerales::ajaxVerTodos($_POST['concepto']);
}
if (isset($_POST['ajaxEditarConcepto']) && $_POST['ajaxEditarConcepto'] == "ok") {
	AjaxConceptosGenerales::ajaxEditar($_POST['concepto'], $_POST['id'], $_POST['dato']);
}
if (isset($_POST['ajaxVerUnConcepto']) && $_POST['ajaxVerUnConcepto'] == "ok") {
	AjaxConceptosGenerales::ajaxVerRegistro($_POST['concepto'], $_POST['id'], $_POST['id']);
}
if (isset($_POST['ajaxContarRegistro']) && $_POST['ajaxContarRegistro'] == "ok") {
	AjaxConceptosGenerales::ajaxContarRegistro($_POST['concepto']);
}
if (isset($_POST['NuevoDos']) && $_POST['NuevoDos'] == "ok") {
	AjaxConceptosGenerales::ajaxNuevoDos($_POST['concepto'], $_POST['dato1'], $_POST['dato2']);
}
if (isset($_POST['VerTodosDos']) && $_POST['VerTodosDos'] == "ok") {
	AjaxConceptosGenerales::ajaxVerTodosDos($_POST['concepto']);
}
if (isset($_POST['VerUno']) && $_POST['VerUno'] == "ok") {
	AjaxConceptosGenerales::ajaxVerRegistroDos($_POST['concepto'], $_POST['id']);
}
if (isset($_POST['EditarDos']) && $_POST['EditarDos'] == "ok") {
	AjaxConceptosGenerales::ajaxEditarDos($_POST['concepto'], $_POST['id'], $_POST['dato1'], $_POST['dato2']);
}
/*=============================================================
=====================LLAMADOS RUTAS============================
============================================================?*/
if (isset($_POST['AgregarRuta']) && $_POST['AgregarRuta'] == "ok") {
	AjaxRutas::AgregarRuta($_POST['dato1'], $_POST['dato2'], $_POST['dato3']);
}
if (isset($_POST['VerRutas']) && $_POST['VerRutas'] == "ok") {
	AjaxRutas::VerRutas();
}
if (isset($_POST['EditarRuta']) && $_POST['EditarRuta'] == "ok") {
	AjaxRutas::EditarRuta($_POST['dato3'], $_POST['id']);
}
if (isset($_POST['ListarRutas']) && $_POST['ListarRutas'] == "ok") {
	AjaxRutas::ajaxTablaRutasGeneral();
}
/*=============================================================
=====================LLAMADOS EMPRESA==========================
============================================================?*/
if (isset($_POST['DatosEmpresa']) && $_POST['DatosEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxDatosEmpresa($_POST['id']);
}
if (isset($_POST['EditarEmpresa']) && $_POST['EditarEmpresa'] == "ok") {
	$imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : "";
	AjaxConceptoEmpresa::ajaxEditarEmpresa($_POST, $imagen);
}
if (isset($_POST['VerEmpresa']) && $_POST['VerEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxVerEmpresa();
}
/*=============================================================
=====================LLAMADOS CIUDADES=========================
============================================================?*/
if (isset($_POST['VerCiudades']) && $_POST['VerCiudades'] == "ok") {
	AjaxCiudades::VerCiudades();
}
if (isset($_POST['EditarCiudad']) && $_POST['EditarCiudad'] == "ok") {
	AjaxCiudades::EditarCiudad($_POST['dato1'], $_POST['dato2'], $_POST['id']);
}
if (isset($_POST['AgregarCiudad']) && $_POST['AgregarCiudad'] == "ok") {
	AjaxCiudades::AgregarCiudad($_POST['dato1'], $_POST['dato2']);
}
if (isset($_POST['DatosCiudad']) && $_POST['DatosCiudad'] == "ok") {
	AjaxCiudades::DatosCiudad($_POST['id']);
}
/*=============================================================
=====================LLAMADOS SERVICIOS========================
============================================================?*/
if (isset($_POST['nuevoServicio']) && $_POST['nuevoServicio'] == "ok") {
	AjaxConceptoServicios::ajaxNuevoServicio($_POST['dato1'], $_POST['dato2'], $_POST['dato3']);
}
if (isset($_POST['ajaxVerServicios']) && $_POST['ajaxVerServicios'] == "ok") {
	AjaxConceptoServicios::ajaxVerServicios();
}
if (isset($_POST['ajaxEditarServicio']) && $_POST['ajaxEditarServicio'] == "ok") {
	AjaxConceptoServicios::ajaxEditarServicio($_POST['id'], $_POST['dato1'], $_POST['dato2'], $_POST['dato3']);
}
//AJAX ELIMINAR
if (isset($_POST['EliminarRegistro']) && $_POST['EliminarRegistro'] == "ok") {
	AjaxConceptosGenerales::ajaxEliminar($_POST['id'], /*$_POST['valor'],*/ $_POST['concepto']);
}
/*=============================================================
=================MODELO TIPO DOCUMENTO VEHICULAR===============
============================================================?*/
if (isset($_POST['AgregarTipoDocumentoVehicular']) && $_POST['AgregarTipoDocumentoVehicular'] == "ok") {
	AjaxTipoDocumentoVehicular::AgregarTipoDocumento($_POST);
}
if (isset($_POST['EditarTipoDocumentoVehicular']) && $_POST['EditarTipoDocumentoVehicular'] == "ok") {
	AjaxTipoDocumentoVehicular::EditarTipoDocumento($_POST);
}
if (isset($_POST['DatosTipoDocumentoVehicular']) && $_POST['DatosTipoDocumentoVehicular'] == "ok") {
	AjaxTipoDocumentoVehicular::DatosTipoDocumento($_POST['idtipo']);
}