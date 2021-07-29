/* ===================================================
    * CLIENTES
===================================================*/
if (
  window.location.href == `${urlPagina}contratos-clientes/` ||
  window.location.href == `${urlPagina}contratos-clientes`
) {
  $(document).ready(function () {
    $(document).on("click", ".btn-editarcliente", function () {
      var idcliente = $(this).attr("idcliente");
      $("#idcliente").val(idcliente);
      var document = $(this).attr("docum");

      var datos = new FormData();
      datos.append("DatosClientes", "ok");
      datos.append("item", "Documento");
      datos.append("valor", document);
      $.ajax({
        type: "POST",
        url: "ajax/contratos.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $("#titulo_clientes").html("Editar datos de: " + response.nombre);
          $("#nom_empre").val(response.nombre);
          $("#t_document_empre").val(response.tipo_doc);
          $("#docum_empre").val(response.Documento);
          $("#telclient").val(response.telefono);
          $("#telclient2").val(response.telefono2);
          $("#dir_empre").val(response.direccion);
          $("#nom_respo").val(response.nombrerespons);
          $("#t_document_respo").val(response.tipo_docrespons);
          $("#ciudadresponsable").val(response.idciudadrespons);
          $("#ciudadcliente").val(response.idciudad);
          $("#expedicion").val(response.cedula_expedidaen);
          $("#docum_respo").val(response.Documentorespons);
          $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT
        },
      });
    });
    $(document).on("click", ".btn-agregarcliente", function () {
      // Reset valores del formulario
      $(".input-clientes").val("");
      $("#idcliente").val("");
      $("#titulo_clientes").html("Nuevo cliente");
      $(".select2-single").trigger("change");
    });

    $(document).on("click", ".btn-estado", function () {
      var id = $(this).attr("idcliente");

      var datos = new FormData();
      datos.append("ConvertirCliente", "ok");
      datos.append("value", id);
      $.ajax({
        type: "POST",
        url: "ajax/contratos.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response == "ok") {
            Swal.fire({
              icon: "success",
              title: "¡Cliente actualizado con exito!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            }).then((result) => {
              window.location = "contratos-clientes";
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "¡Error al actualizar cliente!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            });
          }
        },
      });
    });
  });
}
/* ===================================================
    * COTIZACIONES
===================================================*/
if (
  window.location.href == `${urlPagina}contratos-cotizaciones/` ||
  window.location.href == `${urlPagina}contratos-cotizaciones`
) {
  $(document).ready(function () {
    $(document).on("click", ".btn-editarcotizacion", function () {
      var idcot = $(this).attr("id_cot");
      $("#id_cot").val(idcot);
      var document = $(this).attr("document");
      $("#pcliente").val("cliente");
      $("#listaclientes").attr("readonly", false);
      $(".input-clientes").attr("readonly", "readonly");
      $("#listaclientes").attr("required", "required");

      var datos = new FormData();
      datos.append("DatosCotizaciones", "ok");
      datos.append("value", idcot);
      $.ajax({
        type: "POST",
        url: "ajax/contratos.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $("#listaclientes").val(response.idcliente);
          $("#titulo_cotizacion").html(
            "Editar cotización ( " + response.nombre + " )"
          );
          $("#nom_contrata").val(response.nombre);
          $("#t_document_empre").val(response.tipo_doc);
          $("#t_document_respo").val(response.tipo_docrespons);
          $("#document").val(response.Documento);
          $("#direcci").val(response.direccion);
          $("#ciudadcliente").val(response.idciudad);
          $("#nom_respo").val(response.nombrerespons);
          $("#docum_respo").val(response.Documentorespons);
          $("#ciudadresponsable").val(response.idciudadrespons);
          $("#expedicion").val(response.cedula_expedidaen);
          $("#origin").val(response.origen);
          $("#f_sol").val(response.fecha_solicitud);
          $("#h_salida").val(response.hora_salida);
          $("#h_recog").val(response.hora_recogida);
          $("#capaci").val(response.capacidad);
          $("#cotiz").val(response.cotizacion);
          $("#tel1").val(response.telefono);
          $("#empres").val(response.empresa);
          $("#destin").val(response.destino);
          $("#f_resuelve").val(response.fecha_solucion);
          $("#durac").val(response.duracion);
          $("#tipovehiculocot").val(response.idtipovehiculo);
          $("#valor_vel").val(response.valorxvehiculo);
          $("#clasi_cot").val(response.clasificacion);
          $("#tel2").val(response.telefono2);
          $("#sucursalcot").val(response.idsucursal);
          $("#des_sol").val(response.descripcion);
          $("#f_inicio").val(response.fecha_inicio);
          $("#f_fin").val(response.fecha_fin);
          $("#n_vehiculos").val(response.nro_vehiculos);
          $("#vtotal").val(response.valortotal);
          $("#music").val(response.musica);
          $("#bodeg").val(response.bodega);
          $("#another").val(response.otro);
          $("#air").val(response.aire);
          $("#baño").val(response.bano);
          $("#realizav").val(response.realiza_viaje);
          $("#wi_fi").val(response.wifi);
          $("#silleteriar").val(response.silleriareclinable);
          $("#porque").val(response.porque);
          $(".select2-single").trigger("change");
        },
      });
    });
    $(document).on("click", ".btn-agregarcotizacion", function () {
      // Reset valores del formulario
      $("#formulariocotizacion").trigger("reset");
      $("#id_cot").val("");
      $("#titulo_cotizacion").html("Nueva cotización");
      $(".select2-single").trigger("change");
    });

    $(document).on("change", "#pcliente", function () {
      var cambio = $(this).val();
      // Si selecciona cliente
      if (cambio == "cliente") {
        $("#listaclientes").attr("readonly", false);
        $(".input-clientes").attr("readonly", "readonly");
        $("#listaclientes").attr("required", "required");
        $("#ciudadcliente").select2("readonly");
      }
      // Si selecciona posible cliente
      else {
        $(".input-clientes").val("");
        $("#listaclientes").val("");
        $("#listaclientes").attr("readonly", true);
        $(".input-clientes").removeAttr("readonly");
        $("#listaclientes").removeAttr("required");
        $(".select2-single").trigger("change");
      }
    });

    $(document).on("change", "#listaclientes", function () {
      var id = $(this).val();

      var datos = new FormData();
      datos.append("DatosClientes", "ok");
      datos.append("item", "idcliente");
      datos.append("valor", id);
      $.ajax({
        type: "POST",
        url: "ajax/contratos.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $("#nom_contrata").val(response.nombre);
          $("#t_document_empre").val(response.tipo_doc);
          $("#document").val(response.Documento);
          $("#tel1").val(response.telefono);
          $("#direcci").val(response.direccion);
          $("#nom_respo").val(response.nombrerespons);
          $("#t_document_respo").val(response.tipo_docrespons);
          $("#ciudadresponsable").val(response.idciudadrespons);
          $("#ciudadcliente").val(response.idciudad);
          $("#expedicion").val(response.cedula_expedidaen);
          $("#docum_respo").val(response.Documentorespons);
          $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT
        },
      });
    });
  });
}
/* ===================================================
    * FIJOS
===================================================*/
if (
  window.location.href == `${urlPagina}contratos-fijos/` ||
  window.location.href == `${urlPagina}contratos-fijos`
) {
  $(document).ready(function () {
    $(document).on("click", ".btn-editarfijo", function () {
      var idfijos = $(this).attr("idfijos");
      var idcliente = $(this).attr("idcliente");
      $("#idconfijo").val(idfijos);

      var datos = new FormData();
      datos.append("DatosFijos", "ok");
      datos.append("value", idfijos);

      $.ajax({
        type: "POST",
        url: "ajax/contratos.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          console.log(response.observaciones);

          $("#titulo_fijos").html(
            "Editar (Contrato # " +
              response.numcontrato +
              " - " +
              response.nombre_cliente +
              ")"
          );
          $("#nom_clien").val(response.idcliente);
          $("#num_contrato").val(response.numcontrato);
          $("#f_inicial_fijos").val(response.fecha_inicial);
          $("#f_final_fijos").val(response.fecha_final);
          $("#observaciones_fijos").val(response.observaciones);
          //$("#documento_es").val(response.documento_escaneado);
          $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT
        },
      });
    });

    $(document).on("click", ".btn-agregarfijo", function () {
      $("#titulo_fijos").html("Nuevo contrato fijo");
      $(".input-fijos").val("");
    });
  });
}
/* ===================================================
    * ORDEN DE SERVICIO
===================================================*/
if (
  window.location.href == `${urlPagina}contratos-ordenservicio/` ||
  window.location.href == `${urlPagina}contratos-ordenservicio`
) {
  //SELECCIONAR UNA COTIZACION PARA TRAER LOS DATOS DE ESA COTIZACION Y DEL CLIENTE
  $(document).on("change", "#listacotizaciones", function () {
    var idcotizacion = $(this).val();

    var datos = new FormData();
    datos.append("DatosCotizaciones", "ok");
    datos.append("value", idcotizacion);
    $.ajax({
      type: "POST",
      url: "ajax/contratos.ajax.php",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        $("#nomcontrataorden").val(response.nombre);
        $("#documentorden").val(response.Documento);
        $("#direcciorden").val(response.direccion);
        $("#telefono1").val(response.telefono);
        $("#telefono2").val(response.telefono2);
        $("#nomcontacto").val(response.nombrerespons);
        //$("#numcontrato").val(response.tipo_docrespons);
        $("#h_incio_orden").val(response.hora_salida);
        $("#h_final_orden").val(response.hora_recogida);
        $("#f_inicio_orden").val(response.fecha_inicio);
        $("#f_fin_orden").val(response.fecha_fin);
        $("#valor_facturar").val(response.valortotal);
        $("#origen_orden").val(response.origen);
        $("#destino_orden").val(response.destino);
        $("#ruta_orden").val(response.descripcion);
        $("#musica_orden").val(response.musica);
        $("#bodega_orden").val(response.bodega);
        $("#aire").val(response.aire);
        $("#otro_orden").val(response.otro);
        $("#baño").val(response.bano);
        $("#wi_fi").val(response.wifi);
        $("#silleteria_orden").val(response.silleriareclinable);
        $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT
      },
    });
  });

  //BOTON EDITAR ORDEN DE SERVICIO
  $(document).on("click", ".btn-editarorden", function () {
    var idorden = $(this).attr("idorden");
    $("#idorden").val(idorden);

    var datos = new FormData();
    datos.append("DatosOrden", "ok");
    datos.append("value", idorden);
    $.ajax({
      type: "POST",
      url: "ajax/contratos.ajax.php",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (response) {
        $("#titulo_orden").html("Editar órden (# "+response.nro_contrato+" - "+response.nombre+")");
        $("#listacotizaciones").val(response.idcotizacion);
        $("#numcontrato").val(response.nro_contrato);
        $("#numfacturaorden").val(response.nro_factura);
        $("#f_facturacion").val(response.fecha_facturacion);
        $("#cancelacion").val(response.cancelada);
        $("#cod_autorizacion").val(response.cod_autoriz);
        $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT
      },
    });
  });

  //BOTON AGREGAR UNA NUEVA ORDEN DE SERVICIO
  $(document).on("click", ".btn-agregarorden", function () {
    // Reset valores del formulario
    $("#formulario_orden").trigger("reset");
    $("#idorden").val("");
    $("#titulo_orden").html("Nueva órden de servicio");
    $(".select2-single").trigger("change");
  });
}
