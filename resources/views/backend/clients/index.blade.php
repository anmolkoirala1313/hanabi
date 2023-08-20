@extends('backend.layouts.master')
@section('title') Clients @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')


    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Clients</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Clients</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'clients.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-8">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Client details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="name">

                                <div class="invalid-feedback">
                                    Please select the company name.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Website Link </label>
                                <input type="text" class="form-control" name="link">
                                <div class="invalid-feedback">
                                    Please enter the category name.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Country <span class="text-muted text-danger">*</span></label>
                                <select class="form-control select select2" name="country" required>
                                    <option disabled>Select Country</option>
                                    @foreach($countries as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Please select the country.
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-sm mt-4" >Add Client</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Client Image Details <span class="text-muted text-danger">*</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div style="margin: auto;width: 60%;">
                                <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file-input" onchange="loadbasicFile('profile-foreground-img-file-input','current-img',event)" name="image" required
                                        class="profile-foreground-img-file-input" >

                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                </label>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="company-doc">
                        <div class="card ctm-border-radius shadow-sm grow">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block mb-0">
                                    Client List
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="client-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Client Image</th>
                                            <th>Name</th>
                                            <th>Link</th>
                                            <th>Country</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="blog-list">
                                        @if(@$clients)
                                            @foreach($clients as  $client)
                                                <tr>
                                                    <td class="align-middle pt-6 pb-4 px-6">
                                                        <img src="{{asset('/images/clients/'.@$client->image)}}" alt="{{@$client->slug}}" class="figure-img rounded avatar-lg">

                                                    </td>
                                                    <td>{{(!empty($client->name)) ?  $client->name:"Not Set"}}</td>
                                                    <td>{{(!empty($client->link)) ?  $client->link:"Not Set"}}</td>
                                                    <td><?php
                                                        if(!empty($client->country)){
                                                            foreach ($countries as $key=>$value){
                                                                if($client->country == $key){
                                                                    echo $value;
                                                                }
                                                            }
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <div class="row">

                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item action-edit" href="#" hrm-update-action="{{route('clients.update',$client->id)}}" hrm-edit-action="{{route('clients.edit',$client->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                    <li><a class="dropdown-item action-delete" cs-delete-route="{{route('clients.destroy',$client->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editClient" tabindex="-1" aria-hidden="true">
        <form action="#" method="post" id="deleted-form" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
        </form>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="myModalLabel">Page Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
                    {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateclient','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                    <div class="modal-body">
                        <h4 class="modal-title mb-3">Edit Clients</h4>
                        <div class="row">

                            <div class="col-md-7">
                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">
                                            Client Details
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" name="name" id="name">

                                            <div class="invalid-feedback">
                                                Please select the company name.
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Link </label>
                                            <input type="text" class="form-control" name="link" id="link">
                                            <div class="invalid-feedback">
                                                Please enter the category name.
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Country <span class="text-muted text-danger">*</span></label>
                                            <br>
                                            <select class="form-control select select2" name="country" id="country" required>
                                                <option disabled>Select Country</option>
                                                @foreach($countries as $key => $value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the country.
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">
                                            Client Image Details <span class="text-muted text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">

                                        <div style="margin: auto;width: 60%;">
                                            <img id="current-edit-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="image-edit" onchange="loadbasicFile('image-edit','current-edit-img',event)" name="image"
                                                    class="profile-foreground-img-file-input" >
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <label for="image-edit" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Update Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-success w-sm mt-4">Update</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript">

        var loadbasicFile = function(id1,id2,event) {
            var image       = document.getElementById(id1);
            var replacement = document.getElementById(id2);
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };


        $(document).ready(function () {
            $('#client-index').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            });


            $(document).on('click', '.action-edit', function (e) {
                e.preventDefault();
                var url = $(this).attr('hrm-edit-action');
                // console.log(action)
                var id = $(this).attr('id');
                var action = $(this).attr('hrm-update-action');

                $.ajax({
                    url: $(this).attr('hrm-edit-action'),
                    type: "GET",
                    cache: false,
                    dataType: 'json',
                    success: function (dataResult) {
                        // $('#id').val(data.id);
                        $("#editClient").modal("toggle");
                        $('#name').attr('value', dataResult.edit.name);
                        $('#link').attr('value', dataResult.edit.link);
                        $.each(dataResult.countries, function (index, value) {
                            if(index==dataResult.edit.country){
                                $('#select2-country-container').text(value);
                            }
                        });
                        $('#country option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                        $('#current-edit-img').attr("src", '/images/clients/' + dataResult.edit.image);
                        $('.updateclient').attr('action', action);

                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });


            $(document).on('click','.action-delete', function (e) {
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
                            text: "Client was not removed.",
                            icon: "error",
                            confirmButtonClass: "btn btn-primary mt-2",
                            buttonsStyling: !1
                        });
                });



            });

        });


    </script>
@endsection



