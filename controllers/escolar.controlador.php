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
            "user_updated" => $_SESSION['cedula']
        );

        if ($datos2['auxiliar'] == 0 || $datos2['auxiliar'] == "") $datos2['auxiliar'] == null;
        if ($datos2['auxiliar2'] == 0 || $datos2['auxiliar2'] == "") $datos2['auxiliar2'] == null;

        $datos2['auxiliar'] = $datos2['auxiliar'] == "" ? null : $datos2['auxiliar'];
        $datos2['auxiliar2'] = $datos2['auxiliar2'] == "" ? null : $datos2['auxiliar2'];



        //Ver si existe un recorrido para ese día y esa ruta
        $existe = ModeloEscolar::mdlRecorridoxFechaxRuta($datos2['idruta'], $datos2['fecha']);


        if ($existe != false) {
            //Actualizar recorrido 
            $respuesta = ModeloEscolar::mdlEditarRecorrido($datos2);

            if ($respuesta == "ok") {
                $respuesta = $existe['idrecorrido'];
            }

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

            $datos2['auxiliar'] = $datos2['auxiliar'] == "" ? null : $datos2['auxiliar'];
            $datos2['auxiliar2'] = $datos2['auxiliar2'] == "" ? null : $datos2['auxiliar2'];


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



        $pasajero = ModeloEscolar::mdlEstudiantexId($idpasajero);





        //Verificar si el pasajero tiene un seguimiento, es decir si ya lo recogieron en otra ruta  
        $existe = ModeloEscolar::mdlSeguimientoxPasajeroxFecha($idpasajero, $fecha);


        /* ===================================================
            GUARDAR SEGUIMIENTO
        ===================================================*/
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
        } else if ($existe['idrecorrido_recogida'] == NULL || $existe['idrecorrido_recogida'] == "") {

            $datos2 = array(
                "hora" => $hora,
                "idrecorrido" => $idrecorrido,
                "idseguimiento" => $existe['idseguimiento'],
                "user_updated" => $_SESSION['cedula']
            );

            $respuesta = ModeloEscolar::mdlInsertarRecogida($datos2);
            return $respuesta;
        } else {
            return "ya lo recogieron";
        }
    }

    /* ===================================================
        DAR ORDEN
    ===================================================*/
    static public function ctrDarOrden($idrecorrido, $idpasajero)
    {
        date_default_timezone_set('America/Bogota');
        $fecha = date("Y/m/d");
        
        $datosPR = array(
            "idrecorrido" => $idrecorrido,
            "fecha" => $fecha
        );




        $recorrido = ModeloEscolar::mdlDatosRecorrido($idrecorrido);
        $pasajerosRecorrido = ModeloEscolar::mdlPasajerosxRecorridoxFecha($datosPR);

        $orden = 0;

        //Si existe el recorrido
        if ($recorrido != false) {
            //Si ya existen pasajeros 
            if ($pasajerosRecorrido != false) {


                foreach ($pasajerosRecorrido as $key => $value) {
                    $respuesta = ModeloEscolar::mdlEstudiantexId($value['idpasajero']);
                    $orden_estudiante = ModeloEscolar::mdlEstudiantexId($idpasajero);

                    //SI EL ESTUDIANTE NO TIENE UN ORDEN 
                    if (!is_numeric($orden_estudiante['orden'])) {

                        if ($respuesta['orden'] != NULL && $respuesta['orden'] != 0 && $respuesta['orden'] != $orden && $respuesta['orden'] > $orden) {
                            //CAPTURA EL ÚLTIMO ORDEN Y SUMA 100 PARA EL NUEVO ODEN
                            $orden = $respuesta['orden'] + 100;
                        } else if ($respuesta['orden'] == $orden) {
                            //Si tiene el mismo orden suma 100
                            $orden = $orden + 100;
                        }
                    } else if (is_numeric($orden_estudiante['orden'])) {
                        //EL ESTUDIANTE TIENE ORDEN, SE MANTIENE EL MISMO ORDEN
                        $orden = $orden_estudiante['orden'];
                    }
                }






                $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);

                //Array para saber cuantas veces se ha actualizado el orden
                // $actualizaciones = [];
                
                if ($act == "ok") {

                    
                    
                    //Si solo se ha recogido un pasajero
                    if(count($pasajerosRecorrido) <= 1)
                    {
                        //ENVIAMOS CORREO
                        $datos_estudiante = ModeloEscolar::mdlEstudiantexId($idpasajero);
                        $datos_institucion = ModeloEscolar::mdlInstitucionxIdruta($datos_estudiante['idruta']);


                        $correo_institucion = $datos_institucion['correo'];
                        $subject = "Inicio de recorrido de la ruta " . $datos_institucion['numruta'];
                        $message = "<html>
                        <body>
                        <center>
                            <ul>
                            <li>Sector: {$datos_institucion['sector']}</li>
                            <li>Vehículo: {$datos_institucion['placa']} </li>
                            <li>Institución: {$datos_institucion['nombre']}</li>
                            </ul>
                        </center>
                        </body>
                        </html>";
                        
                        ControladorCorreo::ctrEnviarCorreo($correo_institucion, $subject, $message);

                    }

                }


                return $act;
            } else {

                //ES EL PRIMER PASAJERO QUE VAN A LISTAR
                $orden = 100;
                $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
                return $act;
            }
        } else {
            return "Este recorrido no existe";
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
        $existe = ModeloEscolar::mdlEstudiantexId($datos['idpasajero']);

        if ($existe != false) {
            if ($existe['idruta'] == $datos['idruta']) {
                return "El estudiante ya existe en esta ruta";
            } else {
                $respuesta = ModeloEscolar::mdlAsociarEstudianteTemporalRuta($datos);
                return $respuesta;
            }
        }
    }

    /* ===================================================
        ELIMINAR SEGUIMIENTO PASAJERO
    ===================================================*/
    static public function ctrEliminarSeguimientoEstudiante($datos)
    {
        $datos['fecha'] = date("Y/m/d");

        if ($datos['momento'] == "entrega") {
            $respuesta = ModeloEscolar::mdlEliminarSeguimientoEntrega($datos);
            return $respuesta;
        } else {
            $respuesta = ModeloEscolar::mdlEliminarSeguimientoRecoge($datos);
            return $respuesta;
        }
    }

    /* ===================================================
        FINALIZAR RECORRIDO
    ===================================================*/
    static public function ctrFinalizarRecorrido($datos)
    {
        $hora = date("h:i:s");

        $datos['hora'] = $hora;

        if ($datos['momento'] == "entrega") {
            $respuesta = ModeloEscolar::mdlFinalizarRecorridoEntrega($datos);
            return $respuesta;
        } else {
            $respuesta = ModeloEscolar::mdlFinalizarRecorridoRecoge($datos);
            return $respuesta;
        }
    }
}
