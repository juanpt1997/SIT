$(document).ready(function () {
    /* ===================================================
    * INVENTARIO
    ===================================================*/
    if (
        window.location.href == `${urlPagina}m-inventario/` ||
        window.location.href == `${urlPagina}m-inventario`
    ) {
        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        CONDUCTORES SEGUN LA PLACA DEL VEHICULO
        ==========================================================================*/
        $(document).on("change", "#placa_invent", function () {
            $(".documentos").val("").removeClass("bg-danger bg-success");
            let idvehiculo = $(this).val();

            if (idvehiculo == "null") {
                $(".documentos").val("");
            }

            AjaxTablaEvidencias(idvehiculo);

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
                    $("#tipo_vel").val(Vehiculo.datosVehiculo.idtipovehiculo);
                    $("#numinter_invent").val(
                        Vehiculo.datosVehiculo.numinterno
                    );
                    $("#marca_invent").val(Vehiculo.datosVehiculo.idmarca);
                    $("#modelo_invent").val(Vehiculo.datosVehiculo.modelo);
                    //Funcion para cargar las fotos del vehiculo segun ese id
                    cargarFotosVehiculo(Vehiculo.fotosVehiculo);
                    //CAMBIAR INVENTARIO SEGUN EL TIPO DE VEHICULO
                    inventario_tipo_vel(Vehiculo.datosVehiculo.categoria);
                    //FOTO DE LLANTAS SEGUN EL TIPO DE VEHICULO QUE VENGA
                    // if (
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Camioneta" ||
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Campero" ||
                    //     Vehiculo.datosVehiculo.tipovehiculo ==
                    //         "Camioneta Doble Cabina" ||
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Automovil"
                    // ) {
                    //     $("#llantas_camioneta").removeClass("d-none");
                    //     $("#llantas_bus").addClass("d-none");
                    //     $("#llantas_buseta").addClass("d-none");
                    //     $("#llantas_micro").addClass("d-none");
                    // } else if (
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Bus" ||
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Buseton"
                    // ) {
                    //     $("#llantas_bus").removeClass("d-none");
                    //     $("#llantas_camioneta").addClass("d-none");
                    //     $("#llantas_buseta").addClass("d-none");
                    //     $("#llantas_micro").addClass("d-none");
                    // } else if (
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Buseta"
                    // ) {
                    //     $("#llantas_buseta").removeClass("d-none");
                    //     $("#llantas_bus").addClass("d-none");
                    //     $("#llantas_camioneta").addClass("d-none");
                    //     $("#llantas_micro").addClass("d-none");
                    // } else if (
                    //     Vehiculo.datosVehiculo.tipovehiculo == "Microbus"
                    // ) {
                    //     $("#llantas_micro").removeClass("d-none");
                    //     $("#llantas_bus").addClass("d-none");
                    //     $("#llantas_buseta").addClass("d-none");
                    //     $("#llantas_camioneta").addClass("d-none");
                    // }
                    if (Vehiculo.datosVehiculo.categoria == "BUS-BUSETA") {
                        $("#llantas_bus_buseta").removeClass("d-none");
                        $("#llantas_camioneta_micro").addClass("d-none");
                    } else if (
                        Vehiculo.datosVehiculo.categoria == "CAMIONETA-MICRO"
                    ) {
                        $("#llantas_camioneta_micro").removeClass("d-none");
                        $("#llantas_bus_buseta").addClass("d-none");
                    }
                },
            });

            //DOCUMENTOS DEL VEHICULO
            var datos = new FormData();
            datos.append("DocumentosxVehiculo", "ok");
            datos.append("idvehiculo", idvehiculo);
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
                        $(`#documento_${element.idtipodocumento}`).val(
                            element.fechafin
                        );

                        // Color del fondo segun la fecha
                        // var bg =
                        //     element.fechafin >=
                        //     moment().format("YYYY-MM-DD")
                        //         ? "bg-success"
                        //         : "bg-danger";

                        bg = semaforo_tipo1(
                            element.fechafin,
                            moment().format("YYYY-MM-DD")
                        );

                        $(`#documento_${element.idtipodocumento}`).addClass(
                            "bg-" + bg
                        );
                    });
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
                        $("#observador_conductoresInventario").trigger(
                            "change"
                        );
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "No se ha encontrado conductor",
                            text: "Seleccione otra placa",
                            showConfirmButton: false,
                            timer: 1600,
                        });
                        //RESET DE VALOR
                        $("#conductor_invent").empty();
                    }
                },
            });
        });

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        LICENCIA DEL CONDUCTOR SELECCIONADO
        ==========================================================================*/
        $(document).on("change", "#conductor_invent", function () {
            let idconductor = $(this).val();
            var datos = new FormData();
            datos.append("LicenciasxVehiculo", "ok");
            datos.append("idconductor", idconductor);
            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/mantenimiento.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        $("#categoria_invent").val(response.categoria);
                        $("#vencimineto_inventario").val(
                            response.fecha_vencimiento
                        );
                    }
                },
            });
        });

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        ELEMENTO OBSERVADOR QUE PONE EL CONDUCTOR CUANDO SE ACTUALIZA EL SELECT 
        ==========================================================================*/
        $(document).on(
            "change",
            "#observador_conductoresInventario",
            function () {
                let idconductor = $(this).attr("idconductor");
                setTimeout(() => {
                    $("#conductor_invent").val(idconductor).trigger("change");
                }, 1000);
            }
        );

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        EDITAR INVENTARIO
        ==========================================================================*/
        $(".btn-editarInventario").on("click", function () {
            //Capturamos el id del inventario del boton
            let id = $(this).attr("id_inventario");
            //Le pasamos el ID al input escondido para validar AGREGAR/EDITAR
            $("#inventario_id").val(id);
            //INSTRUCCION PARA EXPANDIR EL COLLAPSE DEL DATA WIDGET DEL CARD INVENTARIO
            $("#card-inventario").CardWidget("expand");
            //llevar el
            $(window).scrollTop(0);
            //AJAX que trae los datos del inventario seleccionado
            let datos = new FormData();
            datos.append("DatosInventario", "ok");
            datos.append("id", id);
            $.ajax({
                type: "POST",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    $("#placa_invent")
                        .val(response.idvehiculo)
                        .trigger("change");
                    $("#kilo_invent").val(response.kilometraje);
                    $("#fecha_invent").val(response.fecha_inventario);
                    $("#observador_conductoresInventario").attr(
                        "idconductor",
                        response.idconductor
                    );
                    $("#numero_luces").val(response.numero_luces_internas);
                    $("#numeroparlantes").val(response.num_parlantes);
                    $("#numsalimarti").val(response.Nsalidas_martillos);
                    //$("#inventario_tipo_vel").val(response.tipo_vel_inven).trigger("change");

                    var keys = Object.keys(response);
                    var values = Object.values(response);

                    // Recorremos ambos arreglos
                    for (let index = 0; index < keys.length; index++) {
                        // NO tomamos las llaves numericas
                        if (isNaN(keys[index])) {
                            if (
                                keys[index] != "idvehiculo" &&
                                keys[index] != "tipo_vel" &&
                                keys[index] != "numinter_invent" &&
                                keys[index] != "marca_invent" &&
                                keys[index] != "modelo_invent" &&
                                keys[index] != "idconductor" &&
                                keys[index] != "categoria_invent" &&
                                keys[index] != "vencimineto_inventario"
                            ) {
                                // Si el input es un check - radio
                                $(
                                    `input[name='${keys[index]}'][value='${values[index]}']`
                                ).iCheck("check");
                            }
                        }
                    }
                    AjaxTablaEvidencias(response.idvehiculo);
                },
            });
        });

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        RESTABLECER INVENTARIO
        ==========================================================================*/
        $("#restablecer").click(function (e) {
            $("#placa_invent").val("").trigger("change");
        });

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        FUNCION PARA LISTAR LAS IMAGENES DE EVIDENCIA
        ==========================================================================*/
        const AjaxTablaEvidencias = (idvehiculo) => {
            // Quitar datatable
            $(`#tabla_fotos`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody_tabla_fotos`).html("");

            let datos = new FormData();
            datos.append(`FotosVehiculos`, "ok");
            datos.append("idvehiculo", idvehiculo);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $(`#tbody_tabla_fotos`).html(response);
                    } else {
                        $(`#tbody_tabla_fotos`).html("");
                    }
                },
            });
        };

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        FUNCION PARA CARGAR LAS FOTOS DE LOS VEHICULOS EN COMPUTADOR Y CELULAR
        ==========================================================================*/
        let cargarFotosVehiculo = (response) => {
            let htmljumbo = ``;
            let htmlcarouselindicators = ``;
            let htmlcarouselinner = ``;

            for (let index = 0; index < response.length; index++) {
                htmljumbo += `<div class="jumbotron jumbotron-fluid">
                        <div class="container insertar_fotos">
                          <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                        </div>
                      </div>
                      <hr class="my-5">`;

                let activo = index == 0 ? `active` : ``;

                htmlcarouselindicators += `<li data-target="#col_fotos_inventario" data-slide-to="${index}" class="${activo}"></li>`;
                htmlcarouselinner += `<div class="carousel-item ${activo}">
                                            <div class="btn-group my-1" role="group" aria-label="Basic example">
                                                <a class="btn btn-info" href="${response[index].ruta_foto}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                            </div>
                                            <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                              </div>`;
            }

            $("#col_fotos_inventario1").html(htmljumbo);
            $("#col_fotos_inventario")
                .find(".carousel-indicators")
                .html(htmlcarouselindicators);
            $("#col_fotos_inventario")
                .find(".carousel-inner")
                .html(htmlcarouselinner);
        };

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        FUNCION PARA CAMBIAR EL INVENTARIO SEGUN EL TIPO DE VEHICULO
        ==========================================================================*/
        let inventario_tipo_vel = (response) => {
            if (response == "CAMIONETA-MICRO") {
                $(".input-camioneta").addClass("d-none");
                $(".camioneta").removeAttr("required");
                $(".camioneta").val(0);
            } else if (response == "BUS-BUSETA") {
                $(".input-camioneta").removeClass("d-none");
                $(".camioneta").prop("required", true);
            }
        };

        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        GUARDAR IMAGENES DE EVIDENCIA
        ==========================================================================*/
        $("#formulario_evidencias").submit(function (e) {
            e.preventDefault();

            let idvehiculo = $("#placa_invent").val();

            if (idvehiculo != "") {
                var fotoInventario = $("#foto_evidencia_inventario")[0].files;
                var observaciones = $("#observaciones").val();

                if (fotoInventario.length > 0 && observaciones != "") {
                    var datos = new FormData();
                    datos.append("GuardarEvidencia", "ok");
                    datos.append("idvehiculo", idvehiculo);
                    datos.append("fotoInventario", fotoInventario[0]);
                    datos.append("observaciones", observaciones);

                    $.ajax({
                        type: "post",
                        url: `${urlPagina}ajax/mantenimiento.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
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
                }
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Seleccione un vehículo / placa",
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });

        /*==========================================================================
        BOTON CAMBIAR ESTADO EVIDENCIA
        ==========================================================================*/
        $(document).on("click", ".btn-estado", function () {
            var $boton = $(this);
            var idevidencia = $(this).attr("idevidencia");
            var idvehiculo = $(this).attr("idvehiculo");
            var estado = $(this).attr("estado");

            var textoBoton =
                estado == "PENDIENTE" ? "Resuelto!" : "Aún pendiente";
            var colorBoton = estado == "PENDIENTE" ? "#5cb85c" : "#d33";
            Swal.fire({
                title: `Esto se encuentra ${estado}`,
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
                            url: `${urlPagina}ajax/mantenimiento.ajax.php`,
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
                                else
                                    Swal.fire({
                                        icon: "error",
                                        title: "Ha ocurrido un error, por favor intente de nuevo",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location = "m-inventario";
                                        }
                                    });
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

        /*==========================================================================
        BOTON VALIDAR INPUTS REQUERIDOS
        ==========================================================================*/
        $(document).on("click", ".btn-agregar-inventario", function () {
            Requeridos = [];

            $("input:invalid").each(function (index, element) {
                var $input = $(this);

                var idform = $input.closest("form").attr("id");

                if (idform == "formulario_inventario") {
                    Requeridos.push($input);
                }
            });

            var tables = [];

            $("input:invalid").each(function (index, element) {
                var $inputs = $(this);
                var table = $inputs.closest("table").attr("nombre");

                if (table == undefined) table = "Datos inventario";

                if (!tables.includes(table)) tables.push(table);
            });

            if (Requeridos.length > 0) {
                let InputRequeridos = `<ul>`;
                tables.forEach((element) => {
                    InputRequeridos += `<li>${element}</li>`;
                });
                InputRequeridos += `</ul>`;

                Swal.fire({
                    icon: "warning",
                    html: `<div class="text-left">
                                      <p class="font-weight-bold">Hace falta diligenciar campos en los siguientes apartados:</p>
                                          ${InputRequeridos}
                                  </div>`,
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                });
            }
        });

        /*==========================================================================
        BOTON ELIMINAR INVENTARIO
        ===========================================================================*/
        $(".btn-eliminar").on("click", function () {
            let id = $(this).attr("id_inventario");

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
                    datos.append("EliminarInventario", "ok");
                    datos.append("idvehiculo", id);

                    $.ajax({
                        type: "POST",
                        url: "ajax/mantenimiento.ajax.php",
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
                                    window.location = "m-inventario";
                                });
                            }
                        },
                    });
                }
            });
        });

        /* ===================================================
           VISUALIZAR PDF DEL INVENTARIO
        ===================================================*/
        $(document).on("click", ".btn-verInventario", function () {
            var id_inventario = $(this).attr("id_inventario");
            window.open(
                `./pdf/pdfinventario.php?id_inventario=${id_inventario}`,
                "",
                "width=1280,height=720,left=50,top=50,toolbar=yes"
            );
        });

        /*===================================================
              INICIALIZAR DATATABLE
        ===================================================*/
        let FiltroTablaInventario = () => {
            /* ===================================================
                    FILTRAR POR COLUMNA
            ====================================================*/
            /* Filtrar por columna */
            //Clonar el tr del thead
            $(`#tabla_resumen_inventario thead tr:eq(1)`)
                .clone(true)
                .appendTo(`#tabla_resumen_inventario thead`);
            //Por cada th creado hacer lo siguiente
            $(`#tabla_resumen_inventario thead tr:eq(2) th`).each(function (i) {
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
            var table = dataTableCustom(`#tabla_resumen_inventario`, buttons);
        };
        FiltroTablaInventario();
    }

    /* ===================================================
    * REVISIÓN TECNICOMECÁNICA
  ====================================================== */
    if (
        window.location.href == `${urlPagina}m-revision-tm/` ||
        window.location.href == `${urlPagina}m-revision-tm`
    ) {
        /*============================================
            CLICK EN EDITAR REVISIÓN TECNICOMECANICA
        ==============================================*/
        $(document).on("click", ".btnEditarRev", function () {
            $("#titulo-modal-tecnomecanica").html(
                "Editar revisión tecnicomecánica"
            );

            var idrevision = $(this).attr("idrevision");
            $("#idrevision").val(idrevision);

            var datos = new FormData();
            datos.append("DatosRevision", "ok");
            datos.append("idrevision", idrevision);

            $.ajax({
                type: "POST",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
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
                                    keys[index] != "idconductor"
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

                        $("#observacion").val(response.observacion);
                        $("#cant_externos").val(response.cant_externos);
                        $("#cant_internos").val(response.cant_internos);
                        $("#cant_martillos").val(response.cant_martillos);
                        $("#kilometraje").val(response.kilometraje);
                    }
                },
            });

            var idvehiculo = $(this).attr("idvehiculo");
            $("#idvehiculo").val(idvehiculo);

            var datos = new FormData();
            datos.append("DatosVehiculo", "ok");
            datos.append("idvehiculo", idvehiculo);

            $.ajax({
                type: "POST",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    $("#placa").val(response.idvehiculo).trigger("change");
                },
            });
        });

        /*==========================================
          CARGAR DATOS POR PLACA
        =========================================*/
        $(document).on("change", "#placa", function () {
            let idvehiculo = $(this).val();

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
                    //Se resetea los colores del fondo de documentos
                    $(".documentos").val("").trigger("change");
                    $(".bg-success").removeClass("bg-success");
                    $(".bg-danger").removeClass("bg-danger");

                    //DESACTIVAR INPUTS DEPENDIENDO DEL TIPO DE VEHICULO
                    if (Vehiculo.categoria == "CAMIONETA-MICRO") {
                        $("input[name='freno_ahogo']").attr("disabled", true);
                        $("input[name='compresor']").attr("disabled", true);
                        $("input[name='fuga_aire']").attr("disabled", true);
                        $("input[name='banda_delantera_derecha']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='banda_delantera_izquierda']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='rachets']").attr("disabled", true);
                        $("input[name='llantar5']").attr("disabled", true);
                        $("input[name='llantar6']").attr("disabled", true);
                        $("input[name='tanques_aire']").attr("disabled", true);
                        $("input[name='luces_delimitadoras']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='rutero']").attr("disabled", true);
                        $("input[name='estribos_puerta']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='brazo_limpiaparabrisas_derecho']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='parabrisas_izquierdo']").attr(
                            "disabled",
                            true
                        );
                        $(
                            "input[name='brazo_limpiaparabrisas_izquierdo']"
                        ).attr("disabled", true);
                        $("input[name='vidrio_puerta_principal']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='vidrio_segunda_puerta']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='claraboyas']").attr("disabled", true);
                        $("input[name='parales']").attr("disabled", true);
                        $("input[name='booster_puertas']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='reloj_vigia']").attr("disabled", true);
                        $("input[name='vigia_delantera_derecha']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='vigia_delantera_izquierda']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='vigia_trasera_derecha']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='vigia_trasera_izquierda']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='martillo_emergencia']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='dispositivo_velocidad']").attr(
                            "disabled",
                            true
                        );
                        $("input[name='balizas']").attr("disabled", true);
                    } else if (Vehiculo.categoria == "BUS-BUSETA") {
                        $("input[name='freno_ahogo']").attr("disabled", false);
                        $("input[name='compresor']").attr("disabled", false);
                        $("input[name='fuga_aire']").attr("disabled", false);
                        $("input[name='banda_delantera_derecha']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='banda_delantera_izquierda']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='rachets']").attr("disabled", false);
                        $("input[name='llantar5']").attr("disabled", false);
                        $("input[name='llantar6']").attr("disabled", false);
                        $("input[name='tanques_aire']").attr("disabled", false);
                        $("input[name='luces_delimitadoras']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='rutero']").attr("disabled", false);
                        $("input[name='estribos_puerta']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='brazo_limpiaparabrisas_derecho']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='parabrisas_izquierdo']").attr(
                            "disabled",
                            false
                        );
                        $(
                            "input[name='brazo_limpiaparabrisas_izquierdo']"
                        ).attr("disabled", false);
                        $("input[name='vidrio_puerta_principal']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='vidrio_segunda_puerta']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='claraboyas']").attr("disabled", false);
                        $("input[name='parales']").attr("disabled", false);
                        $("input[name='booster_puertas']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='reloj_vigia']").attr("disabled", false);
                        $("input[name='vigia_delantera_derecha']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='vigia_delantera_izquierda']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='vigia_trasera_derecha']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='vigia_trasera_izquierda']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='martillo_emergencia']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='dispositivo_velocidad']").attr(
                            "disabled",
                            false
                        );
                        $("input[name='balizas']").attr("disabled", false);
                    }

                    $("#numinterno").val(Vehiculo.numinterno);
                    $("#modelo").val(Vehiculo.modelo);
                    $("#tipo_vehiculo")
                        .val(Vehiculo.idtipovehiculo)
                        .trigger("change");
                    $("#tipo_vehiculo").attr("disabled", "disabled");
                    $("#marca").val(Vehiculo.idmarca).trigger("change");
                    $("#marca").attr("disabled", "disabled");
                    $("#tarjeta_operacion").val(Vehiculo.idtipodocumento);
                    $("#num_interno")
                        .val(Vehiculo.idvehiculo)
                        .trigger("change");
                    $("#num_interno").attr("disabled", "disabled");

                    //CAMBIAR IMAGENES DE LLANTAS SEGUN LA CATEGORIA
                    imagenesLlantas(Vehiculo.categoria);
                    // CARGA LOS DOCUMENTOS DEL VEHICULO
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
                                $(`#documento_${element.idtipodocumento}`).val(
                                    element.fechafin
                                );

                                // Color del fondo segun la fecha
                                // var bg =
                                //     element.fechafin >=
                                //     moment().format("YYYY-MM-DD")
                                //         ? "bg-success"
                                //         : "bg-danger";

                                bg = semaforo_tipo1(
                                    element.fechafin,
                                    moment().format("YYYY-MM-DD")
                                );
                                $(
                                    `#documento_${element.idtipodocumento}`
                                ).addClass("bg-" + bg);
                            });
                        },
                    });
                },
            });
        });

        /*============================================
            CLICK EN NUEVA REVISIÓN
        ==============================================*/
        $(document).on("click", ".btn-nuevaRevision", function () {
            $("#titulo-modal-tecnomecanica").html(
                "Nueva revisión tecnicomecánica"
            );
            $("#datosrevision_form").trigger("reset");
            $(".select2-single").val(" ").trigger("change");
            $(".documentos").val("").trigger("change");

            $(document).on("change", "#placa", function () {
                let idvehiculo = $(this).val();

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
                        //Se resetea los colores del fondo de documentos
                        $(".documentos").val("").trigger("change");
                        $(".bg-success").removeClass("bg-success");
                        $(".bg-danger").removeClass("bg-danger");

                        $("#numinterno").val(Vehiculo.numinterno);
                        $("#modelo").val(Vehiculo.modelo);
                        $("#tipo_vehiculo")
                            .val(Vehiculo.idtipovehiculo)
                            .trigger("change");
                        $("#tipo_vehiculo").attr("disabled", "disabled");
                        $("#marca").val(Vehiculo.idmarca).trigger("change");
                        $("#marca").attr("disabled", "disabled");
                        $("#tarjeta_operacion").val(Vehiculo.idtipodocumento);
                        $("#num_interno")
                            .val(Vehiculo.idvehiculo)
                            .trigger("change");
                        $("#num_interno").attr("disabled", "disabled");

                        //CARGA DOCUMENTOS DEL VEHICULO

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
                    },
                });
            });
        });

        /*============================================
            ELIMINAR REVISIÓN TECNICOMECANICA
        ==============================================*/
        $(document).on("click", ".btnBorrarRev", function () {
            var idrevision = $(this).attr("idrevision");
            $("#idrevision").val(idrevision);

            Swal.fire({
                icon: "warning",
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea borrar este registro?",
                confirmButtonText: "Si, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#0080ff",
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value == true) {
                    var datos = new FormData();
                    datos.append("EliminarRevision", "ok");
                    datos.append("idrevision", idrevision);

                    $.ajax({
                        type: "POST",
                        url: "ajax/mantenimiento.ajax.php",
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
                                    window.location = "m-revision-tm";
                                });
                            }
                        },
                    });
                }
            });
        });

        /*============================================
            AGREGAR/GUARDAR REVISIÓN
        ==============================================*/
        $(document).on("click", ".btn-guardarRev", function () {
            Areas = [];
            Requeridos = [];
            Elementos = [];

            //Validación de inputs

            $("input:invalid").each(function (index, element) {
                var $input = $(this);

                var idform = $input.closest("form").attr("id");

                if (idform == "datosrevision_form") {
                    Requeridos.push($input);
                }
            });

            //Validación textarea

            $("textarea:invalid").each(function (index, element) {
                var $area = $(this);

                var idform = $area.closest("form").attr("id");

                if (idform == "datosrevision_form") {
                    Areas.push($area);
                }
            });

            var tab = [];

            //Se trae los tabs
            $("input:invalid").each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest("table").attr("nombre");
                if (idtab == undefined) idtab = "Documentos";
                if (!tab.includes(idtab)) tab.push(idtab);
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

        /*====================================================================================
            FUNCION QUE RECIBE UNA CATEGORIA DE VEHICULO Y CAMBIA LAS IMAGENES DE LAS LLANTAS
        ====================================================================================*/
        let imagenesLlantas = (categoria) => {
            if (categoria == "BUS-BUSETA") {
                $("#llantas_bus_buseta").removeClass("d-none");
                $("#llantas_camioneta_micro").addClass("d-none");
            } else if (categoria == "CAMIONETA-MICRO") {
                $("#llantas_camioneta_micro").removeClass("d-none");
                $("#llantas_bus_buseta").addClass("d-none");
            }
        };
    }

    /* ===================================================
    * MANTENIMIENTOS
  ====================================================== */
    if (
        window.location.href == `${urlPagina}m-mantenimientos/` ||
        window.location.href == `${urlPagina}m-mantenimientos`
    ) {
        /*===================================================
     **********ORDEN DE SERVICIO/MANTENIMIENTO*********
    ====================================================*/

        //CLICK EN ELIMINAR FILA DE REPUESTO EN ORDEN DE SERVICIO
        $(document).on("click", ".btn-EliminarRepuesto", function () {
            $("#tbody_repuesto tr:last").remove();
        });

        //CLICK EN AÑADIR FILA EN MANO DE OBRA

        $(document).on("click", ".btn-agregarManoObra", function () {
            var dinamico = $("#filas_tabla_manoObra tr:last").attr(
                "consecutivo"
            );

            dinamico = parseInt(dinamico) + 1;

            var fila =
                `<tr consecutivo="${dinamico}">` +
                `<td style="width: 300px">` +
                `<div class="input-group">` +
                `<input class="form-control form-control-sm" type="text" id="proveedor_${dinamico}" placeholder="Seleccione un repuesto"  maxlength="0">` +
                `<div class="input-group-append">` +
                `<button type="button" class="btn btn-sm btn-success btn-md btn-proveedor" consecutivo="${dinamico}" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>` +
                `</div>` +
                `</div>` +
                `</td>` +
                `<input type="hidden" id="idproveedor_${dinamico}" name="proveedor[]"> ` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm" id="descrip_${dinamico}" name="descrip_mano[]">` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm input-valorMano" id="valor_${dinamico}" consecutivo="${dinamico}" name="valor_mano[]">` +
                `</td>` +
                `<td style="width: 300px"><input type="text" class="form-control form-control-sm input-cantMano" consecutivo="${dinamico}" id="cantmanoObra_${dinamico}" name="cantmanoObra[]" readonly></td>` +
                `<td>` +
                `<input type="text" class="form-control form-control-sm input-ivaMano" id="iva_mano_${dinamico}" name="iva_mano[]" consecutivo="${dinamico}">` +
                `</td>` +
                `<td>` +
                `<input type="text" class="form-control form-control-sm" id="total_mano_${dinamico}" name="total_mano[]" readonly>` +
                `</td>` +
                `<td style="width: 300px">
                <input type="hidden" id="servicio_mano_${dinamico}" name="servicio_mano[]">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="servmanoObra_${dinamico}" name="servmanoObra[]" placeholder="Seleccione un servicio"  maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-success btn-sm btn-md btn-servicios" seccion="manoObra" consecutivo="${dinamico}" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                </div>
                </div>
                </td>` +
                `<td style="width: 900px;">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="sistemanoObra_${dinamico}" name="sistmanoobra[]" placeholder="Seleccione el tipo de sistema"  maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="manoObra" consecutivo="${dinamico}" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                </div>
                </div>
                </td>` +
                `<td style="width: 900px;">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="mantenimientoManoObra_${dinamico}" name="mantenimientomanobra[]" placeholder="Seleccione un mantenimiento"  maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="manoObra" consecutivo="${dinamico}" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                </div>
                </div>
                </td>` +
                `<td style="display: none;">
                <input type="hidden" id="idcuenta_mano_${dinamico}" name="idcuenta_mano[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="cuenta_mano_${dinamico}" name="cuenta_mano[]" placeholder="Seleccione una cuenta" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="manoObra" consecutivo="${dinamico}" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
                    </div>
                </div>
                </td>` +
                `</tr>`;

            $("#filas_tabla_manoObra").append(fila);
        });

        //CLICK EN ELIMINAR FILA DE MANO DE OBRA EN ORDEN DE SERVICIO
        $(document).on("click", ".btn-EliminarManoObra", function () {
            $("#filas_tabla_manoObra tr:last").remove();
        });

        //CLICK EN AÑADIR FILA A REPUESTO
        $(document).on("click", ".btn-agregarRepuestoSolicitud", function () {
            var dinamico = $("#filas_tabla_repuestoSolicitud tr:last").attr(
                "consecutivo"
            );

            dinamico = parseInt(dinamico) + 1;

            var fila =
                `<tr consecutivo="${dinamico}">
                <td style="width: 300px">` +
                `<div class="input-group">` +
                `<input class="form-control form-control-sm" type="text" id="repuesto_${dinamico}" name="repuesto[] "placeholder="Seleccione un repuesto"  maxlength="0">` +
                `<div class="input-group-append">` +
                `<button type="button" class="btn btn-success btn-sm btn-md btn-repuestos" consecutivo="${dinamico}" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>` +
                `</div>` +
                `</div>` +
                `</td>` +
                `<input type="hidden" id="inventario_${dinamico}" name="inventario[]">` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm" id="refrepuestos_${dinamico}" name="referencia_repuesto[]"  maxlength="0" readonly>` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm" id="codrepuestos_${dinamico}" name="codigo_repuesto[]"  maxlength="0" readonly>` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm input-valorrepuesto" id="valorrepuestos_${dinamico}" consecutivo="${dinamico}" name="valor_repuesto[]" maxlength="0" >` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm input-cantrepuesto" consecutivo="${dinamico}" id="cantrepuestos_${dinamico}" name="cantidad_repuesto[]" readonly>` +
                `</td>` +
                `<td>` +
                `<input type="text" class="form-control form-control-sm input-ivarepuesto" id="iva_repuesto_${dinamico}" consecutivo="${dinamico}" name="iva_repuesto[]">` +
                `</td>` +
                `<td><input type="text" class="form-control form-control-sm" id="total_repuesto_${dinamico}" name="total_repuesto[]" readonly></td>` +
                `<input type="hidden" name="idproveedor_repuesto[]" id="idproveedor_repuesto_${dinamico}">` +
                `<td><input type="text" class="form-control form-control-sm" id="proveedor_repuesto_${dinamico}" name="proveedor_repuesto[]" readonly></td>` +
                `<td style="width: 900px;">
                <input type="hidden" id="servicio_repuesto_${dinamico}" name="servicio_repuesto[]">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="servrepuesto_${dinamico}" name="servrepuesto[]" placeholder="Seleccione un servicio"  maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="repuesto" consecutivo="${dinamico}" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                </div>
                </div>
                </td>` +
                `<td style="width: 900px;">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="sistemarepuesto_${dinamico}" name="sistemarepuesto[]" placeholder="Seleccione el tipo de sistema"  maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="repuesto" consecutivo="${dinamico}" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                </div>
                </div>
                </td>` +
                `<td style="width: 900px;">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="mantenimientorepuesto_${dinamico}" name="mantenimientorepuesto[]" placeholder="Seleccione un mantenimiento"  maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="repuesto" consecutivo="${dinamico}" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                </div>
                </div>
                </td>` +
                `<td style="display: none;">
                <input type="hidden" id="idcuenta_repuesto_${dinamico}" name="idcuenta[]">
                <div class="input-group">
                <input class="form-control form-control-sm" type="text" id="cuenta_repuesto_${dinamico}" name="cuenta_repuesto[]" placeholder="Seleccione una cuenta" maxlength="0">
                <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="repuesto" consecutivo="${dinamico}" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
                </div>
                </div>
                </td>` +
                `</tr> `;

            $("#filas_tabla_repuestoSolicitud").append(fila);
        });

        //CLICK QUE ABRE MODAL DE SERVICIOS
        $(document).on("click", ".btn-servicios", function () {
            let consecutivo = $(this).attr("consecutivo");
            let seccion = $(this).attr("seccion");

            var datos = new FormData();
            datos.append("ListaServicios", "ok");
            datos.append("consecutivo", consecutivo);
            datos.append("seccion", seccion);
            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tBodyServicios").html(response);
                    } else {
                        $("#tBodyServicios").html("");
                    }
                },
            });
        });

        //CLICK EN MODAL QUE CARGA TIPOS DE SISTEMAS
        $(document).on("click", ".btn-sistema", function () {
            let consecutivo = $(this).attr("consecutivo");
            let seccion = $(this).attr("seccion");

            $(".btn-SeleccionarSistema").attr("seccion", seccion);
            $(".btn-SeleccionarSistema").attr("consecutivo", consecutivo);
        });

        //CLICK EN SELECCIOANR TIPO DE SISTEMA
        $(document).on("click", ".btn-SeleccionarSistema", function () {
            let nombre = $(this).attr("nombre");
            let consecutivo = $(this).attr("consecutivo");
            let seccion = $(this).attr("seccion");

            $("#modal-sistema").modal("hide");

            if (seccion == "repuesto") {
                $(`#sistemarepuesto_${consecutivo}`).val(nombre);
            } else {
                $(`#sistemanoObra_${consecutivo}`).val(nombre);
            }
        });

        //CLICK EN MODAL QUE CARGA TIPOS DE MANTENIMIENTOS
        $(document).on("click", ".btn-mantenimiento", function () {
            let consecutivo = $(this).attr("consecutivo");
            let seccion = $(this).attr("seccion");

            $(".btn-SeleccionarMantenimiento").attr("seccion", seccion);
            $(".btn-SeleccionarMantenimiento").attr("consecutivo", consecutivo);
        });

        //CLICK EN SELECCIONAR TIPO DE MANTENIMIENTO
        $(document).on("click", ".btn-SeleccionarMantenimiento", function () {
            let nombre = $(this).attr("nombre");
            let consecutivo = $(this).attr("consecutivo");
            let seccion = $(this).attr("seccion");

            $("#modal-mantenimiento").modal("hide");

            if (seccion == "repuesto") {
                $(`#mantenimientorepuesto_${consecutivo}`).val(nombre);
            } else {
                $(`#mantenimientoManoObra_${consecutivo}`).val(nombre);
            }
        });

        //CLICK EN ELIMINAR FLA A RESPUESTO EN SOLICITUD DE SERVICIO
        $(document).on("click", ".btn-EliminarRepuestoSolicitud", function () {
            $("#filas_tabla_repuestoSolicitud tr:last").remove();
        });

        //CARGAR TABLA SERVICIOS POR VEHICULO

        let AjaxTablaServiciosxVehiculo = (idvehiculo) => {
            // Quitar datatable
            $("#tablaProgramacionServ").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyProgramacionServ").html("");

            var datos = new FormData();
            datos.append("ServiciosxVehiculo", "ok");
            datos.append("idvehiculo", idvehiculo);
            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodyProgramacionServ").html(response);
                    } else {
                        $("#tbodyProgramacionServ").html("");
                    }

                    /* ===================================================
                   INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                   ===================================================*/
                    // var buttons = [
                    //   { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    // ];
                    // var table = dataTableCustom(`#tablaProgramacionServ`, buttons);
                },
            });
        };

        /*=========================================================================
            FUNCION PARA CARGAR EVIDENCIAS DEL VEHICULO EN ORDEN DE SERVICIO
        ========================================================================*/
        const AjaxTablaEvidenciasOrden = (idvehiculo) => {
            // Quitar datatable
            $(`#tablaEvidenciasServ`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbodyEvidenciaServ`).html("");

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
                        $(`#tbodyEvidenciaServ`).html(response);
                    } else {
                        $(`#tbodyEvidenciaServ`).html("");
                    }

                    /* ===================================================
                                        INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                                        ===================================================*/
                    // var buttons = [
                    //     {
                    //         extend: "excel",
                    //         className: "btn-info",
                    //         text: '<i class="far fa-file-excel"></i> Exportar',
                    //     },
                    // ];
                    // var table = dataTableCustom(`#tablaEvidenciasServ`, buttons);
                },
            });
        };

        /*===================================================
         FUNCION PARA CARGAR TABLA PROGRAMACION POR VEHÍCULO
        =====================================================*/
        const AjaxTablaProgramacionxVehiculo = (idvehiculo, tbody, tabla) => {

            // Quitar datatable
            $(tabla).dataTable().fnDestroy();
            // Borrar datos
            $(tbody).html("");

            var datos = new FormData();
            datos.append("TablaProgramacionxVehiculo", "ok");
            datos.append("idvehiculo", idvehiculo);
            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    
                    if (response != "" || response != undefined) {
                        $(tbody).html(response);
                    } else {
                        $(tbody).html("");
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    var buttons = [
                      { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    // var table = dataTableCustom(tabla, buttons);

                    var table = $(tabla).DataTable({
                        dom:
                            "<'row'<'col-12 text-right'B>>" +
                            "<'row mt-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: buttons,
                        orderCellsTop: true,
                        fixedHeader: true,
                        order: [],
                        language: {
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                            sInfoEmpty:
                                "Mostrando registros del 0 al 0 de un total de 0",
                            sInfoFiltered:
                                "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
                            sInfoPostFix: "",
                            sSearch: "Buscar:",
                            sUrl: "",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior",
                            },
                            oAria: {
                                sSortAscending:
                                    ": Activar para ordenar la columna de manera ascendente",
                                sSortDescending:
                                    ": Activar para ordenar la columna de manera descendente",
                            },
                        },
                        lengthMenu: [
                            [10, 25, 50, 75, -1],
                            [10, 25, 50, 75, "Todo"],
                        ],
                        fnDrawCallback: function () {
                            $table = $(this);

                            // only apply this to specific tables
                            if ($table.closest(".datatable-multi-row").length) {
                                // for each row in the table body...
                                $table.find("tbody>tr").each(function () {
                                    var $tr = $(this);

                                    // get the "extra row" content from the <script> tag.
                                    // note, this could be any DOM object in the row.
                                    var extra_row = $tr
                                        .find(".extra-row-content")
                                        .html();

                                    // in case draw() fires multiple times,
                                    // we only want to add new rows once.
                                    if (!$tr.next().hasClass("dt-added")) {
                                        $tr.after(extra_row);
                                        $tr.find("td").each(function () {
                                            // for each cell in the top row,
                                            // set the "rowspan" according to the data value.
                                            var $td = $(this);
                                            var rowspan = parseInt(
                                                $td.data(
                                                    "datatable-multi-row-rowspan"
                                                ),
                                                10
                                            );
                                            if (rowspan) {
                                                $td.attr("rowspan", rowspan);
                                            }
                                        });
                                    }
                                });
                            } // end if the table has the proper class
                        }, // end fnDrawCallback()
                    });
                },
            });
        };

        // CARGAR DATOS DEL VEHICULO
        $(document).on("change", "#placa_OrdServ", function () {

            let fecha_actual = moment().format("YYYY-MM-DD");
            let idvehiculo = $(this).val();

            $(".documentos").val("").removeClass("bg-danger bg-success");

            if (idvehiculo == null) {
                $(".documentos").val("");
            }


            //CARGAR TABLA DE PROGRAMACIÓN POR VEHÍCULO
            AjaxTablaProgramacionxVehiculo(
                idvehiculo,
                "#tbodyProgramacionServ",
                "#tablaProgramacionServ"
            );
            
            AjaxTablaEvidenciasOrden(idvehiculo);

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
                    $("#kilome_ordSer").val(Vehiculo.kilometraje);
                    $("#numinterno_ordSer").val(Vehiculo.numinterno);
                    $("#modelo_ordSer").val(Vehiculo.modelo);
                    $("#clasevehiculo_ordSer")
                        .val(Vehiculo.tipovehiculo)
                        .trigger("change");
                    $("#marca_ordSer").val(Vehiculo.marca);
                    $("#cliente_orderServ").val(Vehiculo.cliente);
                },
            });

            //DOCUMENTOS DEL VEHÍCULO
            var datos = new FormData();
            datos.append("DocumentosxVehiculo", "ok");
            datos.append("idvehiculo", idvehiculo);
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
                        $(`#documento_${element.idtipodocumento}`).val(
                            element.fechafin
                        );
                        // var bg =
                        //     element.fechafin >= moment().format("YYYY-MM-DD")
                        //         ? "bg-success"
                        //         : "bg-danger";
                        // $(`#documento_${element.idtipodocumento}`).addClass(bg);

                        bg = semaforo_tipo1(
                            element.fechafin,
                            moment().format("YYYY-MM-DD")
                        );

                        $(`#documento_${element.idtipodocumento}`).addClass(
                            "bg-" + bg
                        );
                    });
                },
            });

            // var datos = new FormData();
            // datos.append("DocumentosxVehiculo", "ok");
            // datos.append("idvehiculo", idvehiculo);
            // $.ajax({
            //     type: "post",
            //     url: `${urlPagina}ajax/vehicular.ajax.php`,
            //     data: datos,
            //     dataType: "json",
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     success: function (response) {
            //         response.forEach((element) => {
            //             // Color del fondo segun la fecha
            //             var bg =
            //                 element.fechafin >= moment().format("YYYY-MM-DD")
            //                     ? "bg-success"
            //                     : "bg-danger";
            //             $(`#documento_${element.idtipodocumento}`).addClass(bg);

            //             // Asigno valor fecha
            //             $(`#documento_${element.idtipodocumento}`).val(
            //                 element.fechafin
            //             );
            //         });
            //     },
            // });
        });

        //CARGAR TABLA DE PRODUCTOS
        let AjaxTablaProductos = (consecutivo) => {
            // Quitar datatable
            $("#tablaRepuesto").dataTable().fnDestroy();
            // Borrar datos
            $("#tBodyRepuesto").html("");

            var datos = new FormData();
            datos.append("ListaProductos", "ok");
            datos.append("consecutivo", consecutivo);
            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tBodyRepuesto").html(response);
                    } else {
                        $("#tBodyRepuesto").html("");
                    }

                    /* ===================================================
                    FILTRAR POR COLUMNA
                    ====================================================*/
                    /* Filtrar por columna */
                    //Clonar el tr del thead
                    if ($(`#tablaRepuesto thead tr`).length == 1)
                        $(`#tablaRepuesto thead tr:eq(0)`)
                            .clone(true)
                            .appendTo(`#tablaRepuesto thead`);
                    //Por cada th creado hacer lo siguiente
                    $(`#tablaRepuesto thead tr:eq(1) th`).each(function (i) {
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
                    var table = dataTableCustom(`#tablaRepuesto`, buttons);
                },
            });
        };

        /* =====================================================
        CLICK EN CAMPO REPUESTO TABLA SOLICITUD DE SERVICIO
        =======================================================*/

        $(document).on("click", ".btn-repuestos", function () {
            //Mando el consecutivo para luego saber a que fila poner el repuesto seleccionado
            var consecutivo = $(this).attr("consecutivo");
            //FUNCION CARGAR TABLA PRODUCTOS
            AjaxTablaProductos(consecutivo);
        });

        /*==============================
        ClICK EN SELECCIONAR PRODUCTO
        ================================*/

        $(document).on("click", ".btnSeleccionarProducto", function () {
            $("#sucursalesProductos").modal("hide");

            var descripcion = $(this).attr("descripcion");
            var consecutivo = $(this).attr("consecutivo");
            var codigo = $(this).attr("codigo");
            var referencia = $(this).attr("referencia");
            var inventario = $(this).attr("inventario");
            var valor = $(this).attr("valor");
            var nombre_proveedor = $(this).attr("nombre_proveedor");
            var idproveedor = $(this).attr("idproveedor");

            //VUELVE REQUIRED LOS CAMPOS QUE VAN AMARRADOS AL REPUESTO
            $(`#servrepuesto_${consecutivo}`).attr("required", true);
            $(`#sistemarepuesto_${consecutivo}`).attr("required", true);
            $(`#mantenimientorepuesto_${consecutivo}`).attr("required", true);
            $(`#cantrepuestos_${consecutivo}`).attr("readonly", false);

            //PONE LOS DATOS EN LOS CAMPOS CORRESPONDIENTES
            $(`#inventario_${consecutivo} `).val(inventario);
            $(`#repuesto_${consecutivo} `).val(descripcion);
            $(`#refrepuestos_${consecutivo} `).val(referencia);
            $(`#codrepuestos_${consecutivo} `).val(codigo);
            $(`#valorrepuestos_${consecutivo} `).val(valor).trigger("change");
            $(`#proveedor_repuesto_${consecutivo} `).val(nombre_proveedor);
            $(`#idproveedor_repuesto_${consecutivo} `).val(idproveedor);
        });

        /*==============================
        CLICK EN SELECCIONAR SERVICIO
        ================================*/
        $(document).on("click", ".btn-SeleccionarServicio", function () {
            $("#modal-servicios").modal("hide");

            let servicio = $(this).attr("servicio");
            let seccion = $(this).attr("seccion");
            let consecutivo = $(this).attr("consecutivo");
            let idservicio = $(this).attr("idservicio");

            if (seccion == "repuesto") {
                $(`#servrepuesto_${consecutivo} `).val(servicio);
                $(`#servicio_repuesto_${consecutivo}`).val(idservicio);
            } else {
                $(`#servmanoObra_${consecutivo} `).val(servicio);
                $(`#servicio_mano_${consecutivo}`).val(idservicio);
            }
        });

        /*========================================
  ***************PROGRAMACION*****************
    ===========================================*/

        // CARGAR DATOS EN LA TABLA DEPENDIENDO DEL SERVICIO SELECCIONADO

        let AjaxTablaProgramacion = (idservicio) => {
            // Quitar datatable
            $("#tablaProgramacion").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyProgramacion").html("");

            var datos = new FormData();
            datos.append("Servicios", "ok");
            datos.append("idservicio", idservicio);
            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodyProgramacion").html(response);
                    } else {
                        $("#tbodyProgramacion").html("");
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
                    var table = dataTableCustom(`#tablaProgramacion`, buttons);
                },
            });
        };

        //SELECCION SERVICIO
        $(document).on("change", "#servicio", function () {
            //CARGA TABLA POR AJAX
            let idservicio = $(this).val();

            if (idservicio == "todo") $("#btn-guardarProgra").hide();
            else $("#btn-guardarProgra").show();

            AjaxTablaProgramacion(idservicio);
        });

        // BORRAR SERVICIO PROGRAMACIÓN
        $(document).on("click", ".btnBorrarProgramacion", function () {
            let idserviciovehiculo = $(this).attr("idserviciovehiculo");
            let idservicio = $(this).attr("idservicio");

            Swal.fire({
                icon: "warning",
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea borrar este registro?",
                confirmButtonText: "Si, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#0080ff",
                allowOutsideClick: false,
            }).then((result) => {
                if (result.value == true) {
                    var datos = new FormData();
                    datos.append("EliminarProgramacion", "ok");
                    datos.append("idserviciovehiculo", idserviciovehiculo);

                    $.ajax({
                        type: "POST",
                        url: "ajax/mantenimiento.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                AjaxTablaProgramacion(idservicio);
                                Swal.fire({
                                    icon: "success",
                                    showConfirmButton: true,
                                    title: "¡El registro ha sido borrado correctamente!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false,
                                }).then((result) => {
                                    window.location = "m-mantenimientos";
                                });
                            }
                        },
                    });
                }
            });
        });

        // GUARDAR SERVICIO
        $("#programacion_form").submit(function (e) {
            e.preventDefault();

            let idvehiculo = 0;
            let kilometrajeFrm = 0;

            var datosFrm = $(this).serializeArray();

            datosFrm.forEach((element) => {
                if (element.name == "idvehiculo_serv")
                    idvehiculo = element.value;
                if (element.name == "kilometraje_serv")
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

                    //Validamos si el kilometraje ingresado en el formulario es mayor o igual al que tiene el vehículo, de ser así puede guardar, de lo contrario no puede guardar
                    if (kilometrajeFrm >= Vehiculo.kilometraje) {
                        //AJAX PARA GUARDAR PROGRAMACIÓN
                        var datosAjax = new FormData();
                        datosAjax.append("GuardarProgramacion", "ok");

                        datosFrm.forEach((element) => {
                            datosAjax.append(element.name, element.value);
                        });

                        $.ajax({
                            type: "post",
                            url: "ajax/mantenimiento.ajax.php",
                            data: datosAjax,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if (response == "ok") {
                                    // Cargar de nuevo la tabla de servicios
                                    AjaxTablaProgramacion(1);
                                    // Reset del formulario
                                    $("#programacion_form").trigger("reset");
                                    $("#servicio").val("").trigger("change");
                                    $("#placa").val("").trigger("change");
                                    // Mensaje de éxito al usuario
                                    Swal.fire({
                                        icon: "success",
                                        title: "¡Datos guardados correctamente!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                    });
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Ha ocurrido un error, por favor intente de nuevo",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false,
                                    }).then((result) => {
                                        if (result.value) {
                                            window.location =
                                                "m-mantenimientos";
                                        }
                                    });
                                }
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Verifique el kilometraje del vehículo y vuelva a intentarlo",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                        });
                    }
                },
            });
        });

        /*============================================
            GUARDAR ORDEN DE SERVICIO
        ==============================================*/
        $("#ordenServ_form").submit(function (e) {
            e.preventDefault();

            var datosFrm = $(this).serializeArray();
            var datosAjax = new FormData();
            datosAjax.append("Guardar_OrdenServicio", "ok");

            var serviciosexternos = new Array();

            // CAPTURA EL IDSERVICIOEXTERNO DE LOS SERVICIOS QUE FUERON SELECCIONADOS
            $("input:checkbox:checked").each(function () {
                let valido = $(this).attr("idservicioexterno");
                if (!serviciosexternos.includes(valido)) {
                    serviciosexternos.push(valido);
                }
            });

            // MANDAMOS LOS SERVICIOS SELECCIONADOS
            serviciosexternos.forEach((element) => {
                datosAjax.append("serviciosexternos[]", element);
            });

            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "error") {
                        $("#numOrden_ordSer").val(response);
                        $("#btn-crearSolicitud").removeAttr("disabled");
                        $(".btn-exportar-solicitud").attr("idorden", response);

                        // Mensaje de éxito al usuario
                        Swal.fire({
                            icon: "success",
                            title: "¡Datos guardados correctamente!",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Ha ocurrido un error, por favor intente de nuevo",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false,
                        }).then((result) => {
                            if (result.value) {
                                window.location = "m-mantenimientos";
                            }
                        });
                    }
                },
            });
        });

        //TABLA DE PROVEEDORES
        let AjaxTablaProveedores = (consecutivo) => {
            // Quitar datatable
            $("#tablaProveedores").dataTable().fnDestroy();
            // Borrar datos
            $("#tBodyProveedores").html("");

            var datos = new FormData();
            datos.append("ListaProveedores", "ok");
            datos.append("consecutivo", consecutivo);
            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tBodyProveedores").html(response);
                    } else {
                        $("#tBodyProveedores").html("");
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
                    var table = dataTableCustom(`#tablaProveedores`, buttons);
                },
            });
        };

        // CLICK EN LISTA DE PROVEEDORES
        $(document).on("click", ".btn-proveedor", function () {
            let consecutivo = $(this).attr("consecutivo");
            AjaxTablaProveedores(consecutivo);
        });

        //CLICK EN SELECCIÓN DE PROVEEDORES
        $(document).on("click", ".btn-SeleccionarProveedor", function () {
            $("#modal-proveedores").modal("hide");

            var nombre_proveedor = $(this).attr("nombre_proveedor");
            var consecutivo = $(this).attr("consecutivo");
            var idproveedor = $(this).attr("idproveedor");
            // var codigo = $(this).attr("codigo");
            // var referencia = $(this).attr("referencia");

            //SE PONEN REQUIRED LOS CAMPOS DESPUÉS DE SELECCIONAR UN PROVEEDOR
            $(`#servmanoObra_${consecutivo}`).attr("required", true);
            $(`#sistemanoObra_${consecutivo}`).attr("required", true);
            $(`#mantenimientoManoObra_${consecutivo}`).attr("required", true);

            // SE CARGAN LOS DATOS SELECCIONADOS POR EL USUARIO
            $(`#proveedor_${consecutivo} `).val(nombre_proveedor);
            $(`#idproveedor_${consecutivo} `).val(idproveedor);
        });

        $(document).on("click", ".btn-nuevoProveedor", function () {
            $("#modal-proveedores").modal("hide");
        });

        //ESTADOS DE LA ORDEN
        $(document).on("change", "#estado", function () {
            let estado = this.value;

            if (estado == "3") {
                $("#estado").removeClass("bg-warning");
                $("#estado").removeClass("bg-success");
                $("#estado").removeClass("bg-danger");
                $("#fechainicio_ordSer").removeAttr("required");
            }

            //CANCELADA
            if (estado == 0) {
                $("#estado").removeClass("bg-warning");
                $("#estado").removeClass("bg-success");
                $("#estado").addClass("bg-danger");
                $("#fechainicio_ordSer").removeAttr("required");
            }

            //ABIERTA
            if (estado == 1) {
                $("#estado").removeClass("bg-danger");
                $("#estado").removeClass("bg-success");
                $("#estado").addClass("bg-warning");
                $("#fechainicio_ordSer").removeAttr("required");
            }

            // APROBADA
            if (estado == 2) {
                $("#estado").removeClass("bg-warning");
                $("#estado").removeClass("bg-danger");
                $("#estado").addClass("bg-success");

                //PONE REQUIRED FECHA INICIO TRABAJOS
                $("#fechainicio_ordSer").attr("required", true);
            }
        });

        //CLICK EN CREAR SOLICITUD DE SERVICIO
        $(document).on("click", "#btn-crearSolicitud", function () {
            $("#tbodyResumen").empty();

            let idorden = $("#numOrden_ordSer").val();

            var datos = new FormData();
            datos.append("DatosOrdenServicio", "ok");
            datos.append("idorden", idorden);
            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    let datos = response.datosOrden;

                    var fila = `<tr>
                     <td>${datos.idorden}</td>
                     <td>${datos.placa}</td>
                     <td>${datos.numinterno}</td>
                     <td>${datos.marca}</td>
                     <td>${datos.tipovehiculo}</td>
                     <td>${datos.modelo}</td>
                     <td>${datos.kilometraje}</td>
                     <td>${datos.Ffecha_entrada}</td>
                     </tr>`;

                    $("#tbodyResumen").append(fila);
                },
            });

            $("#servExternosResu").empty();
            $("#servicios_externos").clone().appendTo("#servExternosResu");
            $("#RepuestoResu").empty();
            $("#repuesto_solicitud").clone().appendTo("#RepuestoResu");
            $("#diagnosticoResu").empty();
            $("#diagnostico_solicitud").clone().appendTo("#diagnosticoResu");

            //DESHABILITAR OPCIONES EN LA MODAL
            $("#modal-solicitud")
                .find(".btn-repuestos")
                .attr("disabled", "disabled");
            $("#modal-solicitud")
                .find(".input-cantrepuesto")
                .attr("disabled", "disabled");
            $("#modal-solicitud")
                .find(".custom-control-label")
                .removeAttr("for");
            $("#modal-solicitud")
                .find(".diagno-resu")
                .attr("disabled", "disabled");

            $("#modal-solicitud")
                .find(".btn-servicios")
                .attr("disabled", "disabled");

            $("#modal-solicitud")
                .find(".btn-sistema")
                .attr("disabled", "disabled");

            $("#modal-solicitud")
                .find(".btn-mantenimiento")
                .attr("disabled", "disabled");

            $("#modal-solicitud")
                .find(".btn-cuenta")
                .attr("disabled", "disabled");

            $("#modal-solicitud")
                .find(".input-ivarepuesto")
                .attr("readonly", "readonly");
        });

        //FUNCION PARA CARGAR FILAS DE REPUESTO AL EDITAR ORDEN
        const filasEditarOrdenRepuesto = (dinamico, element) => {
            var fila =
                `<tr id="contenido_filas_repuestoSolicitud" consecutivo="${dinamico}">
      <td style="width: 300px">` +
                `<div class="input-group">` +
                `<input class="form-control form-control-sm" type="text" id="repuesto_${dinamico}" name="repuesto[] "placeholder="Seleccione un repuesto" value="${element.descripcion}"  maxlength="0">` +
                `<div class="input-group-append">` +
                `<button type="button" class="btn btn-sm btn-success btn-md btn-repuestos" consecutivo="${dinamico}" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>` +
                `</div>` +
                `</div>` +
                `</td>` +
                `<input type="hidden" id="inventario_${dinamico}" value="${element.idinventario}" name="inventario[]">` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm" id="refrepuestos_${dinamico}" value="${element.descripcion}" name="referencia_repuesto[]"  maxlength="0" readonly>` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm" id="codrepuestos_${dinamico}" value="${element.codigo}" name="codigo_repuesto[]"  maxlength="0" readonly>` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm input-valorrepuesto" id="valorrepuestos_${dinamico}" consecutivo="${dinamico}" name="valor_repuesto[]" value="${element.valor}"  maxlength="0" >` +
                `</td>` +
                `<td style="width: 300px">` +
                `<input type="text" class="form-control form-control-sm input-cantrepuesto" id="cantrepuestos_${dinamico}" consecutivo="${dinamico}" value="${element.cantidad}" name="cantidad_repuesto[]">` +
                `</td>` +
                `<td>` +
                `<input type="text" class="form-control form-control-sm input-ivarepuesto" id="iva_repuesto_${dinamico}" consecutivo="${dinamico}" name="iva_repuesto[]" value="${element.iva}">` +
                `</td>` +
                `<td>` +
                `<input type="text" class="form-control form-control-sm" id="total_repuesto_${dinamico}" name="total_repuesto[]" value="${element.total}" readonly>` +
                `</td>` +
                `<input type="hidden" value="${element.idproveedor}" name="idproveedor_repuesto[]"  id="idproveedor_repuesto_${dinamico}">` +
                `<td>` +
                `<input type="text" class="form-control form-control-sm" id="proveedor_repuesto_${dinamico}" value="${element.nombre_contacto}" name="proveedor_repuesto[]" readonly>` +
                `</td>` +
                `<td style="width: 900px;">
                <input type="hidden" id="servicio_repuesto_${dinamico}" value="${element.idservicio}"  name="servicio_repuesto[]">
        <div class="input-group">
            <input class="form-control form-control-sm" type="text" id="servrepuesto_${dinamico}" value="${element.servicio}" name="servrepuesto[]" placeholder="Seleccione un servicio"  maxlength="0">
            <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="repuesto" consecutivo="${dinamico}" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
            </div>
        </div>
        </td>` +
                `<td style="width: 900px;">
        <div class="input-group">
            <input class="form-control form-control-sm" type="text" id="sistemarepuesto_${dinamico}" value="${element.sistema}" name="sistemarepuesto[]" placeholder="Seleccione el tipo de sistema"  maxlength="0">
            <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="repuesto" consecutivo="${dinamico}" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
            </div>
        </div>
      </td>` +
                `<td style="width: 900px;">
        <div class="input-group">
            <input class="form-control form-control-sm" type="text" id="mantenimientorepuesto_${dinamico}" value="${element.mantenimiento}" name="mantenimientorepuesto[]" placeholder="Seleccione un mantenimiento"  maxlength="0">
            <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="repuesto" consecutivo="${dinamico}" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
            </div>
        </div>
      </td>` +
                `<td style="display: none;">
                <input type="hidden" id="idcuenta_repuesto_${dinamico}" value="${element.idcuenta}" name="idcuenta[]">
      <div class="input-group">
          <input class="form-control form-control-sm" type="text" id="cuenta_repuesto_${dinamico}" value="${element.num_cuenta}" name="cuenta_repuesto[]" placeholder="Seleccione una cuenta" maxlength="0">
          <div class="input-group-append">
              <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="repuesto" consecutivo="${dinamico}" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
          </div>
      </div>
  </td>` +
                `</tr> `;

            $("#filas_tabla_repuestoSolicitud").append(fila);
        };

        //FUNCION PARA RESETEAR TABLA REPUESTO CUANDO DEN EDITAR ORDEN
        const resetTableRepuesto = () => {
            $("#filas_tabla_repuestoSolicitud").html("");

            var fila = ` <tr id="contenido_filas_repuestoSolicitud" consecutivo="1">
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="repuesto_1" name="repuesto[]" placeholder="Seleccione un repuesto" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-repuestos" consecutivo="1" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>
                    </div>
                </div>
            </td>
            <input type="hidden" id="inventario_1" name="inventario[]">
            <td> <input type="text" class="form-control form-control-sm" id="refrepuestos_1" name="referencia_repuesto[]" readonly></td>
            <td> <input type="text" class="form-control form-control-sm" id="codrepuestos_1" name="codigo_repuesto[]" readonly></td>
            <td> <input type="text" class="form-control form-control-sm input-valorrepuesto" id="valorrepuestos_1" consecutivo="1" name="valor_repuesto[]" ></td>
            <td> <input type="text" class="form-control form-control-sm input-cantrepuesto" consecutivo="1" id="cantrepuestos_1" name="cantidad_repuesto[]" readonly></td>
            <td> <input type="text" class="form-control form-control-sm input-ivarepuesto" id="iva_repuesto_1" consecutivo="1" name="iva_repuesto[]"></td>
            <td> <input type="text" class="form-control form-control-sm" id="total_repuesto_1" name="total_repuesto[]" readonly></td>
            <input type="hidden" name="idproveedor_repuesto[]" id="idproveedor_repuesto_1">
            <td><input type="text" class="form-control form-control-sm" id="proveedor_repuesto_1" name="proveedor_repuesto[]" readonly></td>
            <td>
                <input type="hidden" id="servicio_repuesto_1" name="servicio_repuesto[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="servrepuesto_1" name="servrepuesto[]" placeholder="Seleccione un servicio" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="repuesto" consecutivo="1" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                    </div>
                </div>
            </td>
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="sistemarepuesto_1" name="sistemarepuesto[]" placeholder="Seleccione el tipo de sistema" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="repuesto" consecutivo="1" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                    </div>
                </div>
            </td>
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="mantenimientorepuesto_1" name="mantenimientorepuesto[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="repuesto" consecutivo="1" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                    </div>
                </div>
            </td>
            <td style="display: none;">
                <input type="hidden" id="idcuenta_repuesto_1" name="idcuenta[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="cuenta_repuesto_1" name="cuenta_repuesto[]" placeholder="Seleccione una cuenta" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="repuesto" consecutivo="1" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
                    </div>
                </div>
            </td>
            
        </tr>`;

            $("#filas_tabla_repuestoSolicitud").append(fila);
        };

        //FUNCION QUE CARGA LAS FILAS DE MANO DE OBRA AL DAR CLICK EN EDITAR
        const filasEditarOrdenMano = (dinamico, element) => {
            var fila = `<tr id="Contenido_tabla_manoObra" consecutivo="${dinamico}">
            <td style="width: 600px">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="proveedor_${dinamico}" value="${element.nombre_contacto}" placeholder="Seleccione un proveedor" maxlength="0">
                    <div class=" input-group-append">
                    <button type="button" class="btn btn-sm btn-success btn-md btn-proveedor" consecutivo="${dinamico}" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>
                    </div>
                </div>
            </td>
            <input type="hidden" id="idproveedor_${dinamico}" value="${element.id}" name="proveedor[]">
            <td style="width: 300px"><input type="text" class="form-control form-control-sm" id="descrip_${dinamico}" value="${element.descripcion}" name="descrip_mano[]"></td>
            <td style="width: 300px"><input type="text" class="form-control form-control-sm input-valorMano" id="valor_${dinamico}" consecutivo="${dinamico}" value="${element.valor}" name="valor_mano[]"></td>
            <td style="width: 300px"><input type="text" class="form-control form-control-sm input-cantMano" id="cantmanoObra_${dinamico}" consecutivo="${dinamico}" value="${element.cantidad}" name="cantmanoObra[]" ></td>
            <td><input type="text" class="form-control form-control-sm input-ivaMano" consecutivo="${dinamico}" id="iva_mano_${dinamico}" value="${element.iva}" name="iva_mano[]"></td>
            <td><input type="text" class="form-control form-control-sm" id="total_mano_${dinamico}" value="${element.total}" name="total_mano[]" readonly></td>
            <td style="width: 300px">
                <input type="hidden" id="servicio_mano_${dinamico}" value="${element.idservicio}" name="servicio_mano[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="servmanoObra_${dinamico}" value="${element.servicio}" name="servmanoObra[]" placeholder="Seleccione un servicio" maxlength="0">
                    <div class=" input-group-append">
                    <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="manoObra" consecutivo="${dinamico}" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                    </div>                
                </div>

            </td>
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="sistemanoObra_${dinamico}" value="${element.sistema}" name="sistmanoobra[]" placeholder="Seleccione el tipo de sistema" maxlength="0">
                    <div class=" input-group-append">
                    <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="manoObra" consecutivo="${dinamico}" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                    </div>
                </div>

            </td>
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="mantenimientoManoObra_${dinamico}" value="${element.mantenimiento}" name="mantenimientomanobra[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="manoObra" consecutivo="${dinamico}" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                    </div>
                </div>
            </td>
            <td style="display: none;">
                <input type="hidden" id="idcuenta_mano_${dinamico}" value="${element.idcuenta}" name="idcuenta_mano[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="cuenta_mano_${dinamico}" value="${element.num_cuenta}" name="cuenta_mano[]" placeholder="Seleccione una cuenta" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="manoObra" consecutivo="${dinamico}" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
                    </div>
                </div>
            </td>

        </tr>`;

            $("#filas_tabla_manoObra").append(fila);
        };

        //FUNCIION PARA RESETEAR TABLA DE MANO DE OBRA
        const resetTableMano = () => {
            $("#filas_tabla_manoObra").html("");

            var fila = `<tr id="Contenido_tabla_manoObra" consecutivo="1">
            <td style="width: 600px">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="proveedor_1" placeholder="Seleccione un proveedor" maxlength="0">
                    <div class=" input-group-append">
                    <button type="button" class="btn btn-sm btn-success btn-md btn-proveedor" consecutivo="1" title="lista proveedores" data-toggle="modal" data-target="#modal-proveedores"><i class="fas fa-parachute-box"></i></button>
                    </div>
                </div>
            </td>
            <input type="hidden" id="idproveedor_1" name="proveedor[]">
            <td style="width: 300px"><input type="text" class="form-control form-control-sm" id="descrip_1" name="descrip_mano[]"></td>
            <td style="width: 300px"><input type="text" class="form-control form-control-sm input-valorMano" consecutivo="1" id="valor_1" name="valor_mano[]"></td>
            <td style="width: 300px"><input type="text" class="form-control form-control-sm input-cantMano" id="cantmanoObra_1" consecutivo="1" name="cantmanoObra[]" readonly></td>
            <td><input type="text" class="form-control form-control-sm input-ivaMano" id="iva_mano_1" name="iva_mano[]" consecutivo="1"></td>
            <td><input type="text" class="form-control form-control-sm" id="total_mano_1" name="total_mano[]"  readonly></td>
            <td style="width: 300px">
                <input type="hidden" id="servicio_mano_1" name="servicio_mano[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="servmanoObra_1" name="servmanoObra[]" placeholder="Seleccione un servicio" maxlength="0">
                    <div class=" input-group-append">
                    <button type="button" class="btn btn-sm btn-success btn-md btn-servicios" seccion="manoObra" consecutivo="1" title="lista de servicios" data-toggle="modal" data-target="#modal-servicios"><i class="fab fa-cloudsmith"></i></button>
                    </div>
                </div>

            </td>
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="sistemanoObra_1" name="sistmanoobra[]" placeholder="Seleccione el tipo de sistema" maxlength="0">
                    <div class=" input-group-append">
                    <button type="button" class="btn btn-sm btn-success btn-md btn-sistema" seccion="manoObra" consecutivo="1" title="lista de sistemas" data-toggle="modal" data-target="#modal-sistema"><i class="fas fa-drafting-compass"></i></button>
                    </div>
                </div>

            </td>
            <td style="width: 900px;">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="mantenimientoManoObra_1" name="mantenimientomanobra[]" placeholder="Seleccione un mantenimiento" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-mantenimiento" seccion="manoObra" consecutivo="1" title="lista de mantenimientos" data-toggle="modal" data-target="#modal-mantenimiento"><i class="fas fa-wrench"></i></button>
                    </div>
                </div>
            </td>
            <td style="display: none;">
                <input type="hidden" id="idcuenta_mano_1" name="idcuenta_mano[]">
                <div class="input-group">
                    <input class="form-control form-control-sm" type="text" id="cuenta_mano_1" name="cuenta_mano[]" placeholder="Seleccione una cuenta" maxlength="0">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-sm btn-success btn-md btn-cuenta" seccion="manoObra" consecutivo="1" title="lista de cuentas" data-toggle="modal" data-target="#modal-cuentas"><i class="fas fa-money-check-alt"></i></button>
                    </div>
                </div>
            </td>

        </tr>`;
            $("#filas_tabla_manoObra").append(fila);
        };

        //CLICK EN EDITAR ORDEN
        $(document).on("click", ".btn-editarOrden", function () {
            Swal.fire({
                icon: "info",
                title: "Cargando datos de la orden",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1500,
                timerProgressBar: true,
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    //CAMBIA DE TAB
                    $("#custom-tabs-one-historial_orden").removeClass(
                        "active show"
                    );
                    $("#custom-tabs-one-historial_orden-tab").removeClass(
                        "active"
                    );
                    $("#custom-tabs-one-ordenserv_mante-tab").addClass(
                        "active"
                    );
                    $("#custom-tabs-one-ordenserv_mante").addClass(
                        "active show"
                    );

                    $("#custom-tabs-one-control-tab").removeClass(
                        "active show"
                    );
                    $("#custom-tabs-one-control").removeClass("active");

                    //ELIMINA EL ATRIBUTO DISABLED A CREAR SOLICITUD DE SERVICIO
                    $("#btn-crearSolicitud").removeAttr("disabled");
                    $("#btn-crearSolicitud").addClass("invisible");

                    //PERMITE QUE SIEMPRE SE MUESTRE EN EL TAB DE DATOS GENERALES
                    $("#v-pills-general-tab").addClass("active");
                    $("#v-pills-general").addClass("show active");
                    $("#v-pills-diagnostico-tab").removeClass("active");
                    $("#v-pills-diagnostico").removeClass("show active");
                    $("#v-pills-repuestos-tab").removeClass("active");
                    $("#v-pills-repuestos").removeClass("show active");
                    $("#v-pills-observaciones-tab").removeClass("active");
                    $("#v-pills-observaciones").removeClass("show active");

                    $("#placa_OrdServ").attr("disabled", true);
                    // $('placa_OrdServ').prop('readonly',true);

                    //RESETEA LA TABLA DE REPUESTOS
                    resetTableRepuesto();

                    //RESETEA LA TABLA DE MANO DE OBRA
                    resetTableMano();

                    //RESETEA SERVICIOS EXTERNOS
                    $(".input-servext").prop("checked", false);

                    // NO PERMITE CAMBIAR VEHÍCULO
                    // $("#placa_OrdServ").attr("disabled", true);

                    let idorden = $(this).attr("idorden");

                    $(".btn-exportar-solicitud").attr("idorden", idorden);

                    //AJAX PARA CARGAR DATOS DE LA ORDEN
                    var datos = new FormData();
                    datos.append("DatosOrdenServicio", "ok");
                    datos.append("idorden", idorden);
                    $.ajax({
                        type: "post",
                        url: `ajax/mantenimiento.ajax.php`,
                        data: datos,
                        cache: false,
                        dataType: "JSON",
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            let datosOrden = response.datosOrden;

                            // SE PONEN LOS DATOS GENERALES DE LA ORDEN EN SUS RESPECTIVOS CAMPOS
                            $("#placa_OrdServ")
                                .val(datosOrden.idvehiculo)
                                .trigger("change");

                            // $("#placa_OrdServ").attr("disabled", true);
                            $("#numOrden_ordSer").val(datosOrden.idorden);
                            $("#fechaentrada_ordSer").val(
                                moment(
                                    datosOrden.fecha_entrada,
                                    "YYYY-MM-DD h:mm:ss"
                                ).format("YYYY-MM-DD")
                            );
                            $("#horaentra_ordSer").val(datosOrden.hora_entrada);
                            $("#fechainicio_ordSer").val(
                                moment(
                                    datosOrden.fecha_trabajos,
                                    "YYYY-MM-DD h:mm:ss"
                                ).format("YYYY-MM-DD")
                            );
                            $("#ciudad_OrdServ")
                                .val(datosOrden.idmunicipio)
                                .trigger("change");
                            $(".diagno-resu").val(datosOrden.diagnostico);
                            $("#observacion").val(datosOrden.observacion);
                            $("#estado")
                                .val(datosOrden.estado)
                                .trigger("change");

                            $("#numFactura_ordSer").val(datosOrden.factura);
                            setTimeout(() => {
                                $("#kilome_ordSer").val(
                                    datosOrden.kilometraje_orden
                                );
                            }, 500);

                            //SE PONEN LOS DATOS DE REPUESTOS
                            let repuestos = response.repuestosOrden;
                            let dinamico = 2;

                            repuestos.forEach((element, index) => {
                                let total;

                                //CALCULAMOS EL VALOR TOTAL DE CADA REPUESTO
                                if (
                                    element.cantidad != "" &&
                                    element.valor != 0
                                ) {
                                    total = element.cantidad * element.valor;
                                } else {
                                    total = 0;
                                }

                                //SE PONEN LOS DATOS EN LA PRIMERA FILA PARA EVITAR QUE HAGA UNA FILA MÁS, YA QUE POR DEFECTO SE CARGA UNA FILA
                                if (index == 0) {
                                    $("#inventario_1").val(
                                        element.idinventario
                                    );
                                    $("#servicio_repuesto_1").val(
                                        element.idservicio
                                    );
                                    $("#repuesto_1").val(element.descripcion);
                                    $("#refrepuestos_1").val(
                                        element.referencia
                                    );
                                    $("#codrepuestos_1").val(element.codigo);
                                    $("#valorrepuestos_1").val(element.valor);
                                    $("#cantrepuestos_1").val(element.cantidad);
                                    $("#servrepuesto_1").val(element.servicio);
                                    $("#sistemarepuesto_1").val(
                                        element.sistema
                                    );
                                    $("#mantenimientorepuesto_1").val(
                                        element.mantenimiento
                                    );
                                    $("#iva_repuesto_1").val(element.iva);
                                    $("#total_repuesto_1").val(element.total);
                                    $("#proveedor_repuesto_1").val(
                                        element.nombre_contacto
                                    );
                                    $("#cuenta_repuesto_1").val(
                                        element.num_cuenta
                                    );
                                    // $("#idcuenta_repuesto_1").val(
                                    //     element.idcuenta
                                    // );
                                    $("#idproveedor_repuesto_1").val(
                                        element.idproveedor
                                    );
                                    $("#iva_mano_1").val(element.iva);
                                } else {
                                    filasEditarOrdenRepuesto(dinamico, element);

                                    dinamico += 1;
                                }
                            });

                            //SE PONEN LOS DATOS DE MANO DE OBRA
                            let mano = response.manoObraOrden;
                            let dinamico2 = 2;

                            mano.forEach((element, index) => {
                                //CALCULAMOS EL VALOR TOTAL DE CADA REPUESTO
                                if (
                                    element.cantidad != "" &&
                                    element.valor != 0
                                ) {
                                    total = element.cantidad * element.valor;
                                } else {
                                    total = 0;
                                }

                                if (index == 0) {
                                    $("#proveedor_1").val(
                                        element.nombre_contacto
                                    );
                                    $("#servicio_mano_1").val(
                                        element.idservicio
                                    );
                                    $("#idproveedor_1").val(
                                        element.idproveedor
                                    );
                                    $("#descrip_1").val(element.descripcion);
                                    $("#valor_1").val(element.valor);
                                    $("#cantmanoObra_1").val(element.cantidad);
                                    $("#servmanoObra_1").val(element.servicio);
                                    $("#sistemanoObra_1").val(element.sistema);
                                    $("#total_mano_1").val(total);
                                    $("#mantenimientoManoObra_1").val(
                                        element.mantenimiento
                                    );
                                    $("#total_mano_1").val(element.total);
                                    $("#cuenta_mano_1").val(element.num_cuenta);
                                    // $("#idcuenta_mano_1").val(element.idcuenta);
                                } else {
                                    filasEditarOrdenMano(dinamico2, element);

                                    dinamico2 += 1;
                                }
                            });

                            //SE PONEN LOS DATOS DE SERVICIOS EXTERNOS
                            let servicios = response.serviciosExt;

                            servicios.forEach((element) => {
                                $(
                                    `#servicioexter_` +
                                        element.idservicio_externo
                                ).prop("checked", true);
                            });
                        },
                    });
                }
            });
        });

        //CLICK EN RESTABLECER
        $(document).on("click", "#btn-restablecer", function () {
            Swal.fire({
                icon: "info",
                title: "Restableciendo formulario",
                showConfirmButton: false,
                allowOutsideClick: false,
                timer: 1000,
                timerProgressBar: true,
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    // //CAMBIA DE TAB
                    $("#v-pills-general").addClass("show active");
                    $("#v-pills-diagnostico").removeClass("show active");
                    $("#v-pills-repuestos").removeClass("show active");
                    $("#v-pills-general-tab").addClass("active");
                    $("#v-pills-diagnostico-tab").removeClass("active");
                    $("#v-pills-repuestos-tab").removeClass("active");

                    $("#placa_OrdServ").attr("disabled", false);
                    $("#placa_OrdServ").val("").trigger("change");
                    // $("#placa_OrdServ").select2("val","");
                    // $("#placa_OrdServ").removeAttr("disabled");
                    $("#ciudad_OrdServ").val("").trigger("change");

                    // //RESETEA LA TABLA DE REPUESTOS
                    resetTableRepuesto();

                    // //RESETEA LA TABLA DE MANO DE OBRA
                    resetTableMano();

                    // //RESETEA ESTADO DE LA ORDEN
                    $("#estado").val(3).trigger("change");
                }
            });
        });

        //DIGITAN LA CANTIDAD Y CALCULA EL TOTAL DEL REPUESTO
        $(document).on("blur", ".input-cantrepuesto", function () {
            let consecutivo = $(this).attr("consecutivo");
            let total = 0;
            let valor = $("#valorrepuestos_" + consecutivo).val();
            let cantidad = $(this).val();
            let iva = $("#iva_repuesto_" + consecutivo).val();

            if (valor > 0 && cantidad > 0 && iva > 0) {
                iva = iva / 100 + 1;
                total = valor * cantidad * iva;
                $("#total_repuesto_" + consecutivo).val(total);
            } else if (valor > 0 && cantidad > 0 && iva <= 0) {
                total = valor * cantidad;
                $("#total_repuesto_" + consecutivo).val(total);
            } else {
                total = 0;
                $("#total_repuesto_" + consecutivo).val(total);
            }
        });

        //DIGITAN EL IVA Y CALCULA EL TOTAL DEL REPUESTO
        $(document).on("blur", ".input-ivarepuesto", function () {
            let consecutivo = $(this).attr("consecutivo");
            let total = $("#total_repuesto_" + consecutivo).val();
            let valor = $("#valorrepuestos_" + consecutivo).val();
            let cantidad = $("#cantrepuestos_" + consecutivo).val();
            let iva = $(this).val();

            if (valor > 0 && cantidad > 0 && iva > 0) {
                iva = iva / 100 + 1;
                total = valor * cantidad * iva;
                $("#total_repuesto_" + consecutivo).val(total);
            } else if (valor > 0 && cantidad > 0 && iva <= 0) {
                total = valor * cantidad;
                $("#total_repuesto_" + consecutivo).val(total);
            } else {
                total = 0;
                $("#total_repuesto_" + consecutivo).val(total);
            }
        });

        //DIGITAN EL VALOR Y PUEDEN DIGITAR LA CANTIDAD EN MANO DE OBRRA
        $(document).on("blur", ".input-valorMano", function () {
            let consecutivo = $(this).attr("consecutivo");
            $("#cantmanoObra_" + consecutivo).attr("readonly", false);

            let total = $("#total_mano_" + consecutivo).val();
            let cantidad = $("#cantmanoObra_" + consecutivo).val();
            let valor = $(this).val();
            let iva = $("#iva_mano_" + consecutivo).val();

            if (cantidad > 0 && iva > 0) {
                iva = iva / 100 + 1;
                total = valor * cantidad * iva;
                $("#total_mano_" + consecutivo).val(total);
            } else if (cantidad > 0 && iva <= 0) {
                total = valor * cantidad;
                $("#total_mano_" + consecutivo).val(total);
            } else {
                total = 0;
                $("#total_mano_" + consecutivo).val(total);
            }
        });

        //DIGITAN LA CANTIDAD Y CALCULA EL TOTAL EN MANO DE OBRA
        $(document).on("blur", ".input-cantMano", function () {
            let consecutivo = $(this).attr("consecutivo");
            let total = 0;
            let valor = $("#valor_" + consecutivo).val();
            let cantidad = $(this).val();
            let iva = $("#iva_mano_" + consecutivo).val();

            if (valor > 0 && cantidad > 0 && iva > 0) {
                iva = iva / 100 + 1;
                total = valor * cantidad * iva;
                $("#total_mano_" + consecutivo).val(total);
            } else if (valor > 0 && cantidad > 0 && iva <= 0) {
                total = valor * cantidad;
                $("#total_mano_" + consecutivo).val(total);
            } else {
                total = 0;
                $("#total_mano_" + consecutivo).val(total);
            }
        });

        //DIGITAN EL IVA Y CALCULA EL TOTAL EN MANO DE OBRA
        $(document).on("blur", ".input-ivaMano", function () {
            let consecutivo = $(this).attr("consecutivo");
            let total = 0;
            let valor = $("#valor_" + consecutivo).val();
            let cantidad = $("#cantmanoObra_" + consecutivo).val();
            let iva = $(this).val();

            if (cantidad > 0 && valor > 0 && iva > 0) {
                iva = iva / 100 + 1;
                total = valor * cantidad * iva;
                $("#total_mano_" + consecutivo).val(total);
            } else if (cantidad > 0 && valor > 0 && iva <= 0) {
                total = valor * cantidad;
                $("#total_mano_" + consecutivo).val(total);
            } else {
                total = 0;
                $("#total_mano_" + consecutivo).val(total);
            }
        });
        //CUANDO CAMBIA EL VALOR SE BORRA LA CANTIDAD PARA QUE LA DIGITEN Y REALICE EL CALCULO DEL TOTAL
        $(document).on("change", ".input-valorrepuesto", function () {
            let consecutivo = $(this).attr("consecutivo");
            $("#cantrepuestos_" + consecutivo).val("");
            $("#total_repuesto_" + consecutivo).val("");
            $("#iva_repuesto_" + consecutivo).val("");
        });
        //CARGAR LISTA DE CUENTAS
        $(document).on("click", ".btn-cuenta", function () {
            let consecutivo = $(this).attr("consecutivo");
            let seccion = $(this).attr("seccion");

            var datos = new FormData();
            datos.append("ListaCuentasContables", "ok");
            datos.append("consecutivo", consecutivo);
            datos.append("seccion", seccion);
            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                // dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") $("#tbodycuentas").html(response);
                    else $("#tbodycuentas").html("");
                },
            });
        });
        //CLICK BOTON SELECCIONAR CUENTAS CONTABLES
        $(document).on("click", ".btn-SeleccionarCuentaContable", function () {
            $("#modal-cuentas").modal("hide");

            let consecutivo = $(this).attr("consecutivo");
            let codigo = $(this).attr("codigo");
            let nombre = $(this).attr("nombre");
            let seccion = $(this).attr("seccion");
            let idcuenta = $(this).attr("idcuenta");

            if (seccion == "repuesto") {
                $("#cuenta_repuesto_" + consecutivo).val(codigo);
                $("#idcuenta_repuesto_" + consecutivo).val(idcuenta);
            } else {
                $("#cuenta_mano_" + consecutivo).val(codigo);
                $("#idcuenta_mano_" + consecutivo).val(idcuenta);
            }
        });
        /*============================================
                CARGA TABLA CONTROL DE ACTIVIDADES
            ==============================================*/
        const TablaControlActividades = () => {
            // Quitar datatable
            $("#tableControlActividades").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyControlActividades").html("");

            var datos = new FormData();
            datos.append("TablaControlActividades", "ok");

            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                // dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "")
                        $("#tbodyControlActividades").html(response);
                    else $("#tbodyControlActividades").html("");

                    /* ===================================================
                        FILTRAR POR COLUMNA
                        ====================================================*/
                    /* Filtrar por columna */
                    //Clonar el tr del thead
                    if ($(`#tableControlActividades thead tr`).length == 1)
                        $(`#tableControlActividades thead tr:eq(0)`)
                            .clone(true)
                            .appendTo(`#tableControlActividades thead`);
                    //Por cada th creado hacer lo siguiente
                    $(`#tableControlActividades thead tr:eq(1) th`).each(
                        function (i) {
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
                        }
                    );
                    /* ===================================================
                       INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                       ===================================================*/
                    var buttons = [
                        {
                            extend: "",
                            className: "btn-info excel-controlActividades",
                            text: '<i class="far fa-file-excel "></i> Exportar',
                        },
                    ];
                    /* var table = dataTableCustom(
                        `#tablaSolicitudesProgramacion`,
                        buttons
                    ); */

                    var table = $("#tableControlActividades").DataTable({
                        dom:
                            "<'row'<'col-12 text-right'B>>" +
                            "<'row mt-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: buttons,
                        orderCellsTop: true,
                        fixedHeader: true,
                        order: [],
                        language: {
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                            sInfoEmpty:
                                "Mostrando registros del 0 al 0 de un total de 0",
                            sInfoFiltered:
                                "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
                            sInfoPostFix: "",
                            sSearch: "Buscar:",
                            sUrl: "",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior",
                            },
                            oAria: {
                                sSortAscending:
                                    ": Activar para ordenar la columna de manera ascendente",
                                sSortDescending:
                                    ": Activar para ordenar la columna de manera descendente",
                            },
                        },
                        lengthMenu: [
                            [10, 25, 50, 75, -1],
                            [10, 25, 50, 75, "Todo"],
                        ],
                        fnDrawCallback: function () {
                            $table = $(this);

                            // only apply this to specific tables
                            if ($table.closest(".datatable-multi-row").length) {
                                // for each row in the table body...
                                $table.find("tbody>tr").each(function () {
                                    var $tr = $(this);

                                    // get the "extra row" content from the <script> tag.
                                    // note, this could be any DOM object in the row.
                                    var extra_row = $tr
                                        .find(".extra-row-content")
                                        .html();

                                    // in case draw() fires multiple times,
                                    // we only want to add new rows once.
                                    if (!$tr.next().hasClass("dt-added")) {
                                        $tr.after(extra_row);
                                        $tr.find("td").each(function () {
                                            // for each cell in the top row,
                                            // set the "rowspan" according to the data value.
                                            var $td = $(this);
                                            var rowspan = parseInt(
                                                $td.data(
                                                    "datatable-multi-row-rowspan"
                                                ),
                                                10
                                            );
                                            if (rowspan) {
                                                $td.attr("rowspan", rowspan);
                                            }
                                        });
                                    }
                                });
                            } // end if the table has the proper class
                        }, // end fnDrawCallback()
                    });
                },
            });
        };

        $(document).on("click", "#custom-tabs-one-control-tab", function () {
            TablaControlActividades();
        });
        /*============================================
                CARGAR DATOS PARA LA MODAL DE QUIÉN ASUME
            ==============================================*/
        $(document).on("click", ".btn-asume", function () {
            let id = $(this).attr("id");
            let cantidad = $(this).attr("cantidad");
            let valor = $(this).attr("valor");
            let iva = $(this).attr("iva");
            let total = $(this).attr("total");
            let nombre_cuenta = $(this).attr("nombre_cuenta");
            let num_cuenta = $(this).attr("num_cuenta");
            let cliente = $(this).attr("cliente");
            let idvehiculo = $(this).attr("idvehiculo");
            let idcuenta = $(this).attr("idcuenta");
            let descripcion = $(this).attr("descripcion");

            $("#idcontrol").val(id);
            $("#cantidad_ctrActividades").val(cantidad);
            $("#valor_ctrActividades").val(valor);
            $("#iva_ctrActividades").val(iva);
            $("#total_ctrActividades").val(total);
            $("#nombre_cuenta_ctrActividades").val(idcuenta);
            $("#codigo_cuenta_ctrActividades").val(idcuenta).trigger("change");
            $("#cliente_asume").val(cliente).trigger("change");
            $("#descripcion").val(descripcion);

            //AJAX PARA CARGAR EL CLIENTE Y CONTRATISTA A TRAVÉS DEL VEHÍCULO
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
                    let vehiculo = response.datosVehiculo;

                    $("#contratista_asume").val(vehiculo.contratista);
                },
            });

            //AJAX PARA CARGAR LA EMPRESA
            var datos2 = new FormData();
            datos2.append("AsumeVerEmpresa", "ok");

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/mantenimiento.ajax.php`,
                data: datos2,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#empresa_asume").val(response.razon_social);
                },
            });

            //AJAX PARA CARGAR LOS DATOS DE CUANTO ESTÁN ASUMIENDO LAS EMPRESAS
            var datos3 = new FormData();
            datos3.append("DatosAsume", "ok");
            datos3.append("idcontrol", id);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/mantenimiento.ajax.php`,
                data: datos3,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#porcentaje_cliente")
                        .val(response.porcentaje_cliente)
                        .trigger("blur");
                    $("#porcentaje_empresa")
                        .val(response.porcentaje_empresa)
                        .trigger("blur");
                    $("#porcentaje_contratista")
                        .val(response.porcentaje_contratista)
                        .trigger("blur");
                },
            });
        });
        /*============================================
                VISUALIZAR PDF DE SOLICITUD DE SERVICIO
            ==============================================*/
        $(document).on("click", ".btn-exportar-solicitud", function () {
            var idorden = $(this).attr("idorden");
            window.open(
                `./pdf/pdfmantenimiento.php?idorden=${idorden}&tipo_mantenimiento=solicitud`,
                "",
                "width=1280,height=720,left=50,top=50,toolbar=yes"
            );
        });
        /*============================================
                VISUALIZAR PDF DE ORDEN DE SERVICIO
            ==============================================*/
        $(document).on("click", ".btn-pdforden", function () {
            var idorden = $(this).attr("idorden");
            window.open(
                `./pdf/pdfmantenimiento.php?idorden=${idorden}&tipo_mantenimiento=orden`,
                "",
                "width=1280,height=720,left=50,top=50,toolbar=yes"
            );
        });
        /*============================================
                CALCULOS PARA EL VALOR QUE ASUME CADA PARTE
            ==============================================*/
        $(document).on("blur", "#porcentaje_cliente", function () {
            let porcentaje = $(this).val();
            let total = $("#total_ctrActividades").val();
            let asume = 0;

            if (porcentaje > 0 && total > 0) {
                asume = total * (porcentaje / 100);
                asume = asume.toFixed();
            } else asume = 0;

            $("#valor_cliente").val(asume);
        });

        $(document).on("blur", "#porcentaje_empresa", function () {
            let porcentaje = $(this).val();
            let total = $("#total_ctrActividades").val();
            let asume = 0;

            if (porcentaje > 0 && total > 0) {
                asume = total * (porcentaje / 100);
                asume = asume.toFixed();
            } else asume = 0;

            $("#valor_empresa").val(asume);
        });

        $(document).on("blur", "#porcentaje_contratista", function () {
            let porcentaje = $(this).val();
            let total = $("#total_ctrActividades").val();
            let asume = 0;

            if (porcentaje > 0 && total > 0) {
                asume = total * (porcentaje / 100);
                asume = asume.toFixed();
            } else asume = 0;

            $("#valor_contratista").val(asume);
        });

        /*============================================
                CLICK PARA ABRIR LA SUCURSAL PRODUCTO
            ==============================================*/
        $(document).on("click", ".btn-SucursalesProducto", function () {
            $("#modal-repuestos").modal("hide");
            let idproducto = $(this).attr("idproducto");
            let consecutivo = $(this).attr("consecutivo");

            var datos = new FormData();
            datos.append("SucursalesProductos", "ok");
            datos.append("idproducto", idproducto);
            datos.append("consecutivo", consecutivo);

            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                // dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "")
                        $("#tBodySucursalesProductos").html(response);
                    else $("#tBodySucursalesProductos").html("");
                },
            });
        });

        /*============================================
                GUARDAR QUIÉN ASUME
            ==============================================*/
        $("#asume_form").submit(function (e) {
            e.preventDefault();
            var datosFrm = $(this).serializeArray();

            var datos = new FormData();
            datos.append("GuardarAsume", "ok");

            datosFrm.forEach((element) => {
                datos.append(element.name, element.value);
            });

            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                // dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "¡Datos guardados correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                        });

                        //SE CARGA LA TABLA
                        TablaControlActividades();
                    }
                },
            });
        });

        /*============================================
                DATOS DE LA CUENTA
            ==============================================*/
        $(document).on("change", "#codigo_cuenta_ctrActividades", function () {
            let idcuenta = $(this).val();

            var datos = new FormData();
            datos.append("datosCuenta", "ok");
            datos.append("idcuenta", idcuenta);

            $.ajax({
                type: "post",
                url: `ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#nombre_cuenta_ctrActividades")
                        .val(response.id)
                        .trigger("change");
                },
            });
        });

        /*===================================================================
                 MUESTRA EL BOTON DE CREAR SOLICITUD SOLO CUANDO ESTÁ EN EL TAB
            =====================================================================*/
        $(document).on("click", "#v-pills-repuestos-tab", function () {
            $("#btn-crearSolicitud").removeClass("invisible");
            $("#btn-crearSolicitud").addClass("visible");
        });

        $(document).on("click", "#v-pills-diagnostico-tab", function () {
            $("#btn-crearSolicitud").addClass("invisible");
            $("#btn-crearSolicitud").removeClass("visible");
        });

        $(document).on("click", "#v-pills-general-tab", function () {
            $("#btn-crearSolicitud").addClass("invisible");
            $("#btn-crearSolicitud").removeClass("visible");
        });

        /*============================================
                PROGRAMACIÓN
            ==============================================*/

        /*============================================
                FUNCION PARA CARGAR TABLA DE EVIDENCIAS DEL VEHÍCULO
            ==============================================*/
        const AjaxTablaEvidencias = (idvehiculo) => {
            // Quitar datatable
            $(`#table-evidenciasprogramacion`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbodyevidenciasprogramacion`).html("");

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
                        $(`#tbodyevidenciasprogramacion`).html(response);
                    } else {
                        $(`#tbodyevidenciasprogramacion`).html("");
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
                    var table = dataTableCustom(
                        `#table-evidenciasprogramacion`,
                        buttons
                    );
                },
            });
        };

        /*============================================
                CARGA DATOS SOLICITUD PROGRAMACIÓN X VEHÍCULO
            ==============================================*/
        $(document).on("click", ".btn-programacionxvehiculo", function () {
            let idvehiculo = $(this).attr("idvehiculo");

            AjaxTablaProgramacionxVehiculo(
                idvehiculo,
                "#tbodyserviciosxvehiculoprogramacion",
                "#tablaserviciosxvehiculoprogramacion"
            );

            let idsolicitud = $(this).attr("idsolicitud");
        });

        /*============================================
                CARGAR SOLICITUDES
            ==============================================*/
        $(document).on("click", ".btn-solicitudesvehiculo", function () {
            let idvehiculo = $(this).attr("idvehiculo");

            AjaxTablaEvidencias(idvehiculo);
        });

        /*============================================
                CARGAR DATOS DEL VEHÍCULO
            ==============================================*/
        $(document).on("change", "#placa_programacion", function () {
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
                success: function (response) {
                    let vehiculo = response.datosVehiculo;

                    $("#num_interno_progra").val(vehiculo.numinterno);
                    $("#marca_progra").val(vehiculo.marca);
                    $("#tipo_vehiculo_progra").val(vehiculo.tipovehiculo);
                    $("#modelo_progra").val(vehiculo.modelo);
                    $("#kilometraje_progra").val(vehiculo.kilometraje);
                },
            });
        });

        /*============================================
                FUNCION QUE CARGA LA TABLA DE SOLICITUDES
            ==============================================*/

        function TablaSolicitudesProgramacion() {
            // // Quitar datatable
            $(`#tablaSolicitudesProgramacion`).dataTable().fnDestroy();
            // // Borrar datos
            $(`#tbodyprogramacion`).html("");

            var datos = new FormData();
            datos.append("TablaProgramacion", "ok");

            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodyprogramacion").html(response);
                    } else {
                        $("#tbodyprogramacion").html("");
                    }

                    /* ===================================================
                       INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                       ===================================================*/
                    var buttons = [
                        {
                            extend: "",
                            className: "btn-info excelSolicitudesProgramacion",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                    ];
                    /* var table = dataTableCustom(
                            `#tablaSolicitudesProgramacion`,
                            buttons
                        ); */

                    var table = $("#tablaSolicitudesProgramacion").DataTable({
                        dom:
                            "<'row'<'col-12 text-right'B>>" +
                            "<'row mt-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        buttons: buttons,
                        orderCellsTop: true,
                        fixedHeader: true,
                        order: [],
                        language: {
                            sProcessing: "Procesando...",
                            sLengthMenu: "Mostrar _MENU_ registros",
                            sZeroRecords: "No se encontraron resultados",
                            sEmptyTable: "Ningún dato disponible en esta tabla",
                            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                            sInfoEmpty:
                                "Mostrando registros del 0 al 0 de un total de 0",
                            sInfoFiltered:
                                "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
                            sInfoPostFix: "",
                            sSearch: "Buscar:",
                            sUrl: "",
                            sInfoThousands: ",",
                            sLoadingRecords: "Cargando...",
                            oPaginate: {
                                sFirst: "Primero",
                                sLast: "Último",
                                sNext: "Siguiente",
                                sPrevious: "Anterior",
                            },
                            oAria: {
                                sSortAscending:
                                    ": Activar para ordenar la columna de manera ascendente",
                                sSortDescending:
                                    ": Activar para ordenar la columna de manera descendente",
                            },
                        },
                        lengthMenu: [
                            [10, 25, 50, 75, -1],
                            [10, 25, 50, 75, "Todo"],
                        ],
                        fnDrawCallback: function () {
                            $table = $(this);

                            // only apply this to specific tables
                            if ($table.closest(".datatable-multi-row").length) {
                                // for each row in the table body...
                                $table.find("tbody>tr").each(function () {
                                    var $tr = $(this);

                                    // get the "extra row" content from the <script> tag.
                                    // note, this could be any DOM object in the row.
                                    var extra_row = $tr
                                        .find(".extra-row-content")
                                        .html();

                                    // in case draw() fires multiple times,
                                    // we only want to add new rows once.
                                    if (!$tr.next().hasClass("dt-added")) {
                                        $tr.after(extra_row);
                                        $tr.find("td").each(function () {
                                            // for each cell in the top row,
                                            // set the "rowspan" according to the data value.
                                            var $td = $(this);
                                            var rowspan = parseInt(
                                                $td.data(
                                                    "datatable-multi-row-rowspan"
                                                ),
                                                10
                                            );
                                            if (rowspan) {
                                                $td.attr("rowspan", rowspan);
                                            }
                                        });
                                    }
                                });
                            } // end if the table has the proper class
                        }, // end fnDrawCallback()
                    });
                },
            });
        }

        /*============================================
             CARGAR TABLA DE SOLICITUDES PROGRAMACIÓN
            ==============================================*/
        $(document).on("click", "#pills-programacion-tab", function () {
            TablaSolicitudesProgramacion();
        });

        /*====================================================================
            CARGAR DATOS DEL VEHÍCULO CUANDO ABRAN MODAL DE SOLICITUD PROGRAMACION
            ======================================================================*/
        $(document).on("click", ".btn-programacion", function () {
            let idvehiculo = $(this).attr("idvehiculo");
            let idsolicitud = $(this).attr("idsolicitud");

            if (
                idsolicitud == "" ||
                idsolicitud == null ||
                idsolicitud == undefined
            ) {
                $("#estado_programacion").val("NUEVO");
                $("#estado_programacion").attr("readonly", true);
            } else {
                $("#estado_programacion").attr("readonly", false);
                $("#idsolicitud").val(idsolicitud);
            }

            AjaxTablaProgramacionxVehiculo(
                idvehiculo,
                "#tbodyProgramacionSolicitud",
                "#tablaProgramacionSolicitud"
            );

            $("#placa_programacion").val(idvehiculo).trigger("change");

            var datos = new FormData();
            datos.append("ItemsProgramacionxVehiculo", "ok");
            datos.append("idvehiculo", idvehiculo);
            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#descripcion_progra").val(response);
                },
            });
        });

        /*============================================
                GUARDAR SOLICITUD PROGRAMACIÓN
            ==============================================*/
        $("#Guardarprogramacion_form").submit(function (e) {
            e.preventDefault();

            var datosFrm = $(this).serializeArray();

            var datos = new FormData();
            datos.append("GuardarSolicitudProgramacion", "ok");

            datosFrm.forEach((element) => {
                datos.append(element.name, element.value);
            });

            $.ajax({
                type: "post",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                // dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            timer: 1500,
                            title: "Solicitud creada correctamente!",
                            showConfirmButton: false,
                        });

                        //CARGA LA TABLA
                        TablaSolicitudesProgramacion();
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
        });

        /*============================================
            OCULTAR/MOSTRAR OBSERVACIÓN DE REPROGRAMACIÓN
            ==============================================*/
        $(document).on("change", "#estado_programacion", function () {
            let option = $(this).val();

            if (option == "REPROGRAMADO") {
                $("#label_observacion").html("Observación de reprogramación");
                $("#observacion_progra").attr("required", true);
            } else {
                $("#label_observacion").html("Observación");
                $("#observacion_progra").attr("required", false);
            }
        });

        /*============================================
                CARGAR HISTORIAL DE SOLICITUDES
            ==============================================*/
        $(document).on(
            "click",
            "#historialSolicitudesProgramacion-tab",
            function () {
                // Quitar datatable
                $(`#tablaHistorialSolicitudesProgramacion`)
                    .dataTable()
                    .fnDestroy();
                // Borrar datos
                $(`#tbodyHistorialSolicitudesProgramacion`).html("");

                var datos = new FormData();
                datos.append("TablaHistorialSolicitudesProgramacion", "ok");

                $.ajax({
                    type: "post",
                    url: "ajax/mantenimiento.ajax.php",
                    data: datos,
                    // dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != "" || response != null) {
                            $("#tbodyHistorialSolicitudesProgramacion").html(
                                response
                            );
                        } else {
                            $("#tbodyHistorialSolicitudesProgramacion").html(
                                ""
                            );
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
                        var table = dataTableCustom(
                            `#tablaHistorialSolicitudesProgramacion`,
                            buttons
                        );
                    },
                });
            }
        );

        /*============================================
                EXPORTAR EXCEL CONTROL DE ACTIVIDADES
            ==============================================*/
        $(document).on("click", ".excel-controlActividades", function () {
            let urlRerport = `${urlPagina}/ajax/mantenimiento.ajax.php?ExcelControlActividades=ok`;
            window.location = urlRerport;
        });

        /*============================================
                EXPORTAR EXCEL PROGRAMACION
            ==============================================*/
        $(document).on("click", ".excelSolicitudesProgramacion", function () {
            let urlRerport = `${urlPagina}/ajax/mantenimiento.ajax.php?ExcelSolicitudesProgramacion=ok`;
            window.location = urlRerport;
        });

        /*============================================
            NOTIFICACIONES ORDEN DE SERVICIO SI FALTA UN CAMPO
        ==============================================*/
        $(document).on("click", "#guardar_orden", function(){
            
            Areas = [];
            Requeridos = [];
            Elementos = [];
            //Validación de inputs
            $("input:invalid").each(function (index, element) {
                var $input = $(this);
                var idform = $input.closest("form").attr("id");
                if (idform == "ordenServ_form") {
                    Requeridos.push($input);
                }
            });
            //Validación textarea
            $("textarea:invalid").each(function (index, element) {
                var $area = $(this);
                var idform = $area.closest("form").attr("id");
                if (idform == "ordenServ_form") {
                    Areas.push($area);
                }
            });
            var tab = [];
            //Se trae los tabs
            $("input:invalid").each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest(".tab-pane").attr("nombre");
                if (!tab.includes(idtab) && idtab != undefined) tab.push(idtab);
            });
            $("textarea:invalid").each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest(".tab-pane").attr("nombre");
                if (!tab.includes(idtab) && idtab) tab.push(idtab);
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
});
