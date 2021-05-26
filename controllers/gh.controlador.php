<?php
class ControladorGH
{
    /* ===================================================
       * PERSONAL
    ===================================================*/
    /* ===================================================
            LISTADO PERSONAL
        ===================================================*/
    static public function ctrListaPersonal()
    {
        $respuesta = ModeloGH::mdlPersonal(null);
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
        $empleado = ModeloGH::mdlPersonal($datos['Documento']);

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
            $retorno = ModeloGH::mdlEditarPersonal($datos);
        }

        # FOTO
        if ($retorno != "existe" && $retorno != "error") {
            $idPersonal = $retorno;
            /* ===================== 
				CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL EMPLEADO 
			========================= */
            $directorio = DIR_APP . "views/img/fotosPersonal/" . strval($idPersonal);
            if (!is_dir($directorio)){
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
    static public function ctrDatosEmpleado($idPersonal)
    {
        $empleado = ModeloGH::mdlDatosEmpleado($idPersonal);
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
        $guardarDatos = ModeloGH::mdlGuardarLicencias($datos);
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

    

}
