<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

/* ===================================================
   * GERENCIAL
===================================================*/
class ModeloGerencial
{
    /* ===================================================
        GESTION HUMANA - INGRESOS PERSONAL
    ===================================================*/
    static public function mdlIngresosPersonal()
    {
        $sql = "SELECT COUNT(DISTINCT(p.idPersonal)) AS Cantidad, MONTH(p.fecha_ingreso) AS mes, YEAR(p.fecha_ingreso) AS `year`
                FROM gh_personal p
                WHERE YEAR(p.fecha_ingreso) = YEAR(NOW())
                GROUP BY YEAR(p.fecha_ingreso), MONTH(p.fecha_ingreso);";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();

        $retorno = $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    /* ===================================================
        VEHICULAR - TIPOS VEHICULOS
    ===================================================*/
    static public function mdlTiposVehiculos()
    {
        $sql = "SELECT COUNT(v.idvehiculo) AS Cantidad, t.tipovehiculo
                FROM v_vehiculos v
                LEFT JOIN v_tipovehiculos t ON t.idtipovehiculo = v.idtipovehiculo
                WHERE v.activo != 'Desvinculado'
                GROUP BY t.idtipovehiculo;";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();

        $retorno = $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
}
