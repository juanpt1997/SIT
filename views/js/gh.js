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
            FORMULARIO
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
                    console.log(response);
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
            $("#frmPersonal").trigger("reset"); //reset formulario
            $("#idPersonal").val(""); //reset id personal
            $('.select2-single').trigger('change'); //reset select2
            $('.previsualizar').attr('src', 'views/img/fotosUsuarios/default/anonymous.png'); //reset foto
        });

        /* ===================================================
          CLICK EN EDITAR PERSONAL
        ===================================================*/
        $(document).on("click", ".btn-editarPersonal", function () {
            var idPersonal = $(this).attr("idPersonal");
            $("#idPersonal").val(idPersonal); //asignar id personal
            $("#frmPersonal").trigger("reset"); //reset formulario
            $('.select2-single').trigger('change'); //reset select2
            $('.previsualizar').attr('src', 'views/img/fotosUsuarios/default/anonymous.png'); //reset foto

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

