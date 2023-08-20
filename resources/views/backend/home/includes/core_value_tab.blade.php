<div class="tab-pane fade" id="simple-core-action" role="tabpanel">

    {!! Form::open(['url'=>route('homepage.corevalues', @$homesettings->id),'id'=>'homesettings-coreval-header-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}

    <div class="row  mb-2">
        <div class="col-lg-12">
            <div class="sticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Heading Details</h5>
                    </div>
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{asset('images/core_values.png')}}" class="figure-img img-fluid rounded" alt="...">
                            <figcaption class="figure-caption">Output Sample.</figcaption>
                        </figure>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="core_main_heading-input">Main Heading <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="35" id="core_main_heading-input" name="core_main_heading" value="{{@$homesettings->core_main_heading}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label"> Subheading <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="25" id="core_main_description-input" name="core_main_description" value="{{@$homesettings->core_main_description}}"
                                   placeholder="Enter subheading" required>
                            <div class="invalid-tooltip">
                                Please enter the subheading.
                            </div>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>

    </div>
    <div class="row  mb-2">
        <div class="col-lg-6">
            <div class="nosticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Core 1 Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label" for="core_main_heading1-input">Core Heading 1 <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="18" id="core_main_heading1-input" name="core_heading1" value="{{@$homesettings->core_heading1}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Description 1 <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="215" name="core_description1" placeholder="Enter core description" rows="4" required>{{@$homesettings->core_description1}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div class="nosticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Core 2 Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Heading 2 <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="18" name="core_heading2" value="{{@$homesettings->core_heading2}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Description 2 <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="215" name="core_description2" placeholder="Enter core value description" rows="4" required>{{@$homesettings->core_description2}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>

                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div class="nosticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Core 3 Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label" >Core Heading 2 <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="18"  name="core_heading3" value="{{@$homesettings->core_heading3}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Description 3 <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="215" name="core_description3" placeholder="Enter core description" rows="4" required>{{@$homesettings->core_description3}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div class="nostickys-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Core 4 Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Heading 4 <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="18" name="core_heading4" value="{{@$homesettings->core_heading4}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Description 4 <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="215" name="core_description4" placeholder="Enter core description" rows="4" required>{{@$homesettings->core_description4}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div class="nostickys-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Core 5 Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Heading 5 <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="18" name="core_heading5" value="{{@$homesettings->core_heading5}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Description 5 <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="215" name="core_description5" placeholder="Enter core description" rows="4" required>{{@$homesettings->core_description5}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div class="nostickys-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Core 6 Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Heading 6 <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="18" name="core_heading6" value="{{@$homesettings->core_heading6}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Core Description 6 <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="215" name="core_description6" placeholder="Enter core description" rows="4" required>{{@$homesettings->core_description6}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
        <div class="text-center mb-3 mt-2">
            <button type="submit" class="btn btn-success w-sm">Update Section</button>
        </div>
    </div>

    {!! Form::close() !!}


</div>
