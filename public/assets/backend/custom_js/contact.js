$(document).on('click','.edit-item-btn', function (e) {
    e.preventDefault();
    var url =  $(this).attr('contact-edit-action');
    // console.log(action)
    $.ajax({
        url: $(this).attr('contact-edit-action'),
        type: "GET",
        cache: false,
        dataType: 'json',
        success: function(dataResult){
            console.log(dataResult)
            // $('#id').val(data.id);
            $('#customername-field').attr('value',dataResult.name);
            $('#email-field').attr('value',dataResult.email);
            $('#phone-field').attr('value',dataResult.phone);
            $('#subject-field').attr('value',dataResult.subject);
            $('#message-field').val(dataResult.message);
        },
        error: function(error){
            console.log(error)
        }
    });
});

$(document).on('click','.remove-item-btn', function (e) {
    e.preventDefault();
    var form = $('#deleted-form');
    var action = $(this).attr('contact-delete-action');
    form.attr('action',$(this).attr('contact-delete-action'));
    var url = form.attr('action');
    var form_data = form.serialize();
    // $('.deleterole').attr('action',action);
    Swal.fire({
        html: '<div class="mt-2">' +
                '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"' +
                ' trigger="loop" colors="primary:#f7b84b,secondary:#f06548" ' +
                'style="width:100px;height:100px"></lord-icon>' +
                '<div class="mt-4 pt-2 fs-15">' +
                '<h4>Are your sure? </h4>' +
                '<p class="text-muted mx-4 mb-0">' +
                'You want to Remove this Record ?</p>' +
                '</div>' +
                '</div>',
        showCancelButton:!0,
        confirmButtonClass:"btn btn-primary w-xs me-2 mt-2",
        cancelButtonClass:"btn btn-danger w-xs mt-2",
        confirmButtonText:"Yes, delete it!",
        buttonsStyling:!1,
        showCloseButton:!0
    }).then(function(t)
    {
            t.value
                ?
                $.post(url, form_data)
                    .done(function(response) {
                        console.log(response);
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
                            var contact_block = '#customer-block-num-'+response.id;
                            setTimeout(function() {
                                $(contact_block).remove();
                            }, 3800);
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
                    text: "Customer Contact was not removed.",
                    icon: "error",
                    confirmButtonClass: "btn btn-primary mt-2",
                    buttonsStyling: !1
                });
        });

    })
