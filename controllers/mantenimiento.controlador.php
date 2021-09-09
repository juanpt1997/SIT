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

            //$proveedorexistente = ModeloProveedores::mdlListarProveedores($_POST['cc_proveedor']);

            $datos = array(
                'nit' => $_POST['cc_proveedor'],
                'nombre' => $_POST['nom_razonsocial'],
                'dir' => $_POST['direccion_proveedor'],
                'tel' => $_POST['telef_proveedor'],
                'cont' => $_POST['contacto_proveedor'],
                'correo' => $_POST['correo_proveedor'],
                'ciudad' => $_POST['ciudad_proveedor']
            );

            if ($_POST['cc_proveedor'] == '') {

                $responseModel = ModeloProveedores::mdlAgregarProveedor($datos);

                if ($responseModel == "ok") {
                    echo "
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Proveedor agregado correctamente!',						
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
                                        icon: 'success',
                                        title: '¡Problema al crear el proveedor!',						
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
                                        title: '¡Proveedor actualizado correctamente!',						
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
                                        icon: 'success',
                                        title: '¡Problema al editar el proveedor!',						
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
