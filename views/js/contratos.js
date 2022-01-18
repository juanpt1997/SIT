/* ===================================================
    * CLIENTES
===================================================*/
if (
    window.location.href == `${urlPagina}contratos-clientes/` ||
    window.location.href == `${urlPagina}contratos-clientes`
) {
    $(document).ready(function () {
        $(document).on("click", ".btn-editarcliente", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

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
                    $("#titulo_clientes").html(
                        "Editar datos de: " + response.nombre
                    );
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
                    $("#correo").val(response.correo);
                    $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT
                },
            });
        });

        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarcliente", function () {
            // Reset id
            $("#idcliente").val("");
            // Reset titulo modal
            $("#titulo_clientes").html("Nuevo cliente");
            // Reset valores del formulario
            if (AbiertoxEditar) {
                // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
                $(".input-clientes").val("");
                $(".select2-single").trigger("change");
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
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
        /* ===================================================
          INICIALIZAR DATATABLE CON FILTRO AVANZADO
        ===================================================*/
        let TablaCotizaciones = () => {
            /* ===================================================
              FILTRAR POR COLUMNA
            ===================================================*/
            /* Filtrar por columna */
            //Clonar el tr del thead
            $(`#tblCotizaciones thead tr`)
                .clone(true)
                .appendTo(`#tblCotizaciones thead`);
            //Por cada th creado hacer lo siguiente
            $(`#tblCotizaciones thead tr:eq(1) th`).each(function (i) {
                //Remover clase sorting y el evento que tiene cuando se hace click
                $(this).removeClass("sorting").unbind();
                //Agregar input de busqueda
                $(this).html(
                    '<input class="form-control" type="text" placeholder="Buscar"/>'
                );
                //Evento para detectar cambio en el input y buscar
                $("input", this).on("keyup change", function () {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });

            /* ===================================================
          Fecha inicio y Fecha fin de los Inputs
        ===================================================*/
            let today = new Date();
            let dateIMin = today.getFullYear() - 1 + "-" + "01" + "-" + "01";
            let dateIMax = today.getFullYear() + 1 + "-" + "12" + "-" + "31";
            let dateFMin = today.getFullYear() + "-" + "01" + "-" + "01";
            let dateFMax = today.getFullYear() + 1 + "-" + "12" + "-" + "31";
            $("#f_inicio").attr("min", dateIMin);
            $("#f_inicio").attr("max", dateIMax);
            $("#f_fin").attr("min", dateFMin);
            $("#f_fin").attr("max", dateFMax);
            /* ===================================================
            INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
            ===================================================*/
            var buttons = [
                {
                    extend: "excel",
                    className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar',
                },
            ];
            var table = dataTableCustom(`#tblCotizaciones`, buttons);
        };
        TablaCotizaciones();

        var ActualizoListaClientes = true;
        $(document).on("click", ".btn-editarcotizacion", function () {
            ActualizoListaClientes = false;
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var idcot = $(this).attr("id_cot");
            $("#id_cot").val(idcot);
            var document = $(this).attr("document");
            $("#pcliente").val("cliente");
            $("#listaclientes").attr("readonly", false);
            //$(".input-clientes").attr("readonly", "readonly");
            //$('.select-ciudad').prop('disabled', true);
            $("#listaclientes").attr("required", "required");
            //$('#listaclientes').prop('disabled', true);

            $(".btn-copy-cotizacion").removeClass("d-none");

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
                    //console.log(response);
                    $("#listaclientes").val(response.idcliente);
                    $("#titulo_cotizacion").html(
                        "Editar cotización ( " + response.nombre + " )"
                    );
                    $("#nom_contrata").val(response.nombre_con);
                    $("#t_document_empre").val(response.tipo_doc_con);
                    $("#document").val(response.documento_con);
                    $("#tel1").val(response.tel_1);
                    $("#direcci").val(response.direccion_con);
                    $("#nom_respo").val(response.nombre_respo);
                    $("#t_document_respo").val(response.tipo_doc_respo);
                    $("#ciudadresponsable").val(response.ciudad_res);
                    $("#ciudadcliente").val(response.ciudad_con);
                    $("#expedicion").val(response.cedula_expedicion);
                    $("#docum_respo").val(response.documento_res);
                    $("#tel2").val(response.tel_2);
                    $("#otro_v").val(response.otro_v);

                    $("#origin").val(response.origen);
                    $("#f_sol").val(response.fecha_solicitud);
                    $("#h_salida").val(response.hora_salida);
                    $("#h_recog").val(response.hora_recogida);
                    $("#capaci").val(response.capacidad);
                    $("#cotiz").val(response.cotizacion);
                    $("#empres").val(response.empresa);
                    $("#destin").val(response.destino);
                    $("#f_resuelve").val(response.fecha_solucion);
                    $("#durac").val(response.duracion);
                    $("#tipovehiculocot").val(response.idtipovehiculo);
                    $("#valor_vel").val(response.valorxvehiculo);
                    $("#clasi_cot").val(response.clasificacion);
                    $("#sucursalcot").val(response.idsucursal);
                    $("#des_sol").val(response.descripcion);
                    //console.log(response.descripcion);
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
                    $(".select-ciudad").trigger("change");
                    $("#listaclientes").trigger("change");
                    $("#idruta").val(response.idruta);
                    $("#descrip").val(response.descripcion);
                    $("#viaje_ocasional").val(response.viaje_ocasional);
                },
            });
        });

        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarcotizacion", function () {
            ActualizoListaClientes = true;
            // Reset valores del formulario
            $("#id_cot").val("");
            $("#titulo_cotizacion").html("Nueva cotización");
            $(".btn-copy-cotizacion").addClass("d-none");
            if (AbiertoxEditar) {
                // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
                $("#formulariocotizacion").trigger("reset");
                $(".select-ciudad").trigger("change");
                $(".select-clientes").trigger("change");
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        });

        $(document).on("change", "#pcliente", function () {
            var cambio = $(this).val();
            // Si selecciona cliente
            if (cambio == "cliente") {
                $("#listaclientes").prop("disabled", false);
                //$("#listaclientes").attr("readonly", false);
                //$(".input-clientes").attr("readonly", "readonly");
                $("#listaclientes").attr("required", "required");
                //$("#ciudadcliente").select2("readonly");
                //$('.select-ciudad').prop('disabled', true);
            }
            // Si selecciona posible cliente
            else {
                $(".input-clientes").val("");
                $("#listaclientes").val("");
                $("#listaclientes").prop("disabled", true);
                //$("#listaclientes").attr("readonly", true);
                $("#listaclientes").trigger("change");
                $(".input-clientes").removeAttr("readonly");
                $("#listaclientes").removeAttr("required");
                //$('.select-ciudad').prop('disabled', false);
                $(".select-ciudad").trigger("change");
            }
        });

        $(document).on("change", "#listaclientes", function () {
            // CONDICION PARA QUE OCURRA UNICAMENTE CUANDO EL USUARIO SELECCIONE UN CLIENTE Y ESTA NO SE MODIFIQUE CUANDO ABRA LA MODAL POR EDITAR
            if (ActualizoListaClientes) {
                var id = $(this).val();

                if (id != "") {
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
                            $("#t_document_respo").val(
                                response.tipo_docrespons
                            );
                            $("#ciudadresponsable").val(
                                response.idciudadrespons
                            );
                            $("#ciudadcliente").val(response.idciudad);
                            $("#expedicion").val(response.cedula_expedidaen);
                            $("#docum_respo").val(response.Documentorespons);
                            $("#tel2").val(response.telefono);
                            $(".select-ciudad").trigger("change"); //MUESTRA EL VALOR DEL SELECT
                        },
                    });
                }
            } else {
                ActualizoListaClientes = true;
            }
        });

        /* ===================================================
          COPIA DE COTIZACION
        ===================================================*/
        $(document).on("click", ".btn-copy-cotizacion", function () {
            $("#id_cot").val(""); //reset id cotizacion
            $("#titulo_cotizacion").html("Nuevo");
            $(".btn-copy-cotizacion").addClass("d-none");
        });

        /* ===================================================
          SELECCIÓN DE RUTA EN COTIZACIONES
        ===================================================*/
        $(document).on("click", ".btn-ruta", function () {
            $("#cotizacionmodal").modal("hide");
            $("#titulo_modal_general").html("Seleccione una ruta");
            $("#tabla_general_rutas").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_principal").html("");

            $(".btnBorrar").addClass("d-none");

            var datos = new FormData();
            datos.append("ListarRutas", "ok");
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbody_principal").html(response);
                    } else {
                        $("#tbody_principal").html("");
                    }
                    var buttons = [
                        {
                            extend: "excel",
                            className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar',
                        },
                        /* 'copy', 'csv', 'excel', 'pdf', 'print' */
                    ];
                    dataTableCustom("#tabla_general_rutas", buttons);
                },
            });
        });

        $(document).on("click", ".btnSeleccionarRuta", function () {
            $("#cotizacionmodal").modal("show");
            $("#modal_general").modal("hide");

            var origen = $(this).attr("origen");
            var destino = $(this).attr("destino");
            var descripcion = $(this).attr("descripcion");
            var id = $(this).attr("idregistro");

            $("#idruta").val(id);
            $("#descrip").val(descripcion);
            $("#origin").val(origen);
            $("#destin").val(destino);
        });

        // $(document).on("click", ".btn_cancelar_ruta", function () {

        //     $("#cotizacionmodal").modal('show');
        //     $("#modal_general").modal('hide');
        //     $("#idruta").val("");
        //     $("#descrip").val("");
        //     $("#origin").val("");
        //     $("#destin").val("");
        // });
        $("#modal_general").on("hidden.bs.modal", function () {
            $("#cotizacionmodal").modal("show");
            $("#modal_general").modal("hide");

            // $("#idruta").val("");
            // $("#observacionescontr").val("");
            // $("#origen").val("");
            // $("#destino").val("");
        });

        /* ===================================================
          VALIDAR CAMPO VACIO DE RUTA
        ===================================================*/
        var guardoCotizacion = false;
        $("#formulariocotizacion").submit(function (e) {
            if (!guardoCotizacion) {
                e.preventDefault();
                if ($("#idruta").val() == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Debe seleccionar una ruta antes de guardar!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    guardoCotizacion = false;
                } else {
                    guardoCotizacion = true;
                    $("#formulariocotizacion").submit();
                    //$(".btn-guardar-cotizacion").click();
                }
            }
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
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var idfijos = $(this).attr("idfijos");
            var idcliente = $(this).attr("idcliente");
            $("#idconfijo").val(idfijos);
            $("#num_contrato").val(idfijos);
            $("#visualizDocumento").text("");

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
                    //$("#num_contrato").val(response.numcontrato);
                    $("#f_inicial_fijos").val(response.fecha_inicial);
                    $("#f_final_fijos").val(response.fecha_final);
                    $("#observaciones_fijos").val(response.observaciones);
                    //$("#documento_es").val(response.documento_escaneado);
                    $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT

                    // Visualizacion contrato adjunto
                    if (response.documento_escaneado != null) {
                        let nombre = response.documento_escaneado.split("/");
                        nombre = nombre[nombre.length - 1];
                        $("#visualizDocumento")
                            .attr(
                                "href",
                                urlPagina + response.documento_escaneado
                            )
                            .text(nombre);
                    }
                },
            });
        });

        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarfijo", function () {
            $("#titulo_fijos").html("Nuevo contrato fijo");
            $(".select2-single").val("").trigger("change");
            $("#visualizDocumento").text("");
            if (AbiertoxEditar) {
                // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
                $(".input-fijos").val("");
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        });

        /* ===================================================
          ? RUTAS
        ===================================================*/
        /* ===================================================
          Evento abrir gestión de rutas para el cliente
        ===================================================*/
        $(document).on("click", ".btn-verRutas", function () {
            var idcliente = $(this).attr("idcliente");
            var nombreCliente = $(this).attr("nombreCliente");

            $("#idclienteRutas").val(idcliente);
            $("#nombreClienteRutas").html(nombreCliente);

            // Reset formulario
            $("#formRutasCliente").trigger("reset");
            $("#idrutacliente").val("");
            $("#idruta").val("");

            // Tabla dinámica de rutas
            AjaxTablaRutasxCliente(idcliente);
        });

        /* ===================================================
          Evento para ver rutas disponibles y agregar una
        ===================================================*/
        $(document).on("click", ".btn-ruta", function () {
            $("#modalRutasCliente").modal("hide");
            $("#titulo_modal_general").html("Seleccione una ruta");
            $("#tabla_general_rutas").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_principal").html("");

            $(".btnBorrar").addClass("d-none");

            var datos = new FormData();
            datos.append("ListarRutas", "ok");
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbody_principal").html(response);
                    } else {
                        $("#tbody_principal").html("");
                    }
                    var buttons = [
                        {
                            extend: "excel",
                            className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar',
                        },
                        /* 'copy', 'csv', 'excel', 'pdf', 'print' */
                    ];
                    dataTableCustom("#tabla_general_rutas", buttons);
                },
            });
        });

        /* ===================================================
          Seleccionar ruta
        ===================================================*/
        $(document).on("click", ".btnSeleccionarRuta", function () {
            //     $("#modalRutasCliente").modal('show');
            $("#modal_general").modal("hide");

            var origen = $(this).attr("origen");
            var destino = $(this).attr("destino");
            var descripcion = $(this).attr("descripcion");
            var id = $(this).attr("idregistro");

            $("#idruta").val(id);
            $("#descripcion").val(descripcion);
            $("#origen").val(origen);
            $("#destino").val(destino);
        });

        /* ===================================================
            Cuando se esconde el modal volver a abrir el anterior      
        ===================================================*/
        $("#modal_general").on("hidden.bs.modal", function () {
            $("#modalRutasCliente").modal("show");
            //$("#modal_general").modal('hide');

            // $("#idruta").val("");
            // $("#descripcion").val("");
            // $("#origen").val("");
            // $("#destino").val("");
        });

        /* ===================================================
          Guardar ruta
        ===================================================*/
        $("#formRutasCliente").submit(function (e) {
            e.preventDefault();
            var datosAjax = new FormData();
            datosAjax.append("GuardarRutaCliente", "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            // VALIDAR QUE LA RUTA NO ESTÉ VACÍA
            if ($("#idruta").val() == "") {
                Swal.fire({
                    icon: "warning",
                    title: "¡Debe seleccionar una ruta antes de guardar!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                /* Guardar */
                $.ajax({
                    type: "post",
                    url: "ajax/contratos.ajax.php",
                    data: datosAjax,
                    /* dataType: "json", */
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        switch (response) {
                            case "existe":
                                Swal.fire({
                                    icon: "warning",
                                    title: "Ya existe otra ruta asociada a este cliente con los mismos datos",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                });
                                break;

                            case "error":
                                Swal.fire({
                                    icon: "error",
                                    title: "Ha ocurrido un error, por favor intente de nuevo",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = window.location;
                                    }
                                });
                                break;

                            default:
                                // Reset formulario
                                $("#formRutasCliente").trigger("reset");
                                $("#idrutacliente").val("");
                                $("#idruta").val("");

                                // Mensaje de éxito al usuario
                                Swal.fire({
                                    icon: "success",
                                    title: "¡Datos guardados correctamente!",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                });

                                // Tabla dinámica de rutas
                                AjaxTablaRutasxCliente(
                                    $("#idclienteRutas").val()
                                );
                                break;
                        }
                    },
                });
            }
        });

        /* ===================================================
          Cargar datos de la ruta asociada en el formulario
        ===================================================*/
        $(document).on("click", ".editarRuta", function () {
            // Reset formulario
            $("#formRutasCliente").trigger("reset");
            $("#idrutacliente").val("");
            $("#idruta").val("");

            var idrutacliente = $(this).attr("idregistro");

            var datos = new FormData();
            datos.append("DatosRutaCliente", "ok");
            datos.append("idrutacliente", idrutacliente);
            $.ajax({
                type: "post",
                url: "ajax/contratos.ajax.php",
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        Swal.fire({
                            icon: "info",
                            title: "Cargando datos",
                            showConfirmButton: false,
                            timer: 1200,
                            timerProgressBar: true,
                            allowOutsideClick: false,
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                setTimeout(() => {
                                    //llevar el scroll al principio
                                    $("#modalRutasCliente").scrollTop(0);
                                }, 300);
                            }
                        });

                        // Cargar datos de la ruta
                        $("#idrutacliente").val(response.idrutacliente);
                        $("#idruta").val(response.idruta);
                        $("#descripcion").val(response.descripcion);
                        $("#origen").val(response.origen);
                        $("#destino").val(response.destino);
                        $("#tipoVehiculo").val(response.idtipovehiculo);
                        $("#valor_recorrido").val(response.valor_recorrido);
                    }
                },
            });
        });

        /* ===================================================
          Eliminar ruta asociada
        ===================================================*/
        $(document).on("click", ".eliminarRuta", function () {
            var idrutacliente = $(this).attr("idregistro");

            Swal.fire({
                icon: "warning",
                title: "¿Está seguro de que desea eliminar esta ruta?",
                showConfirmButton: true,
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Borrar!",
                cancelButtonColor: "#5cb85c",
                confirmButtonColor: "#d9534f",
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append("EliminarRutaCliente", "ok");
                    datos.append("idrutacliente", idrutacliente);
                    $.ajax({
                        type: "post",
                        url: "ajax/contratos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: "success",
                                    title: "Datos eliminados con éxito",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (
                                        result.dismiss ===
                                        Swal.DismissReason.timer
                                    ) {
                                        // Tabla dinámica de rutas
                                        AjaxTablaRutasxCliente(
                                            $("#idclienteRutas").val()
                                        );
                                    }
                                });
                            }
                        },
                    });
                }
            });
        });

        /* ===================================================
          Función para cargar tabla de las rutas que tiene asociadas el cliente
        ===================================================*/
        /* ===================================================
            TABLA RUTAS X CLIENTE
        ===================================================*/
        const AjaxTablaRutasxCliente = (idcliente) => {
            // Quitar datatable
            $("#tblRutasxCliente").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyRutasxCliente").html("");

            let datos = new FormData();
            datos.append("TablaRutasxCliente", "ok");
            datos.append("idcliente", idcliente);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/contratos.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodyRutasxCliente").html(response);
                    } else {
                        $("#tbodyRutasxCliente").html("");
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    var buttons = [
                        {
                            extend: "excel",
                            className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tblRutasxCliente`, buttons);
                },
            });
        };

        /*==============================
            CARGAR DATOS DEL VEHÍCULO
        ================================*/

        $(document).on("change", "#placa_contrutas", function () {

            let idvehiculo = $(this).val();

            var datos = new FormData();
            datos.append("DatosVehiculo", "ok");
            datos.append("item", "idvehiculo");
            datos.append("valor", idvehiculo);

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    let datosVehiculo = response.datosVehiculo
                    $("#num_internocontrutas").val(datosVehiculo.numinterno);
                    $("#marca_contrutas").val(datosVehiculo.marca);
                    $("#clase_contrutas").val(datosVehiculo.tipovehiculo);
                    $("#modelo_contrutas").val(datosVehiculo.modelo);
                    $("#kilometraje_contrutas").val(datosVehiculo.kilometraje);
                },
            });
        });

        /*============================================
        CLICK EN VER VEHÍCULOS CLIENTES / CARGA TABLA
        ==============================================*/
        $(document).on("click", ".btn-verVehiculosRutas",function(){
            let idcliente = $(this).attr("idcliente");
            $(".btn-guardarvehiculosclientes").attr("idcliente", idcliente);

            var datos = new FormData();
            datos.append("CargarTablaVehiculosClientes", "ok");
            datos.append("idcliente", idcliente);

            $.ajax({
                type: "post",
                url: "ajax/contratos.ajax.php",
                data: datos,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response != ""){
                        $("#tbodyresuRutasContratos").html(response);
                    }else{
                        $("#tbodyresuRutasContratos").html("");
                    }
                },
            });




        });

        /*==============================================
            GUARDAR / ASOCIAR VEHÍCULO A CLIENTE
        ===============================================*/
        $("#form_contrutas").submit(function (e){
            e.preventDefault();

            let idcliente = $(".btn-guardarvehiculosclientes").attr("idcliente");

            
            var datosFrm = $(this).serializeArray();
            var datosAjax = new FormData();
            datosAjax.append("Guardar_VehiculoCliente", "ok");
            datosAjax.append("idcliente", idcliente);

            
           

            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });


            $.ajax({
                type: "post",
                url: "ajax/contratos.ajax.php",
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    
                    if(response != "error"){
                        Swal.fire({
                            icon: "success",
                            title: "¡Datos guardados correctamente!",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "¡Este vehículo ya se encuentra asociado a un cliente!",
                            showConfirmButton: false
                        });
                    }
                },
            });

        

        });
        
        /*============================================
            ELIMINAR VEHICULO A UN CLIENTE
        ==============================================*/
        $(document).on("click",".btnEliminarVehiculoRuta", function(){
            let idvehiculo = $(this).attr("idvehiculo");
            let idcliente = $(this).attr("idcliente");

            Swal.fire({
                icon: "warning",
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea eliminar este vehículo?",
                confirmButtonText: "Si, eliminar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#0080ff",
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value == true) {

                    var datos = new FormData();
                    datos.append("EliminarVehiculoCliente", "ok");
                    datos.append("idcliente", idcliente);
                    datos.append("idvehiculo", idvehiculo);
                    

                    $.ajax({
                        type: "POST",
                        url: "ajax/contratos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: "success",
                                    showConfirmButton: true,
                                    title: "¡El registro ha sido borrado correctamente!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false,
                                }).then((result) => {
                                    window.location = "contratos-fijos";
                                });
                            }
                        },
                    });
                }
            });
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
    $(document).ready(function () {
        /* ===================================================
              INICIALIZAR DATATABLE CON FILTRO AVANZADO
            ===================================================*/
        let TablaOrdenServicio = () => {
            /* ===================================================
              FILTRAR POR COLUMNA
            ===================================================*/
            /* Filtrar por columna */
            //Clonar el tr del thead
            $(`#tblOrdenServicio thead tr`)
                .clone(true)
                .appendTo(`#tblOrdenServicio thead`);
            //Por cada th creado hacer lo siguiente
            $(`#tblOrdenServicio thead tr:eq(1) th`).each(function (i) {
                //Remover clase sorting y el evento que tiene cuando se hace click
                $(this).removeClass("sorting").unbind();
                //Agregar input de busqueda
                $(this).html(
                    '<input class="form-control" type="text" placeholder="Buscar"/>'
                );
                //Evento para detectar cambio en el input y buscar
                $("input", this).on("keyup change", function () {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });

            /* ===================================================
            INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
            ===================================================*/
            var buttons = [
                {
                    extend: "excel",
                    className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar',
                },
            ];
            var table = dataTableCustom(`#tblOrdenServicio`, buttons);
        };
        TablaOrdenServicio();

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
                    $("#nomcontrataorden").val(response.nombre_con);
                    $("#documentorden").val(response.documento_con);
                    $("#direcciorden").val(response.direccion_con);
                    $("#telefono1").val(response.tel_1);
                    $("#telefono2").val(response.tel_2);
                    $("#nomcontacto").val(response.nombre_respo);
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
                    //$(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT ***Por favor no
                },
            });
        });

        //BOTON EDITAR ORDEN DE SERVICIO
        $(document).on("click", ".btn-editarorden", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

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
                    $("#titulo_orden").html(
                        "Editar órden (# " +
                            response.nro_contrato +
                            " - " +
                            response.nombre_con +
                            ")"
                    );
                    $("#listacotizaciones").val(response.idcotizacion);
                    $("#numcontrato").val(response.nro_contrato);
                    $("#numfacturaorden").val(response.nro_factura);
                    $("#f_facturacion").val(response.fecha_facturacion);
                    $("#cancelacion").val(response.cancelada);
                    $("#cod_autorizacion").val(response.cod_autoriz);
                    //$("#viaje_ocasional").val(response.viaje_ocasional);
                    $(".select2-single").trigger("change"); //MUESTRA EL VALOR DEL SELECT
                },
            });
        });

        //BOTON AGREGAR UNA NUEVA ORDEN DE SERVICIO
        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarorden", function () {
            // Reset valores del formulario
            $("#idorden").val("");
            $("#titulo_orden").html("Nueva órden de servicio");
            if (AbiertoxEditar) {
                // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
                $("#formulario_orden").trigger("reset");
                $(".select2-single").trigger("change");
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        });

        /* ===================================================
               VISUALIZAR PDF DE LA ORDEN DE SERVICIO
             ===================================================*/
        $(document).on("click", ".btn-verorden", function () {
            var idorden = $(this).attr("idorden");
            window.open(
                `./pdf/pdfordenservicio.php?idorden=${idorden}`,
                "",
                "width=1280,height=720,left=50,top=50,toolbar=yes"
            );
        });
    });
}
