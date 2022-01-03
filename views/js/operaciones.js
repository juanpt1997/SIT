$(document).ready(function () {
    /* ===================================================
            * PROTOCOLO DE ALISTAMIENTO
        ===================================================*/
    if (
        window.location.href == `${urlPagina}o-alistamiento/` ||
        window.location.href == `${urlPagina}o-alistamiento`
    ) {
        /* ===================================================
                  INICIALIZAR DATATABLE
                ===================================================*/
        // Acá pondremos la tabla de alistamiento por ajax (por ahora no, unicamente filtro)
        let TablaAlistamientos = () => {
            /* ===================================================
                          FILTRAR POR COLUMNA
                        ===================================================*/
            /* Filtrar por columna */
            //Clonar el tr del thead
            $(`#tblAlistamientos thead tr:eq(1)`)
                .clone(true)
                .appendTo(`#tblAlistamientos thead`);
            //Por cada th creado hacer lo siguiente
            $(`#tblAlistamientos thead tr:eq(2) th`).each(function (i) {
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
                    className: "btn-info",
                    text: '<i class="far fa-file-excel"></i> Exportar',
                },
            ];
            var table = dataTableCustom(`#tblAlistamientos`, buttons);
        };
        TablaAlistamientos();

        /* ===================================================
                    DETECTA SELECCIÓN DE UN VEHICULO
                ===================================================*/
        var actualizo = true;
        $(document).on("change", "#placa", function () {
            var placa = $(this).val();
            var $select = $(this);

            /* Esta condicion sirve para ejecutar el evento unicamente cuando de verdad seleccione un vehiculo porque puede ocurrir que el select sea modificado internamente con $select.trigger('change')*/
            if (actualizo) {
                // Reset valores
                $(".documentos").val("").removeClass("bg-danger bg-success");
                $(".overlay-conductores").removeClass("d-none");
                $(".datosVehiculo").val("");

                if (placa != "") {
                    //$select.val("");
                    // Cargo datos del vehiculo
                    var datos = new FormData();
                    datos.append("DatosVehiculo", "ok");
                    datos.append("item", "placa");
                    datos.append("valor", placa);
                    $.ajax({
                        type: "post",
                        url: `${urlPagina}ajax/vehicular.ajax.php`,
                        data: datos,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            var Vehiculo = response.datosVehiculo;

                            $("#idvehiculo").val(Vehiculo.idvehiculo);
                            $("#marca").val(Vehiculo.marca);
                            $("#modelo").val(Vehiculo.modelo);
                            $("#numinterno").val(Vehiculo.numinterno);
                            $("#sucursal").val(Vehiculo.sucursal);

                            var Servicios = response.serviciosVehiculo;

                            Servicios.forEach((element) => {
                                $(`#servicio_${element.idservicio}`).val(
                                    element.Ffecha
                                );

                                // if(element.idservicio == 1)$("#cambio_aceite").val(element.Ffecha);
                                // if(element.idservicio == 2)$("#engrase").val(element.Ffecha);
                                // if(element.idservicio == 3)$("#rotacion_llantas").val(element.Ffecha);
                                // if(element.idservicio == 4)$("#filtro_aire").val(element.Ffecha);
                                // if(element.idservicio == 5)$("#sincronizacion").val(element.Ffecha);
                                // if(element.idservicio == 6)$("#alineacion_balanceo").val(element.Ffecha);
                            });

                            /* ===================================================
                                                            Cargar fechas de vencimiento del vehículo
                                                        ===================================================*/
                            var datos = new FormData();
                            datos.append("DocumentosxVehiculo", "ok");
                            datos.append("idvehiculo", Vehiculo.idvehiculo);
                            $.ajax({
                                type: "post",
                                url: `${urlPagina}ajax/vehicular.ajax.php`,
                                data: datos,
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    response.forEach((element) => {
                                        // Asigno valor fecha
                                        $(
                                            `#documento_${element.idtipodocumento}`
                                        ).val(element.fechafin);

                                        // Color del fondo segun la fecha
                                        var bg =
                                            element.fechafin >=
                                            moment().format("YYYY-MM-DD")
                                                ? "bg-success"
                                                : "bg-danger";
                                        $(
                                            `#documento_${element.idtipodocumento}`
                                        ).addClass(bg);
                                    });
                                },
                            });

                            /* ===================================================
                                                            CARGAR LISTA CONDUCTORES
                                                        ===================================================*/
                            var datos = new FormData();
                            datos.append("ListaConductores", "ok");
                            datos.append("idvehiculo", Vehiculo.idvehiculo);
                            $.ajax({
                                type: "post",
                                url: `${urlPagina}ajax/fuec.ajax.php`,
                                data: datos,
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $(".overlay-conductores").addClass(
                                        "d-none"
                                    );
                                    let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                                    if (response != "") {
                                        response.forEach((element) => {
                                            htmlSelect += `<option value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                                        });
                                    }
                                    $("#idconductor").html(htmlSelect);

                                    // Accionar el observador
                                    $(
                                        "#observador_conductoresAlistamiento"
                                    ).trigger("change");
                                },
                            });

                            /* ===================================================
                                                            Cargar fechas de vencimiento del vehículo
                                                        ===================================================*/
                            var datos = new FormData();
                            datos.append("DocumentosxVehiculo", "ok");
                            datos.append("idvehiculo", Vehiculo.idvehiculo);
                            $.ajax({
                                type: "post",
                                url: `${urlPagina}ajax/vehicular.ajax.php`,
                                data: datos,
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    response.forEach((element) => {
                                        // Asigno valor fecha
                                        $(
                                            `#documento_${element.idtipodocumento}`
                                        ).val(element.fechafin);

                                        // Color del fondo segun la fecha
                                        var bg =
                                            element.fechafin >=
                                            moment().format("YYYY-MM-DD")
                                                ? "bg-success"
                                                : "bg-danger";
                                        $(
                                            `#documento_${element.idtipodocumento}`
                                        ).addClass(bg);
                                    });
                                },
                            });

                            /* ===================================================
                                                            CARGAR LISTA CONDUCTORES
                                                        ===================================================*/
                            var datos = new FormData();
                            datos.append("ListaConductores", "ok");
                            datos.append("idvehiculo", Vehiculo.idvehiculo);
                            $.ajax({
                                type: "post",
                                url: `${urlPagina}ajax/fuec.ajax.php`,
                                data: datos,
                                dataType: "json",
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $(".overlay-conductores").addClass(
                                        "d-none"
                                    );
                                    let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                                    if (response != "") {
                                        response.forEach((element) => {
                                            htmlSelect += `<option value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                                        });
                                    }
                                    $("#idconductor").html(htmlSelect);

                                    // Accionar el observador
                                    $(
                                        "#observador_conductoresAlistamiento"
                                    ).trigger("change");
                                },
                            });

                            /* ===================================================
                                                            TABLA DE EVIDENCIAS
                                                        ===================================================*/
                            AjaxTablaEvidencias(Vehiculo.idvehiculo);
                        },
                    });
                }
                // Vehiculo no seleccionado
                else {
                    // Quitar datatable evidencias
                    $(`#tblEvidencias`).dataTable().fnDestroy();
                    // Borrar datos
                    $(`#tbodyEvidencias`).html("");
                }
            } else {
                actualizo = true;
            }
        });

        /* ==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                ELEMENTO OBSERVADOR QUE PONE EL CONDUCTOR CUANDO SE ACTUALIZA EL SELECT 
                ==========================================================================*/
        $(document).on(
            "change",
            "#observador_conductoresAlistamiento",
            function () {
                let idconductor = $(this).attr("idconductor");
                setTimeout(() => {
                    $("#idconductor").val(idconductor).trigger("change");
                }, 1000);
            }
        );

        /* ===================================================
             BOTON PDF ALISTAMIENTO
           ===================================================*/
            $(document).on('click','.btn-PdfAlistamiento', function () {
                
               let id = $(this).attr('idalistamiento');
               window.open(
                `./pdf/pdfalistamiento.php?idalistamiento=${id}`,
                "",
                "width=1280,height=720,left=50,top=50,toolbar=yes"
            );
        });

        /* ===================================================
                  GUARDAR FORMULARIO ALISTAMIENTO
                ===================================================*/
        $("#alistamiento_form").submit(function (e) {
            e.preventDefault();
            AbiertoxEditar = true; //BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            $(".overlayBtnGuardarAlistamiento").removeClass("d-none");

            var datosAjax = new FormData();
            datosAjax.append("GuardarAlistamiento", "ok");

            let idvehiculo = 0;
            let kilometrajeFrm = 0;

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
                if (element.name == "idvehiculo") idvehiculo = element.value;
                if (element.name == "kilometraje_total")
                    kilometrajeFrm = element.value;
            });

            var datos = new FormData();
            datos.append("DatosVehiculo", "ok");
            datos.append("item", "idvehiculo");
            datos.append("valor", idvehiculo);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    var Vehiculo = response.datosVehiculo;

                    //VALIDAMOS QUE EL KILOMETRAJE NO SEA MENOR AL QUE TIENE EL VEHÍCULO
                    if (kilometrajeFrm >= Vehiculo.kilometraje) {
                        $.ajax({
                            type: "post",
                            url: `${urlPagina}ajax/operaciones.ajax.php`,
                            data: datosAjax,
                            cache: false,
                            // dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                $(".overlayBtnGuardarAlistamiento").addClass(
                                    "d-none"
                                );
                                switch (response) {
                                    case "existe":
                                        Swal.fire({
                                            icon: "warning",
                                            title: "Ya existe dicho vehículo registrado para este día",
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
                                                window.location =
                                                    "o-alistamiento";
                                            }
                                        });
                                        break;
                                    default:
                                        var idalistamiento = response;

                                        // Mensaje de éxito al usuario
                                        Swal.fire({
                                            icon: "success",
                                            title: "¡Datos guardados correctamente!",
                                            showConfirmButton: false,
                                            confirmButtonText: "Cerrar",
                                            timer: 2000,
                                        });

                                        // Id fuec
                                        $("#idalistamiento").val(
                                            idalistamiento
                                        );

                                        // Titulo modal
                                        $("#TituloModal").val(
                                            $("#placa").val()
                                        );

                                        // Evento para refrescar la pagina cuando sale de la modal
                                        $("#modal-nuevoAlistamiento").on(
                                            "hidden.bs.modal",
                                            function () {
                                                window.location =
                                                    "o-alistamiento";
                                            }
                                        );
                                        break;
                                }
                            },
                        });
                    } else {
                        $(".overlayBtnGuardarAlistamiento").addClass("d-none");
                        Swal.fire({
                            icon: "warning",
                            title:
                                "El kilometraje anterior es " +
                                Vehiculo.kilometraje +
                                " verifique el kilometraje del vehículo y vuelva a intentarlo",
                            showConfirmButton: false,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                            timer: 2000,
                        });
                    }
                },
            });

            // $.ajax({
            //     type: "post",
            //     url: `${urlPagina}ajax/operaciones.ajax.php`,
            //     data: datosAjax,
            //     cache: false,
            //     // dataType: 'json',
            //     contentType: false,
            //     processData: false,
            //     success: function (response) {
            //         console.log(response);
            //         switch (response) {
            //             case "existe":
            //                 Swal.fire({
            //                     icon: "warning",
            //                     title: "Ya existe dicho vehículo registrado para este día",
            //                     showConfirmButton: true,
            //                     confirmButtonText: "Cerrar",
            //                     closeOnConfirm: false,
            //                 });
            //                 break;

            //             case "error":
            //                 Swal.fire({
            //                     icon: "error",
            //                     title: "Ha ocurrido un error, por favor intente de nuevo",
            //                     showConfirmButton: true,
            //                     confirmButtonText: "Cerrar",
            //                     closeOnConfirm: false,
            //                 }).then((result) => {
            //                     if (result.value) {
            //                         window.location = "o-alistamiento";
            //                     }
            //                 });
            //                 break;
            //             default:
            //                 var idalistamiento = response;

            //                 // Mensaje de éxito al usuario
            //                 Swal.fire({
            //                     icon: "success",
            //                     title: "¡Datos guardados correctamente!",
            //                     showConfirmButton: true,
            //                     confirmButtonText: "Cerrar",
            //                 });

            //                 // Id fuec
            //                 $("#idalistamiento").val(idalistamiento);

            //                 // Titulo modal
            //                 $("#TituloModal").val($("#placa").val());

            //                 // Evento para refrescar la pagina cuando sale de la modal
            //                 $("#modal-nuevoAlistamiento").on("hidden.bs.modal", function () {
            //                     window.location = "o-alistamiento";
            //                 });
            //                 break;
            //         }
            //     },
            // });
        });

        /* ===================================================
                    CLIC EN NUEVO ALISTAMIENTO
                ===================================================*/
        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-nuevoAlistamiento", function () {
            $("#idalistamiento").val(""); // RESET id alistamiento
            $("#TituloModal").html("");
            // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
            if (AbiertoxEditar) {
                $("#alistamiento_form").trigger("reset"); //reset formulario
                $("#placa").trigger("change");
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        });

        /* ===================================================
                  CLICK EN EDITAR ALISTAMIENTO
                ===================================================*/
        $(document).on("click", ".btn-editarAlistamiento", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var idalistamiento = $(this).attr("idalistamiento");
            var placa = $(this).attr("placa");

            $("#TituloModal").html(placa);
            $("#alistamiento_form").trigger("reset"); //reset formulario

            $("#idalistamiento").val(idalistamiento);
            $("#placa").val(placa).trigger("change");
            var datos = new FormData();
            datos.append("DatosAlistamiento", "ok");
            datos.append("idalistamiento", idalistamiento);
            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/operaciones.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        //Guarda en KEYS los elementos llaves, nombres, name del JSON
                        var keys = Object.keys(response);
                        //Guarda en VALUES los elementos de valor del JSON
                        var values = Object.values(response);

                        // Recorremos ambos arreglos
                        for (let index = 0; index < keys.length; index++) {
                            // NO tomamos las llaves numericas (normalmente un json repite el arreglo json con llaves numericos)
                            if (isNaN(keys[index])) {
                                if (
                                    keys[index] != "placa" &&
                                    keys[index] != "numinterno" &&
                                    keys[index] != "id" &&
                                    keys[index] != "idvehiculo" &&
                                    keys[index] != "idconductor" &&
                                    keys[index] != "fechaalista"
                                ) {
                                    // Si el input es un check - radio
                                    $(
                                        `input[name='${keys[index]}'][value='${values[index]}']`
                                    ).iCheck("check");
                                }
                            }
                        }

                        $("#observador_conductoresAlistamiento").attr(
                            "idconductor",
                            response.idconductor
                        );

                        // setTimeout(() => {
                        //     $("#idconductor").val(response.idconductor);
                        // }, 1000);

                        // $("#cambio_aceite").val(response.cambio_aceite);
                        // $("#engrase").val(response.engrase);
                        // $("#rotacion_llantas").val(response.rotacion_llantas);
                        // $("#filtro_aire").val(response.filtro_aire);
                        // $("#sincronizacion").val(response.sincronizacion);
                        // $("#alineacion_balanceo").val(response.alineacion_balanceo);

                        $("#fechaAlistamiento").val(response.Ffechaalista);
                        $("#kmtotal").val(response.kilometraje_total);
                        $("#observaciones").val(response.observaciones);
                    }
                },
            });
        });

        /* ===================================================
                    TABLA EVIDENCIAS
                ===================================================*/
        const AjaxTablaEvidencias = (idvehiculo) => {
            // Quitar datatable
            $(`#tblEvidencias`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbodyEvidencias`).html("");

            let datos = new FormData();
            datos.append(`TablaEvidencias`, "ok");
            datos.append("idvehiculo", idvehiculo);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/operaciones.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $(`#tbodyEvidencias`).html(response);
                    } else {
                        $(`#tbodyEvidencias`).html("");
                    }

                    /* ===================================================
                                        INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                                        ===================================================*/
                    var buttons = [
                        {
                            extend: "excel",
                            className: "btn-info",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tblEvidencias`, buttons);
                },
            });
        };

        /* ===================================================
                  GUARDAR EVIDENCIA
                ===================================================*/
        $(document).on("click", "#btnGuardarEvidencia", function () {
            var idvehiculo = $("#idvehiculo").val();
            AbiertoxEditar = true; //BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
            // Tenga un vehiculo seleccionado
            if (idvehiculo != "") {
                var fotoEvidencia = $("#foto_evidencia")[0].files;
                var observaciones = $("#observacion_evidencia").val();
                // foto no sea vacia y las observaciones tampoco sean vacias
                if (fotoEvidencia.length > 0 && observaciones != "") {
                    // Cambiar la animacion del boton para que no pueda guardar
                    //$("#btnGuardarEvidencia").attr("disabled", true);
                    $("#overlayBtnGuardarEvidencia").removeClass("d-none");

                    var datos = new FormData();
                    datos.append("GuardarEvidencia", "ok");
                    datos.append("idvehiculo", idvehiculo);
                    datos.append("fotoEvidencia", fotoEvidencia[0]);
                    datos.append("observaciones", observaciones);

                    $.ajax({
                        type: "post",
                        url: `${urlPagina}ajax/operaciones.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Despues de traer respuesta, cambiar animacion del boton para poder guardar
                            //$("#btnGuardarEvidencia").removeAttr("disabled");
                            $("#overlayBtnGuardarEvidencia").addClass("d-none");

                            if (response == "ok") {
                                Swal.fire({
                                    icon: "success",
                                    timer: 1500,
                                    title: "Documento subido correctamente!",
                                    showConfirmButton: false,
                                });
                                /* ===================================================
                                                                    TABLA DE EVIDENCIAS
                                                                ===================================================*/
                                AjaxTablaEvidencias(idvehiculo);
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "¡Ha ocurrido un error, por favor intente de nuevo más tarde!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                });
                            }
                        },
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Primero seleccione un archivo y digite las observaciones",
                        showConfirmButton: false,
                        confirmButtonText: "Aceptar",
                    });
                }
            }
        });

        /* ===================================================
                  BOTON CAMBIAR ESTADO EVIDENCIA
                ===================================================*/
        $(document).on("click", ".btn-estado", function () {
            var $boton = $(this);
            var idevidencia = $(this).attr("idevidencia");
            var idvehiculo = $(this).attr("idvehiculo");
            var estado = $(this).attr("estado");

            var textoBoton =
                estado == "PENDIENTE" ? "Resuelto!" : "Aún pendiente";
            var colorBoton = estado == "PENDIENTE" ? "#5cb85c" : "#d33";
            Swal.fire({
                title: `Estado de evidencia: ${estado}`,
                html: `
                                        <hr>
                                        <label for="">Observaciones</label>
                                        <input class="form-control" id="swal-evidencia-obs" type="text" value="${$(
                                            "#obs_" + idevidencia
                                        ).text()}">
                                        `,
                showCancelButton: true,
                confirmButtonColor: colorBoton,
                cancelButtonColor: "#007bff",
                confirmButtonText: textoBoton,
                cancelButtonText: "Cerrar",
            }).then((result) => {
                if (result.value) {
                    var observaciones = $("#swal-evidencia-obs").val();

                    if (observaciones != "") {
                        var datos = new FormData();
                        datos.append("CambiarEstadoEvidencia", "ok");
                        datos.append("idevidencia", idevidencia);
                        datos.append("estadoActual", estado);
                        datos.append("observaciones", observaciones);
                        $.ajax({
                            url: `${urlPagina}ajax/operaciones.ajax.php`,
                            method: "POST",
                            data: datos,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if (response == "ok") {
                                    Swal.fire({
                                        icon: "success",
                                        timer: 1000,
                                        title: "Registro modificado correctamente!",
                                        showConfirmButton: false,
                                    });
                                    /* ===================================================
                                    TABLA DE EVIDENCIAS
                                    ===================================================*/
                                    AjaxTablaEvidencias(idvehiculo);
                                    // if (estado == 'RESUELTO') {
                                    //     $boton.removeClass("btn-success");
                                    //     $boton.addClass("btn-danger");
                                    //     $boton.html(`<i class="far fa-clock"></i> PENDIENTE`);
                                    //     $boton.attr("estado", "PENDIENTE");
                                    // } else {
                                    //     $boton.addClass("btn-success");
                                    //     $boton.removeClass("btn-danger");
                                    //     $boton.html(`<i class="far fa-check-square"></i> RESUELTO`);
                                    //     $boton.attr("estado", "RESUELTO");
                                    // }
                                }
                                // Mensaje de error
                                else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Ha ocurrido un error, por favor intente de nuevo",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = "o-alistamiento";
                                        }
                                    });
                                }
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: "warning",
                            timer: 3000,
                            title: "No pueden quedar en blanco las observaciones",
                            showConfirmButton: false,
                        });
                    }
                }
            });
        });

        /* ===================================================
            COMPROBAR INPUTS 
        ====================================================== */

        $(document).on("click", ".btn-alistamientoguardar", function () {
            Areas = [];
            Requeridos = [];
            Elementos = [];

            //Validación de inputs

            $("input:invalid").each(function (index, element) {
                var $input = $(this);

                var idform = $input.closest("form").attr("id");

                if (idform == "alistamiento_form") {
                    Requeridos.push($input);
                }
            });

            //Validación textarea

            //Validación textarea

            $("textarea:invalid").each(function (index, element) {
                var $area = $(this);

                var idform = $area.closest("form").attr("id");
                console.log(idform);
                if (idform == "alistamiento_form") {
                    Areas.push($area);
                }
            });

            var tab = [];

            //Se trae los tabs
            $("input:invalid").each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest("table").attr("nombre");
                if (!tab.includes(idtab)) tab.push(idtab);
            });

            $("select:invalid").each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest("table").attr("nombre");
                if (idtab == undefined) idtab = "Documentos";
                if (!tab.includes(idtab)) {
                    tab.push(idtab);
                    Requeridos.push($tabs);
                }
            });

            $("textarea:invalid").each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest("table").attr("nombre");
                if (!tab.includes(idtab)) tab.push(idtab);
            });

            if (Requeridos.length > 0 || Areas.length > 0) {
                let inputsRequeridosHtml = `<ul>`;
                tab.forEach((element) => {
                    inputsRequeridosHtml += `<li>${element}</li>`;
                });
                inputsRequeridosHtml += `</ul>`;

                Swal.fire({
                    icon: "warning",
                    html: `<div class="text-left">
                                                    <p class="font-weight-bold">Hace falta diligenciar campos en los siguientes apartados:</p>
                                                        ${inputsRequeridosHtml}
                                                </div>`,
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                });
            }
        });
    }

    /* ===================================================
            * PLAN DE RODAMIENTO
    =====================================================*/
    if (
        window.location.href == `${urlPagina}o-rodamiento/` ||
        window.location.href == `${urlPagina}o-rodamiento`
    ) {
        /*==========================================================================
        CONDUCTORES SEGUN LA PLACA
        ===========================================================================*/
        $(document).on("change", "#placa_roda", function () {
            let idvehiculo = $(this).val();

            // Datos del vehiculo
            var datos = new FormData();
            datos.append("DatosVehiculo", "ok");
            datos.append("item", "idvehiculo");
            datos.append("valor", idvehiculo);
            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (Vehiculo) {
                    $("#tipo_vinculacion").val(
                        Vehiculo.datosVehiculo.tipovinculacion
                    );
                    $("#numinterno").val(Vehiculo.datosVehiculo.numinterno);
                    $("#marca").val(Vehiculo.datosVehiculo.marca);
                    $("#modelo").val(Vehiculo.datosVehiculo.modelo);
                    $("#capacidad").val(Vehiculo.datosVehiculo.capacidad);
                    $("#tipoVehiculo").val(
                        Vehiculo.datosVehiculo.idtipovehiculo
                    ).trigger("change");
                },
            });

            // lISTA CONDUCTORES
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
                    if (response != "") {
                        let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                        if (response != "") {
                            response.forEach((element) => {
                                htmlSelect += `<option class="inv-conductor" value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                            });
                        }
                        $(".conductores").html(htmlSelect);

                        // Accionar el observador
                        $("#observador_conductoresRodamiento").trigger(
                            "change"
                        );
                    } else if (idvehiculo == "") {
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "No se ha encontrado conductor",
                            text: "Seleccione otra placa",
                        });
                    }
                },
            });
        });
        /*==========================================================================
        TRAER DATOS DEL RODAMIENTO BOTON EDITAR
        ===========================================================================*/
        $(".btn-editarRodamiento").on("click", function () {
            let id = $(this).attr("id_rodamiento");

            $("#id_rodamiento").val(id);

            $("#titulo_modal_rodamiento").html("Editando plan de rodamiento");

            $("#btn-copiar").removeClass("d-none");

            var datos = new FormData();
            datos.append("DatosRodamiento", "ok");
            datos.append("id", id);
            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/operaciones.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#idruta").val(response.idruta);
                    $("#placa_roda").val(response.idvehiculo).trigger("change");
                    $("#idcliente").val(response.idcliente);
                    $("#placa_invent").val(response.idvehiculo).trigger("change");
                    $("#observador_conductoresRodamiento").attr("idconductor",response.idconductor);
                    $("#fecha_servicio").val(response.fecha_servicio);
                    $("#tipo_servicio").val(response.tipo_servicio).trigger("change");
                    $("#cantidadpasajerosdatosroda").val(response.cantidad_pasajeros);
                    $("#hora_inicio").val(response.h_inicio);
                    $("#hora_final").val(response.h_final);
                    $("#kmrecorridosdatosroda").val(response.kmrecorridos);
                    $("#descrip").val(response.descripcion);
                    $("#origen").val(response.origen);
                    $("#destino").val(response.destino);
                    $("#valor_total").val(response.valortotal).removeAttr("readonly");
                    if(response.contratante == null){
                        $("#selectContFijos").removeClass("d-none"); // Muestra el select de fijos
                        $("#selectContOrden").addClass("d-none");
                        $("#contratofijo").attr("required", "required"); // SE VUELVE REQUERIDO EL SELECT DE FIJOS
                        $("#contratante").val("").removeAttr("required");
                    } else if (response.contratofijo == null){
                        $("#selectContOrden").removeClass("d-none"); // Muestra el select de contratante
                        $("#selectContFijos").addClass("d-none");
                        $("#contratofijo").val("").removeAttr("required"); // Reset valor de fijos y lo vuelvo obligatorio
                        $("#contratante").attr("required", "required");
                    }
                    $("#tipocontrato").val(response.tipo_contrato).attr("actualizo", "NO").trigger("change");
                    $("#contratante").val(response.contratante).trigger("change");
                    $("#contratofijo").val(response.contratofijo).trigger("change");
                },
            });
        });
        /*==========================================================================
        ELEMENTO OBSERVADOR QUE PONE EL CONDUCTOR CUANDO SE ACTUALIZA EL SELECT
        ===========================================================================*/
        $(document).on(
            "change",
            "#observador_conductoresRodamiento",
            function () {
                let idconductor = $(this).attr("idconductor");
                setTimeout(() => {
                    $("#idconductor").val(idconductor).trigger("change");
                }, 1000);
            }
        );
        /*==========================================================================
        HABILITAR BOTON PARA COPIAR UN RODAMIENTO
        ===========================================================================*/
        $(".btn-copiar-rodamiento").on("click", function () {
            Swal.fire({
                icon: "success",
                title: "Dato copiado",
                text: "Guarde los nuevos cambios",
                showConfirmButton: true,
                timer: 1500,
                closeOnConfirm: false,
            });
            $("#id_rodamiento").val("");
            $("#titulo_modal_rodamiento").html(
                "Agregar nuevo plan de rodamiento"
            );
            $("#btn-copiar").addClass("d-none");
        });
        /*==========================================================================
        RESET VALORES AL AGREGAR
        ===========================================================================*/
        $(".btn-nuevoplanrodamiento").on("click", function () {
            $("#titulo_modal_rodamiento").html(
                "Agregar nuevo plan de rodamiento"
            );

            $("#btn-copiar").addClass("d-none");
            $("#id_rodamiento").val("");
            $("#formulario_rodamiento").trigger("reset");
            //$("#ruta").trigger("change");
            $("#tipo_servicio").trigger("change");
            $("#idcliente").val("");
            $("#placa_roda").val("").trigger("change");
            $("#idconductor").empty();
            $("#selectContOrden").addClass("d-none");//OCULTA EL SELECT DE OCASIONAL
            $("#selectContFijos").addClass("d-none");//OCULTA EL SELECT DE FIJOS
            $("#contratofijo").val("").removeAttr("required");
            $("#contratante").val("").removeAttr("required");
            $("#contratante").trigger("change");
            $("#contratofijo").trigger("change");
            $(".input-clientes-datos").val("");
            $(".input-ruta").val("");
            $("#valor_total").val("").attr("required",true);
        });
        /*==========================================================================
        BOTON ELIMINAR RODAMIENTO
        ===========================================================================*/
        $(".btn-eliminar-rodamiento").on("click", function () {
            let id = $(this).attr("id_rodamiento");

            Swal.fire({
                icon: "warning",
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que desea borrar este registro?",
                confirmButtonText: "SI, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#e60000",
                cancelButtonColor: "#0066ff",
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append("EliminarRodamiento", "ok");
                    datos.append("id", id);

                    $.ajax({
                        type: "POST",
                        url: "ajax/operaciones.ajax.php",
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
                                    window.location = "o-rodamiento";
                                });
                            }
                        },
                    });
                }
            });
        });
        /*==========================================================================
        CREAR DATATABLE DEL RODAMIENTO
        ===========================================================================*/
        let FiltroTablaRodamiento = () => {
            /* ===================================================
                          FILTRAR POR COLUMNA
            ====================================================*/
            /* Filtrar por columna */
            //Clonar el tr del thead
            $(`#tblplanrodamiento thead tr:eq(0)`)
                .clone(true)
                .appendTo(`#tblplanrodamiento thead`);
            //Por cada th creado hacer lo siguiente
            $(`#tblplanrodamiento thead tr:eq(1) th`).each(function (i) {
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
                            INICIALIZAR DATATABLE 
            ====================================================*/
            var buttons = [
                {
                    extend: "excel",
                    className: "btn-info",
                    text: '<i class="far fa-file-excel"></i> Exportar',
                },
            ];
            var table = dataTableCustom(`#tblplanrodamiento`, buttons);
        };
        /*==========================================================================
        INICIALIZAR DATATABLE
        ===========================================================================*/
        FiltroTablaRodamiento();
        /*==========================================================================
        LISTA DE RUTAS
        ===========================================================================*/
        $(document).on("click", ".btn-ruta", function () {
            $("#modal-nuevoplanrodamiento").modal("hide");
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
                            className: "btn-info",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                        /* 'copy', 'csv', 'excel', 'pdf', 'print' */
                    ];
                    dataTableCustom("#tabla_general_rutas", buttons);
                },
            });
        });
        /*==========================================================================
        TRAER DATOS DE LA RUTA SELECCIONADA
        ===========================================================================*/
        $(document).on("click", ".btnSeleccionarRuta", function () {
            $("#modal-nuevoplanrodamiento").modal("show");
            $("#modal_general").modal("hide");

            var origen = $(this).attr("origen");
            var destino = $(this).attr("destino");
            var descripcion = $(this).attr("descripcion");
            var id = $(this).attr("idregistro");

            $("#idruta").val(id);
            $("#descrip").val(descripcion);
            $("#origen").val(origen);
            $("#destino").val(destino);

            let contratofijo = $("#contratofijo").val();
            let contratante = $("#contratante").val();

            if (contratofijo != "") {

                let idcliente = $("#idcliente").val();
                let idruta = $("#idruta").val();
                let idtipo = $("#tipoVehiculo").val();

                if(idtipo == ""){
                    Swal.fire({
                        icon: "warning",
                        title: "Seleccione una vehículo.",
                        showConfirmButton: true,
                        confirmButtonText: "continuar."
                    });

                    $("#idruta").val("");
                    $("#descrip").val("");
                    $("#origen").val("");
                    $("#destino").val("");

                } else if (idcliente != "" && idruta != "" && idtipo != "") {
                    var datos = new FormData();
                    datos.append("ConsultarValor", "ok");
                    datos.append("idcliente", idcliente);
                    datos.append("idruta", idruta);
                    datos.append("idtipove", idtipo);
                    $.ajax({
                        type: "POST",
                        url: `${urlPagina}ajax/operaciones.ajax.php`,
                        data: datos,
                        dataType: "json",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if(response.valor_recorrido == undefined){
                                Swal.fire({
                                    icon: "info",
                                    title: "No se encontró ruta con ese cliente",
                                    text: "Ingrese el valor total de la ruta.",
                                    showConfirmButton: true,
                                    confirmButtonText: "continuar."
                                });
                                $("#valor_total").removeAttr("readonly");
                            }else{
                                $("#valor_total").val(response.valor_recorrido);
                                $("#valor_total").attr("readonly",true);
                            }
                        },
                    });
                }
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Debe seleccionar un contrato fijo",
                    showConfirmButton: true,
                    confirmButtonText: "continuar."
                });
                $("#idruta").val("");
                $("#descrip").val("");
                $("#origen").val("");
                $("#destino").val("");
            }
        });
        /*==========================================================================
        CERRAR MODAL, REINICIAR VALORES 
        ===========================================================================*/
        $("#modal_general").on("hidden.bs.modal", function () {
            $("#modal-nuevoplanrodamiento").modal("show");
            $("#modal_general").modal("hide");
        });
        /*==========================================================================
        VALIDAR CAMPO VACIO DE RUTA
        ===========================================================================*/
        var guardoRodamiento = false;
        $("#formulario_rodamiento").submit(function (e) {
            if (!guardoRodamiento) {
                e.preventDefault();
                if ($("#idruta").val() == "") {
                    Swal.fire({
                        icon: "warning",
                        title: "¡Debe seleccionar una ruta antes de guardar!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    guardoRodamiento = false;
                } else {
                    guardoRodamiento = true;
                    $("#formulario_rodamiento").submit();
                }
            }
        });
        /*==========================================================================
        TIPO DE CONTRATO
        ===========================================================================*/
        $(document).on("change", "#tipocontrato", function () {

            var actualizoTipoContrato = $(this).attr("actualizo");
            if(actualizoTipoContrato == "SI"){

                var tipocontrato = $(this).val();
                if (tipocontrato == "FIJO") {
                    $("#selectContFijos").removeClass("d-none"); // Muestra el select de fijos
                    $("#selectContOrden").addClass("d-none"); // Esconde el select de contratante
                    $("#contratofijo").attr("required", "required"); // SE VUELVE REQUERIDO EL SELECT DE FIJOS
                    $("#contratante").val("").removeAttr("required");//REMUEVE EL ATRIBUTO REQUERIDO DE CONTRATANTE
                    $("#contratante").trigger("change"); //CHANGE QUE RESETEA EL SELECT DE CONTRATANTE
                    $(".input-clientes-datos").val("");//RESET VALORES DEL CLIENTE AL CAMBIAR DE TIPO DE CONTRATO
                    $(".input-ruta").val("");
                    $("#valor_total").val("");
                    $(".btn-ruta").attr("disabled", true);
                } else if (tipocontrato == "OCASIONAL") {
                    $("#selectContOrden").removeClass("d-none"); // Muestra el select de contratante
                    $("#selectContFijos").addClass("d-none"); // Esconde el select de fijos
                    $("#contratofijo").val("").removeAttr("required"); // Reset valor de fijos y lo vuelvo obligatorio
                    $("#contratante").attr("required", "required"); // Vuelvo obligatorios el select de contratante
                    $("#contratofijo").trigger("change");//CHANGE QUE RESETEA EL SELECT DE FIJOS
                    $(".input-clientes-datos").val("");//RESET VALORES DEL CLIENTE AL CAMBIAR DE TIPO DE CONTRATO
                    $("#valor_total").val("").attr("readonly",true);
                    $(".btn-ruta").attr("disabled", true);
                } else if (tipocontrato == "") {
                    $("#selectContOrden").addClass("d-none");//OCULTA EL SELECT DE OCASIONAL
                    $("#selectContFijos").addClass("d-none");//OCULTA EL SELECT DE FIJOS
                    $("#contratofijo").val("").removeAttr("required");
                    $("#contratante").val("").removeAttr("required");
                    $("#contratante").trigger("change");
                    $("#contratofijo").trigger("change");
                    $(".input-clientes-datos").val("");
                    $(".input-ruta").val("");
                    $("#valor_total").val("");
                    $(".btn-ruta").attr("disabled", true);
                }
            }else {
                $(this).attr("actualizo", "SI");
            }
        });
        /*==========================================================================
        TRAER LOS DATOS DEL CLIENTE SI ES OCASIONAL
        ===========================================================================*/
        $(document).on("change", "#contratante", function () {

            var actualizoDatosclienteOca = $(this).attr("actualizo");
            if(actualizoDatosclienteOca == "SI"){

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
                            $("#nombre_cliente").val(response.nombre_con);
                            $("#documento_cliente").val(response.documento_con);
                            $("#direccion_con").val(response.direccion_con);
                            $("#telefono_cliente").val(response.tel_1);
                            $("#idruta").val(response.idruta);
                            $("#descrip").val(response.descripcion);
                            $("#origen").val(response.origen);
                            $("#destino").val(response.destino);
                            $("#valor_total").val(response.valortotal);
                            $("#idcliente").val(response.idcliente);
                        },
                    });
                }
            }else{
                $(this).attr("actualizo", "SI");
            }
        });
        /*==========================================================================
        TRAER LOS DATOS DEL CLIENTE SI ES FIJO
        ===========================================================================*/
        $(document).on("change", "#contratofijo", function () {

            var actualizoDatosclienteFijo = $(this).attr("actualizo");
            if(actualizoDatosclienteFijo == "SI"){

                var idfijo = $(this).val();
                if (idfijo != "") {
                    var datos = new FormData();
                    datos.append("DatosFijos", "ok");
                    datos.append("value", idfijo);
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
                            $("#nombre_cliente").val(response.nombre_cliente);
                            $("#documento_cliente").val(response.Documento);
                            $("#direccion_con").val(response.direccion);
                            $("#telefono_cliente").val(response.telefono);
                            $("#idcliente").val(response.idcliente);
                        },
                    });
                }
            } else {
                $(this).attr("actualizo", "SI");
            }
        });
        /*=======================================================================================================
        VALIDA SI UN CONTRATO FIJO Y UN TIPO DE VEHICULO HA SIDO SELECCIONADO (PARA HABILITAR EL BOTON DE LA RUTA)
        ========================================================================================================*/
        $(document).on("change", ".validacion", function () {

            let tipo = $("#tipoVehiculo").val();
            let fijo = $("#contratofijo").val();
            console.log(tipo,fijo);
            if(tipo != "" && tipo != null && fijo != ""){
                $(".btn-ruta").removeAttr("disabled");
            }
        });
    }
});
