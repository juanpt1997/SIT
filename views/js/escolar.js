if (
    window.location.href == `${urlPagina}e-escolar/` ||
    window.location.href == `${urlPagina}e-escolar`
) {
    $(document).ready(function () {
        /*============================================
            FUNCION PARA CARGAR LOS SELECT
        ==============================================*/
        const cargarSelect = (nombre) => {
            let datos = new FormData();
            datos.append("cargarselect", "ok");
            datos.append("nombreSelect", nombre);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $(`#${nombre}`).html(response);
                    } else {
                        $(`#${nombre}`).html("");
                    }
                },
            });
        };

        cargarSelect("institucion");
        cargarSelect("placa");
        cargarSelect("ruta");
        cargarSelect("ruta2");
        cargarSelect("estudiante");

        /*============================================
            FUNCION PARA CARGAR TABLA DE RUTAS 
        ==============================================*/
        const cargarTablaRutas = () => {
            // Quitar datatable
            $(`#tablaruta`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbodyRuta`).html("");

            let datos = new FormData();
            datos.append("TablaRutas", "ok");

            $.ajax({
                type: "POST",
                url: "ajax/escolar.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodyRuta").html(response);
                    } else {
                        $("#tbodyRuta").html("");
                    }

                    var buttons = [
                        {
                            extend: "excel",
                            className: "border-0 bg-gradient-olive",
                            text: '<i class="fas fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tablaOrdenes`, buttons);
                },
            });
        };

        cargarTablaRutas();

        /*============================================
            TABLA ESTUDIANTES X RUTA 
        ==============================================*/

        const cargarTablaEstudiantesxRuta = (idruta) => {
            // Quitar datatable
            $(`#tablaEstudiantesxRuta`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbodyEstudiantesxRuta`).html("");

            var datos = new FormData();
            datos.append("TablaEstudiantesxRuta", "ok");
            datos.append("idruta", idruta);

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodyEstudiantesxRuta").html(response);
                    } else {
                        $("#tbodyEstudiantesxRuta").html("");
                    }

                    var buttons = [
                        {
                            extend: "excel",
                            className: "border-0 bg-gradient-olive",
                            text: '<i class="fas fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(
                        `#tablaEstudiantesxRuta`,
                        buttons
                    );
                },
            });
        };

        /*============================================
            TABLA SEGUIMIENTO X RUTA    
        ==============================================*/
        const cargarTablaSeguimientoxRuta = (idruta) => {
            // Quitar datatable
            $(`#tablaSeguimiento`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbodySeguimiento`).html("");

            var datos = new FormData();
            datos.append("TablaSeguimientosxRuta", "ok");
            datos.append("idruta", idruta);

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbodySeguimiento").html(response);
                    } else {
                        $("#tbodySeguimiento").html("");
                    }

                    var buttons = [
                        {
                            extend: "excel",
                            className: "border-0 bg-gradient-olive",
                            text: '<i class="fas fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tablaSeguimiento`, buttons);
                },
            });
        };


        /*============================================
            CARGAR SELECT PARA EL ORDEN
        ==============================================*/
        const cargarSelectOrden = (idruta) =>{
            let datos = new FormData();
            datos.append("cargarselectOrden", "ok");
            datos.append("idruta", idruta);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $(`#estudianteOrden`).html(response);
                    } else {
                        $(`#estudianteOrden`).html("");
                    }
                },
            });
        };

        /*============================================
            SELECCIONAN VEHÍCULO
        ==============================================*/
        $(document).on("change", "#placa", function () {
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
                    let Vehiculo = response.datosVehiculo;
                    $("#numinterno").val(Vehiculo.numinterno);
                    $("#tipovehiculo").val(Vehiculo.tipovehiculo);
                    $("#cantidad").val(Vehiculo.capacidad);

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
                            // $(".overlay-conductores").addClass("d-none");
                            let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                            if (response != "") {
                                response.forEach((element) => {
                                    htmlSelect += `<option value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                                });
                            }
                            $("#idconductor").html(htmlSelect);

                            // console.log(response);

                            // Accionar el observador
                            // $("#observador_conductores_ruta").trigger(
                            //     "change"
                            // );
                        },
                    });
                },
            });
        });

        /*============================================
            GUARDAR RUTA 
        ==============================================*/
        $("#ruta_form").submit(function (e) {
            e.preventDefault();

            let datosFrm = $(this).serializeArray();

            var datosAjax = new FormData();
            datosAjax.append("GuardarRuta", "ok");

            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "POST",
                url: "ajax/escolar.ajax.php",
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "Datos agregados correctamente.",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        //ACTUALIZAMOS LA TABLA
                        cargarTablaRutas();
                        cargarSelect("ruta");
                        cargarSelect("ruta2");
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Los datos no pudieron ser guardados vuelva a intentar más tarde.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        });

        /*============================================
            EDITAR RUTA 
        ==============================================*/
        $(document).on("click", ".btn-editarRuta", function (e) {
            e.preventDefault();

            let idruta = $(this).attr("idruta");

            var datos = new FormData();
            datos.append("datosRuta", "ok");
            datos.append("idruta", idruta);

            $.ajax({
                type: "POST",
                url: "ajax/escolar.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response != "") {
                        $("#idruta").val(response.idruta);
                        $("#numruta").val(response.numruta);
                        $("#sector").val(response.sector);
                        $("#institucion")
                            .val(response.idinstitucion)
                            .trigger("change");
                        $("#placa").val(response.idvehiculo).trigger("change");

                        setTimeout(() => {
                            $("#idconductor")
                                .val(response.idconductor)
                                .trigger("change");
                        }, 1500);
                    }
                },
            });
        });

        /*============================================
            CLICK EN AGREGAR RUTA
        ==============================================*/
        $(document).on("click", ".btn-nuevaRuta", function () {
            //LIMPIAMOS EL FORMULARIO
            $("#ruta_form").trigger("reset");
            $("#institucion").val("").trigger("change");
            $("#placa").val("").trigger("change");
        });

        /*============================================
            CLICK EN CREAR NUEVO ESTUDIANTE
        ==============================================*/
        $(document).on("click", ".btn-nuevoEstudiante", function () {
            $("#modal-listar").modal("hide");
            $("#estudianteNuevo_form").trigger("reset");
            $("#ruta").val("").trigger("change");
        });

        /*============================================
            SE CIERRA MODAL NUEVO ESTUDIANTE
        ==============================================*/
        $("#modalEstudiante").on("hidden.bs.modal", function () {
            $("#modal-listar").modal("show");
        });

        /*============================================
            GUARDAR ESTUDIANTE 
        ==============================================*/
        $("#estudianteNuevo_form").submit(function (e) {
            e.preventDefault();

            let datosFrm = $(this).serializeArray();

            var datosAjax = new FormData();
            datosAjax.append("CrearEstudiante", "ok");

            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response == "existe") {
                        Swal.fire({
                            icon: "error",
                            title: "El estudiante que intenta crear, ya existe.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "Datos agregados correctamente.",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        cargarSelect("estudiante");
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Los datos no pudieron ser guardados vuelva a intentar más tarde.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        });

        /*============================================
            CLICK EN LISTAR ESTUDIANTES
        ==============================================*/
        $(document).on("click", ".btn-listar", function () {
            let idruta = $(this).attr("idruta");
            let ordenado = $(this).attr("ordenado");

            //SI LA RUTA YA ESTÁ ORDENADA HABILITA EL BOTON PARA ORDEN DE LOS ESTUDIANTES
            if(ordenado == 1){
                $("#despuesDe").removeClass("hide");
            }else{
                $("#despuesDe").addClass("hide");
            }

            $("#formulario_estudianteRuta").trigger("reset");

            $("#ruta2").val(idruta).trigger("change");
            $("#estudiante").val("").trigger("change");
            cargarSelectOrden(idruta);
            cargarTablaEstudiantesxRuta(idruta); 
        });

        /*============================================
            ASOCIAR ESTUDIANTE A RUTA 
        ==============================================*/
        $("#formulario_estudianteRuta").submit(function (e) {
            e.preventDefault();

            let datosFrm = $(this).serializeArray();
            let idruta = $("#ruta2").val();

            var datosAjax = new FormData();

            datosAjax.append("estudianteARuta", "ok");

            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response == "no existe") {
                        Swal.fire({
                            icon: "error",
                            title: "El estudiante que intenta asociar, no existe.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    } else if (response != "error") {
                        Swal.fire({
                            icon: "success",
                            title: "Datos agregados correctamente.",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        cargarTablaEstudiantesxRuta(idruta);
                        cargarSelectOrden(idruta);

                        //HABILITAMOS PARA DAR ORDEN A LOS ESTUDIANTES 
                        $("#despuesDe").removeClass("hide");

                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Los datos no pudieron ser guardados vuelva a intentar más tarde.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        });

        /*============================================
            TABLA SEGUIMIENTO X RUTA 
        ==============================================*/
        $(document).on("click", ".btn-seguimiento", function () {
            let idruta = $(this).attr("idruta");

            $("#idruta_aux").val(idruta);
            cargarTablaSeguimientoxRuta(idruta);
        });

        /*============================================
            GUARDAR RECORRIDO 
        ==============================================*/
        $("#auxiliar_form").submit(function (e) {
            e.preventDefault();

            let datosFrm = $(this).serializeArray();

            var datos = new FormData();

            datos.append("guardarRecorrido", "ok");

            datosFrm.forEach((element) => {
                datos.append(element.name, element.value);
            });

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/escolar.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (!isNaN(response)) {
                        Swal.fire({
                            icon: "success",
                            title: "Datos agregados correctamente.",
                            showConfirmButton: false,
                            timer: 1500,
                        });

                        $(".btn-entrega").attr("idrecorrido", response);
                        $(".btn-recoge").attr("idrecorrido", response);

                        cargarTablaEstudiantesxRuta(idruta);
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Los datos no pudieron ser guardados vuelva a intentar más tarde.",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
            });
        });

        /*============================================
            CLICK EN ENTREGAR 
        ==============================================*/
        $(document).on("click", ".btn-entrega", function () {
            let idrecorrido = $(this).attr("idrecorrido");
            let idpasajero = $(this).attr("idpasajero");

            if (idrecorrido != "") {
                var datos = new FormData();

                datos.append("GuardarSeguimiento", "ok");
                datos.append("idrecorrido", idrecorrido);
                datos.append("idpasajero", idpasajero);
            }
        });
    }); //FINAL DOCUMENT READY
}
