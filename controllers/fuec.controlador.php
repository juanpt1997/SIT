<?php

/* ===================================================
   * FUEC
===================================================*/
class ControladorFuec
{
	/* ===================================================
       LISTA DE FUEC
    ===================================================*/
	static public function ctrListaFUEC()
	{
		$respuesta = ModeloFuec::mdlListaFUEC();
		return $respuesta;
	}

	/* ===================================================
       DATOS DEL FUEC
    ===================================================*/
	static public function ctrDatosFUEC($item, $valor)
	{
		$datos = array(
			'item' => $item,
			'valor' => $valor
		);
		$FUEC = ModeloFuec::mdlDatosFUEC2($datos);
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
       VERIFICAR LICENCIA DEL CONDUCTOR
    ===================================================*/
	static public function ctrConductorLicencia($idpersonal)
	{
		$respuesta = ModeloFuec::mdlConductorLicencia($idpersonal);
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
	static public function ctrGuardarFUEC($datos, $documento)
	{
		$datosBusqueda = array(
			'item' => 'idfuec',
			'valor' => $datos['idfuec']
		);

		# Datos que pueden venir vacios del formulario
		$datos["precio"] = $datos["precio"] == "" ? null : $datos["precio"];
		$datos["contratofijo"] = $datos["contratofijo"] == "" ? null : $datos["contratofijo"];
		$datos["contratante"] = $datos["contratante"] == "" ? null : $datos["contratante"];
		$datos["conductor2"] = $datos["conductor2"] == "" ? null : $datos["conductor2"];
		$datos["conductor3"] = $datos["conductor3"] == "" ? null : $datos["conductor3"];
		$datos["usuario_creacion"] = $_SESSION['cedula'];
		//$datos["contratoadjunto"] = $datos["contratoadjunto"] == "" ? null : $datos["contratoadjunto"];
		// Número del contrato
		if ($datos['tipocontrato'] == "OCASIONAL") {
			$nro_contrato_maximo = ModeloFuec::mdlNumeroContrato($datos['tipocontrato'])['nro_contrato'];
			$nro_contrato = $nro_contrato_maximo == null ? 1 : $nro_contrato_maximo += 1;
		} else {
			$nro_contrato = $datos["contratofijo"];
		}

		# INSERT
		if ($datos['idfuec'] == "") {
			$datos["nro_contrato"] = $nro_contrato;
			$retorno = ModeloFuec::mdlAgregarFUEC($datos);
		}
		# UPDATE
		else {
			$FUEC = self::ctrDatosFUEC("idfuec", $datos['idfuec']);
			if ($FUEC !== false) {
				// Es diferente el tipo que entra al tipo existente
				if ($datos["tipocontrato"] != $FUEC['tipocontrato'] && $datos["contratofijo"] != $FUEC['contratofijo']) {
					// Actualizo numero consecutivo
					// es decir no hago nada
				} else {
					// Dejo el consecutivo guardado anteriormente
					$nro_contrato = $FUEC['nro_contrato'];
				}
				# UPDATE
				$datos["nro_contrato"] = $nro_contrato;
				$retorno = ModeloFuec::mdlEditarFUEC($datos);
			} else {
				$retorno = "error";
			}
		}
		# En caso de retornar algo distinto al id
		if ($retorno != "error" && !is_numeric($retorno)) {
			$retorno = "error";
		}

		// ? ADJUNTAR CONTRATO
		if ($retorno != "error" && is_array($documento)) {
			// CONTRATO ADJUNTO
			self::ctrGuardarContratoAdjunto($documento, $retorno);
		}

		return $retorno;
	}

	/* ===================================================
	   GUARDAR CONTRATO
	===================================================*/
	static public function ctrGuardarContratoAdjunto($documento, $idfuec)
	{
		/* ===================== 
			CREAMOS DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA TARJETA DE PROPIEDAD
		========================= */
		$directorio = DIR_APP . "views/docs/contratosFuec/" . strval($idfuec);
		if (!is_dir($directorio)) {
			mkdir($directorio, 0755);
		}
		/* ===================================================
			GUARDAR LA IMAGEN EN EL SERVIDOR
		===================================================*/
		$GuardarImagen = new FilesController();
		$GuardarImagen->file = $documento;
		$aleatorio = mt_rand(100, 999);
		$GuardarImagen->ruta = $directorio . "/" . $aleatorio;
		//$ruta = $GuardarImagen->ctrImages(null, null);
		# Si es pdf
		if ($documento['type'] == "application/pdf") {
			$ruta = $GuardarImagen->ctrPDFFiles();
		} else {
			# Si es una imagen
			if (($documento['type'] == "image/jpeg" || $documento['type'] == "image/png")) {
				$ruta = $GuardarImagen->ctrImages(null, null);
			}
		}

		/* ===================================================
			ACTUALIZAR RUTA IMAGEN EN LA BD
		===================================================*/
		if ($ruta != "") {
			$rutaImg = str_replace(DIR_APP, "", $ruta);

			$datosRutaImg = array(
				'tabla' => 'fuec',
				'item1' => 'ruta_contrato',
				'valor1' => $rutaImg,
				'item2' => 'idfuec',
				'valor2' => $idfuec
			);
			$actualizarRutaImg = ModeloFuec::mdlActualizarFUEC($datosRutaImg);
		}
	}
}
