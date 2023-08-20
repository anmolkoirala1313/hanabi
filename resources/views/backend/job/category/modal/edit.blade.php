<div class="modal fade" id="edit_job_category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Edit Job Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatejobcategory','enctype'=>'multipart/form-data','novalidate'=>'']) !!}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="categoryid" id="category_id" />

                            <label for="name" class="form-label">Category Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="update-name"
                                   onclick="slugMaker('update-name','update-slug')" required>
                            <div class="invalid-feedback">
                                Please enter the category title.
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" id="update-slug" required>
                            <div class="invalid-feedback">
                                Please enter the category Slug.
                            </div>
                        </div>
                    </div>

{{--                    <div class="mt-3">--}}
{{--                        <label class="form-label" for="category-slug-input">Category Image</label>--}}
{{--                        <div style="margin: auto;width: 60%;">--}}

{{--                            <img  id="current-edit-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >--}}
{{--                            <input  type="file" accept="image/png, image/jpeg" hidden--}}
{{--                                    id="profile-edit-img-file-input" onchange="loadbasicFile('profile-edit-img-file-input','current-edit-img',event)" name="image" required--}}
{{--                                    class="profile-foreground-img-file-input" >--}}

{{--                            <figcaption class="figure-caption">*use image minimum of 500px x 500px </figcaption>--}}
{{--                            <div class="invalid-feedback" >--}}
{{--                                Please select a image.--}}
{{--                            </div>--}}
{{--                            <label for="profile-edit-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">--}}
{{--                                <i class="ri-image-edit-line align-bottom me-1"></i> Add Image--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="blog-category-update-button" >Update Category</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
