<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ucwords(@$setting_data->meta_description ?? 'Unity Center')}} "/>
    <meta name="keywords" content="{{@$setting_data->meta_tags ?? 'Unity Center'}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="canonical" href="https://unitycenter.com.np" />


    @if (\Request::is('/'))
        <title>{{ucwords(@$setting_data->website_name ?? 'Careerlink')}}</title>
    @else
        <title>@yield('title') | {{ucwords(@$setting_data->website_name ?? 'Careerlink')}} </title>
    @endif

    <meta property="og:title" content=" {{ucwords(@$setting_data->meta_title ?? 'Careerlink')}}" />
    <meta property="og:type" content="Consultancy" />
    <meta property="og:url" content="https://unitycenter.com.np" />
    <meta property="og:site_name" content="Careerlink" />
    <meta property="og:description" content=" {{ucwords(@$setting_data->meta_description ?? 'Careerlink')}}" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ (@$setting_data->favicon) ? asset('/images/settings/'.@$setting_data->favicon):asset('assets/backend/images/canosoft-favicon.png') }}">


    <link href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="{{asset('assets/frontend/js/respond.js')}}"></script><![endif]-->

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
<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>
    <!-- Main Header-->
    <header class="main-header header-style-three">

        <div class="header-top">
            <div class="inner-container">
                <div class="top-left">
                    <!-- Info List -->
                    <ul class="list-style-one">
                        <li><i class="fa fa-envelope"></i> <a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}</a></li>
                        <li><i class="fa fa-map-marker"></i> {{@$setting_data->address ?? ''}}</li>
                    </ul>
                </div>
            </div>

            <div class="outer-box">
                <ul class="social-icon-one">
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

        <!-- Main box -->
        <div class="main-box">
            <div class="logo-box">
                <div class="logo">
                    <a href="/">
                        <img class="lazy" style="width: 200px;"
                             data-src="{{$setting_data->logo ? asset('/images/settings/'.@$setting_data->logo):''}}" alt="" />
                    </a>
                </div>
            </div>
            <!--Nav Box-->
            <div class="nav-outer">
                <nav class="nav main-menu">
                    <ul class="navigation">
                        <li class="current"><a href="/">Home</a></li>
                        @if(!empty($top_nav_data))
                            @foreach($top_nav_data as $nav)
                                @if(!empty($nav->children[0]))
                                    <li class="dropdown">
                                        <a href="#">{{ @$nav->name ?? @$nav->title }}</a>
                                        <ul>
                                            @foreach($nav->children[0] as $childNav)
                                                <li class="{{!empty($childNav->children[0]) ? 'dropdown':''}}">
                                                    <a href="{{get_menu_url($childNav->type, $childNav)}}">
                                                        {{ @$childNav->name ?? @$childNav->title ??''}}
                                                    </a>
                                                    @if(@$childNav->children[0])
                                                        <ul>
                                                            @foreach(@$childNav->children[0] as $key => $lastchild)
                                                                <li>
                                                                    <a href="{{get_menu_url($lastchild->type, $lastchild)}}" target="{{@$lastchild->target ? '_blank':''}}">
                                                                        {{ @$lastchild->name ?? @$lastchild->title ?? ''}}
                                                                    </a>
                                                                </li>
                                                            @endforeach
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
                </nav>
                <!-- Main Menu End-->
            </div>
            <div class="outer-box">
                <a href="{{ route('contact') }}" class="theme-btn btn-style-one bg-theme-color3"><span class="btn-title">Book a consultation</span></a>
                <!-- Mobile Nav toggler -->
                <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
            </div>
        </div>
        <!-- End Main Box -->
        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            <nav class="menu-box">
                <div class="upper-box">
                    <div class="nav-logo">
                        <a href="/">
                            <img class="lazy" data-src="{{$setting_data->logo ? asset('/images/settings/'.@$setting_data->logo):''}}" alt="" title="">
                        </a>
                    </div>
                    <div class="close-btn"><i class="icon fa fa-times"></i></div>
                </div>
                <ul class="navigation clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </ul>
                <ul class="contact-list-one">
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <i class="icon lnr-icon-phone-handset"></i>
                            <span class="title">Call Us</span>
                            <a href="tel:{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}">
                                {{@$setting_data->phone ?? $setting_data->mobile  ?? ''}}
                            </a>
                        </div>
                    </li>
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-envelope1"></span>
                            <span class="title">Send Email</span>
                            <a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}</a>
                        </div>
                    </li>
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-clock"></span>
                            <span class="title">Our Address</span>
                            {{@$setting_data->address ?? ''}}
                        </div>
                    </li>
                </ul>
                <ul class="social-links">
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
            </nav>
        </div><!-- End Mobile Menu -->
        <!-- Header Search -->
        <div class="search-popup">
            <span class="search-back-drop"></span>
            <button class="close-search"><span class="fa fa-times"></span></button>
            <div class="search-inner">
                <form method="get" action="{{route('searchJob')}}">
                    <div class="form-group">
                        <input id="s" name="s" class="form-control" placeholder="Search for jobs.." type="text" oninvalid="this.setCustomValidity('Type a keyword')" oninput="this.setCustomValidity('')" required>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Header Search -->
        <!-- Sticky Header  -->
        <div class="sticky-header">
            <div class="auto-container">
                <div class="inner-container">
                    <!--Logo-->
                    <div class="logo">
                        <a href="/" title=""><img src="{{ (@$setting_data->favicon) ? asset('/images/settings/'.@$setting_data->favicon):asset('assets/backend/images/canosoft-favicon.png') }}" alt="" title=""></a>
                    </div>
                    <!--Right Col-->
                    <div class="nav-outer">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-collapse show collapse clearfix">
                                <ul class="navigation clearfix">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </ul>
                            </div>
                        </nav><!-- Main Menu End-->
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div><!-- End Sticky Menu -->
    </header>
    <!--End Main Header -->
