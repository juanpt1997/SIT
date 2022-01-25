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
            // var_dump($existe);

            if($existe != false){
                return "existe";
            }else{
                $respuesta = ModeloEscolar::mdlGuardarEstudiante($datos);
                return $respuesta;
            }
            
        }
    }
}