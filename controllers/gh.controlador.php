<?php
class ControladorGH
{
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
    static public function ctrGuardarPersonal($datos)
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

        $datos = array('tabla' => 'gh_personal', 
                        'item1' => 'activo',
                        'valor1' => $nuevoEstado,
                        'item2' => 'idPersonal',
                        'valor2' => $idPersonal
                        );
        $respuesta = ModeloGH::mdlActualizarEmpleado($datos);
        return $respuesta;
    }
}
