$.fn.editable.defaults.mode = 'popup';
$.fn.editable.defaults.url = '/events/editable/'; 

var FormEditable = function () {
    var loadAllElements = function () {
        $('#name').editable({
            validate: function (value) {
                if ($.trim(value) == '') {
                    return 'Naziv mora biti unijet.';
                }
            }
        });

        $('#lid').editable();

        $('#start_time').editable({
            placement: 'right',
            format: 'yyyy-mm-dd hh:ii',
            viewformat: 'dd.mm.yyyy hh:ii',
            datetimepicker: {
                weekStart: 1
            }
        });

        $('#end_time').editable({
            placement: 'right',
            format: 'yyyy-mm-dd hh:ii',
            viewformat: 'dd.mm.yyyy hh:ii',
            datetimepicker: {
                weekStart: 1
            }
        });


        $('#html_text').editable({
            placement: 'bottom'
        });
        $('#edit-html-text').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#html_text').editable('toggle');
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