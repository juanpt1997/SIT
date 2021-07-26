$(document).ready(function () {
    /* ===================================================
        * FUEC
    ===================================================*/
    if (window.location.href == `${urlPagina}contratos-fuec/` ||
        window.location.href == `${urlPagina}contratos-fuec`
    ) {
        $(document).on("click", ".btn-FTFuec", function () {
            var idfuec = $(this).attr("idfuec");
            window.open(`./pdf/pdffuec.php?idfuec=${idfuec}`, '', 'width=1280,height=720,left=50,top=50,toolbar=yes');
        });
    }
});