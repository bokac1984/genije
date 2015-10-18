$(document).ready(function () {
    var table;

    $('.dataTable').each(function () {
        table = $(this);
        var settings = dataTableSettings[table.attr('data-config')];

        console.log(settings);
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
                deleteLocation($(this).attr('pk'), $(this).attr('name'));
            });

            // DELETE
            $(".btn-delete").click(function (event) {
                $modal.modal()
                        .find('.modal-body')
                        .html('<p>Da li ste sigurni da želite da obrišete lokaciju: </p><strong>' + $(this).attr('name') + '</strong>')
                        .parent()
                        .find('.btn-bricky')
                        .attr('pk', $(this).attr("value"))
                        .attr('name', $(this).attr('name'));
            });
        };
        
    var deleteLocation = function (pk, name) {

        jQuery.ajax({
            url: 'server-methods/delete-location.php',
            method: 'POST',
            data: 'pk=' + pk + '&name=' + name
        }).done(function (response) {
            if (response == 200)
                $oTable.fnDraw(false);
        }).fail(function () {
            alert('Error! Contact Djordje Hrnjez');
        });
    }
    });
});


