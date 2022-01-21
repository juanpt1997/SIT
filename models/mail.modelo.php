<?php
//INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

class ModeloCorreos
{
    static public function mdlDatosCorreos($valor)
    {
        if ($valor != null) {
            $stmt = Conexion::conectar()->prepare("SELECT C.*, u.nombre AS usuarioCrea
                                                    FROM correos_difusion C
                                                    LEFT JOIN l_usuarios u ON u.Cedula = C.user_created
                                                    WHERE C.idcorreo = :idcorreo AND C.estado = 1 ");

            $stmt->bindParam(":idcorreo",  $valor, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT C.*, u.nombre AS usuarioCrea FROM correos_difusion C
                                                    LEFT JOIN l_usuarios u ON u.Cedula = C.user_created WHERE C.estado = 1");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregarCorreo($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO correos_difusion(correo,modulo,user_created,user_updated)
                                                VALUES(:correo,:modulo,:user_created,:user_updated)");

        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":modulo", $datos["modulo"], PDO::PARAM_STR);
        $stmt->bindParam(":user_created", $datos["usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos["usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarCorreo($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE correos_difusion set correo=:correo,user_updated=:user_updated
		                                        WHERE idcorreo = :idcorreo");
        $stmt->bindParam(":idcorreo", $datos["idcorreo"], PDO::PARAM_INT);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":user_updated", $datos["usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }

    static public function mdlListarCorreos($modulo)
    {
        $stmt = Conexion::conectar()->prepare("SELECT C.*, u.nombre AS usuarioCrea FROM correos_difusion C
                                                    LEFT JOIN l_usuarios u ON u.Cedula = C.user_created WHERE C.estado = 1 AND C.modulo = :modulo");

        $stmt->bindParam(":modulo",  $modulo, PDO::PARAM_STR);
        
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEliminarCorreo($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE correos_difusion set user_updated=:user_updated, estado = 0
		                                        WHERE idcorreo = :idcorreo");
                                                
        $stmt->bindParam(":idcorreo", $datos['idcorreo'], PDO::PARAM_INT);
        $stmt->bindParam(":user_updated", $datos['usuario'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        return $retorno;

    }
}
