@extends('backend.layouts.master')
@section('title', "Testimonials")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .rating_selection {
            text-align: center;
        }
        .rating_selection label:first-of-type {
            display: none;
        }
        .rating_selection input[type=radio],
        .rating_selection span {
            display: none;
        }
        .rating_selection label {
            cursor: pointer;
        }
        .rating_selection label:before {
            display: inline-block;
            content: "★";
            font-size: 40px;
            letter-spacing: 10px;
            color: #e9cd10;
        }
        .rating_selection input:checked + label ~ label:before {
            color: #aaa;
        }
        .rating_selection:hover label[for]:before {
            color: #e9cd10;
        }
        .rating_selection:hover label:hover ~ label:before {
            color: #aaa;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0"> Testimonials</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Testimonials</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4">
                    {!! Form::open(['route' => 'testimonials.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name-input">Provider Name</label>
                                <input type="text" name="name" class="form-control" id="name-input"  maxlength="15"
                                       placeholder="Enter name of testimonial provider" />
                                <div class="invalid-feedback">
                                    Please enter the name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title-position">Position /  Company name</label>
                                <input type="text" name="position" class="form-control" id="title-position" maxlength="18"
                                       placeholder="Enter position/company name of provider" required>
                                <div class="invalid-feedback">
                                    Please enter the position/company name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description-input">Description</label>
                                <textarea class="form-control" maxlength="300" id="description-input" name="description" placeholder="Enter Testimonial description" rows="4" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter the description.
                                </div>
                            </div>
                            <label class="form-label">Image</label>
                            <div class="card">
                                <div class="card-body">
                                    <div style="margin: auto; width: 50%">
                                        <img  id="current-work-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                id="work-foreground-img-file-input" onchange="loadbasicFile('work-foreground-img-file-input','current-work-img',event)" name="image" required
                                                class="work-foreground-img-file-input" >

                                        <figcaption class="figure-caption">Select your related testimonial image (320 x 280px).</figcaption>
                                        <div class="invalid-feedback" >
                                            Please select a image.
                                        </div>
                                        <label for="work-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end card -->

                    <!-- end card -->
                    <div class="text-end mb-3">
                        <button type="submit" class="btn btn-success w-sm form-control">Submit</button>
                    </div>
                    {!! Form::close() !!}



                </div>
                <!-- end col -->

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Call Action List</h4>
                        </div>
                        <div class="card-body">

                            <div class="row" >

                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="testimonial-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="call-action-list">
                                        @if(!empty($testimonials))
                                            @foreach($testimonials as  $testimonial)
                                                <tr>
                                                    <td >
                                                        <img src="{{asset('/images/testimonial/'.@$testimonial->image)}}" alt="{{@$testimonial->name}}" class="figure-img rounded avatar-lg">
                                                    </td>
                                                    <td>{{ ucwords(@$testimonial->name) }}</td>
                                                    <td>{{ ucwords(@$testimonial->position) }}</td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item cs-testimonial-edit"  cs-update-route="{{route('testimonials.update',$testimonial->id)}}" cs-edit-route="{{route('testimonials.edit',$testimonial->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                    <li><a class="dropdown-item cs-testimonial-remove" cs-delete-route="{{route('testimonials.destroy',$testimonial->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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
                            </div><!--end row-->
                            <form action="#" method="post" id="deleted-form">
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    @include('backend.testimonial.modal.edit')


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
{{--    <script src="{{asset('assets/backend/custom_js/callaction.js')}}"></script>--}}
<script>
    $(document).ready(function () {
        $('#testimonial-index').DataTable({
            paging: true,
            searching: true,
            ordering:  false,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
        });
    });
    var loadbasicFile = function(id1,id2,event) {
        var image       = document.getElementById(id1);
        var replacement = document.getElementById(id2);
        replacement.src = URL.createObjectURL(event.target.files[0]);
    };

    $(document).on('click','.cs-testimonial-edit', function (e) {
        e.preventDefault();
        var action = $(this).attr('cs-update-route');
        $.ajax({
            url: $(this).attr('cs-edit-route'),
            type: "GET",
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                // $('#id').val(data.id);
                $("#edit_testimonial").modal("toggle");
                $('#update-name').attr('value',dataResult.name);
                $('#update-position').attr('value',dataResult.position);
                $('#update-description').text(dataResult.description);
                $('#current-update-img').attr("src", '/images/testimonial/' + dataResult.image);
                $('.updatetestimonial').attr('action',action);
            },
            error: function(error){
                console.log(error)
            }
        });
    });

    $(document).on('click','.cs-testimonial-remove', function (e) {
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
                    text: "Testimonial detail was not removed.",
                    icon: "error",
                    confirmButtonClass: "btn btn-primary mt-2",
                    buttonsStyling: !1
                });
        });



    })

</script>

@endsection
