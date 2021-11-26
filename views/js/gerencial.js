$(document).ready(function () {
    if (
        window.location.href == `${urlPagina}g-dashboard/` ||
        window.location.href == `${urlPagina}g-dashboard`
    ) {
        function GraficosIngresosPersonal() {

            // var datos = new FormData();
            // datos.append('GraficosPerfilSD', "ok");
            // datos.append('parametro', "test");
            // $.ajax({
            //     type: 'post',
            //     url: `${urlPagina}ajax/gh.ajax.php`,
            //     data: datos,
            //     dataType: 'json',
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     success: function (response) {
            //         if (response != "" || response != "error") {
            //             $(".spinner-scIngresosPersonal").addClass("d-none");

            //             let datosLabel = [];
            //             let datosGrafico = [];

            //             var totalCantidad = 0; //Usado para medir mas adelante el porcentaje
            //             response.forEach(element => {
            //                 datosLabel.push(element.nivel_escolaridad);
            //                 datosGrafico.push(element.Cantidad);
            //                 totalCantidad += parseInt(element.Cantidad, 10); //Total
            //             });

            //             graficoSimple('scIngresosPersonal', datosLabel, datosGrafico, totalCantidad, 'INGRESOS PERSONAL', 'line', true);
            //         }
            //     }
            // });


            var datos = new FormData();
            datos.append('IngresosPersonal', "ok");
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gerencial.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != "error") {
                        $(".spinner-scIngresosPersonal").addClass("d-none");

                        let datosLabel = [];
                        let datosGrafico = [];

                        var totalCantidad = 0; //Usado para medir mas adelante el porcentaje
                        response.forEach(element => {
                            datosLabel.push(element.mes);
                            datosGrafico.push(element.Cantidad);
                            totalCantidad += parseInt(element.Cantidad, 10); //Total
                        });

                        //graficoSimple('scIngresosPersonal', datosLabel, datosGrafico, totalCantidad, 'INGRESOS PERSONAL', 'line', true);
                        graficoLinea('scIngresosPersonal', datosLabel, datosGrafico, totalCantidad, `INGRESOS PERSONAL - ${response[0].anio}`);
                    }
                }
            });
        }
        function GraficosTiposVehiculos() {
            var datos = new FormData();
            datos.append('TiposVehiculos', "ok");
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gerencial.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != "error") {
                        $(".spinner-scTiposVehiculos").addClass("d-none");

                        let datosLabel = [];
                        let datosGrafico = [];

                        var totalCantidad = 0; //Usado para medir mas adelante el porcentaje
                        response.forEach(element => {
                            datosLabel.push(element.tipovehiculo);
                            datosGrafico.push(element.Cantidad);
                            totalCantidad += parseInt(element.Cantidad, 10); //Total
                        });

                        graficoSimple('scTiposVehiculos', datosLabel, datosGrafico, totalCantidad, 'TIPOS - ACTIVOS', 'doughnut', true, true);
                    }
                }
            });
        }
        function GraficosViajesOcasionales() {
            var datos = new FormData();
            datos.append('ViajesOcasionales', "ok");
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gerencial.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != "error") {
                        $(".spinner-scViajesOcasionales").addClass("d-none");

                        let datosLabel = [];
                        let datosGrafico = [];

                        var totalCantidad = 0; //Usado para medir mas adelante el porcentaje
                        response.forEach(element => {
                            datosLabel.push(element.mes);
                            datosGrafico.push(element.Cantidad);
                            totalCantidad += parseInt(element.Cantidad, 10); //Total
                        });

                        graficoSimple('scViajesOcasionales', datosLabel, datosGrafico, totalCantidad, `VIAJES OCASIONALES - ${response[0].anio}`, 'bar', true);
                    }
                }
            });
        }
        function GraficosTiposContrato() {
            var datos = new FormData();
            datos.append('TiposContrato', "ok");
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gerencial.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "" || response != "error") {
                        $(".spinner-scTiposContrato").addClass("d-none");

                        // Saber valor del total
                        var totalCantidad = 0; //Usado para medir mas adelante el porcentaje
                        response.forEach(element => {
                            totalCantidad += parseInt(element.Cantidad, 10); //Total
                        });

                        // Mostrar barras progreso
                        for (let index = 0; index < response.length; index++) {
                            let bg = index == 0 ? "secondary" : "info";
                            $('#scTiposContrato_progreso').append(`
                                                <div class="progress-group">
                                                    <span class="progress-text">${response[index].tipo}</span>
                                                    <span class="float-right"><b>` + response[index].Cantidad + `</b></span>
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-${bg}" style="width: ` + response[index].Cantidad / totalCantidad * 100 + `%"></div>
                                                    </div>
                                                </div>
                                                <!-- /.progress-group -->`);
                        }
                    }
                }
            });
        }

        /* ===================================================
          LLAMADOS GRÁFICOS
        ===================================================*/
        GraficosIngresosPersonal();
        GraficosTiposVehiculos();
        GraficosViajesOcasionales();
        GraficosTiposContrato();
    }
});