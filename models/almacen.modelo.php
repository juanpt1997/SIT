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
        $retorno =  $stmt->fetchAll();

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlAgregarInventario($datos)
    {
        $conexion = Conexion::conectar();
        $stmt = $conexion->prepare("INSERT INTO a_re_inventario (idproducto,idsucursal,posicion,stock) VALUES (:idproducto,:idsucursal,:posicion,:stock)");
        $stmt->bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":idsucursal", $datos["sucursal"], PDO::PARAM_INT);
        $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["cantidad"], PDO::PARAM_INT);

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
        $stmt = Conexion::conectar()->prepare("INSERT INTO a_re_movimientoinven(idinventario,cantidad,tipo_movimiento,preciocompra,idproveedor,facturacompra,observaciones)
                                                VALUES(:idinventario,:cantidad,:tipo_movimiento,:preciocompra,:idproveedor,:facturacompra,:observaciones)");

        $stmt->bindParam(":idinventario", $datos["idinventario"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_movimiento", $datos["tipo_movimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":preciocompra", $datos["precio-compra-producto"], PDO::PARAM_INT);
        $stmt->bindParam(":idproveedor", $datos["proveedor"], PDO::PARAM_INT);
        $stmt->bindParam(":facturacompra", $datos["num_factura"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlValidarInventario($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT i.* FROM a_re_inventario i
                                               WHERE i.idproducto = :idproducto AND i.idsucursal = :idsucursal
                                              ");

        $stmt->bindParam(":idproducto", $datos['idproducto'], PDO::PARAM_INT);
        $stmt->bindParam(":idsucursal", $datos['sucursal'], PDO::PARAM_INT);
        $stmt->execute();
        $retorno =  $stmt->fetch();

        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarInventario($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE a_re_inventario set stock=:stock, posicion=:posicion
                                               WHERE idinventario = :idinventario");

        $stmt->bindParam(":idinventario", $datos["idinventario"], PDO::PARAM_INT);
        $stmt->bindParam(":posicion", $datos["posicion"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;

        return $retorno;
    }

    static public function mdlListarInventario()
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.*, c.categoria, ma.marca, me.medida, SUM(i.stock) AS stock, i.posicion FROM a_re_inventario i
        INNER JOIN a_productos p ON p.idproducto = i.idproducto
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        LEFT JOIN a_categorias c ON c.idcategorias = p.idcategoria
        LEFT JOIN a_marcas ma ON ma.idmarca = p.idmarca
        LEFT JOIN a_medidas me ON me.idmedidas = p.idmedida
        GROUP BY p.idproducto");

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlSucursalesInventario($idproducto)
    {
        $stmt = Conexion::conectar()->prepare("SELECT p.*, i.stock, i.posicion, i.idinventario, s.sucursal FROM a_productos p
        INNER JOIN a_re_inventario i ON i.idproducto = p.idproducto
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        WHERE p.idproducto = :idproducto");

        $stmt->bindParam(":idproducto", $idproducto, PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlHistorialMovimientos($idproducto)
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.*, s.sucursal, pro.razon_social, p.idproducto FROM a_re_movimientoinven m
        INNER JOIN a_re_inventario i ON i.idinventario = m.idinventario
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        LEFT JOIN c_proveedores pro ON pro.id = m.idproveedor
        INNER JOIN a_productos p ON p.idproducto = i.idproducto
        WHERE p.idproducto = :idproducto ORDER BY m.fecha DESC");

        $stmt->bindParam(":idproducto", $idproducto, PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetchAll();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlPosicionCantidad($datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT i.posicion, i.stock, s.sucursal, p.descripcion, p.codigo
        FROM a_re_inventario i
        INNER JOIN a_productos p ON p.idproducto = i.idproducto
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        WHERE i.idproducto = :idproducto AND i.idsucursal = :idsucursal");

        $stmt->bindParam(":idproducto", $datos["idproducto"], PDO::PARAM_INT);
        $stmt->bindParam(":idsucursal", $datos["idsucursal"], PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlDatosMovimiento($idmovimiento)
    {
        $stmt = Conexion::conectar()->prepare("SELECT m.*, CONCAT(pro.razon_social,' - ', pro.documento) AS proveedor
        FROM a_re_movimientoinven m
        LEFT JOIN c_proveedores pro ON pro.id = m.idproveedor
        WHERE m.idmovimiento =  :idmovimiento");

        $stmt->bindParam(":idmovimiento", $idmovimiento, PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }

    static public function mdlEditarMovimiento($datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE a_re_movimientoinven set idproveedor=:idproveedor, facturacompra=:facturacompra, preciocompra=:preciocompra, observaciones=:observaciones
                                               WHERE idmovimiento = :idmovimiento");

        $stmt->bindParam(":idmovimiento", $datos["idmovimiento"], PDO::PARAM_INT);
        $stmt->bindParam(":preciocompra", $datos["preciocompra"], PDO::PARAM_INT);
        $stmt->bindParam(":idproveedor", $datos["proveedorMovimiento"], PDO::PARAM_INT);
        $stmt->bindParam(":facturacompra", $datos["facturacompra"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            $retorno = "ok";
        } else {
            $retorno = "error";
        }

        $stmt->closeCursor();
        $stmt = null;
        return $retorno;
    }

    static public function mdlDatosInventario($idinventario)
    {
        $stmt = Conexion::conectar()->prepare("SELECT i.posicion, i.stock, p.referencia, p.descripcion, s.sucursal FROM a_re_inventario i
        INNER JOIN a_productos p ON p.idproducto = i.idproducto
        INNER JOIN gh_sucursales s ON s.ids = i.idsucursal
        WHERE i.idinventario = :idinventario");

        $stmt->bindParam(":idinventario", $idinventario, PDO::PARAM_INT);

        $stmt->execute();
        $retorno =  $stmt->fetch();
        $stmt->closeCursor();
        return $retorno;
    }
}
