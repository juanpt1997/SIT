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
    //EVENTO QUE MUESTRA LOS CONDUCTORES SEGUN LA PLACA DEL VEHICULO
    $(document).on("change", "#placa_invent", function () {
      $(".documentos").val("").removeClass("bg-danger bg-success");
      let idvehiculo = $(this).val();

      if (idvehiculo == "null") {
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
            var bg =
              element.fechafin >= moment().format("YYYY-MM-DD")
                ? "bg-success"
                : "bg-danger";
            $(`#documento_${element.idtipodocumento}`).addClass(bg);
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
            let htmlSelect = `<option value="" selected>-Seleccione un conductor</option>`;
            if (response != "") {
              response.forEach((element) => {
                htmlSelect += `<option class="inv-conductor" value="${element.idconductor}">${element.Documento} - ${element.conductor}</option>`;
              });
            }
            $(".conductores").html(htmlSelect);
            // Swal.fire({
            //   icon: "success",
            //   text: "Seleccione un conductor",
            //   showConfirmButton: true,
            //   confirmButtonText: "Cerrar",
            //   closeOnConfirm: false,
            // });

            // Accionar el observador
            $("#observador_conductoresInventario").trigger("change");
          } else {
            Swal.fire({
              icon: "warning",
              title: "No se ha encontrado conductor",
              text: "Seleccione otra placa",
              showConfirmButton: true,
              confirmButtonText: "Cerrar",
              closeOnConfirm: false,
            });
            //RESET DE VALOR
            $(".documentos").val("").removeClass("bg-danger bg-success");
            $("#conductor_invent").empty();
            $(".inventario").val("");
            $(".inventario").prop("checked", false);
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

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    ELEMENTO OBSERVADOR QUE PONE EL CONDUCTOR CUANDO SE ACTUALIZA EL SELECT (Permite ver el valor que tiene el slect conductores al editar)
    ==========================================================================*/
    $(document).on("change", "#observador_conductoresInventario", function () {
      let idconductor = $(this).attr("idconductor");
      console.log(idconductor);
      setTimeout(() => {
        $("#conductor_invent").val(idconductor).trigger("change");
      }, 1000);
    });

    //BOTON EDITAR UN ELEMENTO DEL INVENTARIO
    $(".btn-editarInventario").on("click", function () {
      //INSTRUCCION PARA EXPANDIR EL COLLAPSE DEL DATA WIDGET DEL CARD INVENTARIO
      $("#card-inventario").CardWidget("expand");
      $(window).scrollTop(0);

      let id = $(this).attr("id_inventario");
      let datos = new FormData();
      datos.append("DatosInventario", "ok");
      datos.append("id", id);
      $.ajax({
        type: "POST",
        url: "ajax/mantenimiento.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $("#placa_invent").val(response.idvehiculo).trigger("change");
          $("#observador_conductoresInventario").attr("idconductor", response.idconductor);
          $("#kilo_invent").val(response.kilometraje);
          $("#fecha_invent").val(response.fecha_inventario);

          var keys = Object.keys(response);
          var values = Object.values(response);

          // Recorremos ambos arreglos
          for (let index = 0; index < keys.length; index++) {
            // NO tomamos las llaves numericas
            if (isNaN(keys[index])) {
                if (keys[index] != "idvehiculo" && keys[index] != "tipo_vel" && keys[index] != "numinter_invent" && keys[index] != "marca_invent" && keys[index] != "modelo_invent" && keys[index] != "idconductor" && keys[index] != "categoria_invent" && keys[index] != "vencimineto_inventario") {
                    // Si el input es un check - radio
                    $(`input[name='${keys[index]}'][value='${values[index]}']`).iCheck('check');

                    // Si el input es distinto a un radio button
                    if ($(`input[name='${keys[index]}']`).attr("type") != "radio") {
                        $(`input[name='${keys[index]}']`).val(values[index]);
                    }
                }
            }
        }



        },
      });
    });

    //BOTON CANCELAR LA SELECCION DE INVENTARIO
    $(".cancelar").click(function (e) {
      e.preventDefault();
      $(".documentos").val("").removeClass("bg-danger bg-success");
      // $(".conductores").val("");
      // $(".inventario").val("");
      // $(".inventario").prop("checked", false);
      $("#formulario_inventario").trigger("reset");//reset formulario
      $(".select2-single").trigger("change");
    });

    //Funcion que carga las fotos de un vehiculo
    let cargarFotosVehiculo = (response) => {
      let htmljumbo = ``;

      for (let index = 0; index < response.length; index++) {
        htmljumbo += `<div class="jumbotron jumbotron-fluid">
                        <div class="container insertar_fotos">
                          <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                        </div>
                      </div>
                      <hr class="my-5">`;
      }

      $("#col_fotos_inventario").html(htmljumbo);
    };
  }
});
