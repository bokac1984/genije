var FormValidator = function () {
    var loadAllElements = function () {

        $(document).on('click', '.dodaj_red', function(e){
            e.preventDefault();
            var $row = $(this);

            $("table.feature tbody tr:first").clone().find("input").each(function() {
                $(this).val('').attr('id', function(_, id) { return id + i });
            }).end().appendTo("table");
        });

        $(document).on('click', '.ukloni_red', function(e){
            e.preventDefault();
            var $row = $(this).closest('tr');

            if (!$row.is(":last-child")) {
                $row.remove();
            }
        });
        
        $(".switch").bootstrapSwitch();
        
        $('.switch').on('switch-change', function (event, state) {
              if (!state.value) {
                  alert('on');
              } else {
                  alert('off');
              }
          });        
        
        $("#map_object").select2({
            placeholder: "Izaberite lokaciju",
            allowClear: true
        }).on("select2-selecting", function (e) {

        });
        
        $("#fk_id_events").select2({
            placeholder: "Izaberite dogadjaj",
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
        
        $("#map_object").change(function () {
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "/news/events.json",
              data: { location: $(this).val() }
            })
            .done(function( result ) {
                var options = $("#fk_id_events");
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
            $("#text").val($('.summernote').code());
            if ($("#text").val() !== "" && $("#text").val() !== "<br>") {
                $('#text').val('');
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
                "data[News][title]": {
                    minlength: 2,
                    required: true
                },
                "data[News][lid]": {
                    required: true
                },
                "data[News][fk_id_cities]": {
                    required: true
                },                
                "data[News][text]": "getEditorValue"
            },
            messages: {
                "data[News][title]": {
                    required: "Molimo unesite naslov vijesti"
                },
                "data[News][fk_id_cities]": {
                    required: "Molimo odaberite jedan grad"
                },
                "data[News][lid]": "Molimo vas unesite skrećeni opis",
                "data[News][text]": "Molimo vas unesite tekst vijesti",
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
                console.log(element);
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler.show();
                errorHandler.hide();
                // submit form
                if ($('.summernote').code() !== "<br>")
                    $("#text").val($('.summernote').code());

                $('body').modalmanager('loading');

                $.ajax({
                    url: saveNews,
                    method: 'POST',
                    data: $('#form_new_event').serialize()
                }).done(function (response) {
                    if (parseInt(response) !== 0) {
                        window.location.href = add_images + '/' + parseInt(response);
                    } else {
                        alert('Greska se desila');
                    }
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