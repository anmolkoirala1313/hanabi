var loadbasicFile = function(id1,id2,event) {
    var image       = document.getElementById(id1);
    var replacement = document.getElementById(id2);
    replacement.src = URL.createObjectURL(event.target.files[0]);
};

function slugMaker(title, slug){
    $("#"+ title).keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#"+slug).val(Text);
    });
}

$(document).ready(function () {
    $('#job-category-index').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    });


    $(document).on('click', '.cs-category-edit', function (e) {
        e.preventDefault();
        var url = $(this).attr('cs-edit-route');
        // console.log(action)
        var id = $(this).attr('id');
        var action = $(this).attr('cs-update-route');

        $.ajax({
            url: $(this).attr('cs-edit-route'),
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function (dataResult) {
                $("#edit_job_category").modal("toggle");
                $('#update-name').attr('value', dataResult.edit.name);
                $('#update-slug').attr('value', dataResult.edit.slug);
                $('#current-edit-img').attr("src", '/images/job/' + dataResult.edit.image);
                $('.updatejobcategory').attr('action', action);
            },
            error: function (error) {
                console.log(error)
            }
        });
    });


    $(document).on('click','.cs-category-remove', function (e) {
        e.preventDefault();
        var form = $('#deleted-form');
        var action = $(this).attr('cs-delete-route');
        form.attr('action',action);
        var url = form.attr('action');
        var form_data = form.serialize();
        Swal.fire({
            html: '<div class="mt-2">' +
                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                'style="width:120px;height:120px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15">' +
                '<h4>Are your sure? </h4>' +
                '<p class="text-muted mx-4 mb-0">' +
                'You want to Remove this Record ?</p>' +
                '</div>' +
                '</div>',
            showCancelButton: !0,
            confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
            cancelButtonClass: "btn btn-danger w-xs mt-2",
            confirmButtonText: "Yes!",
            buttonsStyling: !1,
            showCloseButton: !0
        }).then(function(t)
        {
            t.value
                ?
                $.post( url, form_data)
                    .done(function(response) {
                        if(response.status == "success") {
                            Swal.fire({
                                html: '<div class="mt-2">' +
                                    '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                    'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                    '</lord-icon>' +
                                    '<div class="mt-4 pt-2 fs-15">' +
                                    '<h4>Success !</h4>' +
                                    '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                    '</div>' +
                                    '</div>',
                                timerProgressBar: !0,
                                timer: 2e3,
                                showConfirmButton: !1
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 2500);
                        }else{
                            Swal.fire({
                                html: '<div class="mt-2">' +
                                    '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                    ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                    'style="width:120px;height:120px"></lord-icon>' +
                                    '<div class="mt-4 pt-2 fs-15">' +
                                    '<h4>Oops...! </h4>' +
                                    '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                    '</div>' +
                                    '</div>',
                                timerProgressBar: !0,
                                timer: 3000,
                                showConfirmButton: !1
                            });
                        }
                    })
                    .fail(function(response){
                        console.log(response)
                    })

                :
                t.dismiss === Swal.DismissReason.cancel &&
                Swal.fire({
                    title: "Cancelled",
                    text: "Job Category was not removed.",
                    icon: "error",
                    confirmButtonClass: "btn btn-primary mt-2",
                    buttonsStyling: !1
                });
        });



    });

});
