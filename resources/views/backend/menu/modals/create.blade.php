
<div class="modal fade" id="createMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Create New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                {!! Form::open(['route' => 'menu.store','method'=>'post','id'=>'menu-form','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="row">
                        <div class="form-group">
                            <label for="name" class="text-heading">Menu Name</label>
                            <input type="text" class="form-control border-dashed" id="modal-name" name="name"
                                   onclick="slugMaker('modal-name','modal-slug')"
                                   required>
                            <div class="invalid-feedback">
                                Please enter the menu name.
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="title" class="text-heading">Menu Title (for frontend display)</label>
                            <input type="text" class="form-control border-dashed" id="title" name="title" required>
                            <div class="invalid-feedback">
                                Please enter the menu title.
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="slug" class="text-heading">Menu Slug</label>
                            <input type="text" class="form-control  border-dashed" id="modal-slug" name="slug" readonly required>
                            <div class="invalid-feedback">
                                Please enter the menu slug.
                            </div>
                        </div>
                    <div class="text-center mb-2 mt-4">
                        <button type="submit" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Create Menu</button>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>




