$(document).ready(function () {
    /* ===================================================
        * FUEC
    ===================================================*/
    if (window.location.href == `${urlPagina}contratos-fuec/` ||
        window.location.href == `${urlPagina}contratos-fuec`
    ) {

        /* ===================================================
          VISUALIZAR PDF DEL FUEC
        ===================================================*/
        $(document).on("click", ".btn-FTFuec", function () {
            var idfuec = $(this).attr("idfuec");
            window.open(`./pdf/pdffuec.php?idfuec=${idfuec}`, '', 'width=1280,height=720,left=50,top=50,toolbar=yes');
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
                $('.select2-single').trigger('change'); //ACTUALIZA EL VALOR DEL SELECT

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
                    $('.select2-single').trigger('change'); //ACTUALIZA EL VALOR DEL SELECT

                    /* Seleccionar tipo de contrato, es readonly en este caso y solo permite una opción */
                    $("#objetocontrato").val(4).attr("readonly", "readonly");
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
                    datos.append('VehiculoDisponible', "ok");
                    datos.append('idvehiculo', idvehiculo);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/fuec.ajax.php`,
                        data: datos,
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.DocumentosVencidos == "" && response.Bloqueo == "NO") {
                                $select.val(idvehiculo);

                                // Actualice la lista de conductores
                                FuncionCargarConductores(idvehiculo);
                            }
                            else {
                                if (response.DocumentosVencidos != "") {
                                    let listaVencidosHtml = `<ul>`;
                                    response.DocumentosVencidos.forEach(element => {
                                        listaVencidosHtml += `<li>${element.tipodocumento}</li>`;
                                    });
                                    listaVencidosHtml += `</ul>`;

                                    Swal.fire({
                                        icon: 'warning',
                                        html: `<div class="text-left">
                                                <p class="font-weight-bold">No es posible seleccionar este vehículo debido a que no están al día los siguientes documentos:</p>
                                                    ${listaVencidosHtml}
                                            </div>`,
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        closeOnConfirm: false
                                    });
                                    $(".conductores").empty();
                                    actualizo = false;
                                    $select.trigger('change'); //MUESTRA EL VALOR DEL SELECT
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        html: `<div class="text-left">
                                                <p class="font-weight-bold">El vehículo se encuentra bloqueado por el siguiente motivo: </p>
                                                <li>${response.Bloqueo.motivo}</li>
                                            </div>`,
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        closeOnConfirm: false
                                    });
                                    $(".conductores").empty();
                                    actualizo = false;
                                    $select.trigger('change'); //MUESTRA EL VALOR DEL SELECT
                                }
                            }
                            //console.log(response.DocumentosVencidos);
                        }
                    });
                }
                else {
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
                datos.append('ListaConductores', "ok");
                datos.append('idvehiculo', idvehiculo);
                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/fuec.ajax.php`,
                    data: datos,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
                        if (response != "") {
                            response.forEach(element => {
                                htmlSelect += `<option value="${element.idconductor}">${element.conductor}</option>`;
                            });
                        }
                        $(".conductores").html(htmlSelect);
                    }
                });
            } else {
                $(".conductores").html(`<option value="" selected>-Seleccione un conductor</option>`);
            }
        }
        /* ===================================================
          DETECTA SELECCIÓN DE UN CONDUCTOR
        ===================================================*/
        var actualizoSelectConductor = true;
        $(document).on("change", ".conductores", function () {
            var idconductor = $(this).val();
            var $select = $(this);

            /* Esta condicion sirve para ejecutar el evento unicamente cuando de verdad seleccione un vehiculo porque puede ocurrir que el select sea modificado internamente con $select.trigger('change')*/
            if (actualizoSelectConductor) {
                if (idconductor != "") {
                    $select.val("");

                    // Reviso si el vehículo tiene bloqueo y los documentos estan al dia
                    var datos = new FormData();
                    datos.append('ConductorDisponible', "ok");
                    datos.append('idconductor', idconductor);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/fuec.ajax.php`,
                        data: datos,
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response.Bloqueo == "NO" && response.PagoSS == "SI") {
                                $select.val(idconductor);
                            }
                            else {
                                if (response.PagoSS == "NO") {
                                    Swal.fire({
                                        icon: 'warning',
                                        text: 'No es posible seleccionar un conductor que no haya pagado la seguridad social',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        closeOnConfirm: false
                                    });
                                    actualizoSelectConductor = false;
                                    $select.trigger('change'); //MUESTRA EL VALOR DEL SELECT
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        html: `<div class="text-left">
                                                <p class="font-weight-bold">El conductor se encuentra bloqueado por el siguiente motivo: </p>
                                                <li>${response.Bloqueo.motivo}</li>
                                            </div>`,
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        closeOnConfirm: false
                                    });
                                    actualizoSelectConductor = false;
                                    $select.trigger('change'); //MUESTRA EL VALOR DEL SELECT
                                }
                            }
                        }
                    });
                }
            } else {
                actualizoSelectConductor = true;
            }
        });

        /* ===================================================
          DETECTA CAMBIO EN UN CONTRATANTE PARA CARGAR LOS DATOS DE LA ORDEN DE SERVICIO
        ===================================================*/
        $(document).on("change", "#contratante", function () {
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
                        $("#docum_empre").val(response.Documento);
                        $("#dir_empre").val(response.direccion);
                        $("#telefono_empre").val(response.telefono);
                        $("#nom_respo").val(response.nombrerespons);
                        $("#docum_respo").val(response.Documentorespons);
                        $("#dir_respo").val(response.direccion);
                        $("#telefono_cliente").val(response.telefono2);
                        $("#ciudad_cliente").val(response.ciudadrespons);
                        $("#expedicion_doccliente").val(response.ciudad_cedula_expedidaen);

                        // Datos cotizacion
                        $("#fechaini").val(response.fecha_inicio);
                        $("#fechafin").val(response.fecha_fin);
                        $("#origen").val(response.origen);
                        $("#destino").val(response.destino);
                        $("#observacionescontr").val(response.descripcion);
                        $("#valorneto").val(response.valortotal);
                    }
                });
            }
        });

        /* ===================================================
          GUARDAR FORMULARIO FUEC
        ===================================================*/
        $("#frmFUEC").submit(function (e) {
            e.preventDefault();

            var datosAjax = new FormData();
            datosAjax.append('GuardarFUEC', "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach(element => {
                datosAjax.append(element.name, element.value);
            });

            // FOTO
            // var files = $('#nuevaFoto')[0].files;
            // datosAjax.append("foto", files[0]);

            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/fuec.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    switch (response) {
                        case "error":
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'contratos-fuec';
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
                            var idfuec = response;

                            // Id fuec
                            $("#idfuec").val(idfuec);

                            // Titulo modal
                            $("#titulo-modal-fuec").html(idfuec);

                            // Evento para refrescar la pagina cuando sale de la modal
                            $('#NuevoFuecModal').on('hidden.bs.modal', function () {
                                window.location = 'contratos-fuec';
                            })
                            break;
                    }
                }
            });
        });

        /* ===================================================
          CLICK EN NUEVO FUEC
        ===================================================*/
        $(document).on("click", ".btn-nuevofuec", function () {
            $("#titulo-modal-fuec").html("Nuevo");
            $("#frmFUEC").trigger("reset"); //reset formulario
            $("#idfuec").val(""); //reset id fuec
            $('#tipocontrato').trigger('change'); //Inicializar opciones con el tipo de contrato
        });

        /* ===================================================
          CLICK EN EDITAR FUEC
        ===================================================*/
        $(document).on("click", ".btn-editarfuec", function () {
            var idfuec = $(this).attr("idfuec");
            $("#idfuec").val(idfuec); //asignar id personal
            $("#titulo-modal-fuec").html("");
            $("#frmFUEC").trigger("reset"); //reset formulario

            /* AJAX PARA CARGAR DATOS */
            var datos = new FormData();
            datos.append('DatosFUEC', "ok");
            datos.append('item', 'idfuec');
            datos.append('valor', idfuec);
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/fuec.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                    if (response != "") {
                        $("#titulo-modal-fuec").html(response.idfuec);

                        // Datos cliente
                        $("#docum_empre").val(response.docContratante);
                        $("#dir_empre").val(response.direccion);
                        $("#telefono_empre").val(response.telContratante);
                        $("#nom_respo").val(response.nombrerespons);
                        $("#docum_respo").val(response.Documentorespons);
                        $("#dir_respo").val(response.direccion);
                        $("#telefono_cliente").val(response.telrespons);
                        $("#ciudad_cliente").val(response.ciudadrespons);
                        $("#expedicion_doccliente").val(response.ciudad_cedula_expedidaen);

                        // Datos FUEC
                        $("#vehiculofuec").val(response.idvehiculo).trigger("change");
                        setTimeout(() => {
                            $("#conductor1").val(response.idconductor1).trigger("change");
                            $("#conductor2").val(response.idconductor2).trigger("change");
                            $("#conductor3").val(response.idconductor3).trigger("change");
                        }, 3000);
                        $("#fechaini").val(response.fecha_inicial);
                        $("#fechafin").val(response.fecha_vencimiento);
                        $("#objetocontrato").val(response.idobjeto_contrato);
                        $("#origen").val(response.origen);
                        $("#destino").val(response.destino);
                        $("#observacionescontr").val(response.observaciones);
                        $("#precio").val(response.precio);
                        $("#valorneto").val(response.valor_neto);
                        $("#estado_fuec").val(response.estado_fuec);
                    }
                }
            });
        });

    }
});