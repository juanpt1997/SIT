/*=============================================================
=====================GESTION HUMANA============================
============================================================?*/
if (window.location.href == `${urlPagina}cg-gestion-humana/` ||
    window.location.href == `${urlPagina}cg-gestion-humana`
) {
    $(document).ready(function () {
        //===================BOTON NUEVO CONCEPTO EN GESTION HUMANA
        $(document).on("click", ".btn-nuevo", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalGH").html(concepto);
        });
        //SUBMIT DEL FORMULARIO DE GESTION HUMANA
        $("#formularioGH").submit(function (e) {

            e.preventDefault();//Previene la accion por defecto del boton
            var concepto = $("#titulo_modalGH").html();
            var datos = new FormData();

            datos.append("NuevoGH", "ok");
            datos.append("concepto", concepto);
            datos.append("dato", $("#inputGH").val());

            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "El nuevo dato ha sido agregado",
                            confirmButtonText: "¡Cerrar!",
                            allowOutsideClick: false
                        }).then((result) => {

                            if (result.value) {
                                window.location = 'cg-gestion-humana';
                            }
                        })
                    }
                }
            });
        });
        //===================BOTON VER CONCEPTO EN GESTION HUMANA
        $(document).on("click", ".btn-ver", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVer").html("Visualizar (" + concepto + ")");
            //Quitar datatable
            $("#ver_concepto").dataTable().fnDestroy();
            //Borrar datos
            $("#tbody_ver_concepto").html("");
            //Nombre de la cabecera de la tabla segun el concepto 
            $("#tipo").html(concepto);

            var datos = new FormData();
            datos.append("ajaxVerConcepto", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_concepto").html(response);

                    } else {

                        $("#tbody_ver_concepto").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#ver_concepto`, buttons);
                }
            });
        });
        //=================BOTON CANCELAR AL AGREGAR==================
        //$(document).on("click", ".btn-cancelar", function () {
        $('#AgregarEditarGH, #AgregarCiudad, #VisualizarCiudades, #VisualizarGH, #VisualizarEmpresa, #EditarCiudad').on('hidden.bs.modal', function (e) {
            $(".overlay").each(function () { //Al cancelar se agrega la clase d-none para que no se vea el reload
                $(this).addClass("d-none");
            });
        });
        //===================BOTON EDITAR CONCEPTO EN GESTION HUMANA
        $(document).on("click", ".btnEditar", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var concepto = $(this).attr("concepto");
            var id = $(this).attr("idregistro");
            var dato = $(this).attr("dato");

            Swal.fire({
                title: `Editar (${concepto})`,
                html:
                    `
                <hr>
                <label for="">${concepto}</label>
                <input class="form-control" id="input-edit" type="text" value="${dato}">`
                ,
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    var dato_edit = $("#input-edit").val();
                    var datos = new FormData();
                    datos.append("ajaxEditarConcepto", "ok");
                    datos.append("concepto", concepto);
                    datos.append("id", id);
                    datos.append("dato", dato_edit);

                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El dato ha sido actualizado!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-gestion-humana'; })
                            }
                        }

                    });
                }
            })
        });
        // funcion para el contador de los info box
        $(".info-box-number").each(function () {
            var $infobox = $(this);
            var concepto = $infobox.attr("concepto");
            var datos = new FormData();

            datos.append("ajaxContarRegistro", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                url: "ajax/conceptos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                dataType: "json", //
                processData: false,
                success: function (response) {
                    $infobox.text(response.contador + " registros");
                }
            });
        });
        //EMPRESA
        //========
        //BOTON VER EMPRESA EN GESTION HUMANA
        $(document).on("click", ".btn-ver-empresa", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Quitar datatable
            $("#tabla_empresa").dataTable().fnDestroy();
            //Borrar datos
            $("#tbody_tabla_empresa").html("");

            var datos = new FormData();
            datos.append("VerEmpresa", "ok");
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_tabla_empresa").html(response);
                        $("#titulo_modalEmpresa").html("Empresa");


                    } else {

                        $("#tbody_tabla_empresa").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#tabla_empresa`, buttons);
                }
            });
        });
        //BOTON EDITAR EMPRESA EN GESTION HUMANA
        $(document).on("click", ".btnEditarEmpresa", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var razon = $(this).attr("razon");
            var id = $(this).attr("id");

            var datos = new FormData();
            datos.append("DatosEmpresa", "ok");
            datos.append("id", id);
            //Actualizar datos de la empresa
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response != "") {
                        console.log(response);
                        Swal.fire({
                            title: `Editar (${razon})`,
                            html:
                                `
                            <hr>
                            <form id="formulario_editar_empresa" method="post" enctype="multipart/form-data">
                            <label class="text-sm">Razón social</label>
                            <input class="form-control" id="razon" name="razon" type="text" value="${response.razon_social}" required>
                            <label class="text-sm">NIT</label>
                            <input class="form-control" id="nit" name="nit" type="text" value="${response.nit}" required>
                            <label class="text-sm">Número de resolución</label>
                            <input class="form-control" id="num" name="num" type="text" value="${response.nro_resolucion}" required>
                            <label class="text-sm">Año de resolución</label>
                            <input class="form-control" id="anio" name="anio" type="text" value="${response.anio_resolucion}" required  >
                            <label class="text-sm">Dirección territorial</label>
                            <input class="form-control" id="dir" name="dir" type="text" value="${response.dir_territorial}" required>
                            <label class="text-sm">Foto firma</label>
                            <input class="form-control" id="firma" name="firma" type="file" accept="image/png, image/jpeg">
                            <label class="text-sm">Sitio WEB</label>
                            <input class="form-control" id="sitio" name="sitio" type="text" value="${response.sitio_web}" required>
                            <label><br></label>
                            </form>`,
                            showConfirmButton: true,
                            showCancelButton: true,
                            confirmButtonText: 'Actualizar',
                            confirmButtonColor: '#33cc33',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {

                            var fotoFirma = $("#firma")[0].files;
                            if (result.value) {
                                var datosAjax = new FormData();
                                var datosFrm = $("#formulario_editar_empresa").serializeArray();
                                datosAjax.append('EditarEmpresa', "ok");
                                datosAjax.append("id_empresa", id);
                                datosAjax.append("imagen", fotoFirma[0]);

                                var vacio = false;
                                datosFrm.forEach(element => {

                                    datosAjax.append(element.name, element.value);

                                    if (element.value == '') {
                                        vacio = true;
                                    }
                                });
                                if (!vacio) {

                                    $.ajax({
                                        type: "post",
                                        url: "ajax/conceptos.ajax.php",
                                        data: datosAjax,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        //dataType: "json",
                                        success: function (response) {
                                            $('#VisualizarEmpresa').modal('toggle');
                                            if (response == 'ok') {
                                                Swal.fire({
                                                    icon: 'success',
                                                    showConfirmButton: true,
                                                    title: "La empresa ha sido actualizada",
                                                    confirmButtonText: "¡Cerrar!",
                                                    allowOutsideClick: false
                                                })
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    showConfirmButton: true,
                                                    title: "Problema al actualizar la empresa",
                                                    confirmButtonText: "¡Cerrar!",
                                                    allowOutsideClick: false
                                                })
                                            }
                                        }
                                    });
                                }
                            }
                        })
                    }
                }
            });
        });
        //CIUDADES
        //========
        //BOTON VER CIUDADES
        $(document).on("click", ".btn-ver-ciudad", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Quitar datatable
            $("#ver_ciudad").dataTable().fnDestroy();
            //Borrar datos
            $("#tbody_ver_ciudad").html("");
            //TITULO
            $("#titulo_ciudades").html('Lista de ciudades');

            var datos = new FormData();
            datos.append("VerCiudades", "ok");
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_ciudad").html(response);

                    } else {

                        $("#tbody_ver_ciudad").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#ver_ciudad`, buttons);
                }
            });
        });
        //Cerrar Modal de ver ciudades al abrir el modal de editar ciudades
        $("#EditarCiudad").on('show.bs.modal', function (e) { $("#VisualizarCiudades").modal("hide"); });
        //BOTON EDITAR CIUDAD
        $(document).on("click", ".btnEditarCiudad", function () {


            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var id = $(this).attr("idregistro");
            $("#idmunicipioedit").val(id);

            var datos = new FormData();
            datos.append("DatosCiudad", "ok");
            datos.append("id", id);

            $("#titulo_ciudad_edit").html("Editar ciudad");

            $.ajax({

                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#municipioEdit").val(response.municipio);
                    $("#departamentosEdit").val(response.iddepartamento);
                    $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT 
                }
            });
        });
        //BOTON AGREGAR CIUDAD
        $(document).on("click", ".btn-nueva-ciudad", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_ciudad").html("Agregar una nueva ciudad");
        });
        //SUBMIT DEL FORMULARIO DE CIUDAD
        $("#formularioCiudadesEdit").submit(function (e) {

            e.preventDefault();//Previene la accion por defecto del boton
            var datos = new FormData();

            var id = $("#idmunicipioedit").val();

            datos.append("EditarCiudad", "ok");
            datos.append("dato1", $("#departamentosEdit").val());
            datos.append("dato2", $("#municipioEdit").val());
            datos.append("id", id);

            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "La ciudad ha sido actualizada",
                            confirmButtonText: "¡Cerrar!",
                            allowOutsideClick: false
                        }).then((result) => {

                            if (result.value) {
                                window.location = 'cg-gestion-humana';
                            }
                        })
                    }
                }
            });
        });

        //ELIMINAR
        $(document).on("click", ".btnBorrar", function () {


            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var id = $(this).attr("idregistro");
            var valor_cambio = $(this).attr("valor-cambio");
            var concepto = $(this).attr("concepto");

            Swal.fire({
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea borrar este registro?",
                confirmButtonText: "SI, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#66ff99",
                allowOutsideClick: false
            }).then((result) => {

                if (result.value) {

                    var datos = new FormData();
                    datos.append("EliminarRegistro", "ok");
                    datos.append("id", id);
                    datos.append("valor", valor_cambio);
                    datos.append("concepto", concepto);


                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El registro ha sido borrado correctamente!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-gestion-humana'; })
                            }
                        }

                    });
                }
            })
        });
    });
}
/*=============================================================
=====================MANTENIMIENTO============================
============================================================?*/
if (window.location.href == `${urlPagina}cg-mantenimiento/` ||
    window.location.href == `${urlPagina}cg-mantenimiento`
) {
    $(document).ready(function () {
        //BOTON NUEVO CONCEPTO EN MANTENIMIENTO============
        $(document).on("click", ".btn-nuevo", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalM").html(concepto);
        });
        //SUBMIT DEL FORMULARIO DE MANTENIMIENTO
        $("#formularioM").submit(function (e) {

            e.preventDefault();//Previene la accion por defecto del boton
            var concepto = $("#titulo_modalM").html();
            var datos = new FormData();

            datos.append("NuevoGH", "ok");
            datos.append("concepto", concepto);
            datos.append("dato", $("#inputGH").val());

            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "El nuevo dato ha sido agregado",
                            confirmButtonText: "¡Cerrar!",
                            allowOutsideClick: false
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'cg-mantenimiento';
                            }
                        })
                    }
                }
            });
        });
        //BOTON VER CONCEPTO EN MANTENIMIENTO============
        $(document).on("click", ".btn-ver", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVerM").html(concepto);
            // Quitar datatable
            $("#ver_concepto").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_ver_concepto").html("");
            //Nombre de la cabecera de la tabla segun el concepto 
            $("#tipo").html(concepto);

            var datos = new FormData();
            datos.append("ajaxVerConcepto", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_concepto").html(response);

                    } else {

                        $("#tbody_ver_concepto").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#ver_concepto`, buttons);
                }
            });
        });
        //BOTON CANCELAR AL AGREGAR===========================
        $('#AgregarEditarM, #VisualizarM').on('hidden.bs.modal', function (e) {
            $(".overlay").each(function () { //Al cancelar se agrega la clase d-none para que no se vea el reload
                $(this).addClass("d-none");
            });
        });
        //BOTON EDITAR CONCEPTO EN MANTENIMIENTO===========
        $(document).on("click", ".btnEditar", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var concepto = $(this).attr("concepto");
            var id = $(this).attr("idregistro");
            var dato = $(this).attr("dato");

            Swal.fire({
                title: `Editar (${concepto})`,
                html:
                    `
                <hr>
                <label for="">${concepto}</label>
                <input class="form-control" id="input-edit" type="text" value="${dato}">`
                ,
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    var dato_edit = $("#input-edit").val();
                    var datos = new FormData();
                    datos.append("ajaxEditarConcepto", "ok");
                    datos.append("concepto", concepto);
                    datos.append("id", id);
                    datos.append("dato", dato_edit);

                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El dato ha sido actualizado!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-mantenimiento'; })
                            }
                        }

                    });
                }
            })
        });
        // funcion para el contador de los info box
        $(".info-box-number").each(function () {
            var $infobox = $(this);
            var concepto = $infobox.attr("concepto");
            var datos = new FormData();

            datos.append("ajaxContarRegistro", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                url: "ajax/conceptos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                dataType: "json", //
                processData: false,
                success: function (response) {
                    $infobox.text(response.contador + " registros");
                }
            });
        });

        //ELIMINAR
        $(document).on("click", ".btnBorrar", function () {


            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var id = $(this).attr("idregistro");
            var valor_cambio = $(this).attr("valor-cambio");
            var concepto = $(this).attr("concepto");

            Swal.fire({
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea borrar este registro?",
                confirmButtonText: "SI, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#66ff99",
                allowOutsideClick: false
            }).then((result) => {

                if (result.value) {

                    var datos = new FormData();
                    datos.append("EliminarRegistro", "ok");
                    datos.append("id", id);
                    datos.append("valor", valor_cambio);
                    datos.append("concepto", concepto);


                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El registro ha sido borrado correctamente!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-mantenimiento'; })
                            }
                        }

                    });
                }
            })
        });
    });
}
/*=============================================================
=====================SEGURIDAD=================================
============================================================?*/
if (window.location.href == `${urlPagina}cg-seguridad/` ||
    window.location.href == `${urlPagina}cg-seguridad`
) {
    $(document).ready(function () {
        //========================BOTON NUEVO CONCEPTO EN SEGURIDAD
        $(document).on("click", ".btn-nuevo", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalGH").html(concepto);

            $(document).on("click", ":submit", function () {

                var datos = new FormData();

                datos.append("NuevoGH", "ok");
                datos.append("concepto", concepto);
                datos.append("dato", $("#inputGH").val());

                $.ajax({
                    url: "ajax/conceptos.ajax.php",
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
                                title: "El nuevo dato ha sido agregado",
                                confirmButtonText: "¡Cerrar!"
                            });
                        } window.location = 'cg-seguridad';
                    }
                });
            });
        });
        //========================BOTON VER CONCEPTO EN SEGURIDAD        
        $(document).on("click", ".btn-ver", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVer").html(concepto);
            // Quitar datatable
            $("#ver_concepto").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_ver_concepto").html("");
            //Nombre de la cabecera de la tabla segun el concepto 
            $("#tipo").html(concepto);

            var datos = new FormData();
            datos.append("ajaxVerConcepto", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_concepto").html(response);

                    } else {

                        $("#tbody_ver_concepto").html('');
                    }

                    dataTable("#ver_concepto");
                }
            });
        });
        //=================BOTON CANCELAR AL AGREGAR==================
        $(document).on("click", ".btn-cancelar", function () {
            $(".overlay").each(function () { //Al cancelar se agrega la clase d-none para que no se vea el reload
                $(this).addClass("d-none");
            });
        });
        //===================BOTON EDITAR CONCEPTO EN SEGURIDAD
        $(document).on("click", ".btnEditar", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var concepto = $(this).attr("concepto");
            var id = $(this).attr("idregistro");
            var dato = $(this).attr("dato");

            Swal.fire({
                title: `Editar (${concepto})`,
                html:
                    `
                <hr>
                <label for="">${concepto}</label>
                <input class="form-control" id="input-edit" type="text" value="${dato}">`
                ,
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    var dato_edit = $("#input-edit").val();
                    var datos = new FormData();
                    datos.append("ajaxEditarConcepto", "ok");
                    datos.append("concepto", concepto);
                    datos.append("id", id);
                    datos.append("dato", dato_edit);

                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El dato ha sido actualizado!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-matenimiento'; })
                            }
                        }

                    });
                }
            })
        });
        // funcion para el contador de los info box
        $(".info-box-number").each(function () {
            var $infobox = $(this);
            var concepto = $infobox.attr("concepto");
            var datos = new FormData();

            datos.append("ajaxContarRegistro", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                url: "ajax/conceptos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                dataType: "json", //
                processData: false,
                success: function (response) {
                    $infobox.text(response.contador + " registros");
                }
            });
        });
    });
}
/*=============================================================
=====================VEHICULAR=================================
============================================================?*/
if (window.location.href == `${urlPagina}cg-vehicular/` ||
    window.location.href == `${urlPagina}cg-vehicular`
) {
    $(document).ready(function () {
        //BOTON NUEVO CONCEPTO EN VEHICULAR
        $(document).on("click", ".btn-nuevo", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalV").html(concepto);
        });
        //SUBMIT DEL FORMULARIO DE VEHICULAR
        $("#formularioV").submit(function (e) {
            e.preventDefault();//Previene la accion por defecto del boton
            var concepto = $("#titulo_modalV").html();
            var datos = new FormData();

            datos.append("NuevoGH", "ok");
            datos.append("concepto", concepto);
            datos.append("dato", $("#inputGH").val());

            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "El nuevo dato ha sido agregado",
                            confirmButtonText: "¡Cerrar!"
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'cg-vehicular';
                            }
                        })
                    }
                }
            });
        });
        //BOTON VER CONCEPTO EN VEHICULAR 
        $(document).on("click", ".btn-ver", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVerV").html(concepto);
            // Quitar datatable
            $("#ver_conceptoV").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_ver_conceptoV").html("");
            //Nombre de la cabecera de la tabla segun el concepto 
            $("#tipoV").html(concepto);

            var datos = new FormData();
            datos.append("ajaxVerConcepto", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_conceptoV").html(response);

                    } else {

                        $("#tbody_ver_conceptoV").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#ver_conceptoV`, buttons);
                }
            });
        });
        //BOTON CANCELAR AL AGREGAR==================
        $('#AgregarEditarV, #AgregarEditarV2, #AgregarEditarV3, #AgregarRuta, #VisualizarV, #VisualizarV1, #VisualizarRutas').on('hidden.bs.modal', function (e) {
            $(".overlay").each(function () { //Al cancelar se agrega la clase d-none para que no se vea el reload
                $(this).addClass("d-none");
            });
        });
        //BOTON EDITAR CONCEPTO EN VEHICULAR
        $(document).on("click", ".btnEditar", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var concepto = $(this).attr("concepto");
            var id = $(this).attr("idregistro");
            var dato = $(this).attr("dato");

            Swal.fire({
                title: `Editar (${concepto})`,
                html:
                    `
                <hr>
                <label for="">${concepto}</label>
                <input class="form-control" id="input-edit" type="text" value="${dato}">`
                ,
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    var dato_edit = $("#input-edit").val();
                    var datos = new FormData();
                    datos.append("ajaxEditarConcepto", "ok");
                    datos.append("concepto", concepto);
                    datos.append("id", id);
                    datos.append("dato", dato_edit);

                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El dato ha sido actualizado!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-vehicular'; })
                            }
                        }

                    });
                }
            })
        });
        // funcion para el contador de los info box
        $(".info-box-number").each(function () {
            var $infobox = $(this);
            var concepto = $infobox.attr("concepto");
            var datos = new FormData();

            datos.append("ajaxContarRegistro", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                url: "ajax/conceptos.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                dataType: "json", //
                processData: false,
                success: function (response) {
                    $infobox.text(response.contador + " registros");
                }
            });
        });
        //BOTON NUEVO DOCUMENTO VEHICULAR
        $(document).on("click", ".btn-nuevo-documento", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalV3").html(concepto);
        });
        //BOTON NUEVA LICENCIA, TIPO IDENTIFICACION
        $(document).on("click", ".btn-nuevo-2", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalV2").html(concepto);
        });
        //SUBMIT DEL FORMULARIO DE VEHICULAR - 2
        $("#formularioV2").submit(function (e) {
            e.preventDefault();//Previene la accion por defecto del boton
            var concepto = $("#titulo_modalV2").html();
            var datos = new FormData();

            datos.append("NuevoVehicular", "ok");
            datos.append("concepto", concepto);
            datos.append("dato1", $("#input_campo_uno").val());
            datos.append("dato2", $("#input_campo_dos").val());

            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "El nuevo dato ha sido agregado",
                            confirmButtonText: "¡Cerrar!"
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'cg-vehicular';
                            }
                        })
                    }
                }
            });
        });
        //SUBMIT DEL FORMULARIO DE VEHICULAR - 3
        $("#formularioV3").submit(function (e) {
            e.preventDefault();//Previene la accion por defecto del boton
            var concepto = $("#titulo_modalV3").html();
            var datos = new FormData();

            datos.append("NuevoVehicular", "ok");
            datos.append("concepto", concepto);
            datos.append("dato1", $("#input_tipo").val());
            datos.append("dato2", $("#input_dias").val());

            var hd = $('#input_dias').val();



            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "El nuevo dato ha sido agregado",
                            confirmButtonText: "¡Cerrar!"
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'cg-vehicular';
                            }
                        })
                    }
                }
            });
        });
        //BOTON VER 2 
        $(document).on("click", ".btn-ver-2", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVerV2").html(concepto);
            // Quitar datatable
            $("#ver_conceptoV2").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_ver_conceptoV2").html("");
            //Nombre de la cabecera de la tabla segun el concepto 
            $("#tipoV1").html(concepto);
            $("#tipoV2").html("Descripción");

            var datos = new FormData();
            datos.append("VerConcepto2", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_conceptoV2").html(response);

                    } else {

                        $("#tbody_ver_conceptoV2").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#ver_conceptoV2`, buttons);
                }
            });
        });
        //BOTON VER DOCUMENTO
        $(document).on("click", ".btn-ver-documento", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVerV2").html(concepto);
            // Quitar datatable
            $("#ver_conceptoV2").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_ver_conceptoV2").html("");
            //Nombre de la cabecera de la tabla segun el concepto 
            $("#tipoV1").html(concepto);
            $("#tipoV2").html("Días (alerta)");

            var datos = new FormData();
            datos.append("VerConcepto2", "ok");
            datos.append("concepto", concepto);
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_conceptoV2").html(response);

                    } else {

                        $("#tbody_ver_conceptoV2").html('');
                    }

                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                    ];
                    var table = dataTableCustom(`#ver_conceptoV2`, buttons);
                }
            });
        });
        //BOTON EDITAR 2
        $(document).on("click", ".btnEditarV2", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var concepto = $(this).attr("concepto");
            var id = $(this).attr("idregistro");
            var dato1 = $(this).attr("dato1");
            var dato2 = $(this).attr("dato2");


            Swal.fire({
                title: `Editar (${concepto})`,
                html:
                    `
                <hr>
                <label for="">${concepto}</label>
                <input class="form-control" id="input-edit1" type="text" value="${dato1}">
                <label for="">Descripción</label>
                <input class="form-control" id="input-edit2" type="text" value="${dato2}">`
                ,
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    var dato_edit1 = $("#input-edit1").val();
                    var dato_edit2 = $("#input-edit2").val();
                    var datos = new FormData();
                    datos.append("EditarVehicular", "ok");
                    datos.append("concepto", concepto);
                    datos.append("id", id);
                    datos.append("dato1", dato_edit1);
                    datos.append("dato2", dato_edit2);

                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El dato ha sido actualizado!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-vehicular'; })
                            }
                        }

                    });
                }
            })
        });
        //BOTON NUEVA RUTA
        $(document).on("click", ".btn-nueva-ruta", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modal_ruta").html(concepto);
        });
        //SUBMIT DEL FORMULARIO DE RUTAS
        $("#formularioRuta").submit(function (e) {
            e.preventDefault();//Previene la accion por defecto del boton
            var datos = new FormData();

            datos.append("AgregarRuta", "ok");
            datos.append("dato1", $("#id_ruta").val());
            datos.append("dato2", $("#origen").val());
            datos.append("dato3", $("#id_destino").val());


            $.ajax({
                url: "ajax/conceptos.ajax.php",
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
                            title: "¡Nueva ruta agregada!",
                            confirmButtonText: "¡Cerrar!"
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'cg-vehicular';
                            }
                        })
                    }
                }
            });
        });
        //BOTON VER RUTAS
        $(document).on("click", ".btn-ver-ruta", function () {

            var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_ver_rutas").html(concepto);
            // Quitar datatable
            $("#ver_ruta").dataTable().fnDestroy();
            // Borrar datos
            $("#tbody_ver_ruta").html("");

            var datos = new FormData();
            datos.append("VerRutas", "ok");
            $.ajax({
                type: "POST",
                url: "ajax/conceptos.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                //dataType: "json",
                success: function (response) {

                    if (response != '' || response != null) {

                        $("#tbody_ver_ruta").html(response);

                    } else {

                        $("#tbody_ver_ruta").html('');
                    }
                    var buttons = [
                        { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
                        /* 'copy', 'csv', 'excel', 'pdf', 'print' */
                    ];
                    dataTableCustom("#ver_ruta", buttons);
                }
            });
        });
        //BOTON EDITAR RUTA
        $(document).on("click", ".btnEditarRuta", function () {

            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var id = $(this).attr("idregistro");
            var dato1 = $(this).attr("dato1");
            var dato2 = $(this).attr("dato2");
            var dato3 = $(this).attr("dato3");

            Swal.fire({
                title: `Editar (RUTA)`,
                html:
                    `
                <hr>
                <label>Origen</label>
                <input class="form-control" id="input-edit1" type="text" value="${dato1}" readonly>
                <label>Destino</label>
                <input class="form-control" id="input-edit2" type="text" value="${dato2}" readonly>
                <label>Ruta</label>
                <input class="form-control" id="input-edit3" type="text" value="${dato3}"  >`
                ,
                showCancelButton: true,
                confirmButtonColor: '#5cb85c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Continuar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    var dato_edit1 = $("#input-edit1").val();
                    var dato_edit2 = $("#input-edit2").val();
                    var dato_edit3 = $("#input-edit3").val();

                    var datos = new FormData();
                    datos.append("EditarRuta", "ok");
                    datos.append("id", id);
                    datos.append("dato3", dato_edit3);

                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡La ruta ha sido actualizada!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-vehicular'; })
                            }
                        }

                    });
                }
            })
        });

        //ELIMINAR
        $(document).on("click", ".btnBorrar", function () {


            //Se guarda el ID, el CONCEPTO y el DATO que se va a editar
            var id = $(this).attr("idregistro");
            var valor_cambio = $(this).attr("valor-cambio");
            var concepto = $(this).attr("concepto");

            Swal.fire({
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                title: "¿Seguro que de sea borrar este registro?",
                confirmButtonText: "SI, borrar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#ff0000",
                cancelButtonColor: "#66ff99",
                allowOutsideClick: false
            }).then((result) => {

                if (result.value) {

                    var datos = new FormData();
                    datos.append("EliminarRegistro", "ok");
                    datos.append("id", id);
                    datos.append("valor", valor_cambio);
                    datos.append("concepto", concepto);


                    $.ajax({
                        type: "POST",
                        url: "ajax/conceptos.ajax.php",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //dataType: "json",
                        success: function (response) {
                            console.log(response)
                            if (response == "ok") {
                                Swal.fire({
                                    icon: 'success',
                                    showConfirmButton: true,
                                    title: "¡El registro ha sido borrado correctamente!",
                                    confirmButtonText: "¡Cerrar!",
                                    allowOutsideClick: false
                                }).then((result) => { window.location = 'cg-vehicular'; })
                            }
                        }

                    });
                }
            })
        });





    });
}