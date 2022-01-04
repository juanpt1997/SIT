<?php

class ControladorInventario
{
	/* ===================================================
       AGREGAR / EDITAR INVENTARIO
    ===================================================*/
	public function ctrAgregarEditarInventario()
	{
		if (isset($_POST['inventario_id'])) {

			$datos = array(
				'id' => $_POST['inventario_id'],
				'idvehiculo' => $_POST['idvehiculo'],
				'idconductor' => $_POST['idconductor'],
				'kilometraje' => $_POST['kilometraje'],
				'fecha_inventario' => $_POST['fecha_inventario'],
				'recepcion_entrega_vehiculo' => $_POST['recepcion_entrega_vehiculo'],
				'Techo_exterior' => $_POST['Techo_exterior'],
				'Techo_interior' => $_POST['Techo_interior'],
				'Frente' => $_POST['Frente'],
				'Bomper_delantero' => $_POST['Bomper_delantero'],
				'Bomper_trasero' => $_POST['Bomper_trasero'],
				'Lateral_derecho' => $_POST['Lateral_derecho'],
				'Lateral_izquierdo' => $_POST['Lateral_izquierdo'],
				'puerta_derecha' => $_POST['puerta_derecha'],
				'Puerta_izquierda' => $_POST['Puerta_izquierda'],
				'Parabrisas_izquierdo' => $_POST['Parabrisas_izquierdo'],
				'Parabrisas_derecho' => $_POST['Parabrisas_derecho'],
				'parabrisas_trasero' => $_POST['parabrisas_trasero'],
				'Espejo_retrovisor_derecho' => $_POST['Espejo_retrovisor_derecho'],
				'Espejo_retrovisor_izquierdo' => $_POST['Espejo_retrovisor_izquierdo'],
				'Vidrios_ventanas_lateral_derecho' => $_POST['Vidrios_ventanas_lateral_derecho'],
				'Vidrios_ventanas_lateral_izquierdo' => $_POST['Vidrios_ventanas_lateral_izquierdo'],
				'Vidrios_puertas' => $_POST['Vidrios_puertas'],
				'Direccional_delantera_izquierda' => $_POST['Direccional_delantera_izquierda'],
				'Direccional_delantera_derecha' => $_POST['Direccional_delantera_derecha'],
				'Stop_trasero_derecho' => $_POST['Stop_trasero_derecho'],
				'Stop_trasero_izquierdo' => $_POST['Stop_trasero_izquierdo'],
				'Cucuyo_lateral_derecho' => $_POST['Cucuyo_lateral_derecho'],
				'Cucuyo_lateral_izquierdo' => $_POST['Cucuyo_lateral_izquierdo'],
				'Luces_internas' => $_POST['Luces_internas'],
				'numero_luces_internas' => $_POST['numero_luces_internas'],
				'balizas' => $_POST['balizas'],
				'Delantera_izquierda_R1' => $_POST['Delantera_izquierda_R1'],
				'Delantera_derecha_R2' => $_POST['Delantera_derecha_R2'],
				'Trasera_interior_izquierda_R3' => $_POST['Trasera_interior_izquierda_R3'],
				'Trasera_exterior_izquierda_R4' => $_POST['Trasera_exterior_izquierda_R4'],
				'Trasera_interior_derecha_R5' => $_POST['Trasera_interior_derecha_R5'],
				'Trasera_exterior_derecha_R6' => $_POST['Trasera_exterior_derecha_R6'],
				'Gato' => $_POST['Gato'],
				'Cruceta_Copa' => $_POST['Cruceta_Copa'],
				'2Conos_Triangulos' => $_POST['2Conos_Triangulos'],
				'Botiquin' => $_POST['Botiquin'],
				'Extintor' => $_POST['Extintor'],
				'2Tacos_Bloques' => $_POST['2Tacos_Bloques'],
				'Alicate_destornillador' => $_POST['Alicate_destornillador'],
				'Llave_expancion_Llaves_fijas' => $_POST['Llave_expancion_Llaves_fijas'],
				'Llanta_repuesto' => $_POST['Llanta_repuesto'],
				'Linterna_pila' => $_POST['Linterna_pila'],
				'Cinturon_conductor' => $_POST['Cinturon_conductor'],
				'Radiotelefono' => $_POST['Radiotelefono'],
				'Antena' => $_POST['Antena'],
				'usb_cd' => $_POST['usb_cd'],
				'Equipo_Sonido' => $_POST['Equipo_Sonido'],
				'num_parlantes' => $_POST['num_parlantes'],
				'Parlantes' => $_POST['Parlantes'],
				'Manguera_agua' => $_POST['Manguera_agua'],
				'Manguera_aire' => $_POST['Manguera_aire'],
				'Pantalla_Televisor' => $_POST['Pantalla_Televisor'],
				'Reloj' => $_POST['Reloj'],
				'Brazo_1_Izquierdo_R1' => $_POST['Brazo_1_Izquierdo_R1'],
				'Brazo_2_Derecho_R2' => $_POST['Brazo_2_Derecho_R2'],
				'Brazo_3_Izquierdo_R3' => $_POST['Brazo_3_Izquierdo_R3'],
				'Brazo_4_Derecho_R6' => $_POST['Brazo_4_Derecho_R6'],
				'Emblema_izquierdo_empresa' => $_POST['Emblema_izquierdo_empresa'],
				'Emblema_derecho_empresa' => $_POST['Emblema_derecho_empresa'],
				'escolar_delantero_trasero' => $_POST['escolar_delantero_trasero'],
				'escolar' => $_POST['escolar'],
				'Logo_izquierdo' => $_POST['Logo_izquierdo'],
				'Logo_derecho' => $_POST['Logo_derecho'],
				'N_Interno_delantero' => $_POST['N_Interno_delantero'],
				'N_Interno_trasero' => $_POST['N_Interno_trasero'],
				'N_Interno_izquierdo' => $_POST['N_Interno_izquierdo'],
				'N_Interno_derecho' => $_POST['N_Interno_derecho'],
				'Nsalidas_martillos' => $_POST['Nsalidas_martillos'],
				'Salidas_emergencia_martillos' => $_POST['Salidas_emergencia_martillos'],
				'interno_externo_comoConduzco' => $_POST['interno_externo_comoConduzco'],
				'Dispositivo_velocidad' => $_POST['Dispositivo_velocidad'],
				'Av_Como_conduzco' => $_POST['Av_Como_conduzco'],
				'Brazo_limpiaparabrisas_izquierdo' => $_POST['Brazo_limpiaparabrisas_izquierdo'],
				'Plumilla_limpiaparabrisas_izquierdo' => $_POST['Plumilla_limpiaparabrisas_izquierdo'],
				'Brazo_limpiaparabrisas_derecho' => $_POST['Brazo_limpiaparabrisas_derecho'],
				'Plumilla_limpiaparabrisas_derecho' => $_POST['Plumilla_limpiaparabrisas_derecho'],
				'Baterias' => $_POST['Baterias'],
				'Botones_tablero_timon' => $_POST['Botones_tablero_timon'],
				'Tapa_radiador' => $_POST['Tapa_radiador'],
				'Tapa_deposito_hidraulico' => $_POST['Tapa_deposito_hidraulico'],
				'Cojineria_general' => $_POST['Cojineria_general'],
				'Cinturon_sillas_calidad' => $_POST['Cinturon_sillas_calidad'],
				'Pasamanos' => $_POST['Pasamanos'],
				'Claxon' => $_POST['Claxon'],
				'Placas_reglamentarias' => $_POST['Placas_reglamentarias']
				//'inventario_tipo_vel' => $_POST['inventario_tipo_vel']
			);
			// Asignacion de valor NULL en caso de que el tipo de vehiculo sea una camioneta (se desactivan los campos)
			$datos['balizas'] = isset($_POST['balizas']) ? $_POST['balizas'] : null;
			$datos['Trasera_interior_derecha_R5'] = isset($_POST['Trasera_interior_derecha_R5']) ? $_POST['Trasera_interior_derecha_R5'] : null;
			$datos['Trasera_exterior_derecha_R6'] = isset($_POST['Trasera_exterior_derecha_R6']) ? $_POST['Trasera_exterior_derecha_R6'] : null;
			$datos['Radiotelefono'] = isset($_POST['Radiotelefono']) ? $_POST['Radiotelefono'] : null;
			$datos['Manguera_agua'] = isset($_POST['Manguera_agua']) ? $_POST['Manguera_agua'] : null;
			$datos['Manguera_aire'] = isset($_POST['Manguera_aire']) ? $_POST['Manguera_aire'] : null;
			$datos['Pantalla_Televisor'] = isset($_POST['Pantalla_Televisor']) ? $_POST['Pantalla_Televisor'] : null;
			$datos['Reloj'] = isset($_POST['Reloj']) ? $_POST['Reloj'] : null;
			$datos['Brazo_1_Izquierdo_R1'] = isset($_POST['Brazo_1_Izquierdo_R1']) ? $_POST['Brazo_1_Izquierdo_R1'] : null;
			$datos['Brazo_2_Derecho_R2'] = isset($_POST['Brazo_2_Derecho_R2']) ? $_POST['Brazo_2_Derecho_R2'] : null;
			$datos['Brazo_3_Izquierdo_R3'] = isset($_POST['Brazo_3_Izquierdo_R3']) ? $_POST['Brazo_3_Izquierdo_R3'] : null;
			$datos['Brazo_4_Derecho_R6'] = isset($_POST['Brazo_4_Derecho_R6']) ? $_POST['Brazo_4_Derecho_R6'] : null;
			$datos['escolar_delantero_trasero'] = isset($_POST['escolar_delantero_trasero']) ? $_POST['escolar_delantero_trasero'] : null;
			$datos['escolar'] = isset($_POST['escolar']) ? $_POST['escolar'] : null;
			$datos['Salidas_emergencia_martillos'] = isset($_POST['Salidas_emergencia_martillos']) ? $_POST['Salidas_emergencia_martillos'] : null;
			$datos['Nsalidas_martillos'] = isset($_POST['Nsalidas_martillos']) ? $_POST['Nsalidas_martillos'] : null;
			$datos['Reloj'] = isset($_POST['Reloj']) ? $_POST['Reloj'] : null;
			$datos['Reloj'] = isset($_POST['Reloj']) ? $_POST['Reloj'] : null;
			$datos['Reloj'] = isset($_POST['Reloj']) ? $_POST['Reloj'] : null;

			if ($_POST['inventario_id'] == "") {

				$responseModel = ModeloInventario::mdlAgregarInventario($datos);

				/* ===================================================
            		GUARDAR KILOMETRAJE VEHICULO
        		===================================================*/
				$tabla = "v_vehiculos";

				$datoskm = array(
					'tabla' => $tabla,
					'item1' => 'kilometraje',
					'valor1' => $datos['kilometraje'],
					'item2' => 'idvehiculo',
					'valor2' => $datos['idvehiculo']
				);

				$respuestakm = ModeloVehiculos::mdlActualizarVehiculo($datoskm);


				echo $responseModel;

				if ($responseModel == "ok") {
					echo "
							<script>
								Swal.fire({
									icon: 'success',
									title: '¡Inventario guardado correctamente!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{
	
									if(result.value){
										window.location = 'm-inventario';
									}
	
								})
							</script>
						";
				} else {
					echo "
							<script>
								Swal.fire({
									icon: 'success',
									title: '¡Problema al guardar le inventario!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{
	
									if(result.value){
										window.location = 'm-inventario';
									}
	
								})
							</script>
						";
				}
			} else {

				$responseModel = ModeloInventario::mdlEditarInventario($datos);


				/* ===================================================
            		GUARDAR KILOMETRAJE VEHICULO
        		===================================================*/
				$tabla = "v_vehiculos";

				$datoskm = array(
					'tabla' => $tabla,
					'item1' => 'kilometraje',
					'valor1' => $datos['kilometraje'],
					'item2' => 'idvehiculo',
					'valor2' => $datos['idvehiculo']
				);

				$respuestakm = ModeloVehiculos::mdlActualizarVehiculo($datoskm);


				echo $responseModel;

				if ($responseModel == "ok") {
					echo "
							<script>
								Swal.fire({
									icon: 'success',
									title: '¡Inventario actualizado correctamente!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{
	
									if(result.value){
										window.location = 'm-inventario';
									}
	
								})
							</script>
						";
				} else {
					echo "
							<script>
								Swal.fire({
									icon: 'success',
									title: '¡Problema al actualizar le inventario!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{
	
									if(result.value){
										window.location = 'm-inventario';
									}
	
								})
							</script>
						";
				}
			}
		}
	}

	/* ===================================================
       LISTA INVENTARIO
    ===================================================*/
	static public function ctrListaInventario()
	{
		$respuesta = ModeloInventario::mdlListarInventario(null);
		return $respuesta;
	}

	/* ===================================================
       TRADUCIR ESTADO DE LOS VALORES DE LA TABLA
    ===================================================*/
	static public function TraducirEstadoInventario($estado)
	{
		switch ($estado) {
			case "1":
				return "Bueno";
				break;

			case "0":
				return "Malo";
				break;

			case "2":
				return "N/A";
				break;

			case "3":
				return "Regular";
				break;

			case "4":
				return "Rayado";
				break;

			case "5":
				return "Golpe";
				break;

			case "6":
				return "Si";
				break;

			case "7":
				return "No";
				break;

			case "8":
				return "Entrega";
				break;

			case "9":
				return "Recibe";
				break;

			default:
				return "";
				break;
		}
	}

	/* ===================================================
       LISTAR EVIDENCIAS
    ===================================================*/
	static public function ctrListaEvidencias($idvehiculo)
	{
		$respuesta = ModeloInventario::mdlListaEvidencias($idvehiculo);
		return $respuesta;
	}

	/*===================================================
       CAMBIAR ESTADO EVIDENCIA
    ===================================================*/
	static public function ctrActualizarEstado($idevidencia, $estadoActual, $observaciones)
	{
		$nuevoEstado = $estadoActual == "RESUELTO" ? "PENDIENTE" : "RESUELTO";

		$datos = array(
			'idevidencia' => $idevidencia,
			'observaciones' => $observaciones,
			'estado' => $nuevoEstado
		);
		$respuesta = ModeloInventario::mdlActualizarEstado($datos);
		return $respuesta;
	}
}

class ControladorRevision
{
	/*=============================
		LISTADO REVISION
		=========================== */
	static public function ctrListadoRevision()
	{
		$respuesta = ModeloRevision::mdlListadoRevision();
		return $respuesta;
	}

	/*====================================
		REVISION POR ID 
		===========================*/

	static public function ctrRevisionxid($idrevision)
	{
		$respuesta = ModeloRevision::mdlRevisionxid($idrevision);
		return $respuesta;
	}

	/* ============================================
		AGREGAR Y EDITAR REVISIÓN TECNICOMECÁNICA
		========================================= */

	static public function ctrAgregarEditarRevision()
	{

		// $_POST['freno_ahogo'] = $_POST['freno_ahogo'] == "" ? null : $_POST['freno_ahogo'];
		if (isset($_POST['idrevision'])) {
			$datos = $_POST;

			if (!isset($_POST['freno_ahogo'])) {
				$datos['freno_ahogo'] = "2";
				$datos['compresor'] = "2";
				$datos['fuga_aire'] = "2";
				$datos['banda_delantera_derecha'] = "2";
				$datos['banda_delantera_izquierda'] = "2";
				$datos['rachets'] = "2";
				$datos['llantar5'] = "2";
				$datos['llantar6'] = "2";
				$datos['tanques_aire'] = "2";
				$datos['rutero'] = "2";
				$datos['estribos_puerta'] = "2";
				$datos['brazo_limpiaparabrisas_derecho'] = "2";
				$datos['parabrisas_izquierdo'] = "2";
				$datos['brazo_limpiaparabrisas_izquierdo'] = "2";
				$datos['vidrio_puerta_principal'] = "2";
				$datos['vidrio_segunda_puerta'] = "2";
				$datos['claraboyas'] = "2";
				$datos['parales'] = "2";
				$datos['booster_puertas'] = "2";
				$datos['reloj_vigia'] = "2";
				$datos['vigia_delantera_derecha'] = "2";
				$datos['vigia_delantera_izquierda'] = "2";
				$datos['vigia_trasera_derecha'] = "2";
				$datos['vigia_trasera_izquierda'] = "2";
				$datos['martillo_emergencia'] = "2";
				$datos['dispositivo_velocidad'] = "2";
				$datos['balizas'] = "2";
			}
			//echo $datos['luces_delimitadoras'];

			$datos['idvehiculo'] = isset($datos['idvehiculo']) ? $datos['idvehiculo'] : "null";
			$datos['kilometraje'] = !isset($datos['kilometraje']) || $datos['kilometraje'] == "" ? "null" : $datos['kilometraje'];
			$datos['nivelrefrigerante'] = isset($datos['nivelrefrigerante']) ? $datos['nivelrefrigerante'] : "null";
			$datos['nivelaceite'] = isset($datos['nivelaceite']) ? $datos['nivelaceite'] : "null";
			$datos['radiador'] = isset($datos['radiador']) ? $datos['radiador'] : "null";
			$datos['mangueras'] = isset($datos['mangueras']) ? $datos['mangueras'] : "null";
			$datos['correas'] = isset($datos['correas']) ? $datos['correas'] : "null";
			$datos['motor'] = isset($datos['motor']) ? $datos['motor'] : "null";
			$datos['freno_ahogo'] = isset($datos['freno_ahogo']) ? $datos['freno_ahogo'] : "null";
			$datos['exosto'] = isset($datos['exosto']) ? $datos['exosto'] : "null";
			$datos['guaya'] = isset($datos['guaya']) ? $datos['guaya'] : "null";
			$datos['turbo'] = isset($datos['turbo']) ? $datos['turbo'] : "null";
			$datos['tapa_radiador'] = isset($datos['tapa_radiador']) ? $datos['tapa_radiador'] : "null";
			$datos['fuga_aceite'] = isset($datos['fuga_aceite']) ? $datos['fuga_aceite'] : "null";
			$datos['fuga_combustible'] = isset($datos['fuga_combustible']) ? $datos['fuga_combustible'] : "null";
			$datos['nivel_aceite_transmision'] = isset($datos['nivel_aceite_transmision']) ? $datos['nivel_aceite_transmision'] : "null";
			$datos['transmision'] = isset($datos['transmision']) ? $datos['transmision'] : "null";
			$datos['tapon_transmision'] = isset($datos['tapon_transmision']) ? $datos['tapon_transmision'] : "null";
			$datos['palanca_cambios'] = isset($datos['palanca_cambios']) ? $datos['palanca_cambios'] : "null";
			$datos['embrague'] = isset($datos['embrague']) ? $datos['embrague'] : "null";
			$datos['pedal_embrague'] = isset($datos['pedal_embrague']) ? $datos['pedal_embrague'] : "null";
			$datos['cruceta_cardan'] = isset($datos['cruceta_cardan']) ? $datos['cruceta_cardan'] : "null";
			$datos['cojinete_cardan'] = isset($datos['cojinete_cardan']) ? $datos['cojinete_cardan'] : "null";
			$datos['cadena_cardan'] = isset($datos['cadena_cardan']) ? $datos['cadena_cardan'] : "null";
			$datos['aceite_diferencial'] = isset($datos['aceite_diferencial']) ? $datos['aceite_diferencial'] : "null";
			$datos['drenaje_diferencial'] = isset($datos['drenaje_diferencial']) ? $datos['drenaje_diferencial'] : "null";
			$datos['fuga_transmision'] = isset($datos['fuga_transmision']) ? $datos['fuga_transmision'] : "null";
			$datos['fuga_diferencial'] = isset($datos['fuga_diferencial']) ? $datos['fuga_diferencial'] : "null";
			$datos['muelle_delantero_derecho'] = isset($datos['muelle_delantero_derecho']) ? $datos['muelle_delantero_derecho'] : "null";
			$datos['amortiguador_delantero_derecho'] = isset($datos['amortiguador_delantero_derecho']) ? $datos['amortiguador_delantero_derecho'] : "null";
			$datos['muelle_delantero_izquierdo'] = isset($datos['muelle_delantero_izquierdo']) ? $datos['muelle_delantero_izquierdo'] : "null";
			$datos['amortiguador_delantero_izquierdo'] = isset($datos['amortiguador_delantero_izquierdo']) ? $datos['amortiguador_delantero_izquierdo'] : "null";
			$datos['muelle_trasero_derecho'] = isset($datos['muelle_trasero_derecho']) ? $datos['muelle_trasero_derecho'] : "null";
			$datos['amortiguador_trasero_derecho'] = isset($datos['amortiguador_trasero_derecho']) ? $datos['amortiguador_trasero_derecho'] : "null";
			$datos['muelle_trasero_izquierdo'] = isset($datos['muelle_trasero_izquierdo']) ? $datos['muelle_trasero_izquierdo'] : "null";
			$datos['amortiguador_trasero_izquierdo'] = isset($datos['amortiguador_trasero_izquierdo']) ? $datos['amortiguador_trasero_izquierdo'] : "null";
			$datos['barra_estabilizadora'] = isset($datos['barra_estabilizadora']) ? $datos['barra_estabilizadora'] : "null";
			$datos['tornillo_pasador_central'] = isset($datos['tornillo_pasador_central']) ? $datos['tornillo_pasador_central'] : "null";
			$datos['aceite_hidraulico'] = isset($datos['aceite_hidraulico']) ? $datos['aceite_hidraulico'] : "null";
			$datos['lineas'] = isset($datos['lineas']) ? $datos['lineas'] : "null";
			$datos['pitman'] = isset($datos['pitman']) ? $datos['pitman'] : "null";
			$datos['barra_ejes'] = isset($datos['barra_ejes']) ? $datos['barra_ejes'] : "null";
			$datos['tijeras'] = isset($datos['tijeras']) ? $datos['tijeras'] : "null";
			$datos['splinders'] = isset($datos['splinders']) ? $datos['splinders'] : "null";
			$datos['timon'] = isset($datos['timon']) ? $datos['timon'] : "null";
			$datos['caja_direccion'] = isset($datos['caja_direccion']) ? $datos['caja_direccion'] : "null";
			$datos['cruceta_direccion'] = isset($datos['cruceta_direccion']) ? $datos['cruceta_direccion'] : "null";
			$datos['fuga_caja'] = isset($datos['fuga_caja']) ? $datos['fuga_caja'] : "null";
			$datos['nivel_fluido'] = isset($datos['nivel_fluido']) ? $datos['nivel_fluido'] : "null";
			$datos['tuberias'] = isset($datos['tuberias']) ? $datos['tuberias'] : "null";
			$datos['freno_parqueo'] = isset($datos['freno_parqueo']) ? $datos['freno_parqueo'] : "null";
			$datos['frenos'] = isset($datos['frenos']) ? $datos['frenos'] : "null";
			$datos['pedal_freno'] = isset($datos['pedal_freno']) ? $datos['pedal_freno'] : "null";
			$datos['compresor'] = isset($datos['compresor']) ? $datos['compresor'] : "null";
			$datos['fuga_aire'] = isset($datos['fuga_aire']) ? $datos['fuga_aire'] : "null";
			$datos['banda_delantera_derecha'] = isset($datos['banda_delantera_derecha']) ? $datos['banda_delantera_derecha'] : "null";
			$datos['banda_delantera_izquierda'] = isset($datos['banda_delantera_izquierda']) ? $datos['banda_delantera_izquierda'] : "null";
			$datos['banda_trasera_derecha'] = isset($datos['banda_trasera_derecha']) ? $datos['banda_trasera_derecha'] : "null";
			$datos['banda_trasera_izquierda'] = isset($datos['banda_trasera_izquierda']) ? $datos['banda_trasera_izquierda'] : "null";
			$datos['rachets'] = isset($datos['rachets']) ? $datos['rachets'] : "null";
			$datos['discos_delanteros'] = isset($datos['discos_delanteros']) ? $datos['discos_delanteros'] : "null";
			$datos['discos_traseros'] = isset($datos['discos_traseros']) ? $datos['discos_traseros'] : "null";
			$datos['pastillas_freno'] = isset($datos['pastillas_freno']) ? $datos['pastillas_freno'] : "null";
			$datos['rines'] = isset($datos['rines']) ? $datos['rines'] : "null";
			$datos['llantar1'] = isset($datos['llantar1']) ? $datos['llantar1'] : "null";
			$datos['llantar2'] = isset($datos['llantar2']) ? $datos['llantar2'] : "null";
			$datos['llantar3'] = isset($datos['llantar3']) ? $datos['llantar3'] : "null";
			$datos['llantar4'] = isset($datos['llantar4']) ? $datos['llantar4'] : "null";
			$datos['llantar5'] = isset($datos['llantar5']) ? $datos['llantar5'] : "null";
			$datos['llantar6'] = isset($datos['llantar6']) ? $datos['llantar6'] : "null";
			$datos['llanta_repuesto'] = isset($datos['llanta_repuesto']) ? $datos['llanta_repuesto'] : "null";
			$datos['tanques_aire'] = isset($datos['tanques_aire']) ? $datos['tanques_aire'] : "null";
			$datos['luces_altas'] = isset($datos['luces_altas']) ? $datos['luces_altas'] : "null";
			$datos['luces_bajas'] = isset($datos['luces_bajas']) ? $datos['luces_bajas'] : "null";
			$datos['luces_direccionales'] = isset($datos['luces_direccionales']) ? $datos['luces_direccionales'] : "null";
			$datos['luces_estacionarias'] = isset($datos['luces_estacionarias']) ? $datos['luces_estacionarias'] : "null";
			$datos['luces_laterales'] = isset($datos['luces_laterales']) ? $datos['luces_laterales'] : "null";
			$datos['luz_reversa'] = isset($datos['luz_reversa']) ? $datos['luz_reversa'] : "null";
			$datos['luces_internas'] = isset($datos['luces_internas']) ? $datos['luces_internas'] : "null";
			$datos['luces_delimitadoras'] = isset($datos['luces_delimitadoras']) ? $datos['luces_delimitadoras'] : "null";
			$datos['alarma_reversa'] = isset($datos['alarma_reversa']) ? $datos['alarma_reversa'] : "null";
			$datos['motor_arranque'] = isset($datos['motor_arranque']) ? $datos['motor_arranque'] : "null";
			$datos['alternador'] = isset($datos['alternador']) ? $datos['alternador'] : "null";
			$datos['baterias'] = isset($datos['baterias']) ? $datos['baterias'] : "null";
			$datos['pito'] = isset($datos['pito']) ? $datos['pito'] : "null";
			$datos['rutero'] = isset($datos['rutero']) ? $datos['rutero'] : "null";
			$datos['cables_conexiones'] = isset($datos['cables_conexiones']) ? $datos['cables_conexiones'] : "null";
			$datos['fusibles'] = isset($datos['fusibles']) ? $datos['fusibles'] : "null";
			$datos['presion_aceite'] = isset($datos['presion_aceite']) ? $datos['presion_aceite'] : "null";
			$datos['temperatura_motor'] = isset($datos['temperatura_motor']) ? $datos['temperatura_motor'] : "null";
			$datos['velocimetro'] = isset($datos['velocimetro']) ? $datos['velocimetro'] : "null";
			$datos['nivel_combustible'] = isset($datos['nivel_combustible']) ? $datos['nivel_combustible'] : "null";
			$datos['presion_aire'] = isset($datos['presion_aire']) ? $datos['presion_aire'] : "null";
			$datos['carga_bateria'] = isset($datos['carga_bateria']) ? $datos['carga_bateria'] : "null";
			$datos['techo_exterior'] = isset($datos['techo_exterior']) ? $datos['techo_exterior'] : "null";
			$datos['techo_interior'] = isset($datos['techo_interior']) ? $datos['techo_interior'] : "null";
			$datos['bomper_delantero'] = isset($datos['bomper_delantero']) ? $datos['bomper_delantero'] : "null";
			$datos['bomper_trasero'] = isset($datos['bomper_trasero']) ? $datos['bomper_trasero'] : "null";
			$datos['frente'] = isset($datos['frente']) ? $datos['frente'] : "null";
			$datos['lamina_lateral_derecho'] = isset($datos['lamina_lateral_derecho']) ? $datos['lamina_lateral_derecho'] : "null";
			$datos['lamina_lateral_izquierdo'] = isset($datos['lamina_lateral_izquierdo']) ? $datos['lamina_lateral_izquierdo'] : "null";
			$datos['puerta_principal'] = isset($datos['puerta_principal']) ? $datos['puerta_principal'] : "null";
			$datos['puerta_lateral'] = isset($datos['puerta_lateral']) ? $datos['puerta_lateral'] : "null";
			$datos['estribos_puerta'] = isset($datos['estribos_puerta']) ? $datos['estribos_puerta'] : "null";
			$datos['sillas'] = isset($datos['sillas']) ? $datos['sillas'] : "null";
			$datos['descansa_brazos'] = isset($datos['descansa_brazos']) ? $datos['descansa_brazos'] : "null";
			$datos['bocallanta'] = isset($datos['bocallanta']) ? $datos['bocallanta'] : "null";
			$datos['guardapolvos'] = isset($datos['guardapolvos']) ? $datos['guardapolvos'] : "null";
			$datos['piso'] = isset($datos['piso']) ? $datos['piso'] : "null";
			$datos['parabrisas_derecho'] = isset($datos['parabrisas_derecho']) ? $datos['parabrisas_derecho'] : "null";
			$datos['brazo_limpiaparabrisas_derecho'] = isset($datos['brazo_limpiaparabrisas_derecho']) ? $datos['brazo_limpiaparabrisas_derecho'] : "null";
			$datos['plumillas_limpiaparabrisas_derecho'] = isset($datos['plumillas_limpiaparabrisas_derecho']) ? $datos['plumillas_limpiaparabrisas_derecho'] : "null";
			$datos['parabrisas_izquierdo'] = isset($datos['parabrisas_izquierdo']) ? $datos['parabrisas_izquierdo'] : "null";
			$datos['brazo_limpiaparabrisas_izquierdo'] = isset($datos['brazo_limpiaparabrisas_izquierdo']) ? $datos['brazo_limpiaparabrisas_izquierdo'] : "null";
			$datos['plumillas_limpiaparabrisas_izquierdo'] = isset($datos['plumillas_limpiaparabrisas_izquierdo']) ? $datos['plumillas_limpiaparabrisas_izquierdo'] : "null";
			$datos['espejo_retrovisor_derecho'] = isset($datos['espejo_retrovisor_derecho']) ? $datos['espejo_retrovisor_derecho'] : "null";
			$datos['espejo_retrovisor_izquierdo'] = isset($datos['espejo_retrovisor_izquierdo']) ? $datos['espejo_retrovisor_izquierdo'] : "null";
			$datos['espejo_central'] = isset($datos['espejo_central']) ? $datos['espejo_central'] : "null";
			$datos['ventanas_lado_derecho'] = isset($datos['ventanas_lado_derecho']) ? $datos['ventanas_lado_derecho'] : "null";
			$datos['ventanas_lado_izquierdo'] = isset($datos['ventanas_lado_izquierdo']) ? $datos['ventanas_lado_izquierdo'] : "null";
			$datos['parabrisas_trasero'] = isset($datos['parabrisas_trasero']) ? $datos['parabrisas_trasero'] : "null";
			$datos['vidrio_puerta_principal'] = isset($datos['vidrio_puerta_principal']) ? $datos['vidrio_puerta_principal'] : "null";
			$datos['vidrio_segunda_puerta'] = isset($datos['vidrio_segunda_puerta']) ? $datos['vidrio_segunda_puerta'] : "null";
			$datos['manijas'] = isset($datos['manijas']) ? $datos['manijas'] : "null";
			$datos['claraboyas'] = isset($datos['claraboyas']) ? $datos['claraboyas'] : "null";
			$datos['airbag'] = isset($datos['airbag']) ? $datos['airbag'] : "null";
			$datos['aire_acondicionado'] = isset($datos['aire_acondicionado']) ? $datos['aire_acondicionado'] : "null";
			$datos['limpieza'] = isset($datos['limpieza']) ? $datos['limpieza'] : "null";
			$datos['chapas'] = isset($datos['chapas']) ? $datos['chapas'] : "null";
			$datos['parales'] = isset($datos['parales']) ? $datos['parales'] : "null";
			$datos['booster_puertas'] = isset($datos['booster_puertas']) ? $datos['booster_puertas'] : "null";
			$datos['reloj_vigia'] = isset($datos['reloj_vigia']) ? $datos['reloj_vigia'] : "null";
			$datos['vigia_delantera_derecha'] = isset($datos['vigia_delantera_derecha']) ? $datos['vigia_delantera_derecha'] : "null";
			$datos['vigia_delantera_izquierda'] = isset($datos['vigia_delantera_izquierda']) ? $datos['vigia_delantera_izquierda'] : "null";
			$datos['vigia_trasera_derecha'] = isset($datos['vigia_trasera_derecha']) ? $datos['vigia_trasera_derecha'] : "null";
			$datos['vigia_trasera_izquierda'] = isset($datos['vigia_trasera_izquierda']) ? $datos['vigia_trasera_izquierda'] : "null";
			$datos['tapa_motor'] = isset($datos['tapa_motor']) ? $datos['tapa_motor'] : "null";
			$datos['tapa_bodegas'] = isset($datos['tapa_bodegas']) ? $datos['tapa_bodegas'] : "null";
			$datos['parasol'] = isset($datos['parasol']) ? $datos['parasol'] : "null";
			$datos['cenefas'] = isset($datos['cenefas']) ? $datos['cenefas'] : "null";
			$datos['emblema_izquierdo'] = isset($datos['emblema_izquierdo']) ? $datos['emblema_izquierdo'] : "null";
			$datos['emblema_derecho'] = isset($datos['emblema_derecho']) ? $datos['emblema_derecho'] : "null";
			$datos['emblema_trasero'] = isset($datos['emblema_trasero']) ? $datos['emblema_trasero'] : "null";
			$datos['equipo_audio'] = isset($datos['equipo_audio']) ? $datos['equipo_audio'] : "null";
			$datos['parlantes'] = isset($datos['parlantes']) ? $datos['parlantes'] : "null";
			$datos['cinturon_usuario'] = isset($datos['cinturon_usuario']) ? $datos['cinturon_usuario'] : "null";
			$datos['martillo_emergencia'] = isset($datos['martillo_emergencia']) ? $datos['martillo_emergencia'] : "null";
			$datos['cant_martillos'] = isset($datos['cant_martillos']) ? $datos['cant_martillos'] : "null";
			$datos['dispositivo_velocidad'] = isset($datos['dispositivo_velocidad']) ? $datos['dispositivo_velocidad'] : "null";
			$datos['avisos'] = isset($datos['avisos']) ? $datos['avisos'] : "null";
			$datos['cant_internos'] = isset($datos['cant_internos']) ? $datos['cant_internos'] : "null";
			$datos['cant_externos'] = isset($datos['cant_externos']) ? $datos['cant_externos'] : "null";
			$datos['placa_trasera'] = isset($datos['placa_trasera']) ? $datos['placa_trasera'] : "null";
			$datos['placa_delantera'] = isset($datos['placa_delantera']) ? $datos['placa_delantera'] : "null";
			$datos['placa_lateral_derecha'] = isset($datos['placa_lateral_derecha']) ? $datos['placa_lateral_derecha'] : "null";
			$datos['placa_lateral_izquierda'] = isset($datos['placa_lateral_izquierda']) ? $datos['placa_lateral_izquierda'] : "null";
			$datos['balizas'] = isset($datos['balizas']) ? $datos['balizas'] : "null";
			$datos['cinturon'] = isset($datos['cinturon']) ? $datos['cinturon'] : "null";
			$datos['gato'] = isset($datos['gato']) ? $datos['gato'] : "null";
			$datos['copa'] = isset($datos['copa']) ? $datos['copa'] : "null";
			$datos['senales_carretera'] = isset($datos['senales_carretera']) ? $datos['senales_carretera'] : "null";
			$datos['botiquin'] = isset($datos['botiquin']) ? $datos['botiquin'] : "null";
			$datos['extintor'] = isset($datos['extintor']) ? $datos['extintor'] : "null";
			$datos['tacos'] = isset($datos['tacos']) ? $datos['tacos'] : "null";
			$datos['alicate'] = isset($datos['alicate']) ? $datos['alicate'] : "null";
			$datos['destornilladores'] = isset($datos['destornilladores']) ? $datos['destornilladores'] : "null";
			$datos['llave_expansion'] = isset($datos['llave_expansion']) ? $datos['llave_expansion'] : "null";
			$datos['llaves_fijas'] = isset($datos['llaves_fijas']) ? $datos['llaves_fijas'] : "null";
			$datos['linterna'] = isset($datos['linterna']) ? $datos['linterna'] : "null";


			if ($_POST['idrevision'] == "") {
				$respuesta = ModeloRevision::mdlAgregarRevision($datos);
			} else {
				$respuesta = ModeloRevision::mdlEditarRevision($datos);
			}

			/* ===================================================
            		GUARDAR KILOMETRAJE VEHICULO
        		===================================================*/
			$tabla = "v_vehiculos";

			$datoskm = array(
				'tabla' => $tabla,
				'item1' => 'kilometraje',
				'valor1' => $datos['kilometraje'],
				'item2' => 'idvehiculo',
				'valor2' => $datos['idvehiculo']
			);

			$respuestakm = ModeloVehiculos::mdlActualizarVehiculo($datoskm);

			if ($respuesta == "ok") {
				echo "
							<script>
								Swal.fire({
									icon: 'success',
									title: '¡Revisión guardada correctamente!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{
	
									if(result.value){
										window.location = 'm-revision-tm';
									}
	
								})
							</script>
						";
			} else {

				echo "
							<script>
								Swal.fire({
									icon: 'error',
									title: '¡Problema al actualizar al revisión!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{
	
									if(result.value){
										window.location = 'm-revision-tm';
									}
	
								})
							</script>
						";
			}
		}
	}

	/* ==================================================
		ELIMINAR REVISION 
	===================================================== */

	static public function ctrEliminarRevision($idrevision)
	{

		$respuesta = ModeloRevision::mdlEliminarRevision($idrevision);
		return $respuesta;
	}
}

class ControladorMantenimientos
{

	/* ===================================================
		GUARDAR ORDEN DE SERVICIO
	===================================================*/

	static public function ctrAgregarEditarOrden($datos)
	{

		if (isset($datos['numOrden_ordSer'])) {

			if ($datos['numOrden_ordSer'] == "") {


				// Validar campos vacíos
				$datos['fechaInic_ordSer'] = $datos['fechaInic_ordSer'] == "" ? null : $datos['fechaInic_ordSer'];
				$datos['fecha_aprobacion'] = !isset($datos['fecha_aprobacion']) ? null : $datos['fecha_aprobacion'];
				$datos['valor_repuesto'] = $datos['valor_repuesto'] == "" ? null : $datos['valor_repuesto'];

				//ALMACENAMOS LA CEDULA DE LA PERSONA QUE HACE LA ORDEN 
				$datos['cedula'] = $_SESSION['cedula'];

				//SI NO SELECCIONAN ESTADO LA PONE ABIERTA 
				if ($datos['estado'] == 3) {

					$datos['estado'] = 1;
				}

				#RETORNA EL ÚLTIMO ID INSERTADO
				$respuesta = ModeloMantenimientos::mdlAgregarOrdenServicio($datos);
				$idorden = $respuesta;


				//SI EL ESTADO ES 2 (APROBADA) PONE LA FECHA ACTUAL EN FECHA DE APROBACION
				// PERO SI HAY FECHA EN LA BASE DE DATOS, DEJARLA COMO ESTÁ
				if ($datos['estado'] == 2) {
					//GUARDAMOS FECHA DE APROBACIÓN COMO LA ACTUAL
					$date = date('Y-m-d H:i:s');
					$datos['fecha_aprobacion'] = $date;

					//EDITO INVENTARIO Y GENERO MOVIMIENTO
					if (isset($datos['inventario'])) {
						foreach ($datos['inventario'] as $key => $value) {
							if ($value != "") {
								$idinventario = intval($value);
								$cantidad = intval($datos['cantidad_repuesto'][$key]);
								$datos['tipo_movimiento'] = 'SALIDA';
								$movimiento = $datos['tipo_movimiento'];
								$valor = intval($datos['valor_repuesto'][$key]);
								$idproveedor = intval($datos['idproveedor_repuesto'][$key]);
								$factura = $datos['numFactura_ordSer'];
								$observaciones = $datos['observacion'];
								$datos['posicion'] = "";
								$posicion = $datos['posicion'];
								$stock = ModeloProductos::mdlConsultarStock($idinventario);
								$stock_nuevo = $stock[0] - $cantidad;
								$datos['stock'] = $stock_nuevo;

								$datos2 = array(
									'idinventario' => $datos['inventario'][$key],
									'posicion' => $datos['posicion'],
									'stock' => $datos['stock']
								);

								$datos3 = array(
									'idinventario' => $idinventario,
									'cantidad' => $cantidad,
									'tipo_movimiento' => $movimiento,
									'preciocompra' => $valor,
									'idproveedor' => $idproveedor,
									'facturacompra' => $factura,
									'observaciones' => $datos['observacion']
								);

								// var_dump($datos['inventario'][$key], $datos['posicion'], $datos['stock']);
								$respuesta = ModeloProductos::mdlAgregarMovimiento($datos3);
								$respuesta = ModeloProductos::mdlEditarInventario($datos2);
							}
						}
					}



					//AGREGO LA PROGRAMACIÓN DE REPUESTO
					if (isset($datos['servicio_repuesto'])) {
						foreach ($datos['servicio_repuesto'] as $key => $value) {

							if ($value != 10 && $datos['servrepuesto'][$key] != "Otros") {
								$datos2 = array(
									'idvehiculo_serv' => $datos['idvehiculo_OrdServ'],
									'idservicio' => $value,
									'kilometraje_serv' => $datos['kilome_ordSer'],
									'fecha' => $datos['fechaInic_ordSer'],
									'idorden' => $idorden
								);

								$respuesta = ModeloMantenimientos::mdlAgregarServicio($datos2);
							}
						}
					}

					//AGREGO LA PROGRAMACIÓN DE MANO DE OBRA
					if (isset($datos['servicio_mano'])) {
						foreach ($datos['servicio_mano'] as $key => $value) {
							if ($value != 10 && $datos['servmanoObra'][$key] != "Otros") {
								$datos2 = array(
									'idvehiculo_serv' => $datos['idvehiculo_OrdServ'],
									'idservicio' => $value,
									'kilometraje_serv' => $datos['kilome_ordSer'],
									'fecha' => $datos['fechaInic_ordSer'],
									'idorden' => $idorden
								);

								$respuesta = ModeloMantenimientos::mdlAgregarServicio($datos2);
							}
						}
					}
				}


				#GUARDAR REPUESTO
				if (isset($datos['inventario'])) {
					foreach ($datos['inventario'] as $key => $value) {
						if ($value != "") {
							$idorden = intval($respuesta);
							$idinventario = intval($value);
							$cantidad = intval($datos['cantidad_repuesto'][$key]);
							$idservicio = intval($datos['servicio_repuesto'][$key]);
							$sistema = $datos['sistemarepuesto'][$key];
							$mantenimiento = $datos['mantenimientorepuesto'][$key];
							$iva = intval($datos['iva_repuesto'][$key]);
							$total = intval($datos['total_repuesto'][$key]);
							$idproveedor = intval($datos['idproveedor_repuesto'][$key]);
							$valor = intval($datos['valor_repuesto'][$key]);
							$idcuenta = intval($datos['idcuenta'][$key]);
							$add = ModeloMantenimientos::mdlAgregarRepuestoOrdenServicio($idorden, $idinventario, $cantidad, $idservicio, $sistema, $mantenimiento, $iva, $total, $idproveedor, $valor, $idcuenta);
						}
					}
				}

				#GUARDAR MANO DE OBRA
				if (isset($datos['proveedor'])) {
					foreach ($datos['proveedor'] as $key => $value) {
						if ($value != "") {
							$idorden = intval($respuesta);
							$idproveedor = intval($value);
							$descrip = $datos['descrip_mano'][$key];
							$valor = intval($datos['valor_mano'][$key]);
							$cantidad = intval($datos['cantmanoObra'][$key]);
							$idservicio = intval($datos['servicio_mano'][$key]);
							$sistema = $datos['sistmanoobra'][$key];
							$mantenimiento = $datos['mantenimientomanobra'][$key];
							$iva = intval($datos['iva_mano'][$key]);
							$total = intval($datos['total_mano'][$key]);
							$idcuenta = intval($datos['idcuenta_mano'][$key]);
							$add = ModeloMantenimientos::mdlAgregarManoObra($idorden, $idproveedor, $descrip, $valor, $cantidad, $idservicio, $sistema, $mantenimiento, $iva, $total, $idcuenta);
						}
					}
				}


				#GUARDAR SERVICIOS EXTERNOS
				if (isset($datos['serviciosexternos'])) {
					// $borrar = ModeloMantenimientos::mdlEliminarServiciosExternosOrden($datos['numOrden_ordSer']);
					foreach ($datos['serviciosexternos'] as $key => $value) {
						if ($value != "") {
							$id = intval($respuesta);
							$dato = intval($value);
							$addServicio = ModeloMantenimientos::mdlAgregarServiciosExternosOrdenServicio($id, $dato);
						}
					}
				}



				return $respuesta;
			} else {

				//OBTENEMOS LOS DATOS DE ESA ORDEN
				$datosOrden = ModeloMantenimientos::mdlCargarOrdenServicio($datos['numOrden_ordSer']);


				if ($datosOrden['idvehiculo'] != "") {
					$idvehiculo = intval($datosOrden['idvehiculo']);
					$datos['idvehiculo_OrdServ'] = $idvehiculo;
				}



				//SI EL ESTADO ES 2 (APROBADA) PONE LA FECHA ACTUAL EN FECHA DE APROBACION
				// PERO SI HAY FECHA EN LA BASE DE DATOS, Y EL ESTADO ANTERIOR ES APROBADO DEJARLA COMO ESTÁ, SI NO ACTUALIZAR  
				// $fecha_aprobacion = ModeloMantenimientos::mdlCargarOrdenServicio($datos['numOrden_ordSer']);


				if ($datosOrden['estado'] != 2) {
					if ($datos['estado'] == 2) {
						$date = date('Y-m-d H:i:s');
						$datos['fecha_aprobacion'] = $date;
					}
				} else {
					//INSERTAMOS LA FECHA DE APROBACION
					$datos['fecha_aprobacion'] = $datosOrden['fecha_aprobacion'];

					//EDITO INVENTARIO Y GENERAMOS MOVIMIENTO
					if (isset($datos['inventario'])) {
						foreach ($datos['inventario'] as $key => $value) {
							if ($value != "") {
								$idinventario = intval($value);
								$cantidad = intval($datos['cantidad_repuesto'][$key]);
								$datos['tipo_movimiento'] = 'SALIDA';
								$movimiento = $datos['tipo_movimiento'];
								$valor = intval($datos['valor_repuesto'][$key]);
								$idproveedor = intval($datos['idproveedor_repuesto'][$key]);
								$factura = $datos['numFactura_ordSer'];
								$observaciones = $datos['observacion'];
								$datos['posicion'] = "";
								$posicion = $datos['posicion'];
								$stock = ModeloProductos::mdlConsultarStock($idinventario);
								$stock_nuevo = $stock[0] - $cantidad;
								$datos['stock'] = $stock_nuevo;

								$datos2 = array(
									'idinventario' => $datos['inventario'][$key],
									'posicion' => $datos['posicion'],
									'stock' => $datos['stock']
								);

								$datos3 = array(
									'idinventario' => $idinventario,
									'cantidad' => $cantidad,
									'tipo_movimiento' => $movimiento,
									'preciocompra' => $valor,
									'idproveedor' => $idproveedor,
									'facturacompra' => $factura,
									'observaciones' => $datos['observacion']
								);

								// var_dump($datos['inventario'][$key], $datos['posicion'], $datos['stock']);
								$respuesta = ModeloProductos::mdlAgregarMovimiento($datos3);
								$respuesta = ModeloProductos::mdlEditarInventario($datos2);
							}
						}
					}


					//AGREGO LA PROGRAMACIÓN DE REPUESTO 
					if (isset($datos['servicio_repuesto'])) {
						$borrar = ModeloMantenimientos::mdlEliminarServicioxOrden($datos['numOrden_ordSer']);
						foreach ($datos['servicio_repuesto'] as $key => $value) {


							if ($value != 10 && $datos['servrepuesto'][$key] != "Otros") {
								$datos2 = array(
									'idvehiculo_serv' => $datos['idvehiculo_OrdServ'],
									'idservicio' => $value,
									'kilometraje_serv' => $datos['kilome_ordSer'],
									'fecha' => $datos['fechaInic_ordSer'],
									'idorden' => $datos['numOrden_ordSer']
								);

								$respuesta = ModeloMantenimientos::mdlAgregarServicio($datos2);
							}
						}
					}


					//AGREGO LA PROGRMACIÓN DE MANO DE OBRA 
					if (isset($datos['servicio_mano'])) {

						if ($borrar != "ok") $borrar = ModeloMantenimientos::mdlEliminarServicioxOrden($datos['numOrden_ordSer']);

						foreach ($datos['servicio_mano'] as $key => $value) {
							if ($value != 10 && $datos['servmanoObra'][$key] != "Otros") {
								$datos2 = array(
									'idvehiculo_serv' => $datos['idvehiculo_OrdServ'],
									'idservicio' => $value,
									'kilometraje_serv' => $datos['kilome_ordSer'],
									'fecha' => $datos['fechaInic_ordSer'],
									'idorden' => $datos['numOrden_ordSer']
								);

								$respuesta = ModeloMantenimientos::mdlAgregarServicio($datos2);
							}
						}
					}
				}



				//SI NO SELECCIONAN ESTADO LA PONE ABIERTA 
				if ($datos['estado'] == 3) $datos['estado'] = 1;

				// Validar campos vacíos
				$datos['fechaInic_ordSer'] = $datos['fechaInic_ordSer'] == "" ? null : $datos['fechaInic_ordSer'];

				//ACTUALIZA DATOS GENERALES DE LA ORDEN
				$respuesta = ModeloMantenimientos::mdlActualizarOrden($datos);

				//ACTUALIZA REPUESTOS DE LA ORDEN
				if (isset($datos['inventario'])) {
					$borrar = ModeloMantenimientos::mdlEliminarRepuesto($datos['numOrden_ordSer']);
					foreach ($datos['inventario'] as $key => $value) {
						if ($value != "") {
							$idorden = $datos['numOrden_ordSer'];
							$idinventario = intval($value);
							$cantidad = intval($datos['cantidad_repuesto'][$key]);
							$idservicio = intval($datos['servicio_repuesto'][$key]);
							$sistema = $datos['sistemarepuesto'][$key];
							$mantenimiento = $datos['mantenimientorepuesto'][$key];
							$iva = intval($datos['iva_repuesto'][$key]);
							$total = intval($datos['total_repuesto'][$key]);
							$idproveedor = intval($datos['idproveedor_repuesto'][$key]);
							$valor = intval($datos['valor_repuesto'][$key]);
							$idcuenta = intval($datos['idcuenta'][$key]);

							$add = ModeloMantenimientos::mdlAgregarRepuestoOrdenServicio($idorden, $idinventario, $cantidad, $idservicio, $sistema, $mantenimiento, $iva, $total, $idproveedor, $valor, $idcuenta);
						}
					}
				}

				//ACTUALIZA MANO DE OBRA DE LA ORDEN
				if (isset($datos['proveedor'])) {
					$borrar = ModeloMantenimientos::mdlEliminarManoObra($datos['numOrden_ordSer']);
					foreach ($datos['proveedor'] as $key => $value) {
						if ($value != "") {
							$idorden = $datos['numOrden_ordSer'];
							$idproveedor = intval($value);
							$descrip = $datos['descrip_mano'][$key];
							$valor = intval($datos['valor_mano'][$key]);
							$cantidad = intval($datos['cantmanoObra'][$key]);
							$idservicio = intval($datos['servicio_mano'][$key]);
							$sistema = $datos['sistmanoobra'][$key];
							$mantenimiento = $datos['mantenimientomanobra'][$key];
							$iva = intval($datos['iva_mano'][$key]);
							$total = intval($datos['total_mano'][$key]);
							$idcuenta = intval($datos['idcuenta_mano'][$key]);
							$add = ModeloMantenimientos::mdlAgregarManoObra($idorden, $idproveedor, $descrip, $valor, $cantidad, $idservicio, $sistema, $mantenimiento, $iva, $total, $idcuenta);
						}
					}
				}

				//ACTUALIZA SERVICIOS EXTERNOS DE LA ORDEN

				$borrar = ModeloMantenimientos::mdlEliminarServiciosExternosOrden($datos['numOrden_ordSer']);
				if (isset($datos['serviciosexternos'])) {
					foreach ($datos['serviciosexternos'] as $key => $value) {
						if ($value != "") {
							$id = $datos['numOrden_ordSer'];
							$dato = intval($value);
							$addServicio = ModeloMantenimientos::mdlAgregarServiciosExternosOrdenServicio($id, $dato);
						}
					}
				}


				return $datos['numOrden_ordSer'];
			}
		}
	}

	/* ===================================================
		CARGAR DATOS DE UNA ORDEN DE SERVICIO
	===================================================*/
	static public function ctrCargarOrdenServicio($idorden)
	{
		$respuesta = ModeloMantenimientos::mdlCargarOrdenServicio($idorden);
		return $respuesta;
	}

	/* ===================================================
		LISTADO DE REPUESTOS ORDEN DE SERVICIO
	===================================================*/
	static public function ctrRepuestosOrden($idorden)
	{
		$respuesta = ModeloMantenimientos::mdlRepuestosOrden($idorden);
		return $respuesta;
	}

	/* ===================================================
		LISTADO DE MANO DE OBRAS ORDEN DE SERVICIO
	===================================================*/
	static public function ctrManoObraOrden($idorden)
	{
		$respuesta = ModeloMantenimientos::mdlManoObraOrden($idorden);
		return $respuesta;
	}

	/* ===================================================
		LISTADO DE SERVICIOS EXTERNOS DE UNA ORDEN DE SERVICIO
	===================================================*/

	static public function ctrServiciosExt($idorden)
	{
		$respuesta = ModeloMantenimientos::mdlServicosExternosOrden($idorden);
		return $respuesta;
	}

	/* ===================================================
		LISTADO SERVICIOS EXTERNOS 
	===================================================*/

	static public function ctrListadoServiciosExternos()
	{
		$respuesta = ModeloMantenimientos::mdlListadoServiciosExternos();
		return $respuesta;
	}

	/* ===================================================
		LISTADO DE ORDENES DE SERVICIO
	===================================================*/

	static public function ctrListadoOrdenesServicio()
	{
		$respuesta = ModeloMantenimientos::mdlListadoOrdenesServicio();
		return $respuesta;
	}

	/* ===================================================
		LISTADO DE PRODUCTOS
	===================================================*/

	static public function ctrListadoProductos()
	{
		$respuesta = ModeloMantenimientos::mdlListadoProductos();
		return $respuesta;
	}

	/* ===================================================
		AGREGAR SOLICITUD DE SERVICIO	
	===================================================*/

	static public function ctrAgregarSolicitud($datos)
	{

		//Array de servicios
		$arrayserv = ModeloMantenimientos::mdlListadoServiciosExternos();


		foreach ($arrayserv as $key => $value) {
			if (isset($_POST['servicioexterno_' . $value['idservicio_externo']]) && $_POST['servicioexterno_' . $value['idservicio_externo']] == "on") {
				$datos['servicioexterno_' . $value['idservicio_externo']] = 1;
			} else {
				$datos['servicioexterno_' . $value['idservicio_externo']] = 0;
			}
		}



		// $respuesta = ModeloMantenimientos::mdlAgregarSolicitud($datos);
		// return $respuesta;

	}

	/* ===================================================
		AGREGAR SERVICIO PROGRAMACIÓN 
	===================================================*/

	static public function ctrAgregarProgramacion($datos)
	{

		$respuesta = ModeloMantenimientos::mdlAgregarServicio($datos);

		/* ===================================================
            GUARDAR KILOMETRAJE VEHICULO
        ===================================================*/
		$tabla = "v_vehiculos";

		$datoskm = array(
			'tabla' => $tabla,
			'item1' => 'kilometraje',
			'valor1' => $datos['kilometraje_serv'],
			'item2' => 'idvehiculo',
			'valor2' => $datos['idvehiculo_serv']
		);

		$respuestakm = ModeloVehiculos::mdlActualizarVehiculo($datoskm);


		return $respuesta;
	}

	/* ===================================================
		LISTADO CONTROL DE ACTIVIDADES ORDEN DE SERVICIO
	===================================================*/
	static public function ctrListadoControlActividades()
	{
		$respuesta = ModeloMantenimientos::mdlListadoControlActividades();
		return $respuesta;
	}

	/* ===================================================
		LISTADO DE CUENTAS CONTABLES
	===================================================*/
	static public function ctrListaCuentasContables()
	{
		$respuesta = ModeloMantenimientos::mdlListaCuentasContables();

		return $respuesta;
	}

	/* ===================================================
		GUARDA QUIEN ASUME 
	===================================================*/
	static public function ctrGuardaAsume($datos)
	{

		//VALIDAMOS SI ES UN REPUESTO O UNA MANO DE OBRA 
		if ($datos['descripcion'] == "REPUESTO") {
			$respuesta = ModeloMantenimientos::mdlGuardaAsumeRepuesto($datos);
		} else {
			$respuesta = ModeloMantenimientos::mdlGuardaAsumeManoObra($datos);
		}


		return $respuesta;
	}

	/* ===================================================
		LISTADO DE PROGRAMACIÓN 
	===================================================*/
	static public function ctrListaProgramacion()
	{
		$respuesta = ModeloMantenimientos::mdlListaProgramacion();
		return $respuesta;
	}

	/* ===================================================
		GUARDAR SOLICITUD
	===================================================*/
	static public function ctrGuardarSolicitudProgramacion($datos)
	{
		//Validar campos nulos 
		$datos['fecha_progra'] = $datos['fecha_progra'] == "" ? null : $datos['fecha_progra'];


		//Validamos si es una solicitud nueva o si es una que ya está 
		if (isset($datos['idsolicitud'])) {
			if ($datos['idsolicitud'] == '' || $datos['idsolicitud'] == NULL) {
				//Añadimos la nueva solicitud 
				$respuesta = ModeloMantenimientos::mdlGuardarSolicitudProgramacion($datos);
				return $respuesta;
			} else {
				//Consultamos datos de esa solicitud
				$DatosSolicitud = ModeloMantenimientos::mdlDatosSolicitudProgramacion($datos['idsolicitud']);

				//Validamos que estado nuevo viene para actualizar el estado de la solicitud anterior de ese vehículo 
				if ($datos['estado_programacion'] == "NUEVO") {
					//PONEMOS EL ESTADO DE LA ANTERIOR SOLICITUD EN FINALIZADO
					$DatosSolicitud['estado'] = "FINALIZADO";
					$respuesta = ModeloMantenimientos::mdlActualizarEstadoSolicitudProgramacion($DatosSolicitud);
					//PONEMOS EL ESTADO DE LA NUEVA SOLICITUD EN PENDIENTE Y GUARDAMOS LOS DATOS
					$datos['estado_programacion'] = "PENDIENTE";
					$respuesta = ModeloMantenimientos::mdlGuardarSolicitudProgramacion($datos);
				}
				if ($datos['estado_programacion'] == "REPROGRAMADO"){
					//PONEMOS EL ESTADO DE LA ANTERIOR SOLICITUD EN REPROGRAMADO
					$DatosSolicitud['estado'] = "REPROGRAMADO";
					$respuesta = ModeloMantenimientos::mdlActualizarEstadoSolicitudProgramacion($DatosSolicitud);
					//PONEMOS EL ESTADO DE LA NUEVA SOLICITUD EN PENDIENTE Y GUARDAMOS LOS DATOS 
					$datos['estado_programacion'] = "PENDIENTE";
					$respuesta = ModeloMantenimientos::mdlGuardarSolicitudProgramacion($datos);

				}
					


				return $respuesta;
			}
		}
	}
}
