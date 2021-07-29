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
                $("#colContratoFijo").removeClass("d-none");
                $("#contratofijo").attr("required", "required");

                $(".row-cliente").addClass("d-none");
                $("#colContratante").addClass("d-none");
                $("#contratante").val("");
                $("#contratante").removeAttr("required");
                $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT
            } else {
                if (tipocontrato == "OCASIONAL") {
                    $("#colContratoFijo").addClass("d-none");
                    $("#contratofijo").val("");
                    $("#contratofijo").removeAttr("required");

                    $(".row-cliente").removeClass("d-none");
                    $("#colContratante").removeClass("d-none");
                    $("#contratante").attr("required", "required");
                    $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT
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
                                        text: 'No es posible seleccionar un vehículo que se encuentre bloqueado',
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
            }else{
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
                                if (response.Bloqueo == "SI"){
                                    Swal.fire({
                                        icon: 'warning',
                                        text: 'No es posible seleccionar un conductor que se encuentre bloqueado',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                        closeOnConfirm: false
                                    });
                                    actualizoSelectConductor = false;
                                    $select.trigger('change'); //MUESTRA EL VALOR DEL SELECT
                                }else{
                                    Swal.fire({
                                        icon: 'warning',
                                        text: 'No es posible seleccionar un conductor que no haya pagado la seguridad social',
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

    }
});