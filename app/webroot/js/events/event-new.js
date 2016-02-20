var FormValidator = function () {
    var loadAllElements = function () {
        $(".switch").bootstrapSwitch();

        $('.switch').on('switch-change', function (event, state) {
            if (!state.value) {
                $(".slika_upload").show();
            } else {
                $(".slika_upload").hide();
                $(".fileupload-new > img").attr('src', '/img/no-photo.png');
            }
        });

        $("#map_object").select2({
            placeholder: "Izaberite lokaciju",
            allowClear: true
        }).on("select2-selecting", function (e) {

        });

        $('.limited').inputlimiter({
            remText: 'Preostalo je %n karaktera za unos...',
            remFullText: 'Dostigli ste limit polja!',
            limitText: 'U polje je dozvoljeno unijeti %n karaktera.'
        });

        $('.date-range').daterangepicker({
            format: 'DD.MM.YYYY. HH:mm:ss',
            timePicker: true,
            timePicker12Hour: false,
            timePickerIncrement: 15
        },
        function (start, end, label) {
            $('#start_time').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#end_time').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });

        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });

        $('#city_id').change(function () {
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "/events/locations.json",
              data: { city: $(this).val() }
            })
            .done(function( result ) {
                var options = $("#map_object");
                options.empty().append('<option selected="selected" value=""></option>');
                $.each(result, function () {
                    options.append($("<option />").val(this.id).text(this.name));
                });
            });
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

        var form = $('#form_new_event');
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