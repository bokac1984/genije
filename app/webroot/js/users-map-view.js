var PageInitalization = function () {
    var loadAllElements = function () {


        // MAP
        var gMap = new GMaps({
            el: '#map1',
            zoom: 7,
            lat: 44.138326,
            lng: 17.889540,
            markerClusterer: function (map) {
                return new MarkerClusterer(map);
            }
        });


        jQuery.ajax({
            url: '/application_users/users',
            method: 'GET'
        }).done(function (response) {
            console.log('ovdje uradjeno');
            console.log(response);
            gMap.addMarkers(JSON.parse(response));
        }).fail(function () {
            alert('fail');
        });
    };

    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
        }
    };
}();