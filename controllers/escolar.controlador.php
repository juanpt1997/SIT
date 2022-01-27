<?php 

class ControladorEscolar
{
    /* ===================================================
        LISTA DE INSTITUCIONES
    ===================================================*/
    static public function ctrListaInstituciones()
    {
        $respuesta = ModeloEscolar::mdlListaInstituciones();
        return $respuesta;
    }

    /* ===================================================
        GUARDAR EDITAR RUTA
    ===================================================*/
    static public function ctrGuardarEditarRuta($datos)
    {
        if(isset($datos['idruta'])){
            if($datos['idruta'] == ""){
                $respuesta = ModeloEscolar::mdlGuardarRuta($datos);
                return $respuesta;
            }else{
                $respuesta = ModeloEscolar::mdlEditarRuta($datos);
                return $respuesta;
            }
        }
    }

    /* ===================================================
        GUARDAR ESTUDIANTE 
    ===================================================*/
    static public function ctrGuardarEstudiante($datos)
    {
        if(isset($datos['documentoEstudiante'])){

            //Verificar si el estudiante existe 
            $existe = ModeloEscolar::mdlEstudiantexDocumento($datos['documentoEstudiante']);
            

            if($existe != false){
                return "existe";
            }else{
                $respuesta = ModeloEscolar::mdlGuardarEstudiante($datos);
                return $respuesta;
            }
            
        }
    }


    /* ===================================================
        ASOCIAR ESTUDIANTE A RUTA 
    ===================================================*/
    static public function ctrAsociarEstudianteRuta($datos)
    {
        if(isset($datos['idpasajero'])){
            $existe = ModeloEscolar::mdlEstudiantexId($datos['idpasajero']);
            $ruta = ModeloEscolar::mdlRutaxId($datos['idruta']);
            $cantidad = ModeloEscolar::mdlEstudiantesxRuta($datos['idruta']);
            // var_dump($cantidad);


            //Valida que el estudiante exista 
            if($existe != false){
                
                //Valida si la ruta está ordenada
                if($ruta['ordenado'] == 0 && count($cantidad) < 1 )
                {
                    //Actualizar campo ordenado en la ruta 
                    $respuesta = ModeloEscolar:: mdlActualizarOrdenadoRuta($datos['idruta']);
                    //Al ser el primer estudiante el orden es 100 (Primero)
                    $datos['orden'] = 100; 
                }else{
                   
                    foreach ($cantidad as $key => $value) {
                        if($value['idpasajero'] == $datos['estudianteOrden']){
                            if($cantidad[$key + 1] != null ){

                                $datos['orden'] = ($value['orden'] + $cantidad[$key + 1]['orden'])  / 2;
                                // var_dump($value['orden'], " + ", ($cantidad[$key + 1]['orden'] / 2));
                                // var_dump($datos);
                            }else{
                                $datos['orden'] = $value['orden'] + 100;
                            }
                            
                        }else if($datos['estudianteOrden'] == 0){
                            $datos['orden'] = ($cantidad[0]['orden'] / 2 );
                        }
                    }
                }
                
                
                
                //Asociamos estudiante a ruta
                $respuesta = ModeloEscolar::mdlAsociarEstudianteRuta($datos);

                var_dump($datos);
                return $respuesta;
            }else{
                return "no existe";
            }
        }
    }

    /* ===================================================
        GUARDAR RECORRIDO
    ===================================================*/
    static public function ctrGuardarRecorrido($datos)
    {


        $datos2 = array(
            "idruta" => $datos['idruta_aux'],
            "fecha" => date("Y/m/d"), 
            "auxiliar" => $datos['nom_auxiliar'],
            "observaciones" => $datos['observaciones_auxiliar']
        );

        $respuesta = ModeloEscolar::mdlGuardarRecorrido($datos2);
        return $respuesta;
    }

}