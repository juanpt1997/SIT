if (window.location.href == `${urlPagina}v-propietarios/` ||
    window.location.href == `${urlPagina}v-propietarios`
){
	$(document).ready(function () {

		//CARGAR DATOS DEL PROPIETARIOS PARA EDITARLOS
		$(document).on("click", ".btnEditarProp", function () {


			var cedula = $(this).attr("cedula");
            console.log(cedula);

			var datos = new FormData();
            datos.append("DatosPropietarios", "ok");
            datos.append("value", cedula);
            $.ajax({
                type: "POST",
                url: "ajax/vehicular.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#documento").val(response.documento);
                    $("#documento").attr("readonly", "readonly");

                    $("#tdocumento").val(response.tipodoc);
                    $("#nombre").val(response.nombre);
                    $("#telpro").val(response.telef);
                    $("#dirpro").val(response.direccion);
                    $("#emailp").val(response.email);
                    $("#ciudadpro").val(response.idciudad);
                    $("#deptopro").val(response.deptopro);

                    $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT 
                }
            });
		});
        $(document).on("click", ".btn-agregarPropietario", function () {
            // Reset valores del formulario
            $(".input-propietario").val("");
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            $("#documento").removeAttr("readonly");
        });


	});
}

if (window.location.href == `${urlPagina}v-convenios/` ||
    window.location.href == `${urlPagina}v-convenios`
){

    $(document).ready(function () {

        //CARGAR DATOS DEL PROPIETARIOS PARA EDITARLOS
        $(document).on("click", ".btnEditarConv", function () {


            var nit = $(this).attr("nit");
            console.log(nit);

            var datos = new FormData();
            datos.append("DatosConvenios", "ok");
            datos.append("value", nit);
            $.ajax({
                type: "POST",
                url: "ajax/vehicular.ajax.php",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {

                    $("#nit").val(response.nit);
                    $("#nit").attr("readonly", "readonly");

                    $("#nombre").val(response.nombre);
                    $("#dirco").val(response.direccion);
                    $("#telco").val(response.telefono1);
                    $("#telco2").val(response.telefono2);
                }
            });
        });
        $(document).on("click", ".btn-agregarConvenio", function () {
            // Reset valores del formulario
            $(".input-convenio").val("");
            // Remover atributo readonly del formulario puesto que va a agregar uno nuevo
            $("#nit").removeAttr("readonly");
        });
    });
}
