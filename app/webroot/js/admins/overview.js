var UsersOverview = function () {
    //function to assign location to user
    var assignLocation = function () {
        
        $("#map_object").prop("disabled", true);
        $("#map_object").select2({
            placeholder: "Izaberite lokaciju",
            allowClear: true,
            theme: "bootstrap"
        });
        
        $(document).on('click', '#dodijeli-lokaciju', function(e){
            e.preventDefault();
            var $modal = $('#assign-location').modal();
        }); 
        
        $('#city_id').change(function () {
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "/users/listLocations.json",
              data: { city: $(this).val() }
            })
            .done(function( result ) {
                var options = $("#map_object");
                options.prop("disabled", false);
                options.empty().append('<option selected="selected" value=""></option>');
                $.each(result, function () {
                    options.append($("<option />").val(this.id).text(this.name));
                });
            })
            .fail(function( result ) {
                alert('Nastala je greska');
            });             
        }); 
        
        
        $(document).on('click', '#btn-dialog-save', function(e){
            e.preventDefault();
            var location = $("#map_object").val() ? $("#map_object").val() : null;
            
            if (location !== null) {
                $.ajax({
                  method: "POST",
                  dataType: "html",
                  url: "/users/saveuserlocation.json",
                  data: { location: location, user: $(".user-id").val() }
                })
                .done(function( result ) {
                    $('.rezultati').html(result);
                })
                .fail(function( result ) {
                    alert('Nastala je greska prilikom snimanja lokacije!');
                });
            } else {
                
            }

        });                
    };
    
    var subscribe = function () {
        $(document).on('click', '#btn-subscribe', function(e){
            e.preventDefault();
            $.ajax({
              method: "POST",
              dataType: "html",
              url: "/plans/getallplans.json"
            })
            .done(function( result ) {
                $('.modal-body .rezultati-sub').html(result);
        
                $('input[name="iCheck"]').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green'
                });
                
                $('input[name="iCheck"]').on('ifChecked', function(event){
                  $('input[name="selected-plan"]').val(($(this).val()));
                });                
            })
            .fail(function( result ) {
                alert('Nastala je greska prilikom snimanja lokacije!');
            });            
            var $modal = $('#subscription').modal();
        }); 

        $(document).on('click', '#btn-dialog-save-subs', function(){
            var odabrano = $('input[name="selected-plan"]').val();
            
            $.ajax({
              method: "POST",
              dataType: "html",
              url: "/users/saveplan.json",
              data: { plan: odabrano, user: $(".sub-user-id").val()}
            })
            .done(function( result ) {
                $('.odabrani-planovi').html(result);              
            })
            .fail(function( result ) {
                console.log(result.responseText);
                var poruka = JSON.parse(result.responseText);
                $('.modal-body .error-sub').html("<p style='color: red;'>" + poruka.message + "</p>");
            });              
        });
        
        /**
         * klik na dugme X u jednom redu
         */
        $(document).on('click', '#cancelsub', function(){
            var $modal = $('#cancel-subscription').modal();
            
            var subscriptionId = $(this).attr('data-id');
            $modal.find('#subscription-id').attr('data-id', subscriptionId);
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "/decline_reasons/reasons.json"
            })
            .done(function( result ) {
                console.log(result);  
                var options = $modal.find("#decline_reason");
                options.prop("disabled", false);
                options.empty();
                $.each(result, function (index, element) {
                    console.log(this.id);
                    options.append($("<option />").val(this.id).text(this.description));
                });
            })
            .fail(function( result ) {
                console.log(result.responseText);
            });
        }); 
        
        /**
         * klik na sacuvaj poslije klika na X
         */
        $(document).on('click', '#btn-dialog-save-canceled-sub', function(){
            var id = $('#cancel-subscription').find('#subscription-id').attr('data-id');
            var reason = $('#decline_reason').val();
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "/subscriptions/cancel",
              data: {subscription: id, reason: reason}
            })
            .done(function( result ) {
                console.log(result);  
                var options = $modal.find("#decline_reason");
                options.prop("disabled", false);
                options.empty().append('<option selected="selected" value=""></option>');
                $.each(result, function (index, element) {
                    console.log(this.id);
                    options.append($("<option />").val(this.id).text(this.description));
                });
            })
            .fail(function( result ) {
                console.log(result.responseText);
            });
        });         

    };
    return {
        //main function to initiate template pages
        init: function () {
            assignLocation();
            subscribe();
        }
    };
}();