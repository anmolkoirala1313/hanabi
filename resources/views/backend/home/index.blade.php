@extends('backend.layouts.master')
@section('title', "Home Setting")
@section('css')
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <style>
        .icons-select option {
            text-transform: capitalize;
        }

        .icons-select {
            font-family: 'FontAwesome';
            font-weight: 500;
        }

        .hidden{
            display:none!important;
        }
        .dropdown-item{
            cursor: pointer;
        }

        .feature-image-button{
            /*position: absolute;*/
            top: 25%;
        }

        .profile-foreground-img-file-input {
            display: none;
        }

        label.profile-photo-edit.btn.btn-light.feature-side-image-button {
            position: absolute;
            bottom: 25%;
        }
    </style>
@endsection


@section('content')
    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mt-n4 mx-n4">
                        <div class="bg-soft-warning">
                            <div class="card-body pb-0 px-4">
                                <div class="row mb-3">
                                    <div class="col-md">
                                        <div class="row align-items-center g-3">

                                            <div class="col-md">
                                                <div>
                                                    <h4 class="fw-bold">

                                                         Home Page Settings</h4>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto" style="    margin-top: 1rem;">
                                        <div class="hstack gap-1 flex-wrap">
                                            <div class="d-sm-flex align-items-center justify-content-between">

                                                <div class="page-title-right">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                                        <li class="breadcrumb-item active">{{str_replace('-',' ',ucwords(Request::segment(2)))}}</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#welcome-tab"
                                           role="tab">
                                            Welcome Section                                        </a>
                                    </li>
                                    @if($homesettings !== null)
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-core-action"--}}
{{--                                               role="tab">--}}
{{--                                                Core Values--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-missionvision-action"
                                               role="tab">
                                                Mission Vision Values
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-call-action"
                                               role="tab">
                                                Call Action
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-recruitment-action"
                                               role="tab">
                                                Our Work Process
                                            </a>
                                        </li>

{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#status-overview"--}}
{{--                                               role="tab">--}}
{{--                                                General Grievance--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <li class="nav-item">--}}
{{--                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-what-makes-us-action"--}}
{{--                                               role="tab">--}}
{{--                                                What makes us different?--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

                                        <li class="nav-item">
                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#simple-why-us-action"
                                               role="tab">
                                                Why us?
                                            </a>
                                        </li>

                                    @endif
                                </ul>
                            </div>
                            <!-- end card body -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content text-muted">
                        <div class="tab-pane fade show active" id="welcome-tab" role="tabpanel">
                            @if($homesettings !== null)
                                {!! Form::open(['url'=>route('homepage.update', @$homesettings->id),'id'=>'homesettings-info-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                            @else
                                {!! Form::open(['route' => 'homepage.store','method'=>'post','class'=>'needs-validation','id'=>'homesettings-info-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            @endif
                                <div class="row  mb-4">
                                    <div class="col-lg-8">
                                            <figure class="figure">
                                                <img src="{{asset('images/welcome.png')}}" class="figure-img img-fluid rounded" alt="...">
                                                <figcaption class="figure-caption">Output Sample.</figcaption>
                                            </figure>
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="welcome-heading-input">Heading <span class="text-muted text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="welcome-heading-input" name="welcome_heading" value="{{@$homesettings->welcome_heading}}"
                                                               placeholder="Enter  heading" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="welcome-subheading-input">Sub Heading </label>
                                                        <input type="text" class="form-control" id="welcome-subheading-input" name="welcome_subheading" value="{{@$homesettings->welcome_subheading}}"
                                                               placeholder="Enter  subheading">
                                                    </div>
                                                    <div class="position-relative mb-3">
                                                        <label> Description <span class="text-muted text-danger">*</span></label>
                                                        <textarea class="form-control" maxlength="1025" name="welcome_description" placeholder="Enter welcome description" rows="8" required>{{@$homesettings->welcome_description}}</textarea>
                                                        <div class="invalid-tooltip">
                                                            Please enter the  description.
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Button Text </label>
                                                        <input type="text" maxlength="20" class="form-control" value="{{@$homesettings->welcome_button}}" name="welcome_button">
                                                        <div class="invalid-feedback">
                                                            Please enter the button text.
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Button Link </label>
                                                        <input type="text" class="form-control" value="{{@$homesettings->welcome_link}}" name="welcome_link">
                                                        <div class="invalid-feedback">
                                                            Please enter the button link.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card -->



                                            <!-- end card -->
                                            <div class="text-end mb-3">
                                                <button type="submit" class="btn btn-success w-sm">{{($homesettings !== null) ? "Update Home Settings":"Save Home Settings"}}</button>
                                            </div>



                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-4">
                                        <div class="sticky-side-div">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-title mb-0">Other Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <img  id="current-img"  src="{{ (@$homesettings->welcome_image !== null) ? asset('images/home/welcome/'.@$homesettings->welcome_image) :  asset('images/default-image.jpg') }}" class="position-relative img-fluid img-thumbnail welcome-feature-image" >
                                                        <input  type="file" accept="image/png, image/jpeg" hidden
                                                            id="profile-foreground-img-file-input" onchange="loadFile(event)" name="welcome_image" {{ (@$homesettings->welcome_image !== null) ? '' :  'required' }}
                                                        class="profile-foreground-img-file-input" >

                                                        <figcaption class="figure-caption">*use image minimum of 800 x 760px </figcaption>
                                                        <div class="invalid-feedback" >
                                                                Please select a image.
                                                            </div>
                                                        <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                                            <i class="ri-image-edit-line align-bottom me-1"></i> Add  Image
                                                        </label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="welcome-video-input">Youtube Video Link </label>
                                                        <input type="text" class="form-control" id="welcome-video-input" name="welcome_video_link" value="{{@$homesettings->welcome_video_link}}"
                                                               placeholder="Enter video link">
                                                    </div>
                                                </div>
                                                <!-- end card body -->
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            {!! Form::close() !!}

                        </div>
                        @if($homesettings !== null)

{{--                           @include('backend.home.includes.core_value_tab')--}}

                           @include('backend.home.includes.mission_vision_tab')

{{--                           @include('backend.home.includes.what_makes_us_tab')--}}

                           @include('backend.home.includes.why_us_tab')

                           @include('backend.home.includes.call_action_tab')

                           @include('backend.home.includes.recruitment_process')

{{--                           @include('backend.home.includes.status')--}}

                        @endif

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>



@endsection

@section('js')
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>


    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/backend/custom_js/homepage.js')}}"></script>
    <script type="text/javascript">
        var all_process = [];
        <?php foreach(@$recruitment as $key => $val){ ?>
        all_process.push('<?php echo $val->id; ?>');
        <?php } ?>

        $(document).ready(function () {
            if(all_process.length==9){
                $('#add-field').addClass('add-disabled');
            }else{
                $('#add-field').removeClass('add-disabled');
            }
        });

        var counter = 0;
        $('#multi-field-wrapper').each(function() {
            var $wrapper = $('#multi-fields', this);

            //disable the delete button if the cloned div is just one
            clonecount = $('.multi-field').length;
            if(clonecount == 1){
                $('.remove-field').addClass('add-disabled');
            }

            $("#add-field", $(this)).click(function(e) {
                counter++;
                clonecount = clonecount + 1;
                //remove the disable option for button once the cloned div is more than 1
                if(clonecount > 1){
                    $('.remove-field').removeClass('add-disabled');
                }
                if(clonecount > 8){
                    $('#add-field').addClass('add-disabled');
                }
                //clone the element and add the id to div to make select field unique.
                var newElem = $('.multi-field:last-child', $wrapper).clone(true).appendTo($wrapper).attr('id', 'cloned-' + counter).find("input").val("");
                //remove the initial id from select and add new ID
                $('.multi-field').find('select').last().removeAttr('id').attr('id', 'icon_clone_' + counter).find('option').focus();
                $('.multi-field').find('textarea').last().val('');

                $('.multi-field').find('select').last().val('');
            });

            $('.multi-field .remove-field', $wrapper).click(function() {
                clonecount = clonecount - 1;
                if(clonecount < 9){
                    $('#add-field').removeClass('add-disabled');
                }
                if(clonecount == 1){
                    $('.remove-field').addClass('add-disabled');
                }else if (clonecount > 1){
                    $('.remove-field').removeClass('add-disabled');
                }
                if ($('.multi-field', $wrapper).length > 1){
                    $(this).parent('.input-group').parent('.multi-field').remove();
                }
            });

        });

    </script>


@endsection
