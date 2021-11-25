<?php 

class ControladorAlmacen
{
    //Metodo para validar un inventario existente con un producto y una sucursal
    static public function ctrValidarInventario($datos)
    {

        $inventarioExistente = ModeloProductos::mdlValidarInventario($datos);
        
        if(is_array($inventarioExistente)){
            
            $nuevoStock = $inventarioExistente['stock'] + $datos['cantidad'];
            $datos['idinventario'] = $inventarioExistente['idinventario'];
            $datos['tipo_movimiento'] = 'ENTRADA';

            $datos2 = array(
                'idinventario' => $inventarioExistente['idinventario'],
                'stock' =>  $nuevoStock
            );

            ModeloProductos::mdlEditarInventario($datos2);
            ModeloProductos::mdlAgregarMovimiento($datos);
            
            return 'editado';

        }else {
            $idinventario = ModeloProductos::mdlAgregarInventario($datos);
            $datos['idinventario'] = $idinventario;
            $datos['tipo_movimiento'] = 'ENTRADA';
            ModeloProductos::mdlAgregarMovimiento($datos);

            return 'agregado';
        }
    }
}