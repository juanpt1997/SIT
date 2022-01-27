$(document).ready(function () {
    /* ===================================================
      MOSTRAR O ESCONDER EL MINI MENU DE LA IZQUIERDA SEGUN LA VISTA EN LA QUE SE ENCUENTRE
    ===================================================*/
    if (
        window.location.href == `${dominioApp}/sit/${proyecto}/inicio/` ||
        window.location.href == `${dominioApp}/sit/${proyecto}/inicio` ||
        window.location.href == `${dominioApp}/sit/${proyecto}/` ||
        window.location.href == `${dominioApp}/sit/${proyecto}`
    ) {
        $("body").removeClass("sidebar-mini");

        //OBTENER ID DE CALENDAR LOCALIZADO EN INICIO
        var calendarEl = document.getElementById("calendar");

        //FUNCION QUE DEFINE EL CALENDARIO
        var calendario;
        function initCalendario() {
            var datosAjax = new FormData();
            datosAjax.append("cargarCalendario", "ok");

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        //VISTA INICIAL AL RENDERIZAR EL CALENDARIO
                        //posibles vistas (dayGridMonth,timeGridWeek,listMonth,listWeek,dayGridWeek,vista personalizada)
                        initialView: "dayGridMonth",

                        //themeSystem: 'bootstrap',

                        dayMaxEventRows: 3,

                        headerToolbar: {
                            start: "prev,next",
                            center: "title",
                            end: "dayGridMonth,timeGridWeek,listMonth custom1",
                        },

                        //BOTONES PERSONALIZADOS (agregar funciones al metodo click)
                        customButtons: {
                            //BOTON PERSONALIZADO 1 (se pueden crear varios)
                            custom1: {
                                text: "Hoy",
                                click: function () {
                                    //Muestra el dia actual del calendario segun la fecha
                                    calendar.today();
                                    //cargar tareas del dia
                                    tareasDelDia();
                                },
                            },
                        },

                        views: {
                            timeGridWeek: {
                                titleFormat: { month: "long", year: "numeric" },
                                // dayMaxEventRows: 6
                            },
                        },

                        // formato calendario
                        fixedWeekCount: false,
                        locale: "Es",
                        eventDisplay: "block",
                        displayEventTime: false,
                        editable: true,
                        droppable: true,
                        weekNumbers: true,
                        eventResizableFromStart: false,

                        events: response,

                        // mostrar info de la tarea al clickear la tarea especifica
                        eventClick: function (info) {
                            visualizarTarea(info);
                        },

                        eventDrop: function (info) {
                            //console.log(info);
                            soltarTarea(info, info.event);
                        },
                    });

                    calendar.render();

                    calendario = calendar;
                },
            });
        }

        //INICIALIZAR EL CALENDARIO
        $("#custom-tabs-five-normal-tab").on("shown.bs.tab", function (e) {
            initCalendario();
        });

        //FUNCION QUE AÑADE UN EVENTO NUEVO AL CALENDARIO
        function crearEvento(calendar, evento) {
            calendar.addEvent(evento);
        }

        //FUNCION QUE ALMACENA EN LA BD el evento
        function almacenarEvento() {
            //guardar los datos al crear la tarea
            let titulo = $("#titulo_tarea").val();
            let fecha_i = $("#fecha_inicio").val();
            let fecha_f = $("#fecha_final").val();
            let descripcion = $("#descripcion_tarea").val();

            if (titulo == "" || fecha_i == "") {
                Swal.fire({
                    icon: "warning",
                    title: "Asegurese de describir una tarea y su fecha de inicio.",
                    showConfirmButton: true,
                    confirmButtonText: "continuar",
                });
            } else {
                var datosAjax = new FormData();
                datosAjax.append("almacenarEvento", "ok");
                datosAjax.append("titulo", titulo);
                datosAjax.append("fecha_i", fecha_i);
                datosAjax.append("fecha_f", fecha_f);
                datosAjax.append("descripcion", descripcion);
                datosAjax.append("color", "#DBD053");
                datosAjax.append("estado_tarea", "PENDIENTE");

                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/calendario.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Tarea añadida al calendario.",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            allowOutsideClick: false,
                        });
                        //AÑADIR EVENTO AL CALENDARIO
                        crearEvento(calendario, {
                            title: titulo,
                            start: fecha_i,
                            end: fecha_f,
                            color: "#DBD053",
                            id: response,
                        });
                        initCalendario();
                        ListaTareas("PENDIENTE", "lista_pendientes");
                        ListaTareas("FINALIZADA", "lista_finalizadas");
                        //RESET Valores
                        $("#titulo_tarea").val("");
                        $("#fecha_inicio").val("");
                        $("#fecha_final").val("");
                        $("#descripcion_tarea").val("");
                    },
                });
            }
        }

        //FUNCION PARA VISUALIZAR LOS DATOS DE UN EVENTO/TAREA
        function datosEvento(id) {
            var datosAjax = new FormData();
            datosAjax.append("datosEvento", "ok");
            datosAjax.append("id_evento", id);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    $("#modal_titulo_tarea").val(response.title);
                    $("#modal_descripcion").val(response.descripcion);
                    $("#modal_fecha_inicio").val(response.start);
                    $("#modal_fecha_final").val(response.end);
                    $("#id_evento").val(id);

                    if (response.estado_tarea == "PENDIENTE") {
                        $("#btn_finalizada").removeClass("d-none");
                        $("#btn_pendiente").addClass("d-none");
                    } else {
                        $("#btn_pendiente").removeClass("d-none");
                        $("#btn_finalizada").addClass("d-none");
                    }
                },
            });
        }

        //FUNCION PARA VER LA TAREA AL DARLE CLICK(PERMITIRIA CAMBIAR EL ESTADO)
        function visualizarTarea(info) {
            $("#modal_tarea").modal("show");

            let id = info.event.id;
            datosEvento(id);
        }

        //FUNCION ARRASTRAR Y SOLTAR UNA TAREA (ACTUALIZA LA FECHA)
        function soltarTarea(info, event) {
            let id = event.id;

            //GUARDAMOS LA NUEVA FECHA INICAL AL SOLTAR EL EVENTO
            let nuevaFechaI = event.start;
            //FORMATEAMOS LA FECHA PARA GUARDAR EN LA BD
            let fechaInicio_formateada = moment(nuevaFechaI).format(
                "YYYY-MM-DD HH:mm:ss"
            );
            //GUARDAMOS LA NUEVA FECHA FINAL AL SOLTAR EL EVENTO
            let nuevaFechaF = event.end;
            let fechaFinal_formateada;

            if(nuevaFechaF == null){

                fechaFinal_formateada = fechaInicio_formateada;

            }else{
                //FORMATEAMOS LA FECHA PARA GUARDAR EN LA BD
                fechaFinal_formateada = moment(nuevaFechaF).format(
                    "YYYY-MM-DD HH:mm:ss"
                );
            }

            Swal.fire({
                title: "¿Está seguro que desea cambiar la fecha de la tarea?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, actualizar!",
            }).then((result) => {
                if (result.value == true) {
                    var datosAjax = new FormData();
                    datosAjax.append("actualizarFechas", "ok");
                    datosAjax.append("id", id);
                    datosAjax.append("fecha_i", fechaInicio_formateada);
                    datosAjax.append("fecha_f", fechaFinal_formateada);

                    $.ajax({
                        type: "post",
                        url: `${urlPagina}ajax/calendario.ajax.php`,
                        data: datosAjax,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    title: "Actualizado!",
                                    icon: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                });
                                initCalendario();
                                ListaTareas("PENDIENTE", "lista_pendientes");
                                ListaTareas("FINALIZADA", "lista_finalizadas");
                            }
                        },
                    });
                } else {
                    info.revert();
                }
            });
        }

        //CARGAR LAS TAREAS DEL DIA ACTUAL
        function tareasDelDia() {
            let fecha_actual = moment().format("YYYY-MM-DD");
            let tareas = [];

            var datosAjax = new FormData();
            datosAjax.append("cargarCalendario", "ok");

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    var tareas = ``;
                    var bg = ``;

                    response.forEach((element) => {
                        let fecha = moment(element.start).format("YYYY-MM-DD");

                        if (fecha == fecha_actual) {
                            if (element.estado_tarea == "PENDIENTE") {
                                bg = `<span class="badge badge-warning">pendiente</span>`;
                            } else {
                                bg = `<span class="badge badge-success">finalizada</span>`;
                            }
                            if (element.end == null) {
                                fin = "Sin fecha final."
                            } else{
                                fin = element.end;
                            }

                            tareas += `<li style="font-family: Arial, Helvetica, sans-serif;"><strong><i>Título: </i></strong> ${element.title}</li><li style="font-family: Arial, Helvetica, sans-serif;"><strong><i>Descripción: </i></strong> ${element.descripcion}</li><li style="font-family: Arial, Helvetica, sans-serif;"><strong><i>Fecha de inicio: </i></strong> ${element.start}</li><li style="font-family: Arial, Helvetica, sans-serif;"><strong><i>Fecha final: </i></strong> ${fin}</li><li style="font-family: Arial, Helvetica, sans-serif;"><strong><i>Estado: </i></strong> ${bg}</li><br>`;
                        }
                    });

                    if (tareas != "") {
                        //$("#ingresar_tareas").html(tareas);
                        Swal.fire({
                            title:`<h3><i class="fas fa-clipboard-list" style='color: #02075d;'></i>&nbsp<i style='color: #000000;'>TAREAS DEL DÍA</i></h3>`,
                            html:`<hr class="bg-dark"><ul style='list-style: none;'>${tareas}</ul>`,
                            showCancelButton: false,
                            confirmButtonColor: "#02075d",
                            confirmButtonText: "Continuar.",
                        })
                    } else {
                        // $("#ingresar_tareas").html(
                        //     "<i>No hay tareas disponibles para el día de hoy.</i>"
                        // );
                        Swal.fire({
                            title:`<h3><i class="fas fa-clipboard-list" style='color: #02075d;'></i>&nbsp<i style='color: #000000;'>TAREAS DEL DÍA</i></h3>`,
                            html:`<i>No hay tareas disponibles para el día de hoy</i>`,
                            showCancelButton: false,
                            confirmButtonColor: "#02075d",
                            confirmButtonText: "Continuar",
                        })
                    }
                },
            });
            //$("#tareas_del_dia").modal("show");
        }

        //AGREGAR UNA TAREA AL CALENDARIO
        $(".btn-crearTarea").on("click", function () {
            //GUARDAR EN LA BD Y ENVIAR AL CALENDARIO
            almacenarEvento();
            $(".input_add_tarea").removeClass("is-valid");
            $(".input_add_tarea").removeClass("is-invalid");
        });

        //EDITAR UNA TAREA
        $(".btn-editar").on("click", function () {
            let id = $("#id_evento").val();
            let titulo = $("#modal_titulo_tarea").val();
            let fecha_i = $("#modal_fecha_inicio").val();
            let fecha_f = $("#modal_fecha_final").val();
            let descripcion = $("#modal_descripcion").val();

            if (id != "") {
                var datosAjax = new FormData();
                datosAjax.append("editarEvento", "ok");
                datosAjax.append("id", id);
                datosAjax.append("titulo", titulo);
                datosAjax.append("fecha_i", fecha_i);
                datosAjax.append("fecha_f", fecha_f);
                datosAjax.append("descripcion", descripcion);

                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/calendario.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    //dataType: "json",
                    success: function (response) {
                        if (response == "ok") {
                            Swal.fire({
                                icon: "success",
                                title: "Actualizado.",
                                text: "Tarea actualizada con éxito.",
                                showConfirmButton: true,
                                confirmButtonText: "continuar",
                            });
                            initCalendario();
                            ListaTareas("PENDIENTE", "lista_pendientes");
                            ListaTareas("FINALIZADA", "lista_finalizadas");
                            $("#modal_tarea").modal("hide");
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Problema al actualizar la tarea.",
                                showConfirmButton: true,
                                confirmButtonText: "continuar",
                            });
                        }
                    },
                });
            }
        });

        //BOTON QUE FINALIZA LA TAREA
        $(".btn-finalizar").on("click", function () {
            let id = $("#id_evento").val();
            let titulo = $("#modal_titulo_tarea").val();
            let fecha_i = $("#modal_fecha_inicio").val();
            let fecha_f = $("#modal_fecha_final").val();
            let descripcion = $("#modal_descripcion").val();

            var datosAjax = new FormData();
            datosAjax.append("estadoTarea", "ok");
            datosAjax.append("id", id);
            datosAjax.append("estado", "PENDIENTE");
            datosAjax.append("titulo", titulo);
            datosAjax.append("fecha_i", fecha_i);
            datosAjax.append("fecha_f", fecha_f);
            datosAjax.append("descripcion", descripcion);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "¡Finalizada!",
                            text: "Tarea finalizada con éxito.",
                            showConfirmButton: true,
                            confirmButtonText: "continuar",
                        });
                        initCalendario();
                        ListaTareas("PENDIENTE", "lista_pendientes");
                        ListaTareas("FINALIZADA", "lista_finalizadas");
                        $("#modal_tarea").modal("hide");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Ocurrió un error al finalizar la tarea.",
                            showConfirmButton: true,
                            confirmButtonText: "continuar",
                        });
                    }
                },
            });
        });

        //BOTON QUE VUELVE PENDIENTE LA TAREA
        $(".btn-pendiente").on("click", function () {
            let id = $("#id_evento").val();
            let titulo = $("#modal_titulo_tarea").val();
            let fecha_i = $("#modal_fecha_inicio").val();
            let fecha_f = $("#modal_fecha_final").val();
            let descripcion = $("#modal_descripcion").val();

            var datosAjax = new FormData();
            datosAjax.append("estadoTarea", "ok");
            datosAjax.append("id", id);
            datosAjax.append("estado", "FINALIZADA");
            datosAjax.append("titulo", titulo);
            datosAjax.append("fecha_i", fecha_i);
            datosAjax.append("fecha_f", fecha_f);
            datosAjax.append("descripcion", descripcion);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "¡Pendiente!",
                            text: "La tarea se ha pospuesto con éxito.",
                            showConfirmButton: true,
                            confirmButtonText: "continuar",
                        });
                        initCalendario();
                        ListaTareas("PENDIENTE", "lista_pendientes");
                        ListaTareas("FINALIZADA", "lista_finalizadas");
                        $("#modal_tarea").modal("hide");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "Ocurrió un error al finalizar la tarea.",
                            showConfirmButton: true,
                            confirmButtonText: "continuar",
                        });
                    }
                },
            });
        });

        //BOTON ELIMINAR TAREA
        $(".btn-eliminar").on("click", function () {
            let id = $("#id_evento").val();

            var datosAjax = new FormData();
            datosAjax.append("eliminarTarea", "ok");
            datosAjax.append("id", id);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: "success",
                            title: "¡Eliminada!",
                            text: "La tarea se ha eliminado con éxito.",
                            showConfirmButton: true,
                            confirmButtonText: "continuar",
                        });
                        // .then(function (){
                        //     location.reload();
                        // })
                        initCalendario();
                        ListaTareas("PENDIENTE", "lista_pendientes");
                        ListaTareas("FINALIZADA", "lista_finalizadas");
                        $("#modal_tarea").modal("hide");
                    }
                },
            });
        });

        //VALIDAR INPUTS AL CREAR TAREA (verificar que no esten vacios)
        $(".input_add_tarea").blur(function () {
            let valor = $(this).val();

            if(valor != ""){

                $(this).addClass("is-valid");
                $(this).removeClass("is-invalid");

            }else {

                $(this).addClass("is-invalid");
                $(this).removeClass("is-valid");
                
            }
        });
        
        //ABRIR MODAL AL DARLE CLICK A LA TAREA LISTADA
        $(document).on("click", ".btn-listaTarea", function () {
            let id = $(this).attr("id");
            $("#modal_tarea").modal("show");
            datosEvento(id);
        });

        //LISTAR TAREAS EN TAB DE VISUALIZACION
        function ListaTareas(estado, lista) {
            var datosAjax = new FormData();
            datosAjax.append("tareasPorEstado", "ok");
            datosAjax.append("estado", estado);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/calendario.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response) {
                        $(`#${lista}`).html(response);
                    } else {
                        $(`#${lista}`).html(
                            "<p><i>No hay tareas disponibles para visualizar.</i></p>"
                        );
                    }
                },
            });
        }

        //INSTANCIAR FUNCION LISTAR TAREAS
        ListaTareas("PENDIENTE", "lista_pendientes");
        ListaTareas("FINALIZADA", "lista_finalizadas");
    } else {
        $("body").addClass("sidebar-mini");
    }
});
