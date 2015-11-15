var FormValidator = function () {
    var loadAllElements = function () {

        var longitude = $('#longitude');
        var latitude = $('#latitude');
        // MAP
        var gMap = new GMaps({
            el: '#map1',
            zoom: 7,
            lat: 44.138326,
            lng: 17.889540
        });

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

    // FORM VALIDATION	
    var runValidator = function () {

        var $modal = $('#ajax-modal');
        $.fn.modalmanager.defaults.resize = true;
        $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
                '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
                '</div>';

        var form = $('#form_new_location');
        var errorHandler = $('.errorHandler', form);
        var successHandler = $('.successHandler', form);

        form.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            ignore: "",
            rules: {
                "data[City][name]": {
                    minlength: 2,
                    required: true
                },
            },
            messages: {
                "data[City][name]": "Molimo unesite naziv grada",
                "data[Location][address]": {
                    required: "Unesite adresu"
                },
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler.hide();
                errorHandler.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler.show();
                errorHandler.hide();
                form.submit();
            }
        });
    };


    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
            runValidator();
        }
    };
}();