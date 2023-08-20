@extends('backend.layouts.master')
@section('title') Sliders @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        /*for image*/
        .avatar-upload{
            max-width: 505px!important;
        }

        .current-img{
            border: 6px solid #f3f3f3;
            border-radius: 10px;
        }

        #blog-img{
            border: 6px solid #f3f3f3;
            border-radius: 10px;
        }
        /*end for image*/


    </style>
@endsection
@section('content')


    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Sliders</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Sliders</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'sliders.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-7">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                General details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Heading <span class="text-muted text-danger">*</span></label>
                                <input type="text" maxlength="30" class="form-control" name="heading" required>
                                <div class="invalid-feedback">
                                    Please enter the slider heading.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Sub Heading </label>
                                <input type="text" maxlength="30" class="form-control" name="subheading">
                                <div class="invalid-feedback">
                                    Please enter the slider subheading.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Small description </label>
                                <input type="text" maxlength="100" class="form-control" name="caption1">
                                <div class="invalid-feedback">
                                    Please enter the small summary.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Button details
                            </h4>
                        </div>
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label>Button text </label>
                                <input type="text" maxlength="20" class="form-control" name="button">
                                <div class="invalid-feedback">
                                    Please enter the button text.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Button link </label>
                                <input type="text" class="form-control" name="link">
                                <div class="invalid-feedback">
                                    Please enter the button link.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Slider Image Details <span class="text-muted text-danger">*</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div style="margin: auto;width: 60%;">
                                <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file-input" onchange="loadbasicFile('profile-foreground-img-file-input','current-img',event)" name="image" required
                                        class="profile-foreground-img-file-input" >

                                <figcaption class="figure-caption">*use image minimum of 1920px x 800px </figcaption>
                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                </label>
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <label>Status</label>
                                <br>
                                <select class="form-control select select2" name="status" required>
                                    <option disabled>Select Status</option>
                                    <option value="active" selected>Active</option>
                                    <option value="deactive">Deactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select the status.
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="text-center mt-2 mb-5">
                    <button type="submit" class="btn btn-success w-sm mt-4" >Add Slider</button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="company-doc">
                        <div class="card ctm-border-radius shadow-sm grow">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block mb-0">
                                    Sliders List
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive  mt-3 mb-1">
                                    <table id="slider-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th></th>
                                            <th>Heading</th>
                                            <th>Subheading</th>
                                            <th>Button</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(@$sliders)
                                            @foreach($sliders as  $slider)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$slider->heading}}</td>
                                                    <td>{{$slider->subheading}}</td>
                                                    <td>{{$slider->button}}</td>
                                                    <td>{{(!empty($slider->link)) ?  $slider->link:"Not Set"}}</td>
                                                    <td>
                                                        <div class="text-end">
                                                            <div class="btn-group view-btn" id="user-status-button-{{$slider->id}}">
                                                                <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                                    {{ucwords($slider->status)}}
                                                                </button>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                                    @if($slider->status == "active")
                                                                        <li><a class="dropdown-item change-status" cs-update-route="{{route('sliders-status.update',$slider->id)}}" href="#" cs-status-value="deactive">Deactive</a></li>
                                                                    @else
                                                                        <li><a class="dropdown-item change-status" cs-update-route="{{route('sliders-status.update',$slider->id)}}" href="#" cs-status-value="active">Active</a></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">

                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item action-edit" href="#" hrm-update-action="{{route('sliders.update',$slider->id)}}" hrm-edit-action="{{route('sliders.edit',$slider->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                    <li><a class="dropdown-item action-delete" cs-delete-route="{{route('sliders.destroy',$slider->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
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


    <div class="modal fade" id="editSlider" tabindex="-1" aria-hidden="true">
        <form action="#" method="post" id="deleted-form" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
        </form>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="myModalLabel">Slider Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateslider','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                <div class="modal-body">
                    <h4 class="modal-title mb-3">Update Slider</h4>

                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group mb-3">
                                <label>Heading </label>
                                <input type="text" maxlength="30" class="form-control" name="heading" id="heading" required>
                                <div class="invalid-feedback">
                                    Please enter the slider heading.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Sub Heading </label>
                                <input type="text" maxlength="30" class="form-control" name="subheading" id="subheading">
                                <div class="invalid-feedback">
                                    Please enter the slider subheading.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Small summary </label>
                                <input type="text" maxlength="100" class="form-control" name="caption1" id="caption1">
                                <div class="invalid-feedback">
                                    Please enter the small summary.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Button text</label>
                                <input type="text" class="form-control" name="button" id="button">
                                <div class="invalid-feedback">
                                    Please enter the category button.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Button link </label>
                                <input type="text" class="form-control" name="link" id="link">
                                <div class="invalid-feedback">
                                    Please enter the category name.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="margin: auto;width: 60%;">
                                <img  id="current-edit-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file" onchange="loadbasicFile('profile-foreground-img-file','current-edit-img',event)" name="image"
                                        class="profile-foreground-img-file-input" >

                                <figcaption class="figure-caption">*use image minimum of 1920px x 800px </figcaption>
                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="profile-foreground-img-file" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                </label>
                            </div>
                            <div class="form-group mb-3 mt-3">
                                <label>Status</label>
                                <select class="form-control" name="status" id="sliderstatus" required>
                                    <option disabled>Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="deactive">Deactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select the status.
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

    <script src="{{asset('assets/backend/custom_js/slider.js')}}"></script>

@endsection



