<div class="tab-pane fade" id="simple-call-action" role="tabpanel">

    {!! Form::open(['url'=>route('homepage.action', @$homesettings->id),'id'=>'homesettings-simple-header-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}

    <div class="row  mb-4">
        <div class="col-lg-12">
            <div class="sticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Main Details</h5>
                    </div>
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{asset('images/home_action.png')}}" class="figure-img img-fluid rounded" alt="...">
                            <figcaption class="figure-caption">Output Sample.</figcaption>
                        </figure>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="direction-heading-input">Heading <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" maxlength="90" id="direction-heading-input" name="action_heading" value="{{@$homesettings->action_heading}}"
                                   placeholder="Enter heading" required>
                            <div class="invalid-feedback">
                                Please enter the heading.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label" for="direction-heading-inputs" >Button </label>
                            <input type="text" class="form-control" id="direction-heading-inputs" name="action_link" value="{{@$homesettings->action_link}}"
                                   placeholder="Enter button link">
                            <div class="invalid-feedback">
                                Please enter the button link.
                            </div>
                        </div>

                        <div class="position-relative mb-3">
                            <label class="form-label" for="direction-heading-inputs">Link <span class="text-muted text-danger">*</span></label>
                            <input type="text" class="form-control" id="direction-heading-inputs" name="action_link2" value="{{@$homesettings->action_link2}}"
                                   placeholder="Enter button link" required>
                            <div class="invalid-feedback">
                                Please enter the button link.
                            </div>
                        </div>
                        <div class="text-end mb-3 mt-3">
                            <button type="submit" class="btn btn-success w-sm">Update Section</button>
                        </div>
                    </div>

                    <!-- end card body -->
                </div>


            </div>
        </div>
    </div>

    {!! Form::close() !!}


</div>
