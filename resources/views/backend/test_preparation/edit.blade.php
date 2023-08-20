@extends('backend.layouts.master')
@section('title', "Edit Test Preparation")
@section('css')

    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .blog-feature-image{
        }
        .feature-image-button{
            /*position: absolute;*/
            top: 25%;
        }
        .profile-foreground-img-file-input {
            display: none;
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
                        <h4 class="mb-sm-0">Edit Test Preparation</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('test-preparation.index')}}">Test Preparation</a></li>
                                <li class="breadcrumb-item active">Edit Test Preparation</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            {!! Form::open(['url'=>route('test-preparation.update', @$edit->id),'method'=>'put','class'=>'needs-validation submit_form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

            <div class="row">


                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label>Title <span class=" text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{ @$edit->title }}" required>
                                <div class="invalid-feedback">
                                    Please enter the title.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="choices-publish-status-input" class="form-label">Status</label>

                                <select class="form-select" id="choices-publish-status-input" name="status" data-choices data-choices-search-false>
                                    <option value="publish" @if(@$edit->status == "publish") selected @endif>Published</option>
                                    <option value="draft" @if(@$edit->status == "draft") selected @endif>Draft</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Summary</label>
                                <textarea class="form-control" maxlength="300" name="summary" placeholder="Enter description" rows="3">{{ @$edit->summary }}</textarea>
                                <div class="invalid-tooltip">
                                    Please enter summary
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Enter Description</label>
                                <textarea class="form-control" id="task-textarea" name="description" placeholder="Enter description" rows="3">{{ @$edit->description }}</textarea>
                                <div class="invalid-tooltip">
                                    Please enter description
                                </div>
                            </div>

                        </div>
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
                                                <input type="text" class="form-control" placeholder="Enter meta title" name="meta_title" value="{{@$edit->meta_title}}"  id="meta-title-input">
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="meta-keywords-input">Meta Keywords</label>
                                                <input type="text" class="form-control" placeholder="Enter meta keywords" name="meta_tags" value="{{@$edit->meta_tags}}"  id="meta-keywords-input" data-choices data-choices-text-unique-true>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div>
                                        <label class="form-label" for="meta-description-input">Meta Description</label>
                                        <textarea class="form-control" id="meta-description-input" placeholder="Enter meta description" name="meta_description" rows="3">{{@$edit->meta_description}}</textarea>
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
                        <button type="submit" class="btn btn-success w-sm" id="submit-form">Submit</button>
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
                                    <img  id="current-img"   src="{{ ($edit->image !== null) ? asset('images/test_preparation/'.$edit->image) :  asset('images/default-image.jpg') }}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                    <input  type="file" accept="image/png, image/jpeg" hidden
                                            id="profile-foreground-img-file-input" onchange="loadFile(event)" name="image_input"
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
    <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('profile-foreground-img-file-input');
            var replacement = document.getElementById('current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
        $(document).ready(function () {
            CKEDITOR.replace('task-textarea',{
                allowedContent: true
            });
        });

        $('#submit-form').click( function(e) {
            e.preventDefault();

            var editor_data = CKEDITOR.instances['task-textarea'].getData();
            $('#task-textarea').text(editor_data);


            $('.submit_form').submit()

        });



    </script>
@endsection
