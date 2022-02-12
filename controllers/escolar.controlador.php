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

                //SI CAMBIA DE RUTA 
                if ($existe['idruta'] != $datos['idruta']) {
                    ModeloEscolar::mdlEliminarOrden($datos['idpasajero']);
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
        $hora = date("h:i:s");

        $datosPR = array(
            "idrecorrido" => $idrecorrido,
            "fecha" => $fecha
        );




        $recorrido = ModeloEscolar::mdlDatosRecorrido($idrecorrido);
        $pasajerosRecorrido = ModeloEscolar::mdlPasajerosxRecorridoxFecha($datosPR);
        // DATOS DEL ESTUDIANTE QUE RECOGEN
        $Estudiante = ModeloEscolar::mdlEstudiantexId($idpasajero);

        $orden = 0;

        $pasajerosRuta = ModeloEscolar::mdlPasajerosxRuta($recorrido['idruta']);
        $ultimo_pasajero = ModeloEscolar::mdlUltimoPasajero($idrecorrido);

        if (count($ultimo_pasajero) - 2 >= 0) {
            $ultimo_pasajero = $ultimo_pasajero[count($ultimo_pasajero) - 2];
        }

        // var_dump($ultimo_pasajero[count($ultimo_pasajero) - 2]);

        if ($recorrido != false) {
            if (!is_numeric($Estudiante['orden'])) {
                foreach ($pasajerosRuta as $key => $value) {
                    if ($value['idpasajero'] == $ultimo_pasajero['idpasajero']) {
                        
                        $anterior = $value['orden'];
                        if($key + 1 != null) $siguiente = $pasajerosRuta[$key + 1]['orden'];
                        
                        if ($anterior != null && $siguiente != null) {

                            $orden = ($anterior + $siguiente) /  2;
                            $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
                            return $act;
                        } else if ($anterior == null && $siguiente != null) {

                            $orden = $siguiente / 2;
                            $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
                            return $act;
                        } else if ($anterior == null && $siguiente == null) {

                            $orden = 100;
                            $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
                            return $act;
                        }else if($anterior != null && $siguiente == null)
                        {
                            $orden = $anterior + 100;
                            $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
                            return $act;
                        }
                    }
                }
            }
        }


        # $recorrido != false
        # Estudiante tiene orden
        # pasa
        # 

        // if (false/* $recorrido != false */) {
        //     if (count($pasajerosRecorrido) == 1) {
        //         $orden = 100;
        //         $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //         return $act;
        //     } else if (count($pasajerosRecorrido) > 1) {

        //         foreach ($pasajerosRecorrido as $key => $value) {
        //             //BUSCAMOS EL ESTUDIANTE QUE RECOGEN
        //             if ($value['idpasajero'] == $idpasajero) {
        //                 // if (!is_numeric($orden_estudiante['orden'])) {

        //                     $estudiante_anterior = ModeloEscolar::mdlEstudiantexId($pasajerosRecorrido[$key-1]['idpasajero']);
        //                     $estudiante_siguiente = ModeloEscolar::mdlEstudiantexId($pasajerosRecorrido[$key + 1]['idpasajero']);

        //                     var_dump("ANTERIOR: ", $estudiante_anterior, "SIGUIENTE: ", $estudiante_siguiente);

        //                     if ($estudiante_anterior != false && $estudiante_siguiente != false) {
        //                         if ($estudiante_anterior['orden'] != null && $estudiante_siguiente['orden'] != null) {
        //                             $orden = $estudiante_anterior['orden'] + $estudiante_siguiente['orden'] / 2;
        //                             $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //                             return $act;
        //                         }
        //                     } else if ($estudiante_anterior != false && $estudiante_siguiente == false) {
        //                         $orden = $estudiante_anterior['orden'] + 100;
        //                         $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //                         return $act;
        //                     }
        //                 // }
        //             }
        //         }
        //     }
        // }

        //Si existe el recorrido
        // if ($recorrido != false) {
        //     //Si ya existen pasajeros 
        //     if ($pasajerosRecorrido != false) {



        //         //SI ES EL PRIMER PASAJERO PONE UNO
        //         if (count($pasajerosRecorrido) == 1) {
        //             $orden = 100;
        //             $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //             return $act;
        //         } else {
        //             foreach ($pasajerosRecorrido as $key => $value) {

        //                 //DATOS DE CADA ESTUDIANTE DEL RECORRIDO
        //                 $respuesta = ModeloEscolar::mdlEstudiantexId($value['idpasajero']);
        //                 //DATOS DEL ESTUDIANTE QUE RECOGEN
        //                 $orden_estudiante = ModeloEscolar::mdlEstudiantexId($idpasajero);

        //                 //SI EL ESTUDIANTE QUE RECOGEN NO TIENE UN ORDEN, SE ESTABLECE UNO
        //                 if (!is_numeric($orden_estudiante['orden'])) {

        //                     $estudiante_anterior = ModeloEscolar::mdlEstudiantexId($pasajerosRecorrido[$key]['idpasajero']);
        //                     $estudiante_siguiente = ModeloEscolar::mdlEstudiantexId($pasajerosRecorrido[$key + 2]['idpasajero']);

        //                     var_dump("ANTERIOR: ", $estudiante_anterior, "SIGUIENTE: ", $estudiante_siguiente);

        //                     if ($estudiante_anterior != false && $estudiante_siguiente != false) {
        //                         if ($estudiante_anterior['orden'] != null && $estudiante_siguiente['orden'] != null) {
        //                             $orden = $estudiante_anterior['orden'] + $estudiante_siguiente['orden'] / 2;
        //                             $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //                             return $act;
        //                         }
        //                     } else if ($estudiante_anterior != false && $estudiante_siguiente == false) {
        //                         $orden = $estudiante_anterior['orden'] + 100;
        //                         $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //                         return $act;
        //                     }
        //                 }
        //             }
        //         }




        //         // foreach ($pasajerosRecorrido as $key => $value) {
        //         //     $respuesta = ModeloEscolar::mdlEstudiantexId($value['idpasajero']);
        //         //     $orden_estudiante = ModeloEscolar::mdlEstudiantexId($idpasajero);

        //         //     //SI EL ESTUDIANTE NO TIENE UN ORDEN 
        //         //     if (!is_numeric($orden_estudiante['orden'])) {

        //         //         if ($respuesta['orden'] != NULL && $respuesta['orden'] != 0 && $respuesta['orden'] != $orden && $respuesta['orden'] > $orden) {
        //         //             //CAPTURA EL ÚLTIMO ORDEN Y SUMA 100 PARA EL NUEVO ODEN
        //         //             $orden = $respuesta['orden'] + 100;
        //         //         } else if ($respuesta['orden'] == $orden) {
        //         //             //Si tiene el mismo orden suma 100
        //         //             $orden = $orden + 100;
        //         //         }
        //         //     } else if (is_numeric($orden_estudiante['orden'])) {
        //         //         //EL ESTUDIANTE TIENE ORDEN, SE MANTIENE EL MISMO ORDEN
        //         //         $orden = $orden_estudiante['orden'];
        //         //     }
        //         // }








        //         //Array para saber cuantas veces se ha actualizado el orden
        //         // $actualizaciones = [];

        //         // if ($act == "ok") {



        //         //     //Si solo se ha recogido un pasajero
        //         //     if(count($pasajerosRecorrido) <= 1)
        //         //     {
        //         //         //ENVIAMOS CORREO
        //         //         $datos_estudiante = ModeloEscolar::mdlEstudiantexId($idpasajero);
        //         //         $datos_institucion = ModeloEscolar::mdlInstitucionxIdruta($datos_estudiante['idruta']);


        //         //         $correo_institucion = $datos_institucion['correo'];
        //         //         $subject = "Inicio de recorrido de la ruta " . $datos_institucion['numruta'];
        //         //         $message = "<html>
        //         //         <body>

        //         //             <ul>
        //         //             <li><b><u>Sector: </u></b>{$datos_institucion['sector']}</li>
        //         //             <li><b><u>Vehículo: </u></b>{$datos_institucion['placa']} </li>
        //         //             <li><b><u>Conductor: </u></b>{$datos_institucion['Nombre']}</li>
        //         //             <li><b><u>Institución: </u></b>{$datos_institucion['nombre']}</li>
        //         //             <li><b><u>Fecha: </u></b>$fecha </li>
        //         //             <li><b><u>Hora: </u></b>$hora </li>
        //         //             <br><i> Email generado automáticamente, por favor no responder este correo.</i>
        //         //             </ul>

        //         //         </body>
        //         //         </html>";


        //         //         ControladorCorreo::ctrEnviarCorreo($correo_institucion, $subject, $message);

        //         //     }

        //         // }



        //     } else {

        //         //ES EL PRIMER PASAJERO QUE VAN A LISTAR
        //         $orden = 100;
        //         $act = ModeloEscolar::mdlActualizarOrden($idpasajero, $orden);
        //         return $act;
        //     }
        // } else {
        //     return "Este recorrido no existe";
        // }
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
        $fecha = date("Y/m/d");
        $hora = date("h:i:s");

        $datos['hora'] = $hora;

        if ($datos['momento'] == "entrega") {
            $respuesta = ModeloEscolar::mdlFinalizarRecorridoEntrega($datos);

            if ($respuesta == "ok") {
                $datos_recorrido = ModeloEscolar::mdlDatosRecorrido($datos['idrecorrido']);
                $datos_institucion = ModeloEscolar::mdlInstitucionxIdruta($datos_recorrido['idruta']);
                $pasajeros = ModeloEscolar::mdlPasajerosxRecorridoEntrega($datos['idrecorrido']);

                $lista_estudiantes = "<ul>";

                foreach ($pasajeros as $key => $value) {
                    $lista_estudiantes .=  "<br><li>" . $value['nombre'] .  " - "  . $value['codigo'] . "-" . $value['hora_entrega'] . "</li>";
                }

                $lista_estudiantes .= "</ul>";


                $correo_institucion = $datos_institucion['correo'];
                $subject = "Fin de recorrido de la ruta " . $datos_institucion['numruta'] . " (ENTREGA)";
                $message = "<table <table border='1'>
                <thead>
                  <tr>
                    <td># Ruta</td>
                    <td>Sector</td>
                    <td>Placa</td>
                     <td>Conductor</td>
                    <td>Fecha</td>
                    <td>Hora</td>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{$datos_institucion['numruta']}</td>
                      <td>{$datos_institucion['sector']}</td>
                      <td>{$datos_institucion['placa']}</td>
                      <td>{$datos_institucion['Nombre']}</td>
                      <td>$fecha</td>
                      <td>$hora</td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <b><u>Estudiantes que fueron entregados:</u></b> $lista_estudiantes
                <br>
                <i> Email generado automáticamente, por favor no responder este correo.</i>
                ";
                // $message = "<html>
                //         <body>

                //             <ul>
                //             <li><b><u>Sector: </u></b>{$datos_institucion['sector']}</li>
                //             <li><b><u>Vehículo: </u></b>{$datos_institucion['placa']} </li>
                //             <li><b><u>Conductor: </u></b>{$datos_institucion['Nombre']}</li>
                //             <li><b><u>Institución: </u></b>{$datos_institucion['nombre']}</li>
                //             <li><b><u>Fecha: </u></b>$fecha </li>
                //             <li><b><u>Hora: </u></b>$hora </li>
                //             <br>
                //             <li><b><u>Estudiantes que fueron entregados:</u></b> $lista_estudiantes </li>
                //             <br><i> Email generado automáticamente, por favor no responder este correo.</i>
                //             </ul>

                //         </body>
                //         </html>";




                ControladorCorreo::ctrEnviarCorreo($correo_institucion, $subject, $message);
            }

            return $respuesta;
        } else {
            $respuesta = ModeloEscolar::mdlFinalizarRecorridoRecoge($datos);

            if ($respuesta == "ok") {
                $datos_recorrido = ModeloEscolar::mdlDatosRecorrido($datos['idrecorrido']);
                $datos_institucion = ModeloEscolar::mdlInstitucionxIdruta($datos_recorrido['idruta']);

                $pasajeros = ModeloEscolar::mdlPasajerosxRecorridoRecoge($datos['idrecorrido']);

                $lista_estudiantes = "<ul>";

                foreach ($pasajeros as $key => $value) {
                    $lista_estudiantes .=  "<br><li>" . $value['nombre'] .  " - "  . $value['codigo'] .  $value['hora_recogida'] . "</li>";
                }
                $lista_estudiantes .= "</ul>";


                $correo_institucion = $datos_institucion['correo'];
                $subject = "Fin de recorrido de la ruta " . $datos_institucion['numruta'] . " (RECOGIDA)";
                $message = "<table border='1' style='text-align: center;'>
                <thead>
                  <tr>
                    <td># Ruta</td>
                    <td>Sector</td>
                    <td>Placa</td>
                     <td>Conductor</td>
                    <td>Fecha</td>
                    <td>Hora</td>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{$datos_institucion['numruta']}</td>
                      <td>{$datos_institucion['sector']}</td>
                      <td>{$datos_institucion['placa']}</td>
                      <td>{$datos_institucion['Nombre']}</td>
                      <td>$fecha</td>
                      <td>$hora</td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <b><u>Estudiantes que fueron recogidos:</u></b> $lista_estudiantes
                <br>
                <i> Email generado automáticamente, por favor no responder este correo.</i>
                ";

                // $message = "<html>
                //         <body>

                //             <ul>
                //             <li><b><u>Sector: </u></b>{$datos_institucion['sector']}</li>
                //             <li><b><u>Vehículo: </u></b>{$datos_institucion['placa']} </li>
                //             <li><b><u>Conductor: </u></b>{$datos_institucion['Nombre']}</li>
                //             <li><b><u>Institución: </u></b>{$datos_institucion['nombre']}</li>
                //             <li><b><u>Fecha: </u></b>$fecha </li>
                //             <li><b><u>Hora: </u></b>$hora </li>
                //             <br>
                //             <li><b><u>Estudiantes que fueron entregados:</u></b> $lista_estudiantes </li>
                //             <br><i> Email generado automáticamente, por favor no responder este correo.</i>
                //             </ul>

                //         </body>
                //         </html>";

                ControladorCorreo::ctrEnviarCorreo($correo_institucion, $subject, $message);
            }



            return $respuesta;
        }
    }

    /* ===================================================
        GUARDAR INSTITUCION 
    ===================================================*/
    static public function ctrGuardarInstitucion($datos)
    {

        var_dump($datos);


        if (isset($_POST['docum_empre'])) {

            $datosBusqueda = array(
                'item' => 'Documento',
                'valor' => $_POST['docum_empre']
            );



            $datos = array(
                'idcliente' => $_POST['idcliente'],
                't_document_empre' => $_POST['t_document_empre'],
                'nom_empre' => $_POST['nom_empre'],
                'docum_empre' => $_POST['docum_empre'],
                'telclient' => $_POST['telclient'],
                'telclient2' => $_POST['telclient2'],
                'dir_empre' => $_POST['dir_empre'],
                'ciudadcliente' => $_POST['ciudadcliente'],
                't_document_respo' => $_POST['t_document_respo'],
                'docum_respo' => $_POST['docum_respo'],
                'expedicion' => $_POST['expedicion'],
                'nom_respo' => $_POST['nom_respo'],
                'ciudadresponsable' => $_POST['ciudadresponsable'],
                'correo' => $_POST['correo'],
                'tipo' => "CLIENTE",
                'tipo_cliente' => $_POST['tipocliente']
            );



            $datos['tipo_cliente'] = $datos['tipo_cliente'] == "" ? null : $datos['tipo_cliente'];


            $ClienteExistente = ModeloClientes::mdlVerClienteid($datosBusqueda);


            if (is_array($ClienteExistente) && $ClienteExistente['idcliente'] != $_POST['idcliente']) {
                // echo "
                // 			<script>
                // 				Swal.fire({
                // 					icon: 'warning',
                // 					title: '¡Cliente ya existe!',						
                // 					showConfirmButton: true,
                // 					confirmButtonText: 'Cerrar',

                // 				}).then((result)=>{

                // 					if(result.value){
                // 						window.location = 'contratos-clientes';
                // 					}

                // 				})
                // 			</script>
                // 		";
                return "existe";
            } else {
                if ($_POST['idcliente'] == '') {

                    $responseModel = ModeloClientes::mdlAgregarCliente($datos);
                } else {
                    $responseModel = ModeloClientes::mdlEditarCliente($datos);
                }
            }

            if ($responseModel == "ok" || $responseModel != "error") {
                // echo "
                // 		<script>
                // 			Swal.fire({
                // 				icon: 'success',
                // 				title: '¡Cliente añadido correctamente!',						
                // 				showConfirmButton: true,
                // 				confirmButtonText: 'Cerrar',

                // 			}).then((result)=>{

                // 				if(result.value){
                // 					window.location = 'contratos-clientes';
                // 				}

                // 			})
                // 		</script>
                // 	";

                return "ok";
            } else {
                // echo "
                // 		<script>
                // 			Swal.fire({
                // 				icon: 'warning',
                // 				title: '¡Problema al añadir el cliente!',						
                // 				showConfirmButton: true,
                // 				confirmButtonText: 'Cerrar',

                // 			}).then((result)=>{

                // 				if(result.value){
                // 					window.location = 'contratos-clientes';
                // 				}

                // 			})
                // 		</script>
                // 	";

                return "error";
            }
        }
    }


    /* ===================================================
        LISTAR AUXILIARES 
    ===================================================*/
    static public function ctrListarAuxiliares()
    {
        $respuesta = ModeloEscolar::mdlListarAuxiliares();
        return $respuesta;
    }
}
