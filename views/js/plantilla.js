/* ===================== 
    FUNCION MENU DINAMICO 
    https://stackoverflow.com/questions/61025311/adminlte-sidebar-active-menu-doesnt-change-dynamically
========================= */
$(function () {
    var url = window.location;
    // for single sidebar menu
    $('ul.nav-sidebar a').filter(function () {
        return this.href == url;
    }).addClass('active');

    // for sidebar menu and treeview
    $('ul.nav-treeview a').filter(function () {
        return this.href == url;
    }).parentsUntil(".nav-sidebar > .nav-treeview")
        .css({ 'display': 'block' })
        .addClass('menu-open').prev('a')
        .addClass('active');
});

/* ===================================================
  PERMITIR ESCRIBIR EN EL SWEET ALERT
===================================================*/
// No permite escribir en el input del sweet alert
// Problem: it enforces focus on the Bootstrap modal whenever it loses focus to another element( in this case SweetAlert Modal) in the page.
// WorkAround: It's as simple as removing the focus event.
$.fn.modal.Constructor.prototype._enforceFocus = function () { };

/* ===================== 
  FUNCIÓN DEL DATEPICKER  
========================= */
const dateRangePicker = (id) => {

    moment.locale("es"); //ESTABLESCO LA ZONA HORARIA DADA POR MOMENT.JS
    $("#mesAnio").text(moment().format("MMMM  YYYY")); // MUESTRO EL MES ACTUAL

    let fechaInicio = moment().format("YYYY-MM") + "-01";
    let fechaHoy = moment().format("YYYY-MM-DD");
    let fecha1 = fechaInicio,
        fecha2 = fechaHoy;

    $(`${id}`).daterangepicker(
        {
            showWeekNumbers: true,
            showDropdowns: true,
            autoApply: true,
            ranges: {
                Hoy: [moment(), moment()],
                Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Últimos 7 Días": [moment().subtract(6, "days"), moment()],
                "Últimos 30 Días": [moment().subtract(29, "days"), moment()],
                "Este Mes": [moment().startOf("month"), moment().endOf("month")],
                "Ultimo Mes": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month")
                ],
                Todo: [moment().subtract(20, "years"), moment()]
            },
            locale: {
                format: "DD-MM-YYYY",
                separator: " - ",
                applyLabel: "Aplicar",
                cancelLabel: "Cancelar",
                fromLabel: "Desde",
                toLabel: "Hasta",
                customRangeLabel: "Personalizado",
                weekLabel: "W",
                daysOfWeek: ["Do", "Lu", "Mar", "Mie", "Jue", "Vie", "Sab"],
                monthNames: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                firstDay: 1
            },
            alwaysShowCalendars: true,
            startDate: moment().startOf("month"),
            endDate: moment().endOf("month"),
            opens: "center",
            cancelClass: "btn-danger"
        },
        function (start, end, label) {
            console.info(
                "Rango desde: " +
                start.format("YYYY-MM-DD") +
                " hasta " +
                end.format("YYYY-MM-DD") +
                " (predefined range: " +
                label +
                ")"
            );

            // fecha1 = start.format("YYYY-MM-DD");
            // fecha2 = end.format("YYYY-MM-DD");

            //Recorro las funciones del objeto
            // for (const f of funciones) {
            //     f.funcion();
            // }

            // funciones.forEach(f => {
            //     f();
            // });




        }
    ); //Datepicker
}//end funcion dateRangePicker

/* ===================================================
      DATATABLE
    ===================================================*/
$('.tablas').DataTable({
    stateSave: true,

    "order": [],
    "language": {
        "decimal": ",",
        "thousands": ".",

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    },
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]]

});
const dataTable = (tabla) => {
    $(`${tabla}`).DataTable({
        "order": [],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        },
        "lengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "Todo"]]

    });
}
// l - Length changing
// f - Filtering input
// t - The Table!
// i - Information
// p - Pagination
// r - pRocessing
const dataTableCustom = (tabla, buttons) => {
    var table = $(`${tabla}`).DataTable({
        "dom": "<'row'<'col-12 text-right'B>>" +
            "<'row mt-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "buttons": buttons,
        "orderCellsTop": true,
        "fixedHeader": true,
        "order": [],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered": "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }

        },
        "lengthMenu": [[10, 25, 50, 75, -1], [10, 25, 50, 75, "Todo"]]

    });

    return table;
}
$('.tablasBtnExport').DataTable({
    //dom: 'Bfrt<"col-md-6 inline"i> <"col-md-12 inline"p>',
    dom: "<'row'<'col-12 text-right'B>>" +
        "<'row mt-1'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    "buttons": [
        { extend: 'excel', className: 'btn-info no-print', text: '<i class="far fa-file-excel"></i> Exportar' }
        /* 'copy', 'csv', 'excel', 'pdf', 'print' */
    ],
    "order": [],
    stateSave: true,
    "language": {

        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "<div class='small'>(filtrado de un total de _MAX_ registros)</div>",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }

    },
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todo"]]

});

/* ===================================================
  CHART JS
===================================================*/
/* =====================
    Función que genera colores claros aleatorios
    Fuente: https://helderesteves.com/generating-random-colors-js/
 ======================= */
const generateLightColorHex = () => {
    let color = "#";
    for (let i = 0; i < 3; i++)
        color += ("0" + Math.floor(((1 + Math.random()) * Math.pow(16, 2)) / 2).toString(16)).slice(-2);
    return color;
}
/* =====================
    Función que retorna un arreglo de colores aleatorios según el arreglo que se le pase como
    parametro.

    Parametro:
        [{"name": "Pepe"},{"name": "Larry"}]
    Respuesta:
        ["#FEFEFE", "#0E0E0E"]
 ======================= */
const getRandomColors = (data) => {
    let colors = data.map(() => {
        return generateLightColorHex();
    });

    return colors;
}
/* ===================== 
  FUNCION PARA GRAFICO BAR 
  - ID DEL GRAFICO
  - ARRAY DE LABELS
  - ARRAY DE DATOS 
  - TOTAL DE DATOS O CANTIDADES A NIVEL NUMERICO
  - TITULO DEL GRAFICO
========================= */
const graficoSimple = (idGrafico, datosLabel, datosGrafico, totalCantidad, tituloGrafico, tipo, randomColors, legendDisplay = false) => {
    /* ===================================================
      TIPOS:
      - bar
      - horizontalBar
      - pie
      - doughnut
    ===================================================*/

    let coloresFondo = ['#5fb7d4', '#d2d6de', '#ea9e70', '#17a2b8', '#00a65a', '#3c8dbc', '#ce7d78', '#ff0000', '#e01e84', '#c758d0', '#2dcb75', '#52d726', '#1baa2f', '#ffec00', '#007ed6', '#ff7300', '#8399eb'];

    // REFERENCIA https://www.chartjs.org/docs/latest/samples/bar/stacked.html
    let ctx = document.getElementById(idGrafico).getContext('2d');
    ctx.imageSmoothingEnabled = true;
    ctx.webkitImageSmoothingEnabled = true;
    ctx.mozImageSmoothingEnabled = true;
    ctx.msImageSmoothingEnabled = true;
    ctx.oImageSmoothingEnabled = true;


    new Chart(ctx, {
        type: tipo,
        data: {
            labels: datosLabel,
            datasets: [
                {
                    label: "",
                    data: datosGrafico,
                    backgroundColor: (randomColors ? getRandomColors(datosGrafico) : coloresFondo)
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: legendDisplay,
                position: "right"
            },
            title: {
                display: true,
                text: tituloGrafico
            },

            tooltips: {
                callbacks: {
                    title: function (tooltipItem, data) {
                        return data["labels"][tooltipItem[0]["index"]];
                    },

                    label: function (tooltipItem, data) {
                        var dato =
                            data["datasets"][0]["data"][tooltipItem["index"]];
                        var porcentaje = Math.round((dato * 100) / totalCantidad);
                        return porcentaje + "%";
                    }
                },
                backgroundColor: "#FFF",
                titleFontSize: 16,
                titleFontColor: "#0066ff",
                bodyFontColor: "#000",
                bodyFontSize: 14,
                displayColors: false
            },
            plugins: {
                datalabels: {
                    align: "center",
                    anchor: "end",
                    color: "black",
                    labels: {
                        title: {
                            font: {
                                weight: "bold"
                            }
                        },
                        value: {
                            color: "green"
                        }
                    }
                }
            }
        }
    });
};
const graficoLinea = (idGrafico, datosLabel, datosGrafico, totalCantidad, tituloGrafico) => {

    // REFERENCIA https://www.chartjs.org/docs/latest/samples/bar/stacked.html
    let ctx = document.getElementById(idGrafico).getContext('2d');
    ctx.imageSmoothingEnabled = true;
    ctx.webkitImageSmoothingEnabled = true;
    ctx.mozImageSmoothingEnabled = true;
    ctx.msImageSmoothingEnabled = true;
    ctx.oImageSmoothingEnabled = true;


    new Chart(ctx, {
        type: "line",
        data: {
            labels: datosLabel,
            datasets: [
                {
                    label: "",
                    data: datosGrafico,
                    /* backgroundColor: '#ddc8b4',
                    borderColor: '#ccb495', */
                    backgroundColor: '#7ea3de',
                    borderColor: '#f3be94',
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
                position: "bottom"
            },
            title: {
                display: true,
                text: tituloGrafico
            },

            tooltips: {
                callbacks: {
                    title: function (tooltipItem, data) {
                        return data["labels"][tooltipItem[0]["index"]];
                    },

                    label: function (tooltipItem, data) {
                        var dato =
                            data["datasets"][0]["data"][tooltipItem["index"]];
                        var porcentaje = Math.round((dato * 100) / totalCantidad);
                        return porcentaje + "%";
                    }
                },
                backgroundColor: "#FFF",
                titleFontSize: 16,
                titleFontColor: "#0066ff",
                bodyFontColor: "#000",
                bodyFontSize: 14,
                displayColors: false
            },
            plugins: {
                datalabels: {
                    align: "center",
                    anchor: "end",
                    color: "black",
                    labels: {
                        title: {
                            font: {
                                weight: "bold"
                            }
                        },
                        value: {
                            color: "green"
                        }
                    }
                }
            }
        }
    });
};

/* ===================================================
            FICHA TÉCNICA CONDUCTOR - BOTON PARA GENERAR PDF
        ===================================================*/
$(document).on("click", ".btn-FTConductor", function () {
    var idPersonal = $(this).attr("idPersonal");
    window.open(`./pdf/pdfconductor.php?idPersonal=${idPersonal}`, '', 'width=1280,height=720,left=50,top=50,toolbar=yes')
});

$(document).ready(function () {
    /* ===================================================
      MOSTRAR O ESCONDER EL MINI MENU DE LA IZQUIERDA SEGUN LA VISTA EN LA QUE SE ENCUENTRE
    ===================================================*/
    if (window.location.href == `${dominioApp}/sit/${proyecto}/inicio/` ||
        window.location.href == `${dominioApp}/sit/${proyecto}/inicio` ||
        window.location.href == `${dominioApp}/sit/${proyecto}/` ||
        window.location.href == `${dominioApp}/sit/${proyecto}`
    ) {
        // import { Calendar } from '@fullcalendar/core';
        // import dayGridPlugin from '@fullcalendar/daygrid';
        // import timeGridPlugin from '@fullcalendar/timegrid';
        // import listPlugin from '@fullcalendar/list';

        $("body").removeClass("sidebar-mini");


        //     var calendarEl = document.getElementById('calendar');
        //     var calendar = new FullCalendar.Calendar(calendarEl, {

        //       //initialView: 'timeGridWeek',
        //       //themeSystem: 'bootstrap'
        //       //aspectRatio: -10
        //       headerToolbar: {
        //         lenguage: 'es',
        //         left  : 'prev,next today',
        //         center: 'title',
        //         right : 'dayGridMonth,timeGridWeek,timeGridDay'
        //       },
        //       themeSystem: 'bootstrap',
        //       editable:true,
        //       eventLimit:true,
        //       selectable:true,
        //       selectHelper:true,
        //   });
        //     calendar.render();

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '2021-10-07',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'All Day Event',
                        start: '2021-10-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2021-10-07',
                        end: '2021-10-10'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2021-10-09T16:00:00'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2021-10-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2021-10-11',
                        end: '2021-10-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2021-10-12T10:30:00',
                        end: '2021-10-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2021-10-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2021-10-12T14:30:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2021-10-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2021-10-28'
                    }
                ]
            });

            calendar.render();
        });

    } else {
        $("body").addClass("sidebar-mini");
    }

    /* ===================================================
      CAMBIAR CONTRASEÑA
    ===================================================*/
    $(document).on("click", "#btnCambiarPass", function () {
        Swal.fire({
            title: 'Cambiar contraseña',
            html:
                `
                    <hr>
                    <label for="">Digite la contraseña anterior</label>
                    <input class="swal2-input" id="passwordAnterior" type="password">
                    <label for="">Nueva contraseña</label>
                    <input class="swal2-input" type="password" id="passNueva">
                    <label for="">Confirme la contraseña</label>
                    <input class="swal2-input" id="confirmPass" type="password">`
            ,
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continuar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var passAnterior = $("#passwordAnterior").val();
                var passNueva = $("#passNueva").val();
                var confirmPass = $("#confirmPass").val();

                if (passNueva == confirmPass && passNueva.length >= 4 && passAnterior != "") {
                    var datos = new FormData();
                    datos.append('CambiarPass', "ok");
                    datos.append('passAnterior', passAnterior);
                    datos.append('passNueva', passNueva);
                    datos.append('confirmPass', confirmPass);
                    $.ajax({
                        type: 'post',
                        url: 'ajax/usuarios.ajax.php',
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            switch (response) {
                                case "ok":
                                    // Mensaje de éxito
                                    Swal.fire({
                                        icon: 'success',
                                        title: '¡Contraseña modificada con éxito!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                    });
                                    break;

                                case "incorrecto":
                                    // Mensaje de clave incorrecta
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¡Contraseña anterior incorrecta!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                    });
                                    break;

                                case "no coinciden":
                                    // Mensaje de clave incorrecta
                                    Swal.fire({
                                        icon: 'warning',
                                        title: '¡Las contraseñas no coinciden!',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                    });
                                    break;

                                default:
                                    // Mensaje de clave incorrecta
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ha ocurrido un error, por favor intente de nuevo más tarde',
                                        showConfirmButton: true,
                                        confirmButtonText: 'Cerrar',
                                    });
                                    break;
                            }
                        }
                    });
                } else {
                    if (passNueva != confirmPass) {
                        // No coinciden
                        Swal.fire({
                            icon: 'warning',
                            title: '¡Las contraseñas no coinciden!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                        });
                    }
                }
            }
        })
    });

    /* ===================================================
          INICIALIZAR SELECT 2 DE LOS FORMULARIOS ACTIVOS
        ===================================================*/
    $('.select2-single').select2({
        theme: 'bootstrap4',
        "language": {
            "noResults": function () {
                return "No hay resultados para esta búsqueda.";
            }
        }
    });

    $('.select2-multiple').select2();
    /* ===================================================
          INICIALIZAR tooltip titulos de los botones
    ===================================================*/
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })


    /* ===================================================
      CAMBIAR FOTO
    ===================================================*/
    $(document).on("change", "#nuevaFoto", function (e) {
        e.preventDefault();

        var imagen = this.files[0];
        //console.log("Imagen "+imagen);

        /* ===================== 
            VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG 
          ========================= */
        if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
            $("#nuevaFoto").val("");
            //Mandamos alerta de de que el archivo no es una imagen
            Swal.fire({
                icon: "error",
                title: "¡La imagen debe estar en formato JPG o PNG!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            });
        } else if (imagen["size"] > 2000000) {
            /* los 2000000 equivalen a 2mb 
                    Teniendo en cuenta: 
                    - 2 MB
                    - 2.000 KB
                    - 2.000.000 bytes
                */
            $("#nuevaFoto").val("");
            $(".previsualizar").attr("src", "");

            Swal.fire({
                icon: "warning",
                title: "¡La imagen no debe pesar más de 2 MB ",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
            });
        } else {
            var datosImgaen = new FileReader();
            datosImgaen.readAsDataURL(imagen);

            $(datosImgaen).on("load", function (event) {
                var rutaImagen = event.target.result;
                $(".previsualizar").attr("src", rutaImagen);
            });
        }
    });

    /* ===================================================
      EVENTO PARA EVITAR EL CARGUE DE ARCHIVOS CON MAS DE 2 MB
    ===================================================*/
    const MAXIMO_TAMANIO_BYTES = 2000000; // 1MB = 1 millón de bytes
    $(document).on("change", "input[type='file']", function () {
        if ($(this).attr("id") != "nuevaFoto") {
            var archivo = this.files[0];

            if (false/*archivo.size > MAXIMO_TAMANIO_BYTES*/) {
                const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
                Swal.fire({
                    icon: "warning",
                    title: `¡El documento no debe pesar más de ${tamanioEnMb} MB `,
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                });
                // Limpiar
                $(this).val("");
            } else {
                var admitidos = $(this).attr("accept");
                /* let admitejpg = admitidos.includes("image/jpeg");
                let admitepng = admitidos.includes("image/png");
                let admitepdf = admitidos.includes("application/pdf"); */
                admitefile = admitidos.includes(archivo["type"]);
                if (!admitefile) {
                    Swal.fire({
                        icon: "error",
                        title: "¡Este tipo de archivo no es permitido!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    });
                    // Limpiar
                    $(this).val("");
                }
            }
        }
    });

    /* ===================================================
        CERRAR MODAL UNICAMENTE DE LOS BOTONES
    ===================================================*/
    //data-backdrop="static" data-keyboard="false"
    $(".modal").attr("data-backdrop", "static");
    $(".modal").attr("data-keyboard", "false");
});