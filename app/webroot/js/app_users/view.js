var Maps = function (lat, long, name) {
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
    
    var initStars = function(){
        $('.stars').rating({
            step: 0.1,
            readonly: true,
            showClear: false,
            showCaption: false,
            size: 'xs'
        });
    };
    return {
        //main function to initiate template pages
        init: function (lat, long, name) {
            runMaps(lat, long, name);
            initStars();
        }
    };
}();