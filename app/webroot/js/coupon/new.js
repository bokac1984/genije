var FormValidator = function () {
    var loadAllElements = function () {

        $("#fk_id_events").select2({
            placeholder: "Izaberite događaj",
            allowClear: true
        }).on("select2-selecting", function (e) {

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

        $('#city_id').change(function () {
            $.ajax({
              method: "POST",
              url: "/coupons/events",
              data: { cityId: $(this).val() }
            })
            .done(function( result ) {
                var options = $("#fk_id_events");
                options.empty().append('<option selected="selected" value=""></option>');
                $.each(result, function () {
                    options.append($("<option />").val(this.id).text(this.name));
                });
            });
        });
        
        var longitude = $('#longitude');
        var latitude = $('#latitude');
        var radius = $('#radius');
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
        
        $("#draw_radius").click(function (event) {
            drawRadius(latitude.val(), longitude.val(), radius.val());
        });


        var circle;
        function drawRadius(lat, lng, radius) {
            if (circle !== undefined) {
                circle.setMap(null);
            }
                
            circle = gMap.drawCircle({
                lat: lat,
                lng: lng,
                tag: "radius",
                radius: parseInt(radius),
                strokeColor: '#007aff',
                strokeOpacity: 1,
                strokeWeight: 2,
                fillColor: '#007aff',
                fillOpacity: 0.6
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

        var form = $('#CouponAddForm');
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
        }, 'Molimo unesite detaljan info o događaju.');

        form.validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.hasClass("date-range")) { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).parent());
                } else {
                    error.insertAfter(element);
                }
            },
            ignore: "",
            rules: {
                "data[Event][name]": {
                    minlength: 2,
                    required: true
                },
                "data[Event][lid]": {
                    required: true
                },
                value_time: {
                    required: true
                },
                html_text: "getEditorValue",
                "data[Event][fk_id_map_objects]": {
                    required: true
                }
            },
            messages: {
                "data[Event][name]": {
                    required: "Molimo unesite naziv događaja"
                },
                "data[Event][lid]": "Molimo vas unesite skrećeni opis",
                value_time: "Molimo vas unesite vrijeme događaja",
                "data[Event][fk_id_map_objects]": "Molimo vas odaberite jednu lokaciju"
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
                
                $.ajax({
                  method: "POST",
                  url: "/coupons/generateCoupons",
                  data: $('#CouponAddForm').serialize()
                })
                .done(function( response ) {
                    $modal.modal()
                            .find('.modal-body')
                            .html('<p>Broj potencijalnih dobitnika: <strong>' + response + '</strong></p><p>Da li želite da nastavite i podjelite kupone?</p>');
                });                
            }
        });
        
        $("#btn-generate-tickets").click(function (event) {
            var $modal = $('#ajax-modal-finish');
            $("#check").val('0');
            $('body').modalmanager('loading');

            jQuery.ajax({
                url: "/coupons/generateCoupons",
                method: 'POST',
                data: $('#CouponAddForm').serialize()
            }).done(function (response) {
                    $modal.modal()
                            .find('.modal-body')
                            .html('<p>Uspješno podjeljeno: <strong>1</strong> kupona.</p>');
            }).fail(function () {
                alert('fail');
            });
        });
        $("#btn-finish").click(function (event) {
            window.location.href = '/coupons/index';
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