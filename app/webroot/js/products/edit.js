$.fn.editable.defaults.mode = 'popup';
$.fn.editable.defaults.url = '/products/editable/'; 

var FormEditable = function () {
    var loadAllElements = function () {
        $('#name').editable({
            validate: function (value) {
                if ($.trim(value) == '') {
                    return 'Morate unijeti naziv proizvoda.';
                }
            }
        });
        
        $.post("/products/getLocations",
        function (data, status) {
            $('#fk_id_map_objects').editable({
                source: JSON.parse(data),
                validate: function (value) {
                    if ($.trim(value) == '') {
                        return 'This field is required';
                    }
                },
                select2: {
                    multiple: true,
                    width: 200,
                    placeholder: 'Izaberite tip lokacije'
                },
                url: '/products/saveLocations'
            });
        });
        
        $('#fk_id_map_objects');

        $('#label').editable();
        
        $('#price').editable();
        
        $('#edit-html-text').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#text').editable('toggle');
        });

        // MAP

    };


    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
        }
    };
}();
FormEditable.init();