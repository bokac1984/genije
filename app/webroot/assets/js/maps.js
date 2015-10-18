var Maps = function () {
    //function to initiate GMaps
    //Gmaps.js allows you to use the potential of Google Maps in a simple way.
    //For more information, please visit http://hpneo.github.io/gmaps/documentation.html
    var runMaps = function () {
        // Basic Map 
        var longitude = $('#longitude');
        var latitude = $('#latitude');

        var gMap = new GMaps({
            el: '#map5',
            zoom: 14,
            lat: latitude.val(),
            lng: longitude.val()
        });
        addMarker(latitude.val(), longitude.val());

        GMaps.on('click', gMap.map, function (event) {
            var index = gMap.markers.length;
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            if (index == 0) {
                addMarker(lat, lng);
            }
        });

        $("#search_map").click(function (event) {
            GMaps.geocode({
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


        $("#save-location").click(function (event) {
            var btnSave = Ladda.create(document.querySelector("#save-location"));
            btnSave.start();
            var pk = $(this).attr('data-lokacija');
            $.post(
            '/locations/saveLocation', 
            'id=' + pk + '&name=longitude&value=' + longitude.val() + '&name2=latitude&value2=' + latitude.val(), 
            function (data) {
                btnSave.stop();
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
    };
    return {
        //main function to initiate template pages
        init: function () {
            runMaps();
        }
    };
}();