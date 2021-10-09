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
                                        $(`#documento_${element.idtipodocumento}`).val(
                                            element.fechafin
                                        );

                                        // Color del fondo segun la fecha
                                        var bg =
                                            element.fechafin >= moment().format("YYYY-MM-DD")
                                                ? "bg-success"
                                                : "bg-danger";
                                        $(`#documento_${element.idtipodocumento}`).addClass(bg);
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
                                    $(".overlay-conductores").addClass("d-none");
                                    let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                                    if (response != "") {
                                        response.forEach((element) => {
                                            htmlSelect += `<option value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                                        });
                                    }
                                    $("#idconductor").html(htmlSelect);

                                    // Accionar el observador
                                    $("#observador_conductoresAlistamiento").trigger("change");
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
              GUARDAR FORMULARIO ALISTAMIENTO
            ===================================================*/
        $("#alistamiento_form").submit(function (e) {
            e.preventDefault();
            AbiertoxEditar = true; //BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var datosAjax = new FormData();
            datosAjax.append("GuardarAlistamiento", "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/operaciones.ajax.php`,
                data: datosAjax,
                cache: false,
                // dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
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
                                    window.location = "o-alistamiento";
                                }
                            });
                            break;
                        default:
                            var idalistamiento = response;

                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: "success",
                                title: "¡Datos guardados correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                            });

                            // Id fuec
                            $("#idalistamiento").val(idalistamiento);

                            // Titulo modal
                            $("#TituloModal").val($("#placa").val());

                            // Evento para refrescar la pagina cuando sale de la modal
                            $("#modal-nuevoAlistamiento").on("hidden.bs.modal", function () {
                                window.location = "o-alistamiento";
                            });
                            break;
                    }
                },
            });
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

                        $("#cambio_aceite").val(response.cambio_aceite);
                        $("#engrase").val(response.engrase);
                        $("#rotacion_llantas").val(response.rotacion_llantas);
                        $("#filtro_aire").val(response.filtro_aire);
                        $("#sincronizacion").val(response.sincronizacion);
                        $("#alineacion_balanceo").val(response.alineacion_balanceo);

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
                                    title:
                                        "¡Ha ocurrido un error, por favor intente de nuevo más tarde!",
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

            var textoBoton = estado == "PENDIENTE" ? "Resuelto!" : "Aún pendiente";
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
                                else
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

            $('input:invalid').each(function (index, element) {
                var $input = $(this);

                var idform = $input.closest("form").attr("id");


                if (idform == "alistamiento_form") {
                    Requeridos.push($input);
                }
            });


            //Validación textarea

            $('textarea:invalid').each(function (index, element) {
                var $area = $(this);

                var idform = $area.closest("form").attr("id");
                console.log(idform);
                if (idform == "alistamiento_form") {
                    Areas.push($area);
                }
            });


            var tab = [];

            //Se trae los tabs 
            $('input:invalid').each(function (index, element) {
                var $tabs = $(this);
                var idtab = $tabs.closest("table").attr("nombre");
                if(!tab.includes(idtab)) tab.push(idtab);

                
                

                // if ($u[0].innerHTML != "Registro fotográfico") Elementos.push($u[0].innerHTML);
            });

            
            console.log(tab);
            
                 
    


            if (Requeridos.length > 0 || Areas.length > 0) {

                let inputsRequeridosHtml = `<ul>`;
                tab.forEach(element => {
                    inputsRequeridosHtml += `<li>${element}</li>`;
                });
                inputsRequeridosHtml += `</ul>`;

                Swal.fire({
                    icon: 'warning',
                    html: `<div class="text-left">
                                                    <p class="font-weight-bold">Hace falta diligenciar campos en los siguientes apartados:</p>
                                                        ${inputsRequeridosHtml}
                                                </div>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                });
                //RESET DE VALOR
                $("#idconductor").empty();
                $(".datosroda").val("");
            }
        });
    }

    /* ===================================================
          * PLAN DE RODAMIENTO
      ===================================================*/
    if (
        window.location.href == `${urlPagina}o-rodamiento/` ||
        window.location.href == `${urlPagina}o-rodamiento`
    ) {
        /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
        CONDUCTORES SEGUN LA PLACA DEL VEHICULO
        ==========================================================================*/
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
                    $("#tipo_vinculacion").val(Vehiculo.datosVehiculo.tipovinculacion);
                    $("#numinterno").val(Vehiculo.datosVehiculo.numinterno);
                    $("#marca").val(Vehiculo.datosVehiculo.marca);
                    $("#modelo").val(Vehiculo.datosVehiculo.modelo);
                    $("#capacidad").val(Vehiculo.datosVehiculo.capacidad);
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
                        // Swal.fire({
                        //   icon: "success",
                        //   text: "Seleccione un conductor",
                        //   showConfirmButton: true,
                        //   confirmButtonText: "Cerrar",
                        //   closeOnConfirm: false,
                        // });

                        // Accionar el observador
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "No se ha encontrado conductor",
                            text: "Seleccione otra placa",
                        })
                    }


                }
            });
        });
    }
})