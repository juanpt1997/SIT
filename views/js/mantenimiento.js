$(document).ready(function () {
  /* ===================================================
        * PROVEEDORES
    ===================================================*/
  if (
    window.location.href == `${urlPagina}m-proveedores/` ||
    window.location.href == `${urlPagina}m-proveedores`
  ) {
    $(".btn_nuevo").on("click", function () {
      $("#titulo_modal_proveedores").html("Agregar proveedor");
      $(".input-proveedores").val("");
    });

    $(".btn_editar").on("click", function () {
      var id = $(this).attr("id_prov");
      $("#id_proveedor").val(id);

      var documento = $(this).attr("nit_editar");
      var datos = new FormData();
      datos.append("DatosProveedor", "ok");
      datos.append("documento", documento);
      $.ajax({
        type: "POST",
        url: "ajax/mantenimiento.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $("#titulo_modal_proveedores").html(
            "Actualizando datos de:  " + response.razon_social
          );

          $("#cc_proveedor").val(response.documento);
          $("#nom_razonsocial").val(response.razon_social);
          $("#direccion_proveedor").val(response.direccion);
          $("#telef_proveedor").val(response.telefono);
          $("#contacto_proveedor").val(response.nombre_contacto);
          $("#correo_proveedor").val(response.correo);
          $("#ciudad_proveedor").val(response.idciudad);
          $(".select2-single").trigger("change");
        },
      });
    });

    $(".btn_eliminar").on("click", function () {
      var id = $(this).attr("id");

      Swal.fire({
        icon: "warning",
        showConfirmButton: true,
        showCancelButton: true,
        title: "¿Seguro que de sea borrar este registro?",
        confirmButtonText: "SI, borrar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#ff0000",
        cancelButtonColor: "#0080ff",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          var datos = new FormData();
          datos.append("EliminarProveedor", "ok");
          datos.append("id", id);

          $.ajax({
            type: "POST",
            url: "ajax/mantenimiento.ajax.php",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            //dataType: "json",
            success: function (response) {
              if (response == "ok") {
                Swal.fire({
                  icon: "success",
                  showConfirmButton: true,
                  title: "¡El registro ha sido borrado correctamente!",
                  confirmButtonText: "¡Cerrar!",
                  allowOutsideClick: false,
                }).then((result) => {
                  window.location = "m-proveedores";
                });
              }
            },
          });
        }
      });
    });
  }

  /* ===================================================
    * INVENTARIO
    ===================================================*/
  if (
    window.location.href == `${urlPagina}m-inventario/` ||
    window.location.href == `${urlPagina}m-inventario`
  ) {


    //EVENTO QUE MUESTRA LOS CONDCUTORES SEGUN LA PLACA DEL VEHICULO
    $(document).on("change", "#placa_invent", function () {
      let idvehiculo = $(this).val();

      if(idvehiculo == "null")
      {
        $(".documentos").val("");
      }

      // Datos del vehiculo
      var datos = new FormData();
      datos.append("DatosVehiculo", "ok");
      datos.append("item", "idvehiculo");
      datos.append("valor", idvehiculo);
      $.ajax({
        type: "post",
        url: `${urlPagina}ajax/vehicular.ajax.php`,
        data: datos,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function (Vehiculo) {
          $("#tipo_vel").val(Vehiculo.datosVehiculo.idtipovehiculo);
          $("#numinter_invent").val(Vehiculo.datosVehiculo.numinterno);
          $("#marca_invent").val(Vehiculo.datosVehiculo.idmarca);
          $("#modelo_invent").val(Vehiculo.datosVehiculo.modelo);
          //Funcion para cargar las fotos del vehiculo segun ese id
          cargarFotosVehiculo(Vehiculo.fotosVehiculo);
        },
      });

      //DOCUMENTOS DEL VEHICULO
      var datos = new FormData();
      datos.append("DocumentosxVehiculo", "ok");
      datos.append("idvehiculo", idvehiculo);
      $.ajax({
        type: "post",
        url: `${urlPagina}ajax/vehicular.ajax.php`,
        data: datos,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          response.forEach((element) => {
            // var bg =
            //   element.fechafin >= moment().format("YYYY-MM-DD")
            //     ? "bg-success"
            //     : "bg-danger";              
              // Asigno valor fecha
              $(`#documento_${element.idtipodocumento}`).val(element.fechafin);
          });
        },
      });

      // lISTA CONDUCTORES
      var datos = new FormData();
      datos.append("ListaConductores", "ok");
      datos.append("idvehiculo", idvehiculo);
      $.ajax({
        type: "post",
        url: `${urlPagina}ajax/fuec.ajax.php`,
        data: datos,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response != "") {
            console.log(response);

            let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
            if (response != "") {
              response.forEach((element) => {
                htmlSelect += `<option class="inv-conductor" value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
              });
            }
            $(".conductores").html(htmlSelect);
            Swal.fire({
              icon: "success",
              text: "Seleccione un conductor",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            });
          } else {
            Swal.fire({
              icon: "warning",
              text: "No se ha encontrado conductor con esa placa",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            });
          }
        },
      });
    });

    //EVENTO QUE MUESTRA EL TIPO DE LICENCIA SEGUN EL CONDUCTOR 
    $(document).on("change", "#conductor_invent", function () {
      let idconductor = $(this).val();

      var datos = new FormData();
      datos.append("LicenciasxVehiculo", "ok");
      datos.append("idconductor", idconductor);
      $.ajax({
        type: "post",
        url: `${urlPagina}ajax/mantenimiento.ajax.php`,
        data: datos,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response != "") {
            $("#categoria_invent").val(response.categoria);
            $("#vencimineto_inventario").val(response.fecha_vencimiento);
          }
        },
      });
    });

    //Funcion que carga las fotos de un vehiculo
    let cargarFotosVehiculo = (response) => {
      let htmljumbo = ``;

      for (let index = 0; index < response.length; index++) {
        console.log(response[index].ruta_foto);

        // htmljumbo += `<img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">`
        htmljumbo += `<div class="jumbotron jumbotron-fluid">
                        <div class="container insertar_fotos">
                          <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                        </div>
                      </div>
                      <hr class="my-5">`;
      }

      $("#col_fotos_inventario").html(htmljumbo);
    };

    $(".cancelar").click(function (e) { 
      e.preventDefault();
      $(".documentos").val("");
      $(".conductores").val("");
      $(".inventario").val("");      
      $('input[type=checkbox]').prop('checked',false);
    });
  }
});
