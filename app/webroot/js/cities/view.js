var FormValidator = function () {
    var longitude = $('#longitude');
    var latitude = $('#latitude');
    var loadAllElements = function () {
        // MAP
        var gMap = new GMaps({
            el: '#map1',
            zoom: 7,
            lat: lati,
            lng: long
        });

        gMap.addMarker({
            lat: lati,
            lng: long
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
        }
    };
}();