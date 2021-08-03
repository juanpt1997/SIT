<?php 

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

/**
 *  GESTION HUMANA
 */
class ModeloConceptosGH
{
	# DATOS GENERALIZADOS
	static public function mdlActualizarGH($tabla, $input1)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $input1 = :$input1");

        $stmt->bindParam(":" . $input1, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
    }

    static public function mdlNuevo($datos){
    	$conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO {$datos['tabla']} ({$datos['item']}) 
            VALUES (:{$datos['item']})");


        $stmt->bindParam(":" . $datos['item'], $datos['valor'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    static public function mdlVer($datos){
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT {$datos['item']}, {$datos['id']} FROM {$datos['tabla']}");
        
        $stmt->execute();
        $respuesta =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta; 
    }

    static public function mdlEditar($datos){
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE {$datos['tabla']} SET {$datos['item']} = :{$datos['item']}
            WHERE {$datos['idtabla']} = :{$datos['id']}");

        $stmt->bindParam(":" . $datos['item'], $datos['valor'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $datos['id'], $datos["id"], PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlVerUnConcepto($datos){
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT {$datos['item']} FROM {$datos['tabla']} WHERE {$datos['id']} = :{$datos['id']}");

        $stmt->bindParam(":" . $datos['id'], $datos["id"], PDO::PARAM_INT);
        
        $stmt->execute();
        $respuesta =  $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta; 
    }

    static public function mdlContarRegistros($datos){
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT COUNT({$datos['item']}) AS contador FROM {$datos['tabla']}");

        $stmt->execute();
        $respuesta =  $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }


    # EMPRESA
    static public function mdlVerEmpresa()
    {
        $sql = "SELECT * FROM empresa LIMIT 1";
        $stmt = Conexion::conectar()->prepare($sql);
        
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }





}







?>