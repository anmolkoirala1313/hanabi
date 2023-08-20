//setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval  = 1000;  //time in ms, 1 second for example
var $input              = $('#oldpasswordInput');
var $input2             = $('#removeaccountPassword');
var allclearpass        = 'no';
var $inputPass          = $('#confirmpasswordInput');
var request_method      = 'POST'; //get form GET/POST method


//on keyup, start the countdown
$input.on('keyup click', function () {
    clearTimeout(typingTimer);
});

//on keydown, clear the countdown
$input.on('keydown blur', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

$input2.on('keyup click', function () {
    clearTimeout(typingTimer);
});

//on keydown, clear the countdown
$input2.on('keydown blur', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(removeAcc, doneTypingInterval);
});

$inputPass.on('keyup click', function () {
    checkPasswordMatch();
});


//user is "finished typing," do something
function doneTyping() {
    var value  = $input.val();
    var userID = $('#userid').val();
    var url = $input.attr("cs-check-route");
    var formData = new FormData();
    formData.append('oldpassword', value);
    formData.append('userid', userID);

    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status =='error'){
                $('#profile-password-btn').prop('disabled', true);
                $('#old-password-error').css('display', 'block');
                $('#old-password-error').css('color', '');
                $('#old-password-error').text(response.message);
                allclearpass = 'no';
                // old-password-error
            }else{
                $('#profile-password-btn').prop('disabled', false);
                $('#old-password-error').css('display', 'block');
                $('#old-password-error').css('color', '#0ab39c');
                $('#old-password-error').text(response.message);
                allclearpass = 'clear';
            }
        },
        error: function(response) {
            console.log(response);
        }
    })
}

function removeAcc() {
    var value  = $input2.val();
    var userID = $('#userid').val();
    var url = $input2.attr("cs-check-route");
    var formData = new FormData();
    formData.append('oldpassword', value);
    formData.append('userid', userID);

    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status =='error'){
                $('#close-acc-btn').prop('disabled', true);
                $('#remove-acc-error').css('display', 'block');
                $('#remove-acc-error').css('color', '');
                $('#remove-acc-error').text(response.message);
            }else{
                $('#close-acc-btn').prop('disabled', false);
                $('#remove-acc-error').css('display', 'block');
                $('#remove-acc-error').css('color', '#0ab39c');
                $('#remove-acc-error').text(response.message);
            }
        },
        error: function(response) {
            console.log(response);
        }
    })
}

function checkPasswordMatch() {
    var password = $('#newpasswordInput').val();
    var confirmPassword = $inputPass.val();
    if (password !== confirmPassword) {
        $('#profile-password-btn').prop('disabled', true);
        $('#confirm-password-error').css('display', 'block');
        $('#confirm-password-error').css('color', '');
        $('#confirm-password-error').text("Your confirm password doesn't match.");
    } else {
        if(allclearpass == 'clear'){
            $('#profile-password-btn').prop('disabled', false);
        }
        $('#confirm-password-error').css('display', 'block');
        $('#confirm-password-error').css('color', '#0ab39c');
        $('#confirm-password-error').text("Your confirm is a match.");
    }
}

$('#profile-foreground-img-file-input, #profile-img-file-input').on('change', function() {
    var cover  = this.files[0];
    var userID = $('#userid').val();
    var name   = $(this).attr("name");
    var url    = $(this).attr("cs-update-route");
    var imagereplaceID = '#header-profile-user-updates';
    var formData = new FormData();
    formData.append('name', name);
    formData.append('userid', userID);
    formData.append('image', cover);
    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status=='success'){
                if(name == 'image'){
                    var imagename = 'profile image';
                    $(imagereplaceID).attr("src",'/images/user/'+response.image );
                }else{
                    var imagename = 'cover photo';
                }
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your '+ imagename +' has been changed .</p>'
                        + '</div>' +
                        '</div>',
                    animation: !1,
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
            }
            else{
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...!</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your'+ imagename +' could not be changed at the moment .</p>'
                        + '</div>' +
                        '</div>',
                    animation: !1,
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        },
        error: function(response) {
            console.log(response);
        }
    })


});

$('#profile-password-btn').on('click', function() {
    var form            = $('#profile-password-form')[0]; //get the form using ID
    if (!form.reportValidity()) { return false;}
    var formData        = new FormData(form); //Creates new FormData object
    var url             = $(this).attr("cs-store-route");
    var request_method  = 'POST'; //get form GET/POST method
    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status=='success'){
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your password has been changed .</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
                $('#oldpasswordInput').val('');
                $('#newpasswordInput').val('');
                $('#confirmpasswordInput').val('');
                $('#old-password-error').css('display', 'none');
                $('#confirm-password-error').css('display', 'none');
            }
            else{
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...! </h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'Your password could not be changed at the moment .</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
});

$('#close-acc-btn').on('click', function() {
    var userID          = $('#userid').val();
    var formData        = new FormData(); //Creates new FormData object
    formData.append('userid', userID);
    var url             = $(this).attr("cs-remove-route");
    var request_method  = 'POST'; //get form GET/POST method

    Swal.fire({
        html: '<div class="mt-3">' +
            '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" ' +
            'trigger="loop" colors="primary:#f7b84b,secondary:#f06548" ' +
            'style="width:100px;height:100px">' +
            '</lord-icon>' +
            '<div class="mt-4 pt-2 fs-15 mx-5">' +
            '<h4>Are you Sure ?</h4>' +
            '<p class="text-muted mx-4 mb-0">You will not be able to revert this!' +
            '</p>' +
            '</div>' +
            '</div>',
        showCancelButton: !0,
        confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
        cancelButtonClass: "btn btn-danger w-xs mt-2",
        confirmButtonText: "Yes, delete it!",
        buttonsStyling: !1,
        showCloseButton: !0
    }).then(function(t)
    {
        t.value
            ?
            $.ajax({
                type : request_method,
                url : url,
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success: function(response){
                    if(response.status=='success'){
                        Swal.fire({
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                '</lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Success !</h4>' +
                                '<p class="text-muted mx-4 mb-0">' +
                                response.message +
                                '</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 2e3,
                            showConfirmButton: !1
                        });
                        $('#removeaccountPassword').val('');
                        $('#remove-acc-error').css('display', 'none');
                        setTimeout(function() {
                            $('#logout-header').click();
                        }, 2800);
                    }
                    else{
                        Swal.fire({
                            html: '<div class="mt-2">' +
                                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                'style="width:120px;height:120px"></lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Oops...! </h4>' +
                                '<p class="text-muted mx-4 mb-0">' +
                                response.message +'</p>' +
                                '</div>' +
                                '</div>',
                            timerProgressBar: !0,
                            timer: 3000,
                            showConfirmButton: !1
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            })
            :
            t.dismiss === Swal.DismissReason.cancel &&
            Swal.fire({
                title: "Cancelled",
                text: "Phew, your credentials are safe. ",
                icon: "error",
                confirmButtonClass: "btn btn-primary mt-2",
                buttonsStyling: !1
            });
    });

});

$('#socials-update').on('click', function(e) {
    e.preventDefault();
    var userID          = $('#userid').val();
    var form            = $('#socials-form')[0]; //get the form using ID
    if (!form.reportValidity()) { return false;}
    var formData        = new FormData(form); //Creates new FormData object
    formData.append('userid', userID);
    var url             = $(this).attr("cs-create-route");
    var request_method  = 'POST'; //get form GET/POST method
    $.ajax({
        type : request_method,
        url : url,
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        },
        cache: false,
        contentType: false,
        processData: false,
        data : formData,
        success: function(response){
            if(response.status=='success'){
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                        'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                        '</lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Success !</h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        response.message +
                        '</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 2e3,
                    showConfirmButton: !1
                });
            }
            else{
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Oops...! </h4>' +
                        '<p class="text-muted mx-4 mb-0">' + response.message +
                        '</p>' +
                        '</div>' +
                        '</div>',
                    timerProgressBar: !0,
                    timer: 3000,
                    showConfirmButton: !1
                });
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
});


