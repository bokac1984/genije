var LocationGallery = function () {
    var loadAllElements = function (pk) {
        // DROP ZONE
//        var myDropZone = new Dropzone(".dropzone", {
//            acceptedFiles: "image/*",
//            paramName: "file", // The name that will be used to transfer the file
//            maxFilesize: 5.0, // MB
//            addRemoveLinks: true
//        });
        var myDropZone = $(".dropzone").dropzone({
            acceptedFiles: "image/*",
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 5.0, // MB
            addRemoveLinks: true
        });
        
        myDropZone.on("success", function (file, response) {
            console.log('uspesh neki');
            //$(file.previewTemplate).append('<input class="server_file_name" type="hidden" value="' + response + '">');
        });
        
        myDropZone.on('addedfile', function(file){
            console.log('dodan fajl');
        });

        myDropZone.on("removedfile", function (file) {
            var photoName = $(file.previewTemplate).children('.server_file_name').attr('value');
            $.post('/locations/deleteImage', "photo=" + photoName); // Send the file id along
        });
        
        $("#btn-add-photos").click(function (event) {
            $('#ajax-modal').modal();
        });


        $("#btn-dialog-dismiss").click(function (event) {
            location.reload();
        });
    };

    var runColorBox = function () {
        $(".group1").colorbox({
            rel: 'group1',
            transition: "none",
            width: "100%",
            height: "100%",
            retinaImage: true
        });
    };

    //function to Image Picker
    var runImagePicker = function () {
        $(document).on('click', '.wrap-image .chkbox', function(e) {
            e.preventDefault();
            var $slika = $(this);
            if (!$(this).parent().hasClass('selected')) {
                $('.galerija-slika').find('.selected').removeClass('selected');
                $slika.parent().addClass('selected').children('a').children('img').addClass('selected');
                var pk = $(this).parent().children('a').attr('pk');
                var photoName = $(this).parent().children('a').attr('data-jpg');
                var posting = $.post( '/locations/makeCover', { id: pk, cover: photoName } );

                posting.done(function( data ) {
                    if(parseInt(data) == 200) {
                        // TODO:
                        // ovdje bi bolje bilo mozda ne reloadati
                        // nego prebaciti check mark na kliknuti sliku a skinuti sa druge
                        //location.reload();
                    }
                    else
                        alert("Data: " + data + "\nStatus: " + status);
                });

            }
        });
    };
    
    var brisanjeSlike = function(pk) {
        var $modal = $('#dialog-delete-image');

        // EDIT
        $("#dialogDeleteFoto").click(function (event) {
            console.log('brisi slikue');
            deletePhoto(pk, $(this).attr('fid'), $(this).attr('jpg'));
        });

        // DELETE
        $(".photo-remove").click(function (event) {
            console.log($(this).attr('data-id'));
            $modal.modal()
                    .find('#dialogDeleteFoto')
                    .attr('fid', $(this).attr('data-id'))
                    .attr('jpg', $(this).attr('data-jpg'));
        });
    }
    var deletePhoto = function (pk, fid, jpg) {
        jQuery.ajax({
            url: '/locations/deleteImage',
            method: 'POST',
            data: 'id=' + pk + '&jpg=' + jpg + '&fid=' + fid
        }).done(function (response) {
            if (parseInt(response) == 200) {
                var $roditelj = $(".photo-remove[data-id='" + fid + "']").closest('.gallery-img');
                $roditelj.fadeOut('slow').remove();
            }
        }).fail(function () {
            alert('Error! Contact Urban Genie');
        });
    }
    return {
        //main function to initiate template pages
        init: function (pk) {
            brisanjeSlike(pk);
            runColorBox();
            runImagePicker();
            loadAllElements(pk);
        }
    };
}();