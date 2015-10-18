
function initMap() {
var longitude = $('#longitude');
var latitude = $('#latitude');
// MAP
var gMap = new google.maps.Map({
    el: '#map1',
    zoom: 7,
    lat: 44.138326,
    lng: 17.889540
});

google.maps.Map.on('click', gMap.map, function (event) {
    var index = gMap.markers.length;
    var lat = event.latLng.lat();
    var lng = event.latLng.lng();
    if (index == 0) {
        addMarker(lat, lng);
    }
});

$("#search_map").click(function (event) {
    google.maps.Map.geocode({
        address: $('#address_geocode').val().trim(),
        callback: function (results, status) {
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                gMap.setCenter(latlng.lat(), latlng.lng());
                if (gMap.markers.length == 1) {
                    longitude.attr('value', latlng.lng());
                    latitude.attr('value', latlng.lat());
                    gMap.markers[0].setPosition(new google.maps.LatLng(latlng.lat(), latlng.lng()));
                }
                else
                    addMarker(latlng.lat(), latlng.lng());
            }
        }
    });
});

function addMarker(lat, lng) {
    longitude.attr('value', lng);
    latitude.attr('value', lat);

    gMap.addMarker({
        lat: lat,
        lng: lng,
        tag: 'location_marker',
        draggable: true,
        animation: google.maps.Animation.DROP,
        drag: function (marker) {
            longitude.attr('value', this.position.lng());
            latitude.attr('value', this.position.lat());
        }
    });
}

}
