<?php

/* ===================================================
   * PROTOCOLO DE ALISTAMIENTO
===================================================*/
class ControladorAlistamiento
{
    /* ===================================================
       LISTA DE EVIDENCIAS
    ===================================================*/
    static public function ctrListaEvidencias($idvehiculo)
    {
        $respuesta = ModeloAlistamiento::mdlListaEvidencias($idvehiculo);
        return $respuesta;
    }

    /* ===================================================
       GUARDAR ALISTAMIENTO
    ===================================================*/
    static public function ctrGuardarAlistamiento($datos)
    {
        $datosBusqueda = array(
            'item' => 'idvehiculo',
            'valor' => $datos['idvehiculo']
        );
        $alistamiento = ModeloAlistamiento::mdlDatosAlistamiento($datosBusqueda, "fecha");

        /* ===================================================
           REVISAR QUE LOS DATOS NO ESTEN VACIOS
        ===================================================*/
        // $datos['idvehiculo'] = isset($datos['idvehiculo']) ? $datos['idvehiculo'] : null;
        // $datos['idconductor'] = isset($datos['idconductor']) ? $datos['idconductor'] : null;
        $datos['lucesbajas'] = isset($datos['lucesbajas']) ? $datos['lucesbajas'] : null;
        $datos['lucesaltas'] = isset($datos['lucesaltas']) ? $datos['lucesaltas'] : null;
        $datos['lucesreversa'] = isset($datos['lucesreversa']) ? $datos['lucesreversa'] : null;
        $datos['direccionales_delanteras'] = isset($datos['direccionales_delanteras']) ? $datos['direccionales_delanteras'] : null;
        $datos['direccionales_traseras'] = isset($datos['direccionales_traseras']) ? $datos['direccionales_traseras'] : null;
        $datos['iluminacioncabina'] = isset($datos['iluminacioncabina']) ? $datos['iluminacioncabina'] : null;
        $datos['lucesinternas'] = isset($datos['lucesinternas']) ? $datos['lucesinternas'] : null;
        $datos['lucesmedias'] = isset($datos['lucesmedias']) ? $datos['lucesmedias'] : null;
        $datos['lucesdestop'] = isset($datos['lucesdestop']) ? $datos['lucesdestop'] : null;
        $datos['lucesdeparqueo'] = isset($datos['lucesdeparqueo']) ? $datos['lucesdeparqueo'] : null;
        $datos['luzescala'] = isset($datos['luzescala']) ? $datos['luzescala'] : null;
        $datos['baliza_licuadora'] = isset($datos['baliza_licuadora']) ? $datos['baliza_licuadora'] : null;
        $datos['retrovisor_izquierdo'] = isset($datos['retrovisor_izquierdo']) ? $datos['retrovisor_izquierdo'] : null;
        $datos['retrovisor_derecho'] = isset($datos['retrovisor_derecho']) ? $datos['retrovisor_derecho'] : null;
        $datos['apoyacabeza_conductor'] = isset($datos['apoyacabeza_conductor']) ? $datos['apoyacabeza_conductor'] : null;
        $datos['apoyacabeza_pasajero'] = isset($datos['apoyacabeza_pasajero']) ? $datos['apoyacabeza_pasajero'] : null;
        $datos['equipoaudio'] = isset($datos['equipoaudio']) ? $datos['equipoaudio'] : null;
        $datos['claraboya'] = isset($datos['claraboya']) ? $datos['claraboya'] : null;
        $datos['espejointerno'] = isset($datos['espejointerno']) ? $datos['espejointerno'] : null;
        $datos['parabrisas'] = isset($datos['parabrisas']) ? $datos['parabrisas'] : null;
        $datos['placas'] = isset($datos['placas']) ? $datos['placas'] : null;
        $datos['limpiaparabrisas_derecho'] = isset($datos['limpiaparabrisas_derecho']) ? $datos['limpiaparabrisas_derecho'] : null;
        $datos['limpiaparabrisas_izquierdo'] = isset($datos['limpiaparabrisas_izquierdo']) ? $datos['limpiaparabrisas_izquierdo'] : null;
        $datos['piso'] = isset($datos['piso']) ? $datos['piso'] : null;
        $datos['bomper_delantero'] = isset($datos['bomper_delantero']) ? $datos['bomper_delantero'] : null;
        $datos['bomper_trasero'] = isset($datos['bomper_trasero']) ? $datos['bomper_trasero'] : null;
        $datos['alarmareversa'] = isset($datos['alarmareversa']) ? $datos['alarmareversa'] : null;
        $datos['sillas'] = isset($datos['sillas']) ? $datos['sillas'] : null;
        $datos['antideslizante_escaleras'] = isset($datos['antideslizante_escaleras']) ? $datos['antideslizante_escaleras'] : null;
        $datos['puertas'] = isset($datos['puertas']) ? $datos['puertas'] : null;
        $datos['claxon'] = isset($datos['claxon']) ? $datos['claxon'] : null;
        $datos['cinturones_pasajero'] = isset($datos['cinturones_pasajero']) ? $datos['cinturones_pasajero'] : null;
        $datos['cinturones_conductor'] = isset($datos['cinturones_conductor']) ? $datos['cinturones_conductor'] : null;
        $datos['pasamanos_interno'] = isset($datos['pasamanos_interno']) ? $datos['pasamanos_interno'] : null;
        $datos['indicador_velocidad'] = isset($datos['indicador_velocidad']) ? $datos['indicador_velocidad'] : null;
        $datos['ventaneria'] = isset($datos['ventaneria']) ? $datos['ventaneria'] : null;
        $datos['nivel_refrigerante'] = isset($datos['nivel_refrigerante']) ? $datos['nivel_refrigerante'] : null;
        $datos['nivel_combustible'] = isset($datos['nivel_combustible']) ? $datos['nivel_combustible'] : null;
        $datos['baterias'] = isset($datos['baterias']) ? $datos['baterias'] : null;
        $datos['freno_principal'] = isset($datos['freno_principal']) ? $datos['freno_principal'] : null;
        $datos['liquido_hidraulico'] = isset($datos['liquido_hidraulico']) ? $datos['liquido_hidraulico'] : null;
        $datos['estado_correas'] = isset($datos['estado_correas']) ? $datos['estado_correas'] : null;
        $datos['nivel_liquido_frenos'] = isset($datos['nivel_liquido_frenos']) ? $datos['nivel_liquido_frenos'] : null;
        $datos['caja_cambios'] = isset($datos['caja_cambios']) ? $datos['caja_cambios'] : null;
        $datos['direccion'] = isset($datos['direccion']) ? $datos['direccion'] : null;
        $datos['nivel_aceite'] = isset($datos['nivel_aceite']) ? $datos['nivel_aceite'] : null;
        $datos['freno_emergencia'] = isset($datos['freno_emergencia']) ? $datos['freno_emergencia'] : null;
        $datos['velocimetro'] = isset($datos['velocimetro']) ? $datos['velocimetro'] : null;
        $datos['carga_bateria'] = isset($datos['carga_bateria']) ? $datos['carga_bateria'] : null;
        $datos['presion_aceite'] = isset($datos['presion_aceite']) ? $datos['presion_aceite'] : null;
        $datos['temperatura'] = isset($datos['temperatura']) ? $datos['temperatura'] : null;
        $datos['combustible'] = isset($datos['combustible']) ? $datos['combustible'] : null;
        $datos['presion_aire'] = isset($datos['presion_aire']) ? $datos['presion_aire'] : null;
        // $datos['cambio_aceite'] = isset($datos['cambio_aceite']) ? $datos['cambio_aceite'] : null;
        // $datos['engrase'] = isset($datos['engrase']) ? $datos['engrase'] : null;
        // $datos['sincronizacion'] = isset($datos['sincronizacion']) ? $datos['sincronizacion'] : null;
        // $datos['filtro_aire'] = isset($datos['filtro_aire']) ? $datos['filtro_aire'] : null;
        // $datos['rotacion_llantas'] = isset($datos['rotacion_llantas']) ? $datos['rotacion_llantas'] : null;
        // $datos['alineacion_balanceo'] = isset($datos['alineacion_balanceo']) ? $datos['alineacion_balanceo'] : null;
        $datos['llantas_delanteras'] = isset($datos['llantas_delanteras']) ? $datos['llantas_delanteras'] : null;
        $datos['llantas_traseras'] = isset($datos['llantas_traseras']) ? $datos['llantas_traseras'] : null;
        $datos['cortes'] = isset($datos['cortes']) ? $datos['cortes'] : null;
        $datos['esparragos'] = isset($datos['esparragos']) ? $datos['esparragos'] : null;
        $datos['profundidad_huella'] = isset($datos['profundidad_huella']) ? $datos['profundidad_huella'] : null;
        $datos['llanta_repuesto'] = isset($datos['llanta_repuesto']) ? $datos['llanta_repuesto'] : null;
        $datos['presion_inflado'] = isset($datos['presion_inflado']) ? $datos['presion_inflado'] : null;
        $datos['abultamientos'] = isset($datos['abultamientos']) ? $datos['abultamientos'] : null;
        $datos['reloj_braza'] = isset($datos['reloj_braza']) ? $datos['reloj_braza'] : null;
        $datos['boca_llanta'] = isset($datos['boca_llanta']) ? $datos['boca_llanta'] : null;
        $datos['rines'] = isset($datos['rines']) ? $datos['rines'] : null;
        $datos['chalecoreflectivo'] = isset($datos['chalecoreflectivo']) ? $datos['chalecoreflectivo'] : null;
        $datos['linterna'] = isset($datos['linterna']) ? $datos['linterna'] : null;
        $datos['conos_triangulos'] = isset($datos['conos_triangulos']) ? $datos['conos_triangulos'] : null;
        $datos['tacos_bloques'] = isset($datos['tacos_bloques']) ? $datos['tacos_bloques'] : null;
        $datos['gato'] = isset($datos['gato']) ? $datos['gato'] : null;
        $datos['cruceta_copa'] = isset($datos['cruceta_copa']) ? $datos['cruceta_copa'] : null;
        $datos['alicate'] = isset($datos['alicate']) ? $datos['alicate'] : null;
        $datos['destornilladores'] = isset($datos['destornilladores']) ? $datos['destornilladores'] : null;
        $datos['llavesfijas'] = isset($datos['llavesfijas']) ? $datos['llavesfijas'] : null;
        $datos['botiquin'] = isset($datos['botiquin']) ? $datos['botiquin'] : null;
        $datos['llave_expansion'] = isset($datos['llave_expansion']) ? $datos['llave_expansion'] : null;
        $datos['extintor'] = isset($datos['extintor']) ? $datos['extintor'] : null;
        // $datos['kilometraje_total'] = isset($datos['kilometraje_total']) ? $datos['kilometraje_total'] : null;
        // $datos['observaciones'] = isset($datos['observaciones']) ? $datos['observaciones'] : null;

        //return $datos;

        /* ===================================================
           INSERT/UPDATE
        ===================================================*/
        # INSERT
        if ($datos['id'] == "") {
            if (is_array($alistamiento)) {
                # mensaje al usuario
                $retorno = "existe";
            } else {
                # INSERT
                $retorno = ModeloAlistamiento::mdlAgregarAlistamiento($datos);
            }
        }
        # UPDATE
        else {
            if (is_array($alistamiento) && $alistamiento['id'] != $datos['id']) {
                # mensaje al usuario
                $retorno = "existe";
            } else {
                # UPDATE
                $retorno = "update";
            }
        }

        return $retorno;
    }
}

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
