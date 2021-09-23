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
    public function ctrAgregarInventario()
    {
        if( isset($_POST['placa_invent'])){

            $datos = array(
				'placa' => $_POST['placa_invent'],
				'tipovel' => $_POST['tipo_vel'],
				'conductor' => $_POST['conductor_invent'],
				'kilom' => $_POST['kilometraje'],
				'fechai' => $_POST['fecha_inventario'],
				'recep_entrega' => $_POST['recepcion_entrega_vehiculo'],
				'techoext' => $_POST['Techo_exterior'],
				'techoint' => $_POST['Techo_interior'],
                'frente' => $_POST['Frente'],
				'bomper_del' => $_POST['Bomper_delantero'],
				'bomper_tra' => $_POST['Bomper_trasero'],
				'lateral_der' => $_POST['Lateral_derecho'],
				'lateral_izq' => $_POST['Lateral_izquierdo'],
				'puerta_der' => $_POST['Puerta_derecho'],
				'puerta_izq' => $_POST['Puerta_izquierda'],
				'parab_izq' => $_POST['parabrisas_izquierdo'],
                'parab_der' => $_POST['parabrisas_derecho'],
				'espejo_re_der' => $_POST['Espejo_retrovisor_derecho'],
				'espejo_re_izq' => $_POST['Espejo_retrovisor_izquierdo'],
				'vidrios_ven_der' => $_POST['Vidrios_ventanas_lateral_derecho'],
				'vidrios_ven_izq' => $_POST['Vidrios_ventanas_lateral_izquierdo'],
				'parab_tra' => $_POST['Parabrisas_trasero'],
				'vidrios_puert' => $_POST['Vidrios_puertas'],
				'dir_del_izq' => $_POST['Direccionalelantera_izquierda'],
                'dir_del_der' => $_POST['Direccional_elantera_derecha'],
				'stop_tra_der' => $_POST['Stop_trasero_derecho'],
				'stop_tra_izq' => $_POST['Stop_trasero_izquierdo'],
				'cucu_la_der' => $_POST['Cucuyo_lateral_derecho'],
				'cucu_la_izq' => $_POST['Cucuyo_lateral_izquierdo'],
				'num_luces_in' => $_POST['numero_luces_internas'],
				'luces_in' => $_POST['Luces_internas'],
				'balizas' => $_POST['Balizas'],
                'delan_izq_r1' => $_POST['Delantera_izquierda_R1'],
				'delan_izq_r2' => $_POST['Delantera_izquierda_R2'],
				'tra_in_izq_r3' => $_POST['Trasera_interior_izquierda_R3'],
				'tra_ex_izq_r4' => $_POST['Trasera_exterior_izquierda_R4'],
				'tra_in_der_r5' => $_POST['Trasera_interior_derecha_R5'],
				'tra_ex_der_r6' => $_POST['Trasera_exterior_derecha_R6'],
				'gato' => $_POST['Gato'],
				'cru_copa' => $_POST['Cruceta__Copa'],
                'conos_trian' => $_POST['2Conos__Triangulos'],
				'botiquin' => $_POST['Botiquin'],
				'extintor' => $_POST['Extintor'],
				'tacos_bloq' => $_POST['2Tacos_Bloques'],
				'alicate_destor' => $_POST['1Alicate_destornillaodor'],
				'llave_exp_fijas' => $_POST['2PLlave_expancion_LLaves_fijas'],
				'llanta_repues' => $_POST['LLanta_repuesto'],
				'linterna_pila' => $_POST['Linterna_pila'],
                'cintu_cond' => $_POST['Cinturon_conductor'],
				'radiotele' => $_POST['Radioteléfono'],
				'antena' => $_POST['Antena'],
				'usb_cd' => $_POST['usb_cd'],
				'equipo_sonido' => $_POST['Equipo_Sonido'],
				'num_parla' => $_POST['num_parlantes'],
				'parlantes' => $_POST['Parlantes'],
				'mangue_agua' => $_POST['Manguera_agua'],
                'mangue_aire' => $_POST['Manguera_aire'],
				'panta_tele' => $_POST['Pantalla_Televisor'],
				'reloj' => $_POST['Reloj'],
				'brazo_izq_r1' => $_POST['Brazo_1_Izquierdo_R1'],
				'brazo_der_r2' => $_POST['Brazo_2_Derecho_R2'],
				'brazo_izq_r3' => $_POST['Brazo_3_Izquierdo_R3'],
				'brazo_der_r6' => $_POST['Brazo_4_Derecho_R6'],
				'emble_izq_empre' => $_POST['Emblema_izquierdo_empresa'],
                'emble_der_empre' => $_POST['Emblema_derecho_empresa'],
				'escolar_del_tra' => $_POST['escolar_delantero_trasero'],
				'escolar' => $_POST['escolar'],
				'logo_izq' => $_POST['Logo_izquierdo'],
				'logo_der' => $_POST['Logo_derecho'],
                'ninter_del' => $_POST['N_Interno_delantero'],
				'ninter_tra' => $_POST['N_Interno_trasero'],
				'ninter_izq' => $_POST['N_Interno_izquierdo'],
				'ninter_der' => $_POST['N_Interno_derecho'],
				'num_salidas' => $_POST['Nsalidas_martillos'],
				'salidas_emer' => $_POST['Salidas_emergencia_martillos'],
				'dispo_velo' => $_POST['Dispositivo_velocidad'],
				'in_ext_conduzco' => $_POST['interno_externo_comoConduzco'],
                'como_conduzco' => $_POST['Av_Como_conduzco'],
				'brazo_limp_izq' => $_POST['Brazo_limpiaparabrisas_izquierdo'],
				'plumilla_limp_izq' => $_POST['Plumilla_limpiaparabrisas_izquierdo'],
				'brazo_limp_der' => $_POST['7Brazo_limpiaparabrisas_derecho'],
				'plumilla_limp_der' => $_POST['Plumilla_limpiaparabrisas_derecho'],
				'baterias' => $_POST['Baterias'],
				'boton_table_tim' => $_POST['Botones_tableron_timon'],
				'tapa_radia' => $_POST['Tapa_radiador'],
                'tapa_depo_hidra' => $_POST['Tapa_deposito_hidráulico'],
                'cojin_general' => $_POST['Cojineria_general'],
				'cintu_sillas' => $_POST['Cinturon_sillas_calidad'],
				'pasama' => $_POST['Pasamanos'],
				'claxon' => $_POST['Claxon'],
                'placa_regla' => $_POST['Placas_reglamentarias'],
                'observ' => $_POST['observaciones']
			);

			$responseModel = ModeloInventario::mdlAgregarInventario($datos);

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
        }
    }
}