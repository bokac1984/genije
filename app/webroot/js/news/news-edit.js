$.fn.editable.defaults.mode = 'popup';
$.fn.editable.defaults.url = '/news/editable/'; 

var FormEditable = function () {
    var loadAllElements = function () {
        $('#title').editable({
            validate: function (value) {
                if ($.trim(value) == '') {
                    return 'Naslov mora biti unijet.';
                }
            }
        });
        
        $('.switch').on('switch-change', function (e, data) {
            var $el = $(data.el)
              , value = data.value;
            var pk = $(this).attr('data-pk');
            $.ajax({
                url: '/news/showproducts',
                method: 'POST',
                data: 'value=' + value + '&id=' + pk
            }).done(function (response) {
                
            }).fail(function () {
                alert('Error! Contact Urban Genie');
            });                
        });
        
        $(".switch").bootstrapSwitch();

        $('#lid').editable();
        
        $('#text').editable({
            placement: 'bottom'
        });
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