$(document).ready(function () {
  /* ===================================================
    * INVENTARIO
    ===================================================*/
  if (
    window.location.href == `${urlPagina}m-inventario/` ||
    window.location.href == `${urlPagina}m-inventario`
  ) {
    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    CONDUCTORES SEGUN LA PLACA DEL VEHICULO
    ==========================================================================*/
    $(document).on("change", "#placa_invent", function () {
      $(".documentos").val("").removeClass("bg-danger bg-success");
      let idvehiculo = $(this).val();

      if (idvehiculo == "null") {
        $(".documentos").val("");
      }

      AjaxTablaEvidencias(idvehiculo);

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
          //CAMBIAR INVENTARIO SEGUN EL TIPO DE VEHICULO
          inventario_tipo_vel(Vehiculo.datosVehiculo.tipovehiculo);
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

            // Accionar el observador
            $("#observador_conductoresInventario").trigger("change");
          } else {
            Swal.fire({
              icon: "warning",
              title: "No se ha encontrado conductor",
              text: "Seleccione otra placa",
              showConfirmButton: false,
              timer: 1600,
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

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    LICENCIA DEL CONDUCTOR SELECCIONADO
    ==========================================================================*/
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
    ELEMENTO OBSERVADOR QUE PONE EL CONDUCTOR CUANDO SE ACTUALIZA EL SELECT 
    ==========================================================================*/
    $(document).on("change", "#observador_conductoresInventario", function () {
      let idconductor = $(this).attr("idconductor");
      setTimeout(() => {
        $("#conductor_invent").val(idconductor).trigger("change");
      }, 1000);
    });

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    EDITAR INVENTARIO
    ==========================================================================*/
    $(".btn-editarInventario").on("click", function () {
      //Capturamos el id del inventario del boton
      let id = $(this).attr("id_inventario");
      //Le pasamos el ID al input escondido para validar AGREGAR/EDITAR
      $("#inventario_id").val(id);
      //INSTRUCCION PARA EXPANDIR EL COLLAPSE DEL DATA WIDGET DEL CARD INVENTARIO
      $("#card-inventario").CardWidget("expand");
      //llevar el
      $(window).scrollTop(0);
      //AJAX que trae los datos del inventario seleccionado
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
          $("#kilo_invent").val(response.kilometraje);
          $("#fecha_invent").val(response.fecha_inventario);
          $("#observador_conductoresInventario").attr(
            "idconductor",
            response.idconductor
          );
          $("#numero_luces").val(response.numero_luces_internas);
          $("#numeroparlantes").val(response.num_parlantes);
          $("#numsalimarti").val(response.Nsalidas_martillos);
          //$("#inventario_tipo_vel").val(response.tipo_vel_inven).trigger("change");

          var keys = Object.keys(response);
          var values = Object.values(response);

          // Recorremos ambos arreglos
          for (let index = 0; index < keys.length; index++) {
            // NO tomamos las llaves numericas
            if (isNaN(keys[index])) {
              if (
                keys[index] != "idvehiculo" &&
                keys[index] != "tipo_vel" &&
                keys[index] != "numinter_invent" &&
                keys[index] != "marca_invent" &&
                keys[index] != "modelo_invent" &&
                keys[index] != "idconductor" &&
                keys[index] != "categoria_invent" &&
                keys[index] != "vencimineto_inventario"
              ) {
                // Si el input es un check - radio
                $(
                  `input[name='${keys[index]}'][value='${values[index]}']`
                ).iCheck("check");
              }
            }
          }
          AjaxTablaEvidencias(response.idvehiculo);
        },
      });
    });

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    CANCELAR AGREGAR/EDITAR
    ==========================================================================*/
    $(".cancelar").click(function (e) {
      e.preventDefault();
      //$(".documentos").val("").removeClass("bg-danger bg-success");
      //$("#formulario_inventario")[0].reset(); //reset formulario
      //$("#formulario_inventario").trigger("reset"); //reset formulario
      //$("#conductor_invent").empty();
      //$(".select2-single").trigger("change");
      //$("#placa_invent").val("");
      //$(".inventario").val("");
      //$('input:checkbox').removeAttr('checked');
    });

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    FUNCION PARA LISTAR LAS IMAGENES DE EVIDENCIA
    ==========================================================================*/
    const AjaxTablaEvidencias = (idvehiculo) => {
      // Quitar datatable
      $(`#tabla_fotos`).dataTable().fnDestroy();
      // Borrar datos
      $(`#tbody_tabla_fotos`).html("");

      let datos = new FormData();
      datos.append(`FotosVehiculos`, "ok");
      datos.append("idvehiculo", idvehiculo);
      $.ajax({
        type: "POST",
        url: `${urlPagina}ajax/mantenimiento.ajax.php`,
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        // dataType: "json",
        success: function (response) {
          if (response != "" || response != null) {
            $(`#tbody_tabla_fotos`).html(response);
          } else {
            $(`#tbody_tabla_fotos`).html("");
          }
        },
      });
    };

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    FUNCION PARA CARGAR LAS FOTOS DE LOS VEHICULOS EN COMPUTADOR Y CELULAR
    ==========================================================================*/
    let cargarFotosVehiculo = (response) => {
      let htmljumbo = ``;
      let htmlcarouselindicators = ``;
      let htmlcarouselinner = ``;

      for (let index = 0; index < response.length; index++) {
        htmljumbo += `<div class="jumbotron jumbotron-fluid">
                        <div class="container insertar_fotos">
                          <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                        </div>
                      </div>
                      <hr class="my-5">`;

        let activo = index == 0 ? `active` : ``;

        htmlcarouselindicators += `<li data-target="#col_fotos_inventario" data-slide-to="${index}" class="${activo}"></li>`;
        htmlcarouselinner += `<div class="carousel-item ${activo}">
                                            <div class="btn-group my-1" role="group" aria-label="Basic example">
                                                <a class="btn btn-info" href="${response[index].ruta_foto}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                            </div>
                                            <img src="${response[index].ruta_foto}" class="d-block w-100" alt="...">
                              </div>`;
      }

      $("#col_fotos_inventario1").html(htmljumbo);
      $("#col_fotos_inventario").find(".carousel-indicators").html(htmlcarouselindicators);
      $("#col_fotos_inventario").find(".carousel-inner").html(htmlcarouselinner);
    };

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    FUNCION PARA CAMBIAR EL INVENTARIO SEGUN EL TIPO DE VEHICULO
    ==========================================================================*/
    let inventario_tipo_vel = (response) => {
      if (
        response == "Camioneta" ||
        response == "Camioneta Doble Cabina" ||
        response == "Microbus"
      ) {
        $(".input-camioneta").addClass("d-none");
        $(".camioneta").removeAttr("required");
        $(".camioneta").val(0);
      } else {
        $(".input-camioneta").removeClass("d-none");
        $(".camioneta").prop("required", true);
      }
    };

    /*==========================================================================                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
    GUARDAR IMAGENES DE EVIDENCIA
    ==========================================================================*/
    $(document).on("click", ".btn_evidencias_inventario", function () {
      let idvehiculo = $("#placa_invent").val();

      if (idvehiculo != "") {
        var fotoInventario = $("#foto_evidencia_inventario")[0].files;
        var observaciones = $("#observaciones").val();

        if (fotoInventario.length > 0 && observaciones != "") {
          //$("#overlayBtnGuardarEvidencia").removeClass("d-none");

          var datos = new FormData();
          datos.append("GuardarEvidencia", "ok");
          datos.append("idvehiculo", idvehiculo);
          datos.append("fotoInventario", fotoInventario[0]);
          datos.append("observaciones", observaciones);

          $.ajax({
            type: "post",
            url: `${urlPagina}ajax/mantenimiento.ajax.php`,
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response == "ok") {
                Swal.fire({
                  icon: "success",
                  timer: 1500,
                  title: "Documento subido correctamente!",
                  showConfirmButton: false,
                });
                /* ===================================================
                        TABLA DE EVIDENCIAS
                ===================================================*/
                AjaxTablaEvidencias(idvehiculo);
              } else {
                Swal.fire({
                  icon: "error",
                  title:
                    "¡Ha ocurrido un error, por favor intente de nuevo más tarde!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                });
              }
            },
          });
        }
      } else {
        Swal.fire({
          icon: "warning",
          title: "Seleccione un vehículo / placa",
          showConfirmButton: false,
          timer: 1500,
        });
      }
    });

    /*==========================================================================
    BOTON CAMBIAR ESTADO EVIDENCIA
    ==========================================================================*/
    $(document).on("click", ".btn-estado", function () {
      var $boton = $(this);
      var idevidencia = $(this).attr("idevidencia");
      var idvehiculo = $(this).attr("idvehiculo");
      var estado = $(this).attr("estado");

      var textoBoton = estado == "PENDIENTE" ? "Resuelto!" : "Aún pendiente";
      var colorBoton = estado == "PENDIENTE" ? "#5cb85c" : "#d33";
      Swal.fire({
        title: `Esto se encuentra ${estado}`,
        html: `
                                      <hr>
                                      <label for="">Observaciones</label>
                                      <input class="form-control" id="swal-evidencia-obs" type="text" value="${$(
          "#obs_" + idevidencia
        ).text()}">
                                      `,
        showCancelButton: true,
        confirmButtonColor: colorBoton,
        cancelButtonColor: "#007bff",
        confirmButtonText: textoBoton,
        cancelButtonText: "Cerrar",
      }).then((result) => {
        if (result.value) {
          var observaciones = $("#swal-evidencia-obs").val();

          if (observaciones != "") {
            var datos = new FormData();
            datos.append("CambiarEstadoEvidencia", "ok");
            datos.append("idevidencia", idevidencia);
            datos.append("estadoActual", estado);
            datos.append("observaciones", observaciones);
            $.ajax({
              url: `${urlPagina}ajax/mantenimiento.ajax.php`,
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                if (response == "ok") {
                  Swal.fire({
                    icon: "success",
                    timer: 1000,
                    title: "Registro modificado correctamente!",
                    showConfirmButton: false,
                  });
                  /* ===================================================
                                      TABLA DE EVIDENCIAS
                                  ===================================================*/
                  AjaxTablaEvidencias(idvehiculo);
                  // if (estado == 'RESUELTO') {
                  //     $boton.removeClass("btn-success");
                  //     $boton.addClass("btn-danger");
                  //     $boton.html(`<i class="far fa-clock"></i> PENDIENTE`);
                  //     $boton.attr("estado", "PENDIENTE");
                  // } else {
                  //     $boton.addClass("btn-success");
                  //     $boton.removeClass("btn-danger");
                  //     $boton.html(`<i class="far fa-check-square"></i> RESUELTO`);
                  //     $boton.attr("estado", "RESUELTO");
                  // }
                }
                // Mensaje de error
                else
                  Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error, por favor intente de nuevo",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                  }).then((result) => {
                    if (result.value) {
                      window.location = "m-inventario";
                    }
                  });
              },
            });
          } else {
            Swal.fire({
              icon: "warning",
              timer: 3000,
              title: "No pueden quedar en blanco las observaciones",
              showConfirmButton: false,
            });
          }
        }
      });
    });

    /*==========================================================================
    BOTON VALIDAR INPUTS REQUERIDOS
    ==========================================================================*/
    $(document).on("click", ".btn-agregar-inventario", function () {
      Requeridos = [];

      $("input:invalid").each(function (index, element) {
        var $input = $(this);

        var idform = $input.closest("form").attr("id");

        if (idform == "formulario_inventario") {
          Requeridos.push($input);
        }
      });

      var tables = [];

      $("input:invalid").each(function (index, element) {
        var $inputs = $(this);
        var table = $inputs.closest("table").attr("nombre");

        if(!tables.includes(table)) tables.push(table);
      });

      if (Requeridos.length > 0) {

        let InputRequeridos = `<ul>`;
        tables.forEach(element => {
            InputRequeridos += `<li>${element}</li>`;
        })
        InputRequeridos += `</ul>`;


        Swal.fire({
          icon: 'warning',
          html: `<div class="text-left">
                                      <p class="font-weight-bold">Hace falta diligenciar campos en los siguientes apartados:</p>
                                          ${InputRequeridos}
                                  </div>`,
          showConfirmButton: true,
          confirmButtonText: 'Cerrar',
          closeOnConfirm: false
      });
      }
    });

    /*==========================================================================
    BOTON ELIMINAR INVENTARIO
    ===========================================================================*/
    $(".btn-eliminar").on("click", function () {
      let id = $(this).attr("id_inventario");

      Swal.fire({
        icon: "warning",
        showConfirmButton: true,
        showCancelButton: true,
        title: "¿Seguro que desea borrar este registro?",
        confirmButtonText: "SI, borrar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#e60000",
        cancelButtonColor: "#0066ff",
        allowOutsideClick: false,
      }).then((result) => {
        if (result.value) {
          var datos = new FormData();
          datos.append("EliminarInventario", "ok");
          datos.append("idvehiculo", id);

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
                  window.location = "m-inventario";
                });
              }
            },
          });
        }
      });
    });
  }

  /* ===================================================
    * REVISIÓN TECNICOMECÁNICA
  ====================================================== */
  if (
    window.location.href == `${urlPagina}m-revision-tm/` ||
    window.location.href == `${urlPagina}m-revision-tm`
  ) {

    $(document).on("click", ".btnEditarRev", function () {
      $("#titulo-modal-tecnomecanica").html("Editar convenio");

      // var idrevision = $(this).attr("idrevision");
      // $("#idrevision").val(idrevision);

      // var datos = new FormData();
      // datos.append("DatosRevision", "ok");
      // datos.append("idrevision", idrevision);
      // // console.log(idrevision);

      // $.ajax({
      //   type: "POST",
      //   url: "ajax/mantenimiento.ajax.php",
      //   data: datos,
      //   cache: false,
      //   contentType: false,
      //   processData: false,
      //   dataType: "json",
      //   success: function (response) {
      //     if (response != "") {
      //       //Guarda en KEYS los elementos llaves, nombres, name del JSON
      //       var keys = Object.keys(response);
      //       //Guarda en VALUES los elementos de valor del JSON
      //       var values = Object.values(response);

      //       // Recorremos ambos arreglos
      //       for (let index = 0; index < keys.length; index++) {
      //         // NO tomamos las llaves numericas (normalmente un json repite el arreglo json con llaves numericos)
      //         if (isNaN(keys[index])) {
      //           if (
      //             keys[index] != "placa" &&
      //             keys[index] != "numinterno" &&
      //             keys[index] != "id" &&
      //             keys[index] != "idvehiculo" &&
      //             keys[index] != "idconductor"
      //           ) {
      //             // Si el input es un check - radio
      //             $(
      //               `input[name='${keys[index]}'][value='${values[index]}']`
      //             ).iCheck("check");
      //           }
      //         }
      //       }

      //       $("#observador_conductoresAlistamiento").attr(
      //         "idconductor",
      //         response.idconductor
      //       );

      //       // setTimeout(() => {
      //       //     $("#idconductor").val(response.idconductor);
      //       // }, 1000);

      //       $("#cambio_aceite").val(response.cambio_aceite);
      //       $("#engrase").val(response.engrase);
      //       $("#rotacion_llantas").val(response.rotacion_llantas);
      //       $("#filtro_aire").val(response.filtro_aire);
      //       $("#sincronizacion").val(response.sincronizacion);
      //       $("#alineacion_balanceo").val(response.alineacion_balanceo);

      //       $("#kmtotal").val(response.kilometraje_total);
      //       $("#observaciones").val(response.observaciones);
      //     }
      //   }
      // });

      var idvehiculo = $(this).attr("idvehiculo");
      $("#idvehiculo").val(idvehiculo);

      var datos = new FormData();
      datos.append("DatosVehiculo", "ok");
      datos.append("idvehiculo", idvehiculo);


      $.ajax({
        type: "POST",
        url: "ajax/mantenimiento.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          $('#placa').val(response.idvehiculo).trigger("change");
        }
      });

      /* ==========================================
          CARGAR DATOS POR PLACA
          ========================================= */

      $(document).on("change", '#placa', function () {

        let idvehiculo = $(this).val();



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
          success: function (response) {

            var Vehiculo = response.datosVehiculo;
            //Se resetea los colores del fondo de documentos
            $(".documentos").val("").trigger("change")
            $(".bg-success").removeClass("bg-success");
            $(".bg-danger").removeClass("bg-danger");

            console.log(Vehiculo.idtipovehiculo);


            //DESACTIVAR INPUTS DEPENDIENDO DEL TIPO DE VEHICULO

            if (Vehiculo.idtipovehiculo == 9 || Vehiculo.idtipovehiculo == 2) {
              $("input[name='freno_ahogo']").attr('disabled', true);
              $("input[name='compresor']").attr('disabled', true);
              $("input[name='fuga_aire']").attr('disabled', true);
              $("input[name='banda_delantera_derecha']").attr('disabled', true);
              $("input[name='banda_delantera_izquierda']").attr('disabled', true);
              $("input[name='rachets']").attr('disabled', true);
              $("input[name='llantar5']").attr('disabled', true);
              $("input[name='llantar6']").attr('disabled', true);
              $("input[name='tanques_aire']").attr('disabled', true);
              $("input[name='luces_delimitadoras']").attr('disabled', true);
              $("input[name='rutero']").attr('disabled', true);
              $("input[name='estribos_puerta']").attr('disabled', true);
              $("input[name='brazo_limpiaparabrisas_derecho']").attr('disabled', true);
              $("input[name='parabrisas_izquierdo']").attr('disabled', true);
              $("input[name='brazo_limpiaparabrisas_izquierdo']").attr('disabled', true);
              $("input[name='vidrio_puerta_principal']").attr('disabled', true);
              $("input[name='vidrio_segunda_puerta']").attr('disabled', true);
              $("input[name='claraboyas']").attr('disabled', true);
              $("input[name='parales']").attr('disabled', true);
              $("input[name='booster_puertas']").attr('disabled', true);
              $("input[name='reloj_vigia']").attr('disabled', true);
              $("input[name='vigia_delantera_derecha']").attr('disabled', true);
              $("input[name='vigia_delantera_izquierda']").attr('disabled', true);
              $("input[name='vigia_trasera_derecha']").attr('disabled', true);
              $("input[name='vigia_trasera_izquierda']").attr('disabled', true);
              $("input[name='martillo_emergencia']").attr('disabled', true);
              $("input[name='dispositivo_velocidad']").attr('disabled', true);
              $("input[name='balizas']").attr('disabled', true);

            } else {
              $("input[name='freno_ahogo']").attr('disabled', false);
              $("input[name='compresor']").attr('disabled', false);
              $("input[name='fuga_aire']").attr('disabled', false);
              $("input[name='banda_delantera_derecha']").attr('disabled', false);
              $("input[name='banda_delantera_izquierda']").attr('disabled', false);
              $("input[name='rachets']").attr('disabled', false);
              $("input[name='llantar5']").attr('disabled', false);
              $("input[name='llantar6']").attr('disabled', false);
              $("input[name='tanques_aire']").attr('disabled', false);
              $("input[name='luces_delimitadoras']").attr('disabled', false);
              $("input[name='rutero']").attr('disabled', false);
              $("input[name='estribos_puerta']").attr('disabled', false);
              $("input[name='brazo_limpiaparabrisas_derecho']").attr('disabled', false);
              $("input[name='parabrisas_izquierdo']").attr('disabled', false);
              $("input[name='brazo_limpiaparabrisas_izquierdo']").attr('disabled', false);
              $("input[name='vidrio_puerta_principal']").attr('disabled', false);
              $("input[name='vidrio_segunda_puerta']").attr('disabled', false);
              $("input[name='claraboyas']").attr('disabled', false);
              $("input[name='parales']").attr('disabled', false);
              $("input[name='booster_puertas']").attr('disabled', false);
              $("input[name='reloj_vigia']").attr('disabled', false);
              $("input[name='vigia_delantera_derecha']").attr('disabled', false);
              $("input[name='vigia_delantera_izquierda']").attr('disabled', false);
              $("input[name='vigia_trasera_derecha']").attr('disabled', false);
              $("input[name='vigia_trasera_izquierda']").attr('disabled', false);
              $("input[name='martillo_emergencia']").attr('disabled', false);
              $("input[name='dispositivo_velocidad']").attr('disabled', false);
              $("input[name='balizas']").attr('disabled', false);
            }



            $('#numinterno').val(Vehiculo.numinterno);
            $('#modelo').val(Vehiculo.modelo);
            $("#tipo_vehiculo").val(Vehiculo.idtipovehiculo).trigger("change");
            $('#tipo_vehiculo').attr('disabled', 'disabled');
            $('#marca').val(Vehiculo.idmarca).trigger("change");
            $('#marca').attr('disabled', 'disabled');
            $('#tarjeta_operacion').val(Vehiculo.idtipodocumento);
            $("#num_interno").val(Vehiculo.idvehiculo).trigger("change");
            $('#num_interno').attr('disabled', 'disabled');


            // CARGA LOS DOCUMENTOS DEL VEHICULO
            var datos = new FormData();
            datos.append("DocumentosxVehiculo", "ok");
            datos.append("idvehiculo", Vehiculo.idvehiculo);
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
                  // Asigno valor fecha
                  $(`#documento_${element.idtipodocumento}`).val(
                    element.fechafin
                  );

                  // Color del fondo segun la fecha
                  var bg =
                    element.fechafin >= moment().format("YYYY-MM-DD")
                      ? "bg-success"
                      : "bg-danger";
                  $(`#documento_${element.idtipodocumento}`).addClass(bg);
                });
              },
            });


          },
        });
      });




    });

    $(document).on("click", ".btn-nuevaRevision", function () {
      $("#titulo-modal-tecnomecanica").html("Nuevo convenio");
      $("#datosrevision_form").trigger("reset");
      $('.select2-single').val(" ").trigger("change");
      $(".documentos").val("").trigger("change")



      $(document).on("change", '#placa', function () {

        let idvehiculo = $(this).val();

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
          success: function (response) {

            var Vehiculo = response.datosVehiculo;
            //Se resetea los colores del fondo de documentos
            $(".documentos").val("").trigger("change")
            $(".bg-success").removeClass("bg-success");
            $(".bg-danger").removeClass("bg-danger");

            $('#numinterno').val(Vehiculo.numinterno);
            $('#modelo').val(Vehiculo.modelo);
            $("#tipo_vehiculo").val(Vehiculo.idtipovehiculo).trigger("change");
            $('#tipo_vehiculo').attr('disabled', 'disabled');
            $('#marca').val(Vehiculo.idmarca).trigger("change");
            $('#marca').attr('disabled', 'disabled');
            $('#tarjeta_operacion').val(Vehiculo.idtipodocumento);
            $("#num_interno").val(Vehiculo.idvehiculo).trigger("change");
            $('#num_interno').attr('disabled', 'disabled');



            //CARGA DOCUMENTOS DEL VEHICULO

            var datos = new FormData();
            datos.append("DocumentosxVehiculo", "ok");
            datos.append("idvehiculo", Vehiculo.idvehiculo);
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
                  // Asigno valor fecha
                  $(`#documento_${element.idtipodocumento}`).val(
                    element.fechafin
                  );

                  // Color del fondo segun la fecha
                  var bg =
                    element.fechafin >= moment().format("YYYY-MM-DD")
                      ? "bg-success"
                      : "bg-danger";
                  $(`#documento_${element.idtipodocumento}`).addClass(bg);
                });
              },
            });


          },
        });
      });



    });

  }




});
