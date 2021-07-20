$(document).ready(function () {
    /* ===================================================
        * CLIENTES
    ===================================================*/
    if (window.location.href == `${urlPagina}contratos-clientes/` ||
        window.location.href == `${urlPagina}contratos-clientes`
    ) {
        console.log("clientes");
    }

    /* ===================================================
        * COTIZACIONES
    ===================================================*/
    if (window.location.href == `${urlPagina}contratos-cotizaciones/` ||
        window.location.href == `${urlPagina}contratos-cotizaciones`
    ) {
        console.log("cotizaciones");
    }
});