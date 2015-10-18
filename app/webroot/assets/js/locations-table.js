var TableData = function () {
    //function to initiate DataTable
    //DataTable is a highly flexible tool, based upon the foundations of progressive enhancement, 
    //which will add advanced interaction controls to any HTML table
    //For more information, please visit https://datatables.net/
	var $oTable;
	
    var runDataTable = function () {
				
        $oTable = $('#table-locations').dataTable({
			"sDom": "lrtip",
			"bProcessing": true,
			"bServerSide": true,
			"bStateSave": true,
			"sAjaxSource": "/locations/index", 
			"aoColumns": [
				{ "sClass": "center", "bSortable": true },
				{ "bSortable": false },
				{ "bSortable": false },
				{ "bSortable": false },
				{ "sClass": "center", "bSortable": true },
				{ "sClass": "center", "bSortable": true },
				{ "sClass": "center", "bSortable": false },
				{ "sClass": "center", "bSortable": false }
			], 
            // set the initial value
            "iDisplayLength": 10,
			"fnInitComplete": function(oSettings, json) {
                var cols = oSettings.aoPreSearchCols;
                for (var i = 0; i < cols.length; i++) {
                    var value = cols[i].sSearch;
                    if (value.length > 0) {
                        $("#filter-"+i).val(value);
                    }
                }
            },
			"fnDrawCallback" : function() {
				initDialogs();
				initOnlineStatus();
			}
        });		
		
        $('#table-locations_wrapper .dataTables_filter input').addClass("form-control input-sm").attr("placeholder", "Search");
        $('#table-locations_wrapper .dataTables_length select').addClass("m-wrap small");
        //$('#table-locations_wrapper .dataTables_length select').select2();
    };
	
	var initDialogs = function() {
		
		var $modal = $('#dialog-delete');
		
		// EDIT
		$("#dialogDelete" ).click(function( event ) {
			deleteLocation($(this).attr('pk'), $(this).attr('name'));
		});
		
		// DELETE
		$(".btn-delete" ).click(function( event ) {			
			$modal.modal()				
				.find('.modal-body')
				.html('<p>Da li ste sigurni da želite da obrišete lokaciju: </p><strong>'+$(this).attr('name')+'</strong>')
				.parent()
				.find('.btn-bricky')
				.attr('pk', $(this).attr("value"))
				.attr('name', $(this).attr('name'));
		});	
	};
	
	var initOnlineStatus = function() {
		
		$('.online-status').editable({ 
			url: 'server-methods/edit-location-status.php',   
			mode: 'popup',
			type: 'select',
			source: [
				{value: 0, text: 'Offline'},
				{value: 1, text: 'Pending'},
				{value: 2, text: 'Online'}
		   	],
			success: function(data, config) {
				$oTable.fnDraw(false);
			}
		});
		
	};
	
	var deleteLocation = function(pk, name) {
	
		jQuery.ajax({
			url: 'server-methods/delete-location.php',
			method: 'POST',
			data: 'pk='+pk+'&name='+name
		}).done(function (response) {
			if(response == 200)
				$oTable.fnDraw(false);
		}).fail(function () {
			alert('Error! Contact Djordje Hrnjez');
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
				$oTable.fnFilter('',null);
            }
        });
        search_button.bind('click', function () {
            if ($(search_input).hasClass('open')) {
				if(search_input.val() != '')
					$oTable.fnFilter( search_input.val() ,null, false, true, false );
				else
					$oTable.fnFilter('',null);
			}
            else
                $(search_input).focus();
            return false;
        });
    };
	
	var initCustomFilter = function () {
		// Apply the search
		
		$('#filter-3').change(function() {			
			$oTable.fnFilter(this.value, 3);
		});
		
		$('#filter-7').change(function() {			
			$oTable.fnFilter(this.value, 7);
		});
	}
	
    return {
        //main function to initiate template pages
        init: function () {
            runDataTable();
			initCustomSearch();
			initCustomFilter();
        }
    };
}();
