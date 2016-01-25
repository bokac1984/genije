$(document).ready(function(){
    $('#name').editable();
    $('#lid').editable();
    
    $(".knob").knob({
        release: function(value){
            console.log();
            var id = $(".knob").attr('data-pk');
            $.ajax({
              method: "POST",
              dataType: "json",
              url: "/locations/ajaxEdit",
              data: { name: 'admin_rating', pk: id, value: value }
            })
            .done(function( result ) {
                console.log(result);
            });
        },
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {
                var a = this.angle(this.cv) // Angle
                        ,
                        sa = this.startAngle // Previous start angle
                        ,
                        sat = this.startAngle // Start angle
                        ,
                        ea // Previous end angle
                        , eat = sat + a // End angle
                        ,
                        r = true;
                this.g.lineWidth = this.lineWidth;
                this.o.cursor && (sat = eat - 0.3) && (eat = eat + 0.3);
                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();
                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();
                return false;
            }
        }
    });

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
            url: '/locations/saveSubtypes'
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
    