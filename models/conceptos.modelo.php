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

    static public function mdlNuevo($datos)
    {
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

    static public function mdlVer($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT {$datos['item']}, {$datos['id']} FROM {$datos['tabla']} WHERE estado = 1");

        $stmt->execute();
        $respuesta =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    static public function mdlEditar($datos)
    {
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

    static public function mdlVerUnConcepto($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT {$datos['item']} FROM {$datos['tabla']} WHERE {$datos['id']} = :{$datos['id']}");

        $stmt->bindParam(":" . $datos['id'], $datos["id"], PDO::PARAM_INT);

        $stmt->execute();
        $respuesta =  $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    static public function mdlContarRegistros($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT COUNT({$datos['item']}) AS contador FROM {$datos['tabla']} WHERE estado = 1");

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

    static public function mdlListaEmpresa()
    {
        $sql = "SELECT * FROM empresa";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlUnaEmpresa($id)
    {
        $sql = "SELECT E.* FROM empresa E WHERE E.id = :id";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id",  $id, PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    #PROGRAMA LIMITADO A UNA EMPRESA, POR LO TANTO NO SE HABILITARA LA OPCION DE AGREGAR UNA EMPRESA NUEVA(POR EL MOMENTO)
    static public function mdlAgregarEmpresa($datos)
    {
        $sql = "INSERT empresa(razon_social,nit,nro_resolucion,anio_resolucion,dir_territorial,ruta_firma,sitio_web) VALUES(:razon_social,:nit,:nro_resolucion,:anio_resolucion,:dir_territorial,:ruta_firma,:sitio_web)";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nro_resolucion", $datos["nro_resolucion"], PDO::PARAM_STR);
        $stmt->bindParam(":anio_resolucion", $datos["anio_resolucion"], PDO::PARAM_STR);
        $stmt->bindParam(":dir_territorial", $datos["dir_territorial"], PDO::PARAM_INT);
        $stmt->bindParam(":ruta_firma", $datos["ruta_firma"], PDO::PARAM_STR);
        $stmt->bindParam(":sitio_web", $datos["sitio_web"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }

    static public function mdlEditarEmpresa($datos)
    {
         $sql = "UPDATE empresa set razon_social=:razon_social, nit=:nit, nro_resolucion=:nro_resolucion, anio_resolucion=:anio_resolucion, dir_territorial=:dir_territorial, ruta_firma=:ruta_firma, sitio_web=:sitio_web WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
        $stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
        $stmt->bindParam(":nro_resolucion", $datos["nro_resolucion"], PDO::PARAM_STR);
        $stmt->bindParam(":anio_resolucion", $datos["anio_resolucion"], PDO::PARAM_STR);
        $stmt->bindParam(":dir_territorial", $datos["dir_territorial"], PDO::PARAM_INT);
        $stmt->bindParam(":ruta_firma", $datos["ruta_firma"], PDO::PARAM_STR);
        $stmt->bindParam(":sitio_web", $datos["sitio_web"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    # VEHICULAR 
    static public function mdlAgregarVehicular($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO {$datos['tabla']} ({$datos['item1']},{$datos['item2']}) 
                                         VALUES (:{$datos['item1']},:{$datos['item2']})");

        $stmt->bindParam(":" . $datos['item1'], $datos['valor1'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $datos['item2'], $datos['valor2'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $respuesta = "ok";
        } else {
            $respuesta = "error";
        }
        $stmt->closeCursor();
        $conexion = null;
        return $respuesta;
    }

    static public function mdlEditarVehicular($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE {$datos['tabla']} SET {$datos['item1']} = :{$datos['item1']}, {$datos['item2']} = :{$datos['item2']}
                                    WHERE {$datos['idtabla']} = :{$datos['id']}");

        $stmt->bindParam(":" . $datos['item1'], $datos['valor1'], PDO::PARAM_STR);
        $stmt->bindParam(":" . $datos['item2'], $datos['valor2'], PDO::PARAM_STR);
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

    static public function mdlListarVehicular($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT {$datos['item1']}, {$datos['item2']}, {$datos['id']} FROM {$datos['tabla']} WHERE estado = 1");

        $stmt->execute();
        $respuesta =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    static public function mdlListarUnConcepto($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT {$datos['item1']}, {$datos['item2']} FROM {$datos['tabla']} WHERE {$datos['id']} = :{$datos['id']}");

        $stmt->bindParam(":" . $datos['id'], $datos["id"], PDO::PARAM_INT);

        $stmt->execute();
        $respuesta =  $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }
    //RUTAS
    static public function mdlAgregarRuta($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO v_rutas(idorigen,iddestino,nombreruta)
                                                VALUES(:origen,:destino,:ruta)");

        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
        $stmt->bindParam(":origen", $datos["origen"], PDO::PARAM_STR);
        $stmt->bindParam(":destino", $datos["destino"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "errorr";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarRuta($datos)
    {
        //print_r($datos);

        $stmt = Conexion::conectar()->prepare("UPDATE v_rutas set nombreruta = :ruta     WHERE id = :idruta");

        $stmt->bindParam(":idruta", $datos["idruta"], PDO::PARAM_INT);
        $stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
   

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlListarRutas()
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT id, nombreruta, idorigen, iddestino,o.municipio AS orig ,d.municipio AS dest  FROM v_rutas  JOIN gh_municipios AS o ON o.idmunicipio=v_rutas.idorigen  JOIN gh_municipios AS d ON d.idmunicipio=v_rutas.iddestino  WHERE v_rutas.estado = 1");

        $stmt->execute();
        $respuesta =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $respuesta;
    }

    //CIUDADES
    static public function mdlAgregarCiudad($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO gh_municipios(iddepartamento,municipio)
                                                VALUES(:iddepartamento,:municipio)");

        $stmt->bindParam(":iddepartamento", $datos["iddepartamento"], PDO::PARAM_INT);
        $stmt->bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlEditarCiudad($datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE gh_municipios set iddepartamento = :iddepartamento, municipio=:municipio
                                               WHERE idmunicipio = :idmunicipio");

        $stmt->bindParam(":idmunicipio", $datos["idmunicipio"], PDO::PARAM_INT);
        $stmt->bindParam(":iddepartamento", $datos["iddepartamento"], PDO::PARAM_INT);
        $stmt->bindParam(":municipio", $datos["municipio"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlVerciudad($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("SELECT iddepartamento, municipio FROM gh_municipios
                                    WHERE idmunicipio = :idmunicipio");

        $stmt->bindParam(":idmunicipio", $datos["id"], PDO::PARAM_INT);

        $stmt->execute();
        $respuesta =  $stmt->fetch();
        $stmt->closeCursor();
        return $respuesta;
    }

    static public function mdlDeparMunicipios()
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.idmunicipio, m.municipio, m.iddepartamento AS iddepar, d.nombre AS departamento, CONCAT(d.nombre, ' - ', m.municipio) AS DeparMunic
                                                FROM gh_municipios m
                                                INNER JOIN gh_departamentos d ON m.iddepartamento = d.iddepartamento
                                                ORDER BY d.nombre, m.municipio");

        $stmt->execute();
        $retorno = $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEliminar($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("UPDATE {$datos['tabla']} SET estado = 0
            WHERE {$datos['id_tabla']} = :{$datos['id']}");

        //$stmt->bindParam(":" . $datos['item'], $datos['valor'], PDO::PARAM_INT);
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


}
