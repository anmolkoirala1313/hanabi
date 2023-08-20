@extends('backend.layouts.master')
@section('title', "Edit Profile | ".$user->name)
@section('css')
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .hidden{
            display:none!important;
        }
    </style>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img
                        src="{{ ($user->cover !== null) ? asset('images/user/cover/'.$user->cover) :  asset('assets/backend/images/profile-bg.jpeg')}}"
                        class="profile-wid-img" id="profile-foreground-img-file-input-updated" alt="">
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <input id="profile-foreground-img-file-input" type="file"
                                       name="cover" cs-update-route="{{route('user.imageupdate')}}"
                                       class="profile-foreground-img-file-input">
                                <label for="profile-foreground-img-file-input"
                                       class="profile-photo-edit btn btn-light">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--user profile-->
            <div class="row">
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img
                                        src="{{ ($user->image !== null) ? asset('images/user/'.$user->image) :  asset('assets/backend/images/default.png')}}"
                                         class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                         id="profile-img-file-input-updated"
                                         alt="user-profile-image">
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" name="image"
                                               cs-update-route="{{route('user.imageupdate')}}"
                                               class="profile-img-file-input">
                                        <label for="profile-img-file-input"
                                               class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-16 mb-1">{{ucwords($user->name)}}</h5>
                                <p class="text-muted mb-0">{{ucwords($user->user_type)}}</p>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Complete Your Profile</h5>
                                </div>
{{--                                <div class="flex-shrink-0">--}}
{{--                                    <a href="javascript:void(0);" class="badge bg-light text-primary fs-12"><i--}}
{{--                                            class="ri-edit-box-line align-bottom me-1"></i> Edit</a>--}}
{{--                                </div>--}}
                            </div>
                            <div class="progress animated-progress custom-progress progress-label">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{profile_percentage($user->id)}}%"
                                     aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                    <div class="label">{{profile_percentage($user->id)}}%</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--portfolio card-->
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['id'=>'socials-form','method'=>'POST','class'=>'needs-validation','novalidate'=>'']) !!}

                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Socials</h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <a id="socials-update" cs-create-route="{{route('profile.socials')}}"
                                       class="badge bg-light text-primary fs-12" style="cursor: pointer"><i
                                            class="ri-add-fill align-bottom me-1"></i> Update</a>
                                </div>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-gradient text-light">
                                                <i class="ri-facebook-fill"></i>
                                            </span>
                                </div>
                                <input type="url" class="form-control" id="fbUsername" name="fb" placeholder="facebook profile link" value="{{@$user->fb}}"/>
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-twitter">
                                                <i class="ri-twitter-fill"></i>
                                            </span>
                                </div>
                                <input type="url" class="form-control" id="twitterUsername" name="twitter" placeholder="Twitter profile link" value="{{@$user->twitter}}">
                            </div>
                            <div class="mb-3 d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-instagram">
                                                <i class="ri-instagram-fill"></i>
                                            </span>
                                </div>
                                <input type="url" class="form-control" id="instaUsername" name="insta" placeholder="Instagram profile link" value="{{@$user->insta}}">
                            </div>
                            <div class="d-flex">
                                <div class="avatar-xs d-block flex-shrink-0 me-3">
                                            <span class="avatar-title rounded-circle fs-16 bg-linkedin">
                                                <i class="ri-linkedin-fill"></i>
                                            </span>
                                </div>
                                <input type="url" class="form-control" id="linkedinUsername" name="linkedin" placeholder="Linkedin profile link" value="{{@$user->linkedin}}">
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                    <!--end card-->
                </div>
                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails"
                                       role="tab">
                                        <i class="fas fa-home"></i>
                                        Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="far fa-user"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#privacy" role="tab">
                                        <i class="far fa-envelope"></i>
                                        Privacy Policy
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    {!! Form::open(['route' => ['user.update', $user->id],'method'=>'PUT','class'=>'needs-validation','enctype'=>'multipart/form-data','novalidate'=>'']) !!}

                                    <div class="row g2">

                                        <div class="col-lg-12">
                                            <div class="mb-3 position-relative">
                                                <label for="firstnameInput" class="form-label">Full
                                                    Name</label>
                                                <input type="text" class="form-control" id="firstnameInput" name="name"
                                                       placeholder="Enter your firstname" value="{{@$user->name}}" required>
                                                <div class="invalid-feedback">
                                                    Please enter a name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phonenumberInput" class="form-label">Phone
                                                    Number</label>
                                                <input type="text" class="form-control" id="phonenumberInput" name="contact"
                                                       placeholder="Enter your phone number"
                                                       value="{{@$user->contact}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative">
                                                <label for="emailInput" class="form-label">Email
                                                    Address</label>
                                                <input type="email" class="form-control" id="emailInput" name="email"
                                                       placeholder="Enter your email"
                                                       value="{{@$user->email}}" required>
                                                <div class="invalid-feedback">
                                                    Please enter a email.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="JoiningdatInput" class="form-label">Joining
                                                    Date</label>
                                                <input type="text" class="form-control"
                                                       value="{{\Carbon\Carbon::parse(Auth::user()->created_at)->isoFormat('MMMM Do, YYYY')}}" readonly/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative">
                                                <label for="designationInput"
                                                       class="form-label">User Role</label>
                                                @if(@$user->user_type == "admin")
                                                    <select class="form-select mb-3" aria-label="Default select" name="user_type" required>
                                                        <option disabled readonly> Select Role </option>
                                                        <option value="admin" {{(@$user->user_type == "admin") ? "selected":""}}>Admin</option>
                                                        <option value="general" {{(@$user->user_type == "general") ? "selected":""}}>General</option>
                                                    </select>
                                                @else
                                                    <input type="text" class="form-control" name="user_type"
                                                           id="designationInput" placeholder="user role"
                                                           value="{{@$user->user_type}}" required>
                                                @endif
                                                <div class="invalid-feedback">
                                                    Please select the user type.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3 position-relative">
                                                <label for="websiteInput1"
                                                       class="form-label">Gender</label>
                                                <select class="form-select mb-3" aria-label="Default select" name="gender" required>
                                                    <option disabled readonly> Select Gender </option>
                                                    <option value="male" {{(@$user->gender == "male") ? "selected":""}}>Male</option>
                                                    <option value="female" {{(@$user->gender == "female") ? "selected":""}}>Female</option>
                                                    <option value="others" {{(@$user->gender == "others") ? "selected":""}}>Others</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the gender.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="cityInput" class="form-label">Location</label>
                                                <input type="text" class="form-control" id="cityInput" name="address"
                                                       placeholder="User Location / Address" value="{{@$user->address}}" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3 pb-2">
                                                <label for="exampleFormControlTextarea"
                                                       class="form-label">Description</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea" name="about"
                                                          placeholder="Write something about yourself.."
                                                          rows="4">{{@$user->about}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="submit" class="btn btn-soft-success">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                </div>

                                <!--end personal details tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    {!! Form::open(['id'=>'profile-password-form','class'=>'needs-validation','novalidate'=>'']) !!}
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="oldpasswordInput" class="form-label">Old
                                                    Password*</label>
                                                <input type="password" class="form-control"
                                                       id="oldpasswordInput" name="oldpassword"
                                                       cs-check-route="{{route('user.oldpassword')}}"
                                                       placeholder="Enter current password" required />
                                                <div class="invalid-feedback" id="old-password-error">
                                                    please enter the old password
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="newpasswordInput" class="form-label">New
                                                    Password*</label>
                                                <input type="password" class="form-control" name="password"
                                                       id="newpasswordInput" placeholder="Enter new password" required/>
                                                <input type="hidden" class="form-control" name="userid" id="userid" value="{{$user->id}}" />
                                                <div class="invalid-feedback">
                                                    Please enter the new password
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirmpasswordInput" class="form-label">Confirm
                                                    Password*</label>
                                                <input type="password" class="form-control"
                                                       id="confirmpasswordInput" name="confirmpassword"
                                                       placeholder="Confirm password" required />
                                                <div class="invalid-feedback" id="confirm-password-error">
                                                        Please enter the confirm password
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="button" id="profile-password-btn"
                                                        cs-store-route="{{route('user.password')}}"
                                                        class="btn btn-success">Change Password</button>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                    <!--end row-->
                                </div>
                                <!--end tab-pane-->

                                <div class="tab-pane" id="privacy" role="tabpanel">
                                    <div>
                                        <h5 class="card-title text-decoration-underline mb-3">Delete This
                                            Account:</h5>
                                        <p class="text-muted">Please be aware that once you remove your account, its data and activities cannot be retrieved. Proceed with caution.
                                            Follow the instructions to delete your account :
                                            <br/> Enter your current password to verify its you and click on "close & delete this account".
                                        </p>
                                        <div>
                                            <input type="password" class="form-control"
                                                   id="removeaccountPassword"
                                                   cs-check-route="{{route('user.oldpassword')}}"
                                                   placeholder="Enter your password"
                                                   style="max-width: 265px;">
                                            <div class="invalid-feedback" id="remove-acc-error">
                                                please enter the old password
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 mt-3">
                                            <button type="button" id="close-acc-btn"
                                                    cs-remove-route="{{route('user.removeaccount')}}"
                                                    class="btn btn-soft-danger" disabled>Close &
                                                    Delete This Account</button>
                                        </div>
                                    </div>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- profile-setting init js -->
    <script src="{{asset('assets/backend/js/pages/profile-setting.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- custom profile js-->
    <script src="{{asset('assets/backend/custom_js/profile.js')}}"></script>

@endsection
