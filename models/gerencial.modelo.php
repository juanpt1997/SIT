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

    /* ===================================================
        VIAJES OCASIONALES (por mes)
    ===================================================*/
    static public function mdlViajesOcasionales()
    {
        $sql = "SELECT COUNT(DISTINCT(o.idorden)) AS Cantidad, MONTH(c.fecha_inicio) AS mes, YEAR(c.fecha_inicio) AS `year`
                FROM cont_ordenservicio o
                INNER JOIN cont_cotizaciones c ON c.idcotizacion = o.idcotizacion
                WHERE YEAR(c.fecha_inicio) = YEAR(NOW())
                GROUP BY YEAR(c.fecha_inicio), MONTH(c.fecha_inicio);";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();

        $retorno = $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
    
    /* ===================================================
        TIPOS CONTRATO (OCASIONAL O FIJO)
    ===================================================*/
    static public function mdlTiposContrato()
    {
        $sql = "SELECT 'OCASIONAL' AS tipo, COUNT(f.idfuec) AS Cantidad FROM fuec f
                WHERE f.tipocontrato = 'OCASIONAL'
                UNION
                SELECT 'FIJO' AS tipo, COUNT(f.idfuec) AS Cantidad FROM fuec f
                WHERE f.tipocontrato = 'FIJO'";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();

        $retorno = $stmt->fetchAll();

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
}
