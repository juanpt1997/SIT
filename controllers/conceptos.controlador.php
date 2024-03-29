<?php

/*=============================================================
=====================Controlador EMPRESA=======================
============================================================?*/
class ControladorEmpresa
{
	#Ver datos de una empresa
	static public function ctrListaEmpresa()
	{
		$respuesta = ModeloEmpresaRaiz::mdlListaEmpresa();
		return $respuesta;
	}
	#Agregar/ Editar una empresa (la opcion de agregar se encuentra inhabilitada)
	static public function ctrAgregarEditarEmpresa($POST, $imagen)
	{
		//$empresa = ModeloEmpresaRaiz::mdlVerEmpresa();
		$empresa = ModeloEmpresaRaiz::mdlUnaEmpresa($_POST['id_empresa']);
		$response = "";
		# Verificar Directorio imagenes de firma en empresa
		$directorio = DIR_APP . "views/img/plantilla/fuec/fotosFirmaEmpresa";
		if (!is_dir($directorio)) {
			mkdir($directorio, 0755);
		}

		$fecha = date('Y-m-d');
		$hora = date('His');

		/* ===================================================
            GUARDAMOS EL ARCHIVO
        ===================================================*/
		$GuardarArchivo = new FilesController();
		$GuardarArchivo->file = $imagen;
		$aleatorio = mt_rand(100, 999);
		$GuardarArchivo->ruta = $directorio . "/{$aleatorio}_{$fecha}_{$hora}";

		$response = $GuardarArchivo->ctrImages(null, null);

		# Actualizar el campo de la base de datos donde queda la ruta del archivo
		if ($response != "") {
			$rutaDoc = str_replace(DIR_APP, "", $response);
		} else {
			$rutaDoc = $empresa['ruta_firma'];
		}

		if (isset($POST['id_empresa'])) {

			$datos = array(
				'id' => $POST['id_empresa'],
				'razon_social' => $POST['razon'],
				'nit' => $POST['nit'],
				'nro_resolucion' => $POST['num'],
				'anio_resolucion' => $POST['anio'],
				'dir_territorial' => $POST['dir'],
				'ruta_firma' => $rutaDoc,
				'sitio_web' => $POST['sitio']
			);

			if ($POST['id_empresa'] == '') {

				$responseModel = ModeloEmpresaRaiz::mdlAgregarEmpresa($datos);
			} else {

				$responseModel = ModeloEmpresaRaiz::mdlEditarEmpresa($datos);
			}
			return $responseModel;
		}
	}
}

/*=============================================================
=====================Controlador CIUDADES=======================
============================================================?*/
class ControladorCiudades
{
	#Ver datos de una ciudad
	static public function ctrVerCiudad($id)
	{
		$datoId = array('id' => $id);
		$respuesta = ModeloCiudades::mdlVerciudad($datoId);
		return $respuesta;
	}
	#Ver todos los registros de los departamentos
	static public function ctrListaDepar()
	{
		$tabla = "gh_departamentos";
		$item = "nombre";
		$id = "iddepartamento";
		$datos = array(
			"tabla" => $tabla,
			"item"  => $item,
			"id" => $id
		);

		$respuesta = ModeloConceptosGenerales::mdlVer($datos);
		return $respuesta;
	}
}

/* ===================================================
	* RUTAS
===================================================*/
class ControladorRutas
{
	static public function ctrListarRutas()
	{
		$respuesta = ModeloRutas::mdlListarRutas();
		return $respuesta;
	}
}

/* ===================================================
	* REPUESTOS
===================================================*/

class ControladorRepuestos
{
	static public function ctrListarRepuestos()
	{
		$repuesta = ModeloRepuestos::mdlListarRepuestos();
		return $repuesta;
	}
}

/* ===================================================
	* ALMACEN
===================================================*/
class ControladorAlmacen
{
	static public function ctrListarMedidas()
	{
		$datos = array(
			'tabla' => 'a_medidas',
			'item'  => 'medida',
			'id' => 'idmedidas'
		);

		$respuesta = ModeloConceptosGenerales::mdlVer($datos);
		return $respuesta;
	}

	static public function ctrListarMarcas()
	{
		$datos = array(
			'tabla' => 'a_marcas',
			'item'  => 'marca',
			'id' => 'idmarca'
		);

		$respuesta = ModeloConceptosGenerales::mdlVer($datos);
		return $respuesta;
	}

	static public function ctrListarCategorias()
	{
		$datos = array(
			'tabla' => 'a_categorias',
			'item'  => 'categoria',
			'id' => 'idcategorias'
		);

		$respuesta = ModeloConceptosGenerales::mdlVer($datos);
		return $respuesta;
	}
}
/* ===================================================
	* VALIDACION DE EXISTENCIA
===================================================*/
class ControladorExistencia
{
	static public function ctrValidarExistencia($datos)
	{
		$validar = ModeloConceptosGenerales::mdlVerificarExistencia($datos);

		if (is_array($validar)) {
			if ($validar['estado'] == 0) {
				$actualizar = array(
					'tabla' => $datos['tabla'],
					'item' => $datos['item'],
					'valor' => $datos['valor']
				);
				$respuesta = ModeloConceptosGenerales::mdlActivarExistencia($actualizar);
				return $respuesta;
			} else if ($validar['estado'] == 1) {

				$respuesta = 'existe';
				return $respuesta;
			}
		 } else {
				$respuesta = "no_existe";
				return $respuesta;
		}
		//echo $respuesta;
	}
}
