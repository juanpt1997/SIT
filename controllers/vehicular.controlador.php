<?php

/**
 * Esto es un controlador para el modulo vehicular
 */

/* ===================================================
   * PROPIETARIOS
===================================================*/
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
			} else {
				if ($_POST['idxp'] == '') {


					$responseModel = ModeloPropietarios::mdlAgregar($datos);
				} else {


					$responseModel = ModeloPropietarios::mdlEditar($datos);
				}
			}

			if ($responseModel == "ok") {

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
			} else {
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

/* ===================================================
   * CONVENIOS
===================================================*/
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
	   CARGAR FOTOS DEL VEHICULO
	===================================================*/
	static public function ctrFotosVehiculo($item, $valor)
	{
		$datos = array(
			'item' => $item,
			'valor' => $valor
		);
		return ModeloVehiculos::mdlFotosVehiculo($datos);
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
		if ($retorno != "existe" && $retorno != "error") {
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
		$ruta = $GuardarImagen->ctrImages(null, null);

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
	/* ===================================================
       ! ELIMINAR REGISTRO
    ===================================================*/
	static public function ctrEliminarRegistro($datos)
	{
		$respuesta = ModeloVehiculos::mdlEliminarRegistro($datos);
		return $respuesta;
	}

	/* ===================================================
	   ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
	===================================================*/
	/* ===================================================
	   MOSTRAR PROPIETARIOSxVEHICULO
	===================================================*/
	static public function ctrPropietariosxVehiculo($idvehiculo)
	{
		$respuesta = ModeloVehiculos::mdlPropietariosxVehiculo($idvehiculo);
		return $respuesta;
	}

	/* ===================================================
	   MOSTRAR CONDUCTORESxVEHICULO
	===================================================*/
	static public function ctrConductoresxVehiculo($idvehiculo)
	{
		$respuesta = ModeloVehiculos::mdlConductoresxVehiculo($idvehiculo);
		return $respuesta;
	}

	/* ===================================================
       MOSTRAR DOCUMENTOSxVEHICULO
    ===================================================*/
	static public function ctrDocumentosxVehiculo($idvehiculo)
	{
		$respuesta = ModeloVehiculos::mdlDocumentosxVehiculo($idvehiculo);
		return $respuesta;
	}
	# DOCUMENTOS POR VEHICULO SIN REPETIR
	static public function ctrDocumentosxVehiculoSinRepetir($idvehiculo)
	{
		$DocumentosTodos = ModeloVehiculos::mdlDocumentosxVehiculo($idvehiculo);
		// Lista que almacena los documentos que se han mostrado, con esto se Verifica que se muestre unicamente el mas reciente
		$ListaDocumentosSinRepetir = array();
        $Documentos = array();
        // Guardar documentos del vehiculo (Sin repetir)
        foreach ($DocumentosTodos as $key => $documento) {
            if (!in_array($documento['tipodocumento'], $ListaDocumentosSinRepetir)) {
                $ListaDocumentosSinRepetir[] = $documento['tipodocumento'];
                $Documentos[] = $documento;
            }
        }

		return $Documentos;
	}

	/* ===================================================
	   VER DATOS DE UN REGISTRO EN ESPECIFICIO DE PROPIETARIOS O CONDUCTORES
	===================================================*/
	static public function ctrVerDetalleVehiculo($datos)
	{
		return ModeloVehiculos::mdlVerDetalleVehiculo($datos);
	}

	/* ===================================================
	   CONDUCTORES
	===================================================*/
	static public function ctrListaConductores()
	{
		return ModeloGH::mdlPersonal("activos");
	}

	/* ===================================================
       TIPOS DE DOCUMENTACIÓN VEHICULAR
    ===================================================*/
	static public function ctrTiposDocumentacion()
	{
		return ModeloVehiculos::mdlTiposDocumentacion();
	}

	/* ===================================================
       GUARDAR(agregar) OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO, CONDUCTOR O DOCUMENTOS
    ===================================================*/
	static public function ctrGuardarDetallesVehiculo($datos)
	{
		$guardarDatos = ModeloVehiculos::mdlGuardarDetallesVehiculo($datos);
		return $guardarDatos;
	}

	/* ===================================================
       EDITAR OTROS DETALLES DE UN VEHICULO COMO EL PROPIETARIO O CONDUCTOR
    ===================================================*/
	static public function ctrEditarDetalleVehiculo($datos)
	{
		$guardarDatos = ModeloVehiculos::mdlEditarDetalleVehiculo($datos);
		return $guardarDatos;
	}

	/* ===================================================
		REPORTE COMPLETO DOCUMENTOS VEHICULOS
	===================================================*/
	static public function ctrReporteDocumentos()
	{
		return ModeloVehiculos::mdlReporteDocumentos();
	}

	/* ===================================================
		REPORTE DOCUMENTOS X VEHICULO
	===================================================*/
	// static public function ctrReporteDocumentosxVehiculo($idvehiculo)
	// {
	// 	return ModeloVehiculos::mdlReporteDocumentosxVehiculo($idvehiculo);
	// }
}

/* ===================================================
   * BLOQUEO DE PERSONAL 
===================================================*/
class ControladorBloqueos
{

	static public function ctrListaPersonal()
	{

		return ModeloGH::mdlPersonal("activos");
	}

	static public function ctrUltimobloqueo()
	{

		return ModeloBloqueoP::mdlUltimoBloqueo(null);
	}

	static public function ctrHIstorial($id)
	{

		return ModeloBloqueoP::mdlHistorial($id);
	}

	static public function ctrMostrarConductor($id)
	{

		return ModeloBloqueoP::mdlMostrarConductor($id);
	}

	static public function ctrNuevoBloqueo()
	{
		if (isset($_POST['conductorB'])) {

			$datos = array(
				'conductorB' => $_POST['conductorB'],
				'motivob' => $_POST['motivob'],
				'estadobloqueo' => $_POST['estadobloqueo'],
				'fecha_vin' => $_POST['fecha_vin'],
				'cedula' => $_SESSION['cedula']
			);


			$respuesta = ModeloBloqueoP::mdlNuevoBloqueo($datos);

			if ($respuesta != 'ok') {

				echo "
				<script>
					Swal.fire({
						icon: 'warning',
						title: '¡Problema al bloquear al conductor!',						
						showConfirmButton: true,
						confirmButtonText: 'Cerrar',

					}).then((result)=>{

						if(result.value){
							window.location = 'gh-bloqueo-personal';
						}

					})
				</script>
			";
			} else {
				if ($datos['estadobloqueo'] == 1) {

					echo "
					<script>
						Swal.fire({
							icon: 'success',
							title: '¡Se ha desbloqueado al conductor!',						
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',

						}).then((result)=>{

							if(result.value){
								window.location = 'gh-bloqueo-personal';
							}

						})
					</script>
				";
				} else {
					echo "
					<script>
						Swal.fire({
							icon: 'success',
							title: '¡Se ha bloqueado al conductor!',						
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',

						}).then((result)=>{

							if(result.value){
								window.location = 'gh-bloqueo-personal';
							}

						})
					</script>
				";
				}
			}
		}
	}
}

class ControladorBloqueosV
{
	static public function ctrMostrarPlaca($id)
	{

		return ModeloBloqueoV::mdlMostrarPlaca($id);
	}

	static public function ctrNuevoBloqueoV()
	{
		if (isset($_POST['vehiculo'])) {

			$datos = array(
				'vehiculo' => $_POST['vehiculo'],
				'motivobv' => $_POST['motivobv'],
				'estadobloqueov' => $_POST['estadobloqueov'],
				'fecha_des' => $_POST['fecha_des'],
				'cedula' => $_SESSION['cedula']
			);


			$respuesta = ModeloBloqueoV::mdlNuevoBloqueoV($datos);

			if ($respuesta != 'ok') {

				echo "
						<script>
							Swal.fire({
								icon: 'warning',
								title: '¡Problema al bloquear el vehículo!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'v-bloqueo-vehiculo';
								}

							})
						</script>
					";
			} else {
				if ($datos['estadobloqueov'] == 1) {

					echo "
					<script>
						Swal.fire({
							icon: 'success',
							title: '¡Se ha desbloqueado el vehículo!',						
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',

						}).then((result)=>{

							if(result.value){
								window.location = 'v-bloqueo-vehiculo';
							}

						})
					</script>
				";
				} else {
					echo "
					<script>
						Swal.fire({
							icon: 'success',
							title: '¡Se ha bloqueado el vehículo!',						
							showConfirmButton: true,
							confirmButtonText: 'Cerrar',

						}).then((result)=>{

							if(result.value){
								window.location = 'v-bloqueo-vehiculo';
							}

						})
					</script>
				";
				}
			}
		}
	}

	static public function ctrUltimobloqueoV()
	{

		return ModeloBloqueoV::mdlUltimoBloqueoV(null);
	}

	static public function ctrHistorialV($id)
	{

		return ModeloBloqueoV::mdlHistorialV($id);
	}
}
