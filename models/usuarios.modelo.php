<?php

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

class ModeloUsuarios
{
    /* ===================================================
       MOSTRAR USUARIOS
    ===================================================*/
    static public function mdlMostrarUsuarios($value)
    {
        if ($value != null) {

            // $stmt = Conexion::conectar_sit()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt = Conexion::conectar()->prepare("SELECT u.*, s.ciudad AS Sucursal
                                                    FROM l_usuarios u
                                                    INNER JOIN sucursales s ON u.idSucursal = s.ids
                                                    WHERE u.Cedula = :cedula");

            $stmt->bindParam(":cedula",  $value, PDO::PARAM_INT);

            $stmt->execute();

            $retorno =  $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT u.*, p.perfil
                                                    FROM l_usuarios u
                                                    inner join l_perfiles p on u.idPerfil = p.idPerfil");

            $stmt->execute();

            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================== 
      PERFIL Y OPCIONES USUARIO 
    ========================= */
    static public function mdlMostrarPerfilOpcion($item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT u.UsuariosID, u.Cedula, u.Nombre, p.perfil, o.opcion
                                            FROM l_usuarios u
                                            INNER JOIN l_perfiles p ON u.idPerfil = p.idPerfil
                                            INNER JOIN l_perfil_opcion po ON p.idPerfil = po.idPerfil
                                            INNER JOIN l_opciones o ON po.idOpcion = o.idOpcion
                                            WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       PERFILES DISPONIBLES
    ===================================================*/
    static public function mdlListadoPerfiles()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM l_perfiles");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       SUCURSALES
    ===================================================*/
    static public function mdlSucursales()
    {
        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM sucursales");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       AGREGAR USUARIO
    ===================================================*/
    static public function mdlAgregarUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO l_usuarios(Cedula,Nombre,Email,idPerfil,idSucursal, Password) 
			                                    VALUES(:Cedula,:Nombre,:Email,:idPerfil,:idSucursal, :Password)");

        $stmt->bindParam(":Cedula", $datos["Identificacion"], PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $datos["Nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":Email", $datos["Email"], PDO::PARAM_STR);
        $stmt->bindParam(":idPerfil", $datos["Perfil"], PDO::PARAM_INT);
        $stmt->bindParam(":idSucursal", $datos["Sucursal"], PDO::PARAM_INT);
        $stmt->bindParam(":Password", $datos["Password"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
    }

    /* ===================================================
       EDITAR USUARIO
    ===================================================*/
    static public function mdlEditarUsuario($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE l_usuarios set Nombre = :Nombre, Email = :Email, idPerfil = :idPerfil, idSucursal = :idSucursal
                                            WHERE Cedula = :Cedula");

        $stmt->bindParam(":Cedula", $datos["Identificacion"], PDO::PARAM_INT);
        $stmt->bindParam(":Nombre", $datos["Nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":Email", $datos["Email"], PDO::PARAM_STR);
        $stmt->bindParam(":idPerfil", $datos["Perfil"], PDO::PARAM_INT);
        $stmt->bindParam(":idSucursal", $datos["Sucursal"], PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
    }

    /* ===================== 
      ZAR USUARIO 
	========================= */
    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

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