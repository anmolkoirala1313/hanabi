$(document).ready(function () {
    createEditor('ckeditor-classic');
    createEditor('ckeditor-classic-update');
    var dataTable = $('#career-index, #career-inactive-index, #career-all-index').DataTable({
        paging: true,
        searching: true,
        ordering:  false,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    });
});
function createEditor(id){
    ClassicEditor.create(document.querySelector("#"+id))
        .then( editor => {
            window.editor = editor;
            editor.ui.view.editable.element.style.height="200px";
            editor.model.document.on( 'change:data', () => {
                $( '#' + id).text(editor.getData());
            } );
        } )
        .catch(function(e){console.error(e)});
}
var loadbasicFile = function(id1,id2,event) {
    var image       = document.getElementById(id1);
    var replacement = document.getElementById(id2);
    replacement.src = URL.createObjectURL(event.target.files[0]);
};
$(document).on('click','.cs-career-edit', function (e) {
    e.preventDefault();
    var url =  $(this).attr('cs-edit-route');
    var action = $(this).attr('cs-update-route');

    $.ajax({
        url: url,
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult){
            $("#edit_career").modal("toggle");
            console.log(dataResult.date);
            $('#update-name').attr('value',dataResult.edit.name);
            $('#update-slug').attr('value',dataResult.edit.slug);
            $('#update-position').attr('value',dataResult.edit.position);
            $('#update-end_date').attr('value',dataResult.date);
            // $('#update-end_date').attr('data-deafult-date',dataResult.date);
            $('#update-salary').attr('value',dataResult.edit.salary);
            $('#update-type option[value="'+dataResult.edit.type+'"]').prop('selected', true);
            $('#career-publish-status-update option[value="'+dataResult.edit.status+'"]').prop('selected', true);
            $('#meta-description-update').text(dataResult.edit.meta_description);
            $('#meta-title-update').attr('value',dataResult.edit.meta_title);
            $('#meta-keywords-update').attr('value',dataResult.edit.meta_tags);
            editor.setData( dataResult.edit.description );
            $('#current-update-img').attr("src",'/images/career/'+dataResult.edit.feature_image );
            $('.updatecareer').attr('action',action);

        },
        error: function(error){
            console.log(error)
        }
    });
});
function slugMaker(title, slug){
    $("#"+ title).keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#"+slug).val(Text);
    });
}
$(document).on('click','.change-status', function (e) {
    e.preventDefault();
    var status = $(this).attr('cs-status-value');
    var url = $(this).attr('cs-update-route');
    if(status == 'inactive'){
        Swal.fire({
            html: '<div class="mt-2">' +
                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                'style="width:120px;height:120px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15">' +
                '<h4>Are your sure? </h4>' +
                '<p class="text-muted mx-4 mb-0">' +
                'Changing Status to Inactive will prevent career information from being displayed in front</p>' +
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
                statusupdate(url,status)
                :
                t.dismiss === Swal.DismissReason.cancel &&
                Swal.fire({
                    title: "Cancelled",
                    text: "Blog status was not changed.",
                    icon: "error",
                    confirmButtonClass: "btn btn-primary mt-2",
                    buttonsStyling: !1
                });
        });

    }else{
        statusupdate(url,status);
    }

});
$(document).on('click','.cs-career-remove', function (e) {
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

                        setTimeout(function() {
                            location.reload();
                        }, 3000);
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
                text: "Career detail was not removed.",
                icon: "error",
                confirmButtonClass: "btn btn-primary mt-2",
                buttonsStyling: !1
            });
    });



})
function statusupdate(url,status){
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        url: url,
        type: "PATCH",
        cache: false,
        data:{
            status: status,
        },
        success: function(response){
            if(response.status == "success"){
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">Career status has been updated successfully.</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
                setTimeout(function() {
                    location.reload();
                }, 3800);
            }else{

                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...! </h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Career status could not be changed at the moment .</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        },
        error: function() {
            Swal.fire({
                html: '<div class="mt-2">' +
                    '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                    ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                    'style="width:120px;height:120px"></lord-icon>' +
                    '<div class="mt-4 pt-2 fs-15">' +
                    '<h4>Warning...! </h4>' +
                    '<p class="text-muted mx-4 mb-0">' +
                    'Could not confirm the status of the career.</p>' +
                    '</div>' +
                    '</div>',
                timerProgressBar: !0,
                timer: 3000,
                showConfirmButton: !1
            });
        }
    });
}
