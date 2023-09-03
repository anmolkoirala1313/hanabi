<!-- Left Sidebar start -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/canosoft-favicon.png')}}" alt="" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php if(@$setting_data->logo){?>{{asset('/images/settings/'.@$setting_data->logo)}}<?php }else{ echo '/assets/backend/images/canosoft-logo.png'; }?>" alt="Logo" height="65">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('dashboard')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('assets/backend/images/canosoft-favicon.png')}}" alt="" height="40">
                    </span>
                     <span class="logo-lg">
                        <img src="<?php if(@$setting_data->logo_white){?>{{asset('/images/settings/'.@$setting_data->logo_white)}}<?php }else{ echo '/assets/backend/images/canosoft-logo.png'; }?>" alt="Logo" height="65">
                     </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/" target="_blank">
                        <i class="ri-rocket-line"></i> <span data-key="t-landing">Landing</span>
                        <span class="badge badge-pill bg-success" data-key="t-new">{{Auth::user()->user_type}}</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Components</span></li>


                <li class="nav-item">
                    <a class="nav-link menu-link  @if(\Request::route()->getName() == 'homepage.index') active @endif" href="{{route('homepage.index')}}">
                    <i class="ri-home-gear-line"></i> <span data-key="t-forms">Home</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link  @if(\Request::route()->getName() == 'menu.index') active @endif" href="{{route('menu.index')}}">
                    <i class="ri-stack-line"></i> <span data-key="t-forms">Menu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'test-preparation.index') active @endif" href="{{route('course.index')}}">
                        <i class="ri-pen-nib-line"></i> <span data-key="t-widgets">Course</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'test-preparation.index') active @endif" href="{{route('test-preparation.index')}}">
                        <i class="ri-quill-pen-line"></i> <span data-key="t-widgets">Test Preparation</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'services.index') active @endif" href="{{route('services.index')}}">
                        <i class="ri-customer-service-2-line"></i> <span data-key="t-widgets">Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'blogcategory.index' || \Request::route()->getName() == 'blog.index' ||  \Request::route()->getName() == 'blog.create' || \Request::route()->getName() == 'blog.edit' ) active @endif" href="#sidebarBlogs" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarBlogs">
                        <i class="ri-bold"></i> <span data-key="t-blog-mgmt">Blog Mgmt.</span>
                    </a>
                    <div class="collapse menu-dropdown @if(\Request::route()->getName() == 'blogcategory.index' || \Request::route()->getName() == 'blog.index' ) show @endif" id="sidebarBlogs">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('blogcategory.index')}}" class="nav-link @if(\Request::route()->getName() == 'blogcategory.index') active @endif" data-key="t-blog-category">Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('blog.index')}}" class="nav-link @if(\Request::route()->getName() == 'blog.index') active @endif" data-key="t-blog">Blog</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'pages.index') active @endif" href="{{route('pages.index')}}">
                        <i class="ri-file-copy-2-line"></i> <span data-key="t-widgets">Pages</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'success_trail.index') active @endif" href="{{route('success_trail.index')}}">
                        <i class="ri-medal-2-line"></i> <span data-key="t-widgets">Success Trail</span>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'formbuilder::forms.index' || \Request::route()->getName() == 'formbuilder::forms.create' || \Request::route()->getName() == 'formbuilder::forms.edit') active @endif" href="{{route('formbuilder::forms.index')}}">--}}
{{--                        <i class="ri-pages-line"></i> <span data-key="t-widgets">Forms</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'alluser') active @endif" href="{{route('alluser')}}">
                        <i class="ri-account-circle-line"></i> <span data-key="t-widgets">User Mgmt.</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'testimonials.index') active @endif" href="{{route('testimonials.index')}}">
                        <i class="ri-hand-heart-line"></i> <span data-key="t-widgets">Testimonial</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'teams.index') active @endif" href="{{route('teams.index')}}">
                        <i class="ri-team-line"></i> <span data-key="t-widgets">Teams</span>
                    </a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'service-category.index') active @endif" href="{{route('service-category.index')}}">--}}
{{--                        <i class=" ri-price-tag-2-line"></i> <span data-key="t-widgets">Service Categories</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'video.index') active @endif" href="{{route('video.index')}}">--}}
{{--                        <i class="ri-video-chat-line"></i> <span data-key="t-widgets">Video Gallery</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'album.index' || \Request::route()->getName() == 'album.show') active @endif" href="{{route('album.index')}}">
                        <i class="ri-gallery-line"></i> <span data-key="t-widgets">Albums</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'clients.index') active @endif" href="{{route('clients.index')}}">
                        <i class="ri-user-2-line"></i> <span data-key="t-widgets">Clients</span>
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'career.index') active @endif" href="{{route('career.index')}}">--}}
{{--                        <i class="ri-medal-line"></i> <span data-key="t-widgets">Career</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a class="nav-link menu-link @if(\Request::route()->getName() == 'sliders.index') active @endif" href="{{route('sliders.index')}}">
                        <i class="ri-slideshow-line"></i> <span data-key="t-widgets">Sliders</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

<!-- Left Sidebar End -->

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
