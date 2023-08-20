<div class="tab-pane fade" id="simple-recruitment-action" role="tabpanel">
    @if(sizeof($recruitment) !== 0)
        {!! Form::open(['route' => 'recruitment.listUpdate','method'=>'post','class'=>'needs-validation','id'=>'accordion2-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
    @else
        {!! Form::open(['route' => 'recruitment.store','method'=>'post','class'=>'needs-validation','id'=>'icon-and-title-form','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
    @endif
    <figure class="figure">
        <img src="{{asset('images/recruitment.png')}}" class="figure-img img-fluid rounded" alt="..." style="width: 100%">
        <figcaption class="figure-caption">Output Sample.</figcaption>
    </figure>
    <div class="row">
        <div class="col-md-12">
            <div class="card ctm-border-radius shadow-sm flex-fill">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        Our Work Process
                    </h4>
                </div>

                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Sub Heading <span class="text-muted text-danger">*</span></label>
                        <input type="text" class="form-control" name="description[]" maxlength="45" value="{{@$recruitment[0]->description}}" />
                        <div class="invalid-feedback">
                            Please enter the subheading.
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Heading <span class="text-muted text-danger">*</span></label>
                        <input type="text" class="form-control" name="heading[]" maxlength="60" value="{{@$recruitment[0]->heading}}" required />
                        <div class="invalid-feedback">
                            Please enter the heading.
                        </div>
                    </div>
                    <input type="hidden" class="form-control" value="{{@$recruitment}}" name="recruitment_elements">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card ctm-border-radius shadow-sm flex-fill">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        Process Details
                    </h4>
                </div>
                <div class="card-body">
                    <div id="multi-field-wrapper">

                        @if(count($recruitment)>0)
                            <div id="multi-fields">
                                @foreach($recruitment as $key=>$value)
                                    <div class="multi-field custom-card" style="border-bottom: double #e3e3e3; margin-bottom: 1rem ">
                                        <label>Title </label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" class="form-control" name="id[]" value="{{$value->id}}"/>
                                            <input type="text" class="form-control " id="title" name="title[]" value="{{@$value->title}}" required/>
                                            <button class="btn btn-danger remove-field"><i class="ri-delete-bin-line" aria-hidden="true"></i></button>
                                            <div class="invalid-feedback">
                                                Please enter a icon title.
                                            </div>
                                        </div>
                                        <div class="row mb-3 attribute-values" id="addValues">
                                            <div class="col-md-12 col-6 mt-4">
                                                <label for="icon_description" class="text-heading">Small Description </label>
                                                <textarea class="form-control" id="icon_description" maxlength="600" name="icon_description[]">
                                                    {{$value->icon_description}}
                                                </textarea>
                                                <div class="invalid-feedback">
                                                    Please enter a icon description.
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                @endforeach
                            </div>
                        @else
                            <div id="multi-fields">
                                <div class="multi-field custom-card" style="border-bottom: double #e3e3e3; ">
                                    <label>Title </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control " id="title" name="title[]" required/>
                                        <button class="btn btn-danger remove-field"><i class="ri-delete-bin-line" aria-hidden="true"></i></button>
                                        <div class="invalid-feedback">
                                            Please enter a title.
                                        </div>
                                    </div>
                                    <div class="row mb-3 attribute-values" id="addValues">
                                        <div class="col-md-12 col-6">
                                            <label for="icon_description" class="text-heading">Small Description<span class="text-muted text-danger">*</span></label>
                                            <textarea class="form-control" id="icon_description" maxlength="600" name="icon_description[]">

                                            </textarea>
                                            <div class="invalid-feedback">
                                                Please enter a small description.
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="text-end mt-3 mb-3">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm" id="add-field"><i class="ri-add-line" aria-hidden="true"></i> Add More </a>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
    <div class="text-center mt-3 mb-3">
        <button type="submit" class="btn btn-success w-sm">{{(count($recruitment)>0) ? 'Update Process':'Add Process'}}</button>
    </div>
    {!! Form::close() !!}
</div>
