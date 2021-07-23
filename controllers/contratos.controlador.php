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
            'dir_empre' => $_POST['dir_empre'],
            'ciudadcliente' => $_POST['ciudadcliente'],
            't_document_respo' => $_POST['t_document_respo'],
            'docum_respo' => $_POST['docum_respo'],
            'expedicion' => $_POST['expedicion'],
            'nom_respo' => $_POST['nom_respo'],
            'ciudadresponsable' => $_POST['ciudadresponsable'],
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

         if ($responseModel == "ok") {
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
            'porque' => $_POST['porque'],
         );

         if (is_array($CotizacionExistente) && $CotizacionExistente['idcotizacion'] != $_POST['id_cot']) {
            echo "
							<script>
								Swal.fire({
									icon: 'warning',
									title: '¡Cotización ya existe!',						
									showConfirmButton: true,
									confirmButtonText: 'Cerrar',
									
								}).then((result)=>{

									if(result.value){
										window.location = 'contratos-cotizaciones';
									}

								})
							</script>
						";
            return;
         } else {
            if ($_POST['id_cot'] == '') {
               $responseModel = ModeloCotizaciones::mdlAgregarCotizacion($datos);
            } else {
               $responseModel = ModeloCotizaciones::mdlEditarCotizacion($datos);
            }
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
