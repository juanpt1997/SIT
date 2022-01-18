if (window.location.href == `${urlPagina}v-propietarios/` ||
    window.location.href == `${urlPagina}v-propietarios`
) {
    $(document).ready(function () {

        //CARGAR DATOS DEL PROPIETARIOS PARA EDITARLOS
        $(document).on("click", ".btnEditarProp", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
            var idxp = $(this).attr("idxp");
            $("#idxp").val(idxp);

            var cedula = $(this).attr("cedula");

            var datos = new FormData();
            datos.append("DatosPropietarios", "ok");
            datos.append("value", cedula);
            $.ajax({
                type: "POST",
                url: "ajax/vehicular.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#titulo-modal-propietario").html("Datos de: " + response.nombre);

                    $("#documento").val(response.documento);
                    //$("#documento").attr("readonly", "readonly");

                    $("#tdocumento").val(response.tipodoc);
                    $("#nombre").val(response.nombre);
                    $("#telpro").val(response.telef);
                    $("#dirpro").val(response.direccion);
                    $("#emailp").val(response.email);
                    $("#ciudadpro").val(response.idciudad);
                    $("#deptopro").val(response.deptopro);

                    $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT 
                }
            });
        });

        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarPropietario", function () {
            // Reset ID
            $("#idxp").val("");
            // Reset titulo modal
            $("#titulo-modal-propietario").html("Nuevo propietario");

            // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
            if (AbiertoxEditar) {
                // Reset valores del formulario
                $(".input-propietario").val("");
                $('.select2-single').trigger('change');
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            //$("#documento").removeAttr("readonly");
        });


    });


    /*==============================================
        BORRADO LÓGICO PROPIETARIO
    ============================================== */
    $(document).on("click", ".btnBorrarProp", function () {

        var idxp = $(this).attr("idxp");
        $("#idxp").val(idxp);

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
                datos.append("EliminarPropietario", "ok");
                datos.append("idxp", idxp);

                $.ajax({
                    type: "POST",
                    url: "ajax/vehicular.ajax.php",
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
                                title: "¡El propietario ha sido borrado correctamente!",
                                confirmButtonText: "¡Cerrar!",
                                allowOutsideClick: false,
                            }).then((result) => {
                                window.location = "v-propietarios";
                            });
                        }
                    },
                });
            }
        });

    });


}

if (window.location.href == `${urlPagina}v-convenios/` ||
    window.location.href == `${urlPagina}v-convenios`
) {

    $(document).ready(function () {

        //CARGAR DATOS DEL CONVENIO PARA EDITARLOS
        $(document).on("click", ".btnEditarEmpresa", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var nit = $(this).attr("nit");

            var datos = new FormData();
            datos.append("DatosEmpresa", "ok");
            datos.append("value", nit);
            $.ajax({
                type: "POST",
                url: "ajax/vehicular.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#idxc").val(response.idxc);
                    $("#nit").val(response.nit);
                    $("#nit").attr("readonly", "readonly");
                    $("#nombre").val(response.nombre);
                    $("#dirco").val(response.direccion);
                    $("#telco").val(response.telefono1);
                    $("#telco2").val(response.telefono2);
                    $("#ciudadcon").val(response.idciudad);
                    $('.select2-single').trigger('change');
                    $("#titulo-modal-convenios").html("Convenio - " + response.nit);
                }
            });
        });

        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarEmpresa", function () {
            $("#idxc").val("");
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            $("#nit").removeAttr("readonly");
            $("#titulo-modal-empresas").html("Nueva empresa");

            // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
            if (AbiertoxEditar) {
                // Reset valores del formulario
                $(".input-convenio").val("");
                $('.select2-single').trigger('change');
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        });
    });

    //AGREGAR CONVENIO

    $(document).on("click", ".btn-agregarConvenio", function () {
        $("#titulo-modal-convenios").html("Nuevo Convenio");
        $("#datosconvenio_form").trigger("reset");
        $('.select2-single').val(" ").trigger("change");
        $('.select2-multiple').val(" ").trigger("change");
        $(".btn-copy-convenio").addClass("d-none");

    });

    //LISTA DE PLACAS 
    $(document).on("click", ".btnPlacas", function () {

        var idconvenio = $(this).attr("idConvenio");
        $("#idConvenio").val(idconvenio);

        var datos = new FormData();
        datos.append("DatosVehiculoxConvenio", "ok");
        datos.append("idconvenio", idconvenio);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                if (response == '') {
                    Swal.fire({
                        icon: 'warning',
                        html: `<div class="font-weight-bold">Este convenio no cuenta con vehículos.</div>`,
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                        closeOnConfirm: false
                    });
                } else {
                    var vehiculos = [];

                    response.forEach(element => {
                        vehiculos.push(element.placa);
                    });

                    let placas = `<ul>`;
                    vehiculos.forEach(element => {
                        placas += `<li>${element}</li>`;
                    });
                    placas += `</ul>`;

                    Swal.fire({
                        icon: 'info',
                        html: `<div class="text-left">
                                                        <p class="font-weight-bold">Este convenio cuenta con los siguientes vehículos:</p>
                                                            ${placas}
                                                    </div>`,
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                        closeOnConfirm: false
                    });
                }


            }
        });



    });

    //EDITAR CONVENIO

    $(document).on("click", ".btnEditarConv", function () {
        $("#titulo-modal-convenios").html("Editar Convenio");

        $(".btn-copy-convenio").removeClass("d-none");

        var idconvenio = $(this).attr("idConvenio");
        $("#idConvenio").val(idconvenio);


        var datos = new FormData();
        datos.append("DatosConvenio", "ok");
        datos.append("idconvenio", idconvenio);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                $('#empresacontratante').val(response.idcontratante).trigger("change");
                //$('#empresacontratante').attr("readonly","readonly");
                $('#empresacontratista').val(response.idcontratista).trigger("change");
                //$('#empresacontratista').attr("readonly","readonly");
                $('#sucursal').val(response.idsucursal).trigger("change");
                //$('#sucursal').attr("readonly","readonly");
                $('#convenioContrato').val(response.contrato);
                $('#fecha_inicio').val(response.fecha_inicio);
                $('#fecha_terminacion').val(response.fecha_terminacion);
                $('#estado').val(response.estado).trigger("change");
                $('#fecha_radicado').val(response.fecha_radicado);
                $('#num_radicado').val(response.num_radicado);
                $('#observacion').val(response.observacion);

            }
        });


        var datos = new FormData();
        datos.append("DatosVehiculoxConvenio", "ok");
        datos.append("idconvenio", idconvenio);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                var vehiculos = [];

                response.forEach(element => {
                    vehiculos.push(element.idvehiculo);
                });

                $('#placa').val(vehiculos).trigger("change");

            }
        });





    });


    //CLICK EN COPIA 

    $(document).on("click", ".btn-copy-convenio", function () {
        $("#idConvenio").val(""); //reset id cotizacion
        $("#titulo-modal-convenios").html("Nuevo");
        $(".btn-copy-convenio").addClass("d-none");
    });

    //CAPTURAR DATOS ID VEHICULO
    $(document).on("change", '#placa', function () {
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
            success: function (Vehiculo) {
                $("#tipo_vehiculo").val(Vehiculo.datosVehiculo.idtipovehiculo).trigger("change");
                $('#tipo_vehiculo').attr('disabled', 'disabled');
                $("#num_interno").val(Vehiculo.datosVehiculo.idvehiculo).trigger("change");
                $('#num_interno').attr('disabled', 'disabled');
            },
        });
    });


    $(document).on("click", ".btnBorrarConv", function () {
        let idConvenio = $(this).attr("idConvenio");
        var datos = new FormData();
        datos.append("Borrado", "ok");
        datos.append("idConvenio", idConvenio);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == "ok") {

                    Swal.fire({
                        title: '¿Está seguro de eliminar este convenio?',
                        text: "No se podrán recuperar los datos",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si,borrar'
                    }).then((result) => {
                        if (result.value == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Convenio eliminado correctamente',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',

                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'v-convenios';
                                }

                            })
                        }

                    })





                } else {
                    Swal.fire({
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#5cb85c',
                        text: 'El convenio no se ha podido eliminar'
                    });
                }
            }
        });
    });


    $(document).on("click", ".btnBorrarEmpresa", function () {
        var idxc = $(this).attr("idxc")
        $("#idxc").val(idxc);


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
                datos.append("EliminarEmpresa", "ok");
                datos.append("idxc", idxc);

                $.ajax({
                    type: "POST",
                    url: "ajax/vehicular.ajax.php",
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
                                title: "¡La empresa ha sido eliminada correctamente!",
                                confirmButtonText: "¡Cerrar!",
                                allowOutsideClick: false,
                            }).then((result) => {
                                window.location = "v-convenios";
                            });
                        }
                    },
                });
            }
        });



    });


}

if (window.location.href == `${urlPagina}gh-bloqueo-personal/` ||
    window.location.href == `${urlPagina}gh-bloqueo-personal`
) {
    $(document).ready(function () {
        // BLOQUEO PERSONAL tab en gestión humana
        $('#ghTabs').simpleTabs(tabsConfigGH, 'gh-tab6');
    });

    $(document).on("click", ".btnHistorial", function () {

        var id = $(this).attr("id_perso");

        // Quitar datatable
        $("#tabla-historial").dataTable().fnDestroy();
        // Borrar datos
        $("#tbodyhistorial").html("");

        var datos = new FormData();
        datos.append("ajaxHistorial", "ok");
        datos.append("idPersonal", id);
        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            //dataType: "json",
            success: function (response) {

                if (response != '' || response != null) {

                    $("#tbodyhistorial").html(response);

                } else {

                    $("#tbodyhistorial").html('');
                }

                var buttons = [
                    { extend: 'excel', className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar' }
                ];
                var table = dataTableCustom(`#tabla-historial`, buttons);

            }
        });
    });

    $(document).on("click", ".btnHistorial", function () {

        $("#titulo_modal").html("");

        var id = $(this).attr("id_perso");

        var datos = new FormData();
        datos.append("ajaxMostrarConductor", "ok");
        datos.append("idPersonal", id);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                $("#titulo_modal").html(" HISTORIAL BLOQUEOS / " + response.conductor);
            }
        });
    });

    $(document).on("click", ".btndesbloqueado", function () {

        $("#titulo_modal_1").html("CONDUCTOR DESBLOQUEADO");
        $("#opcion2").prop('checked', true);

        var id = $(this).attr("idperson");

        var datos = new FormData();
        datos.append("DatosBloqueo", "ok");
        datos.append("idPersonal", id);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {


                $("#conductorB").val(response.idPersonal);
                $("#motivob").val(response.motivo);
                $("#fecha_vin").val(response.fecha);
                $('.select2-single').trigger('change');
            }
        });
    });

    $(document).on("click", ".btnbloqueado", function () {

        $("#titulo_modal_1").html("CONDUCTOR BlOQUEADO");
        $("#opcion1").prop('checked', true);

        var id = $(this).attr("idperson");

        var datos = new FormData();
        datos.append("DatosBloqueo", "ok");
        datos.append("idPersonal", id);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {


                $("#conductorB").val(response.idPersonal);
                $("#motivob").val(response.motivo);
                $("#fecha_vin").val(response.fecha);
                $('.select2-single').trigger('change');
            }
        });
    });

    $(document).on("click", ".btn-agregarBloqueo", function () {

        $("#titulo_modal_1").html("NUEVO BLOQUEO");// reset titulo del modal
        $("#formulario-bloqueo").trigger("reset"); //reset formulario
        $('.select2-single').trigger('change'); //reset conductor
    });
}

if (window.location.href == `${urlPagina}v-bloqueo-vehiculo/` ||
    window.location.href == `${urlPagina}v-bloqueo-vehiculo`
) {

    $(document).on("click", ".btnHistorialv", function () {

        $("#titulo_modalv").html("");

        var id = $(this).attr("id_v");

        var datos = new FormData();
        datos.append("ajaxMostrarPlaca", "ok");
        datos.append("idvehiculo", id);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                $("#titulo_modalv").html(" HISTORIAL BLOQUEOS / " + response.placa);
            }
        });
    });

    $(document).on("click", ".btnHistorialv", function () {

        var id = $(this).attr("id_v");

        // Quitar datatable
        $("#tabla-historialv").dataTable().fnDestroy();
        // Borrar datos
        $("#tbodyhistorialv").html("");

        var datos = new FormData();
        datos.append("ajaxHistorialV", "ok");
        datos.append("idvehiculo", id);
        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            //dataType: "json",
            success: function (response) {

                if (response != '' || response != null) {

                    $("#tbodyhistorialv").html(response);

                } else {

                    $("#tbodyhistorialv").html('');
                }

                dataTable("#tabla-historialv");

            }
        });
    });

    $(document).on("click", ".btndesbloqueadov", function () {

        $("#titulo_modal_1").html("");
        $("#opcion2").prop('checked', true);

        var id = $(this).attr("idveh");

        var datos = new FormData();
        datos.append("DatosBloqueoV", "ok");
        datos.append("idvehiculo", id);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {


                $("#titulo_modal_1").html("VEHÍCULO (" + response.placa + ") DESBLOQUEADO");

                $("#vehiculo").val(response.idvehiculo);
                $("#motivobv").val(response.motivo);
                $("#fecha_des").val(response.fecha);
                $('.select2-single').trigger('change');
            }
        });
    });

    $(document).on("click", ".btnbloqueadov", function () {

        $("#titulo_modal_1").html("");
        $("#opcion1").prop('checked', true);

        var id = $(this).attr("idveh");

        var datos = new FormData();
        datos.append("DatosBloqueoV", "ok");
        datos.append("idvehiculo", id);

        $.ajax({
            type: "POST",
            url: "ajax/vehicular.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {

                $("#titulo_modal_1").html("VEHÍCULO (" + response.placa + ") BlOQUEADO");

                $("#vehiculo").val(response.idvehiculo);
                $("#motivobv").val(response.motivo);
                $("#fecha_des").val(response.fecha);
                $('.select2-single').trigger('change');
            }
        });
    });

    $(document).on("click", ".btn-agregarBloqueov", function () {

        $("#titulo_modal_1").html("NUEVO BLOQUEO DE VEHÍCULO");// reset titulo del modal
        $("#formulario-bloqueo").trigger("reset"); //reset formulario
        $('.select2-single').trigger('change'); //reset conductor
    });
}


/* ===================================================
  * VEHICULOS
===================================================*/
if (window.location.href == `${urlPagina}v-vehiculos/` ||
    window.location.href == `${urlPagina}v-vehiculos`
) {

    $(document).ready(function () {
        /* ===================================================
          INICIALIZAR DATATABLE
        ===================================================*/
        /* Filtrar por columna */
        //Clonar el tr del thead
        $(`#tblVehiculos thead tr`).clone(true).appendTo(`#tblVehiculos thead`);
        //Por cada th creado hacer lo siguiente
        $(`#tblVehiculos thead tr:eq(1) th`).each(function (i) {
            //Remover clase sorting y el evento que tiene cuando se hace click
            $(this).removeClass("sorting").unbind();
            //Agregar input de busqueda
            $(this).html('<input class="form-control" type="text" placeholder="Buscar"/>');
            //Evento para detectar cambio en el input y buscar
            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });
        var buttons = [
            { extend: 'excel', className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar' }
            /* 'copy', 'csv', 'excel', 'pdf', 'print' */
        ];
        var table = dataTableCustom(`#tblVehiculos`, buttons);

        /* ===================================================
            FORMULARIO GENERAL
        ===================================================*/
        $("#vehiculos_form").submit(function (e) {
            e.preventDefault();
            AbiertoxEditar = true; //BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var datosAjax = new FormData();
            $(".overlayBtnGuardarformugeneralvehiculos").removeClass("d-none");
            datosAjax.append('GuardarVehiculo', "ok");

            // ? DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach(element => {
                datosAjax.append(element.name, element.value);
            });

            // ? FOTOS
            // TARJETA DE PROPIEDAD
            var tarjetapropiedad = $('#foto_tarjetapropiedad')[0].files;
            datosAjax.append("tarjetapropiedad", tarjetapropiedad[0]);

            // FOTOS DEL VEHICULO
            var foto_vehiculo = $('#foto_vehiculo')[0].files;
            datosAjax.append("foto_vehiculo", foto_vehiculo[0]);


            // ? AJAX PARA GUARDAR LOS DATOS
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $(".overlayBtnGuardarformugeneralvehiculos").addClass("d-none");
                    switch (response) {
                        case "existe":
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ya existe un vehículo registrado con esta placa',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            })
                            break;

                        case "error":
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'v-vehiculos';
                                }

                            })
                            break;
                        default:
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })

                            // Id vehiculo
                            $("#idvehiculo").val(response);

                            // Titulo modal
                            var placa = $("#placa").val();
                            $("#titulo-modal-vehiculo").html(placa);

                            // Evento para refrescar la pagina cuando sale de la modal
                            $('#VehiculosModal').on('hidden.bs.modal', function () {
                                window.location = 'v-vehiculos';
                            })

                            /* ===================================================
                              ? PREVISUALIZAR FOTOS VEHICULO Y TARJETA DE PROPIEDAD
                            ===================================================*/
                            $("#foto_vehiculo").val(""); // Fotos del vehiculo
                            $("#foto_tarjetapropiedad").val(""); // Tarjeta de propiedad

                            // Fotos del vehiculo
                            $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(""); // RESET DE LAS FOTOS DEL VEHICULO
                            $("#colPrevisualizacion_fotos").find(".carousel-inner").html(""); // RESET DE LAS FOTOS DEL VEHICULO

                            // AJAX PARA CARGAR LAS FOTOS AL USUARIO    
                            var datos = new FormData();
                            datos.append('DatosVehiculo', "ok");
                            datos.append('item', 'idvehiculo');
                            datos.append('valor', $("#idvehiculo").val());
                            $.ajax({
                                type: 'post',
                                url: `${urlPagina}ajax/vehicular.ajax.php`,
                                data: datos,
                                dataType: 'JSON',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (Vehiculo) {
                                    // Tarjeta de propiedad
                                    if (Vehiculo.datosVehiculo.ruta_tarjetapropiedad != null) {
                                        $("#imagenPrevisualizacion_TarjetaPro").attr("href", Vehiculo.datosVehiculo.ruta_tarjetapropiedad).find("img").attr("src", Vehiculo.datosVehiculo.ruta_tarjetapropiedad);
                                    }

                                    // Fotos del vehiculo
                                    FuncionCargarFotosVehiculo(Vehiculo.fotosVehiculo);
                                }
                            });



                            // Tarjeta de propiedad
                            if ($("#foto_tarjetapropiedad").val() != "") {
                                // var datosImagen = new FileReader();
                                // datosImagen.readAsDataURL(tarjetapropiedad[0]);

                                // $(datosImagen).on("load", function (event) {
                                //     var rutaImagen = event.target.result;
                                //     //$("#imagenPrevisualizacion_TarjetaPro").attr("href", rutaImagen).find("img").attr("src", rutaImagen);
                                //     $("#imagenPrevisualizacion_TarjetaPro").find("img").attr("src", rutaImagen);
                                // });

                                // $("#foto_tarjetapropiedad").val("");
                            }

                            // Fotos del vehiculo
                            if ($("#foto_vehiculo").val() != "") {

                                // ESTO FUNCIONA, EL PROBLEMA ES PARA CARGAR EL ID DE LA FOTO EN CASO DE QUERER BORRARLA, POR ESTO OPTAMOS POR LA OPCION 2 DE SOLICITAR TODOS LOS DATOS DEL VEHICULO A LA BD
                                // var datosImagen2 = new FileReader();
                                // datosImagen2.readAsDataURL(foto_vehiculo[0]);

                                // $(datosImagen2).on("load", function (event) {
                                //     var rutaImagen2 = event.target.result;

                                //     let activo = numFotosVehiculo == 0 ? `active` : ``;

                                //     $("#colPrevisualizacion_fotos").find(".carousel-indicators").append(`<li data-target="#colPrevisualizacion_fotos" data-slide-to="${numFotosVehiculo}" class="${activo}"></li>`);
                                //     $("#colPrevisualizacion_fotos").find(".carousel-inner").append(`<div class="carousel-item ${activo}">
                                //                                                                         <div class="btn-group my-1" role="group" aria-label="Basic example">
                                //                                                                             <a class="btn btn-info" href="${rutaImagen2}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                //                                                                             <button type="button" class="btn btn-danger btn-eliminarFotoVehiculo"><i class="fas fa-trash-alt"></i></button>
                                //                                                                         </div>
                                //                                                                         <img src="${rutaImagen2}" class="d-block w-100" alt="...">
                                //                                                                     </div>`);
                                //     numFotosVehiculo++;
                                // });
                            }

                            break;
                    }
                }
            });
        });

        /* ===================================================
          CLICK EN NUEVO VEHICULO
        ===================================================*/
        var AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO
        $(document).on("click", ".btn-agregarVehiculo", function () {
            $("#titulo-modal-vehiculo").html("Nuevo");
            $("#idvehiculo").val(""); //reset id vehiculo

            // NO BORRAR LOS DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO UNO NUEVO
            if (AbiertoxEditar) {
                $("#vehiculos_form").trigger("reset"); //reset formulario
                $("#imagenPrevisualizacion_TarjetaPro").attr("href", "").find("img").attr("src", "");
                //numFotosVehiculo = 0; // Contador de imagenes del vehiculo se resetea
                $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(""); // RESET DE LAS FOTOS DEL VEHICULO
                $("#colPrevisualizacion_fotos").find(".carousel-inner").html(""); // RESET DE LAS FOTOS DEL VEHICULO
            }
            AbiertoxEditar = false; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            /* RESET DE LAS TABLAS QUE INCLUYEN EL RESTO DEL FORMULARIO */
            // Quitar datatable
            $("#tblPropietarios, #tblConductores, #tblDocumentos,#tblHistorico").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyPropietarios, #tbodyConductores, #tbodyDocumentos,#tbodyTablaHistorico").html("");
        });

        /* ===================================================
          CLICK EN EDITAR VEHICULO
        ===================================================*/
        $(document).on("click", ".btnEditarVehiculo", function () {
            AbiertoxEditar = true; // BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var idvehiculo = $(this).attr("idvehiculo");
            $("#titulo-modal-vehiculo").html("");
            $("#vehiculos_form").trigger("reset"); //reset formulario
            $("#imagenPrevisualizacion_TarjetaPro").attr("href", "").find("img").attr("src", "");
            //numFotosVehiculo = 0; // Contador de imagenes del vehiculo se resetea
            $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(""); // RESET DE LAS FOTOS DEL VEHICULO
            $("#colPrevisualizacion_fotos").find(".carousel-inner").html(""); // RESET DE LAS FOTOS DEL VEHICULO

            /* AJAX PARA CARGAR DATOS */
            var datos = new FormData();
            datos.append('DatosVehiculo', "ok");
            datos.append('item', 'idvehiculo');
            datos.append('valor', idvehiculo);
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.datosVehiculo != "") {
                        FuncionCargarDatosVehiculo(response.datosVehiculo);
                        FuncionCargarFotosVehiculo(response.fotosVehiculo);
                    }
                }
            });


            /* AJAX PARA CARGAR DATOS DEL CONVENIO */



        });

        /* ===================================================
            ALMACENAR INPUTS REQUERIDOS QUE NO SE HAN DILIGENCIADO Y MOSTRAR ALERTA
        ===================================================*/
        var Requeridos = [];
        $(document).on("click", ".btn-guardarVehiculo", function () {
            Requeridos = [];

            $('input:invalid').each(function (index, element) {
                var $input = $(this);

                var idform = $input.closest("form").attr("id");

                if (idform == "vehiculos_form") {
                    var label = $input.attr("nombre");
                    Requeridos.push(label);
                }
            });

            if (Requeridos.length > 0) {
                let inputsRequeridosHtml = `<ul>`;
                Requeridos.forEach(element => {
                    inputsRequeridosHtml += `<li>${element}</li>`;
                });
                inputsRequeridosHtml += `</ul>`;

                Swal.fire({
                    icon: 'warning',
                    html: `<div class="text-left">
                                                    <p class="font-weight-bold">Primero debe diligenciar los siguientes campos:</p>
                                                        ${inputsRequeridosHtml}
                                                </div>`,
                    showConfirmButton: true,
                    confirmButtonText: 'Cerrar',
                    closeOnConfirm: false
                });
            }

        });

        /* ===================================================
          SIEMPRE MAYUSCULA EN LA PLACA
        ===================================================*/
        $(document).on("keyup", "#placa", function () {
            $(this).val(this.value.toUpperCase());
        });

        /* ===================================================
            BUSCAR SI LA PLACA EXISTE EN EL SISTEMA CUANDO SALE DEL INPUT
        ===================================================*/
        $(document).on("blur", "#placa", function () {
            // Cuando se encuentra agregando uno nuevo
            
                /* AJAX PARA CARGAR DATOS */
                var datos = new FormData();
                datos.append('DatosVehiculo', "ok");
                datos.append('item', 'placa');
                datos.append('valor', $(this).val());
                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/vehicular.ajax.php`,
                    data: datos,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.datosVehiculo.idvehiculo != undefined) {

                            Swal.fire({
                                position: 'top-end',
                                icon: 'info',
                                title: 'Este vehículo ya existe ',
                                text: 'Cargando datos del vehículo ...',
                                showConfirmButton: false,
                                timer: 1500
                              })

                            $("#vehiculos_form").trigger("reset"); //reset formulario

                            FuncionCargarDatosVehiculo(response.datosVehiculo);
                            FuncionCargarFotosVehiculo(response.fotosVehiculo);
                        }
                    }
                });
            
        });

        /* ===================================================
          ELIMINAR FOTO DEL VEHICULO
        ===================================================*/
        $(document).on("click", ".btn-eliminarFotoVehiculo", function () {
            var idfoto = $(this).attr("idvehiculo");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar esta foto?',
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
                    datos.append('EliminarFotoVehiculo', "ok");
                    datos.append('idfoto', idfoto);
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
                                Swal.fire({
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                })

                                $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(""); // RESET DE LAS FOTOS DEL VEHICULO
                                $("#colPrevisualizacion_fotos").find(".carousel-inner").html(""); // RESET DE LAS FOTOS DEL VEHICULO

                                // Ajax para cargar todas las fotos del vehiculo
                                var datos = new FormData();
                                datos.append('DatosVehiculo', "ok");
                                datos.append('item', 'idvehiculo');
                                datos.append('valor', $("#idvehiculo").val());
                                $.ajax({
                                    type: 'post',
                                    url: `${urlPagina}ajax/vehicular.ajax.php`,
                                    data: datos,
                                    dataType: 'JSON',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function (Vehiculo) {
                                        FuncionCargarFotosVehiculo(Vehiculo.fotosVehiculo);
                                    }
                                });
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
                                        window.location = 'v-vehiculos';
                                    }

                                })
                            }
                        }
                    });
                }

            })
        });

        /* ===================================================
          CARGAR DATOS DEL VEHICULO EN EL FORMULARIO
        ===================================================*/
        const FuncionCargarDatosVehiculo = (response) => {
            $("#titulo-modal-vehiculo").html(response.placa);

            $("#idvehiculo").val(response.idvehiculo); //asignar id vehiculo
            $("#placa").val(response.placa);
            $("#numinterno").val(response.numinterno);
            $("#fechavinculacion").val(response.fechavinculacion);
            $("#chasis").val(response.chasis);
            $("#numeromotor").val(response.numeromotor);
            $("#modelo").val(response.modelo);
            $("#color").val(response.color);
            $("#capacidad").val(response.capacidad);
            $("#cilindraje").val(response.cilindraje);
            $("#tipovinculacion").val(response.tipovinculacion);
            $("#fechaimportacion").val(response.fechaimportacion);
            $("#potenciahp").val(response.potenciahp);
            $("#limitacion").val(response.limitacion);
            $("#activo").val(response.activo);
            $("#declaracionimpor").val(response.declaracionimpor);
            $("#fechamatricula").val(response.fechamatricula);
            $("#fechaexpedicion").val(response.fechaexpedicion);
            $("#transito").val(response.transito);
            $("#tipocarroceria").val(response.tipocarroceria);
            $("#fechafinconvenio").val(response.fechafinconvenio);
            $("#claveapp").val(response.claveapp);
            $("#fechadesvinculacion").val(response.fechadesvinculacion);
            $("#observaciones").val(response.observaciones);
            $("#idsucursal").val(response.idsucursal);
            $("#idmarca").val(response.idmarca);
            $("#idconvenio").val(response.idconvenio);
            $("#idtipovehiculo").val(response.idtipovehiculo);
            $("#tipocombustible").val(response.tipocombustible);
            $("#empresacontratante").val(response.idcontratante);
            $("#empresacontratante").attr("readonly", "readonly");
            $("#empresacontratista").val(response.idcontratista);
            $("#empresacontratista").attr("readonly", "readonly");
            $("#fecha_inicio").val(response.fecha_inicio);
            $("#fecha_inicio").attr("readonly", "readonly");
            $("#fecha_terminacion").val(response.fecha_terminacion);
            $("#fecha_terminacion").attr("readonly", "readonly");


            if (response.ruta_tarjetapropiedad != null) {
                $("#imagenPrevisualizacion_TarjetaPro").attr("href", response.ruta_tarjetapropiedad).find("img").attr("src", response.ruta_tarjetapropiedad);
            }

            // TABLAS DE PROPIETARIOS CONDUCTORES Y DOCUMENTOS
            AjaxTablaDinamica(response.idvehiculo, "Propietarios");
            AjaxTablaDinamica(response.idvehiculo, "Conductores");
            AjaxTablaDinamica(response.idvehiculo, "Documentos");
        }

        //var numFotosVehiculo = 0; // Usado para saber cuantas fotos tiene el vehiculo seleccionado, esto era para previsualizar la foto del input apenas guardara
        /* ===================================================
          CARGAR FOTOS DEL VEHICULO EN EL FORMULARIO
        ===================================================*/
        const FuncionCargarFotosVehiculo = (response) => {
            //numFotosVehiculo = response.length;

            let htmlcarouselindicators = ``;
            let htmlcarouselinner = ``;
            for (let index = 0; index < response.length; index++) {
                let activo = index == 0 ? `active` : ``;

                htmlcarouselindicators += `<li data-target="#colPrevisualizacion_fotos" data-slide-to="${index}" class="${activo}"></li>`;
                htmlcarouselinner += `<div class="carousel-item ${activo}">
                                            <div class="btn-group my-1" role="group" aria-label="Basic example">
                                                <a class="btn btn-info" href="${response[index].ruta_foto}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                <button type="button" class="btn btn-danger btn-eliminarFotoVehiculo" idvehiculo=${response[index].idfoto}><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                            <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                                        </div>`;

            }

            // Asignar html de las fotos
            $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(htmlcarouselindicators);
            $("#colPrevisualizacion_fotos").find(".carousel-inner").html(htmlcarouselinner);
        }

        /* ===================================================
          ? PROPIETARIOS, CONDUCTORES Y DOCUMENTOS
        ===================================================*/
        /* ===================================================
            GUARDAR FORMULARIO
        ===================================================*/
        $("#frmPropietarios, #frmConductores, #frmDocumentos").submit(function (e) {
            e.preventDefault();

            var $formulario = $(this);
            var nombreFormulario = $formulario.attr("id").replace('frm', '');

            var idvehiculo = $("#idvehiculo").val();

            if (idvehiculo != "") {
                var datosAjax = new FormData();
                datosAjax.append('GuardarDetallesVehiculo', "ok");
                $(".overlayBtnguardar").removeClass("d-none");


                // DATOS FORMULARIO
                var datosFrm = $formulario.serializeArray();
                datosFrm.forEach(element => {
                    datosAjax.append(element.name, element.value);
                });

                datosAjax.append("idvehiculo", idvehiculo);

                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/vehicular.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $(".overlayBtnguardar").addClass("d-none");

                        if (response != "error") {
                            if (nombreFormulario != "Documentos") {
                                // Cargar de nuevo la tabla correspondiente
                                AjaxTablaDinamica(idvehiculo, nombreFormulario);
                            } else {
                                // Cargar documento del vehiculo
                                var documento = $('#inputfile-documentos')[0].files;
                                CargarDocumentoVehiculo(idvehiculo, documento, response, "no");
                            }
                            // Reset del formulario
                            $formulario.trigger("reset");
                            $('.select2-single').trigger('change'); //reset select2
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'v-vehiculos';
                                }

                            })
                        }
                    }
                });
            }
        });

        /* ===================================================
            CARGAR LA TABLA CORRESPONDIENTE
        ===================================================*/
        const AjaxTablaDinamica = (idvehiculo, nombreTabla) => {
            // Quitar datatable
            $(`#tbl${nombreTabla}`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody${nombreTabla}`).html("");

            let datos = new FormData();
            datos.append(`Tabla${nombreTabla}`, 'ok');
            datos.append('idvehiculo', idvehiculo);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != '' || response != null) {
                        $(`#tbody${nombreTabla}`).html(response);
                    } else {
                        $(`#tbody${nombreTabla}`).html('');
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    var buttons = [
                        { extend: 'excel', className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#tbl${nombreTabla}`, buttons);
                }
            });
            // HISTORICO EN CASO DE QUERER ACTUALIZAR LA TABLA DOCUMENTOS
            if (nombreTabla == "Documentos") {
                // Quitar datatable
                $("#tblHistorico").dataTable().fnDestroy();
                // Borrar datos
                $("#tbodyTablaHistorico").html("");

                let datoshistorico = new FormData();
                datoshistorico.append('TablaHistorico', 'ok');
                datoshistorico.append('idvehiculo', idvehiculo);
                $.ajax({
                    type: "POST",
                    url: `${urlPagina}ajax/vehicular.ajax.php`,
                    data: datoshistorico,
                    cache: false,
                    contentType: false,
                    processData: false,
                    // dataType: "json",
                    success: function (response) {
                        if (response != '' || response != null) {
                            $("#tbodyTablaHistorico").html(response);
                        } else {
                            $("#tbodyTablaHistorico").html('');
                        }

                        /* ===================================================
                        INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                        ===================================================*/
                        var buttons = [
                            { extend: 'excel', className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar' }
                        ];
                        var table = dataTableCustom(`#tblHistorico`, buttons);
                    }
                });
            }
        }

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
                                AjaxTablaDinamica(idvehiculo, "Propietarios");
                                AjaxTablaDinamica(idvehiculo, "Conductores");
                                AjaxTablaDinamica(idvehiculo, "Documentos");

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
                                        window.location = 'v-vehiculos';
                                    }

                                })
                            }
                        }
                    });
                }

            })

        });

        /* ===================================================
            SUBIR DOCUMENTO VEHICULO
        ===================================================*/
        const CargarDocumentoVehiculo = (idvehiculo, documento, idregistro, msjExito) => {
            var datos = new FormData();
            datos.append('CargarDocumentoVehiculo', "ok");
            datos.append('idvehiculo', idvehiculo);
            datos.append('documento', documento[0]);
            datos.append('idregistro', idregistro);
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok" || response == "vacio") {
                        /* CARGAR DE NUEVO LA TABLA CORRESPONDIENTE */
                        AjaxTablaDinamica(idvehiculo, "Documentos");

                        // Mensaje al usuario de que se subió correctamente el documento
                        if (msjExito == "si") {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Documento subido correctamente!',
                                    showConfirmButton: false,
                                })
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Primero seleccione un archivo',
                                    showConfirmButton: false,
                                })
                            }
                        }
                    } else {
                        // Mensaje al usuario de que NO se subió el documento
                        if (msjExito == "si") {
                            Swal.fire({
                                icon: 'error',
                                title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'v-vehiculos';
                                }

                            })
                        }
                    }
                }
            });
        }

        /* ===================================================
          ELIMINAR DOCUMENTO VEHICULO
        ===================================================*/
        $(document).on("click", ".btnEliminarDocVehiculo", function () {
            var idvehiculo = $(this).attr("idvehiculo");
            var idregistro = $(this).attr("idregistro");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este documento?',
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
                    datos.append('EliminarDocumentoVehiculo', "ok");
                    datos.append('idregistro', idregistro);
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
                                /* CARGAR DE NUEVO LA TABLA CORRESPONDIENTE */
                                AjaxTablaDinamica(idvehiculo, "Documentos")
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Documento eliminado correctamente!',
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
                                        window.location = 'v-vehiculos';
                                    }

                                })
                            }
                        }
                    });
                }
            })
        });

        /* ===================================================
          CLICK EN CARGAR DOCUMENTO DESPUES DE TENER CREADO EL REGISTRO
        ===================================================*/
        $(document).on("click", ".btnSubirDocVehiculo", function () {
            var idvehiculo = $(this).attr("idvehiculo");
            var idregistro = $(this).attr("idregistro");

            Swal.fire({
                html: `<div class="form-group">
                        <label for="exampleInput1">CARGAR DOCUMENTO</label>
                        <div class="input-group mt-1">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                            </div>
                            <input type="file" class="form-control" name="" id="swal-inputfile" accept="image/png, image/jpeg">
                        </div>
                    </div>`,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d9534f',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var documento = $('#swal-inputfile')[0].files;
                    CargarDocumentoVehiculo(idvehiculo, documento, idregistro, "si");

                }
            })
        });

        /* ===================================================
            FICHA TÉCNICA VEHICULO - BOTON PARA GENERAR PDF
        ===================================================*/
        $(document).on("click", ".btn-FTVehiculo", function () {
            var idvehiculo = $(this).attr("idvehiculo");
            window.open(`./pdf/pdfvehiculo.php?idvehiculo=${idvehiculo}`, '', 'width=1280,height=720,left=50,top=50,toolbar=yes');
        });

        /* ===================================================
            TABLA REPORTE COMPLETO DE DOCUMENTOS
        ===================================================*/
        let TablaReporteDocumentos = (nombreTabla) => {
            // console.log(`#tbl${nombreTabla}`);
            // console.log(`#tbody${nombreTabla}`);
            // Agregar spinner
            $(`#spinnerTabla${nombreTabla}`).removeClass("d-none");
            // Quitar datatable
            $(`#tbl${nombreTabla}`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody${nombreTabla}`).html("");

            var datos = new FormData();
            datos.append(`ReporteDocumentos`, "ok");
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/vehicular.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    // Quitar spinner
                    $(`#spinnerTabla${nombreTabla}`).addClass("d-none");

                    /* ===================================================
                        LLENAR EL TBODY
                    ===================================================*/
                    if (response != '' || response != null) {
                        $(`#tbody${nombreTabla}`).html(response);
                    } else {
                        $(`#tbody${nombreTabla}`).html('');
                    }

                    /* ===================================================
                      FILTRAR POR COLUMNA
                    ===================================================*/
                    /* Filtrar por columna */
                    //Clonar el tr del thead
                    $(`#tbl${nombreTabla} thead tr`).clone(true).appendTo(`#tbl${nombreTabla} thead`);
                    //Por cada th creado hacer lo siguiente
                    $(`#tbl${nombreTabla} thead tr:eq(1) th`).each(function (i) {
                        //Remover clase sorting y el evento que tiene cuando se hace click
                        $(this).removeClass("sorting").unbind();
                        //Agregar input de busqueda
                        $(this).html('<input class="form-control" type="text" placeholder="Buscar"/>');
                        //Evento para detectar cambio en el input y buscar
                        $('input', this).on('keyup change', function () {
                            if (table.column(i).search() !== this.value) {
                                table
                                    .column(i)
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    var buttons = [
                        { extend: 'excel', className: 'border-0 bg-gradient-olive', text: '<i class="fas fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#tbl${nombreTabla}`, buttons);

                }
            });
        }
        TablaReporteDocumentos("ReporteDocumentos");
    });
}
