$(document).ready(function () {
    $('.can-do-checks').editable({
        source: [
              {value: 1, text: 'Dozvoljeno'},
              {value: 0, text: 'Nedozvoljeno'}
           ],
        success: function(response, newValue) {
            if(response.status === '200') {
                if ($(this).hasClass('label-succes')) {
                    $(this).removeClass('label-success').addClass('label-danger');
                } else {
                    $(this).removeClass('label-danger').addClass('label-success');
                }
            }
        }
    });
});