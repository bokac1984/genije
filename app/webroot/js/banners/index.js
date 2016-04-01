$(document).ready(function () {
    var beforeValue ;
    var test = {};
    test[0] = "label-danger";
    test[1] = "label-warning";
    test[2] = "label-success";
    
    $('.banner-status').editable({
        type: 'select',
        source: [
            {value: 0, text: 'Offline'},
            {value: 1, text: 'Pending'},
            {value: 2, text: 'Online'}
           ],
        success: function(response, newValue) {
            if(response.status === '200') {
                var classToRemove = test[beforeValue];
                $(this).removeClass(classToRemove).addClass(' ' + response.value);
            }
        }
    });
    
$('.banner-status').on('shown', function(e, editable) {
    beforeValue = editable.input.$input.val();
});    
});