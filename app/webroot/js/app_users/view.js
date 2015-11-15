var Maps = function (lat, long, name) {
    //function to initiate GMaps
    //Gmaps.js allows you to use the potential of Google Maps in a simple way.
    //For more information, please visit http://hpneo.github.io/gmaps/documentation.html
    var runMaps = function (lat, long, name) {
        //Markers
        map2 = new GMaps({
            div: '#map2',
            lat: lat,
            lng: long
        });
        map2.addMarker({
            lat: lat,
            lng: long,
            title: 'Marker with InfoWindow',
            height: '200px',
            infoWindow: {
                content: '<p>'+ name +'</p>'
            }
        });
    };
    return {
        //main function to initiate template pages
        init: function (lat, long, name) {
            runMaps(lat, long, name);
        }
    };
}();