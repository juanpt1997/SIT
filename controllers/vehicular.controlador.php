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
			
			$propietarioExistente = ModeloPropietarios::mdlMostrar($_POST['documento']);

			$datos = array(
				'idxp' => $_POST['idxp'],
				'documento' => $_POST['documento'],
				'tdocumento' => $_POST['tdocumento'],
				'nombre' => $_POST['nombre'],
				'telpro' => $_POST['telpro'],
				'dirpro' => $_POST['dirpro'],
				'emailp' => $_POST['emailp'],
				'ciudadpro' => $_POST['ciudadpro']
			);

			if (is_array($propietarioExistente) && $propietarioExistente['idxp'] != $_POST['idxp']) {		
				echo "
							<script>
								Swal.fire({
									icon: 'warning',
									title: '¡Propietario ya existe!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{

									if(result.value){
										window.location = 'v-propietarios';
									}

								})
							</script>
						";
						return;
				
			}	else {
				if ($_POST['idxp'] == '') {
					

					$responseModel = ModeloPropietarios::mdlAgregar($datos);
			

				}	else {
					
					
					$responseModel = ModeloPropietarios::mdlEditar($datos);
					

					}
				}

			if ($responseModel == "ok"){

				echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Propietario añadido correctamente!',						
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
								icon: 'warning',
								title: '¡Problema al añadir el propietario!',						
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
class ControladorConvenios
{

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
				'telco2' => $_POST['telco2'],
				'ciudadcon' => $_POST['ciudadcon']
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
class ControladorVehiculos
{

	static public function ctrMostrarTipoVehiculo(){

		$respuesta = ModeloVehiculos::mdlMostrarTipoVehiculo();
		return $respuesta;
	}

	static public function ctrMostrarMarca(){

		$respuesta = ModeloVehiculos::mdlMostrarMarca();
		return $respuesta;

	}

}


class ControladorBloqueos
{
	
	static public function ctrListaPersonal(){
		
		return ModeloGH::mdlPersonal("activos");
	}

	static public function ctrUltimobloqueo(){

		return ModeloBloqueoP::mdlUltimoBloqueo();	 
	}

	static public function ctrHIstorial(){

		if (isset($_POST['idbloqueo'])) {


			$i = $_POST['idbloqueo'];
			echo "$i";
			return ModeloBloqueoP::mdlHistorial($_POST['idbloqueo']);

		} else {

			echo "no funciona";
		}

		

	}

}


 ?>