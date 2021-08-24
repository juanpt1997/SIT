<?php

class ControladorEmpresa
{
	static public function ctrVerEmpresa()
	{
		$respuesta = ModeloConceptosGH::mdlListaEmpresa();
		return $respuesta;
	}

	static public function ctrAgregarEditarEmpresa($POST)
	{
		if (isset($POST['id_empresa'])) {

			//$empresa = ModeloConceptosGH::mdlUnaEmpresa($POST['id_empresa']);

			$datos = array(
				'id' => $POST['id_empresa'],
				'razon_social' => $POST['razon'],
				'nit' => $POST['nit'],
				'nro_resolucion' => $POST['num'],
				'anio_resolucion' => $POST['anio'],
				'dir_territorial' => $POST['dir'],
				'ruta_firma' => $POST['firma'],
				'sitio_web' => $POST['sitio']
			);

			if ($POST['id_empresa'] == '') {


				$responseModel = ModeloConceptosGH::mdlAgregarEmpresa($datos);
			} else {


				$responseModel = ModeloConceptosGH::mdlEditarEmpresa($datos);
			}
			return $responseModel;

			// if ($responseModel == "ok") {

			// 	echo "
			// 			<script>
			// 				Swal.fire({
			// 					icon: 'success',
			// 					title: '¡Empresa actualizada correctamente!',						
			// 					showConfirmButton: true,
			// 					confirmButtonText: 'Cerrar',

			// 				}).then((result)=>{

			// 					if(result.value){
			// 						window.location = 'cg-gestion-humana';
			// 					}

			// 				})
			// 			</script>
			// 		";
			// } else {
			// 	echo "
			// 			<script>
			// 				Swal.fire({
			// 					icon: 'warning',
			// 					title: '¡Problema al actualizar la empresa!',						
			// 					showConfirmButton: true,
			// 					confirmButtonText: 'Cerrar',

			// 				}).then((result)=>{

			// 					if(result.value){
			// 						window.location = 'cg-gestion-humana';
			// 					}

			// 				})
			// 			</script>
			// 		";
			// }
		}
	}
}

class ControladorCiudades
{
	static public function ctrVerCiudad($id)
	{
		$datoId = array('id' => $id);
		$respuesta = ModeloConceptosGH::mdlVerciudad($datoId);
		return $respuesta;
	}
}
