@extends('backend.layouts.master')
@section('title') Section Elements @endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/backend/plugins/dropzone/dropzone.css')}}">

    <style>
        .ck-editor__editable_inline {
            min-height: 350px !important;
        }
        .add-disabled{pointer-events: none; opacity: 0.7;}

        /*for tab*/
        li.button-5 a{
            color: #FFFFFF;
        }

        li.button-6 a{
            color: #000000;
        }

        .fade{
            display: none;
        }
        /*end for tab*/

        /*for image*/
        .avatar-upload{
            max-width: 505px!important;
        }

        .default-image{
            border: 6px solid #f3f3f3;
            border-radius: 10px;
        }

        .word-count{
            padding: 10px 20px;
            margin-bottom: 15px;
            background: var(--ck-color-toolbar-background);
            border-left: 10px hsl(260deg 43% 53%) solid;
            box-shadow: 2px 2px 2px hsl(0deg 0% 0% / 10%);
        }

        .word-count .ck-word-count{
            font-size: 13px;
        }
        .ck-word-count .ck-word-count__words{
            display: inline-block;
            margin-right: 1em;
        }
        .ck-word-count .ck-word-count__characters{
            display: inline-block;
        }





        /*end for image*/

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
                                                        {{$page->name}}
                                                        - Page Section Details</h4>
                                                    <div class="hstack gap-3 flex-wrap">
                                                        <div><i class="ri-smartphone-line align-bottom me-1"></i>
                                                            Current Status:- {{ucwords($page->status)}}
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div>
                                                            <i class="ri-user-5-line align-bottom me-1"></i>
                                                            <span class="fw-medium">
                                                                Created by :-  {{ucwords(\App\Models\User::find($page->created_by)->name)}}
                                                            </span>
                                                        </div>
                                                        <div class="vr"></div>
                                                        <div>
                                                            <i class="ri-eye-line align-bottom me-1"></i>
                                                            <span class="fw-medium">
                                                                View in Frontend :-
                                                                <a href="{{route('page',$page->slug)}}" target="_blank">click me</a>
                                                            </span>
                                                        </div>
                                                    </div>
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
                                                        <li class="breadcrumb-item"><a href="{{route('pages.index')}}">Pages</a></li>
                                                        <li class="breadcrumb-item active">{{str_replace('-',' ',ucwords(Request::segment(2)))}}</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                                    @php($i=0)
                                    @foreach(@$sections as $key=>$value)
                                        <li class="nav-item">
                                            <a class="nav-link  {{($i==0) ? 'active':''}} fw-semibold" data-bs-toggle="tab" href="#pills-{{$value}}"
                                               role="tab">
                                                {{ucfirst(str_replace('_',' ',$value))}}
                                            </a>
                                        </li>
                                        <?php $i++; ?>
                                    @endforeach
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
                        @php($j=0)
                        @foreach(@$sections as $key=>$value)
                            <div class="tab-pane fade {{($j==0) ? 'show active':''}}" id="pills-{{$value}}" role="tabpanel">
                            @if($value == 'basic_section')
                                @if($basic_elements !== null)
                                    {!! Form::open(['url'=>route('section-elements.update', @$basic_elements->id),'id'=>'basic-form','class'=>'needs-validation','method'=>'PUT','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                @else
                                    {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'basic-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                @endif
                                <div class="row" id="basic-form-ajax">
                                    <div class="col-md-7">
                                        <div class="card ctm-border-radius shadow-sm flex-fill">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">
                                                    Basic Section Details
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <label>Heading <span class="text-muted text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="heading" value="{{@$basic_elements->heading}}" maxlength="60" required>
                                                    <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                    <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter the basic section heading.
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Subheading </label>
                                                    <input type="text" maxlength="30" class="form-control" value="{{@$basic_elements->subheading}}" name="subheading">
                                                    <div class="invalid-feedback">
                                                        Please enter the subheading.
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label>Description <span class="text-muted text-danger">* write 1100 characters only</span></label>
                                                    <textarea class="form-control" maxlength="1300" rows="14" name="description" id="basic_editor" required>{!! @$basic_elements->description !!}</textarea>
                                                    <div class="invalid-feedback">
                                                        Please write the small summary for basic section.
                                                    </div>
{{--                                                        <div class="word-count" id="word-count"></div>--}}

                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Button Text </label>
                                                    <input type="text" maxlength="20" class="form-control" value="{{@$basic_elements->button}}" name="button">
                                                    <div class="invalid-feedback">
                                                        Please enter the button text.
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Button Link </label>
                                                    <input type="text" class="form-control" value="{{@$basic_elements->button_link}}" name="button_link">
                                                    <div class="invalid-feedback">
                                                        Please enter the button link.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card ctm-border-radius shadow-sm flex-fill">
                                            <div class="card-header">
                                                <h4 class="card-title mb-0">
                                                    Basic Section Image <span class="text-muted text-danger">*</span>
                                                </h4>
                                            </div>
                                            <div class="card-body">

                                                <div>
                                                    <img  id="current-basic-img"  src="<?php if(!empty(@$basic_elements->image)){ echo '/images/section_elements/basic_section/'.@$basic_elements->image; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                                    <input  type="file" accept="image/png, image/jpeg" hidden
                                                            id="basic-image" onchange="loadbasicFile('basic-image','current-basic-img',event)" name="image" {{(@$basic_elements->id !== null) ? "":"required" }}
                                                            class="profile-foreground-img-file-input" >

                                                    <figcaption class="figure-caption">Banner image for current basic section. (SIZE:  750 x 750px)</figcaption>
                                                    <div class="invalid-feedback" >
                                                        Please select a image.
                                                    </div>
                                                    <label for="basic-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                        <i class="ri-image-edit-line align-bottom me-1"></i> Add Basic Image
                                                    </label>
                                                </div>
{{--                                                <div class="form-group mb-3">--}}
{{--                                                    <label>Image Alignment </label>--}}
{{--                                                    <select class="form-control shadow-none" name="list_image" id="list_image_align" required>--}}
{{--                                                        <option value disabled readonly> Select alignment</option>--}}
{{--                                                        <option value="left" {{(@$basic_elements->list_image == 'left') ? "selected":""}} selected> Left </option>--}}
{{--                                                        <option value="right"  {{(@$basic_elements->list_image == 'right') ? "selected":""}}> Right </option>--}}
{{--                                                    </select>--}}
{{--                                                    <div class="invalid-feedback">--}}
{{--                                                        Please select the image alignment.--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3 mb-3" id="basic-form-button">
                                    <button id="basic-button-submit" type="submit" class="btn btn-success w-sm">
                                        {{(@$basic_elements !==null)? "Update Details":"Add Details"}}</button>
                                </div>
                                {!! Form::close() !!}
                            @endif

                             @if($value == 'map_and_description')
                                 @if($map_descp !== null)
                                     {!! Form::open(['url'=>route('section-elements.update', @$map_descp->id),'id'=>'map-descrip-form','class'=>'needs-validation','method'=>'PUT','novalidate'=>'']) !!}
                                 @else
                                     {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'map-descrip-form','novalidate'=>'']) !!}
                                 @endif
                                 <div class="row" id="map-descrip-form-ajax">
                                     <div class="col-md-12">
                                         <div class="card ctm-border-radius shadow-sm flex-fill">
                                             <div class="card-header">
                                                 <h4 class="card-title mb-0">
                                                     Map and Description Details
                                                 </h4>
                                             </div>
                                             <div class="card-body">
                                                 <div class="form-group mb-3">
                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                     <input type="text" class="form-control" name="heading" value="{{@$map_descp->heading}}" maxlength="60" required>
                                                     <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                     <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                     <div class="invalid-feedback">
                                                         Please enter the basic section heading.
                                                     </div>
                                                 </div>

                                                 <div class="form-group mb-3">
                                                     <label>Subheading</label>
                                                     <input type="text" maxlength="60" class="form-control" value="{{@$map_descp->subheading}}" name="subheading">
                                                     <div class="invalid-feedback">
                                                         Please enter the sub heading.
                                                     </div>
                                                 </div>

                                                 <div class="form-group mb-3">
                                                     <label>Description <span class="text-muted text-danger">*</span></label>
                                                     <textarea class="form-control" maxlength="1400" rows="10" name="description" id="mapeditor" required>{{@$map_descp->description}}</textarea>
                                                     <div class="invalid-feedback">
                                                         Please enter the description.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Button Text </label>
                                                     <input type="text" maxlength="15" class="form-control" value="{{@$map_descp->button}}" name="button">
                                                     <div class="invalid-feedback">
                                                         Please enter the button text.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Button Link </label>
                                                     <input type="text" class="form-control" value="{{@$map_descp->button_link}}" name="button_link">
                                                     <div class="invalid-feedback">
                                                         Please enter the button link.
                                                     </div>
                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="text-center mt-3 mb-3" id="map-descrip-form-button">
                                     <button id="map-descrip-form-submit" class="btn btn-success w-sm">
                                         {{(@$map_descp !==null)? "Update Details":"Add Details"}}</button>
                                 </div>
                                 {!! Form::close() !!}
                             @endif

                             @if($value == 'call_to_action_1')
                                 @if($call1_elements !== null)
                                     {!! Form::open(['url'=>route('section-elements.update', @$call1_elements->id),'id'=>'call-action1-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT']) !!}
                                 @else
                                     {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'call-action1-form','novalidate'=>'']) !!}
                                 @endif

                                 <div class="row" id="call-action1-form-ajax">
                                     <div class="col-md-12">
                                         <div class="card ctm-border-radius shadow-sm flex-fill">
                                             <div class="card-header">
                                                 <h4 class="card-title mb-0">
                                                     Call to action: Option 1 Details
                                                 </h4>
                                             </div>
                                             <div class="card-body">
                                                 <div class="form-group mb-3">
                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                     <input type="text" class="form-control" maxlength="85" name="heading" value="{{@$call1_elements->heading}}" required>
                                                     <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                     <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                     <div class="invalid-feedback">
                                                         Please enter the call action section heading.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Button Text </label>
                                                     <input type="text" maxlength="30" class="form-control" value="{{@$call1_elements->button}}" name="button">
                                                     <div class="invalid-feedback">
                                                         Please enter the button text.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Button Link </label>
                                                     <input type="text" class="form-control" value="{{@$call1_elements->button_link}}" name="button_link">
                                                     <div class="invalid-feedback">
                                                         Please enter the button link.
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="text-center mt-3 mb-3" id="call-action1-form-button">
                                     <button id="call-action-button-submit" class="btn btn-success w-sm">
                                         {{(@$call1_elements !==null)? "Update Details":"Add Details"}}
                                     </button>
                                 </div>
                                 {!! Form::close() !!}

                             @endif

                             @if($value == 'call_to_action_2')
                                    @if($call2_elements !== null)
                                        {!! Form::open(['url'=>route('section-elements.update', @$call2_elements->id),'id'=>'call-action2-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT']) !!}
                                    @else
                                        {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'call-action2-form','novalidate'=>'']) !!}
                                    @endif

                                    <div class="row" id="call-action2-form-ajax">
                                        <div class="col-md-12">
                                            <div class="card ctm-border-radius shadow-sm flex-fill">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">
                                                        Call to action: Option 2 Details
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group mb-3">
                                                        <label>Heading <span class="text-muted text-danger">*</span></label>
                                                        <input type="text" class="form-control" maxlength="65" name="heading" value="{{@$call2_elements->heading}}" required>
                                                        <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                        <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                        <div class="invalid-feedback">
                                                            Please enter the call action section heading.
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Button Text </label>
                                                        <input type="text" maxlength="30" class="form-control" value="{{@$call2_elements->button}}" name="button">
                                                        <div class="invalid-feedback">
                                                            Please enter the button text.
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Button Link </label>
                                                        <input type="text" class="form-control" value="{{@$call2_elements->button_link}}" name="button_link">
                                                        <div class="invalid-feedback">
                                                            Please enter the button link.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3 mb-3" id="call-action2-form-button">
                                        <button id="call-action-button-submit" class="btn btn-success w-sm">
                                            {{(@$call2_elements !==null)? "Update Details":"Add Details"}}
                                        </button>
                                    </div>
                                    {!! Form::close() !!}

                                @endif

                             @if($value == 'background_image_section')
                                    @if($bgimage_elements !== null)
                                        {!! Form::open(['url'=>route('section-elements.update', @$bgimage_elements->id),'id'=>'background-image-form','class'=>'needs-validation','method'=>'PUT','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    @else
                                        {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'background-image-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    @endif
                                 <div id="background-image-form-ajax">
                                     <div class="row">
                                         <div class="col-md-8">
                                             <div class="card ctm-border-radius shadow-sm flex-fill">
                                                 <div class="card-header">
                                                     <h4 class="card-title mb-0">
                                                         Background Image Section Details
                                                     </h4>
                                                 </div>
                                                 <div class="card-body">
                                                     <div class="form-group mb-3">
                                                         <label>Heading <span class="text-muted text-danger">*</span></label>
                                                         <input type="text" maxlength="80" class="form-control" name="heading" value="{{@$bgimage_elements->heading}}" required>
                                                         <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                         <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                         <div class="invalid-feedback">
                                                             Please enter the Background Image Section heading.
                                                         </div>
                                                     </div>

                                                     <div class="form-group mb-3">
                                                         <label>Subheading </label>
                                                         <input type="text" maxlength="30" class="form-control" value="{{@$bgimage_elements->subheading}}" name="subheading">
                                                         <div class="invalid-feedback">
                                                             Please enter the subheading.
                                                         </div>
                                                     </div>

                                                     <div class="form-group mb-3">
                                                         <label>Description </label>
                                                         <textarea class="form-control" maxlength="910" rows="12" name="description" >{{@$bgimage_elements->description}}</textarea>
                                                         <div class="invalid-feedback">
                                                             Please enter the description.
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="col-md-4">
                                             <div class="card ctm-border-radius shadow-sm flex-fill">
                                                 <div class="card-header">
                                                     <h4 class="card-title mb-0">
                                                         Background Image Section's Image <span class="text-muted text-danger">*</span>
                                                     </h4>
                                                 </div>
                                                 <div class="card-body">
                                                     <div>
                                                         <img  id="current-backgroundss-img"  src="<?php if(!empty(@$bgimage_elements->image)){ echo '/images/section_elements/bgimage_section/'.@$bgimage_elements->image; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                                         <input  type="file" accept="image/png, image/jpeg" hidden
                                                                 id="background-image" onchange="loadbasicFile('background-image','current-backgroundss-img',event)" name="image" {{(@$bgimage_elements !=="")? "":"required"}}
                                                                 class="profile-foreground-img-file-input" >

                                                         <figcaption class="figure-caption">Banner image for current background section. (SIZE: 723 x 610px)</figcaption>
                                                         <div class="invalid-feedback" >
                                                             Please select a image.
                                                         </div>
                                                         <label for="background-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                             <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                                         </label>
                                                     </div>

                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="text-center  mb-3" id="background-image-form-button">
                                     <button id="background-button-submit" class="btn btn-success w-sm">
                                         {{(@$bgimage_elements !==null)? "Update Details":"Add Details"}}</button>
                                 </div>
                                 {!! Form::close() !!}

                             @endif

                             @if($value == 'flash_cards')
                                 @if(sizeof($flash_elements) !== 0)
                                     {!! Form::open(['route' => 'section-elements.tablistUpdate','method'=>'post','class'=>'needs-validation','id'=>'flash-card-form','novalidate'=>'']) !!}

                                 @else
                                     {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'flash-card-form','novalidate'=>'']) !!}
                                 @endif
                                 <div id="flash-card-form-ajax">
                                     <div class="col-md-12">
                                         <div class="card ctm-border-radius shadow-sm flex-fill">
                                             <div class="card-header">
                                                 <h4 class="card-title mb-0">
                                                     General Details
                                                 </h4>
                                             </div>
                                             <div class="card-body">
                                                 <div class="form-group mb-3">
                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                     <input type="text" class="form-control" maxlength="60" name="heading[]" value="{{@$flash_elements[0]->heading}}" required>
                                                     <div class="invalid-feedback">
                                                         Please enter the call action section heading.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Subheading</label>
                                                     <input type="text" maxlength="60" class="form-control" value="{{@$flash_elements[0]->subheading}}" name="subheading[]">
                                                     <div class="invalid-feedback">
                                                         Please enter the button text.
                                                     </div>
                                                 </div>

                                             </div>
                                         </div>
                                     </div>

                                     <div class="accordion add-tab-section1-details" id="accordion-details">
                                         <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionBordered2">

                                             <div class="accordion-item">
                                                 <h2 class="accordion-header" id="processelect-heading-mission">
                                                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse3" aria-expanded="true" aria-controls="accor_borderedExamplecollapse3">
                                                        Card 1
                                                     </button>
                                                 </h2>
                                                 <div id="accor_borderedExamplecollapse3" class="accordion-collapse collapse show" aria-labelledby="processelect-heading-mission" data-bs-parent="#accordionBordered2">
                                                     <div class="accordion-body">
                                                         <div class="row">
                                                             <div class="col-md-12">

                                                                 <div class="form-group mb-3">
                                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                                     <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                                     <input type="hidden" class="form-control" value="{{@$flash_elements[0]->id}}" name="id[]">
                                                                     <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                                     <input type="text" class="form-control" maxlength="60" name="list_header[]" value="{{@$flash_elements[0]->list_header}}" required>
                                                                     <div class="invalid-feedback">
                                                                         Please enter the card 1 heading.
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group mb-3">
                                                                     <label>Description <span class="text-muted text-danger">*</span></label>
                                                                     <textarea class="form-control" maxlength="500" rows="6" name="list_description[]" required>{{@$flash_elements[0]->list_description}}</textarea>
                                                                     <div class="invalid-feedback">
                                                                         Please write the card 1 description.
                                                                     </div>
                                                                 </div>

                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="accordion-item">
                                                 <h2 class="accordion-header" id="processelect-heading-vision">
                                                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse4" aria-expanded="false" aria-controls="accor_borderedExamplecollapse4">
                                                         Card 2
                                                     </button>
                                                 </h2>
                                                 <div id="accor_borderedExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="processelect-heading-vision" data-bs-parent="#accordionBordered2">
                                                     <div class="accordion-body">
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <div class="form-group mb-3">
                                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                                     <input type="hidden" class="form-control" value="{{@$flash_elements[1]->id}}" name="id[]">
                                                                     <input type="text" class="form-control" maxlength="60" name="list_header[]" value="{{@$flash_elements[1]->list_header}}" required>
                                                                     <div class="invalid-feedback">
                                                                         Please enter the card 1 heading.
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group mb-3">
                                                                     <label>Description <span class="text-muted text-danger">*</span></label>
                                                                     <textarea class="form-control" maxlength="500" rows="6" name="list_description[]" required>{{@$flash_elements[1]->list_description}}</textarea>
                                                                     <div class="invalid-feedback">
                                                                         Please write the card 1 description.
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                                             <div class="accordion-item">
                                                 <h2 class="accordion-header" id="processelect-heading-values">
                                                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse5" aria-expanded="false" aria-controls="accor_borderedExamplecollapse5">
                                                         Card 3
                                                     </button>
                                                 </h2>
                                                 <div id="accor_borderedExamplecollapse5" class="accordion-collapse collapse" aria-labelledby="processelect-heading-values" data-bs-parent="#accordionBordered2">
                                                     <div class="accordion-body">
                                                         <div class="row">

                                                             <div class="col-md-12">

                                                                 <div class="form-group mb-3">
                                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                                     <input type="hidden" class="form-control" value="{{@$flash_elements[2]->id}}" name="id[]">
                                                                     <input type="text" class="form-control" maxlength="60" name="list_header[]" value="{{@$flash_elements[2]->list_header}}" required>
                                                                     <div class="invalid-feedback">
                                                                         Please enter the card 3 heading.
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group mb-3">
                                                                     <label>Description <span class="text-muted text-danger">*</span></label>
                                                                     <textarea class="form-control" rows="6" maxlength="500" name="list_description[]" required>{{@$flash_elements[2]->list_description}}</textarea>
                                                                     <div class="invalid-feedback">
                                                                         Please write the card 3 description.
                                                                     </div>
                                                                 </div>

                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>



                                     </div>
                                 </div>
                                 <div class="text-center mt-3 mb-3" id="flash-card-form-button">
                                     <button id="tab1-button-submit" class="btn btn-success w-sm">{{(sizeof(@$flash_elements) !== 0) ? "Update Details":"Add Details"}}</button>
                                 </div>
                                 {!! Form::close() !!}
                             @endif

                             @if($value == 'simple_header_and_description')
                                 @if($header_descp_elements !== null)
                                     {!! Form::open(['url'=>route('section-elements.update', @$header_descp_elements->id),'id'=>'header-descp-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT']) !!}
                                 @else
                                     {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'header-descp-form','novalidate'=>'']) !!}
                                 @endif

                                 <div class="row" id="header-descp-form-ajax">
                                     <div class="col-md-12">
                                         <div class="card ctm-border-radius shadow-sm flex-fill">
                                             <div class="card-header">
                                                 <h4 class="card-title mb-0">
                                                     Simple Header Description Details
                                                 </h4>
                                             </div>
                                             <div class="card-body">
                                                 <div class="form-group mb-3">
                                                     <label>Heading </label>
                                                     <input type="text" maxlength="40" class="form-control" value="{{@$header_descp_elements->heading}}" name="heading">
                                                     <div class="invalid-feedback">
                                                         Please enter the heading.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Subheading</label>
                                                     <input type="text" maxlength="30" class="form-control" value="{{@$header_descp_elements->subheading}}" name="subheading">
                                                     <div class="invalid-feedback">
                                                         Please enter the sub heading.
                                                     </div>
                                                 </div>
                                                 <div class="form-group mb-3">
                                                     <label>Description <span class="text-muted text-danger">*</span></label>
                                                     <input type="hidden" class="form-control" value="{{$key}}" name="page_section_id" required>
                                                     <input type="hidden" class="form-control" value="{{$value}}" name="section_name" required>
                                                     <textarea class="form-control" rows="6" name="description" id="task-textarea" required>{{@$header_descp_elements->description}}</textarea>
                                                     <div class="invalid-feedback">
                                                         Please write the short description for section.
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="text-center mt-3 mb-3" id="header-descp-form-button">
                                     <button id="call-action-button-submit" class="btn btn-success w-sm">
                                         {{(@$header_descp_elements !==null)? "Update Details":"Add Details"}}
                                     </button>
                                 </div>
                                 {!! Form::close() !!}

                             @endif

                             @if($value == 'accordion_section_2')
                                 @if(sizeof($accordian2_elements) !== 0)
                                     {!! Form::open(['route' => 'section-elements.tablistUpdate','method'=>'post','class'=>'needs-validation','id'=>'accordion2-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                 @else
                                     {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'accordion2-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                 @endif
                                 <div id="accordion2-form-ajax">
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="card ctm-border-radius shadow-sm flex-fill">
                                                 <div class="card-header">
                                                     <h4 class="card-title mb-0">
                                                         Genera details
                                                     </h4>
                                                 </div>
                                                 <div class="card-body">
                                                     <div class="form-group mb-3">
                                                         <label>Heading <span class="text-muted text-danger">*</span></label>
                                                         <input type="text" class="form-control" maxlength="60" name="heading[]" value="{{@$accordian2_elements[0]->heading}}" required>
                                                         <div class="invalid-feedback">
                                                             Please enter the heading.
                                                         </div>
                                                     </div>
                                                     <div class="form-group mb-3">
                                                         <label>Sub Heading <span class="text-muted text-danger">*</span></label>
                                                         <input type="text" class="form-control" maxlength="60" name="subheading[]" value="{{@$accordian2_elements[0]->subheading}}" required>
                                                         <div class="invalid-feedback">
                                                             Please enter the sub heading.
                                                         </div>
                                                     </div>
                                                     <div class="col-md-4">
                                                         <img  id="current-faq-img"  src="<?php if(!empty(@$accordian2_elements[0]->image)){ echo '/images/section_elements/basic_section/'.@$accordian2_elements[0]->image; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                                         <input  type="file" accept="image/png, image/jpeg" hidden
                                                                 id="faq-image" onchange="loadbasicFile('faq-image','current-faq-img',event)" name="image[]"
                                                                 class="profile-foreground-img-file-input" >

                                                         <figcaption class="figure-caption">Side image. (SIZE: 650 × 730px)</figcaption>
                                                         <div class="invalid-feedback" >
                                                             Please select a image.
                                                         </div>
                                                         <label for="faq-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                             <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                                         </label>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>


                                     <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionBordered5">
                                         <input type="hidden" class="form-control" value="{{@$accordian2_elements}}" name="accordion2_elements">
                                         @for ($i = 1; $i <=$list_2; $i++)
                                             <div class="accordion-item">
                                                 <h2 class="accordion-header" id="accordian-heading-{{$i}}">
                                                     <button class="accordion-button {{($i==1) ? '':'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse_{{$i}}" aria-expanded="{{($i==1) ? 'true':'false'}}" aria-controls="accor_borderedExamplecollapse_{{$i}}">
                                                         Box {{$i}} details
                                                     </button>
                                                 </h2>
                                                 <div id="accor_borderedExamplecollapse_{{$i}}" class="accordion-collapse collapse {{($i==1) ? 'show':''}} " aria-labelledby="accordian-heading-{{$i}}" data-bs-parent="#accordionBordered5">
                                                     <div class="accordion-body">
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <div class="form-group mb-3">
                                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                                     <input type="hidden" class="form-control" value="{{$key}}"    name="page_section_id" required>
                                                                     <input type="hidden" class="form-control" value="{{$value}}"  name="section_name" required>
                                                                     <input type="hidden" class="form-control" value="{{$list_2}}" name="list_number_2" required>
                                                                     <input type="hidden" class="form-control" value="{{@$accordian2_elements[$i-1]->id}}" name="id[]">
                                                                     <input type="text" class="form-control" name="list_header[]" value="{{@$accordian2_elements[$i-1]->list_header}}" required>
                                                                     <div class="invalid-feedback">
                                                                         Please enter the heading.
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group mb-3">
                                                                     <label>Description </label>
                                                                     <textarea class="form-control" rows="6" name="list_description[]" id="accordian_two_editor_{{$i}}">{{@$accordian2_elements[$i-1]->list_description}}</textarea>
                                                                     <div class="invalid-feedback">
                                                                         Please write the description.
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         @endfor

                                     </div>
                                 </div>
                                 <div class="text-center mt-3 mb-3" id="accordion2-form-button">
                                     <button id="list2-button-submit" class="btn btn-success w-sm">{{(sizeof(@$accordian2_elements) !== 0) ? "Update Details":"Add Details"}}</button>
                                 </div>
                                 {!! Form::close() !!}
                             @endif

                             @if($value == 'slider_list')
                                 @if(sizeof($slider_list_elements) !== 0)
                                     {!! Form::open(['route' => 'section-elements.tablistUpdate','method'=>'post','class'=>'needs-validation','id'=>'slider-list-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                 @else
                                     {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'slider-list-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                 @endif
                                 <div id="slider-list-form-ajax">
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="card ctm-border-radius shadow-sm flex-fill">
                                                 <div class="card-header">
                                                     <h4 class="card-title mb-0">
                                                         General Details
                                                     </h4>
                                                 </div>
                                                 <div class="card-body">
                                                     <div class="form-group mb-3">
                                                         <label>Heading <span class="text-muted text-danger">*</span></label>
                                                         <input type="text" class="form-control" maxlength="25" name="heading[]" value="{{@$slider_list_elements[0]->heading}}" required>
                                                         <div class="invalid-feedback">
                                                             Please enter the heading.
                                                         </div>
                                                     </div>
                                                     <div class="form-group mb-3">
                                                         <label>Sub heading <span class="text-muted text-danger">*</span></label>
                                                         <input type="text" maxlength="30" class="form-control" name="description[]" value="{{@$slider_list_elements[0]->description}}" required>
                                                         <div class="invalid-feedback">
                                                             Please enter the sub heading.
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionBordered11">
                                         <input type="hidden" class="form-control" value="{{@$slider_list_elements}}" name="slider_list_elements">

                                         @for ($i = 1; $i <=$list_3; $i++)

                                             <div class="accordion-item">
                                                 <h2 class="accordion-header" id="slider-lists-{{$i}}">
                                                     <button class="accordion-button {{($i==1) ? '':'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapsedd_{{$i}}" aria-expanded="{{($i==1) ? 'true':'false'}}" aria-controls="accor_borderedExamplecollapsedd_{{$i}}">
                                                         Slider {{$i}} details
                                                     </button>
                                                 </h2>
                                                 <div id="accor_borderedExamplecollapsedd_{{$i}}" class="accordion-collapse collapse {{($i==1) ? 'show':''}} " aria-labelledby="slider-lists-{{$i}}" data-bs-parent="#accordionBordered11">
                                                     <div class="accordion-body">
                                                         <div class="row">
                                                             <div class="col-md-7">

                                                                 <div class="form-group mb-3">
                                                                     <label>Heading <span class="text-muted text-danger">*</span></label>
                                                                     <input type="hidden" class="form-control" value="{{$key}}"    name="page_section_id" required>
                                                                     <input type="hidden" class="form-control" value="{{$value}}"  name="section_name" required>
                                                                     <input type="hidden" class="form-control" value="{{$list_3}}" name="list_number_3" required>
                                                                     <input type="hidden" class="form-control" value="{{@$slider_list_elements[$i-1]->id}}" name="id[]">
                                                                     <input type="text" class="form-control" maxlength="35" name="list_header[]" id="slider_title_{{$i-1}}" onclick="slugMaker('slider_title_{{$i-1}}','slider_slug_{{$i-1}}')" value="{{@$slider_list_elements[$i-1]->list_header}}"  required>
                                                                     <div class="invalid-feedback">
                                                                         Please enter the heading.
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group mb-3">
                                                                     <label>Slug </label>
                                                                     <input type="text" class="form-control" name="subheading[]" id="slider_slug_{{$i-1}}"  value="{{@$slider_list_elements[$i-1]->subheading}}" >
                                                                     <div class="invalid-feedback">
                                                                         Please enter the slug.
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group mb-3">
                                                                     <label>Long Description<span class="text-muted text-danger">*</span></label>
                                                                     <textarea class="form-control" rows="6"  name="list_description[]" required>{{@$slider_list_elements[$i-1]->list_description}}</textarea>
                                                                     <span class="ctm-text-sm">Please write the description</span>
                                                                     <div class="invalid-feedback">
                                                                         Please write the long description.
                                                                     </div>
                                                                 </div>

                                                             </div>
                                                             <div class="col-md-5">
                                                                 <div>
                                                                     <img  id="current-sliderlist-{{$i}}-img"  src="<?php if(!empty(@$slider_list_elements[$i-1]->list_image)){ echo '/images/section_elements/list_1/'.@$slider_list_elements[$i-1]->list_image; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                                                     <input  type="file" accept="image/png, image/jpeg" hidden
                                                                             id="sliderlist-{{$i}}-image" onchange="loadbasicFile('sliderlist-{{$i}}-image','current-sliderlist-{{$i}}-img',event)" name="list_image[]" {{(@$slider_list_elements[$i-1]->id !== null) ? "":"required" }}
                                                                             class="profile-foreground-img-file-input" >

                                                                     <figcaption class="figure-caption">Banner image for current slider. (SIZE: 850px X 560px)</figcaption>
                                                                     <div class="invalid-feedback" >
                                                                         Please select a image.
                                                                     </div>
                                                                     <label for="sliderlist-{{$i}}-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                                         <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                                                     </label>
                                                                 </div>

                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         @endfor

                                     </div>

                                 </div>
                                 <div class="text-center mt-3 mb-3" id="slider-list-form-button">
                                     <button id="process-button-submit" class="btn btn-success w-sm">{{(sizeof(@$slider_list_elements) !== 0) ? "Update Details":"Add Details"}}</button>
                                 </div>
                                 {!! Form::close() !!}

                             @endif

                             @if($value == 'gallery_section')
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="card ctm-border-radius shadow-sm flex-fill">
                                             <div class="card-header">
                                                 <h4 class="card-title mb-0">
                                                     Add image to gallery section
                                                 </h4>
                                                 <p class="text-danger">Note* Please add the images in the multiplication of 4 (like 3, 6, 9) for perfect design  </p>
                                             </div>
                                             <div class="card-body">
                                                 <h2 class="page-heading">Upload your Images <span id="counter"></span></h2>
                                                 <div class="invalid-feedback">    </div>
                                                 <script type="text/javascript">
                                                     var page_section_id = "{{$key}}";
                                                 </script>
                                                 {!! Form::open(['url'=>route('section-elements-gallery.update', @$key),'method'=>'PUT','class'=>'dropzone','id'=>'myDropzone','enctype'=>'multipart/form-data']) !!}
                                                 <div class="dz-message">
                                                     <div class="col-xs-8">
                                                         <div class="">
                                                             <p>Drop files here or Click to Upload</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="fallback">
                                                     <input name="file" type="file" multiple />
                                                 </div>

                                                 {!! Form::close() !!}


                                                 Dropzone Preview Template
                                                 <div id="preview" style="display: none;">

                                                     <div class="dz-preview dz-file-preview">
                                                         <div class="dz-image"><img data-dz-thumbnail /></div>

                                                         <div class="dz-details">
                                                             <div class="dz-size"><span data-dz-size></span></div>
                                                             <div class="dz-filename"><span data-dz-name></span></div>
                                                         </div>
                                                         <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                                         <div class="dz-error-message"><span data-dz-errormessage></span></div>


                                                         <div class="dz-success-mark">

                                                             <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                                 <title>Check</title>
                                                                 <desc>Created with Sketch.</desc>
                                                                 <defs></defs>
                                                                 <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                                     <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                                                 </g>
                                                             </svg>

                                                         </div>
                                                         <div class="dz-error-mark">

                                                             <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                                 <title>error</title>
                                                                 <desc>Created with Sketch.</desc>
                                                                 <defs></defs>
                                                                 <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                                     <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                                                         <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                                                     </g>
                                                                 </g>
                                                             </svg>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 End of Dropzone Preview Template

                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             @endif

                             @if($value == 'small_box_description')
                                    @if(sizeof($process_elements) !== 0)
                                        {!! Form::open(['route' => 'section-elements.tablistUpdate','method'=>'post','class'=>'needs-validation','id'=>'process-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    @else
                                        {!! Form::open(['route' => 'section-elements.store','method'=>'post','class'=>'needs-validation','id'=>'process-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    @endif
                                    <div id="process-form-ajax">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                                    <div class="card-header">
                                                        <h4 class="card-title mb-0">
                                                            General Details
                                                        </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group mb-3">
                                                            <label>Heading <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" maxlength="60" name="heading[]" value="{{@$process_elements[0]->heading}}" required>
                                                            <div class="invalid-feedback">
                                                                Please enter the heading.
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label>SubHeading </label>
                                                            <input type="text" class="form-control" maxlength="50" name="subheading[]" value="{{@$process_elements[0]->subheading}}">
                                                            <div class="invalid-feedback">
                                                                Please enter the heading.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionBordered">
                                            <input type="hidden" class="form-control" value="{{@$process_elements}}" name="process_list_elements">

                                            @for ($i = 1; $i <=$process_num; $i++)

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="processelect-heading-{{$i}}">
                                                            <button class="accordion-button {{($i==1) ? '':'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapse{{$i}}" aria-expanded="{{($i==1) ? 'true':'false'}}" aria-controls="accor_borderedExamplecollapse{{$i}}">
                                                                Box {{$i}} details
                                                            </button>
                                                        </h2>
                                                        <div id="accor_borderedExamplecollapse{{$i}}" class="accordion-collapse collapse {{($i==1) ? 'show':''}} " aria-labelledby="processelect-heading-{{$i}}" data-bs-parent="#accordionBordered">
                                                            <div class="accordion-body">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group mb-3">
                                                                            <label>Heading </label>
                                                                            <input type="hidden" class="form-control" value="{{$key}}"    name="page_section_id" required>
                                                                            <input type="hidden" class="form-control" value="{{$value}}"  name="section_name" required>
                                                                            <input type="hidden" class="form-control" value="{{$process_num}}" name="list_number_3_process_num" required>
                                                                            <input type="hidden" class="form-control" value="{{@$process_elements[$i-1]->id}}" name="id[]">
                                                                            <input type="text" class="form-control" name="list_header[]" maxlength="100" value="{{@$process_elements[$i-1]->list_header}}" >
                                                                            <div class="invalid-feedback">
                                                                                Please enter the heading.
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mb-3">
                                                                            <label>Description <span class="text-muted text-danger">*</span></label>
                                                                            <textarea class="form-control" maxlength="600" rows="8" name="list_description[]" required>{{@$process_elements[$i-1]->list_description}}</textarea>
                                                                            <div class="invalid-feedback">
                                                                                Please write the description.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endfor

                                        </div>
                                    </div>
                                        <div class="text-end mb-4 mt-4" id="process-form-button">
                                            <button  id="process-button-submit" type="submit" class="btn btn-success w-sm">{{(sizeof(@$process_elements) !== 0) ? "Update Details":"Add Details"}}</button>
                                        </div>

                                    {!! Form::close() !!}

                                @endif
                            </div>
                            <?php $j++; ?>
                        @endforeach
                    </div>
                </div>
                <!-- end col -->
            </div>


        </div>
    </div>

@endsection

@section('js')
   <script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/dropzone/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/dropzone/dropzone.config.js')}}"></script>


    <script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    </script>

    <script type="text/javascript">
        var section_list = new Array();
        <?php foreach($sections as $key => $val){ ?>
        section_list.push('<?php echo $val; ?>');
        <?php } ?>


        var loadbasicFile = function(id1,id2,event) {
            var image       = document.getElementById(id1);
            var replacement = document.getElementById(id2);
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        function reload(){
            location.reload();
        }

        function slugMaker(title, slug){
            $("#"+ title).keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                var regExp = /\s+/g;
                Text = Text.replace(regExp,'-');
                $("#"+slug).val(Text);
            });
        }

        function ElementData(post_url,request_method,form_data,divID,buttonID){
            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data,
                contentType: false,
                cache: false,
                processData:false
            }).done(function(response){
                if (response=="successfully created" || response=="successfully updated"){
                    var replacement = '<div class="card">' +
                        '<div class="card-body p-0"> ' +
                        '<div class="alert alert-success border-0 rounded-0 m-0 d-flex align-items-center" role="alert"> ' +
                        '<i class="ri-user-smile-line me-3 align-middle fs-16"></i>'+
                        '<div class="flex-grow-1 text-truncate">Success !</div>' +
                        '<div class="flex-shrink-0"> ' +
                        '</div> ' +
                        '</div> ' +
                        '<div class="row align-items-end"> ' +
                        '<div class="col-sm-8"> ' +
                        '<div class="p-3"> ' +
                        '<p class="fs-16 lh-base">Section element has been <span class="fw-semibold">'+ response +' </span>, You can continue to add other elements or ‘Click below’ <i class="mdi mdi-arrow-right"></i></p> ' +
                        '<div class="mt-3"> ' +
                        '<a onclick="reload()" class="btn btn-success">Refresh Page!</a>' +
                        '</div> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div>';
                    $('#' + divID).html(replacement);
                    $('#' + buttonID).html("");
                }
                else{
                    var replacements = ' <div class="col-md-12"><div id="container"> ' +
                        '<div id="error-box"> ' +
                        '<div class="face2"> ' +
                        '<div class="eye"></div><div class="eye right"></div><div class="mouth sad"></div> ' +
                        '</div> ' +
                        '<div class="shadow scale"></div> ' +
                        '<div class="message2"><h1 class="alert">Error! Something went wrong.</h1><p class="alert-para">The section element could not be created or updated.</div> ' +
                        '<a onclick="reload()" class="button-box"><h1 class="red">try again</h1></a></div></div> ' +
                        '</div>';
                    $('#' + divID).html(replacements);
                    $('#' + buttonID).html("");
                }
            });
        }

        function createEditor ( elementId ) {
            return ClassicEditor
                .create( document.querySelector( '#' + elementId ), {
                toolbar : {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'link', '|',
                        'outdent', 'indent', '|',
                        'bulletedList', 'numberedList', '|',
                        'insertTable', 'blockQuote', '|',
                        'undo', 'redo'
                    ],
                },
                link: {
                    // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                    addTargetToExternalLinks: true,

                    // Let the users control the "download" attribute of each link.
                    decorators: [
                        {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'download'
                            }
                        }
                    ]
                },
            } )
                .then( editor => {
                    window.editor = editor;
                    editor.model.document.on( 'change:data', () => {
                        $( '#' + elementId).text(editor.getData());
                    } );

                } )
                .catch( err => {
                    console.error( err.stack );
                } );
        }


        //for attributes and values
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
                //clone the element and add the id to div to make select field unique.
                var newElem = $('.multi-field:last-child', $wrapper).clone(true).appendTo($wrapper).attr('id', 'cloned-' + counter).find("input").val("");
                //remove the initial id from select and add new ID
                $('.multi-field').find('select').last().removeAttr('id').attr('id', 'header_' + counter).find('option').focus();
                $('.multi-field').find('select').last().val('');
            });

            $('.multi-field .remove-field', $wrapper).click(function() {
                clonecount = clonecount - 1;
                if(clonecount == 1){
                    $('.remove-field').addClass('add-disabled');
                }else if (clonecount > 1){
                    $('.remove-field').removeClass('add-disabled');
                }
                if ($('.multi-field', $wrapper).length > 1){
                    var id = $(this).prev().find('option:selected').val();
                    $(this).parent('.input-group').parent('.multi-field').remove();
                }
            });

        });

        $(document).ready(function () {

            CKEDITOR.replace('task-textarea',{
                allowedContent: true
            });


            // if(section_list.includes("simple_header_and_description")){
            //     createEditor('task-textarea');
            // }
            // if(section_list.includes("map_and_description")){
            //     createEditor('mapeditor');
            // }

            {{--if(section_list.includes("accordion_section_2")){--}}
            {{--    var list2 = "{{$list_2}}";--}}
            {{--    for ($i = 1; $i <=list2; $i++){--}}
            {{--        createEditor('accordian_two_editor_'+$i);--}}
            {{--    }--}}
            {{--}--}}


        });

        if($.inArray("basic_section", section_list) !== -1) {

            $("#basic-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false; }
                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });

        }

        if($.inArray("map_and_description", section_list) !== -1) {

            $("#map-descrip-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false; }
                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });

        }

        if($.inArray("call_to_action_1", section_list) !== -1) {
            $("#call-action1-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}

                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });
        }

        if($.inArray("call_to_action_2", section_list) !== -1) {
            $("#call-action2-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}

                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });
        }

        if($.inArray("background_image_section", section_list) !== -1) {
            $("#background-image-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}

                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });
        }

        if($.inArray("flash_cards", section_list) !== -1) {
            $("#flash-card-form").submit(function(event){
                if (!this.checkValidity()) { return false;}

                event.preventDefault(); //prevent default action
                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);
            });
        }

        if($.inArray("simple_header_and_description", section_list) !== -1) {
            $("#header-descp-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}

                var editor_data = CKEDITOR.instances['task-textarea'].getData();
                $('#task-textarea').text(editor_data);

                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);
            });
        }

        if($.inArray("accordion_section_2", section_list) !== -1) {

            $("#accordion2-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}
                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });
        }

        if($.inArray("slider_list", section_list) !== -1) {

            $("#slider-list-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}
                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });
        }

        if($.inArray("small_box_description", section_list) !== -1) {

            $("#process-form").submit(function(event){
                event.preventDefault(); //prevent default action
                if (!this.checkValidity()) { return false;}
                var post_url       = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                var form_data      = new FormData(this); //Creates new FormData object
                var divID          = $(this).attr('id')+'-ajax';
                var buttonID       = $(this).attr('id')+'-button';
                ElementData(post_url,request_method,form_data,divID,buttonID);

            });
        }


    </script>


@endsection
