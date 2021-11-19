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
            datosAjax.append('AgregarProducto', "ok");
            var datosFrm = $(this).serializeArray();
            
            datosFrm.forEach(element => {
                datosAjax.append(element.name, element.value);
            });

            $.ajax({
                type: 'post',
                url: `${urlPagina}ajax/almacen.ajax.php`,
                data: datosAjax,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se creó el producto exitosamente!',						
                        showConfirmButton: false,
                        timer: 1000                       
                    })
                }
            });
        });
        //SUBMIT del formulario que agrega un producto y retorna el id del producto
        $("#formulario_addInventario").submit(function (e) {
            e.preventDefault();

            var idproducto = $("#producto").val();
            var idsucursal = $("#sucursal").val();
            var stock = $("#cantidad").val();
            var proveedor = $("#proveedor").val();
            var precio = $("#precio-compra-producto").val();
            var factura = $("#num_factura").val();
            

            if(idproducto != ""){

                var datosAjax = new FormData();
                datosAjax.append('AgregarInventario', "ok");
                datosAjax.append('producto',idproducto);
                datosAjax.append('sucursal',idsucursal);
                datosAjax.append('cantidad',stock);
            
                $.ajax({
                    type: 'post',
                    url: `${urlPagina}ajax/almacen.ajax.php`,
                    data: datosAjax,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if(response != "" && response != null){
                            Swal.fire({
                                icon: 'success',
                                title: 'Se agregó el producto correctamente al inventario!',						
                                showConfirmButton: false,
                                timer: 2500                       
                            })
                            var id_inventario = response;
                            //AJAX MOVIMIENTO
                            var datos = new FormData();
                            datos.append('RegistrarMovimiento', "ok");
                            datos.append('idinventario', id_inventario);
                            datos.append('cantidad', stock);
                            datos.append('tipo_movimiento', "ENTRADA");
                            datos.append('preciocompra', precio);
                            datos.append('idproveedor', proveedor);
                            datos.append('facturacompra', factura);

                            $.ajax({
                                type: 'post',
                                url: `${urlPagina}ajax/almacen.ajax.php`,
                                data: datos,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    console.log(response);
                                }
                            });
                        }
                    }
                });
                }else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Seleccione un producto',						
                        showConfirmButton: false,
                        timer: 1000                       
                    })
                }
        });
        //EVENTO AL ABRIR EL MODAL DE PRODUCTOS CARGA LOS DATOS DE LOS SELECT(proveedor, marca, medida,categoria,sucursales)
        $(document).on("shown.bs.modal", "#modal-productos", function () {
            cargarSelect('categoria');
            cargarSelect('medida');
            cargarSelect('marca');
            cargarSelect('sucursal');
            cargarSelect('producto');
            cargarSelectProveedor();
            $("#formulario_producto").trigger("reset");
            $("#formulario_addInventario").trigger("reset");
            $("#id_producto").val("");
            $(".btn_agregarProducto").show();
            $(".btn_actualizarProducto").addClass("d-none");
            $(".btn_nuevaReferencia").addClass("d-none");
        });
        //EVENTO al salir del input de codigo, busca si ese codigo existe y se trae los datos del producto con ese codigo 
        $(document).on("blur", "#cod_producto", function () {
            
                if (true/* $("#id_producto").val() == ""  */) {
                    
                    var datos = new FormData();
                    datos.append('DatosProducto', "ok");
                    datos.append('item', 'codigo');
                    datos.append('valor', $(this).val());
    
                    $.ajax({
                        type: 'post',
                        url: `${urlPagina}ajax/almacen.ajax.php`,
                        data: datos,
                        dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            if (response != "") {
                                $("#formulario_producto").trigger("reset");
                                $(".btn_agregarProducto").hide();
                                $(".btn_actualizarProducto").removeClass("d-none");
                                $(".btn_nuevaReferencia").removeClass("d-none");
                                cargarDatosProducto(response);
                            }
                            else{
                                // $(".btn_agregarProducto").show();
                                // $(".btn_actualizarProducto").addClass("d-none");
                                // $(".btn_nuevaReferencia").addClass("d-none");
                            }
                        }
                    });      
                }
            
        });
        //HABILITAR CAMPOS DEL PRODUCTO SI SE SELECCIONA UNO
        $(document).on("change", "#producto", function () {
            var idproducto = $(this).val();

            if(idproducto != ""){
                //$("id_producto").val(idproducto);
                $(".input_inventario").attr("readonly", false);
            }else{
                //$("id_producto").val("");
                $(".input_inventario").attr("readonly", true);
            }
        });
        //ACTUALIZAR PRODUCTO EXISTENTE
        $(document).on("click", ".btn_actualizarProducto", function () {

            var idproducto = $("#id_producto").val();
            alert(idproducto);
            



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
            $("#id_producto").val(response.idproducto);
            $("#cod_producto").val(response.codigo);
            $("#referencia").val(response.referencia);
            $("#descripcion_prod").val(response.descripcion);
            $("#categoria").val(response.idcategoria);
            $("#marca").val(response.idmarca);
            $("#medida").val(response.idmedida);
        };
    }
});
