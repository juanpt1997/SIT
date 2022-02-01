<?php
date_default_timezone_set('America/Bogota');

class ControladorEscolar
{
    /* ===================================================
        LISTA DE INSTITUCIONES
    ===================================================*/
    static public function ctrListaInstituciones()
    {
        $respuesta = ModeloEscolar::mdlListaInstituciones();
        return $respuesta;
    }

    /* ===================================================
        GUARDAR EDITAR RUTA
    ===================================================*/
    static public function ctrGuardarEditarRuta($datos)
    {
        if (isset($datos['idruta'])) {
            if ($datos['idruta'] == "") {
                $datos['user_created'] = $_SESSION['cedula'];
                $datos['user_updated'] = $_SESSION['cedula'];
                $respuesta = ModeloEscolar::mdlGuardarRuta($datos);
                return $respuesta;
            } else {
                $datos['user_updated'] = $_SESSION['cedula'];
                $respuesta = ModeloEscolar::mdlEditarRuta($datos);
                return $respuesta;
            }
        }
    }

    /* ===================================================
        GUARDAR ESTUDIANTE 
    ===================================================*/
    static public function ctrGuardarEstudiante($datos)
    {
        if (isset($datos['documentoEstudiante'])) {

            //Verificar si el estudiante existe 
            $existe = ModeloEscolar::mdlEstudiantexDocumento($datos['documentoEstudiante']);


            if ($existe != false) {
                return "existe";
            } else {
                $respuesta = ModeloEscolar::mdlGuardarEstudiante($datos);
                return $respuesta;
            }
        }
    }


    /* ===================================================
        ASOCIAR ESTUDIANTE A RUTA 
    ===================================================*/
    static public function ctrAsociarEstudianteRuta($datos)
    {
        if (isset($datos['idpasajero'])) {
            //Trae el estudiante, para validar si existe
            $existe = ModeloEscolar::mdlEstudiantexId($datos['idpasajero']);
            //Trae información de la ruta
            $ruta = ModeloEscolar::mdlRutaxId($datos['idruta']);
            //Trae los estudiantes que están en esa ruta
            $cantidad = ModeloEscolar::mdlEstudiantesxRuta($datos['idruta']);



            //Valida que el estudiante exista 
            if ($existe != false) {

                //Valida si la ruta está ordenada
                if ($ruta['ordenado'] == 0 && count($cantidad) < 1) {
                    //Actualizar campo ordenado en la ruta 
                    $respuesta = ModeloEscolar::mdlActualizarOrdenadoRuta($datos['idruta']);
                    //Al ser el primer estudiante el orden es 100 (Primero)
                    $datos['orden'] = 100;
                } else {

                    foreach ($cantidad as $key => $value) {
                        //Se toma el orden del estudiante que seleccionaron en después de  
                        if ($value['idpasajero'] == $datos['estudianteOrden']) {
                            if ($cantidad[$key + 1] != null) {

                                $datos['orden'] = ($value['orden'] + $cantidad[$key + 1]['orden'])  / 2;
                            } else {
                                //Si van a poner el estudiante de último, se toma el orden del último estudiante y se le suman 100
                                $datos['orden'] = $value['orden'] + 100;
                            }
                        } else if ($datos['estudianteOrden'] == 0) {
                            //Si desean establecer como primero tomamos el orden del primer estudiante y lo dividimos entre 2
                            $datos['orden'] = ($cantidad[0]['orden'] / 2);
                        }
                    }
                }



                //Asociamos estudiante a ruta
                $respuesta = ModeloEscolar::mdlAsociarEstudianteRuta($datos);

                var_dump($datos);
                return $respuesta;
            } else {
                return "no existe";
            }
        }
    }

    /* ===================================================
        GUARDAR RECORRIDO
    ===================================================*/
    static public function ctrGuardarRecorrido($datos)
    {

        $datos2 = array(
            "idruta" => $datos['idruta_aux'],
            "fecha" => date("Y/m/d"),
            "auxiliar" => $datos['nom_auxiliar'],
            "observaciones" => $datos['observaciones_auxiliar'],
            "auxiliar2" => $datos['nom_auxiliar2'],
            "observaciones2" => $datos['observaciones_auxiliar2'],
        );

        
        //Ver si existe un recorrido para ese día y esa ruta
        $existe = ModeloEscolar::mdlRecorridoxFechaxRuta($datos2['idruta'], $datos2['fecha']);
        
        if ($existe != false) {
            //Actualizar recorrido 
            $datos2 = array(
                "idruta" => $datos['idruta_aux'],
                "fecha" => date("Y/m/d"),
                "auxiliar" => $datos['nom_auxiliar'],
                "observaciones" => $datos['observaciones_auxiliar'],
                "auxiliar2" => $datos['nom_auxiliar2'],
                "observaciones2" => $datos['observaciones_auxiliar2'],
                "user_updated" => $_SESSION['cedula']
            );
            
            $respuesta = ModeloEscolar::mdlEditarRecorrido($datos2);
            return $respuesta;
        } else {
            //Agrega el nuevo recorrido
            $datos2 = array(
                "idruta" => $datos['idruta_aux'],
                "fecha" => date("Y/m/d"),
                "auxiliar" => $datos['nom_auxiliar'],
                "observaciones" => $datos['observaciones_auxiliar'],
                "auxiliar2" => $datos['nom_auxiliar2'],
                "observaciones2" => $datos['observaciones_auxiliar2'],
                "user_updated" => $_SESSION['cedula'],
                "user_created" => $_SESSION['cedula']
            );
            $respuesta = ModeloEscolar::mdlGuardarRecorrido($datos2);
            return $respuesta;
        }
    }

    /* ===================================================
        GUARDAR SEGUIMIENTO RECOGE 
    ===================================================*/
    static public function ctrGuardarSeguimientoRecoge($idrecorrido, $idpasajero)
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y/m/d");
        $hora = date("h:i:s");


        //Verificar si el pasajero tiene un seguimiento, es decir si ya lo recogieron en otra ruta  
        $existe = ModeloEscolar::mdlSeguimientoxPasajeroxFecha($idpasajero, $fecha);



        if ($existe == false) {

            $datos = array(
                "idpasajero" => $idpasajero,
                "idrecorrido" => $idrecorrido,
                "fecha" => $fecha,
                "hora" => $hora,
                "user_created" => $_SESSION['cedula']
            );

            $respuesta = ModeloEscolar::mdlGuardarSeguimientoRecoge($datos);
            if ($respuesta == "ok") {
                return $hora;
            } else {

                return $respuesta;
            }
        } else {
            return "ya lo recogieron";
        }
    }

    /* ===================================================
        GUARDAR SEGUIMIENTO ENTREGA 
    ===================================================*/
    static public function ctrGuardarSeguimientoEntrega($idrecorrido, $idpasajero)
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y/m/d");
        $hora = date("h:i:s");

        //Verificar si el pasajero tiene un seguimiento, es decir si ya lo recogieron en otra ruta  
        $existe = ModeloEscolar::mdlSeguimientoxPasajeroxFecha($idpasajero, $fecha);

        //Si lo entregan pero no lo llevó ninguna ruta 
        if ($existe == false) {
            $datos = array(
                "idpasajero" => $idpasajero,
                "idrecorrido" => $idrecorrido,
                "fecha" => $fecha,
                "hora" => $hora,
                "user_created" => $_SESSION['cedula']
            );

            $respuesta = ModeloEscolar::mdlGuardarSeguimientoEntrega($datos);
            if ($respuesta == "ok") {
                return $hora;
            } else {

                return $respuesta;
            }
            //SI LO RECOGIÓ UNA RUTA Y LO VA ENTREGAR OTRA RUTA
        } else if ($existe['idrecorrido_recogida'] != "" && $existe['idrecorrido_entrega'] == "") {


            $datos = array(
                "idpasajero" => $idpasajero,
                "idrecorrido" => $idrecorrido,
                "fecha" => $fecha,
                "hora" => $hora,
                "idseguimiento" => $existe['idseguimiento'],
                "user_updated" => $_SESSION['cedula']

            );

            $respuesta = ModeloEscolar::mdlInsertarEntrega($datos);
            if ($respuesta == "ok") {
                return $hora;
            } else {

                return $respuesta;
            }
        } else {
            return "ya lo entregaron";
        }
    }

    /* ===================================================
        ASOCIAR ESTUDIANTE TEMPORAL A RUTA
    ===================================================*/
    static public function ctrAsociarEstudianteTemporalRuta($datos)
    {
        $respuesta = ModeloEscolar::mdlAsociarEstudianteTemporalRuta($datos);
        return $respuesta;
    }

    /* ===================================================
        ELIMINAR SEGUIMIENTO PASAJERO
    ===================================================*/
    // static public function ctrEliminarSeguimientoEstudiante($datos)
    // {
    //     $datos['fecha'] = $fecha = date("Y/m/d");

    //     if($datos['momento'] == "entrega")
    //     {
    //         $respuesta = ModeloEscolar::mdlEliminarSeguimientoEntrega($datos);
    //         return $respuesta;
    //     }else{
    //         $respuesta = ModeloEscolar::mdlEliminarSeguimientoRecoge($datos);
    //         return $respuesta;
    //     }
    // }
}
