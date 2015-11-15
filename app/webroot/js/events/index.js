$(document).ready(function () {
    var table;

    $('.dataTable').each(function () {
        table = $(this);
        var settings = dataTableSettings[table.attr('data-config')];

        var options = {
            oLanguage: {
                "sUrl": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Serbian.json"
            },
            "fnDrawCallback": function () {
                initDialogs();
                initOnlineStatus();
            },
            "fnInitComplete": function (oSettings, json) {
                var cols = oSettings.aoPreSearchCols;
                for (var i = 0; i < cols.length; i++) {
                    var value = cols[i].sSearch;
                    console.log(i);
                    if (value.length > 0) {
                        console.log('ima vrijednost')
                        $("#filter-" + i).val(value);
                    } else {
                        console.log('nema vrijednost')
                    }
                }
            },            
        };
        jQuery.extend(settings, options);
        table.dataTable(settings);
        
        var initOnlineStatus = function () {
            $('.online-status').editable({
                url: '/events/updateStatus',
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
        var initDialogs = function () {

            var $modal = $('#dialog-delete');

            // EDIT
            $("#dialogDelete").click(function (event) {
                jQuery.ajax({
                    url: '/events/deleteEvent',
                    method: 'POST',
                    data: 'pk=' + $(this).attr('pk')
                }).done(function (response) {
                    if (parseInt(response) === 200)

                        table.fnDraw(false);
                }).fail(function () {
                    alert('Error! Contact Urban Genie');
                });
            });

            // DELETE
            $(".btn-delete").click(function (event) {
                var pk = $(this).attr("data-pk");
                $modal.modal()
                        .find('.modal-body')
                        .html('<p>Da li ste sigurni da želite da obrišete dogadjaj # <strong>' + pk + '</strong>' + '?' +'</p>')
                        .parent()
                        .find('.btn-bricky')
                        .attr('pk', pk);
            });
        };
    });
});


