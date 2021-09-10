$(document).ready(function () {
    /* ===================================================
        * PROTOCOLO DE ALISTAMIENTO
    ===================================================*/
    if (window.location.href == `${urlPagina}m-alistamiento/` ||
        window.location.href == `${urlPagina}m-alistamiento`
    ) {
        /* ===================================================
          INICIALIZAR DATATABLE
        ===================================================*/



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
                    datos.append('DatosVehiculo', "ok");
                    datos.append('item', 'placa');
                    datos.append('valor', placa);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/vehicular.ajax.php`,
                        data: datos,
                        dataType: 'json',
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
                            datos.append('DocumentosxVehiculo', "ok");
                            datos.append('idvehiculo', Vehiculo.idvehiculo);
                            $.ajax({
                                type: 'post',
                                url: `${urlPagina}ajax/vehicular.ajax.php`,
                                data: datos,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    response.forEach(element => {
                                        // Asigno valor fecha
                                        $(`#documento_${element.idtipodocumento}`).val(element.fechafin);
                                        
                                        // Color del fondo segun la fecha
                                        var bg = element.fechafin >= moment().format("YYYY-MM-DD") ? "bg-success" : "bg-danger";
                                        $(`#documento_${element.idtipodocumento}`).addClass(bg);
                                    });
                                }
                            });

                            /* ===================================================
                                CARGAR LISTA CONDUCTORES
                            ===================================================*/
                            var datos = new FormData();
                            datos.append('ListaConductores', "ok");
                            datos.append('idvehiculo', Vehiculo.idvehiculo);
                            $.ajax({
                                type: 'post',
                                url: `${urlPagina}ajax/fuec.ajax.php`,
                                data: datos,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    $(".overlay-conductores").addClass("d-none");
                                    let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                                    if (response != "") {
                                        response.forEach(element => {
                                            htmlSelect += `<option value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
                                        });
                                    }
                                    $("#idconductor").html(htmlSelect);
                                }
                            });

                            /* ===================================================
                                TABLA DE EVIDENCIAS
                            ===================================================*/
                            AjaxTablaEvidencias(Vehiculo.idvehiculo);
                        }
                    });
                }
            } else {
                actualizo = true;
            }
        });

        /* ===================================================
          GUARDAR FORMULARIO ALISTAMIENTO
        ===================================================*/
        $("#alistamiento_form").submit(function (e) {
            e.preventDefault();
            AbiertoxEditar = true; //BOOL PARA EVITAR BORRAR DATOS DEL MODAL CUANDO SE ESTÁ LLENANDO NUEVO

            var datosAjax = new FormData();
            datosAjax.append('GuardarAlistamiento', "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach(element => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/mantenimiento.ajax.php`,
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
                                icon: 'warning',
                                title: 'Ya existe un vehículo registrado para este día',
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
                                    window.location = 'm-alistamiento';
                                }

                            })
                            break;
                        default:
                            var idalistamiento = response;

                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })

                            // Id fuec
                            $("#idalistamiento").val(idalistamiento);

                            // Titulo modal
                            $("#TituloModal").val($("#placa").val());

                            // Evento para refrescar la pagina cuando sale de la modal
                            $('#modal-nuevoAlistamiento').on('hidden.bs.modal', function () {
                                window.location = 'm-alistamiento';
                            })
                            break;
                    }
                }
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
            datos.append(`TablaEvidencias`, 'ok');
            datos.append('idvehiculo', idvehiculo);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/mantenimiento.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != '' || response != null) {
                        $(`#tbodyEvidencias`).html(response);
                    } else {
                        $(`#tbodyEvidencias`).html('');
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    dataTable(`#tblEvidencias`);
                }
            });
        }
    }

    /* ===================================================
        * PROVEEDORES
    ===================================================*/
    if (window.location.href == `${urlPagina}m-proveedores/` ||
        window.location.href == `${urlPagina}m-proveedores`
    ){
        $(".btn_nuevo").on("click", function () {

            $("#titulo_modal_proveedores").html("Agregar proveedor");
            $(".input-proveedores").val("");
        });

        $(".btn_editar").on("click", function () {

            var documento = $(this).attr("nit_editar");
            var datos = new FormData();
            datos.append("DatosProveedor", "ok");
            datos.append("documento", documento);
            $.ajax({
                type: "POST",
                url: "ajax/mantenimiento.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#titulo_modal_proveedores").html("Actualizando datos de:  " + response.razon_social); 

                    $("#cc_proveedor").val(response.documento);
                    $("#nom_razonsocial").val(response.razon_social);
                    $("#direccion_proveedor").val(response.direccion);
                    $("#telef_proveedor").val(response.telefono);
                    $("#contacto_proveedor").val(response.nombre_contacto);
                    $("#correo_proveedor").val(response.correo);
                    $("#ciudad_proveedor").val(response.idciudad);
                    $('.select2-single').trigger('change');
                }
            });
        });

        $(".btn_eliminar").on("click", function () {

            var id = $(this).attr("id");

            Swal.fire({
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea borrar este registro?",
                confirmButtonText: "SI, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#66ff99",
                allowOutsideClick: false
            }).then((result) => {

                if (result.value) {

                    var datos = new FormData();
                    datos.append("EliminarProveedor", "ok");
                    datos.append("id", id);
                    
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
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El registro ha sido borrado correctamente!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'm-proveedores'; })
                            }
                        }

                    });
                }
            })

        });
    }
});