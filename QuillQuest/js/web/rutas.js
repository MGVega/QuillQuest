let map;

function initMap() {

  /*map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: { lat: -28, lng: 137 },
  });
  // NOTE: This uses cross-domain XHR, and may not work on older browsers.
  map.data.loadGeoJson(
    "https://storage.googleapis.com/mapsdevsite/json/google.json"
  );*/
    
    leerRuta();
    
    //alert('hola');
    
}

//initMap();


function leerRuta(){
    
    var params = new Object();
    params.controller = 'rutasController';
    params.function = 'leerRuta';
    params.ruta_id = $('#ruta_id').val();

    var values = JSON.stringify(params);
    sendToServer(values, dibujarRuta);
    
    
}

function dibujarRuta(Data) {

    var rutas = JSON.parse(Data.result);
    console.log(rutas);

    const map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: rutas.center_lat, lng: rutas.center_lng},
        zoom: 14,
        mapTypeId: 'hybrid',
        streetViewControl: true,
    });
    
    const dibujarRuta = new google.maps.Polyline({
        path: rutas.polylines,
        geodesic: true,
        strokeColor: "#F3B308",
        strokeOpacity: 1.0,
        strokeWeight: 2,
    });
    
    dibujarRuta.setMap(map);
    
    // Create an info window to share between markers.
    const infoWindow = new google.maps.InfoWindow();

    // Create the markers.
    var points = rutas.points;
    points.forEach(({ position, title }, i) => {

        const marker = new google.maps.Marker({
            position,
            map,
            title: title,
        });

        // Add a click listener for each marker, and set up the info window.
        marker.addListener("click", ({ domEvent, latLng }) => {
            const {target} = domEvent;

            infoWindow.close();
            infoWindow.setContent(marker.title);
            infoWindow.open(marker.map, marker);
        });
    });


    
}