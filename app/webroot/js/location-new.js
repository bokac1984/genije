var FormValidator = function () {
    var loadAllElements = function () {



        $("#sub_types").select2({
            placeholder: "Izaberite tip lokacije",
            allowClear: true
        });

        $('.limited').inputlimiter({
            remText: 'Preostalo je %n karaktera za unos...',
            remFullText: 'Dostigli ste limit polja!',
            limitText: 'U polje je dozvoljeno unijeti %n karaktera.'
        });

        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });

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

        // KNOB
        $(".knob").knob({
            draw: function () {
                // "tron" case
                if (this.$.data('skin') == 'tron') {
                    var a = this.angle(this.cv) // Angle
                            ,
                            sa = this.startAngle // Previous start angle
                            ,
                            sat = this.startAngle // Start angle
                            ,
                            ea // Previous end angle
                            , eat = sat + a // End angle
                            ,
                            r = true;
                    this.g.lineWidth = this.lineWidth;
                    this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();
                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();
                    return false;
                }
            }
        });

        $('#city_id').change(function () {
            var res = $('#address_geocode').val().split(",");
            var city = $(this).find("option[value='" + $(this).val() + "']").text();
            if (res.length == 2)
                $('#address_geocode').val(city + ', ' + res[1]);
            else
                $('#address_geocode').val(city + ', ');
        });

        $('#address').change(function () {
            var address = $(this).val();
            var res = $('#address_geocode').val().split(",");
            if (res.length === 2)
                $('#address_geocode').val(res[0] + ', ' + address);
            else
                $('#address_geocode').val(address);
        });
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

        $.validator.addMethod("getEditorValue", function () {
            $("#html_text").val($('.summernote').code());
            if ($("#html_text").val() !== "" && $("#html_text").val() !== "<br>") {
                $('#html_text').val('');
                return true;
            } else {
                return false;
            }
        }, 'Molimo unesite detaljan info o lokaciji.');

        form.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            ignore: "",
            rules: {
                "data[Location][name]": {
                    minlength: 2,
                    required: true
                },
                "data[Location][fk_id_cities]": {
                    required: true
                },
                "data[Location][lid]": {
                    required: true
                },
                "data[MapObjectSubtypeRelation][sub_types][]": {
                    required: true
                },
                "data[Location][address]": {
                    required: true
                },
                contact_email: {
                    email: true
                },
                contact_web: {
                    url: true
                },
                "data[Location][longitude]": {
                    required: true
                },
                "data[Location][latitude]": {
                    required: true
                },
                "data[Location][html_text]": "getEditorValue"
            },
            messages: {
                "data[Location][name]": "Molimo unesite naziv lokacije",
                "data[Location][address]": {
                    required: "Unesite adresu"
                },
                "data[Location][fk_id_cities]": {
                    required: "Odaberite grad"
                },  
                "data[Location][longitude]": {
                    required: "Odaberite neku lokaciju na mapi da bi se učitala geografska širina"
                }, 
                "data[Location][latitude]": {
                    required: "Odaberite neku lokaciju na mapi da bi se učitala geografska dužina"
                },                 
                "data[MapObjectSubtypeRelation][sub_types][]": "Morate izabrati bar jedan tip objekta kome lokacija pripada",
                "data[Location][html_text]": {
                    required: "Unesite detaljan opis lokacije"
                }
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
                // submit form
                if ($('.summernote').code() !== "<br>")
                    $("#html_text").val($('.summernote').code());

                $('body').modalmanager('loading');

                jQuery.ajax({
                    url: '/locations/addNewLocation',
                    method: 'POST',
                    data: $('#form_new_location').serialize()
                }).done(function (response) {
                    $modal.modal();
                    // Do something with the response
                }).fail(function () {
                    alert('fail');
                    // Whoops; show an error.
                });

                //form.submit();
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