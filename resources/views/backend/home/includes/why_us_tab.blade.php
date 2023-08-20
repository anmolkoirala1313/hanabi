<div class="tab-pane fade" id="simple-why-us-action" role="tabpanel">

    {!! Form::open(['url'=>route('homepage.whyus', @$homesettings->id),'id'=>'homesettings-mv-header-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}

    <div class="row mb-2">
        <div class="col-lg-6">
            <div class="sticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Main Details</h5>
                    </div>
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{asset('images/whyus.png')}}" class="figure-img img-fluid rounded" alt="...">
                            <figcaption class="figure-caption">Output Sample.</figcaption>
                        </figure>
                        <div class="position-relative mb-3">
                            <label class="form-label">Heading <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="25" name="why_heading" value="{{@$homesettings->why_heading}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Small Description</label>
                            <textarea class="form-control" name="why_description" rows="9"
                                      placeholder="Enter description" required>{{@$homesettings->why_description}}</textarea>
                            <div class="invalid-feedback">
                                Please enter the description.
                            </div>
                        </div>

{{--                        <div class="position-relative mb-3">--}}
{{--                            <label class="form-label">Video Link <span class="text-muted text-danger">*</span></label>--}}
{{--                            <input type="text" class="form-control" name="why_subheading" value="{{@$homesettings->why_subheading}}"--}}
{{--                                   placeholder="Enter youtube video link">--}}
{{--                            <div class="invalid-tooltip">--}}
{{--                                Please enter the video link.--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative mb-3">--}}
{{--                            <label class="form-label">Button</label>--}}
{{--                            <input type="text" class="form-control" maxlength="30" name="why_button" value="{{@$homesettings->why_button}}"--}}
{{--                                   placeholder="Enter button text">--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please enter the button.--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="position-relative mb-3">--}}
{{--                            <label class="form-label">Button Link</label>--}}
{{--                            <input type="text" class="form-control" maxlength="50" name="why_link" value="{{@$homesettings->why_link}}"--}}
{{--                                   placeholder="Enter button link">--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please enter the button link.--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-9">
                            <div>
                                <img id="current-sliderlist-5-img" src="<?php if(!empty(@$homesettings->what_image5)){ echo '/images/home/welcome/'.@$homesettings->what_image5; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="sliderlist-5-image" onchange="loadbasicFile('sliderlist-5-image','current-sliderlist-5-img',event)" name="what_image5" {{(@$homesettings->what_image5 !== null) ? "":"required" }}
                                        class="profile-foreground-img-file-input" >
                                <figcaption class="figure-caption"> Image for current box. (SIZE: 560px X 375px)</figcaption>
                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <label for="sliderlist-5-image" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div class="sticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Site Statistics</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label">Project completed <span class="text-muted text-danger">*</span></label>
                            <input type="number" class="form-control" name="project_completed" value="{{@$homesettings->project_completed}}"
                                   placeholder="Enter project completed number">
                            <div class="invalid-feedback">
                                Please enter the project completed number.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Happy Clients <span class="text-muted text-danger">*</span></label>
                            <input type="number" class="form-control" name="happy_clients" value="{{@$homesettings->happy_clients}}"
                                   placeholder="Enter happy clients number">
                            <div class="invalid-feedback">
                                Please enter the happy clients number.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Visa Approved <span class="text-muted text-danger">*</span></label>
                            <input type="number" class="form-control" name="visa_approved" value="{{@$homesettings->visa_approved}}"
                                   placeholder="Enter visa approved number">
                            <div class="invalid-feedback">
                                Please enter the visa approved number.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Success Stories <span class="text-muted text-danger">*</span></label>
                            <input type="number" class="form-control" name="success_stories" value="{{@$homesettings->success_stories}}"
                                   placeholder="Enter success stories number">
                            <div class="invalid-feedback">
                                Please enter the success stories number.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-3 mt-2">
            <button type="submit" class="btn btn-success w-sm">Update Section</button>
        </div>
    </div>

    {!! Form::close() !!}


</div>
