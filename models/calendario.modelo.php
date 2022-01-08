<?php
//INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

class ModeloCalendario
{
    static public function mdlAlmacenarEvento($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO calendario_eventos (titulo,fecha_i,fecha_f,color,descripcion,usuario,estado_tarea) VALUES (:titulo,:fecha_i,:fecha_f,:color,:descripcion,:usuario,:estado_tarea)");
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_i", $datos["fecha_i"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_f", $datos["fecha_f"], PDO::PARAM_STR);
        $stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_tarea", $datos["estado_tarea"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        return $id;
    }

    static public function mdlDatosEventos($id_evento)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, titulo as title, fecha_i as start, fecha_f as end, descripcion, color, estado_tarea FROM calendario_eventos WHERE id = :id");

        $stmt->bindParam(":id",  $id_evento, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlCargarCalendario($usuario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, titulo as title, fecha_i as start, fecha_f as end, descripcion, color FROM calendario_eventos WHERE usuario = :usuario AND estado = 1");

        $stmt->bindParam(":usuario",  $usuario, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarEvento($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE calendario_eventos set titulo=:titulo, fecha_i=:fecha_i, fecha_f=:fecha_f, descripcion=:descripcion
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_i", $datos["start"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_f", $datos["end"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlCambiarEstadoTarea($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE calendario_eventos set estado_tarea=:estado_tarea, color=:color
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":estado_tarea", $datos["estado_tarea"], PDO::PARAM_STR);
        $stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlListarTareasPorEstado($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT id, titulo, fecha_i, fecha_f, descripcion FROM calendario_eventos WHERE usuario = :usuario AND estado = 1 AND estado_tarea = :estado_tarea");

        $stmt->bindParam(":usuario",  $datos['usuario'], PDO::PARAM_INT);
        $stmt->bindParam(":estado_tarea",  $datos['estado_tarea'], PDO::PARAM_STR);
        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }
}
