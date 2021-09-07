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
                if (placa != "") {
                    $select.val("");

                    // Reviso si el vehículo tiene bloqueo y los documentos estan al dia
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
                        }
                    });
                }
            } else {
                actualizo = true;
            }
        });
    }
});