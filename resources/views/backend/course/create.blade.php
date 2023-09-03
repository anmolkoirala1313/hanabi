@extends('backend.layouts.master')
@section('title', "Add Course")
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>

            .feature-image-button{
                /*position: absolute;*/
                top: 25%;
            }
            .profile-foreground-img-file-input {
                display: none;
            }

            .add-disabled{
                pointer-events: none;
                opacity: 0.8;
            }
            .select2-container--default .select2-selection--single {
                background-color: #fff;
                border: 1px solid #ced4db;
                border-radius: 4px;
                height: 40px;
                padding: 5px 2px;
            }
    </style>
@endsection
@section('content')


    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('course.index')}}">Course</a></li>
                                <li class="breadcrumb-item active">Create Course</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            {!! Form::open(['route' => 'course.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

            <div class="row">

                <div class="col-lg-8">

                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label>Title <span class=" text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required>
                                    <div class="invalid-feedback">
                                        Please enter the title.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Country</label>
                                    <select class="form-control select2" name="country">
                                        <option disabled>Select Country</option>
                                        @foreach($countries as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select the country.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="choices-publish-status-input" class="form-label">Status</label>

                                    <select class="form-select" id="choices-publish-status-input" name="status" data-choices data-choices-search-false>
                                        <option value="publish" selected>Published</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Description <span class=" text-danger">*</span></label>

                                    <textarea class="form-control" id="ckeditor-classic-blog" name="description" placeholder="Enter description" rows="3" required></textarea>
                                    <div class="invalid-tooltip">
                                        Please enter description
                                    </div>
                                </div>

{{--                                <div class="mb-3">--}}
{{--                                    <label>living description</label>--}}

{{--                                    <textarea class="form-control" id="living" name="living" placeholder="Enter living description" rows="3"></textarea>--}}
{{--                                    <div class="invalid-tooltip">--}}
{{--                                        Please enter description--}}
{{--                                    </div>--}}

{{--                                </div>--}}

{{--                                <div class="mb-3">--}}
{{--                                    <label>Entry requirement description</label>--}}
{{--                                    <textarea class="form-control" id="entry_requirement" name="entry_requirement" placeholder="Enter entry requirements description" rows="3"></textarea>--}}
{{--                                    <div class="invalid-tooltip">--}}
{{--                                        Please enter description--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label>Visa requirement description</label>--}}
{{--                                    <textarea class="form-control" id="visa_requirement" name="visa_requirement" placeholder="Enter visa requirement" rows="3"></textarea>--}}
{{--                                    <div class="invalid-tooltip">--}}
{{--                                        Please enter description--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label>Education cost description</label>--}}
{{--                                    <textarea class="form-control" id="education_cost" name="education_cost" placeholder="Enter education cost description" rows="3"></textarea>--}}
{{--                                    <div class="invalid-tooltip">--}}
{{--                                        Please enter description--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label>After graduation description</label>--}}
{{--                                    <textarea class="form-control" id="after_graduation" name="after_graduation" placeholder="Enter after graduation description" rows="3"></textarea>--}}
{{--                                    <div class="invalid-tooltip">--}}
{{--                                        Please enter description--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3">--}}
{{--                                    <label>Useful Link description</label>--}}
{{--                                    <textarea class="form-control" id="useful_links" name="useful_links" placeholder="Enter useful links description" rows="3"></textarea>--}}
{{--                                    <div class="invalid-tooltip">--}}
{{--                                        Please enter description--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Additional Information</h4>
                                <h6 class="card-subtitle font-14 mt-1 text-muted">Create upto 8 different description section for your courses</h6>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div id="multi-field-wrapper">
                                    <div id="multi-fields">
                                        <div class="multi-field custom-card mt-3" style="border-bottom: double #e3e3e3; ">
                                            <label>Title </label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="detail_title" name="detail_title[]" />
                                                <button class="btn btn-danger remove-field"><i class="ri-delete-bin-line" aria-hidden="true"></i></button>
                                                <div class="invalid-feedback">
                                                    Please enter a title.
                                                </div>
                                            </div>
                                            <div class="row mb-3 attribute-values" id="addValues">
                                                <div class="col-md-12 col-6">
                                                    <label for="icon_description" class="text-heading">Description<span class="text-muted text-danger">*</span></label>
                                                    <textarea class="form-control" id="icon_description" maxlength="600" name="detail_description[]">

                                                </textarea>
                                                    <div class="invalid-feedback">
                                                        Please enter a description.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end mt-3 mb-3">
                                        <a href="javascript:void(0)" class="btn btn-success" id="add-field"><i class="ri-add-line" aria-hidden="true"></i> Add More </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>

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

                                        <div>
                                            <label class="form-label" for="meta-description-input">Meta Description</label>
                                            <textarea class="form-control" id="meta-description-input" placeholder="Enter meta description"  name="meta_description" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>



                </div>
                <!-- end col -->

                <div class="col-lg-4 ">
                    <div class="sticky-side-div">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Feature Image</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                    <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file-input" onchange="loadFile(event)" name="image"
                                       class="profile-foreground-img-file-input" >

{{--                                    <figcaption class="figure-caption">*use image minimum of 1280 x 720px </figcaption>--}}
                                    <div class="invalid-feedback" >
                                            Please select a image.
                                        </div>
                                    <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                        <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                    </label>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                    </div>
                </div>

            </div>
            {!! Form::close() !!}

            <!-- end row -->

        <!-- container-fluid -->
        </div>
    </div>

@endsection

@section('js')
<script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>

<script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <!-- Sweet Alerts js -->
<script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/backend/custom_js/blog_credit.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@include('backend.course.includes.script')
@endsection
