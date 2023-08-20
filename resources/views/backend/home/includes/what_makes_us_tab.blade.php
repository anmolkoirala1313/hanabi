<div class="tab-pane fade" id="simple-what-makes-us-action" role="tabpanel">

    {!! Form::open(['url'=>route('homepage.different', @$homesettings->id),'id'=>'homesettings-whats-header-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}

    <div class="row  mb-2">
        <div class="col-lg-12">
            <div class="ssticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Main Details</h5>
                    </div>
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{asset('images/whatdifferent.png')}}" class="figure-img img-fluid rounded" alt="...">
                            <figcaption class="figure-caption">Output Sample.</figcaption>
                        </figure>
                    </div>


                    <!-- end card body -->
                </div>

                <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-success" id="accordionBordered5">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="slider-lists-1">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapsedd_1" aria-expanded="true" aria-controls="accor_borderedExamplecollapsedd_1">
                                Box 1 details
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapsedd_1" class="accordion-collapse collapse show" aria-labelledby="slider-lists-1" data-bs-parent="#accordionBordered5">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-10">

                                        <div class="form-group mb-3">
                                            <label>Heading <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="what_heading1" value="{{@$homesettings->what_heading1}}"  required>
                                            <div class="invalid-feedback">
                                                Please enter the heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <img id="current-sliderlist-1-img" src="<?php if(!empty(@$homesettings->what_image1)){ echo '/images/home/welcome/'.@$homesettings->what_image1; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="sliderlist-1-image" onchange="loadbasicFile('sliderlist-1-image','current-sliderlist-1-img',event)" name="what_image1" {{(@$homesettings->what_image1 !== null) ? "":"required" }}
                                                    class="profile-foreground-img-file-input" >

                                            <figcaption class="figure-caption">Image for current box. (SIZE: 60px X 60px)</figcaption>
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <label for="sliderlist-1-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="slider-lists-2">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapsedd_2" aria-expanded="false" aria-controls="accor_borderedExamplecollapsedd_2">
                                Box 2 details
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapsedd_2" class="accordion-collapse collapse" aria-labelledby="slider-lists-2" data-bs-parent="#accordionBordered5">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-10">

                                        <div class="form-group mb-3">
                                            <label>Heading <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="what_heading2" value="{{@$homesettings->what_heading2}}" required>
                                            <div class="invalid-feedback">
                                                Please enter the heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <img id="current-sliderlist-2-img" src="<?php if(!empty(@$homesettings->what_image2)){ echo '/images/home/welcome/'.@$homesettings->what_image2; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="sliderlist-2-image" onchange="loadbasicFile('sliderlist-2-image','current-sliderlist-2-img',event)" name="what_image2" {{(@$homesettings->what_image2 !== null) ? "":"required" }}
                                                    class="profile-foreground-img-file-input" >

                                            <figcaption class="figure-caption"> Image for current box. (SIZE: 60px X 60px)</figcaption>
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <label for="sliderlist-2-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="slider-lists-3">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapsedd_3" aria-expanded="flase" aria-controls="accor_borderedExamplecollapsedd_3">
                                Box 3 details
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapsedd_3" class="accordion-collapse collapse" aria-labelledby="slider-lists-3" data-bs-parent="#accordionBordered5">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-10">

                                        <div class="form-group mb-3">
                                            <label>Heading <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="what_heading3" value="{{@$homesettings->what_heading3}}" required>
                                            <div class="invalid-feedback">
                                                Please enter the heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <img id="current-sliderlist-3-img" src="<?php if(!empty(@$homesettings->what_image3)){ echo '/images/home/welcome/'.@$homesettings->what_image3; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="sliderlist-3-image" onchange="loadbasicFile('sliderlist-3-image','current-sliderlist-3-img',event)" name="what_image3" {{(@$homesettings->what_image3 !== null) ? "":"required" }}
                                                    class="profile-foreground-img-file-input" >

                                            <figcaption class="figure-caption"> Image for current box. (SIZE: 60px X 60px)</figcaption>
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <label for="sliderlist-3-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="slider-lists-4">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapsedd_4" aria-expanded="false" aria-controls="accor_borderedExamplecollapsedd_4">
                                Box 4 details
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapsedd_4" class="accordion-collapse collapse" aria-labelledby="slider-lists-4" data-bs-parent="#accordionBordered5">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-10">

                                        <div class="form-group mb-3">
                                            <label>Heading <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="what_heading4" value="{{@$homesettings->what_heading4}}" required>
                                            <div class="invalid-feedback">
                                                Please enter the heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <img id="current-sliderlist-4-img" src="<?php if(!empty(@$homesettings->what_image4)){ echo '/images/home/welcome/'.@$homesettings->what_image4; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="sliderlist-4-image" onchange="loadbasicFile('sliderlist-4-image','current-sliderlist-4-img',event)" name="what_image4" {{(@$homesettings->what_image4 !== null) ? "":"required" }}
                                                    class="profile-foreground-img-file-input" >

                                            <figcaption class="figure-caption"> Image for current box. (SIZE: 60px X 60px)</figcaption>
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <label for="sliderlist-4-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="slider-lists-5">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#accor_borderedExamplecollapsedd_5" aria-expanded="false" aria-controls="accor_borderedExamplecollapsedd_5">
                                Box 5 details
                            </button>
                        </h2>
                        <div id="accor_borderedExamplecollapsedd_5" class="accordion-collapse collapse" aria-labelledby="slider-lists-5" data-bs-parent="#accordionBordered5">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-10">

                                        <div class="form-group mb-3">
                                            <label>Heading <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="what_heading5" value="{{@$homesettings->what_heading5}}" required>
                                            <div class="invalid-feedback">
                                                Please enter the heading.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <img id="current-sliderlist-5-img" src="<?php if(!empty(@$homesettings->what_image5)){ echo '/images/home/welcome/'.@$homesettings->what_image5; } else{  echo '/images/default-image.jpg'; } ?>" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="sliderlist-5-image" onchange="loadbasicFile('sliderlist-5-image','current-sliderlist-5-img',event)" name="what_image5" {{(@$homesettings->what_image5 !== null) ? "":"required" }}
                                                    class="profile-foreground-img-file-input" >

                                            <figcaption class="figure-caption"> Image for current box. (SIZE: 60px X 60px)</figcaption>
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <label for="sliderlist-5-image" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
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
