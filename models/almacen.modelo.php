<?php
//INCLUIMOS LA CONFIGURACIÓN Y LA CONEXION PARA EL FUNCIONAMIENTO DEL PROYECTO
include_once DIR_APP . 'config/conexion.php';

class ModeloProductos
{

    static public function mdlAgregarProducto($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO a_productos (codigo,referencia,descripcion,idcategoria,idmarca,idmedida) VALUES (:codigo,:referencia,:descripcion,:idcategoria,:idmarca,:idmedida)");
        $stmt->bindParam(":codigo", $datos["cod_producto"], PDO::PARAM_STR);
        $stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion_prod"], PDO::PARAM_STR);
        $stmt->bindParam(":idcategoria", $datos["categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":idmarca", $datos["marca"], PDO::PARAM_INT);
        $stmt->bindParam(":idmedida", $datos["medida"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        return $id;
    }

    static public function mdlEditarProducto($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE a_productos set codigo=:codigo, referencia=:referencia, descripcion=:descripcion, idcategoria=:idcategoria,
                                                      idmarca=:idmarca, idmedida=:idmedida
                                               WHERE idproducto = :idproducto");

        $stmt->bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":referencia", $datos["referencia"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":idcategoria", $datos["idcategoria"], PDO::PARAM_INT);
        $stmt->bindParam(":idmarca", $datos["idmarca"], PDO::PARAM_INT);
        $stmt->bindParam(":idmedida", $datos["idmedida"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlListarProductos($idproducto)
    {
        if ($idproducto != null) {

            $stmt = Conexion::conectar()->prepare("SELECT p.*, c.categoria AS categoria, ma.marca AS marca, me.medida AS medida FROM a_productos p
            INNER JOIN a_categorias c ON p.idcategoria = c.idcategorias
            INNER JOIN a_marcas ma ON p.idmarca = ma.idmarca
            INNER JOIN a_medidas me ON p.idmedida = me.idmedidas
            WHERE p.idproducto = :idproducto");

            $stmt->bindParam(":idproducto",  $idproducto, PDO::PARAM_INT);
            $stmt->execute();
            $retorno =  $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT p.*, c.categoria AS categoria, ma.marca AS marca, me.medida AS medida FROM a_productos p
            INNER JOIN a_categorias c ON p.idcategoria = c.idcategorias
            INNER JOIN a_marcas ma ON p.idmarca = ma.idmarca
            INNER JOIN a_medidas me ON p.idmedida = me.idmedidas");

            $stmt->execute();
            $retorno =  $stmt->fetchAll();
        }

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlDatosProducto($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.*, c.categoria AS categoria, ma.marca AS marca, me.medida AS medida FROM a_productos p
        INNER JOIN a_categorias c ON p.idcategoria = c.idcategorias
        INNER JOIN a_marcas ma ON p.idmarca = ma.idmarca
        INNER JOIN a_medidas me ON p.idmedida = me.idmedidas
        WHERE p.{$datos['item']} = :{$datos['item']}");

        $stmt->bindParam(":{$datos['item']}", $datos['valor']);
        $stmt->execute();
        $retorno =  $stmt->fetch();

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregarInventario($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO a_re_inventario (idproducto,idsucursal,stock) VALUES (:idproducto,:idsucursal,:stock)");
        $stmt->bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":idsucursal", $datos["idsucursal"], PDO::PARAM_INT);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $id = $conexion->lastInsertId();
        } else {
            $id = "error";
        }
        $stmt->closeCursor();
        $stmt = null;
        return $id;
    }

    static public function mdlAgregarMovimiento($datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO a_re_movimientoinven(idinventario,cantidad,tipo_movimiento,preciocompra,idproveedor,facturacompra)
                                                VALUES(:idinventario,:cantidad,:tipo_movimiento,:preciocompra,:idproveedor,:facturacompra)");

        $stmt->bindParam(":idinventario", $datos["idinventario"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_movimiento", $datos["tipo_movimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":preciocompra", $datos["preciocompra"], PDO::PARAM_INT);
        $stmt->bindParam(":idproveedor", $datos["idproveedor"], PDO::PARAM_INT);
        $stmt->bindParam(":facturacompra", $datos["facturacompra"], PDO::PARAM_STR);

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
