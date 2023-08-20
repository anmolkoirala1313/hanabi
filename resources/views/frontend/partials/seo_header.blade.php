<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ucwords(@$setting_data->meta_description ?? 'Unity Center')}} "/>
    <meta name="keywords" content="{{@$setting_data->meta_tags ?? 'Unity Center'}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="https://www.hanabi.com.np" />

    @yield('seo')

    <link rel="shortcut icon" type="image/x-icon" href="{{ (@$setting_data->favicon) ? asset('/images/settings/'.@$setting_data->favicon):'' }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/aos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/fontello.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/prettyPhoto.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/twentytwenty.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/shortcodes.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/megamenu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/responsive.css') }}">
    <!-- REVOLUTION LAYERS STYLES -->
    <link rel='stylesheet' id='rs-plugin-settings-css' href="{{ asset('assets/frontend/revolution/css/rs6.css') }}">

    <script async src="https://www.googletagmanager.com/gtag/js?id={{@$setting_data->google_analytics}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{@$setting_data->google_analytics}}');
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    @stack('styles')
</head>
<body>
<!-- page start -->
<div class="page">

    <!-- header start -->
    <header id="masthead" class="header prt-header-style-01">
        <!-- topbar -->
        <div class="top_bar prt-topbar-wrapper text-base-white clearfix">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-row align-items-start justify-content-start">
                            <div class="top_bar_contact_item">
                                <span class="text-base-skin"><i class="fa fa-envelope"></i></span><a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}
                                </a>
                            </div>
                            <div class="top_bar_contact_item">
                                <span class="text-base-skin"><i class="fa fa-phone"></i><a href="tel:{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}"> {{@$setting_data->phone ?? $setting_data->mobile ?? ''}}</a>
                            </div>
                            <div class="top_bar_contact_item top_bar_social ms-auto">
                                <ul class="social-icons">
                                    @if(@$setting_data->facebook)
                                        <li><a href="{{ @$setting_data->facebook }}"><span class="fab fa-twitter"></span></a></li>
                                    @endif
                                    @if(@$setting_data->youtube)
                                        <li><a href="{{ @$setting_data->youtube }}"><span class="fab fa-facebook-square"></span></a></li>
                                    @endif
                                    @if(@$setting_data->instagram)
                                        <li><a href="{{ @$setting_data->instagram }}"><span class="fab fa-pinterest-p"></span></a></li>
                                    @endif
                                    @if(@$setting_data->linkedin)
                                        <li><a href="{{ @$setting_data->linkedin }}"><span class="fab fa-instagram"></span></a></li>
                                    @endif
                                    @if(!empty(@$setting_data->ticktock))
                                        <li><a href="{{ @$setting_data->ticktock }}"><span class="fa-brands fa-tiktok"></span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- topbar end -->
        <!-- site-header-menu -->
        <div id="site-header-menu" class="site-header-menu">
            <div class="site-header-menu-inner prt-stickable-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--site-navigation -->
                            <div class="site-navigation d-flex align-items-center justify-content-between">
                                <!-- site-branding -->
                                <div class="site-branding me-auto">
                                    <h1>
                                        <a class="home-link" href="/" title="{{ $setting_data->website_name ?? 'Hanabi' }}" rel="home">
                                            <img id="logo-img" height="48" width="147" class="img-fluid auto_size" src="i{{$setting_data->logo ? asset('/images/settings/'.@$setting_data->logo):''}}" alt="logo-img">
                                        </a>
                                    </h1>
                                </div><!-- site-branding end -->
                                <div class="btn-show-menu-mobile menubar menubar--squeeze">
                                        <span class="menubar-box">
                                            <span class="menubar-inner"></span>
                                        </span>
                                </div>
                                <!-- menu -->
                                <nav class="main-menu menu-mobile" id="menu">
                                    <ul class="menu">
                                        <li class="mega-menu-item active">
                                            <a href="/" class="mega-menu-link">Home</a>
                                        </li>
                                        @if(!empty($top_nav_data))
                                            @foreach($top_nav_data as $nav)
                                                @if(!empty($nav->children[0]))
                                                    <li class="mega-menu-item">
                                                        <a href="#" class="mega-menu-link">{{ @$nav->name ?? @$nav->title }}</a>
                                                        <ul class="mega-submenu">
                                                            @foreach($nav->children[0] as $childNav)
                                                                <li class="{{!empty($childNav->children[0]) ? 'mega-menu-item':''}}">
                                                                    <a href="{{get_menu_url($childNav->type, $childNav)}}" class="{{!empty($childNav->children[0]) ? 'mega-menu-link':''}}">
                                                                        {{ @$childNav->name ?? @$childNav->title ??''}}
                                                                    </a>
                                                                    @if(@$childNav->children[0])
                                                                        <ul class="mega-submenu">
                                                                            @foreach(@$childNav->children[0] as $key => $lastchild)
                                                                                <li>
                                                                                    <a href="{{get_menu_url($lastchild->type, $lastchild)}}" target="{{@$lastchild->target ? '_blank':''}}">
                                                                                        {{ @$lastchild->name ?? @$lastchild->title ?? ''}}
                                                                                    </a>
                                                                                </li>
                                                                            @endforeach                                                                            <li><a href="diplomatic-visa.html">Right Sidebar</a></li>
                                                                        </ul>
                                                                    @endif
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>

                                                @else
                                                    <li>
                                                        <a href="{{get_menu_url(@$nav->type, @$nav)}}" target="{{@$nav->target ? '_blank':''}}">
                                                            {{ @$nav->name ?? @$nav->title ??''}}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </nav><!-- menu end -->
                                <!-- header_extra -->
                                <div class="header_extra d-flex flex-row align-items-center justify-content-end">
                                    <div class="header_btn">
                                        <a class="prt-btn prt-btn-size-sm prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor" href="{{ route('contact') }}">Get A Quote</a>
                                    </div>
                                </div><!-- header_extra end -->
                            </div><!-- site-navigation end-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- site-header-menu end-->
    </header><!-- header end -->
