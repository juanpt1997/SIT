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
