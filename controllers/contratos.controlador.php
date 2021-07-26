<?php


/* ===================================================
   * CLIENTES
===================================================*/

class ControladorClientes
{
   static public function ctrVerCliente()
   {
      $respuesta = ModeloClientes::mdlVerCliente(null);
      return $respuesta;
   }

   static public function ctrAgregarEditar()
   {
      if (isset($_POST['docum_empre'])) {

         $ClienteExistente = ModeloClientes::mdlVerCliente($_POST['docum_empre']);

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
            'tipo' => "CLIENTE"
         );

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
}

class ControladorCotizaciones
{
   static public function ctrVerCotizacion()
   {
      $respuesta = ModeloCotizaciones::mdlVerCotizacion(null);
      return $respuesta;
   }

   static public function ctrAgregarEditarCot()
   {
      if (isset($_POST['document'])) {

         $CotizacionExistente = ModeloCotizaciones::mdlVerCotizacion($_POST['document']);

         $datos = array(
            'id_cot' => $_POST['id_cot'],
            'nom_contrata' => $_POST['nom_contrata'],
            'document' => $_POST['document'],
            'direcci' => $_POST['direcci'],
            'nom_contact' => $_POST['nom_contact'],
            'origin' => $_POST['origin'],
            'f_sol' => $_POST['f_sol'],
            'h_salida' => $_POST['h_salida'],
            'h_recog' => $_POST['h_recog'],
            'capaci' => $_POST['capaci'],
            'cotiz' => $_POST['cotiz'],
            'tel1' => $_POST['tel1'],
            'empres' => $_POST['empres'],
            'destin' => $_POST['destin'],
            'f_resuelve' => $_POST['f_resuelve'],
            'durac' => $_POST['durac'],
            'tipovehiculocot' => $_POST['tipovehiculocot'],
            'valor_vel' => $_POST['valor_vel'],
            'clasi_cot' => $_POST['clasi_cot'],
            'tel2' => $_POST['tel2'],
            'sucursalcot' => $_POST['sucursalcot'],
            'des_sol' => $_POST['des_sol'],
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
            'porque' => $_POST['porque']
         );

         if (is_array($CotizacionExistente)) {

            $responseModel = ModeloCotizaciones::mdlEditarCotizacion($datos);
         } else {
            $responseModel = ModeloCotizaciones::mdlAgregarCotizacion($datos);
         }

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
            $existecliente = ModeloClientes::mdlVerCliente($datosBusqueda);
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
                  // 'nom_contrata' => $_POST['nom_contrata'],
                  // 'document' => $_POST['document'],
                  // 'direcci' => $_POST['direcci'],
                  // 'nom_contact' => $_POST['nom_contact'],
                  'origin' => $_POST['origin'],
                  'f_sol' => $_POST['f_sol'],
                  'h_salida' => $_POST['h_salida'],
                  'h_recog' => $_POST['h_recog'],
                  'capaci' => $_POST['capaci'],
                  'cotiz' => $_POST['cotiz'],
                  //'tel1' => $_POST['tel1'],
                  'empres' => $_POST['empres'],
                  'destin' => $_POST['destin'],
                  'f_resuelve' => $_POST['f_resuelve'],
                  'durac' => $_POST['durac'],
                  'tipovehiculocot' => $_POST['tipovehiculocot'],
                  'valor_vel' => $_POST['valor_vel'],
                  'clasi_cot' => $_POST['clasi_cot'],
                  //'tel2' => $_POST['tel2'],
                  'sucursalcot' => $_POST['sucursalcot'],
                  'des_sol' => $_POST['des_sol'],
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
                  'porque' => $_POST['porque']
               );

               if ($_POST['id_cot'] != "" && is_array($CotizacionExistente)) {

                  $responseModel = ModeloCotizaciones::mdlEditarCotizacion($datos);
               } else {
                  $responseModel = ModeloCotizaciones::mdlAgregarCotizacion($datos);
               }

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
