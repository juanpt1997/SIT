<?php

/* ===================================================
   * PERSONAL Y PERFIL SOCIODEMOGRAFICO
===================================================*/
class ControladorGH
{
    /* ===================================================
       * PERSONAL - gh_personal
    ===================================================*/
    /* ===================================================
            LISTADO PERSONAL
        ===================================================*/
    static public function ctrListaPersonal()
    {
        $respuesta = ModeloGH::mdlPersonal("todo");
        return $respuesta;
    }

    /* ===================================================
	   SUCURSALES
	===================================================*/
    static public function ctrSucursales()
    {
        $respuesta = ModeloGH::mdlSucursales();
        return $respuesta;
    }

    /* ===================================================
       DEPARTAMENTOS/MUNICIPIOS
    ===================================================*/
    static public function ctrDeparMunicipios()
    {
        $respuesta = ModeloGH::mdlDeparMunicipios();
         return $respuesta;

    }

    /* ===================================================
       CARGOS
    ===================================================*/
    static public function ctrCargos()
    {
        $respuesta = ModeloGH::mdlCargos();
        return $respuesta;
    }

    /* ===================================================
       PROCESOS
    ===================================================*/
    static public function ctrProcesos()
    {
        $respuesta = ModeloGH::mdlProcesos();
        return $respuesta;
    }

    /* ===================================================
       LISTADO EPS
    ===================================================*/
    static public function ctrListadoEPS()
    {
        $respuesta = ModeloGH::mdlListadoEPS();
        return $respuesta;
    }

    /* ===================================================
       LISTADO AFP
    ===================================================*/
    static public function ctrListadoAFP()
    {
        $respuesta = ModeloGH::mdlListadoAFP();
        return $respuesta;
    }

    /* ===================================================
       LISTADO ARL
    ===================================================*/
    static public function ctrListadoARL()
    {
        $respuesta = ModeloGH::mdlListadoARL();
        return $respuesta;
    }

    /* ===================================================
       GUARDAR PERSONAL
    ===================================================*/
    static public function ctrGuardarPersonal($datos, $foto)
    {
        $datosBusqueda = array(
            'item' => 'Documento',
            'valor' => $datos['Documento']
        );
        //$empleado = ModeloGH::mdlPersonal($datos['Documento']);
        $empleado = ModeloGH::mdlDatosEmpleado($datosBusqueda);

        # INSERT
        if ($datos['idPersonal'] == "") {
            if (is_array($empleado)) {
                # mensaje al usuario
                $retorno = "existe";
            } else {
                # INSERT
                $retorno = ModeloGH::mdlAgregarPersonal($datos);
            }
        }
        # UPDATE
        else {
            if (is_array($empleado) && $empleado['idPersonal'] != $datos['idPersonal']) {
                # mensaje al usuario
                $retorno = "existe";
            } else {
                # UPDATE
                $retorno = ModeloGH::mdlEditarPersonal($datos);
            }
        }

        # FOTO
        if ($retorno != "existe" && $retorno != "error") {
            $idPersonal = $retorno;
            /* ===================== 
				CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL EMPLEADO 
			========================= */
            $directorio = DIR_APP . "views/img/fotosPersonal/" . strval($idPersonal);
            if (!is_dir($directorio)) {
                mkdir($directorio, 0755);
            }

            /* ===================================================
                       GUARDAR LA IMAGEN EN EL SERVIDOR
                    ===================================================*/
            $GuardarImagen = new FilesController();
            $GuardarImagen->file = $foto;
            $aleatorio = mt_rand(100, 999);
            $GuardarImagen->ruta = $directorio . "/" . $aleatorio;
            $ruta = $GuardarImagen->ctrImages(500, 500);

            /* ===================================================
					ACTUALIZAR RUTA IMAGEN EN LA BD
				===================================================*/
            if ($ruta != "") {
                $rutaImg = str_replace(DIR_APP, "", $ruta);

                $datosRutaImg = array(
                    'tabla' => 'gh_personal',
                    'item1' => 'foto',
                    'valor1' => $rutaImg,
                    'item2' => 'idPersonal',
                    'valor2' => $idPersonal
                );
                $actualizarRutaImg = ModeloGH::mdlActualizarEmpleado($datosRutaImg);
            }
        }

        return $retorno;
    }

    /* ===================================================
       DATOS DEL EMPLEADO
    ===================================================*/
    static public function ctrDatosEmpleado($item, $valor)
    {
        $datos = array(
            'item' => $item,
            'valor' => $valor
        );
        $empleado = ModeloGH::mdlDatosEmpleado($datos);
        return $empleado;
    }

    /* ===================================================
       ACTIVAR/DESACTIVAR PERSONAL
    ===================================================*/
    static public function ctrCambiarEstado($idPersonal, $estadoActual)
    {
        $nuevoEstado = $estadoActual == "S" ? "N" : "S";

        $datos = array(
            'tabla' => 'gh_personal',
            'item1' => 'activo',
            'valor1' => $nuevoEstado,
            'item2' => 'idPersonal',
            'valor2' => $idPersonal
        );
        $respuesta = ModeloGH::mdlActualizarEmpleado($datos);
        return $respuesta;
    }

    /* ===================================================
       ? HIJOS
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR HIJOS
    ===================================================*/
    static public function ctrGuardarHijos($datos)
    {
        $guardarDatos = ModeloGH::mdlGuardarHijos($datos);
        return $guardarDatos;
    }

    /* ===================================================
       MOSTRAR HIJOS DEL EMPLEADO
    ===================================================*/
    static public function ctrMostrarHijos($idPersonal)
    {
        $respuesta = ModeloGH::mdlMostrarHijos($idPersonal);
        return $respuesta;
    }

    /* ===================================================
       ? CONTRATOS Y PRORROGAS
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR CONTRATOS Y PRORROGAS
    ===================================================*/
    static public function ctrGuardarProrrogas($datos)
    {
        $guardarDatos = ModeloGH::mdlGuardarProrrogas($datos);
        return $guardarDatos;
    }

    /* ===================================================
       MOSTRAR PRORROGAS
    ===================================================*/
    static public function ctrMostrarProrrogas($idPersonal)
    {
        $respuesta = ModeloGH::mdlMostrarProrrogas($idPersonal);
        return $respuesta;
    }

    /* ===================================================
       ? LICENCIAS DE CONDUCCIÓN
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR LICENCIAS DE CONDUCCIÓN
    ===================================================*/
    static public function ctrGuardarLicencias($datos)
    {
        $licencias = ModeloGH::mdlMostrarLicencias($datos['idPersonal']);
        if (count($licencias) == 0) {
            $guardarDatos = ModeloGH::mdlGuardarLicencias($datos);
        } else {
            $guardarDatos = "existe";
        }
        return $guardarDatos;
    }

    /* ===================================================
       MOSTRAR LICENCIAS
    ===================================================*/
    static public function ctrMostrarLicencias($idPersonal)
    {
        $respuesta = ModeloGH::mdlMostrarLicencias($idPersonal);
        return $respuesta;
    }

    /* ===================================================
       ? EXÁMENES MÉDICOS
    ===================================================*/
    /* ===================================================
       FORMULARIO PARA GUARDAR EXÁMENES MÉDICOS
    ===================================================*/
    static public function ctrGuardarExamenes($datos)
    {
        $guardarDatos = ModeloGH::mdlGuardarExamenes($datos);
        return $guardarDatos;
    }

    /* ===================================================
       MOSTRAR EXAMENES
    ===================================================*/
    static public function ctrMostrarExamenes($idPersonal)
    {
        $respuesta = ModeloGH::mdlMostrarExamenes($idPersonal);
        return $respuesta;
    }

    /* ===================================================
       ! ELIMINAR REGISTRO
    ===================================================*/
    static public function ctrEliminarRegistro($datos)
    {
        $respuesta = ModeloGH::mdlEliminarRegistro($datos);
        return $respuesta;
    }

    /* ===================================================
       * Perfil sociodemografico - gh-perfil-sd
    ===================================================*/
    /* ===================================================
       MOSTRAR PERFIL SOCIODEMOGRÁFICO
    ===================================================*/
    static public function ctrMostrarPerfilSD()
    {
        $Personal = ModeloGH::mdlPersonal("todo");

        $respuestaArray = array();

        foreach ($Personal as $key => $empleado) {
            $hijos = ModeloGH::mdlMostrarHijos($empleado['idPersonal']);
            $arrayHijos = array('hijos' => $hijos);
            $mergeArray = array_merge($empleado, $arrayHijos);
            $respuestaArray[] = $mergeArray;
        }

        return $respuestaArray;
    }

    /* ===================================================
        CAPTURA DEL EMPLEADO CON MAYOR CANTIDAD DE HIJOS, usado para saber la cantidad de columnas en el thead de perfil sociodemografico
    ===================================================*/
    static public function ctrMayorCantidadHijos()
    {
        $mayorCantidadHijos = ModeloGH::mdlMayorCantidadHijos();
        if (!is_array($mayorCantidadHijos)) {
            $mayorCantidadHijos = array('cantidad' => 0);
        }
        return $mayorCantidadHijos;
    }

    /* ===================================================
       * Alertas de contratos - gh-alertas-contratos
    ===================================================*/
    /* ===================================================
       MOSTRAR CONTRATOS PROXIMOS A VENCER
    ===================================================*/
    static public function ctrContratosVencer()
    {
        return ModeloGH::mdlContratosVencer();
    }
}

/* ===================================================
    * PAGO SEGURIDAD SOCIAL
===================================================*/
class ControladorPagoSS
{
    /* ===================================================
       MOSTRAR TODAS LAS FECHAS DE LOS PAGOS SEGURIDAD SOCIAL
    ===================================================*/
    static public function ctrMostrarFechas()
    {
        return ModeloPagoSS::mdlMostrarFechas();
    }

    /* ===================================================
       GUARDAR FECHAS PARA PAGO SEGURIDAD SOCIAL
    ===================================================*/
    static public function ctrGuardarFechas($datos)
    {
        if ($datos['idFechas'] == "") {
            # INSERT
            $idFechas = ModeloPagoSS::mdlAgregarFechas($datos);

            #INSERT DE TODO EL PERSONAL A LA TABLA RELACIONAL
            if ($idFechas != "error") {
                ModeloPagoSS::mdlLlenarPagosxEmpleados($idFechas);
                $retorno = $idFechas;
            } else {
                $retorno = "error";
            }
        } else {
            # UPDATE
            $update = ModeloPagoSS::mdlEditFechas($datos);
            if ($update == "ok") {
                $retorno = "update";
            } else {
                $retorno = "error";
            }
        }

        # Mensaje que retorna
        return $retorno;
    }

    /* ===================================================
       TABLA PAGO SEGURIDAD SOCIAL
    ===================================================*/
    static public function ctrMostrarPagoSS($idFechas)
    {
        return ModeloPagoSS::mdlMostrarPagoSS($idFechas);
    }

    /* ===================================================
       CAMBIAR PAGO DEL EMPLEADO
    ===================================================*/
    static public function ctrActualizarPago($idsegursoc, $estadoActual)
    {
        $nuevoEstado = $estadoActual == "S" ? "N" : "S";

        $datos = array(
            'tabla' => 'gh_re_personalsegursoc',
            'item1' => 'pago',
            'valor1' => $nuevoEstado,
            'item2' => 'idsegursoc',
            'valor2' => $idsegursoc
        );
        $respuesta = ModeloGH::mdlActualizarEmpleado($datos);
        return $respuesta;
    }

    /* ===================================================
       AGREGAR UN SOLO EMPLEADO AL PAGO DE SEGURIDAD SOCIAL
    ===================================================*/
    static public function ctrAgregarEmpleado($idPersonal, $idFechas)
    {
        return ModeloPagoSS::mdlAgregarEmpleado($idPersonal, $idFechas);
    }
}

/* ===================================================
   * CONTROL AUSENTISMO
===================================================*/
class ControladorAusentismo
{
    /* ===================================================
       LISTA AUSENTISMO
    ===================================================*/
    static public function ctrListaAusentismo()
    {
        return ModeloAusentismo::mdlListaAusentismo();
    }

    /* ===================================================
       LISTA PERSONAL ACTIVO, ESTO SE USA EN EL FORMULARIO PARA AGREGAR UN NUEVO AUSENTISMO
    ===================================================*/
    static public function ctrListaPersonal()
    {
        return ModeloGH::mdlPersonal("activos");
    }

    /* ===================================================
       TIPOS DE AUSENTISMO
    ===================================================*/
    static public function ctrTiposAusentismo()
    {
        return ModeloAusentismo::mdlTiposAusentismo();
    }

    /* ===================================================
       GUARDAR AUSENTISMO
    ===================================================*/
    static public function ctrGuardarAusentismo()
    {
        if (isset($_POST['idAusentismo'])) {
            if ($_POST['idAusentismo'] == ""){
                //INSERT TABLA
                $AddEditAusentismo = ModeloAusentismo::mdlAgregarAusentismo($_POST);
            }else{
                //UPDATE TABLA
                $AddEditAusentismo = ModeloAusentismo::mdlEditarAusentismo($_POST);
            }

            if ($AddEditAusentismo == "ok") {
                /* Mensaje éxito */
                echo "
						<script>
							Swal.fire({
								icon: 'success',
								title: '¡Ausentismo guardado correctamente!',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								
							}).then((result)=>{

								if(result.value){
									window.location = 'gh-ausentismo';
								}

							})
						</script>
					";
            } else {
                echo "
						<script>
							Swal.fire({
								icon: 'error',
								title: 'Problemas al guardar los datos',						
								showConfirmButton: true,
								confirmButtonText: 'Cerrar',
								closeOnConfirm: false								
							})
						</script>
					";
            }
        }
    }

    /* ===================================================
       DATOS DE UN SOLO AUSENTISMO
    ===================================================*/
    static public function ctrDatosAusentismo($idAusentismo)
    {
        return ModeloAusentismo::mdlDatosAusentismo($idAusentismo);
    }
}
