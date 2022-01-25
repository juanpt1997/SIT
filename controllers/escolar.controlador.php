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
            }
        }
    }
}