$(document).ready(function () {
    /* ===================================================
        * FUEC
    ===================================================*/
    if (window.location.href == `${urlPagina}contratos-fuec/` ||
        window.location.href == `${urlPagina}contratos-fuec`
    ) {

        /* ===================================================
          VISUALIZAR PDF DEL FUEC
        ===================================================*/
        $(document).on("click", ".btn-FTFuec", function () {
            var idfuec = $(this).attr("idfuec");
            window.open(`./pdf/pdffuec.php?idfuec=${idfuec}`, '', 'width=1280,height=720,left=50,top=50,toolbar=yes');
        });

        /* ===================================================
          DETECTA CAMIO EN TIPO DE CONTRATO
        ===================================================*/
        $(document).on("change", "#tipocontrato", function () {
            var tipocontrato = $(this).val();
            
            // Si el tipo contrato es igual a fijo, oculta los campos contratante
            if (tipocontrato == "FIJO"){
                $("#colContratoFijo").removeClass("d-none");
                $("#contratofijo").attr("required", "required");
                
                $(".row-cliente").addClass("d-none");
                $("#colContratante").addClass("d-none");
                $("#contratante").val("");
                $("#contratante").removeAttr("required");
                $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT
            }else{
                if (tipocontrato == "OCASIONAL"){
                    $("#colContratoFijo").addClass("d-none");
                    $("#contratofijo").val("");
                    $("#contratofijo").removeAttr("required");
                    
                    $(".row-cliente").removeClass("d-none");
                    $("#colContratante").removeClass("d-none");
                    $("#contratante").attr("required", "required");
                    $('.select2-single').trigger('change'); //MUESTRA EL VALOR DEL SELECT
                }
            }
        });
    }
});