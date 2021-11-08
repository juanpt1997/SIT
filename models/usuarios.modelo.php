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
            $stmt = Conexion::conectar()->prepare("SELECT u.*, s.sucursal AS Sucursal
                                                    FROM l_usuarios u
                                                    INNER JOIN gh_sucursales s ON u.idSucursal = s.ids
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
                                            LEFT JOIN l_perfil_opcion po ON p.idPerfil = po.idPerfil
                                            LEFT JOIN l_opciones o ON po.idOpcion = o.idOpcion
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
        $stmt = Conexion::conectar()->prepare("SELECT p.idPerfil, p.perfil, p.estado,  p.activo  as activoPerfil, p.descripcion
                                                FROM l_perfiles p WHERE p.estado = 1");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       AGREGAR ROL
    ===================================================*/

    static public function mdlAgregarPerfil($datos)
    {
        $stmt = conexion::conectar()->prepare("INSERT INTO l_perfiles(perfil,descripcion,activo) VALUES(:perfil,:descripcion,:activo)");

        $stmt->bindParam(":perfil", $datos["Perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["Descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":activo",$datos["activo"], PDO::PARAM_INT);

        if($stmt->execute()){
            $retorno = "ok";;
        }else{
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }
    
    /* ===================================================
       MOSTRAR PERFIL 
    ===================================================*/

    static public function mdlDatosPerfil($idPerfil)
    {
        $stmt = conexion::conectar()->prepare("SELECT * FROM l_perfiles WHERE idPerfil = :idPerfil");


        $stmt->bindParam(":idPerfil", $idPerfil, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    
    /* ===================================================
       EDITAR ROL
    ===================================================*/
    
    static public function mdlEditarPerfil($datos)
    {
        $stmt = conexion::conectar()->prepare("UPDATE l_perfiles set perfil =:perfil, descripcion=:descripcion, activo=:activo WHERE idPerfil = :idPerfil");
        
        $stmt->bindParam(":idPerfil", $datos["idPerfil"], PDO::PARAM_INT);
        $stmt->bindParam(":perfil", $datos["Perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["Descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":activo",$datos["activo"], PDO::PARAM_INT);

        if($stmt->execute()){
            $retorno = "ok";;
        }else{
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;

    }

    /* ===================================================
       ACTUALIZAR ROL
    ===================================================*/

    static public function mdlActualizarPerfil($idPerfil,$valor, $campo)
    {
        $stmt = conexion::conectar()->prepare(" UPDATE l_perfiles SET {$campo} = :{$campo} WHERE idPerfil = :idPerfil");

        $stmt->bindParam(":idPerfil", $idPerfil, PDO::PARAM_INT);
        $stmt->bindParam(":{$campo}", $valor, PDO::PARAM_INT);

        if($stmt->execute()){
            $retorno = "ok";;
        }else{
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

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

    /* ===================================================
        PERMISOS DE USUARIO
    ===================================================*/
    static public function mdlPermisos($valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT u.UsuariosID, u.Cedula, u.Nombre, p.perfil, o.opcion, re.Crear, re.Leer, re.Actualizar, re.Borrar
                                                FROM l_usuarios u
                                                INNER JOIN l_perfiles p ON u.idPerfil = p.idPerfil
                                                INNER JOIN l_re_permisos re ON re.idPerfil = p.idPerfil
                                                INNER JOIN l_opciones o ON re.idOpcion = o.idOpcion
                                                WHERE u.Cedula = :valor");
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
        LISTADO OPCIONES
    ===================================================*/

    static public function mdlListadoOpciones()
    {
        $stmt = Conexion::conectar()->prepare("SELECT o.idOpcion, o.nombre FROM l_opciones o");
        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    /* ===================================================
       ELIMINA PERMISOS PERFIL
    ===================================================*/


    static public function mdlEliminarPermisosRol($idPerfil)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM l_re_permisos re WHERE idPerfil = :idPerfil");

        $stmt->bindParam(":idPerfil",$idPerfil,PDO::PARAM_INT);


        if ($stmt->execute()) {
            $retorno = "ok";
            echo $retorno;
        }else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
    }


    /* ===================================================
        AGREGA PERMISOS ROL
    ===================================================*/

    static public function mdlAgregarPermisosRol($datos)
    {
        
       $stmt = Conexion::conectar()->prepare("INSERT INTO l_re_permisos (idPerfil, idOpcion, Crear, Leer, Actualizar, Borrar) 
                                            VALUES(:idPerfil, :idOpcion, :Crear, :Leer, :Actualizar, :Borrar )");

        $stmt->bindParam(":idPerfil",$datos['idPerfil'],PDO::PARAM_INT);
        $stmt->bindParam(":idOpcion",$datos['idOpcion'],PDO::PARAM_INT);
        $stmt->bindParam(":Crear",$datos['Crear'],PDO::PARAM_INT);
        $stmt->bindParam(":Leer",$datos['Ver'],PDO::PARAM_INT);
        $stmt->bindParam(":Actualizar",$datos['Actualizar'],PDO::PARAM_INT);
        $stmt->bindParam(":Borrar",$datos['Borrar'],PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
            echo $retorno;
        }else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;

    }


    /*====================================================
        DATOS PERMISOS ROL 
    =====================================================*/

    static public function mdlDatosPermisosRol($idPerfil)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.* FROM l_re_permisos p
        INNER JOIN l_opciones o ON p.idOpcion = o.idOpcion
        WHERE idPerfil = $idPerfil");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

}