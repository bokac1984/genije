var FormValidator = function () {
    var loadAllElements = function () {
        $(".switch").bootstrapSwitch();
        
        $('.switch').on('switch-change', function (event, state) {
            
            if (!state.value) {
                $('.proizvodi-opener').hide();
            } else {
                $('.proizvodi-opener').show();
            }
        }); 
          
        $(document).on('click', '#otvori-proizvode', function(e){
            e.preventDefault();
            
            var idLocation = $("#map_object").val();
            if (idLocation) {
                loadLocationProducts(idLocation);
            } else {
                $('.no-location').show().delay(3000).fadeOut();
            }

        });        
        
        $("#map_object").select2({
            placeholder: "Izaberite lokaciju",
            allowClear: true
        }).on("select2-selecting", function (e) {
            $('#show_products').show();
        });
        
        $("#fk_id_events").select2({
            placeholder: "Izaberite dogadjaj",
            allowClear: true
        }).on("select2-selecting", function (e) {
            //$('#choose-product-modal').attr('pk', $(this).attr("data-pk"));
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
    
    var loadLocationProducts = function(location) {
        var $modall = $('#choose-products-modal');
        //$modall.show();
        $.ajax({
          method: "POST",
          dataType: "html",
          url: "/news/locationproducts.json",
          data: { id: location }
        })
        .done(function( result ) {
            
            $modall.modal().find('.modal-body').html( result);
            var selected = [];
            $('.selected-products .hidden-selected-products').each(function(i, obj) {
                selected.push($(obj).val());
            });
            
            $('#choose-products-modal .modal-body .grid-item').each(function(i, obj){
                var id = $(obj).attr('data-id');
                if(jQuery.inArray(id,selected) !== -1){
                    $(obj).addClass('selected');
                };
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
            var $mapObject = $("#map_object");
            var $event = $("#fk_id_events");
            var $city_id = $('#city_id');
            if ($mapObject.val() || $event.val() || $city_id.val()) {
                return true;
            }
            if ($("#text").val() !== "" && $("#text").val() !== "<br>") {
                $('#text').val('');
                return true;
            } else {
                return false;
            }
        }, 'Molimo unesite detaljan info o događaju.');
        
        $.validator.addMethod("checkIsOptional", function(){
            var $mapObject = $("#map_object");
            var $event = $("#fk_id_events");
            var $city_id = $('#city_id');
            if ($mapObject.val() || $event.val() || $city_id.val()) {
                return true;
            }
            return false;
            
        }, 'Ovaj podatak morate unijeti');

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
                "data[News][title]": "checkIsOptional",
                "data[News][lid]": "checkIsOptional",               
                "data[News][text]": "getEditorValue"
            },
            messages: {
                "data[News][title]": "Molimo unesite naslov vijesti",
                "data[News][lid]": "Molimo vas unesite skrećeni opis",
                "data[News][text]": "Molimo vas unesite tekst vijesti"
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
                    console.log(response);
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

    var selektujProizvode = function() {
        $(document).on('click', '.chkbox', function(e){
            e.preventDefault();
            var $produkt = $(this).parent();
            if (!$produkt.hasClass('selected')) {
                $produkt.addClass('selected');
            } else {
                $produkt.removeClass('selected');
            }
            
        }); 
        
        $(document).on('click', '#sacuvajproizvode', function(e){
            e.preventDefault();
            var selektovani = '';
            $('.wrap-image.selected').each(function(i, obj) {
                var id = $(this).attr('data-id');
                selektovani += '<input type="hidden" class="hidden-selected-products" name="data[NewsProduct][NewsProduct][]" value="'+ id +'">';
            });
            
            $('.selected-products').empty().html(selektovani);
        }); 
        
    };
    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
            runValidator();
            selektujProizvode();
        }
    };
}();