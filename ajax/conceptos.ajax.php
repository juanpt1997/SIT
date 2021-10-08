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
class AjaxConceptosGH
{
	//Ajax para agregar un nuevo concepto general (no incluye EMPRESA, RUTAS, Documento vehicular, Categorias de licencias, Tipos de identificación)
	static public function ajaxNuevoConcepto($concepto, $dato)
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

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item,
			"valor" => $dato
		);

		$respuesta = ModeloConceptosGH::mdlNuevo($datos);

		echo $respuesta;
	}
	//AJAX para listar todos los registros de un concepto
	static public function ajaxVerConcepto($concepto)
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
			case 'Tipos de vehiculos':
				$tabla = "v_tipovehiculos";
				$item = "tipovehiculo";
				$id = "idtipovehiculo";
				break;

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

			default:
				// code...
				break;
		}

		$datos = array(
			"tabla" => $tabla,
			"item"  => $item,
			"id" => $id
		);

		$respuesta = ModeloConceptosGH::mdlVer($datos);
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
	static public function ajaxEditarConcepto($concepto, $id, $dato)
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
		$respuesta = ModeloConceptosGH::mdlEditar($datos);

		echo $respuesta;
	}
	//Ajax para visualizar datos de un concepto por su ID
	static public function ajaxVerUnConcepto($concepto, $id)
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

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item,
			"id" => $id
		);
		$respuesta = ModeloConceptosGH::mdlVerUnConcepto($datos);
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

			default:
				// code...
				break;
		}
		$datos = array(
			"tabla" => $tabla,
			"item" => $item
		);

		$respuesta = ModeloConceptosGH::mdlContarRegistros($datos);

		echo json_encode($respuesta);
	}
	//Agregar nuevo Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxNuevoVehicular($concepto, $dato1, $dato2)
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

		$respuesta = ModeloConceptosGH::mdlAgregarVehicular($datos);

		echo $respuesta;
	}
	//Ajax Editar datos de Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxEditarVehicular($concepto, $id, $dato1, $dato2)
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

		$respuesta = ModeloConceptosGH::mdlEditarVehicular($datos);

		echo $respuesta;
	}
	//Ajax Visualizar datos de un registro de Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxVerUno($concepto, $id)
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

		$respuesta = ModeloConceptosGH::mdlListarUnConcepto($datos);
	}
	//Ajax Listar todos los registros de Documento vehicular, Categorias de licencias, Tipos de identificación
	static public function ajaxListar($concepto)
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

		$respuesta = ModeloConceptosGH::mdlListarVehicular($datos);
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
	//Ajax Agregar una nueva ruta
	static public function AgregarRuta($dato1, $dato2, $dato3)
	{
		$datos = array(
			"ruta" => $dato1,
			"origen" => $dato2,
			"destino" => $dato3
		);

		$respuesta = ModeloConceptosGH::mdlAgregarRuta($datos);
		echo $respuesta;
	}
	//Ajax Editar datos de una ruta segun su id
	static public function EditarRuta( $dato3, $id)
	{
		$datos = array(
			"ruta" => $dato3,
			"idruta" => $id
		);

		$respuesta = ModeloConceptosGH::mdlEditarRuta($datos);
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
	//CIUDADES
	//Ajax apra agregar una nueva ciudad
	static public function AgregarCiudad($dato1, $dato2)
	{
		$datos = array(
			"iddepartamento" => $dato1,
			"municipio" => $dato2
		);

		$respuesta = ModeloConceptosGH::mdlAgregarCiudad($datos);
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

		$respuesta = ModeloConceptosGH::mdlEditarCiudad($datos);
		echo $respuesta;
	}
	//Ajax para listar todas las ciudadas
	static public function VerCiudades()
	{
		$respuesta = ModeloConceptosGH::mdlDeparMunicipios();
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

		$respuesta = ModeloConceptosGH::mdlEliminar($datos);

		echo $respuesta;
	}
}
/*=============================================================
=====================AJAX EMPRESA=============================
============================================================?*/
class AjaxConceptoEmpresa
{
	//Ajax visualizar datos de una empresa segun su ID
	static public function ajaxDatosEmpresa($id)
	{
		$respuesta = ModeloConceptosGH::mdlUnaEmpresa($id);
		echo json_encode($respuesta);
	}
	//Ajax editar empresa
	static public function ajaxEditarEmpresa($formData,$imagen)
	{
		$respuesta = ControladorEmpresa::ctrAgregarEditarEmpresa($formData,$imagen);
		echo $respuesta;
	}
	//Ajax para listar todas las empresas en la tabla (Limitado a una empresa)
	static public function ajaxVerEmpresa()
	{
		$respuesta = ModeloConceptosGH::mdlListaEmpresa();
		$tr = "";

		foreach ($respuesta as $key => $value) {
            if ($value['ruta_firma'] != null) {
                $btnVerFoto = "<a href='" . URL_APP . $value['ruta_firma'] . "' target='_blank' class='btn btn-sm btn-info m-1' type='button'><i class='fas fa-file-alt'></i></a>";
            }else{
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
			<td>" .$btnVerFoto. "</td>
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
=====================LLAMADOS AJAX=============================
============================================================?*/

if (isset($_POST['NuevoGH']) && $_POST['NuevoGH'] == "ok") {
	AjaxConceptosGH::ajaxNuevoConcepto($_POST['concepto'], $_POST['dato']);
}

if (isset($_POST['ajaxVerConcepto']) && $_POST['ajaxVerConcepto'] == "ok") {
	AjaxConceptosGH::ajaxVerConcepto($_POST['concepto']);
}

if (isset($_POST['ajaxEditarConcepto']) && $_POST['ajaxEditarConcepto'] == "ok") {
	AjaxConceptosGH::ajaxEditarConcepto($_POST['concepto'], $_POST['id'], $_POST['dato']);
}

if (isset($_POST['ajaxVerUnConcepto']) && $_POST['ajaxVerUnConcepto'] == "ok") {
	AjaxConceptosGH::ajaxVerUnConcepto($_POST['concepto'], $_POST['id'], $_POST['id']);
}

if (isset($_POST['ajaxContarRegistro']) && $_POST['ajaxContarRegistro'] == "ok") {
	AjaxConceptosGH::ajaxContarRegistro($_POST['concepto']);
}

if (isset($_POST['NuevoVehicular']) && $_POST['NuevoVehicular'] == "ok") {
	AjaxConceptosGH::ajaxNuevoVehicular($_POST['concepto'], $_POST['dato1'], $_POST['dato2']);
}

if (isset($_POST['VerConcepto2']) && $_POST['VerConcepto2'] == "ok") {
	AjaxConceptosGH::ajaxListar($_POST['concepto']);
}

if (isset($_POST['VerUno']) && $_POST['VerUno'] == "ok") {
	AjaxConceptosGH::ajaxVerUno($_POST['concepto'], $_POST['id']);
}

if (isset($_POST['EditarVehicular']) && $_POST['EditarVehicular'] == "ok") {
	AjaxConceptosGH::ajaxEditarVehicular($_POST['concepto'], $_POST['id'], $_POST['dato1'], $_POST['dato2']);
}

//AJAX RUTAS
if (isset($_POST['AgregarRuta']) && $_POST['AgregarRuta'] == "ok") {
	AjaxConceptosGH::AgregarRuta($_POST['dato1'], $_POST['dato2'], $_POST['dato3']);
}

if (isset($_POST['VerRutas']) && $_POST['VerRutas'] == "ok") {
	AjaxConceptosGH::VerRutas();
}

if (isset($_POST['EditarRuta']) && $_POST['EditarRuta'] == "ok") {
	AjaxConceptosGH::EditarRuta($_POST['dato3'], $_POST['id']);
}

//AJAX EMPRESA
if (isset($_POST['DatosEmpresa']) && $_POST['DatosEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxDatosEmpresa($_POST['id']);
}

if (isset($_POST['EditarEmpresa']) && $_POST['EditarEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxEditarEmpresa($_POST, $_FILES['imagen']);
}

if (isset($_POST['VerEmpresa']) && $_POST['VerEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxVerEmpresa();
}

//AJAX CIUDADES
if (isset($_POST['VerCiudades']) && $_POST['VerCiudades'] == "ok") {
	AjaxConceptosGH::VerCiudades();
}

if (isset($_POST['EditarCiudad']) && $_POST['EditarCiudad'] == "ok") {
	AjaxConceptosGH::EditarCiudad($_POST['dato1'], $_POST['dato2'], $_POST['id']);
}

if (isset($_POST['AgregarCiudad']) && $_POST['AgregarCiudad'] == "ok") {
	AjaxConceptosGH::AgregarCiudad($_POST['dato1'], $_POST['dato2']);
}

if (isset($_POST['DatosCiudad']) && $_POST['DatosCiudad'] == "ok") {
	AjaxConceptosGH::DatosCiudad($_POST['id']);
}

//ajax ELIMINAR (Borrado logico)
if (isset($_POST['EliminarRegistro']) && $_POST['EliminarRegistro'] == "ok") {
	AjaxConceptosGH::ajaxEliminar($_POST['id'], /*$_POST['valor'],*/ $_POST['concepto']);
}
