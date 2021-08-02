<?php

/* ===================================================
   * FUEC
===================================================*/
class ControladorFuec
{
	/* ===================================================
       DATOS DEL FUEC
    ===================================================*/
	static public function ctrDatosFUEC($item, $valor)
	{
		$datos = array(
			'item' => $item,
			'valor' => $valor
		);
		$FUEC = ModeloFuec::mdlDatosFUEC($datos);
		return $FUEC;
	}

    /* ===================================================
        DOCUMENTOS VENCIDOS DEL VEHICULO, esta consulta en realidad trae todos los documentos que puede tener un vehiculo (sin repetir) sin importar si está vencido o no
    ===================================================*/
    static public function ctrDocumentosVencidos($idvehiculo)
    {
        $respuesta = ModeloFuec::mdlDocumentosVencidos($idvehiculo);
        return $respuesta;
    }

    /* ===================================================
       VERIFICAR PAGO SEGURIDAD SOCIAL DEL CONDUCTOR
    ===================================================*/
    static public function ctrConductorPagoSS($idpersonal)
    {
        $respuesta = ModeloFuec::mdlConductorPagoSS($idpersonal);
        return $respuesta;
    }

    /* ===================================================
       OBJETO DE CONTRATO
    ===================================================*/
    static public function ctrObjetosContrato()
    {
        $respuesta = ModeloFuec::mdlObjetosContrato();
        return $respuesta;
    }

    /* ===================================================
       GUARDAR DATOS DEL FUEC
    ===================================================*/
    static public function ctrGuardarFUEC($datos)
	{
		$datosBusqueda = array(
			'item' => 'idfuec',
			'valor' => $datos['idfuec']
		);
		//$FUEC = ModeloVehiculos::mdlDatosVehiculo($datosBusqueda);
		$FUEC = true;

		# Datos que pueden venir vacios del formulario
		$datos["precio"] = $datos["precio"] == "" ? null : $datos["precio"];
		$datos["contratofijo"] = $datos["contratofijo"] == "" ? null : $datos["contratofijo"];
		$datos["contratante"] = $datos["contratante"] == "" ? null : $datos["contratante"];
		$datos["conductor2"] = $datos["conductor2"] == "" ? null : $datos["conductor2"];
		$datos["conductor3"] = $datos["conductor3"] == "" ? null : $datos["conductor3"];
		$datos["usuario_creacion"] = $_SESSION['cedula'];
		$datos["contratoadjunto"] = $datos["contratoadjunto"] == "" ? null : $datos["contratoadjunto"];

		# INSERT
		if ($datos['idfuec'] == "") {
			$retorno = ModeloFuec::mdlAgregarFUEC($datos);
		}
		# UPDATE
		else {
			if ($FUEC !== false) {
				# UPDATE
				//$retorno = ModeloFuec::mdlEditarFUEC($datos);
			}else{
				$retorno = "error";
			}
		}

		// ? FOTOS DEL VEHICULO Y TARJETA DE PROPIEDAD
		if ($retorno != "error"){
			// TARJETA DE PROPIEDAD
			// self::ctrGuardarTarjetaPropiedad($tarjetapropiedad, $datos['placa']);
		}

		# En caso de retornar algo distinto al id
		if ($retorno != "error" && !is_numeric($retorno)){
			$retorno = "error";
		}
		return $retorno;
	}

}
