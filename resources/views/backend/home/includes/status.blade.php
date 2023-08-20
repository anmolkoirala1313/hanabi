<div class="tab-pane fade" id="status-overview" role="tabpanel">

    {!! Form::open(['url'=>route('homepage.grievance', @$settings->id),'id'=>'status-terms-form','class'=>'needs-validation','novalidate'=>'','method'=>'PUT']) !!}
    <div class="row  mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="website-name-input">Heading</label>
                        <input type="text" class="form-control" id="website-name-input" name="grievance_heading" value="{{@$settings->grievance_heading}}"
                               placeholder="Enter grievance heading" required>
                    </div>
                    <div class="position-relative mb-3">
                        <label>Description</label>
                        <textarea class="form-control" maxlength="1100" id="ckeditor-classic" name="grievance_description" placeholder="Enter grievance description" rows="6" required>{{@$settings->grievance_description}}</textarea>
                        <div class="invalid-tooltip">
                            Please enter the website summary.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="grievance_button" value="{{@$settings->grievance_button}}"
                               placeholder="Enter grievance button text" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <input type="text" class="form-control" name="grievance_link" value="{{@$settings->grievance_link}}"
                               placeholder="Enter grievance button link" required>
                    </div>
                </div>
            </div>

            <div class="text-end mb-3">
                <button type="submit" class="btn btn-success w-sm">{{(@$settings->grievance_heading !== null) ? "Update Grievance":"Save Grievance"}}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}


</div>
