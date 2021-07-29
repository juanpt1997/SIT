<?php

/* ===================================================
   * FUEC
===================================================*/
class ControladorFuec
{
    /* ===================================================
        DOCUMENTOS VENCIDOS DEL VEHICULO, esta consulta en realidad trae todos los documentos que puede tener un vehiculo (sin repetir) sin importar si está vencido o no
    ===================================================*/
    static public function ctrDocumentosVencidos($idvehiculo)
    {
        $respuesta = ModeloFuec::mdlDocumentosVencidos($idvehiculo);
        return $respuesta;
    }

    /* ===================================================
       VERIFICAR PAGO SEGURIDAD SOCIAL DEL CONDUCTOR
    ===================================================*/
    static public function ctrConductorPagoSS($idpersonal)
    {
        $respuesta = ModeloFuec::mdlConductorPagoSS($idpersonal);
        return $respuesta;
    }

}
