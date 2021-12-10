<?php


/* ===================================================
   * CLIENTES
===================================================*/
class ControladorClientes
{
    static public function ctrVerCliente($tipo = "todos")
    {
        $respuesta = ModeloClientes::mdlVerCliente(null, $tipo);
        return $respuesta;
    }

    static public function ctrAgregarEditar()
    {




        if (isset($_POST['docum_empre'])) {

            $datosBusqueda = array(
                'item' => 'Documento',
                'valor' => $_POST['docum_empre']
            );

            $datos = array(
                'idcliente' => $_POST['idcliente'],
                't_document_empre' => $_POST['t_document_empre'],
                'nom_empre' => $_POST['nom_empre'],
                'docum_empre' => $_POST['docum_empre'],
                'telclient' => $_POST['telclient'],
                'telclient2' => $_POST['telclient2'],
                'dir_empre' => $_POST['dir_empre'],
                'ciudadcliente' => $_POST['ciudadcliente'],
                't_document_respo' => $_POST['t_document_respo'],
                'docum_respo' => $_POST['docum_respo'],
                'expedicion' => $_POST['expedicion'],
                'nom_respo' => $_POST['nom_respo'],
                'ciudadresponsable' => $_POST['ciudadresponsable'],
                'correo' => $_POST['correo'],
                'tipo' => "CLIENTE"
            );

            $ClienteExistente = ModeloClientes::mdlVerClienteid($datosBusqueda);


            if (is_array($ClienteExistente) && $ClienteExistente['idcliente'] != $_POST['idcliente']) {
                echo "
							<script>
								Swal.fire({
									icon: 'warning',
									title: '¡Cliente ya existe!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{

									if(result.value){
										window.location = 'contratos-clientes';
									}

								})
							</script>
						";
                return;
            } else {
                if ($_POST['idcliente'] == '') {

                    $responseModel = ModeloClientes::mdlAgregarCliente($datos);
                } else {
                    $responseModel = ModeloClientes::mdlEditarCliente($datos);
                }
            }

            if ($responseModel == "ok" || $responseModel != "error") {
                echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Cliente añadido correctamente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'contratos-clientes';
								}

							})
						</script>
					";
            } else {
                echo "
						<script>
							Swal.fire({
								icon: 'warning',
								title: '¡Problema al añadir el cliente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'contratos-clientes';
								}

							})
						</script>
					";
            }
        }
    }

    static public function ctrActualizarCampo($id)
    {
        $datos = array('id' => $id, 'tabla' =>  "cont_clientes", 'campo1' => "tipo", 'campo2' => "idcliente", 'valor' => "CLIENTE");

        $respuesta = ModeloClientes::mdlActualizarCampo($datos);

        return $respuesta;
    }

    /* ===================================================
       GUARDAR RUTA DEL CLIENTE
    ===================================================*/
    static public function ctrGuardarRutaCliente($formdata)
    {
        $sql = "rc.idcliente = {$formdata['idcliente']} AND rc.idruta = {$formdata['idruta']} AND rc.idtipovehiculo = {$formdata['idtipovehiculo']}";
        $RutaExistente = ModeloClientes::mdlDatosRutaCliente($sql);

        // Existe ruta
        if ($RutaExistente !== false) {
            // Vienen vacío el idrutacliente y existe una ruta así
            if ($formdata['idrutacliente'] == "") {
                $formdata['idrutacliente'] = $RutaExistente['idrutacliente'];
                $retorno = ModeloClientes::mdlEditarRutaCliente($formdata);
            }
            // Existe ruta y coincide con la que se está editando
            else if ($formdata['idrutacliente'] == $RutaExistente['idrutacliente']) {
                $retorno = ModeloClientes::mdlEditarRutaCliente($formdata); // Pero entonces actualizo
            }
            // Existe ruta pero no coincide con la que se está editando, por lo tanto hay que mostrar una alerta
            else {
                $retorno = "existe";
            }
        }
        // No existe ruta
        else {
            if ($formdata['idrutacliente'] == "") {
                // Insertar
                $retorno = ModeloClientes::mdlAgregarRutaCliente($formdata);
            } else {
                // Update
                $retorno = ModeloClientes::mdlEditarRutaCliente($formdata);
            }
        }

        if ($retorno != "existe" && !is_numeric($retorno)) {
            $retorno = "error";
        }

        return $retorno;
    }

    /* ===================================================
       TABLA RUTAS X CLIENTE
    ===================================================*/
    static public function ctrRutasxCliente($idcliente)
    {
        $respuesta = ModeloClientes::mdlRutasxCliente($idcliente);
        return $respuesta;
    }

    /* ===================================================
      DATOS DE UNA RUTA ASOCIADA A UN CLIENTE
   ===================================================*/
    static public function ctrDatosRutaCliente($idrutacliente)
    {
        $sql = "rc.idrutacliente = {$idrutacliente}";
        $respuesta = ModeloClientes::mdlDatosRutaCliente($sql);
        return $respuesta;
    }
}
/* ===================================================
   * COTIZACIONES
===================================================*/
class ControladorCotizaciones
{
    static public function ctrVerCotizacion()
    {
        $respuesta = ModeloCotizaciones::mdlVerCotizacion(null);
        return $respuesta;
    }

    /*------------------------------------------------------
----------CONTROLADOR AGREGAR/EDITAR Y AGREGAR CLIENTE--
------------------------------------------------------ */
    static public function ctrAgregarCotizacionCliente()
    {
        //SI el id de la cotizacion existe en post
        if (isset($_POST['id_cot'])) {
            //guarda la variable post en id
            $id = $_POST['listaclientes'];
            //se almacenan los datos del cliente
            $datosCliente = array(
                't_document_empre' => $_POST['t_document_empre'],
                'nom_empre' => $_POST['nom_contrata'],
                'docum_empre' => $_POST['document'],
                'telclient' => $_POST['tel1'],
                'telclient2' => $_POST['tel2'],
                'dir_empre' => $_POST['direcci'],
                'ciudadcliente' => $_POST['ciudadcliente'],
                't_document_respo' => $_POST['t_document_respo'],
                'docum_respo' => $_POST['docum_respo'],
                'expedicion' => $_POST['expedicion'],
                'nom_respo' => $_POST['nom_respo'],
                'ciudadresponsable' => $_POST['ciudadresponsable'],
                'tipo' => "LEAD"
            );
            //si el id es vacio
            if ($id == "") {

                $datosBusqueda = array('item' => 'Documento', 'valor' => $_POST['document']);
                $existecliente = ModeloClientes::mdlVerClienteid($datosBusqueda);
                # existe cliente 
                //var_dump($existecliente);
                if ($existecliente !== false) {

                    $respuestamodeloCliente = "existe";
                }
                # si no existe cliente
                else {

                    $respuestamodeloCliente = ModeloClientes::mdlAgregarCliente($datosCliente);
                }
            } else {
                //respuesta guarda el id en caso de que no sea vacio
                $respuestamodeloCliente = $id;
            }

            if ($respuestamodeloCliente == "error") {

                echo "
						<script>
							Swal.fire({
								icon: 'warning',
								title: '¡Error al agregar el cliente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'contratos-cotizaciones';
								}

							})
						</script>
					";
            } else {
                if ($respuestamodeloCliente == "existe") {
                    echo "
						<script>
							Swal.fire({
								icon: 'error',
								title: '¡Éste cliente ya existe, por favor seleccionelo!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'contratos-cotizaciones';
								}

							})
						</script>
					";
                } else {
                    //ver si la cotizacion contiene datos
                    $CotizacionExistente = ModeloCotizaciones::mdlVerCotizacion($_POST['id_cot']);

                    $datos = array(
                        'id_cot' => $_POST['id_cot'],
                        'id_cliente' => $respuestamodeloCliente,

                        'nom_contrata' => $_POST['nom_contrata'],
                        't_document_empre' => $_POST['t_document_empre'],
                        'document' => $_POST['document'],
                        'tel1' => $_POST['tel1'],
                        'tel2' => $_POST['tel2'],
                        'direcci' => $_POST['direcci'],
                        'ciudadcliente' => $_POST['ciudadcliente'],
                        't_document_respo' => $_POST['t_document_respo'],
                        'docum_respo' => $_POST['docum_respo'],
                        'expedicion' => $_POST['expedicion'],
                        'nom_respo' => $_POST['nom_respo'],
                        'ciudadresponsable' => $_POST['ciudadresponsable'],

                        'origin' => $_POST['origin'],
                        'f_sol' => $_POST['f_sol'],
                        'h_salida' => $_POST['h_salida'],
                        'h_recog' => $_POST['h_recog'],
                        'capaci' => $_POST['capaci'],
                        'cotiz' => $_POST['cotiz'],
                        'empres' => $_POST['empres'],
                        'destin' => $_POST['destin'],
                        'f_resuelve' => $_POST['f_resuelve'],
                        'durac' => $_POST['durac'],
                        'tipovehiculocot' => $_POST['tipovehiculocot'],
                        'valor_vel' => $_POST['valor_vel'],
                        'clasi_cot' => $_POST['clasi_cot'],
                        'sucursalcot' => $_POST['sucursalcot'],
                        'descrip' => $_POST['descrip'],
                        'f_inicio' => $_POST['f_inicio'],
                        'f_fin' => $_POST['f_fin'],
                        'n_vehiculos' => $_POST['n_vehiculos'],
                        'vtotal' => $_POST['vtotal'],
                        'music' => $_POST['music'],
                        'bodeg' => $_POST['bodeg'],
                        'another' => $_POST['another'],
                        'air' => $_POST['air'],
                        'baño' => $_POST['baño'],
                        'realizav' => $_POST['realizav'],
                        'wi_fi' => $_POST['wi_fi'],
                        'silleteriar' => $_POST['silleteriar'],
                        'porque' => $_POST['porque'],
                        'otro_v' => $_POST['otro_v'],
                        'idruta' => $_POST['idruta'] == "" ? null : $_POST['idruta'],
                        'viaje_ocasional' => $_POST['viaje_ocasional']
                    );

                    if ($_POST['id_cot'] != "" && is_array($CotizacionExistente)) {

                        $responseModel = ModeloCotizaciones::mdlEditarCotizacion($datos);

                        if ($responseModel == "ok") {

                            echo "
                         <script>
                         Swal.fire({
                            icon: 'success',
                            title: 'Cotización actualizada correctamente!',						
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            
                         }).then((result)=>{
                            
                            if(result.value){
                               window.location = 'contratos-cotizaciones';
                            }
                            
                         })
                         </script>
                         ";
                        } else {
                            echo "
                         <script>
                         Swal.fire({
                            icon: 'warning',
                            title: '¡Problema al actualizar la cotización!',						
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            
                         }).then((result)=>{
                            
                            if(result.value){
                               window.location = 'contratos-cotizaciones';
                            }
                            
                         })
                         </script>
                         ";
                        }
                    } else {
                        $responseModel = ModeloCotizaciones::mdlAgregarCotizacion($datos);
                        if ($responseModel == "ok") {

                            echo "
                         <script>
                         Swal.fire({
                            icon: 'success',
                            title: 'Cotización añadida correctamente!',						
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            
                         }).then((result)=>{
                            
                            if(result.value){
                               window.location = 'contratos-cotizaciones';
                            }
                            
                         })
                         </script>
                         ";
                        } else {
                            echo "
                         <script>
                         Swal.fire({
                            icon: 'warning',
                            title: '¡Problema al añadir la cotización!',						
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            
                         }).then((result)=>{
                            
                            if(result.value){
                               window.location = 'contratos-cotizaciones';
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
}
/* ===================================================
   * FIJOS
===================================================*/
class ControladorFijos
{
    static public function ctrVerFijos()
    {
        $respuesta = ModeloFijos::mdlVerFijos(null);
        return $respuesta;
    }

    static public function ctrAgregarEditarFijos()
    {
        if (isset($_POST['idconfijo'])) {
            //$FijosExistente = ModeloFijos::mdlVerFijos($_POST['idconfijo']);

            $num_contrato = $_POST['num_contrato'] == "" ? null : $_POST['num_contrato'];
            $datos = array(
                'idfijos' => $_POST['idconfijo'],
                'idcliente' => $_POST['nom_clien'],
                'numcontrato' => $num_contrato,
                'fecha_inicial' => $_POST['f_inicial_fijos'],
                'fecha_final' => $_POST['f_final_fijos'],
                //'documento_escaneado' => $_POST['documento_es'],
                'observaciones' => $_POST['observaciones_fijos']
            );

            # INSERT
            if ($_POST['idconfijo'] == "" /* is_array($FijosExistente) */) {
                $respuestamodelo = ModeloFijos::mdlAgregarFijo($datos);
                $datos['idfijos'] = $respuestamodelo;
            }

            /* ===================================================
                GUARDAR ARCHIVO EN EL SERVIDOR
            ===================================================*/
            if (is_array($_FILES['documento_es'])) {
                $directorioRaiz = "views/docs/contratosFijos";
                //mkdir($directorio, 0755);
                if (!is_dir($directorioRaiz)) {
                    mkdir($directorioRaiz, 0755);
                }

                $directorio = "views/docs/contratosFijos/" . $datos['idfijos'];
                //mkdir($directorio, 0755);
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0755);
                }


                $GuardarArchivo = new FilesController();
                $GuardarArchivo->file = $_FILES['documento_es'];
                $aleatorio = mt_rand(100, 999);
                $GuardarArchivo->ruta = "views/docs/contratosFijos/" . $datos['idfijos'] . "/" . $aleatorio;
                //$ruta = $GuardarArchivo->ctrImages(500, 500);
                # Si es pdf
                if ($_FILES['documento_es']['type'] == "application/pdf") {
                    $ruta = $GuardarArchivo->ctrPDFFiles();
                } else {
                    # Si es una imagen
                    if (($_FILES['documento_es']['type'] == "image/jpeg" || $_FILES['documento_es']['type'] == "image/png")) {
                        $ruta = $GuardarArchivo->ctrImages(null, null);
                    }
                }
            }


            if (isset($ruta) && $ruta != "") {
                $rutaImg = str_replace("./views", "/views", $ruta);
            } else {
                $rutaImg = null;
            }
            $datos["documento_escaneado"] = $rutaImg;

            # UPDATE
            $respuestamodelo = ModeloFijos::mdlEditarFijos($datos);

            if ($respuestamodelo == "ok") {
                $msjExito = "ok";
            } else {
                $msjExito = "error";
            }

            if ($msjExito == "ok") {
                echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: 'Contrato fijo añadido correctamente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'contratos-fijos';
								}

							})
						</script>
					";
            } else {
                echo "
						<script>
							Swal.fire({
								icon: 'warning',
								title: '¡Problema al añadir el contrato fijo!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'contratos-fijos';
								}

							})
						</script>
					";
            }
        }
    }
}
/* ===================================================
   * ORDEN DE SERVICIO
===================================================*/
class ControladorOrdenServicio
{
    static public function ctrVerListaOrden()
    {
        $respuesta = ModeloOrdenServicio::mdlVerListaOrden();
        return $respuesta;
    }

    static public function ctrAgregarEditarOrden()
    {
        if (isset($_POST['idorden'])) {

            $datos = array(
                'idorden' => $_POST['idorden'],
                'idcotizacion' => $_POST['listacotizaciones'],
                'nro_contrato' => $_POST['numcontrato'],
                'nro_factura' => $_POST['numfacturaorden'],
                'fecha_facturacion' => $_POST['f_facturacion'],
                'cancelada' => $_POST['cancelacion'],
                'cod_autoriz' => $_POST['cod_autorizacion']
                //'viaje_ocasional' => $_POST['viaje_ocasional']
            );

            if ($_POST['idorden'] == '') {

                $respuesta = ModeloOrdenServicio::mdlAgregarOrden($datos);
            } else {

                $respuesta = ModeloOrdenServicio::mdlEditarOrden($datos);
            }
            if ($respuesta == 'ok') {

                //Si el modelo responde ok se actualiza el campo del tipo de la tabla cliente
                // se pone tipo 'Cliente' desde la orden de servicio

                $cotizacion = ModeloCotizaciones::mdlVerCotizacion($_POST['listacotizaciones']);
                if ($cotizacion !== false) {
                    ControladorClientes::ctrActualizarCampo($cotizacion['idcliente']);
                }
                echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Orden de servicio añadida!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
							}).then((result)=>{
								if(result.value){
									window.location = 'contratos-ordenservicio';
								}
							})
						</script>
					";
            } else {
                echo "
            <script>
               Swal.fire({
                  icon: 'error',
                  title: '¡Ocurrió un problema!',						
                  showConfirmButton: true,
                  confirmButtonText: 'Cerrar',
               }).then((result)=>{
                  if(result.value){
                     window.location = 'contratos-ordenservicio';
                  }
               })
            </script>
         ";
            }
        }
    }
}
