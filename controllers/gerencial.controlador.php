<?php
/* ===================================================
   * GERENCIAL
===================================================*/
class ControladorGerencial
{
    /* ===================================================
       GESTION HUMANA - INGRESOS PERSONAL
    ===================================================*/
    static public function ctrIngresosPersonal()
    {

        $respuestaModelo = ModeloGerencial::mdlIngresosPersonal();
        $respuestaArray = array();

        foreach ($respuestaModelo as $key => $value) {
            $respuestaArray[] = array(
                "mes" => self::mesNombre($value['mes']),
                "anio" => $value['year'],
                "Cantidad" => $value['Cantidad']
            );
        }

        return $respuestaArray;
    }

    /* ===================================================
        VEHICULAR - TIPOS VEHICULOS
    ===================================================*/
    static public function ctrTiposVehiculos()
    {

        $respuestaArray = ModeloGerencial::mdlTiposVehiculos();

        return $respuestaArray;
    }

    /* ===================================================
        VIAJES OCASIONALES (por mes)
    ===================================================*/
    static public function ctrViajesOcasionales()
    {

        $respuestaModelo = ModeloGerencial::mdlViajesOcasionales();

        $respuestaArray = array();

        foreach ($respuestaModelo as $key => $value) {
            $respuestaArray[] = array(
                "mes" => self::mesNombre($value['mes']),
                "anio" => $value['year'],
                "Cantidad" => $value['Cantidad']
            );
        }

        return $respuestaArray;
    }

    /* ===================================================
        TIPOS CONTRATO (OCASIONAL O FIJO)
    ===================================================*/
    static public function ctrTiposContrato()
    {

        $respuestaArray = ModeloGerencial::mdlTiposContrato();

        return $respuestaArray;
    }

    /* ===================== 
        BUSCAR EL MES Y RETORNARLO EN TEXTO 
    ========================= */
    static public function mesNombre($mes)
    {

        $meses = [
            1   =>  "Enero",
            2   =>  "Febrero",
            3   =>  "Marzo",
            4   =>  "Abril",
            5   =>  "Mayo",
            6   =>  "Junio",
            7   =>  "Julio",
            8   => "Agosto",
            9   => "Septiembre",
            10  => "Octubre",
            11  => "Noviembre",
            12  => "Diciembre"
        ];

        foreach ($meses as $key => $value) {
            if ($key == $mes) {
                return $value;
            }
        }
    }
}
