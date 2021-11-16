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
    }
});
