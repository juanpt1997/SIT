/* ===================================================
  DOMINIO DE LA PAGINA
===================================================*/

var proyecto = "elsaman"
var urlActual = window.location.href;
var arrayUrlApp = urlActual.split('/');
var protocoloArray = urlActual.split(':');
var protocolo = protocoloArray[0];
var dominioApp = protocolo + "://" + window.document.domain;
var urlPagina = `${dominioApp}/${proyecto}/`;

/* ===================================================
  PERMITIR ESCRIBIR EN EL SWEET ALERT
===================================================*/
// No permite escribir en el input del sweet alert
// Problem: it enforces focus on the Bootstrap modal whenever it loses focus to another element( in this case SweetAlert Modal) in the page.
// WorkAround: It's as simple as removing the focus event.
$.fn.modal.Constructor.prototype._enforceFocus = function () { };


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
      DATATABLE
    ===================================================*/
    $('.tablas').DataTable({

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
    const dataTable = (tabla) => {
        $(`${tabla}`).DataTable({

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

    }
});
