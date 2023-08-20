@extends('backend.layouts.master')
@section('title', "Create Services")
@section('css')
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .hidden{
            display:none!important;
        }
        .dropdown-item{
            cursor: pointer;
        }
        .feature-image-button{
            position: absolute;
            top: 25%;
        }
        .profile-foreground-img-file-input {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            {!! Form::open(['route' => 'services.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Services</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('services.index')}}">Services</a></li>
                                <li class="breadcrumb-item active">Create Service</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="service-title-input"> Title</label>
                                <input type="text" class="form-control" id="service-title-input" name="title" onclick="slugMaker('service-title-input','service-slug-input')"
                                       placeholder="Enter service title" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="service-slug-input">Slug</label>
                                <input type="text" class="form-control" id="service-slug-input" name="slug"
                                       placeholder="Enter service slug" required>
                            </div>

                            <div class="mb-3 position-relative">
                                <label class="form-label">Service Description</label>
                                <textarea class="form-control" id="ckeditor-classic" name="description" placeholder="Enter service description" rows="4" required></textarea>
                                <div class="invalid-tooltip">
                                    Please enter the service description.
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#addblog-metadata"
                                       role="tab">
                                        Meta Data
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- end card header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="addblog-metadata" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta-title-input">Meta title</label>
                                                <input type="text" class="form-control" placeholder="Enter meta title" name="meta_title" id="meta-title-input">
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                                <input type="text" class="form-control" placeholder="Enter meta keywords" name="meta_tags" id="meta-keywords-input" data-choices data-choices-text-unique-true>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="position-relative">
                                        <label class="form-label" for="meta-description-input">Meta Description</label>
                                        <textarea class="form-control" id="meta-description-input" placeholder="Enter meta description" name="meta_description" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- end tab pane -->
                            </div>
                            <!-- end tab content -->
                        </div>
                        <!-- end card body -->
                    </div>


                    <div class="text-end mb-4">
                        <button type="submit" class="btn btn-success w-sm">Create</button>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-4">
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h5 class="card-title mb-0">Footer Action</h5>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <div>--}}
{{--                                <label for="choices-privacy-status-input" class="form-label">Call Action</label>--}}
{{--                                <select class="form-select" data-choices data-choices-search-false--}}
{{--                                        id="choices-privacy-status-input" name="call_action_id">--}}
{{--                                    <option value disabled selected>Select Call Action</option>--}}
{{--                                    @foreach(@$callaction as $ca)--}}
{{--                                        <option value="{{$ca->id}}">{{@$ca->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- end card body -->--}}
{{--                    </div>--}}
                    <!-- end card -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Add on</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <label for="sub-title-status-input" class="form-label">Sub Description</label>
                                <textarea class="form-control" id="sub-title-status-input" placeholder="Enter sub description" name="sub_description" rows="4"></textarea>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Banner Image</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file-input" onchange="loadbasicFile('profile-foreground-img-file-input','current-img',event)" name="banner_image" required
                                        class="profile-foreground-img-file-input" >

                                <figcaption class="figure-caption">Banner image for current service. (Size:  850 x 567px)</figcaption>
                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Banner Image
                                </label>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>

                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>

            {!! Form::close() !!}

        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>

    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <script src="{{asset('assets/backend/js/pages/project-create.init.js')}}"></script>

    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/backend/custom_js/servicecredit.js')}}"></script>

@endsection
