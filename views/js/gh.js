/* ===================================================
  * CONFIGURACION DE LOS TABS
===================================================*/
let tabsConfigGH = {
    tabs: [
        {
            id: 'gh-tab1',
            label: 'Personal',
            url: 'gh-personal',
            tooltip: 'Personal',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        },
        {
            id: 'gh-tab2',
            label: 'Perfil sociodemográfico',
            url: 'gh-perfil-sd',
            tooltip: 'Perfil sociodemográfico',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        },
        {
            id: 'gh-tab3',
            label: 'Pago seguridad social',
            url: '#',
            tooltip: 'Pago seguridad social',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        },
        {
            id: 'gh-tab4',
            label: 'Alertas de contratos',
            url: '#',
            tooltip: 'Alertas de contratos',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        },
        {
            id: 'gh-tab5',
            label: 'Control ausentismo',
            url: '#',
            tooltip: 'Control ausentismo',
            tabClass: 'customTabClass',
            spacerClass: 'customSpacerClass',
        }

        // ...
    ]
};

/* ===================================================
  * PERSONAL
===================================================*/
if (
    window.location.href == `${urlPagina}gh-personal/` ||
    window.location.href == `${urlPagina}gh-personal`
) {
    $(document).ready(function () {
        // PERSONAL tab
        $('#ghTabs').simpleTabs(tabsConfigGH, 'gh-tab1');

        /* ===================================================
            FORMULARIO GENERAL
        ===================================================*/
        $("#frmPersonal").submit(function (e) {
            e.preventDefault();

            var datosAjax = new FormData();
            datosAjax.append('GuardarPersonal', "ok");

            // DATOS FORMULARIO
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach(element => {
                datosAjax.append(element.name, element.value);
            });

            // FOTO
            var files = $('#nuevaFoto')[0].files;
            datosAjax.append("foto", files[0]);

            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    switch (response) {
                        case "existe":
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ya existe un registro con este número de cédula',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            })
                            break;

                        case "error":
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'gh-personal';
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

                            // Id usuario
                            $("#idPersonal").val(response);

                            // Titulo modal
                            var nombreEmpleado = $("#Nombre").val();
                            $("#titulo-modal-personal").html(nombreEmpleado);

                            // Evento para refrescar la pagina cuando sale de la modal
                            $('#PersonalModal').on('hidden.bs.modal', function () {
                                window.location = 'gh-personal';
                            })
                            break;
                    }
                }
            });
        });

        /* ===================================================
          CLICK EN NUEVO EMPLEADO
        ===================================================*/
        $(document).on("click", ".btn-agregarPersonal", function () {
            $("#titulo-modal-personal").html("Nuevo");
            $(".formulario").trigger("reset"); //reset formulario
            $("#idPersonal").val(""); //reset id personal
            $('.select2-single').trigger('change'); //reset select2
            $('.previsualizar').attr('src', 'views/img/fotosUsuarios/default/anonymous.png'); //reset foto

            /* RESET DE LAS TABLAS QUE INCLUYEN EL RESTO DEL FORMULARIO */
            // Quitar datatable
            $(".tablas-dinamicas").dataTable().fnDestroy();
            // Borrar datos
            $(".tbody-tablas-dinamicas").html("");
        });

        /* ===================================================
          CLICK EN EDITAR PERSONAL
        ===================================================*/
        $(document).on("click", ".btn-editarPersonal", function () {
            var idPersonal = $(this).attr("idPersonal");
            $("#idPersonal").val(idPersonal); //asignar id personal
            $("#titulo-modal-personal").html("");
            $(".formulario").trigger("reset"); //reset formulario
            $('.select2-single').trigger('change'); //reset select2
            $('.previsualizar').attr('src', 'views/img/fotosUsuarios/default/anonymous.png'); //reset foto

            /* HIJOS */
            AjaxTablaHijos(idPersonal);
            /* CONTRATOS Y PRORROGAS */
            AjaxTablaProrrogas(idPersonal);
            /* LICENCIAS DE CONDUCCIÓN */
            AjaxTablaLicencias(idPersonal);
            /* EXÁMENES MÉDICOS */
            AjaxTablaExamenes(idPersonal);

            /* AJAX PARA CARGAR DATOS */
            var datos = new FormData();
            datos.append('DatosEmpleado', "ok");
            datos.append('idPersonal', idPersonal);
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datos,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        $("#titulo-modal-personal").html(response.Nombre);

                        $("#Documento").val(response.Documento);
                        $(`.tipo_doc[value='${response.tipo_doc}']`).iCheck('check');
                        $("#lugar_expedicion").val(response.lugar_expedicion);
                        $("#Nombre").val(response.Nombre);
                        $(`.consentimiento_informado[value='${response.consentimiento_informado}']`).iCheck('check');
                        $("#fecha_nacimiento").val(response.fecha_nacimiento);
                        $("#lugar_nacimiento").val(response.lugar_nacimiento);
                        $("#edad").val(response.edad);
                        $("#lugar_residencia").val(response.lugar_residencia);
                        $("#direccion").val(response.direccion);
                        $("#barrio").val(response.barrio);
                        $("#estrato_social").val(response.estrato_social);
                        $(`.tipo_vivienda[value='${response.tipo_vivienda}']`).iCheck('check');
                        $("#telefono1").val(response.telefono1);
                        $("#telefono2").val(response.telefono2);
                        $("#estado_civil").val(response.estado_civil);
                        $(`.genero[value='${response.genero}']`).iCheck('check');
                        $("#tipo_sangre").val(response.tipo_sangre);
                        $("#raza").val(response.raza);
                        $("#correo").val(response.correo);
                        $("#nivel_escolaridad").val(response.nivel_escolaridad);
                        $("#cargo").val(response.cargo);
                        $(`.area[value='${response.area}']`).iCheck('check');
                        $("#proceso").val(response.proceso);
                        $("#antiguedad").val(response.antiguedad);
                        $(`.turno_trabajo[value='${response.turno_trabajo}']`).iCheck('check');
                        $("#tipo_contrato").val(response.tipo_contrato);
                        $(`.tipo_vinculacion[value='${response.tipo_vinculacion}']`).iCheck('check');
                        $("#pago_seguridadsocial").val(response.pago_seguridadsocial);
                        $("#anios_experiencia").val(response.anios_experiencia);
                        $("#dependientes").val(response.dependientes);
                        $("#eps").val(response.eps);
                        $("#afp").val(response.afp);
                        $("#arl").val(response.arl);
                        $("#salario_basico").val(response.salario_basico);
                        $("#beneficio_fijo").val(response.beneficio_fijo);
                        $("#bonificacion_variable").val(response.bonificacion_variable);
                        $("#ciudad").val(response.ciudad);
                        $("#sucursal").val(response.sucursal);
                        $(`.activo[value='${response.activo}']`).iCheck('check');
                        $("#fecha_ingreso").val(response.fecha_ingreso);
                        $("#empresa").val(response.empresa);

                        if (response.foto != "" && response.foto != null) {
                            $(".previsualizar").attr("src", response.foto);
                        }
                        else {
                            $(".previsualizar").attr("src", `${urlPagina}views/img/fotosUsuarios/default/anonymous.png`);
                        }

                        $('.select2-single').trigger('change'); //change values select2
                    }
                }
            });
        });

        /* ===================================================
          ACTIVAR/DESACTIVAR PERSONAL
        ===================================================*/
        $(document).on("click", ".btnActivarPersonal", function () {
            var $boton = $(this);
            var idPersonal = $(this).attr("idPersonal");
            var estado = $(this).attr("estado");

            var datos = new FormData();
            datos.append("CambiarActivo", "ok");
            datos.append("idPersonal", idPersonal);
            datos.append("estadoActual", estado);
            $.ajax({
                url: `${urlPagina}ajax/gh.ajax.php`,
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {

                    if (response == "ok") {
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: true,
                            title: "Actualización exitosa",
                            confirmButtonText: "¡Cerrar!"
                        });

                        if (estado == 'S') {
                            $boton.removeClass("btn-success");
                            $boton.addClass("btn-danger");
                            $boton.html("Inactivo");
                            $boton.attr("estado", "N");
                        } else {
                            $boton.addClass("btn-success");
                            $boton.removeClass("btn-danger");
                            $boton.html("Activo");
                            $boton.attr("estado", "S");
                        }
                    }

                }
            });

        });

        /* ===================================================
          ? HIJOS
        ===================================================*/
        /* ===================================================
            FORMULARIO HIJOS
        ===================================================*/
        $("#frmHijos").submit(function (e) {
            e.preventDefault();

            var idPersonal = $("#idPersonal").val();

            if (idPersonal != "") {
                var datosAjax = new FormData();
                datosAjax.append('GuardarHijos', "ok");

                // DATOS FORMULARIO
                var datosFrm = $(this).serializeArray();
                datosFrm.forEach(element => {
                    datosAjax.append(element.name, element.value);
                });

                datosAjax.append("idPersonal", idPersonal);

                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/gh.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response == "ok") {
                            // Cargar de nuevo la tabla hijos
                            AjaxTablaHijos(idPersonal);
                            // Reset del formulario
                            $("#frmHijos").trigger("reset");
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'gh-personal';
                                }

                            })
                        }
                    }
                });
            }

        });

        /* ===================================================
            TABLA HIJOS
        ===================================================*/
        const AjaxTablaHijos = (idPersonal) => {
            // Quitar datatable
            $("#tblHijos").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyHijos").html("");

            let datos = new FormData();
            datos.append('TablaHijos', 'ok');
            datos.append('idPersonal', idPersonal);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != '' || response != null) {
                        $("#tbodyHijos").html(response);
                    } else {
                        $("#tbodyHijos").html('');
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    dataTable("#tblHijos");
                }
            });
        }

        /* ===================================================
            ELIMINAR HIJO
        ===================================================*/
        $(document).on("click", ".eliminarHijo", function () {
            var idhijo = $(this).attr("idhijo");
            var idPersonal = $(this).attr("idPersonal");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este registro?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#0275d8',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append('EliminarHijo', "ok");
                    datos.append('idhijo', idhijo);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/gh.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Mensaje de éxito
                            if (response == "ok") {
                                AjaxTablaHijos(idPersonal);
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Registro eliminado correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                })
                            }
                            // Mensaje de error
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                }).then((result) => {

                                    if (result.value) {
                                        window.location = 'gh-personal';
                                    }

                                })
                            }
                        }
                    });
                }

            })

        });

        /* ===================================================
            ? CONTRATOS Y PRORROGAS
        ===================================================*/
        /* ===================================================
            FORMULARIO CONTRATOS Y PRORROGAS
        ===================================================*/
        $("#frmProrrogas").submit(function (e) {
            e.preventDefault();

            var idPersonal = $("#idPersonal").val();

            if (idPersonal != "") {
                var datosAjax = new FormData();
                datosAjax.append('GuardarProrroga', "ok");

                // DATOS FORMULARIO
                var datosFrm = $(this).serializeArray();
                datosFrm.forEach(element => {
                    datosAjax.append(element.name, element.value);
                });

                datosAjax.append("idPersonal", idPersonal);

                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/gh.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != "error") {
                            // DOCUMENTO
                            var documento = $('#inputfile-prorrogas')[0].files;
                            CargarDocumento(idPersonal, documento, "contratos", response, "no");
                            // Cargar de nuevo la tabla prorrogas - esto se va a hacer despues de obtener respuesta de la funcion anterior de cargar documeno
                            //AjaxTablaProrrogas(idPersonal);

                            // Reset del formulario
                            $("#frmProrrogas").trigger("reset");
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'gh-personal';
                                }

                            })
                        }
                    }
                });
            }

        });

        /* ===================================================
            TABLA CONTRATOS Y PRORROGAS
        ===================================================*/
        const AjaxTablaProrrogas = (idPersonal) => {
            // Quitar datatable
            $("#tblProrrogas").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyProrrogas").html("");

            let datos = new FormData();
            datos.append('TablaProrrogas', 'ok');
            datos.append('idPersonal', idPersonal);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != '' || response != null) {
                        $("#tbodyProrrogas").html(response);
                    } else {
                        $("#tbodyProrrogas").html('');
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    dataTable("#tblProrrogas");
                }
            });
        }

        /* ===================================================
            ELIMINAR CONTRATOS Y PRORROGAS
        ===================================================*/
        $(document).on("click", ".eliminarProrroga", function () {
            var idprorroga = $(this).attr("idprorroga");
            var idPersonal = $(this).attr("idPersonal");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este registro?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#0275d8',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append('EliminarProrroga', "ok");
                    datos.append('idprorroga', idprorroga);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/gh.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Mensaje de éxito
                            if (response == "ok") {
                                AjaxTablaProrrogas(idPersonal);
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Registro eliminado correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                })
                            }
                            // Mensaje de error
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                }).then((result) => {

                                    if (result.value) {
                                        window.location = 'gh-personal';
                                    }

                                })
                            }
                        }
                    });
                }

            })

        });

        /* ===================================================
            ? LICENCIAS DE CONDUCCION
        ===================================================*/
        /* ===================================================
            FORMULARIO LICENCIAS DE CONDUCCION
        ===================================================*/
        $("#frmLicencias").submit(function (e) {
            e.preventDefault();

            var idPersonal = $("#idPersonal").val();

            if (idPersonal != "") {
                var datosAjax = new FormData();
                datosAjax.append('GuardarLicencia', "ok");

                // DATOS FORMULARIO
                var datosFrm = $(this).serializeArray();
                datosFrm.forEach(element => {
                    datosAjax.append(element.name, element.value);
                });

                datosAjax.append("idPersonal", idPersonal);

                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/gh.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != "error") {
                            // DOCUMENTO
                            var documento = $('#inputfile-licencias')[0].files;
                            CargarDocumento(idPersonal, documento, "licencias", response, "no");
                            // Cargar de nuevo la tabla licencias - esto se va a hacer despues de obtener respuesta de la funcion anterior de cargar documeno
                            //AjaxTablaLicencias(idPersonal);

                            // Reset del formulario
                            $("#frmLicencias").trigger("reset");
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'gh-personal';
                                }

                            })
                        }
                    }
                });
            }

        });

        /* ===================================================
            TABLA LICENCIAS DE CONDUCCION
        ===================================================*/
        const AjaxTablaLicencias = (idPersonal) => {
            // Quitar datatable
            $("#tblLicencias").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyLicencias").html("");

            let datos = new FormData();
            datos.append('TablaLicencias', 'ok');
            datos.append('idPersonal', idPersonal);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != '' || response != null) {
                        $("#tbodyLicencias").html(response);
                    } else {
                        $("#tbodyLicencias").html('');
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    dataTable("#tblLicencias");
                }
            });
        }

        /* ===================================================
            ELIMINAR LICENCIA DE CONDUCCIÓN
        ===================================================*/
        $(document).on("click", ".eliminarLicencia", function () {
            var idlicencia = $(this).attr("idlicencia");
            var idPersonal = $(this).attr("idPersonal");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este registro?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#0275d8',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append('EliminarLicencia', "ok");
                    datos.append('idlicencia', idlicencia);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/gh.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Mensaje de éxito
                            if (response == "ok") {
                                AjaxTablaLicencias(idPersonal);
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Registro eliminado correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                })
                            }
                            // Mensaje de error
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                }).then((result) => {

                                    if (result.value) {
                                        window.location = 'gh-personal';
                                    }

                                })
                            }
                        }
                    });
                }

            })

        });

        /* ===================================================
            ? EXÁMENES MÉDICOS
        ===================================================*/
        /* ===================================================
            FORMULARIO EXÁMENES MÉDICOS
        ===================================================*/
        $("#frmExamenes").submit(function (e) {
            e.preventDefault();

            var idPersonal = $("#idPersonal").val();

            if (idPersonal != "") {
                var datosAjax = new FormData();
                datosAjax.append('GuardarExamen', "ok");

                // DATOS FORMULARIO
                var datosFrm = $(this).serializeArray();
                datosFrm.forEach(element => {
                    datosAjax.append(element.name, element.value);
                });

                datosAjax.append("idPersonal", idPersonal);

                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/gh.ajax.php`,
                    data: datosAjax,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != "error") {
                            // DOCUMENTO
                            var documento = $('#inputfile-examenes')[0].files;
                            CargarDocumento(idPersonal, documento, "examenes", response, "no");
                            // Cargar de nuevo la tabla examenes - esto se va a hacer despues de obtener respuesta de la funcion anterior de cargar documeno
                            //AjaxTablaExamenes(idPersonal);

                            // Reset del formulario
                            $("#frmExamenes").trigger("reset");
                            // Mensaje de éxito al usuario
                            Swal.fire({
                                icon: 'success',
                                title: '¡Datos guardados correctamente!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ha ocurrido un error, por favor intente de nuevo',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                                closeOnConfirm: false
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'gh-personal';
                                }

                            })
                        }
                    }
                });
            }

        });

        /* ===================================================
            TABLA EXÁMENES MÉDICOS
        ===================================================*/
        const AjaxTablaExamenes = (idPersonal) => {
            // Quitar datatable
            $("#tblExamenes").dataTable().fnDestroy();
            // Borrar datos
            $("#tbodyExamenes").html("");

            let datos = new FormData();
            datos.append('TablaExamenes', 'ok');
            datos.append('idPersonal', idPersonal);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != '' || response != null) {
                        $("#tbodyExamenes").html(response);
                    } else {
                        $("#tbodyExamenes").html('');
                    }

                    /* ===================================================
                    INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                    ===================================================*/
                    dataTable("#tblExamenes");
                }
            });
        }

        /* ===================================================
            ELIMINAR EXÁMEN MÉDICO
        ===================================================*/
        $(document).on("click", ".eliminarExamen", function () {
            var idexamen = $(this).attr("idexamen");
            var idPersonal = $(this).attr("idPersonal");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este registro?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#0275d8',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append('EliminarExamen', "ok");
                    datos.append('idexamen', idexamen);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/gh.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Mensaje de éxito
                            if (response == "ok") {
                                AjaxTablaExamenes(idPersonal);
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Registro eliminado correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                })
                            }
                            // Mensaje de error
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                }).then((result) => {

                                    if (result.value) {
                                        window.location = 'gh-personal';
                                    }

                                })
                            }
                        }
                    });
                }

            })

        });

        /* ===================================================
          ? CARGAR DOCUMENTOS
        ===================================================*/
        const CargarDocumento = (idPersonal, documento, tipoDoc, idregistro, msjExito) => {
            var datos = new FormData();
            datos.append('CargarDocumento', "ok");
            datos.append('idPersonal', idPersonal);
            datos.append('documento', documento[0]);
            datos.append('tipoDoc', tipoDoc);
            datos.append('idregistro', idregistro);
            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/gh.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok" || response == "vacio") {
                        /* CARGAR DE NUEVO LA TABLA CORRESPONDIENTE */
                        switch (tipoDoc) {
                            case "examenes":
                                AjaxTablaExamenes(idPersonal);
                                break;

                            case "licencias":
                                AjaxTablaLicencias(idPersonal);
                                break;

                            case "contratos":
                                AjaxTablaProrrogas(idPersonal);
                                break;

                            default:
                                break;
                        }

                        // Mensaje al usuario de que se subió correctamente el documento
                        if (msjExito == "si"){
                            if (response == "ok"){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Documento subido correctamente!',
                                    showConfirmButton: false,
                                })
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Primero seleccione un archivo',
                                    showConfirmButton: false,
                                })
                            }
                        }
                    } else {
                        // Mensaje al usuario de que NO se subió el documento
                        if (msjExito == "si") {
                            Swal.fire({
                                icon: 'error',
                                title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                showConfirmButton: true,
                                confirmButtonText: 'Cerrar',
                            }).then((result) => {

                                if (result.value) {
                                    window.location = 'gh-personal';
                                }

                            })
                        }
                    }
                }
            });
        }

        /* ===================================================
          ELIMINAR DOCUMENTO
        ===================================================*/
        $(document).on("click", ".btnEliminarDoc", function () {
            var idPersonal = $(this).attr("idPersonal");
            var idregistro = $(this).attr("idregistro");
            var tipoDoc = $(this).attr("tipoDoc");

            Swal.fire({
                icon: 'warning',
                title: '¿Desea eliminar este documento?',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#d9534f',
                cancelButtonColor: '#0275d8',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var datos = new FormData();
                    datos.append('EliminarDocumento', "ok");
                    datos.append('idregistro', idregistro);
                    datos.append('tipoDoc', tipoDoc);
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/gh.ajax.php`,
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Mensaje de éxito
                            if (response == "ok") {
                                /* CARGAR DE NUEVO LA TABLA CORRESPONDIENTE */
                                switch (tipoDoc) {
                                    case "examenes":
                                        AjaxTablaExamenes(idPersonal);
                                        break;

                                    case "licencias":
                                        AjaxTablaLicencias(idPersonal);
                                        break;

                                    case "contratos":
                                        AjaxTablaProrrogas(idPersonal);
                                        break;

                                    default:
                                        break;
                                }
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Documento eliminado correctamente!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                })
                            }
                            // Mensaje de error
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                }).then((result) => {

                                    if (result.value) {
                                        window.location = 'gh-personal';
                                    }

                                })
                            }
                        }
                    });
                }
            })
        });

        /* ===================================================
          CLICK EN CARGAR DOCUMENTO DESPUES DE TENER CREADO EL REGISTRO
        ===================================================*/
        $(document).on("click", ".btnSubirDoc", function () {
            var idPersonal = $(this).attr("idPersonal");
            var idregistro = $(this).attr("idregistro");
            var tipoDoc = $(this).attr("tipoDoc");

            Swal.fire({
                html: `<div class="form-group">
                        <label for="exampleInput1">CARGAR DOCUMENTO</label>
                        <div class="input-group mt-1">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fas fa-file-alt"></i>
                                </span>
                            </div>
                            <input type="file" class="form-control" name="" id="swal-inputfile" accept="image/png, image/jpeg, application/pdf">
                        </div>
                    </div>`,
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d9534f',
                closeOnConfirm: false
            }).then((result) => {
                if (result.value) {
                    var documento = $('#swal-inputfile')[0].files;
                    CargarDocumento(idPersonal, documento, tipoDoc, idregistro, "si");

                }
            })
        });


    });
}

/* ===================================================
  * PERFIL SOCIODEMOGRÁFICO
===================================================*/
if (
    window.location.href == `${urlPagina}gh-perfil-sd/` ||
    window.location.href == `${urlPagina}gh-perfil-sd`
) {
    $(document).ready(function () {
        // Perfil sociodemográfico tab
        $('#ghTabs').simpleTabs(tabsConfigGH, 'gh-tab2');
    });
}

