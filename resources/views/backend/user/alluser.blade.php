@extends('backend.layouts.master')
@section('title', "User Management Index")
@section('css')
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .hidden{
            display:none!important;
        }
        .dropdown-item{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">User Management</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">User Management</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-sm-4">
                            <div class="search-box">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addmembers"><i class="ri-add-fill me-1 align-bottom"></i> Add Users</button>

                            </div>
                        </div><!--end col-->
                        <div class="col-sm-auto ms-auto">
                            <div class="list-grid-nav hstack gap-1">
                                <button type="button" id="list-view-button" class="btn btn-soft-info nav-link  btn-icon fs-14 active filter-button"><i class="ri-list-unordered"></i></button>
                                <button type="button" id="grid-view-button" class="btn btn-soft-info nav-link btn-icon fs-14 filter-button"><i class="ri-grid-fill"></i></button>
{{--                                <button type="button"  id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-soft-info btn-icon fs-14"><i class="ri-more-2-fill"></i></button>--}}
{{--                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">--}}
{{--                                    <li><a class="dropdown-item" href="#">All</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Last Week</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Last Month</a></li>--}}
{{--                                    <li><a class="dropdown-item" href="#">Last Year</a></li>--}}
{{--                                </ul>--}}
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="team-list list-view-filter row" id="user-list">
                            @foreach($users as $user)
                            <div class="col" id="user-block-cover-{{$user->id}}">
                                <div class="card team-box" id="user-block-num-{{$user->id}}">
                                    <div class="team-cover">
                                        <img src="{{ ($user->cover !== null) ? asset('images/user/cover/'.$user->cover) :  asset('assets/backend/images/profile-bg.jpeg')}}" alt="" class="img-fluid" />
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row align-items-center team-row">
                                            <div class="col-lg-4 col team-settings">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="bookmark-icon flex-shrink-0 me-2" style="display: none">
                                                            <input type="checkbox" id="favourite1" class="bookmark-input bookmark-hide">
                                                            <label for="favourite1" class="btn-star">
                                                                <svg width="20" height="20">
                                                                    <use xlink:href="#icon-star"></use>
                                                                </svg>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col text-end dropdown">
                                                        <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill fs-17"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                            <li><a class="dropdown-item" href="{{route('profile',$user->slug)}}"><i class="ri-eye-line me-2 align-middle"></i>Profile</a></li>
                                                            <li><a class="dropdown-item cs-role-change" id="cs-role-change-{{$user->id}}" cs-user-role="{{@$user->user_type}}" cs-user-id="{{@$user->id}}" cs-update-route="{{route('user-type.update',$user->id)}}"><i class="ri-shield-user-line me-2 align-middle"></i>User Type</a></li>
                                                            <li><a class="dropdown-item cs-user-remove" cs-delete-route="{{route('user.destroy',$user->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="team-profile-img">
                                                    <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                        <img  src="{{ ($user->image !== null) ? asset('images/user/'.$user->image) :  asset('assets/backend/images/default.png')}}" alt="" class="img-fluid d-block rounded-circle" />
                                                    </div>
                                                    <div class="team-content">
                                                        <h5 class="fs-16 mb-1">{{ucwords(@$user->name)}}</h5>
                                                        <p class="text-muted mb-0">{{@$user->email}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col">
                                                <div class="row text-muted text-center">
                                                    <div class="col-6 border-end border-end-dashed" id="user-role-block-{{$user->id}}">
                                                        <h5 class="mb-1">{{ucwords(@$user->user_type)}}</h5>
                                                        <p class="text-muted mb-0">User Role</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <h5 class="mb-1">{{($user->contact == null) ? 'Not Added':@$user->contact}}</h5>
                                                        <p class="text-muted mb-0">Contact</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col">
                                                <div class="text-end">
                                                    <div class="btn-group view-btn" id="user-status-button-{{$user->id}}">
                                                        <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                            @if($user->status == 0) Inactive @else Active  @endif
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                            @if($user->status == 0)
                                                                 <li><a class="dropdown-item change-status" cs-update-route="{{route('user-status.update',$user->id)}}" href="#" cs-status-value="1">Active</a></li>
                                                            @else
                                                                <li><a class="dropdown-item change-status" cs-update-route="{{route('user-status.update',$user->id)}}" href="#" cs-status-value="0">Inactive</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div>
                            @endforeach
{{--                            <div class="col-lg-12">--}}
{{--                                <div class="text-center mb-3">--}}
{{--                                    <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load More </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div><!--end row-->
                        <form action="#" method="post" id="deleted-form">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                        </form>
                    </div>
                </div>
            </div>
            <!-- Offset Position -->
            <svg class="bookmark-hide">
                <symbol viewBox="0 0 24 24" stroke="currentColor" fill="var(--color-svg)" id="icon-star"><path stroke-width=".4" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></symbol>
            </svg>

        </div><!-- container-fluid -->
    </div><!-- End Page-content -->

    @include('backend.user.modal.add')
    @include('backend.user.modal.user-role')

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- profile init js -->
    <script src="{{asset('assets/backend/js/pages/team.init.js')}}"></script>
    <!-- password -->
    <script src="{{asset('assets/backend/js/pages/password-addon.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{asset('assets/backend/custom_js/user-mgm.js')}}"></script>
@endsection
