@extends('frontend.layouts.master')
@section('title') {{ucwords(@$page_detail->name)}} @endsection
@section('css')
    <style>

        .img-wrapper {
            height: 270px;
            object-fit: cover;
        }
        #gallery img.img-responsive {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/common/lightbox.css')}}">

@endsection
@section('content')
    <section class="page-title" style="background-image: url({{ $page_detail->image ? asset('images/page/'.$page_detail->image) : asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title"> {{ucwords(@$page_detail->name)}}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li> {{ucwords(@$page_detail->name)}}</li>
                </ul>
            </div>
        </div>
    </section>

    @foreach($sections as $key=>$value)

        @if($value == "basic_section")
            <section class="about-section-five" style="padding: 120px 0 10px;">
                <div class="auto-container">
                    <div class="anim-icons">
                        <span class="icon icon-object-3"></span>
                    </div>
                    <div class="row">
                        <div class="content-column col-lg-6 col-md-12 order-2 wow fadeInRight animated" data-wow-delay="600ms">
                            <div class="inner-column">
                                <div class="sec-title" style="    margin-bottom: 20px;">
                                    <span class="sub-title">About our company</span>
                                    <h2>  {{@$basic_elements->heading ?? ''}}</h2>
                                    <div class="text text-justify">{!! @$basic_elements->description !!}</div>
                                </div>
                                @if(@$basic_elements->button_link)
                                    <div class="btn-box">
    {{--                                    <a href="tel:+92(8800)9806" class="info-btn">--}}
    {{--                                        <i class="icon fa fa-phone"></i>--}}
    {{--                                        <small>Call Anytime</small> + 88 ( 9800 ) 6802--}}
    {{--                                    </a>--}}
                                        <a href="{{@$basic_elements->button_link}}" class="theme-btn btn-style-one"><span class="btn-title">  {{ucwords(@$basic_elements->button ?? 'Discover More')}}</span></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Image Column -->
                        <div class="image-column col-lg-6 col-md-12">
                            <div class="inner-column wow fadeInLeft animated">
                                <figure class="image overlay-anim wow fadeInUp animated">
                                    <img class="lazy" data-src="{{asset('/images/section_elements/basic_section/'.@$basic_elements->image) }}" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($value == "call_to_action_1")
            <section class="call-to-action-two pull-up" style="background-image: url( http://localhost:8000/assets/frontend/images/cta/01.jpeg)">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="title-box">
                                <h2 class="title">{{ $call1_elements->heading }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="video-box">
                                <div class="inner">
                                    <a href="{{@$call1_elements->button_link ?? '/contact-us'}}" class="theme-btn btn-style-one light"><span class="btn-title"> {{ucwords(@$call1_elements->button ?? 'Get Started')}}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($value == "call_to_action_2")
            <div class="call-to-action">
                <div class="auto-container">
                    <div class="inner-container" style="padding: 40px 0;">
                        <h5 class="title">{{ @$call2_elements->heading ?? '' }}</h5>
                        <a href="{{@$call2_elements->button_link ?? '/contact-us'}}" class="info-btn">{{ucwords(@$call2_elements->button ?? 'Reach Out')}}</a>
                    </div>
                </div>
            </div>
        @endif
        @if($value == "background_image_section")
            <section class="why-choose-us-three" style="padding: 120px 0 0;">
                <div class="anim-icons">
                    <span class="icon icon-object-1"></span>
                </div>
                <div class="auto-container">
                    <div class="row">
                        <!-- Content Column -->
                        <div class="content-column col-lg-7 col-md-12">
                            <div class="inner-column wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
                                <div class="sec-title">
                                    <i class="sub-title">{{@$bgimage_elements->subheading ?? ''}}</i>
                                    <h2> {{@$bgimage_elements->heading ?? ''}}</h2>
                                    <div class="text text-justify">
                                        {{ @$bgimage_elements->description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Image Column -->
                        <div class="image-column col-lg-5 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="image-box">
                                    <figure class="bg-image"><img src="{{asset('assets/frontend/images/resource/image-6.jpg')}}" alt=""></figure>
                                    <figure class="image"><img src="{{asset('/images/section_elements/bgimage_section/'.@$bgimage_elements->image)}}" alt=""></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($value == "flash_cards")
            <div class="rs-services style1 modify shape-bg pt-128 md-pt-70 pb-80 md-pb-80">
                <div class="container">
                    <div class="sec-title4 text-center mb-60">
                        <div class="sub-title mb-2">{{$flash_elements[0]->subheading ?? ''}}</div>
                        <h2 class="title primary-color">{{@$flash_elements[0]->heading ?? ''}}</h2>
                    </div>
                    <div class="row service-wrap mr-0 ml-0">
                        @foreach(@$flash_elements as $index=>$flash_element)
                            <div class="col-lg-4 padding-0 {{ $loop->first ? 'pr-1':'' }}">
                                <div class="service-grid">
                                    <div class="service-icon mb-23">
                                        <img src="{{ asset('assets/frontend/images/services/'.get_icons($index)) }}" alt="">
                                    </div>
                                    <h4 class="title mb-18">
                                        <a>
                                            {{ucwords(@$flash_element->list_header)}}
                                        </a>
                                    </h4>
                                    <div class="desc mb-12">
                                        {{ucfirst(@$flash_element->list_description) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if($value == "simple_header_and_description")

            <section class="blog-details">
                <div class="container" style="padding-top:0">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @if(@$header_descp_elements->heading!==null)
                                <div class="sec-title text-center">
                                    <span class="sub-title">  {{@$header_descp_elements->subheading ?? ''}}</span>
                                    <h2>  <?php
                                        $split = explode(" ", @$header_descp_elements->heading);?> {{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$header_descp_elements->heading)."\n"}} <br> {{$split[count($split)-1]}}</h2>
                                </div>
                            @endif
                            <div class="blog-details__left">
                                <div class="blog-details__content">
                                    <div class="blog-details__text-2 custom-description">
                                        {!! @$header_descp_elements->description !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        @endif

        @if($value == "map_and_description")
            <div class="rs-contact contact-style2 bg11 pt-95 pb-100 md-pt-65 md-pb-70">
                <div class="container">
                    <div class="row y-middle">
                        <div class="col-lg-6">
                            <div class="sec-title2 mb-45 md-mb-30">
                                <div class="sub-text">{{@$map_descp->subheading ?? ''}}</div>
                                <h2 class="title mb-23">
                                    <?php
                                    $split = explode(" ", @$map_descp->heading);?> {{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$map_descp->heading)."\n"}}
                                    <span> {{$split[count($split)-1]}} </span>
                                </h2>
                                <div class="desc mb-0 text-justify">
                                    {!! @$map_descp->description !!}
                                </div>
                                @if(@$map_descp->button_link)
                                    <div class="btn-part mt-3">
                                        <a class="readon consultant discover" href="{{@$map_descp->button_link}}">
                                            {{ucwords(@$map_descp->button ?? 'Contact us')}}
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-map">
                                <iframe src="{{@$setting_data->google_map ?? ''}}"
                                        width="600" height="400" style="border:0;"
                                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($value == "small_box_description")
            @if(count($process_elements)>0)
            <div id="rs-services" class="rs-services style6 bg14" style="margin-top: 0px;padding-top: 100px;padding-bottom: 100px;">
                <div class="container">
                    <div class="sec-title text-center mb-50">
                        <span class="sub-text small"> {{ ucfirst($process_elements[0]->subheading ?? '') }}</span>
                        <h2 class="title title3">
                            {{@$process_elements[0]->heading}}
                        </h2>
                    </div>
                    <div class="services-box-area bg20">
                        <div class="row margin-0">
                            @for ($i = 1; $i <=@$process_num; $i++)
                                <div class="col-lg-4 col-md-6 col-sm-6 padding-0">
                                    <div class="services-item">
                                        <div class="services-content">
                                            <h3 class="title"><a> {{ucwords(@$process_elements[$i-1]->list_header ??'')}}</a></h3>
                                            <p class="margin-0 text-justify">
                                                {{ucfirst(@$process_elements[$i-1]->list_description)}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif

        @if($value == "gallery_section")
            <div class="rs-project style3 pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container">
                    @if(@$heading!==null)
                        <div class="sec-title3 text-center mb-25 md-mb-45">
                            <span class="sub-title">  {{@$subheading ?? ''}}</span>
                            <h2 class="title pb-15">
                                {{@$heading}}
                            </h2>
                            <div class="heading-border-line"></div>
                        </div>
                    @endif
                    <div class="row">
                        @if(count(@$gallery_elements) > 0)
                            <div id="gallery" style="padding: 0px 30px 0 30px;">
                                <div id="image-gallery">
                                    <div class="row">
                                        @foreach($gallery_elements as $gallery)
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                                                <div class="{{  $page_detail->slug =='legal-document' || $page_detail->slug =='legal-documents' ? "":"img-wrapper"   }}">
                                                    <a href="{{asset('/images/section_elements/gallery/'.@$gallery->filename)}}">
                                                        <img data-src="{{asset('/images/section_elements/gallery/'.@$gallery->filename)}}" class="img-responsive lazy"></a>
                                                    <div class="img-overlay">
                                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div><!-- End row -->
                                </div><!-- End image gallery -->
                            </div><!-- End container -->
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if($value == "slider_list")
            @if(count($slider_list_elements)>0))

            <div id="rs-services" class="rs-services style2 gray-bg pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container">
                    <div class="sec-title2 d-flex align-items-center mb-60 md-mb-40">
                        <div class="first-half">
                            <div class="sub-text">{{ucwords(@$slider_list_elements[0]->description)}}</div>
                            <h2 class="title mb-0 md-pb-20">
                                <?php
                                $split = explode(" ", @$slider_list_elements[0]->heading);?> {{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$slider_list_elements[0]->heading)."\n"}}
                                <span> {{$split[count($split)-1]}} </span>
                            </h2>
                        </div>
                    </div>
                    <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30"
                         data-autoplay="true" data-hoverpause="true" data-autoplay-timeout="5000" data-smart-speed="800"
                         data-dots="true" data-nav="false" data-nav-speed="false" data-md-device="3"
                         data-md-device-nav="false" data-md-device-dots="true" data-center-mode="false" data-ipad-device2="2"
                         data-ipad-device-nav2="false" data-ipad-device-dots2="true" data-ipad-device="2"
                         data-ipad-device-nav="false" data-ipad-device-dots="true" data-mobile-device="1"
                         data-mobile-device-nav="false" data-mobile-device-dots="true">
                        @for ($i = 1; $i <=@$list_3; $i++)
                            <div class="service-wrap">
                                <div class="image-part">
                                    <img class="lazy" data-src="{{ asset('/images/section_elements/list_1/thumb/thumb_'.$slider_list_elements[$i-1]->list_image) }}" alt="">
                                </div>
                                <div class="content-part">
                                    <h3 class="title" style="font-size: 18px;line-height: 26px;font-weight: 600;">
                                        <a href="{{route('slider.single',@$slider_list_elements[$i-1]->subheading)}}">
                                            {{ucwords(@$slider_list_elements[$i-1]->list_header)}}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
            @endif
        @endif

    @endforeach


@endsection
@section('js')
    <script src="{{asset('assets/common/lightbox.min.js')}}"></script>
  <script>
      $( document ).ready(function() {
          let selector = $('.custom-description').find('table').length;
          if(selector>0){
              $('.custom-description').find('table').addClass('table table-bordered');
          }
      });
  </script>
@endsection
