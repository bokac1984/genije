$(document).ready(function () {
    var table;

    $.getJSON('/locations/getCitiesForSelect', function (data) {
        var options = '';
        options += '<option value="">Svi gradovi</option>';
        data.forEach(function (city)
        {
            options += '<option value="' + city["City"].id + '">' + city["City"].name + '</option>';
        });
        $('#filter-2').html(options);
    });

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
                    console.log(cols);
                    if (value.length > 0) {
                        console.log(i);
                        $("#filter-" + i).val(value);
                    }
                }
            }
        };
        jQuery.extend(settings, options);
        table.dataTable(settings);

        var initOnlineStatus = function () {
            $('.online-status').editable({
                url: '/locations/updateStatus',
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
                deleteLocation($(this).attr('pk'));
            });

            // DELETE
            $(".btn-delete").click(function (event) {
                $modal.modal()
                        .find('.modal-body')
                        .html('<p>Da li ste sigurni da želite da obrišete lokaciju: </p><strong>' + $(this).attr('name') + '</strong>')
                        .parent()
                        .find('.btn-bricky')
                        .attr('pk', $(this).attr("data-pk"));
            });
        };

        var deleteLocation = function (pk) {
            $.ajax({
                url: '/locations/deleteLoc',
                method: 'POST',
                data: 'pk=' + pk
            }).done(function (response) {
                if (parseInt(response) === 200)
                    table.fnDraw(false);
            }).fail(function () {
                alert('Error! Contact Urban Genie');
            });
        }

        //Search Input function
        var initCustomSearch = function () {
            var search_input = $('.sidebar-search input');
            var search_button = $('.sidebar-search button');
            search_input.attr('data-default', $(search_input).outerWidth()).focus(function () {
                $(this).addClass('open');
                $(this).animate({
                    width: 200
                }, 200);
                $(this).select();
            }).blur(function () {
                if ($(this).val() == "") {
                    $(this).animate({
                        width: $(this).attr('data-default')
                    }, 200);
                    $(this).removeClass('open');
                    table.fnFilter('', null);
                }
            });
            search_button.bind('click', function () {
                if ($(search_input).hasClass('open')) {
                    if (search_input.val() != '')
                        table.fnFilter(search_input.val(), null, false, true, false);
                    else
                        table.fnFilter('', null);
                }
                else
                    $(search_input).focus();
                return false;
            });
        };

        var initCustomFilter = function () {
            // Apply the search

            $('#filter-2').change(function () {
                table.fnFilter(this.value, 2);
            });

            $('#filter-6').change(function () {
                table.fnFilter(this.value, 6);
            });
        };

        initCustomFilter();
    });
});


