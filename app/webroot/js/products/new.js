var FormValidator = function () {
    var summernoteCodeValue;
    var loadAllElements = function () {
        
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
        
        $("#map_object").select2({
            placeholder: "Izaberite tip lokacije",
            allowClear: true,
            theme: "bootstrap"
        });

        
        $(document).on('click', '.dodaj_red', function(e){
            e.preventDefault();

            var $row = $(this);
            var $table = $("table.feature tbody tr").last();
            var clonedRow = $("table.feature tbody tr:first").clone();

            $table.after(clonedRow);
            var idReda = $('table.feature tbody tr:last').find('input').attr('name').match(/\d+/)[0];

            clonedRow.find("input").each(function() {
                var idNew = +idReda + 1;

                $(this).val('').attr('name', function(_, name){
                    var lastPart = name.slice(-7);
                    return 'data\[ProductFeature\]\[' + idNew + '\]' + lastPart;
                });

                $(this).val('').attr('id', function(_, id){
                    return idNew;
                });
            });
        });

        $(document).on('click', '.ukloni_red', function(e){
            e.preventDefault();
            var $row = $(this).closest('tr');

            if (!$row.is(":last-child")) {
                $row.remove();
            }
        });

        $('.summernote').summernote({
            height: 300,
            tabsize: 2
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

        var form = $('#ProductAddForm');
        var errorHandler = $('.errorHandler', form);
        var successHandler = $('.successHandler', form);

        $.validator.addMethod("getEditorValue", function () {
            var $text = $("#text");
            var $noteEditable = $('.note-editable');
            $text.val($('.summernote').code());
            
            if ($text.val() !== "" && $text.val() !== "<br>") {
                $text.val('');
                return true;
            } else if ($noteEditable.html().length > 0){
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
                "data[Product][name]": {
                    minlength: 2,
                    required: true
                },
                "data[Product][price]": {
                    required: true
                },
                "data[News][fk_id_cities]": {
                    required: true
                },
                "data[Product][description]": "getEditorValue"
            },
            messages: {
                "data[Product][name]": {
                    required: "Molimo unesite naziv proizvoda"
                },
                "data[Product][price]": {
                    required: "Molimo unesite cijenu"
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
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler.show();
                errorHandler.hide();
                // submit form
                if ($('.summernote').code() !== "<br>"){  
                    $("#text").val($('.summernote').code());
                    if ($("#text").val().length <= 0 && $('.note-editable').html().length > 0) {
                        $("#text").val($('.note-editable').html());
                    }
                }

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