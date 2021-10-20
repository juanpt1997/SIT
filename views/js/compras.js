$(document).ready(function () {
  /* ===================================================
        * PROVEEDORES
    ===================================================*/
  if (
    window.location.href == `${urlPagina}c-proveedores/` ||
    window.location.href == `${urlPagina}c-proveedores`
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
        url: "ajax/compras.ajax.php",
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
            url: "ajax/compras.ajax.php",
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
                  window.location = "c-proveedores";
                });
              }
            },
          });
        }
      });
    });
  }

  /* ===================================================
      * ORDEN DE COMPRA
  ===================================================*/
  if (
    window.location.href == `${urlPagina}c-orden-compra/` ||
    window.location.href == `${urlPagina}c-orden-compra`
  ){

    $(".btn_print_orden").click(function (e) { 
      window.print();

    /* window.addEventListener("load", window.print); */


    });






  } 












});
