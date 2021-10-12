

if (window.location.href == `${urlPagina}usuarios/` ||
    window.location.href == `${urlPagina}usuarios`
) {
    $(document).ready(function () {

        /* ===================================================
            CARGAR DATOS DEL USUARIO PARA EDITARLO
        ===================================================*/
        $(document).on("click", ".btnEditarUsuario", function () {
            // Mostrar boton restablecer password
            $("#restablecerPswd").removeClass("d-none");

            // Reset valores del formulario
            $(".input-usuario").val("");
            $(".previsualizar").attr("src", `${urlPagina}views/img/fotosUsuarios/default/anonymous.png`);

            // Capturar la cédula
            var cedula = $(this).attr("cedula");

            // AJAX para cargar los datos del usuario
            var datos = new FormData();
            datos.append("DatosUsuario", "ok");
            datos.append("value", cedula);
            $.ajax({
                type: "POST",
                url: "ajax/usuarios.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#Identificacion").val(response.Cedula);
                    $("#Identificacion").attr("readonly", "readonly");

                    $("#Nombre").val(response.Nombre);
                    $("#Email").val(response.Email);
                    $("#Perfil").val(response.idPerfil);
                    $("#Sucursal").val(response.idSucursal);

                    if (response.foto != "") {
                        $(".previsualizar").attr("src", response.foto);

                    }
                    else {
                        $(".previsualizar").attr("src", `${urlPagina}views/img/fotosUsuarios/default/anonymous.png`);
                    }

                }
            });
        });

        /* ===================================================
          BOTON NUEVO USUARIO PARA BORRAR DATOS DEL FORMULARIO
        ===================================================*/
        $(document).on("click", ".btn-agregarUsuario", function () {
            // Reset valores del formulario
            $(".input-usuario").val("");
            $(".previsualizar").attr("src", `${urlPagina}views/img/fotosUsuarios/default/anonymous.png`);
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            $("#Identificacion").removeAttr("readonly");
            // Ocultar boton para restablece password
            $("#restablecerPswd").addClass("d-none");
        });

        /* ===================== 
            ACTIVAR USUARIO 
        ========================= */
        $(document).on("click", ".btnActivar", function () {
            var idUsuario = $(this).attr("idUsuario");
            var estadoUsuario = $(this).attr("estadoUsuario");

            console.log("idUsuario => " + idUsuario);
            console.log("estadoUsuario => " + estadoUsuario);

            var datos = new FormData();
            datos.append("idUsuario", idUsuario);
            datos.append("activarUsuario", estadoUsuario);

            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);

                    if (response == "ok") {
                        Swal.fire({
                            icon: 'success',
                            showConfirmButton: true,
                            title: "El usuario ha sido actualizado",
                            confirmButtonText: "¡Cerrar!"
                        });
                    }
                }
            });

            if (estadoUsuario == 0) {
                $(this).removeClass("btn-success");
                $(this).addClass("btn-danger");
                $(this).html("Inactivo");
                $(this).attr("estadoUsuario", 1);
            } else {
                $(this).addClass("btn-success");
                $(this).removeClass("btn-danger");
                $(this).html("Activo");
                $(this).attr("estadoUsuario", 0);
            }
        });

        /* ===================================================
            RESTABLECER CONTRASEÑA
        ===================================================*/
        $(document).on("click", "#restablecerPswd", function () {
            datos = new FormData();
            datos.append('RestablecerPswd', "ok");
            datos.append('value', $("#Identificacion").val());
            $.ajax({
                type: 'post',
                url: 'ajax/usuarios.ajax.php',
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        Swal.fire({
                            icon: 'success',
                            title: '¡La contraseña se ha restablecido correctamente!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                        });
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: '¡Ha ocurrido un error, por favor intente de nuevo más tarde!',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                        });
                    }
                }
            });
        });
        
    });
}

if (window.location.href == `${urlPagina}roles-usuarios/` ||
    window.location.href == `${urlPagina}roles-usuarios`){
    
    $(document).on("click",".btn-nuevorol", function(){
        console.log("click en nuevo rol");
        $("#datosrol_form").trigger('reset');
    });


    /* ===================================================
            EDITAR ROL
        ===================================================*/
    
    $(document).on("click", ".btn-editarroles", function(){

        var idPerfil = $(this).attr("idPerfil");
        $("#idPerfil").val(idPerfil);

        var datos = new FormData();
        datos.append("DatosPerfil", "ok");
        datos.append("idPerfil", idPerfil);

        $.ajax({
            type: "POST",
            url: "ajax/usuarios.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response!=""){
                    
                    $("#Perfil").val(response.perfil);
                    $("#Descripcion").val(response.descripcion);
                    $("#activo").val(response.activo);


                }
            }
        });
    });


    /* ===================================================
        CAMBIAR ACTIVO/INACTIVO
       ===================================================*/

       $(document).on("click", ".btnActivar", function(){
        

        var idPerfil = $(this).attr("idPerfil");
        var activo = $(this).attr("activo");

        console.log(idPerfil);

        var datos = new FormData();
        datos.append("ActivarPerfil", "ok");
        datos.append("idPerfil", idPerfil);
        datos.append("activo",activo);

        $.ajax({
            type: "POST",
            url: "ajax/usuarios.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response=="ok"){
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Estado actualizado correctamente',						
                        showConfirmButton: true,
                        confirmButtonText: 'Cerrar',
                                    
                        }).then((result)=>{

                            if(result.value){
                                window.location = 'roles-usuarios';
                            }

                        })
                    
                    
                }else{
                    
                    Swal.fire({
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#5cb85c',
                        text: 'Por favor digite correctamente el usuario y contraseña'
                    });
                }
            }
        });

    });


    /* ===================================================
                BORRADO LOGICO
    ===================================================*/

    $(document).on("click",".btn-eliminarroles", function(){
        
        var idPerfil = $(this).attr("idPerfil");
        var datos = new FormData();
        datos.append("Borrado","ok");
        datos.append("idPerfil", idPerfil);
        

        $.ajax({
            type: "POST",
            url: "ajax/usuarios.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if(response == "ok"){
                    
                    Swal.fire({
                        title: '¿Está seguro de eliminar este rol',
                        text: "No se podrán recuperar los datos",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Si,borrar'
                      }).then((result) => {
                          console.log(result);
                        if (result.value == true){
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Rol eliminado correctamente',						
                                    showConfirmButton: true,
                                    confirmButtonText: 'Cerrar',
                                                
                                    }).then((result)=>{
            
                                        if(result.value){
                                            window.location = 'roles-usuarios';
                                        }
            
                                    })
                            }
                        
                      })

                }else{

                    Swal.fire({
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonColor: '#5cb85c',
                        text: 'El perfil no se ha podido eliminar'
                    });

                }


            }
        });

    });

    /* ===================================================
                PERMISOS ROL
    ===================================================*/


    $(document).on("click",".btn-permisoroles", function(){
        

        var idPerfil = $(this).attr("idPerfil");
        $("#idpermisos").val(idPerfil);

        // Reset Formulario
        $("#permisos_form").trigger('reset');

        var datos1 = new FormData();
        datos1.append("Datosrol","ok");
        datos1.append("idPerfil",idPerfil);

       

        $.ajax({
            type: "POST",
            url: "ajax/usuarios.ajax.php",
            data: datos1,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response){
                
                response.forEach(element => {
                    if(element.Leer == 1)$(`input[name='Ver[]'][value='${element.idOpcion}']`).iCheck('check');
                    if(element.Crear == 1)$(`input[name='Crear[]'][value='${element.idOpcion}']`).iCheck('check');
                    if(element.Actualizar == 1)$(`input[name='Actualizar[]'][value='${element.idOpcion}']`).iCheck('check');
                    if(element.Borrar)$(`input[name='Eliminar[]'][value='${element.idOpcion}']`).iCheck('check');
                    
                    
                });
            }
        });


        



        
    });





}