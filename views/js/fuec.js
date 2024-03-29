$(document).ready(function () {
    /* ===================================================
        * FUEC
    ===================================================*/
    if (
        window.location.href == `${urlPagina}o-fuec/` ||
        window.location.href == `${urlPagina}o-fuec`
    ) {
        /* ===================================================
          INICIALIZAR DATATABLE
        ===================================================*/
        /* Filtrar por columna */
        //Clonar el tr del thead
        $(`#tblFUEC thead tr`).clone(true).appendTo(`#tblFUEC thead`);
        //Por cada th creado hacer lo siguiente
        $(`#tblFUEC thead tr:eq(1) th`).each(function (i) {
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
        var buttons = [
            {
                extend: "excel",
                className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar',
            },
            /* 'copy', 'csv', 'excel', 'pdf', 'print' */
        ];
        var table = dataTableCustom(`#tblFUEC`, buttons);

        /* ===================================================
          VISUALIZAR PDF DEL FUEC
        ===================================================*/
        $(document).on("click", ".btn-FTFuec", function () {
            var idfuec = $(this).attr("idfuec");
            window.open(
                `./pdf/pdffuec.php?cod=${idfuec}`,
                "",
                "width=1280,height=720,left=50,top=50,toolbar=yes"
            );
        });

        /* ===================================================
          DETECTA CAMIO EN TIPO DE CONTRATO
        ===================================================*/
        $(document).on("change", "#tipocontrato", function () {
            var tipocontrato = $(this).val();

            // Si el tipo contrato es igual a fijo, oculta los campos contratante
            if (tipocontrato == "FIJO") {
                $("#colContratoFijo").removeClass("d-none"); // Muestra el select de fijos
                $("#contratofijo").attr("required", "required"); // Vuelvo obligatorios el select de fijos

                $("#colContratante").addClass("d-none"); // Esconde el select de contratante
                $("#contratante").val("").removeAttr("required"); // Reset valor de contratante y le remuevo lo de obligatorio
                $(".row-cliente").addClass("d-none"); // Esconde los campos del cliente
                $(".input-clientes").val(""); // Reseteo los input que contienen los datos del cliente
                $(".input-ordenservicio").val("").removeAttr("readonly"); // Reset los campos que se traen de la orden de servicio y los dejo editables
                $(".select2-single").trigger("change"); //ACTUALIZA EL VALOR DEL SELECT

                /* Seleccionar tipo de contrato, remover readonly */
                $("#objetocontrato").val("").removeAttr("readonly");
            } else {
                if (tipocontrato == "OCASIONAL") {
                    $("#colContratoFijo").addClass("d-none"); // Esconde el select de fijos
                    $("#contratofijo").val("").removeAttr("required"); // Reset valor de fijos y lo vuelvo obligatorio

                    $("#colContratante").removeClass("d-none"); // Muestra el select de contratante
                    $("#contratante").attr("required", "required"); // Vuelvo obligatorios el select de contratante
                    $(".row-cliente").removeClass("d-none"); // Muestra los campos de cliente
                    $(".input-ordenservicio").attr("readonly", "readonly"); // Hago que los campos de orden de servicio sean unicamente de lectura
                    $(".select2-single").trigger("change"); //ACTUALIZA EL VALOR DEL SELECT

                    /* Seleccionar tipo de contrato, es readonly en este caso y solo permite una opción */
                    $("#objetocontrato").val(4).attr("readonly", "readonly");
                    $("#anotObjetoContrato").val("").attr("readonly", "readonly"); // Anotación objeto de contrato no se permite con uno ocasional
                }
            }
        });

        /* ===================================================
          DETECTA SELECCIÓN DE UN VEHICULO
        ===================================================*/
        var actualizo = true; // Booleano explicado más abajo
        $(document).on("change", "#vehiculofuec", function () {
            var idvehiculo = $(this).val();
            var $select = $(this);

            /* Esta condicion sirve para ejecutar el evento unicamente cuando de verdad seleccione un vehiculo porque puede ocurrir que el select sea modificado internamente con $select.trigger('change')*/
            if (actualizo) {
                if (idvehiculo != "") {
                    $select.val("");

                    // Reviso si el vehículo tiene bloqueo y los documentos estan al dia
                    var datos = new FormData();
                    datos.append("VehiculoDisponible", "ok");
                    datos.append("idvehiculo", idvehiculo);
                    $.ajax({
                        type: "post",
                        url: `${urlPagina}ajax/fuec.ajax.php`,
                        data: datos,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (
                                response.DocumentosVencidos == "" &&
                                response.Bloqueo == "NO"
                            ) {
                                $select.val(idvehiculo);

                                // Actualice la lista de conductores
                                FuncionCargarConductores(idvehiculo);

                                // Validar fecha de vencimiento contrato fuec con el vencimiento de los documentos del vehiculo
                                FuncionValidarFechaVencimiento();
                            } else {
                                if (response.DocumentosVencidos != "") {
                                    let listaVencidosHtml = `<ul>`;
                                    response.DocumentosVencidos.forEach(
                                        (element) => {
                                            let fechaVencido =
                                                element.fechafin == null
                                                    ? "Sin fecha"
                                                    : element.fechafin;
                                            listaVencidosHtml += `<li>${element.tipodocumento} -> ${fechaVencido}</li>`;
                                        }
                                    );
                                    listaVencidosHtml += `</ul>`;

                                    Swal.fire({
                                        icon: "warning",
                                        html: `<div class="text-left">
                                                <p class="font-weight-bold">No es posible seleccionar este vehículo debido a que no están al día los siguientes documentos:</p>
                                                    ${listaVencidosHtml}
                                            </div>`,
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                    });
                                    $(".conductores").empty();
                                    actualizo = false;
                                    $select.trigger("change"); //MUESTRA EL VALOR DEL SELECT
                                } else {
                                    Swal.fire({
                                        icon: "warning",
                                        html: `<div class="text-left">
                                                <p class="font-weight-bold">El vehículo se encuentra bloqueado por el siguiente motivo: </p>
                                                <li>${response.Bloqueo.motivo}</li>
                                            </div>`,
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                    });
                                    $(".conductores").empty();
                                    actualizo = false;
                                    $select.trigger("change"); //MUESTRA EL VALOR DEL SELECT
                                }
                            }
                            //console.log(response.DocumentosVencidos);
                        },
                    });
                } else {
                    // Esto se ejecuta para resetear los conductores
                    FuncionCargarConductores(idvehiculo);
                }
            } else {
                actualizo = true;
            }
        });

        let FuncionCargarConductores = (idvehiculo) => {
            $(".conductores").empty();

            if (idvehiculo != "") {
                var datos = new FormData();
                datos.append("ListaConductores", "ok");
                datos.append("idvehiculo", idvehiculo);
                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/fuec.ajax.php`,
                    data: datos,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                        if (response != "") {
                            response.forEach((element) => {
                                htmlSelect += `<option class="op-conductor" value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                            });
                        }
                        $(".conductores").html(htmlSelect);
                        $("#Observador-conductoresxvehiculo").trigger("change");
                    },
                });
            } else {
                $(".conductores").html(
                    `<option value="" selected>-Seleccione un conductor</option>`
                );
            }
        };
        /* ===================================================
          DETECTA SELECCIÓN DE UN CONDUCTOR
        ===================================================*/
        var actualizoSelectConductor = true;
        $(document).on("change", ".conductores", function () {
            var idconductor = $(this).val();
            var $select = $(this);

            /* Esta condicion sirve para ejecutar el evento unicamente cuando de verdad seleccione un vehiculo porque puede ocurrir que el select sea modificado internamente con $select.trigger('change')*/
            if (actualizoSelectConductor) {
                if (idconductor != "" && idconductor != null) {
                    $select.val("");

                    // Reviso si el vehículo tiene bloqueo y los documentos estan al dia
                    var datos = new FormData();
                    datos.append("ConductorDisponible", "ok");
                    datos.append("idconductor", idconductor);
                    $.ajax({
                        type: "post",
                        url: `${urlPagina}ajax/fuec.ajax.php`,
                        data: datos,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (
                                response.Bloqueo == "NO" &&
                                response.PagoSS == "SI" &&
                                response.LicenciaActiva == "SI"
                            ) {
                                $select.val(idconductor);

                                // MOSTRAR ALERTA CON LAS OBSERVACIONES QUE SE TIENEN ALMACENADAS DEL CONDUCTOR
                                // Swal.fire({
                                //         title: 'Observaciones conductor',
                                //         text: `${$('option:selected', $select).attr('observaciones')}`,
                                //         showConfirmButton: true,
                                //         confirmButtonText: 'Cerrar',
                                //         closeOnConfirm: false
                                //     });
                            } else {
                                if (response.PagoSS == "NO") {
                                    Swal.fire({
                                        icon: "warning",
                                        text: "No es posible seleccionar un conductor que no haya pagado la seguridad social",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                    });
                                    actualizoSelectConductor = false;
                                    $select.trigger("change"); //MUESTRA EL VALOR DEL SELECT
                                } else {
                                    if (response.LicenciaActiva == "NO") {
                                        Swal.fire({
                                            icon: "warning",
                                            text: "No es posible seleccionar un conductor que no tenga la licencia de conducción al día",
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false,
                                        });
                                        actualizoSelectConductor = false;
                                        $select.trigger("change"); //MUESTRA EL VALOR DEL SELECT
                                    } else {
                                        Swal.fire({
                                            icon: "warning",
                                            html: `<div class="text-left">
                                                    <p class="font-weight-bold">El conductor se encuentra bloqueado por el siguiente motivo: </p>
                                                    <li>${response.Bloqueo.motivo}</li>
                                                </div>`,
                                            showConfirmButton: true,
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false,
                                        });
                                        actualizoSelectConductor = false;
                                        $select.trigger("change"); //MUESTRA EL VALOR DEL SELECT
                                    }
                                }
                            }
                        },
                    });
                }
            } else {
                actualizoSelectConductor = true;
            }
        });

        /* ===================================================
          Fecha inicio y Fecha fin de los Inputs
        ===================================================*/
        let today = new Date();
        let dateIMin = today.getFullYear() - 1 + "-" + "01" + "-" + "01";
        let dateIMax = today.getFullYear() + 1 + "-" + "12" + "-" + "31";
        let dateFMin = today.getFullYear() + "-" + "01" + "-" + "01";
        let dateFMax = today.getFullYear() + 1 + "-" + "12" + "-" + "31";
        $("#fechaini").attr("min", dateIMin);
        $("#fechaini").attr("max", dateIMax);
        $("#fechafin").attr("min", dateFMin);
        $("#fechafin").attr("max", dateFMax);

        /* ===================================================
          DETECTA CAMBIO EN UN CONTRATANTE PARA CARGAR LOS DATOS DE LA ORDEN DE SERVICIO
        ===================================================*/
        $(document).on("change", "#contratante", function () {
            var actualizoDatoscliente = $(this).attr("actualizo");
            if (actualizoDatoscliente == "SI") {
                var idorden = $(this).val();
                if (idorden != "") {
                    var datos = new FormData();
                    datos.append("DatosOrden", "ok");
                    datos.append("value", idorden);
                    $.ajax({
                        type: "POST",
                        url: `${urlPagina}ajax/contratos.ajax.php`,
                        data: datos,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Datos cliente
                            $("#docum_empre").val(response.documento_con);
                            $("#dir_empre").val(response.direccion_con);
                            $("#telefono_empre").val(response.tel_1);
                            $("#nom_respo").val(response.nombre_con);
                            $("#docum_respo").val(response.documento_con);
                            $("#dir_respo").val(response.direccion_con);
                            $("#telefono_cliente").val(response.tel_1);
                            $("#ciudad_cliente").val(response.ciudadrespons);
                            $("#expedicion_doccliente").val(
                                response.ciudad_cedula_expedidaen
                            );

                            // Datos cotizacion
                            $("#fechaini").val(response.fecha_inicio);
                            $("#fechafin").val(response.fecha_fin);
                            FuncionValidarFechaVencimiento();
                            $("#origen").val(response.origen);
                            $("#destino").val(response.destino);
                            $("#observacionescontr").val(response.descripcion);
                            $("#idruta").val(response.idruta).trigger("change");
                            $("#valorneto").val(response.valortotal);
                        },
                    });
                }
            } else {
                $(this).attr("actualizo", "SI");
            }
        });

        /* ===================================================
          CUANDO ESCRIBE FECHA DE VENCIMIENTO ESTA NO PUEDE SUPERAR EL VENCIMIENTO DE LA DE ALGUNO DE LOS DOCUMENTOS DEL VEHICULO
        ===================================================*/
        $(document).on("blur", "#fechafin", function () {
            FuncionValidarFechaVencimiento();
        });
        let FuncionValidarFechaVencimiento = () => {
            var fecha = $("#fechafin").val();
            var idvehiculo = $("#vehiculofuec").val();

            if (fecha != "" && idvehiculo != "") {
                var datos = new FormData();
                datos.append("ValidarFechaVencimientoFuec", "ok");
                datos.append("fecha", fecha);
                datos.append("idvehiculo", idvehiculo);
                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/fuec.ajax.php`,
                    data: datos,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.DocumentosxVencer != "") {
                            let listaVencidosHtml = `<ul>`;
                            response.DocumentosxVencer.forEach((element) => {
                                let fechaVencido =
                                    element.fechafin == null
                                        ? "Sin fecha"
                                        : element.fechafin;
                                listaVencidosHtml += `<li>${element.tipodocumento} -> ${fechaVencido}</li>`;
                            });
                            listaVencidosHtml += `</ul>`;

                            Swal.fire({
                                icon: "warning",
                                html: `<div class="text-left">
                                                    <p class="font-weight-bold">Debe modificar la fecha de vencimiento porque los siguientes documentos estarán vencidos:</p>
                                                        ${listaVencidosHtml}
                                                </div>`,
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                            });
                            $("#vehiculofuec").val("");
                            actualizoSelectConductor = false;
                            $(".conductores").empty();
                            actualizo = false;
                            $("#vehiculofuec").trigger("change"); //MUESTRA EL VALOR DEL SELECT
                        }
                    },
                });
            }
        };

        /* ===================================================
          DETECTA CAMBIO EN OBJETO DE CONTRATO
        ===================================================*/
        $(document).on("change", "#objetocontrato", function () {
            let idobjeto_contrato = $(this).val();

            // Si es transporte de estudiantes, permitimos la anotación del objeto de contrato
            if (idobjeto_contrato != 1){
                $("#anotObjetoContrato").val("").attr("readonly", "readonly");
            }else{
                $("#anotObjetoContrato").removeAttr("readonly");
            }
        });

        /* ===================================================
          GUARDAR FORMULARIO FUEC
        ===================================================*/
        $("#frmFUEC").submit(function (e) {
            e.preventDefault();
            AbiertoxEditar = true; //BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var datosAjax = new FormData();
            datosAjax.append("GuardarFUEC", "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            // CONTRATO ADJUNTO
            var files = $("#contratoadjunto")[0].files;
            datosAjax.append("documento", files[0]);

            if ($("#idruta").val() == "") {
                Swal.fire({
                    icon: "warning",
                    title: "¡Debe seleccionar una ruta antes de guardar!",
                    showConfirmButton: false,
                    timer: 1500,
                });
            } else {
                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/fuec.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        switch (response) {
                            case "error":
                                Swal.fire({
                                    icon: "error",
                                    title: "Ha ocurrido un error, por favor intente de nuevo",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false,
                                }).then((result) => {
                                    if (result.value) {
                                        window.location = "o-fuec";
                                    }
                                });
                                break;
                            default:
                                var idfuec = response;

                                // Mensaje de éxito al usuario
                                Swal.fire({
                                    icon: "success",
                                    title: "¡Datos guardados correctamente!",
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: "Ver PDF",
                                    cancelButtonText: "Cerrar",
                                }).then((result) => {
                                    if (result.value) {
                                        window.open(
                                            `./pdf/pdffuec.php?cod=${idfuec}`,
                                            "",
                                            "width=1280,height=720,left=50,top=50,toolbar=yes"
                                        );
                                    }
                                });

                                // Id fuec
                                $("#idfuec").val(idfuec);

                                // Titulo modal
                                $("#titulo-modal-fuec").html(idfuec);
                                $(".btn-copy-fuec").removeClass("d-none");

                                // Evento para refrescar la pagina cuando sale de la modal
                                $("#NuevoFuecModal").on(
                                    "hidden.bs.modal",
                                    function () {
                                        window.location = "o-fuec";
                                    }
                                );
                                break;
                        }
                    },
                });
            }
        });

        /* ===================================================
          CLICK EN NUEVO FUEC
        ===================================================*/
        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-nuevofuec", function () {
            $("#idfuec").val(""); //reset id fuec
            $("#titulo-modal-fuec").html("Nuevo");
            $("#visualizContrato").text("");
            $(".btn-copy-fuec").addClass("d-none");
            // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
            if (AbiertoxEditar) {
                $("#frmFUEC").trigger("reset"); //reset formulario
                $("#tipocontrato").trigger("change"); //Inicializar opciones con el tipo de contrato
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        });

        /* ===================================================
          CLICK EN EDITAR FUEC
        ===================================================*/
        $(document).on("click", ".btn-editarfuec", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var idfuec = $(this).attr("idfuec");
            $("#idfuec").val(idfuec); //asignar id personal
            $("#titulo-modal-fuec").html("");
            $("#frmFUEC").trigger("reset"); //reset formulario
            $("#visualizContrato").text("");
            $(".btn-copy-fuec").removeClass("d-none");

            $(".overlay-conductores").removeClass("d-none");

            /* AJAX PARA CARGAR DATOS */
            var datos = new FormData();
            datos.append("DatosFUEC", "ok");
            datos.append("item", "idfuec");
            datos.append("valor", idfuec);
            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/fuec.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        $("#titulo-modal-fuec").html(response.idfuec);
                        $("#tipocontrato")
                            .val(response.tipocontrato)
                            .trigger("change");
                        $("#contratofijo")
                            .val(response.contratofijo)
                            .trigger("change");
                        $("#contratante")
                            .val(response.contratante)
                            .attr("actualizo", "NO")
                            .trigger("change");

                        // Datos cliente
                        $("#docum_empre").val(response.docContratante);
                        $("#dir_empre").val(response.direccion);
                        $("#telefono_empre").val(response.telContratante);
                        $("#nom_respo").val(response.nombrerespons);
                        $("#docum_respo").val(response.Documentorespons);
                        $("#dir_respo").val(response.direccion);
                        $("#telefono_cliente").val(response.telrespons);
                        $("#ciudad_cliente").val(response.ciudadrespons);
                        $("#expedicion_doccliente").val(
                            response.ciudad_cedula_expedidaen
                        );

                        // Datos FUEC
                        $("#vehiculofuec")
                            .val(response.idvehiculo)
                            .trigger("change");
                        $("#Observador-conductoresxvehiculo").attr(
                            "conductor1",
                            response.idconductor1
                        );
                        $("#Observador-conductoresxvehiculo").attr(
                            "conductor2",
                            response.idconductor2
                        );
                        $("#Observador-conductoresxvehiculo").attr(
                            "conductor3",
                            response.idconductor3
                        );
                        // setTimeout(() => {
                        //     $("#conductor1").val(response.idconductor1).trigger("change");
                        //     $("#conductor2").val(response.idconductor2).trigger("change");
                        //     $("#conductor3").val(response.idconductor3).trigger("change");
                        //     $(".overlay-conductores").addClass("d-none");
                        // }, 2500);
                        $("#fechaini").val(response.fecha_inicial);
                        $("#fechafin").val(response.fecha_vencimiento);
                        $("#objetocontrato").val(response.idobjeto_contrato);
                        $("#anotObjetoContrato").val(
                            response.anotObjetoContrato
                        );
                        $("#idruta").val(response.idruta);
                        $("#origen").val(response.origen);
                        $("#destino").val(response.destino);
                        //$("#descrip").val(response.observaciones);
                        setTimeout(() => {
                            $("#observacionescontr").val(
                                response.observaciones
                            );
                        }, 1000);
                        $("#precio").val(response.precio);
                        $("#valorneto").val(response.valor_neto);
                        $(
                            `.input-pasajeros[value='${response.listado_pasajeros}']`
                        ).iCheck("check");
                        $(
                            `.input-estado[value='${response.estado_pago}']`
                        ).iCheck("check");
                        $("#estado_fuec").val(response.estado_fuec);

                        // Visualizacion contrato adjunto
                        if (response.ruta_contrato != null) {
                            let nombre = response.ruta_contrato.split("/");
                            nombre = nombre[nombre.length - 1];
                            $("#visualizContrato")
                                .attr(
                                    "href",
                                    urlPagina + response.ruta_contrato
                                )
                                .text(nombre);
                        }
                    }
                },
            });
        });

        /* ===================================================
          ELEMENT OBSERVADOR QUE PONE LOS CONDUCTORES APENAS CAPTA QUE SE ACTUALIZAN EN EL SELECT
        ===================================================*/
        $(document).on(
            "change",
            "#Observador-conductoresxvehiculo",
            function () {
                let idconductor1 = $(this).attr("conductor1");
                let idconductor2 = $(this).attr("conductor2");
                let idconductor3 = $(this).attr("conductor3");
                if (AbiertoxEditar) {
                    setTimeout(() => {
                        $("#conductor1").val(idconductor1).trigger("change");
                        $("#conductor2").val(idconductor2).trigger("change");
                        $("#conductor3").val(idconductor3).trigger("change");
                        $(".overlay-conductores").addClass("d-none");
                    }, 1000);
                }
                //$(".overlay-conductores").addClass("d-none");
            }
        );

        /* ===================================================
          COPIA DEL FUEC
        ===================================================*/
        $(document).on("click", ".btn-copy-fuec", function () {
            $("#idfuec").val(""); //reset id fuec
            $("#titulo-modal-fuec").html("Nuevo");
            $(".btn-copy-fuec").addClass("d-none");
        });

        /* ===================================================
          SELECCIÓN DE RUTA EN FUEC
        ===================================================*/
        $(document).on("click", ".btn-ruta", function () {
            $("#NuevoFuecModal").modal("hide");
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
            $("#NuevoFuecModal").modal("show");
            $("#modal_general").modal("hide");

            var origen = $(this).attr("origen");
            var destino = $(this).attr("destino");
            var descripcion = $(this).attr("descripcion");
            var id = $(this).attr("idregistro");

            $("#idruta").val(id);
            $("#observacionescontr").val(descripcion);
            $("#origen").val(origen);
            $("#destino").val(destino);
        });

        // $(document).on("click", ".btn_cancelar_ruta", function () {

        //     $("#NuevoFuecModal").modal('show');
        //     $("#modal_general").modal('hide');

        //     $("#idruta").val("");
        //     $("#observacionescontr").val("");
        //     $("#origen").val("");
        //     $("#destino").val("");
        // });
        $("#modal_general").on("hidden.bs.modal", function () {
            $("#NuevoFuecModal").modal("show");
            $("#modal_general").modal("hide");

            // $("#idruta").val("");
            // $("#observacionescontr").val("");
            // $("#origen").val("");
            // $("#destino").val("");
        });

        /*============================================
            AGREGAR CONDUCTOR 
        ==============================================*/
        $("#frmConductores").submit(function (e) {
            e.preventDefault();

            let idvehiculo = $("#vehiculofuec").val();

            var datosAjax = new FormData();
            datosAjax.append("GuardarDetallesVehiculo", "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            datosAjax.append("idvehiculo", idvehiculo);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "error") {
                        // Reset del formulario
                        $(this).trigger("reset");
                        $(".select2-single").trigger("change"); //reset select2
                        // Mensaje de éxito al usuario
                        Swal.fire({
                            icon: "success",
                            title: "¡Datos guardados correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                        });


                        $("#agregar_conductor").modal('hide');

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Ha ocurrido un error, por favor intente de nuevo",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                        }).then((result) => {
                            if (result.value) {
                                window.location = "o-fuec";
                            }
                        });
                    }
                },
            });
        });

        /*====================================================
            CARGAR TABLA CONDUCTORES DOCUMENTOS O PROPIETARIOS 
        ======================================================*/
        const AjaxTablaDinamica = (idvehiculo, nombreTabla) => {
            // Quitar datatable
            $(`#tbl${nombreTabla}`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody${nombreTabla}`).html("");

            let datos = new FormData();
            datos.append(`Tabla${nombreTabla}`, "ok");
            datos.append("idvehiculo", idvehiculo);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $(`#tbody${nombreTabla}`).html(response);
                    } else {
                        $(`#tbody${nombreTabla}`).html("");
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
                    var table = dataTableCustom(`#tbl${nombreTabla}`, buttons);
                },
            });
            // HISTORICO EN CASO DE QUERER ACTUALIZAR LA TABLA DOCUMENTOS
            if (nombreTabla == "Documentos") {
                // Quitar datatable
                $("#tblHistorico").dataTable().fnDestroy();
                // Borrar datos
                $("#tbodyTablaHistorico").html("");

                let datoshistorico = new FormData();
                datoshistorico.append("TablaHistorico", "ok");
                datoshistorico.append("idvehiculo", idvehiculo);
                $.ajax({
                    type: "POST",
                    url: `${urlPagina}ajax/vehicular.ajax.php`,
                    data: datoshistorico,
                    cache: false,
                    contentType: false,
                    processData: false,
                    // dataType: "json",
                    success: function (response) {
                        if (response != "" || response != null) {
                            $("#tbodyTablaHistorico").html(response);
                        } else {
                            $("#tbodyTablaHistorico").html("");
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
                        var table = dataTableCustom(`#tblHistorico`, buttons);
                    },
                });
            }
        };


        /*============================================
            CLICK QUE ABRE MODAL DE CONDUCTORES 
        ==============================================*/
        $(document).on("click", ".btn-ModalConductores", function () {
            let idvehiculo = $("#vehiculofuec").val();
            AjaxTablaDinamica(idvehiculo, "Conductores");
        });


          /* ===================================================
          EDITAR REGISTRO
        ===================================================*/
        $(document).on("click", ".btn-editarRegistro", function () {
            var idregistro = $(this).attr("idregistro");
            var tabla = $(this).attr("tabla");
            var nombre = $(this).attr("nombre");
            var idvehiculo = $(this).attr("idvehiculo");

            var datos = new FormData();
            datos.append('VerDetalleVehiculo', "ok");
            datos.append('tabla', tabla);
            datos.append('idregistro', idregistro);
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        switch (tabla) {
                            case 'v_re_propietariosvehiculos':
                                Swal.fire({
                                    title: `${nombre}`,
                                    html:
                                        `
                                        <hr>
                                        <label for="">Porcentaje participación</label>
                                        <input class="form-control" id="swal-propietario-part" type="number" value="${response.participacion}">
                                        <label for="">Observaciones</label>
                                        <input class="form-control" id="swal-propietario-obs" type="text" value="${response.observacion}">
                                        `
                                    ,
                                    showCancelButton: true,
                                    confirmButtonColor: '#5cb85c',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Continuar!',
                                    cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                    if (result.value) {
                                        var observacion = $("#swal-propietario-obs").val();
                                        var participacion = $("#swal-propietario-part").val();
                                        var datos = new FormData();
                                        datos.append('EditarDetalleVehiculo', "ok");
                                        datos.append('tabla', tabla);
                                        datos.append('idregistro', idregistro);
                                        datos.append('observacion', observacion);
                                        datos.append('participacion', participacion);

                                        $.ajax({
                                            type: 'post',
                                            url: `${urlPagina}ajax/vehicular.ajax.php`,
                                            data: datos,
                                            //dataType: 'dataType',
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function (response) {
                                                if (response == "ok") {
                                                    // Cargar de nuevo la tabla correspondiente
                                                    AjaxTablaDinamica(idvehiculo, "Propietarios");
                                                    Swal.fire({
                                                        icon: 'success',
                                                        timer: 1500,
                                                        showConfirmButton: false
                                                    })
                                                }
                                                else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                                        showConfirmButton: true,
                                                        confirmButtonText: 'Cerrar',
                                                    }).then((result) => {
                                                        if (result.dismiss) {
                                                            window.location = 'v-vehiculos';
                                                        }
                                                    })
                                                }
                                            }
                                        });
                                    }
                                })
                                break;

                            case 'v_re_conductoresvehiculos':
                                Swal.fire({
                                    title: `${nombre}`,
                                    html:
                                        `
                                        <hr>
                                        <label for="">Observaciones</label>
                                        <input class="form-control" id="swal-conductor-obs" type="text" value="${response.observacion}">
                                        `
                                    ,
                                    showCancelButton: true,
                                    confirmButtonColor: '#5cb85c',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Continuar!',
                                    cancelButtonText: 'Cancelar'
                                }).then((result) => {
                                    if (result.value) {
                                        var observacion = $("#swal-conductor-obs").val();
                                        var datos = new FormData();
                                        datos.append('EditarDetalleVehiculo', "ok");
                                        datos.append('tabla', tabla);
                                        datos.append('idregistro', idregistro);
                                        datos.append('observacion', observacion);

                                        $.ajax({
                                            type: 'post',
                                            url: `${urlPagina}ajax/vehicular.ajax.php`,
                                            data: datos,
                                            //dataType: 'dataType',
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            success: function (response) {
                                                if (response == "ok") {
                                                    // Cargar de nuevo la tabla correspondiente
                                                    AjaxTablaDinamica(idvehiculo, "Conductores");
                                                    Swal.fire({
                                                        icon: 'success',
                                                        timer: 1500,
                                                        showConfirmButton: false
                                                    })
                                                }
                                                else {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                                        showConfirmButton: true,
                                                        confirmButtonText: 'Cerrar',
                                                    }).then((result) => {
                                                        if (result.dismiss) {
                                                            window.location = 'v-vehiculos';
                                                        }
                                                    })
                                                }
                                            }
                                        });
                                    }
                                })
                                break;

                            default:
                                Swal.fire({
                                    icon: 'error',
                                    showConfirmButton: false,
                                })
                                break;
                        }
                    }
                }
            });
        });

        /* ===================================================
            ELIMINAR REGISTRO
        ===================================================*/
        $(document).on("click", ".eliminarRegistro", function () {
            var idregistro = $(this).attr("idregistro");
            var idvehiculo = $(this).attr("idvehiculo");
            var tabla = $(this).attr("tabla");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este registro?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#0275d8',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append('EliminarRegistro', "ok");
                    datos.append('idregistro', idregistro);
                    datos.append('tabla', tabla);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/vehicular.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Mensaje de éxito
                            if (response == "ok") {
                                AjaxTablaDinamica(idvehiculo, "Conductores");

                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Registro eliminado correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                })
                            }
                            // Mensaje de error
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                }).then((result) => {

                                    if (result.value) {
                                        window.location = 'o-fuec';
                                    }

                                })
                            }
                        }
                    });
                }

            })

        });



    }

    /* ===================================================
      * BUSQUEDA FUEC
    ===================================================*/
    if (
        window.location.href == `${urlPagina}busqueda-fuec/` ||
        window.location.href == `${urlPagina}busqueda-fuec`
    ) {
        /* ===================================================
          CLIC EN BUSQUEDA
        ===================================================*/
        $(document).on("click", "#busquedafuec", function () {
            if ($("#codigoFuec").val() != "") {
                console.log("entra");
                var idfuec = $("#codigoFuec").val();
                var datos = new FormData();
                datos.append("DatosFUEC", "ok");
                datos.append("item", "idfuec");
                datos.append("valor", idfuec);
                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/fuec.ajax.php`,
                    data: datos,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != "") {
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: "success",
                                title: "FUEC ENCONTRADO",
                                showConfirmButton: true,
                                showCancelButton: true,
                                confirmButtonText: "Ver PDF",
                                cancelButtonText: "Cerrar",
                            }).then((result) => {
                                if (result.value) {
                                    window.open(
                                        `./pdf/pdffuec.php?cod=${idfuec}`,
                                        "",
                                        "width=1280,height=720,left=50,top=50,toolbar=yes"
                                    );
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "No se ha podido encontrar el respectivo FUEC",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false,
                            });
                        }
                    },
                });
            }
        });

        /* ===================================================
          CLIC EN LIMPIAR FILTRO
        ===================================================*/
        $(document).on("click", "#limpiarfiltros", function () {
            $("#codigoFuec").val("");
        });
    }
});
