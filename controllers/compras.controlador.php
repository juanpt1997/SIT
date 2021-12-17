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
				'ciudad' => $_POST['ciudad_proveedor'],
				'tipo' => $_POST['tipoProveedor']
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
										window.location = 'c-proveedores';
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
                                            window.location = 'c-proveedores';
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
                                            window.location = 'c-proveedores';
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
                                            window.location = 'c-proveedores';
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
                                            window.location = 'c-proveedores';
                                        }
        
                                    })
                                </script>
                            ";
					}
				}
			}
		}
	}

	static public function ctrListarTipoProveedor()
	{
		$datos = array(
			'id' => 'id',
			'item' => 'tipo',
			'tabla' => 'c_tipo_proveedor'
		);

		$respuesta = ModeloConceptosGH::mdlVer($datos);
		return $respuesta;
	}
}
