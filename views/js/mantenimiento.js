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
            $("#conductor_invent").empty();
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
    RESTABLECER INVENTARIO
    ==========================================================================*/
    $("#restablecer").click(function (e) {

      $("#placa_invent").val("").trigger("change");

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
    $("#formulario_evidencias").submit(function (e) {
      e.preventDefault();

      let idvehiculo = $("#placa_invent").val();

      if (idvehiculo != "") {
        var fotoInventario = $("#foto_evidencia_inventario")[0].files;
        var observaciones = $("#observaciones").val();

        if (fotoInventario.length > 0 && observaciones != "") {

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

        if (table == undefined) table = "Datos inventario"

        if (!tables.includes(table)) tables.push(table);
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

    /* ===================================================
           VISUALIZAR PDF DEL INVENTARIO
    ===================================================*/
    $(document).on("click", ".btn-verInventario", function () {
      var id_inventario = $(this).attr("id_inventario");
      window.open(
        `./pdf/pdfinventario.php?id_inventario=${id_inventario}`,
        "",
        "width=1280,height=720,left=50,top=50,toolbar=yes"
      );
    });

    /*===================================================
              INICIALIZAR DATATABLE
    ===================================================*/
    let FiltroTablaInventario = () => {
      /* ===================================================
                    FILTRAR POR COLUMNA
      ====================================================*/
      /* Filtrar por columna */
      //Clonar el tr del thead
      $(`#tabla_resumen_inventario thead tr:eq(1)`)
        .clone(true)
        .appendTo(`#tabla_resumen_inventario thead`);
      //Por cada th creado hacer lo siguiente
      $(`#tabla_resumen_inventario thead tr:eq(2) th`).each(function (i) {
        //Remover clase sorting y el evento que tiene cuando se hace click
        $(this).removeClass("sorting").unbind();
        //Agregar input de busqueda
        $(this).html(
          '<input class="form-control" type="text" placeholder="Buscar"/>'
        );
        //Evento para detectar cambio en el input y buscar
        $("input", this).on("keyup change", function () {
          if (table.column(i).search() !== this.value) {
            table.column(i).search(this.value).draw();
          }
        });
      });

      /* ===================================================
                      INICIALIZAR DATATABLE 
      ====================================================*/
      var buttons = [
        {
          extend: "excel",
          className: "btn-info",
          text: '<i class="far fa-file-excel"></i> Exportar',
        },
      ];
      var table = dataTableCustom(`#tabla_resumen_inventario`, buttons);
    };
    FiltroTablaInventario();
  }

  /* ===================================================
    * REVISIÓN TECNICOMECÁNICA
  ====================================================== */
  if (
    window.location.href == `${urlPagina}m-revision-tm/` ||
    window.location.href == `${urlPagina}m-revision-tm`
  ) {

    $(document).on("click", ".btnEditarRev", function () {
      $("#titulo-modal-tecnomecanica").html("Editar revisión tecnicomecánica");

      var idrevision = $(this).attr("idrevision");
      $("#idrevision").val(idrevision);

      var datos = new FormData();
      datos.append("DatosRevision", "ok");
      datos.append("idrevision", idrevision);


      $.ajax({
        type: "POST",
        url: "ajax/mantenimiento.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
          if (response != "") {
            //Guarda en KEYS los elementos llaves, nombres, name del JSON
            var keys = Object.keys(response);
            //Guarda en VALUES los elementos de valor del JSON
            var values = Object.values(response);

            // Recorremos ambos arreglos
            for (let index = 0; index < keys.length; index++) {
              // NO tomamos las llaves numericas (normalmente un json repite el arreglo json con llaves numericos)
              if (isNaN(keys[index])) {
                if (
                  keys[index] != "placa" &&
                  keys[index] != "numinterno" &&
                  keys[index] != "id" &&
                  keys[index] != "idvehiculo" &&
                  keys[index] != "idconductor"
                ) {
                  // Si el input es un check - radio
                  $(
                    `input[name='${keys[index]}'][value='${values[index]}']`
                  ).iCheck("check");
                }
              }
            }

            $("#observador_conductoresAlistamiento").attr(
              "idconductor",
              response.idconductor
            );

            $("#observacion").val(response.observacion);
            $("#cant_externos").val(response.cant_externos)
            $("#cant_internos").val(response.cant_internos);
            $("#cant_martillos").val(response.cant_martillos);
            $("#kilometraje").val(response.kilometraje);

          }
        }
      });

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

    $(document).on("click", ".btn-nuevaRevision", function () {
      $("#titulo-modal-tecnomecanica").html("Nueva revisión tecnicomecánica");
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


    $(document).on("click", ".btnBorrarRev", function () {

      var idrevision = $(this).attr("idrevision");
      $("#idrevision").val(idrevision);

      Swal.fire({
        icon: "warning",
        showConfirmButton: true,
        showCancelButton: true,
        title: "¿Seguro que de sea borrar este registro?",
        confirmButtonText: "Si, borrar",
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#ff0000",
        cancelButtonColor: "#0080ff",
        allowOutsideClick: false,
      }).then((result) => {

        if (result.value == true) {

          var datos = new FormData();
          datos.append("EliminarRevision", "ok");
          datos.append("idrevision", idrevision);

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
                  window.location = "m-revision-tm";
                });
              }
            },
          });
        }
      });


    });

    //GUARDAR REVISIÓN 
    $(document).on("click", ".btn-guardarRev", function () {
      Areas = [];
      Requeridos = [];
      Elementos = [];

      //Validación de inputs

      $("input:invalid").each(function (index, element) {
        var $input = $(this);


        var idform = $input.closest("form").attr("id");

        if (idform == "datosrevision_form") {
          Requeridos.push($input);
        }
      });



      //Validación textarea

      $('textarea:invalid').each(function (index, element) {
        var $area = $(this);

        var idform = $area.closest("form").attr("id");

        if (idform == "datosrevision_form") {
          Areas.push($area);
        }
      });


      var tab = [];

      //Se trae los tabs 
      $('input:invalid').each(function (index, element) {
        var $tabs = $(this);
        var idtab = $tabs.closest("table").attr("nombre");
        if (idtab == undefined) idtab = "Documentos";
        if (!tab.includes(idtab)) tab.push(idtab);
      });




      $('textarea:invalid').each(function (index, element) {
        var $tabs = $(this);
        var idtab = $tabs.closest("table").attr("nombre");
        if (!tab.includes(idtab)) tab.push(idtab);
      });


      if (Requeridos.length > 0 || Areas.length > 0) {

        let inputsRequeridosHtml = `<ul>`;
        tab.forEach(element => {
          inputsRequeridosHtml += `<li>${element}</li>`;
        });
        inputsRequeridosHtml += `</ul>`;

        Swal.fire({
          icon: 'warning',
          html: `<div class="text-left">
                                              <p class="font-weight-bold">Hace falta diligenciar campos en los siguientes apartados:</p>
                                                  ${inputsRequeridosHtml}
                                          </div>`,
          showConfirmButton: true,
          confirmButtonText: 'Cerrar',
          closeOnConfirm: false
        });
      }


    });
  }



  /*========================================================
    *MANTENIMIENTOS
    ========================================================*/

  if (
    window.location.href == `${urlPagina}m-mantenimientos/` ||
    window.location.href == `${urlPagina}m-mantenimientos`
  ) {

    /*===================================================
     **********ORDEN DE SERVICIO/MANTENIMIENTO*********
    ====================================================*/

    //CLICK EN AÑADIR CAMPO REPUESTO EN ORDEN DE SERVICIO
    $(document).on("click", ".btn-agregarRepuesto", function () {
      // $("#contenido_filas_repuesto").clone().appendTo("#filas_tabla_repuesto");


      var fila = '<tr>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="descripcion_repuestos1" name="descripcion_repuestos1">' + '</td>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="cantidad1" name="cantidad1">' + '</td>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="precio1" name="precio1">' + '</td>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="referencia_repuestos1" name="referencia_repuestos1">' + '</td>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="proveedor1" name="proveedor1">' + '</td>' +
        '</tr>'
        ;

      $("#tbody_repuesto").append(fila);



    });

    //CLICK EN ELIMINAR FILA DE REPUESTO EN ORDEN DE SERVICIO
    $(document).on("click", ".btn-EliminarRepuesto", function () {
      $('#tbody_repuesto tr:last').remove();
    });


    //CLICK EN AÑADIR CAMPO MANO DE OBRA
    $(document).on("click", ".btn-agregarManoObra", function () {

      var fila = '<tr>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="descripcion_manoObra1" name="descripcion_repuestos1">' + '</td>' +
        '<td style="width: 300px">' + '<input type="text" class="form-control" id="proveedor" name="proveedor">' + '</td>' +
        '</tr>'
        ;
      $("#filas_tabla_manoObra").append(fila);
    });

    //CLICK EN ELIMINAR FILA DE MANO DE OBRA EN ORDEN DE SERVICIO
    $(document).on("click", ".btn-EliminarManoObra", function () {
      $('#filas_tabla_manoObra tr:last').remove();
    });



    /*==============================
        SOLICITUD DE SERVICIO/REPUESTOS
    ================================*/

    //CLICK EN AÑADIR FILA A REPUESTO SOLICITUD DE SERVICIO
    var dinamico = 2;
    $(document).on("click", ".btn-agregarRepuestoSolicitud", function () {
      var fila = `<tr>
      <td style="width: 300px">` +
      `<div class="input-group">` +
      `<input class="form-control" type="text" id="repuesto_${dinamico}" name="repuesto[] "placeholder="Seleccione un repuesto" readonly>` +
      `<div class="input-group-append">` +
      `<button type="button" class="btn btn-success btn-md btn-repuestos" consecutivo="${dinamico}" title="lista repuestos" data-toggle="modal" data-target="#modal-repuestos"><i class="fas fa-business-time"></i></button>` +

      `</div>` +
      `</div>` +
      `</td>` +
      `<td style="width: 300px">` + `<input type="text" class="form-control" id="refrepuestos_${dinamico}" name="referencia_repuesto[]" readonly>` + `</td>` +
      `<td style="width: 300px">` + `<input type="text" class="form-control" id="codrepuestos_${dinamico}" name="codigo_repuesto[]" readonly>` + `</td>` +
      `<td style="width: 300px">` + `<input type="text" class="form-control" id="cantrepuestos_${dinamico}" name="cantidad_repuesto[]">` + `</td>` +
      `</tr>`
      ;
      
      dinamico = dinamico + 1;
      
      
      $("#filas_tabla_repuestoSolicitud").append(fila); 
    });

    //CLICK EN ELIMINAR FLA A RESPUESTO EN SOLICITUD DE SERVICIO
    $(document).on("click", ".btn-EliminarRepuestoSolicitud", function () {
      $('#filas_tabla_repuestoSolicitud tr:last').remove();
    });


    // CARGAR DATOS DEL VEHICULO
    $(document).on('change', "#placa_repuestos", function () {


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
          $('#km_repuestos').val(Vehiculo.kilometraje);
          $('#numinterno_repuestos').val(Vehiculo.numinterno);
          $('#modelo_repuestos').val(Vehiculo.modelo);
          $("#clasevehiculo_repuestos").val(Vehiculo.tipovehiculo).trigger("change");
          $('#marca_repuestos').val(Vehiculo.marca);
        },
      });


    });

  }


  //CARGAR TABLA DE PRODUCTOS
  let AjaxTablaProductos = (consecutivo) => {

    // Quitar datatable
    $("#tablaRepuesto").dataTable().fnDestroy();
    // Borrar datos
    $("#tBodyRepuesto").html("");

    var datos = new FormData();
    datos.append("ListaProductos", "ok");
    datos.append("consecutivo",consecutivo);
    $.ajax({
      type: "post",
      url: `ajax/mantenimiento.ajax.php`,
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {

        if (response != '' || response != null) {
          $("#tBodyRepuesto").html(response);
        } else {
          $("#tBodyRepuesto").html('');
        }
        /* ===================================================
            INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
          ===================================================*/
        var buttons = [
          { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
        ];
        var table = dataTableCustom(`#tablaRepuesto`, buttons);
      },
    });
  }


  /* =====================================================
      CLICK EN CAMPO REPUESTO TABLA SOLICITUD DE SERVICIO
  =======================================================*/

  $(document).on("click", ".btn-repuestos", function () {
    //Mando el consecutivo para luego saber a que fila poner el repuesto seleccionado
    var consecutivo = $(this).attr("consecutivo")
    //FUNCION CARGAR TABLA PRODUCTOS
    AjaxTablaProductos(consecutivo);
    

  });


  /*==============================
    ClICK EN SELECCIONAR PRODUCTO
  ================================*/

  $(document).on("click", ".btnSeleccionarProducto", function () {

    $("#modal-repuestos").modal("hide");

    var descripcion = $(this).attr("descripcion");
    var consecutivo = $(this).attr("consecutivo");
    var codigo = $(this).attr("codigo");
    var referencia = $(this).attr("referencia");
    

    $(`#repuesto_${consecutivo}`).val(descripcion);
    $(`#refrepuestos_${consecutivo}`).val(referencia);
    $(`#codrepuestos_${consecutivo}`).val(codigo);

    
  });




  /*========================================
***************PROGRAMACION*****************
  ===========================================*/



  // CARGAR DATOS EN LA TABLA DEPENDIENDO DEL SERVICIO SELECCIONADO

  let AjaxTablaProgramacion = (idservicio) => {
    // Quitar datatable
    $("#tablaProgramacion").dataTable().fnDestroy();
    // Borrar datos
    $("#tbodyProgramacion").html("");

    var datos = new FormData();
    datos.append("Servicios", "ok");
    datos.append("idservicio", idservicio);
    $.ajax({
      type: "post",
      url: "ajax/mantenimiento.ajax.php",
      data: datos,
      // dataType: "JSON",
      cache: false,
      contentType: false,
      processData: false,
      success: function (response) {

        

        if (response != '' || response != null) {
          $("#tbodyProgramacion").html(response);
        } else {
          $("#tbodyProgramacion").html('');
        }

        /* ===================================================
                 INICIALIZAR DATATABLE PUESTO QUE ESTO CARGA POR AJAX
                 ===================================================*/
        var buttons = [
          { extend: 'excel', className: 'btn-info', text: '<i class="far fa-file-excel"></i> Exportar' }
        ];
        var table = dataTableCustom(`#tablaProgramacion`, buttons);

      }
    });



  }

  //SELECCION SERVICIO
  $(document).on("change", "#servicio", function () {

    
    //CARGA TABLA POR AJAX 
    let idservicio = $(this).val()
    
    if (idservicio == 'todo') $('#btn-guardarProgra').hide();
    else $('#btn-guardarProgra').show();
    
    
    AjaxTablaProgramacion(idservicio);

  });


  // BORRAR SERVICIO PROGRAMACIÓN
  $(document).on("click", ".btnBorrarProgramacion", function () {
    let idserviciovehiculo = $(this).attr("idserviciovehiculo");
    let idservicio = $(this).attr("idservicio");


    Swal.fire({
      icon: "warning",
      showConfirmButton: true,
      showCancelButton: true,
      title: "¿Seguro que de sea borrar este registro?",
      confirmButtonText: "Si, borrar",
      cancelButtonText: "Cancelar",
      confirmButtonColor: "#ff0000",
      cancelButtonColor: "#0080ff",
      allowOutsideClick: false,
    }).then((result) => {

      if (result.value == true) {

        var datos = new FormData();
        datos.append("EliminarProgramacion", "ok");
        datos.append("idserviciovehiculo", idserviciovehiculo);

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
              AjaxTablaProgramacion(idservicio);
              Swal.fire({
                icon: "success",
                showConfirmButton: true,
                title: "¡El registro ha sido borrado correctamente!",
                confirmButtonText: "¡Cerrar!",
                allowOutsideClick: false,
              }).then((result) => {
                window.location = "m-mantenimientos";
              });
            }
          },
        });
      }
    });





  });



  // GUARDAR SERVICIO
  $('#programacion_form').submit(function (e) {
    e.preventDefault();

    let idvehiculo = 0;
    let kilometrajeFrm = 0;



    var datosFrm = $(this).serializeArray();

    datosFrm.forEach(element => {
      if (element.name == 'idvehiculo_serv') idvehiculo = element.value;
      if (element.name == 'kilometraje_serv') kilometrajeFrm = element.value;
    });

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
    
      
        //Validamos si el kilometraje ingresado en el formulario es mayor o igual al que tiene el vehículo, de ser así puede guardar, de lo contrario no puede guardar
        if (kilometrajeFrm >= Vehiculo.kilometraje) {

          //AJAX PARA GUARDAR PROGRAMACIÓN
          var datosAjax = new FormData();
          datosAjax.append('GuardarProgramacion', "ok")

          datosFrm.forEach(element => {
            datosAjax.append(element.name, element.value);
          });


          $.ajax({
            type: 'post',
            url: "ajax/mantenimiento.ajax.php",
            data: datosAjax,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {

              if (response == "ok") {
                // Cargar de nuevo la tabla de servicios
                AjaxTablaProgramacion(1);
                // Reset del formulario
                $("#programacion_form").trigger("reset");
                $("#servicio").val("").trigger("change");
                $("#placa").val("").trigger("change");
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
                    window.location = 'm-mantenimientos';
                  }

                })
              }
            }
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Verifique el kilometraje del vehículo y vuelva a intentarlo',
            showConfirmButton: true,
            confirmButtonText: 'Cerrar',
            closeOnConfirm: false
          })
        }




      },
    });





    // datosFrm.forEach(element => {
    //   datosAjax.append(element.name, element.value);
    // });

    // console.log(datosFrm);

    // $.ajax({
    //   type: 'post',
    //   url: "ajax/mantenimiento.ajax.php",
    //   data: datosAjax,
    //   cache: false,
    //   contentType: false,
    //   processData: false,
    //   success: function (response) {

    //     console.log(response);
    //     if (response == "ok") {
    //       // Cargar de nuevo la tabla de servicios
    //       AjaxTablaProgramacion(1);
    //       // Reset del formulario
    //       $("#programacion_form").trigger("reset");
    //       // Mensaje de éxito al usuario
    //       Swal.fire({
    //         icon: 'success',
    //         title: '¡Datos guardados correctamente!',
    //         showConfirmButton: true,
    //         confirmButtonText: 'Cerrar',
    //       })
    //     } else {
    //       Swal.fire({
    //         icon: 'error',
    //         title: 'Ha ocurrido un error, por favor intente de nuevo',
    //         showConfirmButton: true,
    //         confirmButtonText: 'Cerrar',
    //         closeOnConfirm: false
    //       }).then((result) => {

    //         if (result.value) {
    //           window.location = 'm-mantenimientos';
    //         }

    //       })
    //     }
    //   }
    // });






  });






});


