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

        $("#main-image").fileinput({
            uploadUrl: "/events/changemainimage", // server upload action
            uploadAsync: true,
            maxFileCount: 1,
            language: 'cr',
            uploadExtraData: function() {
                return {
                    event: $("#main-image").attr('data-id')
                };
            }
        });
        
        $("#change-event-img").click(function(){
            var $modal = $('#choose-products-modal');
            
            $modal.modal();
        });
        $("#main-image").on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response, reader = data.reader;
            console.log(response);
            var $modal = $('#choose-products-modal');
            
            $('#link-slika').attr('href', response);
            $('#slika-slika').attr('src', response);
            
            $modal.modal('hide');
        });
    };


    return {
        //main function to initiate template pages
        init: function () {
            loadAllElements();
        }
    };
}();
FormEditable.init();