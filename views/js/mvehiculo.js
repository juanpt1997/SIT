
if (window.location.href == `${urlPagina}mv-vehiculos/` ||
    window.location.href == `${urlPagina}mv-vehiculos`
) {
    $(document).ready(function () {


        /* ===================================================
            CARGAR DATOS DEL VEHICULO
        ===================================================*/
           //Initialize Select2 Elements
            $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
             $('.select2').select2()

                          //Timepicker
              
    
          $("#example1").on("click", "#vehiculo", function(e) 
       {
                  var filaactual = $(this).closest("tr"); // obtiene la fila actual
                  var placa = filaactual.find("td:eq(1)").text(); // obtiene el valor del primer TD de la fila actual
                  var numint = filaactual.find("td:eq(2)").text();
                  var documento = filaactual.find("td:eq(3)").text();
                  var nombre = filaactual.find("td:eq(4)").text();
                  var tiodoc=filaactual.find("td:eq(5)").text();
                  var marca=filaactual.find("td:eq(6)").text();
                  var modelo=filaactual.find("td:eq(7)").text();
                  console.log(placa)
                   $("#placa").val(placa);
                   $("#nuemroin").val(numint); 
                   $("#documento").val(documento);
                    $("#nombre").val(nombre);
                    $("#precioventam").val(prev);
                   //  $("#id").val(id);

                 // var val =  parseFloat(costo) * parseInt(cantidad);
                
                 
                  
                           
             })
      })
    }
    