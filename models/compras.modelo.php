<?php

//INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';


class ModeloProveedores
{
    static public function mdlListarProveedores($value)
    {
        if ($value != null) {

            $stmt = Conexion::conectar()->prepare("SELECT pro.*, m.municipio AS ciudad
                                                   FROM c_proveedores pro
                                                   INNER JOIN gh_municipios m ON pro.idciudad = m.idmunicipio
                                                   WHERE pro.documento = :documento");

            $stmt->bindParam(":documento",  $value, PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT pro.*, m.municipio AS ciudad
                                                   FROM c_proveedores pro
                                                   INNER JOIN gh_municipios m ON pro.idciudad = m.idmunicipio
                                                   WHERE pro.estado = 1");
            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregarProveedor($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO c_proveedores(documento,nombre_contacto,razon_social,direccion,correo,telefono,idciudad)
                                                VALUES(:documento,:nombre_contacto,:razon_social,:direccion,:correo,:telefono,:idciudad)");

        $stmt->bindParam(":documento", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_contacto", $datos["cont"], PDO::PARAM_STR);
        $stmt->bindParam(":razon_social", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["tel"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudad"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarProveedor($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE c_proveedores set documento=:documento, nombre_contacto=:nombre_contacto, razon_social=:razon_social, direccion=:direccion,
                                                      correo=:correo, telefono=:telefono ,idciudad=:idciudad
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":documento", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_contacto", $datos["cont"], PDO::PARAM_STR);
        $stmt->bindParam(":razon_social", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dir"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["tel"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudad"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEliminarProveedor($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE c_proveedores set estado = 0
                                               WHERE id = :id");

        $stmt->bindParam(":id", $datos[""], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlDatosproveedor($value)
    {
        $stmt = Conexion::conectar()->prepare("SELECT pro.*, m.municipio AS ciudad
                                                   FROM c_proveedores pro
                                                   INNER JOIN gh_municipios m ON pro.idciudad = m.idmunicipio
                                                   WHERE pro.id = :id");

        $stmt->bindParam(":id",  $value, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }
}
