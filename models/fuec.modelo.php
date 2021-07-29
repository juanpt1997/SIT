<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';


/* ===================================================
   * FUEC
===================================================*/
class ModeloFuec
{
    /* ===================================================
       DOCUMENTOS VENCIDOS DEL VEHICULO, esta consulta en realidad trae todos los documentos que puede tener un vehiculo (sin repetir) sin importar si está vencido o no
    ===================================================*/
    static public function mdlDocumentosVencidos($idvehiculo)
    {
        // $sql = "SELECT t.tipodocumento, IF(MAX(d.fechafin) >= CURDATE(), MAX(d.fechafin), NULL) AS fechafin FROM v_tipodocumento t
        //                                         LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
        //                                         WHERE d.idvehiculo = :idvehiculo OR d.idvehiculo IS NULL
        //                                         GROUP BY t.idtipo";
        $sql = "SELECT t.tipodocumento, IF(MAX(d.fechafin) >= CURDATE(), MAX(d.fechafin), NULL) AS fechafin
                FROM v_tipodocumento t
                LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                WHERE d.idvehiculo = :idvehiculo
                GROUP BY t.idtipo
                UNION ALL
                SELECT t.tipodocumento, NULL AS fechafin
                FROM v_tipodocumento t
                LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                WHERE t.tipodocumento NOT IN (
                                            SELECT t.tipodocumento
                                            FROM v_tipodocumento t
                                            LEFT JOIN v_re_documentosvehiculos d ON t.idtipo = d.idtipodocumento
                                            WHERE d.idvehiculo = :idvehiculo
                                            GROUP BY t.idtipo)
                GROUP BY t.idtipo;";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":idvehiculo",  $idvehiculo, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       VERIFICAR PAGO SEGURIDAD SOCIAL DEL CONDUCTOR
    ===================================================*/
    static public function mdlConductorPagoSS($idpersonal)
    {
        $sql = "SELECT * FROM gh_fechas_segursoc f
                    INNER JOIN gh_re_personalsegursoc s ON s.idFechas = f.idFechas
                    WHERE CURDATE() BETWEEN f.fechaini AND f.fechafin AND idPersonal = :idpersonal";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":idpersonal",  $idpersonal, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }
}
