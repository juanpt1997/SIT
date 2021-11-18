$(document).ready(function () {
    /* ===================================================
        * INVENTARIO
    ===================================================*/
    if (
        window.location.href == `${urlPagina}a-inventario/` ||
        window.location.href == `${urlPagina}a-inventario`
    ) {
        $(document).on("shown.bs.modal", "#modal-productos", function () {
            cargarSelect('categoria');
            cargarSelect('medida');
            cargarSelect('marca');
            cargarSelect('sucursal');
            cargarSelectProveedor();
            //$(".select2-single").select2("readonly", true);
            // $('.input-sucursal').select2({
            //     disabled: true
            //   });

            //   $('.input-proveedor').select({
            //     disabled: true
            //   });
        });

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

     
    }
});
