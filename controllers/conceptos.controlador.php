<?php

/*=============================================================
=====================Controlador EMPRESA=======================
============================================================?*/
class ControladorEmpresa
{
	#Ver datos de una empresa
	static public function ctrListaEmpresa()
	{
		$respuesta = ModeloConceptosGH::mdlListaEmpresa();
		return $respuesta;
	}
	#Agregar/ Editar una empresa (la opcion de agregar se encuentra inhabilitada)
	static public function ctrAgregarEditarEmpresa($POST, $imagen)
	{
		$empresa = ModeloConceptosGH::mdlVerEmpresa();
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
		} 	else {
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

				$responseModel = ModeloConceptosGH::mdlAgregarEmpresa($datos);
			} else {

				$responseModel = ModeloConceptosGH::mdlEditarEmpresa($datos);
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
		$respuesta = ModeloConceptosGH::mdlVerciudad($datoId);
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

		$respuesta = ModeloConceptosGH::mdlVer($datos);
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
		$respuesta = ModeloConceptosGH::mdlListarRutas();
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