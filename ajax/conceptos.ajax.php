<?php

# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config.php';

# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../controllers/conceptos.controlador.php';
require_once '../models/conceptos.modelo.php';

/**
 * 
 */

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok"){
	echo "larguese hacker, te estoy observando";
	die();
}

class AjaxConceptosGH
{
	
	static public function ajaxNuevoConcepto($concepto, $dato){
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
			//VEHICULAR
			case 'Tipos de vehiculos':
			$tabla = "v_tipovehiculos";
			$item = "tipovehiculo";
			break;	
			
			default:
				// code...
			break;
		}
		$datos = array("tabla" => $tabla,
			"item" => $item,
			"valor" => $dato);

		$respuesta = ModeloConceptosGH::mdlNuevo($datos);

		echo $respuesta;
	}


	static public function ajaxVerConcepto($concepto){
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
			
			//VEHICULAR
			case 'Tipos de vehiculos':
			$tabla = "v_tipovehiculos";
			$item = "tipovehiculo";
			$id = "idtipovehiculo";
			break;
			
			default:
				// code...
			break;

		}

		$datos = array("tabla" => $tabla,
			"item"  => $item,
			"id" => $id);

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
			<button class='btn btn-sm btn-danger btnBorrar'><i class='fas fa-trash-alt'></i></button>
			</div>
			</td>
			</tr>
			";
		}

		echo $tr;
	}


	static public function ajaxEditarConcepto($concepto,$id,$dato){
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
			
			//VEHICULAR
			case 'Tipos de vehiculos':
			$tabla = "v_tipovehiculos";
			$item = "tipovehiculo";
			$idtabla = "idtipovehiculo";
			break;
			
			default:
				// code...
			break;		
		}
		$datos = array("tabla" => $tabla,
			"item" => $item,
			"idtabla" => $idtabla,
			"id" => $id,
			"valor" => $dato);
		$respuesta = ModeloConceptosGH::mdlEditar($datos);

		echo $respuesta;

	}

	static public function ajaxVerUnConcepto($concepto,$id){
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
			
			//VEHICULAR
			case 'Tipos de vehículos':
			$tabla = "v_tipovehiculos";
			$item = "tipovehiculo";
			break;
			
			default:
				// code...
			break;		
		}
		$datos = array("tabla" => $tabla,
			"item" => $item,
			"id" => $id);
		$respuesta = ModeloConceptosGH::mdlVerUnConcepto($datos);

	}
	
	static public function ajaxContarRegistro($concepto){
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
			//VEHICULAR
			case 'Tipos de vehiculos':
			$tabla = "v_tipovehiculos";
			$item = "tipovehiculo";
			break;	
			
			default:
				// code...
			break;
		}
		$datos = array("tabla" => $tabla,
						"item" => $item);

		$respuesta = ModeloConceptosGH::mdlContarRegistros($datos);

		//echo $respuesta['contador'];
		echo json_encode($respuesta);
	}
}

if (isset($_POST['NuevoGH']) && $_POST['NuevoGH'] == "ok"){
	AjaxConceptosGH::ajaxNuevoConcepto($_POST['concepto'], $_POST['dato']);
}

if (isset($_POST['ajaxVerConcepto']) && $_POST['ajaxVerConcepto'] == "ok"){
	AjaxConceptosGH::ajaxVerConcepto($_POST['concepto']);
}

if (isset($_POST['ajaxEditarConcepto']) && $_POST['ajaxEditarConcepto'] == "ok"){
	AjaxConceptosGH::ajaxEditarConcepto($_POST['concepto'], $_POST['id'],$_POST['dato']);
}

if (isset($_POST['ajaxVerUnConcepto']) && $_POST['ajaxVerUnConcepto'] == "ok"){
	AjaxConceptosGH::ajaxVerUnConcepto($_POST['concepto'], $_POST['id'], $_POST['id']);
}

if (isset($_POST['ajaxContarRegistro']) && $_POST['ajaxContarRegistro'] == "ok"){
	AjaxConceptosGH::ajaxContarRegistro($_POST['concepto']);
}