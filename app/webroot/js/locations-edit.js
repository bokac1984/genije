$(document).ready(function(){
    $('#name').editable();
    $('#lid').editable();
    $('#admin_rating').editable();

    $('#fk_id_cities').editable();
    $('#address').editable();
    
    $.post('/locations/getCitiesForSelect', function(data, status){
        var sel = $("#filter-3");
        data = JSON.parse(data);
        for (var i=0; i<data.length; i++) {
          sel.append('<option value="' + data[i].City.id + '">' + data[i].City.name + '</option>');
        }
    });
    
    $.post("/locations/getSubtypes",
        function (data, status) {
            $('#sub_types').editable({
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
                url: '/locations/saveSubtypes',
            });
        });

    $('#contact_mobile').editable({
        params: function (params) {
            params.tip = $(this).attr('data-tip');
            return params;
        }
    });
    $('#contact_phone').editable({
        params: function (params) {
            params.tip = $(this).attr('data-tip');
            return params;
        }
    });
    $('#contact_web').editable({
        params: function (params) {
            params.tip = $(this).attr('data-tip');
            return params;
        }
    });
    $('#contact_email').editable({
        params: function (params) {
            params.tip = $(this).attr('data-tip');
            return params;
        }
    });

    $('#note').editable();
    $('#pencil').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#note').editable('toggle');
    });
});
    