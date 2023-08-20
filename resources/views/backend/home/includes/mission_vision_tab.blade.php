<div class="tab-pane fade" id="simple-missionvision-action" role="tabpanel">

    {!! Form::open(['url'=>route('homepage.mv', @$homesettings->id),'id'=>'homesettings-mv-header-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT','enctype'=>'multipart/form-data']) !!}

    <div class="row  mb-2">
        <div class="col-lg-12">
            <div class="sticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Main Details</h5>
                    </div>
                    <div class="card-body">
                        <figure class="figure">
                            <img src="{{asset('images/mission.png')}}" class="figure-img img-fluid rounded" alt="...">
                            <figcaption class="figure-caption">Output Sample.</figcaption>
                        </figure>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div>
    </div>
    <div class="row  mb-2">
        <div class="col-lg-12">
            <div class="nosticky-side-div">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> Mission, Vision, Goal Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="position-relative mb-3">
                            <label class="form-label">Mission Description <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="250" name="mission" placeholder="Enter mission description" rows="4" required>{{@$homesettings->mission}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Vision Description <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="250" name="vision" placeholder="Enter vision description" rows="4" required>{{@$homesettings->vision}}</textarea>
                            <div class="invalid-tooltip">
                                Please enter the  description.
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <label class="form-label">Value Description <span class="text-muted text-danger">*</span></label>
                            <textarea class="form-control" maxlength="250" name="value" placeholder="Enter value description" rows="4" required>{{@$homesettings->value}}</textarea>
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
