<?php 

/**
 * Esto es un controlador para el modulo vehicular
 */

# Propietarios
class ControladorPropietarios
{
	//===============MOSTRAR PROPIETARIOS =============//
	static public function ctrMostrar(){

		$respuesta = ModeloPropietarios::mdlMostrar(null);
		return $respuesta;
	}

	//==============AGREGAR/EDITAR PROPIETARIO=========//
	public function ctrAgregarEditar(){

		if (isset($_POST['documento'])) {
			// Ver si ya existe un propietario con ese documento
			$propietarioExistente = ModeloPropietarios::mdlMostrar($_POST['documento']);

			$datos = array(
				'documento' => $_POST['documento'],
				'tdocumento' => $_POST['tdocumento'],
				'nombre' => $_POST['nombre'],
				'telpro' => $_POST['telpro'],
				'dirpro' => $_POST['dirpro'],
				'emailp' => $_POST['emailp'],
				'ciudadpro' => $_POST['ciudadpro']
			);

			if(is_array($propietarioExistente)){

				 $responseModel = ModeloPropietarios::mdlEditar($datos);
			} else {

				 $responseModel = ModeloPropietarios::mdlAgregar($datos);
			}

			if ($responseModel == "ok"){
				echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡El propietario ha sido guardado correctamente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'v-propietarios';
								}

							})
						</script>
					";
			}else{
				echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Problema al agregar el propietario!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'v-propietarios';
								}

							})
						</script>
					";
			}
		}
	}


}

# Convenios
class ControladorConvenios{

	static public function ctrMostrar(){

		$respuesta = ModeloConvenios::mdlMostrar(null);
		return $respuesta;

	}

	public function ctrAgregarEditar(){

		if (isset($_POST['nit'])) {
			// Ver si ya existe un convenio con ese nit
			$convenioExistente = ModeloConvenios::mdlMostrar($_POST['nit']);

			$datos = array(
				'nit' => $_POST['nit'],
				'nombre' => $_POST['nombre'],
				'dirco' => $_POST['dirco'],
				'telco' => $_POST['telco'],
				'telco2' => $_POST['telco2']
			);

			if(is_array($convenioExistente)){

				 $responseModel = ModeloConvenios::mdlEditar($datos);
			} else {

				 $responseModel = ModeloConvenios::mdlAgregar($datos);
			}

			if ($responseModel == "ok"){
				echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Convenio guardado correctamente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'v-convenios';
								}

							})
						</script>
					";
			}else{
				echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Problema al añadir el convenio!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'v-convenios';
								}

							})
						</script>
					";
			}
		}
	}

}

#Vehiculos
class ControladorVehiculos{

	static public function ctrMostrarTipoVehiculo(){

		$respuesta = ModeloVehiculos::mdlMostrarTipoVehiculo();
		return $respuesta;
	}

	static public function ctrMostrarMarca(){

		$respuesta = ModeloVehiculos::mdlMostrarMarca();
		return $respuesta;

	}

}


 ?>