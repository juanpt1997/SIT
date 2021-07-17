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
            $("#label_concepto").html(concepto);     
        }); 

        // $(document).on("click", ":submit", function (e) {
            $("#formularioGH").submit(function (e) {

            e.preventDefault();//Previene la accion por defecto del boton
            var concepto = $("#titulo_modalGH").html();
            var datos = new FormData();
            
            datos.append("NuevoGH", "ok");
            datos.append("concepto",concepto);
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

        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-gestion-humana';
        });

//===================BOTON VER CONCEPTO EN GESTION HUMANA
$(document).on("click", ".btn-ver", function () {

    var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Agregamos el titulo a cada modal de cada concepto
            $("#titulo_modalVer").html("Visualizar ("+concepto+")");
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

                    if(response != '' || response != null){

                     $("#tbody_ver_concepto").html(response);

                 }else{

                     $("#tbody_ver_concepto").html('');
                 }

                 dataTable("#ver_concepto");     
             }
         });
        });

//=================BOTON CANCELAR AL AGREGAR==================
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-gestion-humana';
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
        $(".info-box-number").each(function() {
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
=====================MANTENIMIENTO============================
============================================================?*/
if (window.location.href == `${urlPagina}cg-matenimiento/` ||
    window.location.href == `${urlPagina}cg-matenimiento`
    ) {

    $(document).ready(function () {

//====================BOTON NUEVO CONCEPTO EN MANTENIMIENTO
$(document).on("click", ".btn-nuevo", function () {

    var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalGH").html(concepto);

            $(document).on("click", ":submit", function () {

                var datos = new FormData();
                
                datos.append("NuevoGH", "ok");
                datos.append("concepto",concepto);
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
                        } window.location = 'cg-matenimiento';
                    }
                });  
            }); 
        });

        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-matenimiento';
        });

//====================BOTON VER CONCEPTO EN MANTENIMIENTO
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

                    if(response != '' || response != null){

                       $("#tbody_ver_concepto").html(response);

                   }else{

                       $("#tbody_ver_concepto").html('');
                   }

                   dataTable("#ver_concepto");     
               }
           });
        });
        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-matenimiento';
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
                datos.append("concepto",concepto);
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
        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-seguridad';
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

                    if(response != '' || response != null){

                       $("#tbody_ver_concepto").html(response);

                   }else{

                       $("#tbody_ver_concepto").html('');
                   }

                   dataTable("#ver_concepto");     
               }
           });
        });
        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-seguridad';
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

//========================BOTON NUEVO CONCEPTO EN VEHICULAR
$(document).on("click", ".btn-nuevo", function () {

    var concepto = $(this).attr("concepto");
            //Removemos d-none del info-box de cada concepto
            $(`.overlay[concepto='${concepto}']`).removeClass("d-none");
            //Envio de concepto al titulo del modal
            $("#titulo_modalGH").html(concepto);

            $(document).on("click", ":submit", function () {

                var datos = new FormData();
                
                datos.append("NuevoGH", "ok");
                datos.append("concepto",concepto);
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
                        } window.location = 'cg-vehicular';
                    }
                });  
            }); 
        });
        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-vehicular';
        });

//========================BOTON VER CONCEPTO EN VEHICULAR 
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

                    if(response != '' || response != null){

                       $("#tbody_ver_concepto").html(response);

                   }else{

                       $("#tbody_ver_concepto").html('');
                   }

                   dataTable("#ver_concepto");     
               }
           });
        });
        // Cuando se da click a cancelar se refresca la pagina
        $(document).on("click", ".btn-cancelar", function () {
            window.location = 'cg-vehicular';
        });
    });
}