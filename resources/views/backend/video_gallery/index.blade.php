@extends('backend.layouts.master')
@section('title', "Video Gallery")
@section('css')

    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>


    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Video Gallery</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Videos</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Enter URL as: <span class="text-danger fs-14">https://www.youtube.com/watch?v=ly939bnZUrE</span>
                            </h4>

                            <div class="flex-shrink-0">
                                <a  href="{{ route('videoGallery') }}" target="_blank" class="btn btn-soft-primary btn-sm">
                                    <i class=" ri-eye-line align-middle"></i> View in frontend
                                </a>
                            </div>
                        </div>
{{--                        <div class="card-header align-items-center d-flex">--}}
{{--                            <div>--}}
{{--                                <p class="text-danger text-sm">*Please enter the full url as shown below: </p>--}}
{{--                                <p class="text-info text-sm"> https://www.youtube.com/watch?v=ly939bnZUrE (youtube) </p>--}}
{{--                            </div>--}}

{{--                            <div class="flex-shrink-0" style="">--}}
{{--                                <a  href="{{ route('videonews') }}" target="_blank" class="btn btn-soft-primary btn-sm">--}}
{{--                                    <i class=" ri-eye-line align-middle"></i> View in frontend--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="card-body">

                            @if(count($video_section_elements) > 0)
                                {!! Form::open(['route' => 'video.galleryUpdate','method'=>'post','class'=>'needs-validation','id'=>'video-section-form','novalidate'=>'']) !!}
                            @else
                                {!! Form::open(['route' => 'video.store','method'=>'post','class'=>'needs-validation','id'=>'video-section-form','novalidate'=>'']) !!}
                            @endif

                            <div class="row" id="video-section-form-ajax">
                                <input type="hidden" class="form-control" value="{{@$video_section_elements}}" name="video_elements">

                                <div class="col-md-12">
                                    <div id="multi-field-wrapper">

                                                @if(count($video_section_elements)>0)
                                                    <div id="multi-fields">
                                                        @foreach($video_section_elements as $key=>$value)
                                                            <div class="multi-field custom-card" style="border-bottom: 1px dotted #e3e3e3; margin-bottom: 1rem ">
                                                                <label>Video Type </label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control shadow-none" name="type[]" id="type_0" required readonly>
                                                                        <option value="youtube" {{($value->type == 'youtube') ? "selected":""}}> YouTube </option>
                                                                    </select>
                                                                    <button class="btn btn-danger remove-field"><i class="ri-delete-bin-line" aria-hidden="true"></i></button>
                                                                    <div class="invalid-feedback">
                                                                        Please select the video type.
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3 attribute-values" id="addValues">
                                                                    <div class="col-md-12 col-6">
                                                                        <label>Video Link </label>
                                                                        <input type="url" class="form-control" name="url[]" value="{{$value->url}}" required/>
                                                                        <input type="hidden" class="form-control" name="id[]" value="{{$value->id}}"/>
                                                                        <div class="invalid-feedback">
                                                                            Please enter the link.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div id="multi-fields">
                                                        <div class="multi-field custom-card mt-2" style="border-bottom: 1px dotted #e3e3e3; ">
                                                            <label>Video Type </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control shadow-none" name="type[]" id="type_0" required readonly>
                                                                    <option value="youtube" selected> YouTube </option>
                                                                </select>
                                                                <button class="btn btn-danger remove-field"><i class="ri-delete-bin-line" aria-hidden="true"></i></button>
                                                            </div>
                                                            <div class="row mb-3 attribute-values" id="addValues">
                                                                <div class="col-md-12 col-6">
                                                                    <label>Video Link </label>
                                                                    <input type="url" class="form-control" name="url[]" required/>
                                                                    <div class="invalid-feedback">
                                                                        Please enter the link.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @endif
                                                <div class="text-end mt-3 mb-3">
                                                    <a href="javascript:void(0)" class="btn btn-warning btn-sm" id="add-field"><i class="fa fa-copy"></i> Add More </a>
                                                </div>

                                            </div>
                                </div>
                            </div>
                            <div class="text-center mt-3" id="video-section-form-button">
                                <button id="video-section-form-submit" class="btn btn-success w-sm mb-4">
                                    {{(@$video_section_elements !==null)? "Update Details":"Add Details"}}
                                </button>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>

        //for attributes and values
        var counter = 0;
        $('#multi-field-wrapper').each(function() {
            var $wrapper = $('#multi-fields', this);

            //disable the delete button if the cloned div is just one
            clonecount = $('.multi-field').length;
            if(clonecount == 1){
                $('.remove-field').prop('disabled', true);
            }

            $("#add-field", $(this)).click(function(e) {
                counter++;
                clonecount = clonecount + 1;
                //remove the disable option for button once the cloned div is more than 1
                if(clonecount > 1){
                    $('.remove-field').prop('disabled', false);
                }
                //clone the element and add the id to div to make select field unique.
                var newElem = $('.multi-field:last-child', $wrapper).clone(true).appendTo($wrapper).attr('id', 'cloned-' + counter).find("input").val("");
                //remove the initial id from select and add new ID
                $('.multi-field').find('select').last().removeAttr('id').attr('id', 'type_' + counter).attr('readonly', 'readonly').find('option').focus();
                // $('.multi-field').find('select').last().val('');
            });

            $('.multi-field .remove-field', $wrapper).click(function() {
                clonecount = clonecount - 1;
                if(clonecount == 1){
                    $('.remove-field').prop('disabled', true);
                }else if (clonecount > 1){
                    $('.remove-field').prop('disabled', false);
                }
                if ($('.multi-field', $wrapper).length > 1){
                    var id = $(this).prev().find('option:selected').val();
                    $(this).parent('.input-group').parent('.multi-field').remove();
                }
            });

        });


    </script>


@endsection
