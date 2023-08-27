@extends('frontend.layouts.master')
@section('title') Home @endsection
@section('css')

@endsection
@section('content')
    @if(count($sliders) > 0)
        <div class="prt-rev_slider-wide">
            <rs-module-wrap id="rev_slider_1_1_wrapper" data-alias="classic-mainslider" data-source="gallery">

                <rs-module id="rev_slider_1_1" data-version="6.1.8">

                    <rs-slides>

                        @foreach(@$sliders as $index=>$slider)
                            <?php $split = explode(" ", @$slider->heading);?>

                            <rs-slide data-key="rs-{{ $index+1 }}" data-title="Slide" data-thumb="{{ asset('/images/sliders/'.$slider->image) }}" data-anim="ei:d;eo:d;s:d;r:0;t:grayscalecross;sl:d;">

                            <img src="{{ asset('/images/sliders/'.$slider->image) }}" alt="image" title="slider-bg00{{ $index+1 }}" width="1920" height="600" class="rev-slidebg prt-box-view-overlay prt-portfolio-box-view-overlay" data-no-retina>

                            <rs-layer
                                id="slider-1-slide-{{ $index+1 }}-layer-0"
                                data-type="text"
                                data-rsp_ch="on"
                                data-xy="x:l,l,c,c;xo:17px,17px,0,0;y:t,t,t,m;yo:240px,240px,180px,-5px;"
                                data-text="w:normal;s:80,80,65,42;l:110,110,85,52;fw:500;"
                                data-frame_0="y:100%;"
                                data-frame_1="e:power4.inOut;st:330;sp:800;sR:330;"
                                data-frame_999="o:0;st:w;sR:7870;"
                                style="z-index:11;font-family:'Poppins';"
                            >{{$split[count($split)-1]}}
                            </rs-layer>

                            <rs-layer
                                id="slider-1-slide-{{ $index+1 }}-layer-1"
                                data-type="text"
                                data-rsp_ch="on"
                                data-xy="x:l,l,c,c;xo:18px,18px,0,0;yo:139px,139px,104px,74px;"
                                data-text="w:normal;s:80,80,65,42;l:110,110,80,52;fw:500;"
                                data-frame_0="y:100%;"
                                data-frame_1="e:power4.inOut;st:230;sp:800;sR:230;"
                                data-frame_999="o:0;st:w;sR:7970;"
                                style="z-index:10;font-family:'Poppins';"
                            >{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$slider->heading)."\n"}}</span>
                            </rs-layer>

                            <rs-layer
                                id="slider-1-slide-{{ $index+1 }}-layer-2"
                                data-type="text"
                                data-rsp_ch="on"
                                data-xy="x:l,l,c,c;xo:25px,25px,0,519px;yo:111px,111px,73px,27px;"
                                data-text="w:normal;s:19,19,15,14;l:30,30,25,45;fw:500;"
                                data-vbility="t,t,t,f"
                                data-frame_0="y:100%;"
                                data-frame_1="e:power4.inOut;st:80;sp:600;sR:80;"
                                data-frame_999="o:0;st:w;sR:8320;"
                                style="z-index:9;font-family:'Poppins';"
                            >{{@$slider->subheading ?? ''}}</span>
                            </rs-layer>
                            @if(@$slider->link)

                            <a
                                id="slider-1-slide-{{ $index+1 }}-layer-4"
                                class="rs-layer rev-btn"
                                href="{{@$slider->link ?? ''}}" target="_self"
                                data-type="text"
                                data-rsp_ch="on"
                                data-xy="x:c;xo:-554px,-554px,0,0;y:m;yo:157px,157px,125px,59px;"
                                data-text="w:normal;s:14,14,14,13;l:25,25,18,13;fw:600;"
                                data-padding="t:8,8,10,11;r:30,30,30,25;b:8,8,10,11;l:30,30,30,25;"
                                data-border="bos:solid;boc:#ffffff;bow:2px,2px,2px,2px;bor:50px,50px,50px,50px;"
                                data-frame_0="y:100%;"
                                data-frame_1="e:power4.inOut;st:1060;sp:500;sR:1060;"
                                data-frame_999="o:0;st:w;sR:7440;"
                                data-frame_hover="c:#fff;bgc:#e02454;boc:#e02454;bor:50px,50px,50px,50px;bos:solid;bow:2px,2px,2px,2px;e:default;"
                                style="left: -12px;top: -60px;z-index:16;font-family:'Poppins';"
                            >{{@$slider->button ?? 'Start Exploring'}}
                            </a>
                            @endif
                        </rs-slide>
                        @endforeach

                    </rs-slides>

                    <rs-progress class="rs-bottom" style="visibility: hidden !important;"></rs-progress>
                </rs-module>
            </rs-module-wrap>
        </div>
    @endif

    <!-- site-main start -->
    <div class="site-main">
        @if(!empty($homepage_info->welcome_description))
             <section class="prt-row home01-welcome-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12" data-aos="fade-right">
                            <div class="position-relative text-center">
                                <div class="prt_single_image-wrapper">
                                    <img class="lazy" data-src="{{ @$homepage_info->welcome_image ? asset('/images/home/welcome/'.@$homepage_info->welcome_image):''}}" alt="single-img-06">
                                </div>

                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12" data-aos="fade-left">
                            <div class="mt-30">
                                <!--section-title -->
                                <div class="section-title">
                                    <div class="title-header">
                                        <h3>{{$homepage_info->welcome_subheading ?? ''}}</h3>
                                        <h2 class="title">{{  @$homepage_info->welcome_heading }}</h2>
                                    </div>
                                    <div class="title-desc text-justify">
                                        <p>    {{ ucfirst(@$homepage_info->welcome_description) }}</p>
                                    </div>
                                </div>
                                <div class="d-block d-sm-flex mt-15 res-991-mt-20">
                                    @if(@$homepage_info->welcome_link)
                                        <div class="res-575-mr-0">
                                            <a class="prt-btn prt-btn-size-sm prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor"
                                               href="{{@$homepage_info->welcome_link}}">{{ @$homepage_info->welcome_button }}</a>
                                        </div>
                                    @endif
                                    @if(@$homepage_info->welcome_video_link)
                                        <div class="featured-icon-box agent-logo">
                                            <div class="prt-play-icon-btn style1 text-center">
                                                <a href="{{ @$homepage_info->welcome_video_link }}" target="_self" class="prt_prettyphoto">
                                                    <i class="fa fa-play text-base-skin"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section class="prt-row about01-why-us-section prt-bg prt-bgimage-yes bg-img2 bg-base-dark clearfix">
            <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--section-title-->
                        <div class="section-title title-style-center_text">
                            <div class="title-header">
                                <h3>UNDERSTAND US BETTER</h3>
                                <h2 class="title">Know what we  <br><span>strive </span> for</h2>
                            </div>
                        </div><!--section-title end-->
                    </div>
                </div>
                <div class="row res-575-mt_25">
                    <div class="col-lg-12">
                        <div class="featured-icon-box style6">
                            <div class="featured-icon-wrapper">
                                <div class="featured-icon">
                                    <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-lg prt-icon_element-color-skincolor">
                                        <i class="flaticon-passport-3"></i>
                                    </div>
                                </div>
                                <div class="featured-title">
                                    <h3>Our Mission</h3>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-desc">
                                    <p>{{ ucfirst(@$homepage_info->mission) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="featured-icon-box style6">
                            <div class="featured-icon-wrapper">
                                <div class="featured-icon">
                                    <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-lg prt-icon_element-color-skincolor">
                                        <i class="flaticon-office-building"></i>
                                    </div>
                                </div>
                                <div class="featured-title">
                                    <h3>Our Vision</h3>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-desc">
                                    <p>{{ ucfirst(@$homepage_info->vision) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="featured-icon-box style6">
                            <div class="featured-icon-wrapper">
                                <div class="featured-icon">
                                    <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-lg prt-icon_element-color-skincolor">
                                        <i class="flaticon-coronavirus"></i>
                                    </div>
                                </div>
                                <div class="featured-title">
                                    <h3>Our Goal</h3>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-desc text-justify">
                                    <p>{{ ucfirst(@$homepage_info->value) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(count($latestServices) > 0)
            <section class="prt-row home01-services-section bg-img1 bg-base-grey prt-bg prt-bgimage-yes clearfix">
                <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
                <div class="container" data-aos="fade-up">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-10 m-auto">
                            <!--section-title-->
                            <div class="section-title title-style-center_text">
                                <div class="title-header">
                                    <h3>OUR CATEGORIES</h3>
                                    <h2 class="title">We provide great <br> categories <span>for you</span></h2>
                                </div>
                            </div><!--section-title end-->
                        </div>
                    </div>
                    <div class="row slick_slider" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows":false, "dots":false, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1024,"settings":{"slidesToShow": 2}} , {"breakpoint":991,"settings":{"slidesToShow": 2}}, {"breakpoint":575,"settings":{"slidesToShow": 1}}]}'>
                        @foreach(@$latestServices as $index=>$service)
                            <div class="col-lg-6">
                                <!-- featured-imagebox-post -->
                                <div class="featured-imagebox featured-imagebox-services style1">
                                    <!-- featured-thumbnail -->
                                    <div class="featured-thumbnail">
                                        <img class="img-fluid" src="{{asset('/images/service/thumb/thumb_'.@$service->banner_image)}}" alt="blog_img">
                                    </div><!-- featured-thumbnail end-->
                                    <div class="featured-details-wrap">
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3><a href="{{route('service.single',$service->slug)}}" tabindex="0">{{ucwords(@$service->title)}}</a></h3>
                                            </div>
                                        </div>
                                        <div class="featured-explore-more">
                                            <a href="{{route('service.single',$service->slug)}}">Explore more</a>
                                        </div>
                                    </div>
                                    <div class="services-details-wrap">
                                        <div class="services-details-box">
                                            <div class="services-content">
                                                <div class="services-title">
                                                    <h3><a href="{{route('service.single',$service->slug)}}" tabindex="0">{{ucwords(@$service->title)}}</a></h3>
                                                </div>
                                                <div class="services-desc">
                                                    <p>{{ elipsis( strip_tags($service->description) )}}</p>
                                                </div>
                                            </div>
                                            <div class="services-explore-more">
                                                <a href="{{route('service.single',$service->slug)}}">Explore more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- featured-imagebox-post end -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!--services-section end-->
        @endif

        <section class="prt-row padding_zero-section service01-consulting-section bg-layer-equal-height clearfix">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="prt-bg prt-col-bgcolor-yes prt-left-span bg-base-dark spacing-16 z-index-2">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                                <div class="layer-content">
                                    <!--section-title -->
                                    <div class="section-title style2" style="margin-bottom: 0px;">
                                        <div class="title-header">
                                            <?php $split = explode(" ", @$homepage_info->action_heading);?>
                                            <h2 class="title" style="font-size: 30px;line-height: 40px;">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$homepage_info->action_heading)}} <span>{{$split[count($split)-1]}}</span></h2>
                                        </div>
                                    </div><!--section-title-end -->

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="col-bg-img-twenty prt-bg prt-col-bgimage-yes prt-right-span">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                                <div class="layer-content">
                                    <div class="row g-0 h-100">
                                        <div class="col-lg-8">
                                            <div class="bg-base-light-skin h-100">
                                                <div class="spacing-27 h-100 d-flex flex-column justify-content-between">
                                                    <!--section-title-end -->
                                                    <div class="">
                                                        <a class="prt-btn prt-btn-size-sm prt-btn-shape-round mt-55 prt-btn-style-fill prt-btn-color-dark" href="{{ route('contact') }}">Our Consulting</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @if(count($latestcourses) > 0)
            <section class="prt-row home02-service-section bg-layer-equal-height clearfix" style="padding: 50px 0 140px;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 align-self-end">
                            <!-- section title -->
                            <div class="section-title style2 mb-15">
                                <div class="title-header">
                                    <h3>Start your journey</h3>
                                    <h2 class="title">Study Abroad <br> with our<br> <span>programme.</span></h2>
                                </div>
                            </div><!-- section title end -->
                        </div>
                        @foreach(@$latestcourses as $index=>$latest)
                            <div class="col-lg-4 col-md-6">
                                <div class="featured-imagebox featured-imagebox-services style2">
                                    <div class="prt-box-view-overlay prt-portfolio-box-view-overlay">
                                        <div class="featured-thumbnail">
                                            <img class="img-fluid" src="{{ @$latest->image ? asset('/images/course/thumb/thumb_'.@$latest->image):''}}" alt="">
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h3><a href="{{ route('study-abroad.single', $latest->slug) }}" tabindex="0">{{ $latest->title ?? '' }}</a></h3>
                                            </div>
                                            <div class="featured-desc">
                                                <p>
                                                    {{ elipsis( strip_tags($latest->description ?? '') )}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(!empty($homepage_info->why_heading))
            <section class="prt-row padding_zero-section broken-section bg-layer-equal-height clearfix">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <!-- col-img-img-two -->
                            <div class="col-bg-img-one prt-bg prt-col-bgimage-yes prt-left-span z-index-2">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                                <div class="layer-content position-relative">
                                    <div class="row">
                                        <div class="col-xl-7 col-lg-12"></div>
                                        <div class="col-xl-5 col-lg-12 res-991-pl-0 res-991-pr-0">
                                            <div class="services-info-fid">
                                                <div class="prt-fid inside style1 bg-base-skin">
                                                    <div class="prt-fid-contents text-base-white">
                                                        <h4 class="prt-fid-inner">
                                                                <span   data-appear-animation="animateDigits"
                                                                        data-from="0"
                                                                        data-to="852"
                                                                        data-interval="50"
                                                                        data-before=""
                                                                        data-before-style="sup"
                                                                        data-after="+"
                                                                        data-after-style="sub"
                                                                        class="numinate">852
                                                                </span>
                                                        </h4>
                                                        <h3 class="prt-fid-title">Projects Are Completed</h3>
                                                    </div>
                                                </div>
                                                <div class="prt-fid inside style1 bg-base-skin">
                                                    <div class="prt-fid-contents text-base-white">
                                                        <h4 class="prt-fid-inner">
                                                                <span   data-appear-animation="animateDigits"
                                                                        data-from="0"
                                                                        data-to="852"
                                                                        data-interval="50"
                                                                        data-before=""
                                                                        data-before-style="sup"
                                                                        data-after="+"
                                                                        data-after-style="sub"
                                                                        class="numinate">852
                                                                </span>
                                                        </h4>
                                                        <h3 class="prt-fid-title">Projects Are Completed</h3>
                                                    </div>
                                                </div>
                                                <div class="prt-fid inside style1 bg-base-skin">
                                                    <div class="prt-fid-contents text-base-white">
                                                        <h4 class="prt-fid-inner">
                                                                <span   data-appear-animation="animateDigits"
                                                                        data-from="0"
                                                                        data-to="900"
                                                                        data-interval="100"
                                                                        data-before=""
                                                                        data-before-style="sup"
                                                                        data-after="+"
                                                                        data-after-style="sub"
                                                                        class="numinate">900
                                                                </span>
                                                        </h4>
                                                        <h3 class="prt-fid-title">Gave Sigange Advice</h3>
                                                    </div>
                                                </div>
                                                <div class="prt-fid inside style1 bg-base-skin">
                                                    <div class="prt-fid-contents text-base-white">
                                                        <h4 class="prt-fid-inner">
                                                                <span   data-appear-animation="animateDigits"
                                                                        data-from="0"
                                                                        data-to="630"
                                                                        data-interval="50"
                                                                        data-before=""
                                                                        data-before-style="sup"
                                                                        data-after="+"
                                                                        data-after-style="sub"
                                                                        class="numinate">8630
                                                                </span>
                                                        </h4>
                                                        <h3 class="prt-fid-title">Clients Are Satisfied</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row end -->
                        </div>
                        <div class="col-lg-6">
                            <!-- col-img-img-two -->
                            <div class="prt-bg prt-col-bgcolor-yes bg-base-dark prt-right-span spacing-1">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                                <div class="layer-content">
                                <?php $split = explode(" ", @$homepage_info->why_heading);?>

                                <!-- section title -->
                                    <div class="section-title style2">
                                        <div class="title-header">
                                            <h3>Why choose us</h3>
                                            {{ @$homepage_info->why_heading ?? '' }}
                                            <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$homepage_info->why_heading)."\n"}} <span> {{$split[count($split)-1]}}</span></h2>
                                        </div>
                                    </div><!-- section title end -->
                                    <div class="pt-5 text-justify">
                                        <p>  {{ucfirst(@$homepage_info->why_description)}}</p>
                                    </div>
                                </div>
                            </div><!-- row end -->
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(count($latesttests) > 0)
            <section class="prt-row home03-services-section clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--section-title -->
                        <div class="section-title title-style-center_text">
                            <div class="title-header">
                                <h3>Trainings and tests</h3>
                                <h2 class="title">Get the best trainings <br>you deserve <span></span></h2>
                            </div>
                        </div><!--section-title-end -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="prt-tabs slider-tab">
                            <div class="content-tab">
                                <div class="row">
                                    @foreach(@$latesttests as $index=>$latest)
                                        <div class="col-lg-4 col-md-6">
                                            <!-- featured-imagebox -->
                                            <div class="featured-imagebox featured-imagebox-tab">
                                                <div class="featured-thumbnail">
                                                    <img class="img-fluid lazy" width="656" height="484" data-src="{{ @$latest->image ? asset('/images/test_preparation/thumb/thumb_'.@$latest->image):''}}"  alt="gallery-img">
                                                </div>
                                                <div class="featured-content bg-base-grey">
                                                    <div class="featured-title">
                                                        <h3><a href="{{ route('test-preparation.single', $latest->slug) }}">  {{ $latest->title ?? ''}}</a></h3>
                                                    </div>
                                                    <div class="featured-desc text-justify">
                                                        <p>
                                                            {{ elipsis( strip_tags($latest->summary ?? '') )}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div><!-- featured-imagebox end-->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(count($clients) > 0)
            <section class="prt-row about01-why-us-section prt-bg prt-bgimage-yes bg-img2 bg-base-grey clearfix">
                <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--section-title-->
                            <div class="section-title title-style-center_text">
                                <div class="title-header">
                                    <h3>Our affiliation</h3>
                                    <h2 class="title">Institutions We Proudly  <br><span>Represent </span></h2>
                                </div>
                            </div><!--section-title end-->
                        </div>
                    </div>
                    <div class="row res-575-mt_25">
                        <div class="col-lg-12">
    {{--                            @foreach($clients->chunk(5) as $chunk)--}}
                                    <div class="slick_slider row" data-slick='{"slidesToShow": 5, "slidesToScroll": 1, "arrows":true, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1200,"settings":{"slidesToShow": 4}}, {"breakpoint":1024,"settings":{"slidesToShow": 3}}, {"breakpoint":777,"settings":{"slidesToShow": 2}}, {"breakpoint":575,"settings":{"slidesToShow": 1}}, {"breakpoint":420,"settings":{"slidesToShow": 1}}]}'>
                                        @foreach($clients as $client)
                                            <div class="col-lg-12">
                                                <div class="client-box style1">
                                                    <div class="client-thumbnail">
                                                        <a href="{{ $client->link ?? '#' }}" target="{{ ($client->link !== null) ? '_blank':'' }}">
                                                            <img class="img-fluid lazy" data-src="{{asset('/images/clients/'.@$client->image)}}"  alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div><!-- slick_slider end -->
    {{--                            @endforeach--}}
                            </div>
                    </div>
                </div>
           </section>
        @endif

{{--       <section class="prt-row home01-immigration-and-services-section clearfix">--}}
{{--            <div class="container" data-aos="fade-up">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-8 col-md-8 col-sm-10 m-auto">--}}
{{--                        <!--section-title-->--}}
{{--                        <div class="section-title title-style-center_text">--}}
{{--                            <div class="title-header">--}}
{{--                                <h3>COUNTRIES WE OFFER</h3>--}}
{{--                                <h2 class="title">Immigration & visa services <br>following <span> Countries</span></h2>--}}
{{--                            </div>--}}
{{--                        </div><!--section-title end-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row mt_15">--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/01.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="france.html">France</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/02.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="england.html">England</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/03.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="russia.html">New Zealand</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/04.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="italy.html">Italy</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/05.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="russia.html">Russia</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/06.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="india.html">India</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/07.jpg" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="united-kingdom.html">United Kingdom</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <!-- featured-imagebox -->--}}
{{--                        <div class="featured-imagebox featured-imagebox-portfolio style1">--}}
{{--                            <div class="featured-imagebox-wrapper">--}}
{{--                                <div class="featured-thumbnail">--}}
{{--                                    <img width="656" height="484" class="img-fluid" src="images/portfolio/08.png" alt="image">--}}
{{--                                </div>--}}
{{--                                <div class="featured-content">--}}
{{--                                    <div class="featured-title">--}}
{{--                                        <h3><a href="australia.html">Australia</a></h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div><!-- featured-imagebox end-->--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        @if(@$recruitments[0]->heading)
            <section class="prt-row about02-procedure-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- section title -->
                            <div class="section-title title-style-center_text style5">
                                <div class="title-header">
                                    <h3>Our work flow</h3>
                                    <h2 class="title">Achieve your Dreams With These <br>Simple steps <span></span></h2>
                                </div>
                            </div><!-- section title end -->
                        </div>
                    </div>
                    <div class="row mt_15">
                        @foreach(@$recruitments as $index=>$recruitment)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="featured-imagebox featured-imagebox-procedure">
                                    <div class="image-procedure">
                                        <div class="featured-thumbnail">
                                            <img class="img-fluid auto_size lazy" width="210" height="210" data-src="{{asset('assets/frontend/images/downloaded.png')}}" alt="image">
                                            <div class="process-num"><span class="number"></span></div>
                                        </div>
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h3>{{@$recruitment->title}}</h3>
                                        </div>
                                        <div class="featured-desc">
                                            <p>{{ $recruitment->icon_description ?? '' }}</p>
                                        </div>
                                    </div>
                                </div><!-- featured-imagebox end-->
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if(count($testimonials) > 0)
            <section class="prt-row padding_zero-section home01-testimonial-section clearfix">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-lg-6 mb_80 res-991-mb-0">
                            <div class="prt-bg prt-col-bgimage-yes prt-col-bgcolor-yes prt-left-span bg-base-dark spacing-2">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer">
                                    <div class="prt-col-wrapper-bg-layer-inner"></div>
                                </div>
                                <div class="layer-content">
                                    <!-- section title -->
                                    <div class="section-title style2">
                                        <div class="title-header">
                                            <h3>Our Success Stories<</h3>
                                            <h2 class="title">Hear what our students say have <span class="text-base-skin"> to say</span></h2>
                                        </div>
                                    </div><!-- section title end -->
                                    <div class="row vertical_slider testimonial-vertical" data-slick='{"slidesToShow": 2, "slidesToScroll": 1, "arrows":false, "dots":false, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1024,"settings":{"slidesToShow": 2}}, {"breakpoint":992,"settings":{"slidesToShow": 1}}, {"breakpoint":768,"settings":{"slidesToShow": 1}}, {"breakpoint":576,"settings":{"slidesToShow": 1}}]}'>
                                        @foreach($testimonials as $testimonial)
                                            <div class="col-lg-12">
                                                <div class="testimonials style1">
                                                    <div class="testimonial-content">
                                                        <blockquote class="testimonial-text">
                                                            {{ucfirst($testimonial->description)}}
                                                        </blockquote>
                                                    </div>
                                                    <div class="testimonial-bottom">
                                                        <div class="testimonial-avatar">
                                                            <div class="testimonial-img">
                                                                <img class="img-fluid lazy" data-src="{{asset('/images/testimonial/'.@$testimonial->image)}}" alt="testimonial-img" width="60" height="60">
                                                            </div>
                                                        </div>
                                                        <div class="testimonial-caption">
                                                            <h3>{{ucfirst($testimonial->name)}}</h3>
                                                            <label>{{ucfirst($testimonial->position)}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="prt-bg prt-col-bgimage-yes prt-right-span col-bg-img-two">
                                <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                                <div class="layer-content"></div>
                            </div>
                            <img class="img-fluid prt-equal-height-image" src="{{ asset('assets/frontend/images/bg-image/col-bgimage-2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(count($latestPosts) > 0)
            <section class="prt-row home03-blog-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!--section-title -->
                            <div class="section-title title-style-center_text style5">
                                <div class="title-header">
                                    <h3>LATEST NEWS</h3>
                                    <h2 class="title">Latest News & Articles From The <br><span>Blog</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach(@$latestPosts as $index=>$post)
                            <div class="col-md-6">
                                <div class="featured-imagebox featured-imagebox-blog style3">
                                    <div class="row g-0 row-equal-height">
                                        <div class="col-sm-5">
                                            <div class="prt-bg prt-col-bgimage-yes col-bg-img-ten spacing-8">
                                                <div class="prt-col-wrapper-bg-layer prt-bg-layer" style="background-image: url({{asset('/images/blog/thumb/thumb_'.@$post->image)}})"></div>
                                                <div class="layer-content">
                                                    <div class="prt-box-post-date">
                                                        <span>{{date('d', strtotime($post->created_at))}}</span>
                                                        <label>{{date('M Y', strtotime($post->created_at))}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="featured-content">
                                                <div class="post-meta">
                                                    <a href="{{route('blog.single',@$post->slug)}}">
                                                        <span> {{ucfirst(@$post->category->name)}} </span>
                                                    </a>
                                                </div>
                                                <div class="featured-title">
                                                    <h3><a href="{{route('blog.single',$post->slug)}}" {{ucfirst(@$post->title)}}</a></h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>
                                                        {{ elipsis( strip_tags($post->description ?? '') )}}
                                                    </p>
                                                </div>
                                                <div class="featured-bottom">
                                                    <a class="prt-btn btn-inline prt-btn-size-md prt-icon-btn-right" href="{{route('blog.single',$post->slug)}}">View More<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    </div><!-- site-main end-->
@endsection
@section('js')
    <script src="{{asset('assets/frontend/js/lightbox.min.js')}}"></script>
@endsection

