/* ===================================================
    * CLIENTES
===================================================*/
if (window.location.href == `${urlPagina}contratos-clientes/` ||
    window.location.href == `${urlPagina}contratos-clientes`
) {
    $(document).ready(function () {

        $(document).on("click", ".btn-editarcliente", function () {

            var idcliente = $(this).attr("idcliente");
            $("#idcliente").val(idcliente);
            var document = $(this).attr("docum");

            var datos = new FormData();
            datos.append("DatosClientes", "ok");
            datos.append("value", document);
            $.ajax({
                type: "POST",
                url: "ajax/contratos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#titulo_clientes").html("Datos de: " + response.nombre);
                    $("#nom_empre").val(response.nombre);
                    $("#t_document_empre").val(response.tipo_doc);
                    $("#docum_empre").val(response.Documento);
                    $("#telclient").val(response.telefono);
                    $("#dir_empre").val(response.direccion);
                    $("#nom_respo").val(response.nombrerespons);
                    $("#t_document_respo").val(response.tipo_docrespons);
                    $("#ciudadresponsable").val(response.idciudadrespons);
                    $("#ciudadcliente").val(response.idciudad);
                    $("#expedicion").val(response.cedula_expedidaen);
                    $("#docum_respo").val(response.Documentorespons);
                    $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT 
                }
            });
        });
        $(document).on("click", ".btn-agregarcliente", function () {
            // Reset valores del formulario
            $(".input-clientes").val("");
            $("#idcliente").val("");
            $("#titulo_clientes").html("Nuevo cliente");
        });
    });
}
/* ===================================================
    * COTIZACIONES
===================================================*/
if (window.location.href == `${urlPagina}contratos-cotizaciones/` ||
    window.location.href == `${urlPagina}contratos-cotizaciones`
) {
    $(document).ready(function () {

        $(document).on("click", ".btn-editarcotizacion", function () {

            var idcot = $(this).attr("id_cot");
            $("#id_cot").val(idcot);
            var document = $(this).attr("document");

            var datos = new FormData();
            datos.append("DatosCotizaciones", "ok");
            datos.append("value", document);
            $.ajax({
                type: "POST",
                url: "ajax/contratos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#titulo_cotizacion").html("Datos de: " + response.nomcontratante);
                    $("#nom_contrata").val(response.nomcontratante);
                    $("#document").val(response.Documento);
                    $("#direcci").val(response.direccion);
                    $("#nom_contact").val(response.nomcontacto);
                    $("#origin").val(response.origen);
                    $("#f_sol").val(response.fecha_solicitud);
                    $("#h_salida").val(response.hora_salida);
                    $("#h_recog").val(response.hora_recogida);
                    $("#capaci").val(response.capacidad);
                    $("#cotiz").val(response.cotizacion);
                    $("#tel1").val(response.telefono1);
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
                }
            });
        });
        $(document).on("click", ".btn-agregarcotizacion", function () {
            // Reset valores del formulario
            $("#formulariocotizacion").val("");
            $("#id_cot").val("");
            $("#titulo_cotizacion").html("Nueva cotización");
        });
    });
}
