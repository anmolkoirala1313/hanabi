<div class="modal fade" id="changestatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Change User Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['id'=>'user-role-change-form','method'=>'PUT','class'=>'needs-validation','enctype'=>'multipart/form-data','novalidate'=>'']) !!}

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" name="userid" id="userid_role" />
                            <label for="user_type" class="form-label">User Type <span class="text-danger">*</span></label>
                            <select class="form-select mb-3" name="user_type" id="user_type_change" required>
                                <option value="" disabled> Select User Type </option>
                                <option value="admin">Admin</option>
                                <option value="general">General</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="user-role-change" cs-update-role="">Change</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
