var FormValidator = function () {
    var loadAllElements = function () {

        
        $("#map_object").select2({
            placeholder: "Izaberite lokaciju",
            allowClear: true
        }).on("select2-selecting", function (e) {
            //$('#choose-product-modal').attr('pk', $(this).attr("data-pk"));
        });        

 
    };
    

    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
        }
    };
}();