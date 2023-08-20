
<div class="modal fade" id="addmembers" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="myModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'user-add-form','method'=>'post','class'=>'needs-validation','enctype'=>'multipart/form-data','novalidate'=>'']) !!}
                <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="password-input" class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input">
                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select mb-3" name="gender" id="gender">
                                    <option disabled>Select Gender </option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="others" selected>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="stats" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select mb-3" name="status" id="stats" required>
                                    <option selected  value=""  disabled>Select Status </option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="image" class="form-label">Profile Images</label>
                                <input class="form-control" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="cover" class="form-label">Cover Photo</label>
                                <input class="form-control" type="file" id="cover" name="cover">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="user_type" class="form-label">User Type <span class="text-danger">*</span></label>
                                <select class="form-select mb-3" name="user_type" id="user_type" required>
                                    <option selected value="" disabled> Select User Type </option>
                                    <option value="admin">Admin</option>
                                    <option value="general">General</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success" id="user-add-button" cs-create-route="{{route('user.store')}}">Add User</button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div><!--end modal-content-->
    </div><!--end modal-dialog-->
</div>
