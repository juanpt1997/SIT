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

                        graficoSimple('scTiposVehiculos', datosLabel, datosGrafico, totalCantidad, 'TIPOS - ACTIVOS', 'doughnut', true);
                    }
                }
            });
        }

        /* ===================================================
          LLAMADOS GRÁFICOS
        ===================================================*/
        GraficosIngresosPersonal();
        GraficosTiposVehiculos();
    }
});