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
        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
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

$(document).ready(function () {
    /* ===================================================
      MOSTRAR O ESCONDER EL MINI MENU DE LA IZQUIERDA SEGUN LA VISTA EN LA QUE SE ENCUENTRE
    ===================================================*/
    if (window.location.href == `${dominioApp}/${proyecto}/inicio` ||
        window.location.href == `${dominioApp}/${proyecto}/` ||
        window.location.href == `${dominioApp}/${proyecto}`
    ) {
        $("body").removeClass("sidebar-mini");
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