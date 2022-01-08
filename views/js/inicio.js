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
        function initCalendario(data) {
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
                            end: "dayGridMonth,timeGridWeek,listMonth custom1,custom2",
                        },

                        //BOTONES PERSONALIZADOS (agregar funciones al metodo click)
                        customButtons: {
                            //BOTON PERSONALIZADO 1 (se pueden crear varios)
                            custom1: {
                                text: "Hoy",
                                click: function () {
                                    //Muestra el dia actual del calendario segun la fecha
                                    calendar.today();
                                },
                            },
                            custom2: {
                                text: "Tareas del día",
                                click: function () {
                                    alert("tarea del dia");
                                },
                            },
                        },

                        // formato calendario
                        fixedWeekCount: false,
                        locale: "Es",
                        eventDisplay: "block",
                        displayEventTime: false,
                        weekNumbers: true,
                        eventResizableFromStart: false,

                        events: response,

                        // mostrar info de la tarea al clickear la tarea especifica
                        eventClick: function (info) {
                            visualizarTarea(info);
                        },
                    });

                    calendar.render();

                    calendario = calendar;
                },
            });
        }

        //INICIALIZAR EL CALENDARIO
        initCalendario();

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
                        //AÑADIR EVENTO AL CALENDARIO
                        crearEvento(calendario, {
                            title: titulo,
                            start: fecha_i,
                            end: fecha_f,
                            color: "#DBD053",
                            id: response,
                        });
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

        //AGREGAR UNA TAREA AL CALENDARIO
        $(".btn-crearTarea").on("click", function () {
            //GUARDAR EN LA BD Y ENVIAR AL CALENDARIO
            almacenarEvento();
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

            var datosAjax = new FormData();
            datosAjax.append("estadoTarea", "ok");
            datosAjax.append("id", id);
            datosAjax.append("estado", "PENDIENTE");

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
                        ListaTareas("PENDIENTE","lista_pendientes");
                        ListaTareas("FINALIZADA","lista_finalizadas");
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

            var datosAjax = new FormData();
            datosAjax.append("estadoTarea", "ok");
            datosAjax.append("id", id);
            datosAjax.append("estado", "FINALIZADA");

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
                        ListaTareas("PENDIENTE","lista_pendientes");
                        ListaTareas("FINALIZADA","lista_finalizadas");
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

        function ListaTareas(estado,lista){

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
                    $(`#${lista}`).html(response);
                },
            });  
        }
    
        ListaTareas("PENDIENTE","lista_pendientes");
        ListaTareas("FINALIZADA","lista_finalizadas");
             
    } else {
        $("body").addClass("sidebar-mini");
    }
});
