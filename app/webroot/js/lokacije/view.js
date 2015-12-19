var Maps = function (lat, long, name) {
    $('[data-toggle="tooltip"]').tooltip();
    var runMaps = function (lat, long, name) {
        //Markers
        map2 = new GMaps({
            div: '#map2',
            lat: lat,
            lng: long
        });
        map2.addMarker({
            lat: lat,
            lng: long,
            title: 'Marker with InfoWindow',
            height: '200px',
            infoWindow: {
                content: '<p>'+ name +'</p>'
            }
        });
    };
    
    var runCommentFetch = function() {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).attr("href"); // activated tab
            switch(target) {
                case '#panel_events':
                    if (!$('.events-table').html().length){
                        loadData('/locations/getAllEventsForLocation.json', $('.events-table'));
                    }     else {
                        console.log('nema nista u events');
                    }
                    break;
                case '#panel_products':
                    if (!$('.products-table').html().length){
                        loadData('/locations/getProductsForLocation.json', $('.products-table'));
                    }              
                    break;                    
                case '#panel_comments':
                    if (!$('.comments-table').html().length){
                        loadData('/locations/getCommentsForLocation.json', $('.comments-table'));
                    }              
                    break;                    
                default:
                    break;
            }
          });
    };
    
    var loadData = function(url, body) {
        var $loading = $('.loading');
        body.html('');
        $loading.show();
        $.ajax({
            url: url,
            method: 'POST',
            dataType: "html",
            data: {
                id: locationId
            }
        }).done(function (response) {
            $loading.hide();
            body.html(response);
            initStars();
        }).fail(function (response) {
            $loading.hide();
            //body.html('Error! Contact Urban Genie');
        }); 
    };    
    var initStars = function(){
        $('.stars').rating({
            step: 0.1,
            readonly: true,
            showClear: false,
            showCaption: false,
            size: 'xxxs'
        });
    };
    
    var initStarsLocation = function(){
        $('.stars-location').rating({
            step: 0.1,
            readonly: true,
            showClear: false,
            showCaption: false,
            size: 'xxs'
        });
    };    
    
    return {
        //main function to initiate template pages
        init: function (lat, long, name) {
            runMaps(lat, long, name);
            runCommentFetch();
            initStarsLocation();
        }
    };
}();