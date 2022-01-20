// let map;
// let marcadores = [];

// const CrearMarcador = (coord, nombre) => {
//     let html = nombre;

//     const marcador = new google.maps.Marker({
//         position: coord,
//         map: map,
//       });

//       const infowindow = new google.maps.InfoWindow({
//         content: html,
//       });

//     google.maps.event.addListener(marcador, "click", () => {
//         infowindow.open({
//             anchor: marcador,
//             map: map,
//             shouldFocus: false,
//         });

//     });

//     marcadores.push(marcador);
// };

// let lugares = [
//     {
//         name: "Oficina",
//         lat: 4.831005177695691,
//         lng: -75.69797583132306,
//         address: "Entrada la graciela, vía el pollo",
//         phone: "321284891",
//     },
//     {
//         name: "Avenida Regional",
//         lat: 6.250736407386298,
//         lng: -75.57878098613203,
//         address: "Avenida Regional, Medellín",
//         phone: "3235235234",
//     },
//     {
//         name: "Museo botero",
//         lat: 4.597265695257339,
//         lng: -74.07183358128225,
//         address: "Museo Botero, Bogotá",
//         phone: "38292342",
//     },
//     {
//         name: "Zoologico barranquilla",
//         lat: 11.01413540162625,
//         lng: -74.79724977164044,
//         address: "Zoologico, Barranquilla",
//         phone: "38292342",
//     },
//     {
//         name: "Universidad cartagena",
//         lat: 10.388477573044046,
//         lng: -75.4664233226174,
//         address: "Universidad de san Buenaventura, Cartagena",
//         phone: "38292342",
//     },
//     {
//         name: "Makro",
//         lat: 4.823824652394727,
//         lng: -75.68443182550892,
//         address: "Makro, Pereira",
//         phone: "39354334",
//     },
//     {
//         name: "Santa Monica",
//         lat: 4.825150314541477,
//         lng: -75.6790244924601,
//         address: "Hospital Santa Monica, Dosquebradas",
//         phone: "234234234",
//     },
// ];

// //RECORRE LUGARES Y CREA MARCADORES
// const MarcarLugares = () => {
//     lugares.forEach((element) => {
//         let coord = new google.maps.LatLng(element.lat, element.lng);
//         let nombre = element.name;
//         CrearMarcador(coord, nombre);
//         // console.log(element);
//     });
// };

// // MarcarLugares();
// //Inicializa el mapa
// function initMap() {
//     let oficina = { lat: 4.831005177695691, lng: -75.69797583132306 };

//     map = new google.maps.Map(document.getElementById("map"), {
//         center: oficina,
//         zoom: 17,
//         mapId: "768187b9c45dab96", //Id del mapa que se personaliza a través de la plataforma de google, se debe agregar como otra variable en el script de la api,antes del callback
//     });

//     MarcarLugares();
//     const marker = new google.maps.Marker({
//         position: oficina,
//         map: map,
//         // icon: "/bus.png"
//     });

//     const infowindow = new google.maps.InfoWindow({
//       content: "Oficina",
//     });

//     google.maps.event.addListener(marker, "click", () => {
//       infowindow.open({
//           anchor: marker,
//           map: map,
//           shouldFocus: false,
//       });
//     })

//     const flightPlanCoordinates = [
//       { lat: 4.831005177695691, lng: -75.69797583132306 },
//       { lat: 21.291, lng: -157.821 },
//       { lat: -18.142, lng: 178.431 },
//       { lat: -27.467, lng: 153.027 },
//     ];
//     const flightPath = new google.maps.Polyline({
//       path: flightPlanCoordinates,
//       geodesic: true,
//       strokeColor: "#FF0000",
//       strokeOpacity: 1.0,
//       strokeWeight: 2,
//     });

//     flightPath.setMap(map);
// }

//ACESS TOKERN
//  //styles/jhojaaan/ckybqcm1c4rf314p9s2wampox   pk.eyJ1IjoiamhvamFhYW4iLCJhIjoiY2t5YnFnenQ0MGh1NDJ2bXJuNHAyYzNwNyJ9.G2RDhoh0k89zZdQCJIdZMw

if (
    window.location.href == `${urlPagina}tr-gps/` ||
    window.location.href == `${urlPagina}tr-gps`
) {
    // Estilo de mapa 1: ckybqcm1c4rf314p9s2wampox
    // // Estilo de mapa 2: ckybriueb1y4y14pejl9edlxv
    // var map = L.map('map').setView([4.814496008354692, -75.69285895928363], 13); //Inicializamos el mapa [Coordenadas], zoom

    var map = L.map("map", {
        center: [4.814496008354692, -75.69285895928363],
        zoom: 13,
        zoomControl: false,
        attributionControl: false,
    });
    L.control
        .zoom({
            position: "bottomleft",
            zoomInTitle: "Zoom",
            zoomOutTitle: "Zoom",
        })
        .addTo(map);

    /*============================================
            FUNCIÓN QUE CARGA EL MAPA
        ==============================================*/
    const iniciar_mapa = () => {
        L.tileLayer(
            "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}",
            {
                attribution:
                    'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 17,
                id: "jhojaaan/ckybriueb1y4y14pejl9edlxv",
                tileSize: 512,
                zoomOffset: -1,
                accessToken:
                    "pk.eyJ1IjoiamhvamFhYW4iLCJhIjoiY2t5YnFnenQ0MGh1NDJ2bXJuNHAyYzNwNyJ9.G2RDhoh0k89zZdQCJIdZMw",
            }
        ).addTo(map);


            L.circle([4.814496008354692, -75.69285895928363], {radius: 200}).addTo(map);

        //Botones con funcionalidades
        L.control
            .custom({
                position: "topright",
                content:
                    '<button type="button" class="btn btn-default">' +
                    '    <i class="fa fa-crosshairs"></i>' +
                    "</button>" +
                    '<button type="button" class="btn btn-info">' +
                    '    <i class="fa fa-compass"></i>' +
                    "</button>" +
                    '<button type="button" class="btn btn-primary">' +
                    '    <i class="fa fa-spinner fa-pulse fa-fw"></i>' +
                    "</button>" +
                    '<button type="button" class="btn btn-danger">' +
                    '    <i class="fa fa-times"></i>' +
                    "</button>" +
                    '<button type="button" class="btn btn-success">' +
                    '    <i class="fa fa-check"></i>' +
                    "</button>" +
                    '<button type="button" class="btn btn-warning">' +
                    '    <i class="fa fa-exclamation-triangle"></i>' +
                    "</button>",
                classes: "btn-group-vertical btn-group-sm",
                style: {
                    margin: "10px",
                    padding: "0px 0 0 0",
                    cursor: "pointer",
                },
                // datas   :
                // {
                //     'foo': 'bar',
                // },
                // events:
                // {
                //     click: function(data)
                //     {
                //         console.log('wrapper div element clicked');
                //         console.log(data);
                //     },
                //     dblclick: function(data)
                //     {
                //         console.log('wrapper div element dblclicked');
                //         console.log(data);
                //     },
                //     contextmenu: function(data)
                //     {
                //         console.log('wrapper div element contextmenu');
                //         console.log(data);
                //     },
                // }
            })
            .addTo(map);

        //LISTA DE VEHÍCULOS
        L.control
            .custom({
                position: "topleft",
                content:
                    ' <div class="card card-success collapsed-card">' +
                    '    <div class="card-header" data-card-widget="collapse" style="cursor: pointer;">' +
                    '<h3 class="card-title"><b><i>Vehículos </i></b>' +
                    '<i class="fas fa-car-alt"></i>' +
                    "</h3>" +
                    '<div class="card-tools">' +
                    '<button type="button" title="Lista de vehículos"  data-toggle="tooltip" data-placement="top" class="btn btn-tool" data-card-widget="collapse">' +
                    '    <i class="fas fa-plus"></i>' +
                    "</button>" +
                    "</div>" +
                    "    </div>" +
                    '<div class="card-body">' +
                    '<div class="table-responsive mt-2">' +
                    '<table id="tablaVehiculos" class="table table-sm table-striped table-bordered dt-responsive table-hover tablas w-100">' +
                    '<thead class="thead-light text-sm text-center">' +
                    "<tr>" +
                    "<th>Acciones</th>" +
                    "<th>Vehículo</th>" +
                    "</tr>" +
                    "</thead>" +
                    '<tbody id="tbodyVehiculos" class="text-center">' +
                    "</tbody>" +
                    "</table>" +
                    "</div>" +
                    "</div>" +
                    "</div>",
                classes: "",
                style: {
                    margin: "10px",
                    padding: "0px 0 0 0",
                    cursor: "pointer",
                    width: "220px",
                },
                datas: {
                    foo: "bar",
                },
                // events:
                // {
                //     click: function(data)
                //     {
                //         console.log('wrapper div element clicked');
                //         console.log(data);
                //     },
                //     dblclick: function(data)
                //     {
                //         console.log('wrapper div element dblclicked');
                //         console.log(data);
                //     },
                //     contextmenu: function(data)
                //     {
                //         console.log('wrapper div element contextmenu');
                //         console.log(data);
                //     },
                // }
            })
            .addTo(map);
    };

    iniciar_mapa();

    /*============================================
            MARCADOR PERSONALIZADO
        ==============================================*/
    var custom_marker = L.icon({
        iconUrl: "../elsaman/views/img/imgTracker/coche.png", //../views/img/plantilla/plantillapdf.png
        iconSize: [70, 71],
        iconAnchor: [22, 61],
    });

    /*============================================
            CARGAR MARCADORES 
        ==============================================*/
    const marcadores = (Vehiculo) => {
        marcadores_Vehiculo = [];

        Vehiculo.forEach((element, index) => {
            var vehiculo = L.marker([element.lat, element.lng], {
                icon: custom_marker,
            })
                .bindPopup(`<p>Vehículo:<strong> <span class="bg-warning border border-dark text-dark p-1"> ${element.placa}</span></strong></p>
                         <p><strong>Nivel de combustible:</strong> Bajo</p>
                         <p><strong>Velocidad: </strong> 68 km/h</p>`);
            marcadores_Vehiculo.push(vehiculo);
        });

        L.layerGroup(marcadores_Vehiculo).addTo(map);
    };

    /*============================================
            LISTA DE VEHÍCULOS
        ==============================================*/
    const lista_vehiculos = (Vehiculo) => {
        // Quitar datatable
        $(`#tablaVehiculos`).dataTable().fnDestroy();
        // Borrar datos
        $(`#tbodyVehiculos`).html("");

        Vehiculo.forEach((element, index) => {
            contenido = `
                            <tr>
                                <td>
                                    <div class='row d-flex flex-nowrap justify-content-center'>
                                        <button type='button' class='btn btn-sm bg-info btn-sm mt-1 btn-ubicarvehiculo ' title='Ubicar vehículo' placa='${element.placa}'><i class="fas fa-map-marker-alt"></i></button>
                                        
                                    </div>
                                </td>
                                <td>${element.placa}</td>
                            </tr>
                                `;

            $("#tbodyVehiculos").append(contenido);
        });
    };

    /*============================================
            UBICAR VEHÍCULO 
        ==============================================*/
    const ubicar_vehiculo = (placa, Vehiculos) => {
        Vehiculos.forEach((element) => {
            if (element.placa == placa) {
                // map.panTo(new L.LatLng(element.lat, element.lng));
                map.flyTo([element.lat, element.lng], 17); //Centramos el mapa
                var popup = L.popup() //Abrimos el popup con la info del vehículo 
                    .setLatLng([element.lat, element.lng])
                    .setContent(
                        `<p>Vehículo:<strong> <span class="bg-warning text-dark p-1 border border-dark"> ${element.placa}</span></strong></p>
                         <p><strong>Nivel de combustible:</strong> Bajo</p>
                         <p><strong>Velocidad: </strong> 68 km/h</p>`
                    )
                    .openOn(map);
            }
        });
    };

    /*============================================
        CLICK EN UBICAR VEHICULO
        ==============================================*/
    $(document).on("click", ".btn-ubicarvehiculo", function () {
        let placa = $(this).attr("placa");
        ubicar_vehiculo(placa, Vehiculos);
    });

    //ARRAY CON INFORMACIÓN DE LOS VEHÍCULOS
    var Vehiculos = [
        {
            placa: "RFK405",
            lat: "4.818690612367718",
            lng: "-75.71297155516983",
        },
        {
            placa: "LGH479",
            lat: "4.814496008354692",
            lng: "-75.69285895928363",
        },
        {
            placa: "PTA748",
            lat: "4.816378727930608",
            lng: "-75.68668972946124",
        },
        {
            placa: "JNE128",
            lat: "4.819435315212369",
            lng: "-75.67460046430203",
        },
        {
            placa: "RTB915",
            lat: "4.834250578428947",
            lng: "-75.67091955371562",
        },
    ];

    marcadores(Vehiculos);
    lista_vehiculos(Vehiculos);


    // L.Routing.control({
    //     waypoints: [
    //         L.latLng(4.818690612367718, -75.71297155516983),
    //         L.latLng(4.816378727930608, -75.68668972946124)
    //         // L.latLng(4.834250578428947, -75.67091955371562)
    //     ],
    //     show: false
    //   }).addTo(map);

  
}
