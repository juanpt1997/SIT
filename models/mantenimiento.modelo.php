<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';


/* ===================================================
   * PROTOCOLO DE ALISTAMIENTO
===================================================*/
class ModeloAlistamiento
{
    /* ===================================================
       LISTA DE EVIDENCIAS
    ===================================================*/
    static public function mdlListaEvidencias($idvehiculo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM m_re_alistamientoevidencias e
                                                INNER JOIN v_vehiculos v ON e.idvehiculo = v.idvehiculo
                                                WHERE v.idvehiculo = :idvehiculo
                                                ORDER BY e.estado ASC, e.fecha DESC");
        
        $stmt->bindParam(":idvehiculo", $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }
}
