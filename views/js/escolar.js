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
                    var table = dataTableCustom(`#tablaEstudiantesxRuta`, buttons);
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
                    console.log(response);
                    if (response != "") {
                        $("#idruta").val(response.idruta);
                        $("#numruta").val(response.numruta);
                        $("#sector").val(response.sector);
                        $("#institucion")
                            .val(response.idinstitucion)
                            .trigger("change");
                        $("#placa").val(response.idvehiculo).trigger("change");
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
            cargarTablaEstudiantesxRuta(idruta);
        });
    }); //FINAL DOCUMENT READY
}