<?php

class ControladorProveedores
{
	static public function ctrListarProveedores()
	{
		$respuesta = ModeloProveedores::mdlListarProveedores(null);
		return $respuesta;
	}

	static public function ctrAgregarEditarProveedor()
	{
		if (isset($_POST['cc_proveedor'])) {

			$proveedorexistente = ModeloProveedores::mdlListarProveedores($_POST['cc_proveedor']);

			$datos = array(
				'id' => $_POST['id_proveedor'],
				'nit' => $_POST['cc_proveedor'],
				'cont' => $_POST['contacto_proveedor'],
				'nombre' => $_POST['nom_razonsocial'],
				'dir' => $_POST['direccion_proveedor'],
				'correo' => $_POST['correo_proveedor'],
				'tel' => $_POST['telef_proveedor'],
				'ciudad' => $_POST['ciudad_proveedor']
			);

			if (is_array($proveedorexistente) && $proveedorexistente['id'] != $_POST['id_proveedor']) {
				echo "
							<script>
								Swal.fire({
									icon: 'warning',
									title: 'El proveedor ya existe!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{

									if(result.value){
										window.location = 'm-proveedores';
									}

								})
							</script>
						";
				return;
			} else {

				if ($_POST['id_proveedor'] == '') {


					$responseModel = ModeloProveedores::mdlAgregarProveedor($datos);

					if ($responseModel == "ok") {

						echo "
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Proveedor añadido correctamente!',						
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        
                                    }).then((result)=>{
        
                                        if(result.value){
                                            window.location = 'm-proveedores';
                                        }
        
                                    })
                                </script>
                            ";
					} else {
						echo "
                                <script>
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¡Problema al añadir el proveedor!',						
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        
                                    }).then((result)=>{
        
                                        if(result.value){
                                            window.location = 'm-proveedores';
                                        }
        
                                    })
                                </script>
                            ";
					}
				} else {


					$responseModel = ModeloProveedores::mdlEditarProveedor($datos);

					if ($responseModel == "ok") {

						echo "
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Proveedor actualizado correctamente!',						
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        
                                    }).then((result)=>{
        
                                        if(result.value){
                                            window.location = 'm-proveedores';
                                        }
        
                                    })
                                </script>
                            ";
					} else {
						echo "
                                <script>
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¡Problema al actualizar el proveedor!',						
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        
                                    }).then((result)=>{
        
                                        if(result.value){
                                            window.location = 'm-proveedores';
                                        }
        
                                    })
                                </script>
                            ";
					}
				}
			}
		}
	}
}

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
