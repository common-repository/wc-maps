function client_map_initialize() {
  mapInit(OBJECT.lat, OBJECT.long, true);
}

function mapInit(lat, long, client) {
  var currentPosition = new google.maps.LatLng(lat, long);

  var mapProp = {
    center: currentPosition,
    zoom: 16,
  };

  var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

  var marker = new google.maps.Marker({
    position: mapProp.center,
    map: map,
  });

  if (client) {
    document.getElementById("wcmps_lat").value = lat;
    document.getElementById("wcmps_long").value = long;

    map.addListener("click", (event) => {
      marker.setPosition(event.latLng);
      document.getElementById("wcmps_lat").value = event.latLng.lat;
      document.getElementById("wcmps_long").value = event.latLng.lng;
    });
  }
}

function admin_map_initialize() {
  mapInit(OBJECT.lat, OBJECT.long, false);
}
