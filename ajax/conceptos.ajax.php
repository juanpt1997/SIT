<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/conceptos.controlador.php';
require_once '../models/conceptos.modelo.php';
require_once '../models/gh.modelo.php';

/**
 * 
 */

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
	echo "<script>window.location = 'inicio';</script>";
	die();
}

class AjaxConceptosGH
{

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
				$tabla = "rutas";
				$item = "ruta";
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

	static public function EditarRuta($dato1, $dato2, $dato3, $id)
	{
		$datos = array(
			"origen" => $dato1,
			"destino" => $dato2,
			"ruta" => $dato3,
			"idruta" => $id
		);

		$respuesta = ModeloConceptosGH::mdlEditarRuta($datos);
		echo $respuesta;
	}

	static public function VerRutas()
	{
		$respuesta = ModeloConceptosGH::mdlListarRutas();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value["idruta"]}</td>
			<td>{$value["origen"]}</td>
			<td>{$value["destino"]}</td>
			<td>{$value["ruta"]}</td>
			<td> 
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["idruta"]}' dato1='{$value["origen"]}' dato2='{$value["destino"]}' dato3='{$value["ruta"]}' class='btn btn-sm btn-warning btnEditarRuta'><i class='fas fa-edit'></i></button>
			</div>
			<div class='btn-group' role='group' aria-label='Button group'>
			<button idregistro = '{$value["idruta"]}' valor-cambio = '0' concepto = 'Rutas y recorridos' class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}

		echo $tr;
	}

	//CIUDADES
	static public function AgregarCiudad($dato1, $dato2)
	{
		$datos = array(
			"iddepartamento" => $dato1,
			"municipio" => $dato2
		);

		$respuesta = ModeloConceptosGH::mdlAgregarCiudad($datos);
		echo $respuesta;
	}

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

	static public function VerCiudades()
	{
		$respuesta = ModeloGH::mdlDeparMunicipios();
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

	static public function DatosCiudad($id)
	{
		$respuesta = ControladorCiudades::ctrVerCiudad($id);
		echo json_encode($respuesta);
	}

	static public function ajaxEliminar($id, $valor_cambio, $concepto)
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
				$tabla = "rutas";
				$id_tabla = "idruta";
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
			"item" => "estado",
			"valor" => $valor_cambio,
			"id_tabla" => $id_tabla,
			"id" => $id
		);

		$respuesta = ModeloConceptosGH::mdlEliminar($datos);

		echo $respuesta;
	}
}

class AjaxConceptoEmpresa
{
	static public function ajaxDatosEmpresa($id)
	{
		$respuesta = ModeloConceptosGH::mdlUnaEmpresa($id);
		echo json_encode($respuesta);
	}

	static public function ajaxEditarEmpresa($formData)
	{
		$respuesta = ControladorEmpresa::ctrAgregarEditarEmpresa($formData);
		//echo json_encode($formData);
		echo $respuesta;
	}

	static public function ajaxVerEmpresa()
	{
		$respuesta = ModeloConceptosGH::mdlListaEmpresa();
		$tr = "";

		foreach ($respuesta as $key => $value) {
			$tr .= "
			<tr>
			<td>{$value['id']}</td>
			<td>{$value['razon_social']}</td>
			<td>{$value['nit']}</td>
			<td>{$value['nro_resolucion']}</td>
			<td>{$value['anio_resolucion']}</td>
			<td>{$value['dir_territorial']}</td>
			<td>{$value['ruta_firma']}</td>
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

if (isset($_POST['AgregarRuta']) && $_POST['AgregarRuta'] == "ok") {
	AjaxConceptosGH::AgregarRuta($_POST['dato1'], $_POST['dato2'], $_POST['dato3']);
}

if (isset($_POST['VerRutas']) && $_POST['VerRutas'] == "ok") {
	AjaxConceptosGH::VerRutas();
}

if (isset($_POST['EditarRuta']) && $_POST['EditarRuta'] == "ok") {
	AjaxConceptosGH::EditarRuta($_POST['dato1'], $_POST['dato2'], $_POST['dato3'], $_POST['id']);
}

//AJAX EMPRESA
if (isset($_POST['DatosEmpresa']) && $_POST['DatosEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxDatosEmpresa($_POST['id']);
}

if (isset($_POST['EditarEmpresa']) && $_POST['EditarEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxEditarEmpresa($_POST);
}

if (isset($_POST['VerEmpresa']) && $_POST['VerEmpresa'] == "ok") {
	AjaxConceptoEmpresa::ajaxVerEmpresa();
}

//CIUDADES
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

//ELIMINAR
if (isset($_POST['EliminarRegistro']) && $_POST['EliminarRegistro'] == "ok") {
	AjaxConceptosGH::ajaxEliminar($_POST['id'], $_POST['valor'], $_POST['concepto']);
}
