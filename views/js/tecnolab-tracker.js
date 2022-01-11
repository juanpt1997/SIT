// let map;

// function initMap(){
//     let pereira = {lat: 41.390205, lng: 2.154007}
//     map = new google.maps.Map(document.getElementById("map"),{
//         center: barcelona,
//         zoom: 14
//     })
// }

/* let map;

function initMap() {
map = new google.maps.Map(document.getElementById("map"), {
  center: { lat: 4.831005177695691, lng: -75.69797583132306 },
  zoom: 17,
});
} */

let map;
let marcadores = [];

const CrearMarcador = (coord, nombre) => {
    let html = `<h3>${nombre}</h3>`;

    const marcador = new google.maps.Marker({
        position: coord,
        map: map,
    });

    google.maps.event.addListener(marcador, "click", () => {
        infoWindow.setContent(html);
        infoWindow.open(map, marcador);
    });

    marcadores.push(marcador);
};

let lugares = [
    {
        name: "Oficina",
        lat: 4.831005177695691,
        lng: -75.69797583132306,
        address: "Entrada la graciela, vía el pollo",
        phone: "321284891",
    },
    {
        name: "Avenida_Regional",
        lat: 6.250736407386298,
        lng: -75.57878098613203,
        address: "Avenida Regional, Medellín",
        phone: "3235235234",
    },
    {
        name: "Museo_botero",
        lat: 4.597265695257339,
        lng: -74.07183358128225,
        address: "Museo Botero, Bogotá",
        phone: "38292342",
    },
    {
        name: "Zoologico_barranquilla",
        lat: 11.01413540162625,
        lng: -74.79724977164044,
        address: "Zoologico, Barranquilla",
        phone: "38292342",
    },
    {
        name: "Universidad_cartagena",
        lat: 10.388477573044046,
        lng: -75.4664233226174,
        address: "Universidad de san Buenaventura, Cartagena",
        phone: "38292342",
    },
    {
        name: "Makro",
        lat: 4.823824652394727,
        lng: -75.68443182550892,
        address: "Makro, Pereira",
        phone: "39354334",
    },
    {
        name: "Santa Monica",
        lat: 4.825150314541477,
        lng: -75.6790244924601,
        address: "Hospital Santa Monica, Dosquebradas",
        phone: "234234234",
    },
];

const MarcarLugares = () => {
    lugares.forEach((element) => {
        let coord = new google.maps.LatLng(element.lat, element.lng);
        let nombre = element.name;
        CrearMarcador(coord, nombre);
        // console.log(element);
    });
};

// MarcarLugares();
//Inicializa el mapa
function initMap() {
    let saman = { lat: 4.831005177695691, lng: -75.69797583132306 };

    map = new google.maps.Map(document.getElementById("map"), {
        center: saman,
        zoom: 17,
        mapId: "768187b9c45dab96", //Id del mapa que se personaliza a través de la plataforma de google, se debe agregar como otra variable en el script de la api,antes del callback
    });

    MarcarLugares();
    const marker = new google.maps.Marker({
        position: saman,
        map: map,
        // icon: "/bus.png"
    });
}
