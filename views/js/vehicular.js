if (window.location.href == `${urlPagina}v-propietarios/` ||
    window.location.href == `${urlPagina}v-propietarios`
) {
    $(document).ready(function () {

		//CARGAR DATOS DEL PROPIETARIOS PARA EDITARLOS
		$(document).on("click", ".btnEditarProp", function () {
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
        $(document).on("click", ".btn-agregarPropietario", function () {
            // Reset valores del formulario
            $(".input-propietario").val("");
            $("#idxp").val("");
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            //$("#documento").removeAttr("readonly");
        });


    });
}

if (window.location.href == `${urlPagina}v-convenios/` ||
    window.location.href == `${urlPagina}v-convenios`
) {

    $(document).ready(function () {

        //CARGAR DATOS DEL CONVENIO PARA EDITARLOS
        $(document).on("click", ".btnEditarConv", function () {


            var nit = $(this).attr("nit");

            var datos = new FormData();
            datos.append("DatosConvenios", "ok");
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

                    $("#nit").val(response.nit);
                    $("#nit").attr("readonly", "readonly");

                    $("#nombre").val(response.nombre);
                    $("#dirco").val(response.direccion);
                    $("#telco").val(response.telefono1);
                    $("#telco2").val(response.telefono2);
                    $("#ciudadcon").val(response.idciudad);

                    $('.select2-single').trigger('change');
                }
            });
        });
        $(document).on("click", ".btn-agregarConvenio", function () {
            // Reset valores del formulario
            $(".input-convenio").val("");
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            $("#nit").removeAttr("readonly");
        });
    });
}

if (window.location.href == `${urlPagina}v-bloqueo-personal/` ||
    window.location.href == `${urlPagina}v-bloqueo-personal`
) {

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

                    if(response != '' || response != null){

                         $("#tbodyhistorial").html(response);

                    }else{

                         $("#tbodyhistorial").html('');
                    }

                    dataTable("#tabla-historial");
                   
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
        $("#opcion2").prop('checked',true);

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
        $("#opcion1").prop('checked',true);

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

if (window.location.href == `${urlPagina}v-vehiculos/` ||
    window.location.href == `${urlPagina}v-vehiculos`
) {

    $(document).ready(function () {

        /* ===================================================
            FORMULARIO GENERAL
        ===================================================*/
        $("#vehiculos_form").submit(function (e) {
            e.preventDefault();

            var datosAjax = new FormData();
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
                            // Tarjeta de propiedad
                            if ($("#foto_tarjetapropiedad").val() != ""){
                                
                            }

                            break;
                    }
                }
            });
        });

        /* ===================================================
          CLICK EN NUEVO VEHICULO
        ===================================================*/
        $(document).on("click", ".btn-agregarVehiculo", function () {
            $("#titulo-modal-vehiculo").html("Nuevo");
            $("#vehiculos_form").trigger("reset"); //reset formulario
            $("#idvehiculo").val(""); //reset id personal
            //$('.select2-single').trigger('change'); //reset select2

            /* RESET DE LAS TABLAS QUE INCLUYEN EL RESTO DEL FORMULARIO */
            // Quitar datatable
            // /* $(".tablas-dinamicas").dataTable().fnDestroy(); */
            // Borrar datos
            // /* $(".tbody-tablas-dinamicas").html(""); */
        });

        /* ===================================================
          CLICK EN EDITAR VEHICULO
        ===================================================*/
        $(document).on("click", ".btnEditarVehiculo", function () {
            var idvehiculo = $(this).attr("idvehiculo");
            $("#titulo-modal-vehiculo").html("");
            $("#vehiculos_form").trigger("reset"); //reset formulario
            //$('.select2-single').trigger('change'); //reset select2

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
                    if (response != "") {
                        FuncionCargarDatosVehiculo(response);
                    }
                }
            });
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
            if ($("#idvehiculo").val() == ""){
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
                        if (response != "") {
                            $("#vehiculos_form").trigger("reset"); //reset formulario

                            FuncionCargarDatosVehiculo(response);
                        }
                    }
                });
            }
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
        }
    });
}
