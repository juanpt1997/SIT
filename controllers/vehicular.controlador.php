<?php

/**
 * Esto es un controlador para el modulo vehicular
 */

# Propietarios
class ControladorPropietarios
{
	//===============MOSTRAR PROPIETARIOS =============//
	static public function ctrMostrar()
	{

		$respuesta = ModeloPropietarios::mdlMostrar(null);
		return $respuesta;
	}

	//==============AGREGAR/EDITAR PROPIETARIO=========//
	public function ctrAgregarEditar()
	{

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

			if (is_array($propietarioExistente)) {

				$responseModel = ModeloPropietarios::mdlEditar($datos);
			} else {

				$responseModel = ModeloPropietarios::mdlAgregar($datos);
			}

			if ($responseModel == "ok") {
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
			} else {
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
class ControladorConvenios
{

	static public function ctrMostrar()
	{

		$respuesta = ModeloConvenios::mdlMostrar(null);
		return $respuesta;
	}

	public function ctrAgregarEditar()
	{

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

			if (is_array($convenioExistente)) {

				$responseModel = ModeloConvenios::mdlEditar($datos);
			} else {

				$responseModel = ModeloConvenios::mdlAgregar($datos);
			}

			if ($responseModel == "ok") {
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
			} else {
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

/* ===================================================
   * VEHICULOS
===================================================*/
class ControladorVehiculos
{
	/* ===================================================
	   MOSTRAR VEHICULOS
	===================================================*/
	static public function ctrListaVehiculos()
	{
		$respuesta = ModeloVehiculos::mdlVehiculos();
		return $respuesta;
	}

	/* ===================================================
       DATOS DEL VEHICULO
    ===================================================*/
	static public function ctrDatosVehiculo($item, $valor)
	{
		$datos = array(
			'item' => $item,
			'valor' => $valor
		);
		$Vehiculo = ModeloVehiculos::mdlDatosVehiculo($datos);
		return $Vehiculo;
	}

	/* ===================================================
	   MOSTRAR TIPO DE VEHICULOS
	===================================================*/
	static public function ctrMostrarTipoVehiculo()
	{

		$respuesta = ModeloVehiculos::mdlMostrarTipoVehiculo();
		return $respuesta;
	}

	/* ===================================================
	   MOSTRAR MARCAS
	===================================================*/
	static public function ctrMostrarMarca()
	{

		$respuesta = ModeloVehiculos::mdlMostrarMarca();
		return $respuesta;
	}

	/* ===================================================
	   GUARDAR DATOS DEL VEHICULO
	===================================================*/
	static public function ctrGuardarVehiculo($datos, $tarjetapropiedad, $foto_vehiculo)
	{
		$datosBusqueda = array(
			'item' => 'placa',
			'valor' => $datos['placa']
		);
		$vehiculo = ModeloVehiculos::mdlDatosVehiculo($datosBusqueda);

		# INSERT
		if ($datos['idvehiculo'] == "") {
			if (is_array($vehiculo)) {
				# mensaje al usuario
				$retorno = "existe";
			} else {
				# INSERT
				$retorno = ModeloVehiculos::mdlAgregarVehiculo($datos);
			}
		}
		# UPDATE
		else {
			if (is_array($vehiculo) && $vehiculo['idvehiculo'] != $datos['idvehiculo']) {
				# mensaje al usuario
				$retorno = "existe";
			} else {
				# UPDATE
				$retorno = ModeloVehiculos::mdlEditarVehiculo($datos);
			}
		}

		// ? FOTOS DEL VEHICULO Y TARJETA DE PROPIEDAD
		if ($retorno != "existe" && $retorno != "error"){
			// TARJETA DE PROPIEDAD
			self::ctrGuardarTarjetaPropiedad($tarjetapropiedad, $datos['placa']);

			// FOTO DEL VEHICULO
			self::ctrGuardarFotoVehiculo($foto_vehiculo, $datos['placa'], $retorno);
		}

		return $retorno;
	}

	/* ===================================================
	   GUARDAR FOTO TARJETA DE PROPIEDAD
	===================================================*/
	static public function ctrGuardarTarjetaPropiedad($foto, $placa)
	{
		/* ===================== 
				CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA TARJETA DE PROPIEDAD
			========================= */
		$directorio = DIR_APP . "views/img/vehiculos/" . strval($placa);
		if (!is_dir($directorio)) {
			mkdir($directorio, 0755);
		}

		/* ===================================================
			GUARDAR LA IMAGEN EN EL SERVIDOR
		===================================================*/
		$GuardarImagen = new FilesController();
		$GuardarImagen->file = $foto;
		$aleatorio = mt_rand(100, 999);
		$GuardarImagen->ruta = $directorio . "/tarjeta_propiedad" . $aleatorio;
		$ruta = $GuardarImagen->ctrImages(500, 500);

		/* ===================================================
			ACTUALIZAR RUTA IMAGEN EN LA BD
		===================================================*/
		if ($ruta != "") {
			$rutaImg = str_replace(DIR_APP, "", $ruta);

			$datosRutaImg = array(
				'tabla' => 'v_vehiculos',
				'item1' => 'ruta_tarjetapropiedad',
				'valor1' => $rutaImg,
				'item2' => 'placa',
				'valor2' => $placa
			);
			$actualizarRutaImg = ModeloVehiculos::mdlActualizarVehiculo($datosRutaImg);
		}
	}
	/* ===================================================
	   GUARDAR FOTO DEL VEHICULO
	===================================================*/
	static public function ctrGuardarFotoVehiculo($foto, $placa, $idvehiculo)
	{
		/* ===================== 
			CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA TARJETA DE PROPIEDAD
		========================= */
		$directorio = DIR_APP . "views/img/vehiculos/" . strval($placa);
		if (!is_dir($directorio)) {
			mkdir($directorio, 0755);
		}

		/* ===================================================
			GUARDAR LA IMAGEN EN EL SERVIDOR
		===================================================*/
		$GuardarImagen = new FilesController();
		$GuardarImagen->file = $foto;
		$aleatorio = mt_rand(100, 999);
		$GuardarImagen->ruta = $directorio . "/" . $aleatorio;
		$ruta = $GuardarImagen->ctrImages(500, 500);

		/* ===================================================
			ACTUALIZAR RUTA IMAGEN EN LA BD
		===================================================*/
		if ($ruta != "") {
			$rutaImg = str_replace(DIR_APP, "", $ruta);

			$datosRutaImg = array(
				'ruta_foto' => $rutaImg,
				'idvehiculo' => $idvehiculo
			);
			$actualizarRutaImg = ModeloVehiculos::mdlAgregarFotoVehiculo($datosRutaImg);
		}
	}
}
