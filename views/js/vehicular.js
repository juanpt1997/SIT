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
                            if ($("#foto_tarjetapropiedad").val() != "") {
                                var datosImagen = new FileReader();
                                datosImagen.readAsDataURL(tarjetapropiedad[0]);

                                $(datosImagen).on("load", function (event) {
                                    var rutaImagen = event.target.result;
                                    $("#imagenPrevisualizacion_TarjetaPro").attr("href", rutaImagen).find("img").attr("src", rutaImagen);
                                });

                                $("#foto_tarjetapropiedad").val("");
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

                                $("#foto_vehiculo").val("");

                                $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(""); // RESET DE LAS FOTOS DEL VEHICULO
                                $("#colPrevisualizacion_fotos").find(".carousel-inner").html(""); // RESET DE LAS FOTOS DEL VEHICULO

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
            $("#idvehiculo").val(""); //reset id vehiculo
            $("#imagenPrevisualizacion_TarjetaPro").attr("href", "").find("img").attr("src", "");
            //numFotosVehiculo = 0; // Contador de imagenes del vehiculo se resetea
            $("#colPrevisualizacion_fotos").find(".carousel-indicators").html(""); // RESET DE LAS FOTOS DEL VEHICULO
            $("#colPrevisualizacion_fotos").find(".carousel-inner").html(""); // RESET DE LAS FOTOS DEL VEHICULO

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
            if ($("#idvehiculo").val() == "") {
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
                        if (response.datosVehiculo != "") {
                            $("#vehiculos_form").trigger("reset"); //reset formulario

                            FuncionCargarDatosVehiculo(response.datosVehiculo);
                            FuncionCargarFotosVehiculo(response.fotosVehiculo);
                        }
                    }
                });
            }
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

            if (response.ruta_tarjetapropiedad != null) {
                $("#imagenPrevisualizacion_TarjetaPro").attr("href", response.ruta_tarjetapropiedad).find("img").attr("src", response.ruta_tarjetapropiedad);
            }
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
    });
}
