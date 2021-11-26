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
