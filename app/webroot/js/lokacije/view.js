var Maps = function (lat, long, name) {
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
        
        $("#load-more").click(function(){
            alert('RAdi');
//            $.ajax({
//                url: '/news/showproducts',
//                method: 'POST',
//                data: 'value=' + value + '&id=' + pk
//            }).done(function (response) {
//                
//            }).fail(function () {
//                alert('Error! Contact Urban Genie');
//            }); 
        });

    };
    return {
        //main function to initiate template pages
        init: function (lat, long, name) {
            runMaps(lat, long, name);
            runCommentFetch();
        }
    };
}();