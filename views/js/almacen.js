$(document).ready(function () {
    /* ===================================================
        * INVENTARIO
    ===================================================*/
    if (
        window.location.href == `${urlPagina}a-inventario/` ||
        window.location.href == `${urlPagina}a-inventario`
    ) {
        //SUBMIT del formulario que agrega un producto y retorna el id del producto
        $("#formulario_producto").submit(function (e) {
            e.preventDefault();

            var datosAjax = new FormData();
            datosAjax.append("AgregarProducto", "ok");
            var datosFrm = $(this).serializeArray();
            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        Swal.fire({
                            icon: "success",
                            title: "Se creó el producto exitosamente!",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        //GUARDAR ID para agregar al inventario
                        $("#id_producto").val(response);
                        //HABILITAR CAMPOS DE INVENTARIO
                        $(".input_inventario").attr("readonly", false);
                        //Recargar tabla productos
                        cargarTablaProductos();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Error al crear el producto",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        $(".input_inventario").attr("readonly", true);
                    }
                },
            });
        });
        //SUBMIT del formulario que agrega un producto y retorna el id del producto
        $("#formulario_addInventario").submit(function (e) {
            e.preventDefault();

            var idproducto = $("#id_producto").val();
            // var idsucursal = $("#sucursal").val();
            // var stock = $("#cantidad").val();
            // var proveedor = $("#proveedor").val();
            // var precio = $("#precio-compra-producto").val();
            // var factura = $("#num_factura").val();

            if (idproducto != "") {
                var datosAjax = new FormData();
                var datosFrm = $("#formulario_addInventario").serializeArray();
                datosFrm.forEach((element) => {
                    datosAjax.append(element.name, element.value);
                });
                datosAjax.append("AgregarInventario", "ok");
                datosAjax.append("idproducto", idproducto);

                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/almacen.ajax.php`,
                    data: datosAjax,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response == "agregado") {
                            Swal.fire({
                                icon: "success",
                                title: "Se agregó correctamente al inventario.",
                                showConfirmButton: false,
                                timer: 2500,
                            });
                        } else if (response == "editado") {
                            Swal.fire({
                                icon: "success",
                                title: "Se ha actualizado el inventario.",
                                showConfirmButton: false,
                                timer: 2500,
                            });
                        }
                        cargarTablaInventario();
                    },
                });
                //REINICIAR VALORES
                $("#id_producto").val("");
                $("#formulario_producto").trigger("reset");
                $("#formulario_addInventario").trigger("reset");
                $(".select2-single").val("").trigger("change");
                $(".btn_agregarProducto").show();
                $(".btn_actualizarProducto").addClass("d-none");
                $(".btn_nuevaReferencia").addClass("d-none");
                $("#titulo_producto").html("Nuevo producto");
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Agregue un producto primero.",
                    showConfirmButton: false,
                    timer: 1000,
                });
            }
        });
        //EVENTO AL ABRIR EL MODAL DE PRODUCTOS CARGA LOS DATOS DE LOS SELECT(proveedor, marca, medida,categoria,sucursales)
        $(document).on("shown.bs.modal", "#modal-productos", function () {
            cargarSelect("categoria");
            cargarSelect("medida");
            cargarSelect("marca");
            cargarSelect("sucursal");
            cargarSelectProveedor();
            cargarTablaProductos();
            cargarTablaInventario();
            $("#formulario_producto").trigger("reset");
            $("#formulario_addInventario").trigger("reset");
            $("#id_producto").val("");
            $(".btn_agregarProducto").show();
            $(".btn_actualizarProducto").addClass("d-none");
            $(".btn_nuevaReferencia").addClass("d-none");
            $(".input_inventario").attr("readonly", true);
            $("#titulo_producto").html("Nuevo producto");
        });
        //EVENTO al salir del input de codigo, busca si ese codigo existe y se trae los datos del producto con ese codigo
        $(document).on("blur", "#cod_producto", function () {
            var datos = new FormData();
            datos.append("DatosProducto", "ok");
            datos.append("item", "codigo");
            datos.append("valor", $(this).val());

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.length > 1) {
                        var tr = "";
                        response.forEach((element) => {
                            tr += "<tr>";
                            tr += "<td>";
                            tr += element.idproducto;
                            tr += "</td>";
                            tr += "<td>";
                            tr += element.descripcion;
                            tr += "</td>";
                            tr += "<td>";
                            tr += element.referencia;
                            tr += "</td>";
                            tr += "<td>";
                            tr += "<button idproducto='";
                            tr += element.idproducto;
                            tr +=
                                "' class='btn btn-sm btn-info btnSeleccionarRef' title='Seleccionar producto'><i class='fas fa-check-circle'></i></button>";
                            tr += "</td>";
                            tr += "<tr>";
                        });

                        Swal.fire({
                            title: `Referencias con el código - ${response[0].codigo}`,
                            html: `<table border="2" style="width: 100%;" cellpadding="6">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descripción</th>
                                            <th>Referencia</th>
                                            <th>Selección</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${tr}
                                    </tbody>
                                </table>`,
                            width: "800px",
                            confirmButtonColor: "#5cb85c",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Continuar",
                        });
                    } else {
                        var datosProducto = response[0];
                        cargarDatosProducto(datosProducto);
                    }
                },
            });
        });
        //ACTUALIZAR PRODUCTO EXISTENTE
        $(document).on("click", ".btn_actualizarProducto", function () {
            var idproducto = $("#id_producto").val();

            if (idproducto != "") {
                var codigo = $("#cod_producto").val();
                var referencia = $("#referencia").val();
                var descripcion = $("#descripcion_prod").val();
                var categoria = $("#categoria").val();
                var marca = $("#marca").val();
                var medidad = $("#medida").val();

                var datos = new FormData();
                datos.append("ActualizarProducto", "ok");
                datos.append("idproducto", idproducto);
                datos.append("codigo", codigo);
                datos.append("referencia", referencia);
                datos.append("descripcion", descripcion);
                datos.append("idcategoria", categoria);
                datos.append("idmarca", marca);
                datos.append("idmedida", medidad);

                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/almacen.ajax.php`,
                    data: datos,
                    //dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != "") {
                            Swal.fire({
                                icon: "success",
                                title: "Producto actualizado correctamente.",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            $("#formulario_producto").trigger("reset");
                            $("#formulario_addInventario").trigger("reset");
                            $("#id_producto").val("");
                            $(".btn_agregarProducto").show();
                            $(".btn_actualizarProducto").addClass("d-none");
                            $(".btn_nuevaReferencia").addClass("d-none");
                            $(".input_inventario").attr("readonly", true);
                            $("#titulo_producto").html("Nuevo producto");
                            //RECARGAR TABLA PRODUCTOS
                            cargarTablaProductos();
                        }
                    },
                });
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "No seleccionó un producto existente.",
                    showConfirmButton: false,
                    timer: 1000,
                });
            }
        });
        //EVENTO que trae los datos de la referencia seleccionada segun el id producto
        $(document).on("click", ".btnSeleccionarRef", function () {
            let id = $(this).attr("idproducto");

            var datos = new FormData();
            datos.append("DatosProducto", "ok");
            datos.append("item", "idproducto");
            datos.append("valor", id);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    cargarDatosProducto(response[0]);
                    Swal.fire({
                        icon: "success",
                        title: "Referencia seleccionada.",
                        showConfirmButton: false,
                        timer: 1000,
                    });
                },
            });
        });
        //Evento para ver las sucursales en las que un producto se encuentra
        $(document).on("click", ".btnSucursalesInventario", function () {
            let idproducto = $(this).attr("idproducto");
            cargarTablaSucursales(idproducto);

            // var datos = new FormData();
            // datos.append("SucursalesInventario", "ok");
            // datos.append("idproducto", idproducto);

            // $.ajax({
            //     type: "post",
            //     url: `${urlPagina}ajax/almacen.ajax.php`,
            //     data: datos,
            //     dataType: "json",
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     success: function (response) {
            //         var tr = "";
            //         response.forEach((element) => {
            //             tr += "<tr>";
            //             tr += "<td>";
            //             tr += element.descripcion;
            //             tr += "</td>";
            //             tr += "<td>";
            //             tr += element.referencia;
            //             tr += "</td>";
            //             tr += "<td>";
            //             tr += element.stock;
            //             tr += "</td>";
            //             tr += "<td>";
            //             tr += element.posicion;
            //             tr += "</td>";
            //             tr += "<td>";
            //             tr += element.sucursal;
            //             tr += "</td>";
            //             tr += "<tr>";
            //         });

            //         Swal.fire({
            //             title: `Sucursales activas - ${response[0].descripcion}`,
            //             html: `
            //                     <table border="2" style="width: 100%;" cellpadding="6">
            //                         <thead>
            //                             <tr>
            //                                 <th>Descripción</th>
            //                                 <th>Referencia</th>
            //                                 <th>Stock</th>
            //                                 <th>Posición</th>
            //                                 <th>Sucursal</th>
            //                             </tr>
            //                         </thead>
            //                         <tbody>
            //                             ${tr}
            //                         </tbody>
            //                     </table>`,
            //             width: "800px",
            //             confirmButtonColor: "#5cb85c",
            //             cancelButtonColor: "#d33",
            //             confirmButtonText: "Continuar!",
            //         });
            //     },
            // });
        });
        //Evento para los historiales de entradas de un producto
        $(document).on("click", ".btnHistorialMovimientos", function () {
            let idproducto = $(this).attr("idproducto");
            cargarTablaHistorial(idproducto);
        });
        //EVENTO que verifica la sucursal y un producto para saber el stock actual
        $(document).on("change", "#sucursal", function () {
            ubicarProducto();
        });
        //BOTON editar, para ver datos del producto en tabla inventario y tabla productos
        $(document).on("click", ".btnEditar", function () {
            let idproducto = $(this).attr("idproducto");

            var datos = new FormData();
            datos.append("DatosProducto", "ok");
            datos.append("item", "idproducto");
            datos.append("valor", idproducto);

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        icon: "info",
                        title: "Cargando producto.",
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            setTimeout(() => {
                                $("#modal-productos").scrollTop(0);
                            }, 300);
                        }
                    });
                    cargarDatosProducto(response[0]);
                },
            });
        });

        $(document).on("click", ".btnEditarMovimiento", function () {
            let idmovimiento = $(this).attr("idmovimiento");
            let proveedores = $("#proveedor").html();
            let observaciones, factura;
            let idproducto = $(this).attr("idproducto");

            var datos = new FormData();
            datos.append("datosMovimiento", "ok");
            datos.append("idmovimiento", idmovimiento);

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.observaciones == null) {
                        observaciones = "";
                    } else {
                        observaciones = response.observaciones;
                    }
                    if (response.facturacompra == null) {
                        factura = "";
                    } else {
                        factura = response.facturacompra;
                    }
                    if (response != "") {
                        Swal.fire({
                            title: `Editar movimiento - (${idmovimiento})`,
                            html: `
                            <hr>
                            <form id="formularioEditarMovimiento" method="post" enctype="multipart/form-data">
                            <label class="text-sm">Proveedor</label>
                            <select class="form-control" id="proveedorMovimiento" name="proveedorMovimiento">${proveedores}</select>
                            <label class="text-sm">Precio de compra</label>
                            <input class="form-control" id="preciocompra" name="preciocompra" type="number" value="${response.preciocompra}">
                            <label class="text-sm">Factura de compra</label>
                            <input class="form-control" id="facturacompra" name="facturacompra" type="text" value="${factura}">
                            <label class="text-sm">Observaciones</label>
                            <input class="form-control" id="observaciones" name="observaciones" type="text" value="${observaciones}">
                            <label><br></label>
                            </form>
                            <hr>`,
                            showConfirmButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Actualizar",
                            confirmButtonColor: "#33cc33",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                        }).then((result) => {
                            if (result.value) {
                                var datosAjax = new FormData();
                                var datosFrm = $(
                                    "#formularioEditarMovimiento"
                                ).serializeArray();

                                datosAjax.append("editarMovimiento", "ok");
                                datosAjax.append("idmovimiento", idmovimiento);

                                datosFrm.forEach((element) => {
                                    datosAjax.append(
                                        element.name,
                                        element.value
                                    );
                                });

                                $.ajax({
                                    type: "POST",
                                    url: `${urlPagina}ajax/almacen.ajax.php`,
                                    data: datosAjax,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    //dataType: "json",
                                    success: function (response) {
                                        if (response == "ok") {
                                            Swal.fire({
                                                icon: "success",
                                                showConfirmButton: true,
                                                title: "Se ha actualizado el movimiento correctamente.",
                                                confirmButtonText: "¡Cerrar!",
                                                allowOutsideClick: false,
                                            });
                                            cargarTablaHistorial(idproducto);
                                        } else {
                                            Swal.fire({
                                                icon: "error",
                                                showConfirmButton: true,
                                                title: "Problema al actualizar el movimiento",
                                                confirmButtonText: "¡Cerrar!",
                                                allowOutsideClick: false,
                                            });
                                        }
                                    },
                                });
                            }
                        });
                        setTimeout(() => {
                            $("#proveedorMovimiento").val(response.idproveedor);
                        }, 1000);
                    }
                },
            });
        });

        $(document).on("click", ".btnEditarInventario", function () {
            let idinventario = $(this).attr("idinventario");
            let idproducto = $(this).attr("idproducto");

            var datos = new FormData();
            datos.append("datosInventario", "ok");
            datos.append("idinventario", idinventario);

            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response != "") {
                        Swal.fire({
                            title: `Editar inventario - (${idinventario})`,
                            html: `
                            <hr class="bg-success">
                            <form id="formularioEditarInventario" method="post" enctype="multipart/form-data">

                            <div class="row">
                            
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Producto</i> <i class="fas fa-tag"></i></label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="${response.descripcion}" readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Referencia</i> <i class="fas fa-bars"></i></label>
                                        <input type="text" class="form-control" id="referencia" name="referencia" value="${response.referencia}" readonly>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="form-group text-center">
                                        <label><i>Sucursal</i> <i class="fas fa-map-marker-alt"></i></label>
                                        <input type="text" class="form-control" id="referencia" name="referencia" value="${response.sucursal}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label class="text-sm">Posición</label>
                            <input class="form-control" id="posicion" name="posicion" type="text" value="${response.posicion}"></input>
                            <label class="text-sm">Stock</label>
                            <input class="form-control" id="stock" name="stock" type="number" value="${response.stock}">
                            <label class="text-sm">Observaciones</label>
                            <textarea class="form-control" id="observacionesEdit" name="observaciones" type="text" required></textarea>
                            </form>
                            <hr>`,
                            showConfirmButton: true,
                            showCancelButton: true,
                            confirmButtonText: "Actualizar",
                            confirmButtonColor: "#33cc33",
                            cancelButtonColor: "#d33",
                            cancelButtonText: "Cancelar",
                        }).then((result) => {
                            if (result.value) {
                                if ($("#observacionesEdit").val() == "") {
                                    Swal.fire({
                                        icon: "warning",
                                        showConfirmButton: true,
                                        title: "Se deben diligenciar todos los campos",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                    });
                                } else {
                                    var datosAjax = new FormData();
                                    var datosFrm = $(
                                        "#formularioEditarInventario"
                                    ).serializeArray();

                                    datosAjax.append(
                                        "modificarInventario",
                                        "ok"
                                    );
                                    datosAjax.append(
                                        "idinventario",
                                        idinventario
                                    );

                                    datosFrm.forEach((element) => {
                                        datosAjax.append(
                                            element.name,
                                            element.value
                                        );
                                    });

                                    $.ajax({
                                        type: "POST",
                                        url: `${urlPagina}ajax/almacen.ajax.php`,
                                        data: datosAjax,
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        //dataType: "json",
                                        success: function (response) {
                                            if (response == "ok") {
                                                Swal.fire({
                                                    icon: "success",
                                                    showConfirmButton: true,
                                                    title: "Se ha actualizado el inventario correctamente.",
                                                    confirmButtonText:
                                                        "¡Cerrar!",
                                                    allowOutsideClick: false,
                                                });
                                                cargarTablaSucursales(
                                                    idproducto
                                                );
                                            } else {
                                                Swal.fire({
                                                    icon: "error",
                                                    showConfirmButton: true,
                                                    title: "Problema al actualizar el inventario",
                                                    confirmButtonText:
                                                        "¡Cerrar!",
                                                    allowOutsideClick: false,
                                                });
                                            }
                                        },
                                    });
                                }
                            }
                        });
                    }
                },
            });
        });
        //NUEVA REFERENCIA PRODUCTO EXISTENTE
        $(".btn_nuevaReferencia").on("click", function (e) {
            e.preventDefault();

            $("#id_producto").val("");

            var datosAjax = new FormData();
            datosAjax.append("AgregarProducto", "ok");

            var datosFrm = $("#formulario_producto").serializeArray();

            datosFrm.forEach((element) => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: "post",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != "") {
                        Swal.fire({
                            icon: "success",
                            title: "Se creó el producto exitosamente!",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        //GUARDAR ID para agregar al inventario
                        $("#id_producto").val(response);
                        $("#titulo_producto").html("Nueva referencia");
                        //RECARGAR TABLA PRODUCTOS
                        cargarTablaProductos();
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Error al crear el producto",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        $(".input_inventario").attr("readonly", true);
                    }
                },
            });
        });
        //btn que hace abrir el collapse de la tabla de productos
        $(".btn_ver_productos").on("click", function () {
            $("#card_productos").CardWidget("expand");
        });
        //FUNCION para cargar los datos del select
        const cargarSelect = (nombre) => {
            let datos = new FormData();
            datos.append("cargarselect", "ok");
            datos.append("nombreSelect", nombre);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $(`#${nombre}`).html(response);
                    } else {
                        $(`#${nombre}`).html("");
                    }
                },
            });
        };
        //FUNCION para cargar los datos del select proveedor
        const cargarSelectProveedor = () => {
            let datos = new FormData();
            datos.append("cargarselectProveedor", "ok");
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/compras.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#proveedor").html(response);
                    } else {
                        $("#proveedor").html("");
                    }
                },
            });
        };
        //FUNCION para cargar los datos del producto
        const cargarDatosProducto = (response) => {
            $("#titulo_producto").html(
                "<i class='fas fa-eye'></i> Visualizando: " +
                    "<u>" +
                    response.descripcion +
                    "</u>" +
                    " - " +
                    "<u>" +
                    response.referencia +
                    "</u>" +
                    " - " +
                    "<u>" +
                    response.categoria +
                    "</u>"
            );
            $("#titulo_producto").addClass("badge badge-light");
            $("#formulario_producto").trigger("reset");
            $(".btn_agregarProducto").hide();
            $(".btn_actualizarProducto").removeClass("d-none");
            $(".btn_nuevaReferencia").removeClass("d-none");
            $(".input_inventario").attr("readonly", false);

            $("#id_producto").val(response.idproducto);
            $("#cod_producto").val(response.codigo);
            $("#referencia").val(response.referencia);
            $("#descripcion_prod").val(response.descripcion);
            $("#categoria").val(response.idcategoria);
            $("#marca").val(response.idmarca);
            $("#medida").val(response.idmedida);

            // llamar funcion Ubicar
            ubicarProducto();
        };
        //FUNCION para cargar el body de la tabla productos
        const cargarTablaProductos = () => {
            let datos = new FormData();
            // Quitar datatable
            $(`#tabla_productos`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody_productos`).html("");
            datos.append("CargarTablaProductos", "ok");
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbody_productos").html(response);
                    } else {
                        $("#tbody_productos").html("");
                    }
                    var buttons = [
                        {
                            extend: "excel",
                            className: "btn-info",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tabla_productos`, buttons);
                },
            });
        };
        //FUNCION para cargar el body de la tabla inventario
        const cargarTablaInventario = () => {
            let datos = new FormData();
            // Quitar datatable
            $(`#tabla_inventario`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody_inventario`).html("");
            datos.append("CargarTablaInventario", "ok");
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbody_inventario").html(response);
                    } else {
                        $("#tbody_inventario").html("");
                    }
                    var buttons = [
                        {
                            extend: "excel",
                            className: "btn-info",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tabla_inventario`, buttons);
                },
            });
        };
        //FUNCION para cargar el body de la tabla historial de movimientos
        const cargarTablaHistorial = (idproducto) => {
            let datos = new FormData();
            // Quitar datatable
            $(`#tabla_historial`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody_historial`).html("");
            datos.append("CargarTablaHistorial", "ok");
            datos.append("idproducto", idproducto);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbody_historial").html(response);
                    } else {
                        $("#tbody_historial").html("");
                    }
                    var buttons = [
                        {
                            extend: "excel",
                            className: "btn-info",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tabla_historial`, buttons);
                },
            });
        };
        //FUNCION para cargar el body de la tabla de sucursales de un producto
        const cargarTablaSucursales = (idproducto) => {
            let datos = new FormData();
            // Quitar datatable
            $(`#tabla_sucursales`).dataTable().fnDestroy();
            // Borrar datos
            $(`#tbody_sucursales`).html("");
            datos.append("CargarTablaSucursales", "ok");
            datos.append("idproducto", idproducto);
            $.ajax({
                type: "POST",
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                // dataType: "json",
                success: function (response) {
                    if (response != "" || response != null) {
                        $("#tbody_sucursales").html(response);
                    } else {
                        $("#tbody_sucursales").html("");
                    }
                    var buttons = [
                        {
                            extend: "excel",
                            className: "btn-info",
                            text: '<i class="far fa-file-excel"></i> Exportar',
                        },
                    ];
                    var table = dataTableCustom(`#tabla_sucursales`, buttons);
                },
            });
        };
        //FUNCION para ubicar la sucursal de un producto y mostrar su stock actual
        const ubicarProducto = () => {
            var sucursal = $("#sucursal").val();
            var idproducto = $("#id_producto").val();

            if (idproducto != "" && sucursal != "") {
                var datos = new FormData();
                datos.append("ubicarProducto", "ok");
                datos.append("idproducto", idproducto);
                datos.append("idsucursal", sucursal);

                $.ajax({
                    type: "post",
                    url: `${urlPagina}ajax/almacen.ajax.php`,
                    data: datos,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response != false) {
                            $("#posicion").val(response.posicion);

                            Swal.fire({
                                title:
                                    "Producto: " +
                                    response.descripcion +
                                    " Código: " +
                                    response.codigo,
                                html:
                                    "<hr><h4>En la sucursal de: <strong>" +
                                    response.sucursal +
                                    "</strong>" +
                                    " tiene un stock actual de: <strong>" +
                                    response.stock +
                                    "</strong></h4><hr>",
                                showConfirmButton: false,
                                timer: 2500,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (
                                    result.dismiss === Swal.DismissReason.timer
                                ) {
                                    setTimeout(() => {
                                        $("#modal-productos").scrollTop(0);
                                    }, 300);
                                }
                            });
                        }
                    },
                });
            }
        };
    }
});
