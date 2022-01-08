<?php
# IMPORTAMOS LA CONFIGURACION DE LA SESSION
include '../config/config.php';
# REQUERIMOS EL CONTROLADOR Y EL MODELO PARA QUE REALICE LA PETICION
require_once '../models/calendario.modelo.php';

if (!isset($_SESSION['iniciarSesion']) || $_SESSION['iniciarSesion'] != "ok") {
    echo "<script>window.location = 'inicio';</script>";
    die();
}

class AjaxCalendario
{
    static public function ajaxAlmacenarEvento($titulo, $fecha_i, $fecha_f, $descripcion, $color,$estado_tarea)
    {
        $fecha_f = $fecha_f == "" ? null : $fecha_f;
        $datos = array(
            'titulo' => $titulo,
            'fecha_i' => $fecha_i,
            'fecha_f' => $fecha_f,
            'color' => $color,
            'descripcion' => $descripcion,
            'usuario' => $_SESSION['cedula'],
            'estado_tarea' => $estado_tarea
        );

        $respuesta = ModeloCalendario::mdlAlmacenarEvento($datos);

        echo $respuesta;
    }

    static public function ajaxDatosEvento($id_evento)
    {
        $respuesta = ModeloCalendario::mdlDatosEventos($id_evento);

        echo json_encode($respuesta);
    }

    static public function ajaxCargarCalendario()
    {
        $respuesta = ModeloCalendario::mdlCargarCalendario($_SESSION['cedula']);

        echo json_encode($respuesta);
    }

    static public function ajaxEditarEvento($id, $titulo, $fecha_i, $fecha_f, $descripcion)
    {
        $fecha_f = $fecha_f == "" ? null : $fecha_f;
        $datos = array(
            'id' => $id,
            'titulo' => $titulo,
            'start' => $fecha_i,
            'end' => $fecha_f,
            'descripcion' => $descripcion
        );

        $respuesta = ModeloCalendario::mdlEditarEvento($datos);

        echo $respuesta;
    }

    static public function ajaxCambiarEstadoTarea($id, $estado_actual)
    {
        if ($estado_actual == "PENDIENTE") {
            $datos1 = array(
                'id' => $id,
                'estado_tarea' => "FINALIZADA",
                'color' => "#00CC00");

            $respuesta = ModeloCalendario::mdlCambiarEstadoTarea($datos1);

            echo $respuesta;

        } else if ($estado_actual == "FINALIZADA") {
            $datos2 = array(
                'id' => $id,
                'estado_tarea' => "PENDIENTE",
                'color' => "#DBD053");

            $respuesta = ModeloCalendario::mdlCambiarEstadoTarea($datos2);

            echo $respuesta;
        }
    }

    static public function ajaxListarTareasPorEstado($estado)
    {
        $datos = array('estado_tarea' => $estado,
                        'usuario' => $_SESSION['cedula']);

        $respuesta = ModeloCalendario::mdlListarTareasPorEstado($datos);

        $li = "";

        foreach ($respuesta as $key => $value) {
			$li .= "
			<li>  
			    <strong>{$value["titulo"]}: </strong>
				{$value["descripcion"]}
			</li>
			";
		}
		echo $li;
    }


}

if (isset($_POST['almacenarEvento']) && $_POST['almacenarEvento'] == "ok") {
    AjaxCalendario::ajaxAlmacenarEvento($_POST['titulo'], $_POST['fecha_i'], $_POST['fecha_f'], $_POST['descripcion'], $_POST['color'], $_POST['estado_tarea']);
}

if (isset($_POST['datosEvento']) && $_POST['datosEvento'] == "ok") {
    AjaxCalendario::ajaxDatosEvento($_POST['id_evento']);
}

if (isset($_POST['cargarCalendario']) && $_POST['cargarCalendario'] == "ok") {
    AjaxCalendario::ajaxCargarCalendario();
}

if (isset($_POST['editarEvento']) && $_POST['editarEvento'] == "ok") {
    AjaxCalendario::ajaxEditarEvento($_POST['id'], $_POST['titulo'], $_POST['fecha_i'], $_POST['fecha_f'], $_POST['descripcion']);
}

if (isset($_POST['estadoTarea']) && $_POST['estadoTarea'] == "ok") {
    AjaxCalendario::ajaxCambiarEstadoTarea($_POST['id'], $_POST['estado']);
}

if (isset($_POST['tareasPorEstado']) && $_POST['tareasPorEstado'] == "ok") {
    AjaxCalendario::ajaxListarTareasPorEstado($_POST['estado']);
}
