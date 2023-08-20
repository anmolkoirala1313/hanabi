var total_photos_counter = 0;
Dropzone.options.myDropzone = {
    uploadMultiple: true,
    parallelUploads: 1,
    maxFilesize: 16,
    acceptedFiles: ".jpeg,.jpg,.png",
    // previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    // dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 16MB',
    timeout: 50000,
    // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    init: function() {

        // Get images
        var myDropzone = this;
        // console.log(page_section_id);
        $.ajax({
            url: "/auth/section-elements/gallery/" + page_section_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                $.each(data, function(key, value) {

                    var file = { name: value.name, size: value.size };
                    myDropzone.options.addedfile.call(myDropzone, file);
                    myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                    myDropzone.emit("complete", file);
                    total_photos_counter++;
                    $("#counter").text("# " + total_photos_counter);
                });
            }
        });
    },
    removedfile: function(file) {
        if (this.options.dictRemoveFile) {

            return Dropzone.confirm("Are You Sure to " + this.options.dictRemoveFile, function() {
                if (file.previewElement.id != "") {
                    var name = file.previewElement.id;
                } else {
                    var name = file.name;
                }
                // console.log(name);
                $.ajax({
                    type: 'POST',
                    url: '/auth/section-elements/image-delete',
                    data: { filename: name, _token: $('[name="_token"]').val() },
                    success: function(data) {
                        total_photos_counter--;
                        $("#counter").text("# " + total_photos_counter);
                        // alert(data.success +" Image has been successfully removed!");
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.success(data.success + " Image has been successfully removed!");
                    },
                    error: function(e) {
                        $('.invalid-feedback').show();
                        $('.invalid-feedback').text(e.message);
                        console.log(e);
                    }
                });
                var fileRef;
                return (fileRef = file.previewElement) != null ?
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            });
        }
    },
    // {
    //     this.on("removedfile", function (file) {
    //         $.post({
    //             url: '/auth/properties/image-delete',
    //             data: {id: file.name, _token: $('[name="_token"]').val()},
    //             dataType: 'json',
    //             success: function (data) {
    //                 total_photos_counter--;
    //                 $("#counter").text("# " + total_photos_counter);
    //             }
    //         });
    //     });

    //     this.on("error", function (file, responseText) {
    //         $.each(responseText, function (index, value) {
    //             $('.dz-error-message').text(value);
    //             $('.invalid-feedback').show();
    //             $('.invalid-feedback').text(value);
    //         });
    //     });
    // },
    success: function(file, done) {
        total_photos_counter++;
        $("#counter").text("| Total Image's #" + total_photos_counter);
        file.previewElement.id = done.success;
        //console.log(file);
        // set new images names in dropzone’s preview box.
        var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
        file.previewElement.querySelector("img").alt = done.success;
        olddatadzname.innerHTML = done.success;
    },
    error: function(file, response) {
        $.each(response, function(index, value) {
            $('.invalid-feedback').show();
            $('.invalid-feedback').text(value);
        });
    }
};