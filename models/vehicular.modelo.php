<?php  	

// INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';


/**
 * 
 */
class ModeloPropietarios
{
	/*===========================
        MOSTRAR PROPIETARIO
    ============================*/
	static public function mdlMostrar($value){

		// Traer todos los propietarios
		if ($value != null){

			$stmt = Conexion::conectar()->prepare("SELECT P.*, M.municipio AS ciudad FROM propietario P
												   LEFT JOIN gh_municipios M ON P.idciudad = M.idmunicipio
												   WHERE P.documento = :cedula");

			$stmt->bindParam(":cedula",  $value, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();

		} else {

			$stmt = Conexion::conectar()->prepare("SELECT P.*, M.municipio AS ciudad FROM propietario P
									   			   LEFT JOIN gh_municipios M ON P.idciudad = M.idmunicipio
									   			   WHERE P.estado = 1");
			$stmt->execute();
            $retorno =  $stmt->fetchAll();
		}

        $stmt->closeCursor();
        return $retorno;
	}

	/*===========================
        AGREGAR PROPIETARIO
    ============================*/
	static public function mdlAgregar($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO propietario(tipodoc,documento,nombre,telef,direccion,email,idciudad)
                                                VALUES(:tipodoc,:documento,:nombre,:telef,:direccion,:email,:idciudad)");

        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipodoc", $datos["tdocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telef", $datos["telpro"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirpro"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["emailp"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadpro"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
        }

	/*===========================
        EDITAR PROPIETARIO
    ============================*/
	static public function mdlEditar($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE propietario set tipodoc=:tipodoc,nombre=:nombre,telef=:telef,direccion=:direccion,
                                                      email=:email,idciudad=:idciudad
											   WHERE documento = :documento");

        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipodoc", $datos["tdocumento"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":telef", $datos["telpro"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirpro"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["emailp"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadpro"], PDO::PARAM_INT);

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

class ModeloConvenios
{
    static public function mdlMostrar($value){

        if($value != null){

            $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad FROM convenios C
                                                   LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio
                                                   WHERE C.nit = :nit");

            $stmt->bindParam(":nit",  $value, PDO::PARAM_STR);
            $stmt->execute();
            $retorno =  $stmt->fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT C.*, M.municipio AS ciudad FROM convenios C
                                                   LEFT JOIN gh_municipios M ON C.idciudad = M.idmunicipio");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregar($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO convenios(nit,nombre,direccion,telefono1,telefono2,idciudad)
                                               VALUES(:nit,:nombre,:direccion,:telefono1,:telefono2,:idciudad)");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono1", $datos["telco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telco2"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcon"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        
        return $retorno;
    }

    static public function mdlEditar($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE convenios set nit=:nit,nombre=:nombre,direccion=:direccion,
                                                      telefono1=:telefono1,telefono2=:telefono2,idciudad=:idciudad
                                               WHERE nit = :nit");

        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["dirco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono1", $datos["telco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono2", $datos["telco2"], PDO::PARAM_STR);
        $stmt->bindParam(":idciudad", $datos["ciudadcon"], PDO::PARAM_INT);

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


class ModeloVehiculos
{
    static public function mdlMostrarTipoVehiculo(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM v_tipovehiculos");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlMostrarMarca(){

        $stmt = Conexion::conectar()->prepare("SELECT *
                                                FROM v_marcas");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;


    }
    
}




















?>