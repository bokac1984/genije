$(document).ready(function () {
    var table;
$(".switch").bootstrapSwitch();
    $('.dataTable').each(function () {
        table = $(this);
        var settings = dataTableSettings[table.attr('data-config')];
        var options = {
            oLanguage: {
                "sUrl": "/js/Serbian.json"
            },
            "fnDrawCallback": function () {
                initDialogs();
                initOnlineStatus();
                initShowProductsStatus();
                $('.dataTables_length select').addClass('form-control');
            },
            "fnInitComplete": function (oSettings, json) {
                var cols = oSettings.aoPreSearchCols;
                for (var i = 0; i < cols.length; i++) {
                    var value = cols[i].sSearch;
                    if (value.length > 0) {
                        $("#filter-" + i).val(value);
                    }
                }
            },            
        };
        jQuery.extend(settings, options);
        table.dataTable(settings);
        
        var initOnlineStatus = function () {
            $('.online-status').editable({
                url: '/news/editStatus',
                mode: 'popup',
                type: 'select',
                source: [
                    {value: 0, text: 'Offline'},
                    {value: 1, text: 'Pending'},
                    {value: 2, text: 'Online'}
                ],
                success: function (data, config) {
                    table.fnDraw(false);
                }
            });

        };
        
        var initShowProductsStatus = function () {
            $(".switch").bootstrapSwitch();
            $('.switch').on('switch-change', function (e, data) {
                var $el = $(data.el)
                  , value = data.value;
                console.log(e, $el, value);
                var pk = $(this).attr('data-pk');
                console.log("pk " + pk);
                $.ajax({
                    url: '/news/showproducts',
                    method: 'POST',
                    data: 'value=' + value + '&id=' + pk
                }).done(function (response) {
                    if (parseInt(response) === 200)
                        table.fnDraw(false);
                }).fail(function () {
                    alert('Error! Contact Urban Genie');
                });                
            });
        };
        
        var initDialogs = function () {

            var $modal = $('#dialog-delete');

            // EDIT
            $("#dialogDelete").click(function (event) {
                deleteNews($(this).attr('pk'));
            });

            // DELETE
            $(".btn-delete").click(function (event) {
                $modal.modal()
                        .find('.modal-body')
                        .html('<p>Da li ste sigurni da želite da obrišete vijest: </p><strong>' + $(this).attr('name') + '</strong>')
                        .parent()
                        .find('.btn-bricky')
                        .attr('pk', $(this).attr("data-pk"));
            });
        };
        
        var deleteNews = function (pk) {
            $.ajax({
                url: '/news/deleteNews',
                method: 'POST',
                data: 'pk=' + pk
            }).done(function (response) {
                console.log(parseInt(response));
                if (parseInt(response) === 200)
                    table.fnDraw(false);
            }).fail(function () {
                alert('Error! Contact Urban Genie');
            });
        }
    });
});


