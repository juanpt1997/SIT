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
                'stock' =>  $nuevoStock,
                'posicion' => $datos['posicion']
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

    static public function ctrModificarInventario($datos)
    {
        $inventarioExistente = ModeloProductos::mdlDatosInventario($datos['idinventario']);

        if($datos['stock'] < $inventarioExistente['stock'])
        {
            $datos['tipo_movimiento'] = 'SALIDA';
            $datos['cantidad'] = abs( $datos['stock'] - $inventarioExistente['stock']);

            ModeloProductos::mdlAgregarMovimiento($datos);

        } else if($datos['stock'] > $inventarioExistente['stock']){

            $datos['tipo_movimiento'] = 'ENTRADA';
            $datos['cantidad'] = abs( $datos['stock'] - $inventarioExistente['stock']);

            ModeloProductos::mdlAgregarMovimiento($datos);

        } else {

        }

        $respuesta = ModeloProductos::mdlEditarInventario($datos);
        return $respuesta;
    }
}