@extends('frontend.layouts.master')
@section('title') {{ucwords(@$page_detail->name)}} @endsection
@section('css')
    <style>
        .card-image .img-wrapper {
            height: 345px; /* Set your preferred maximum height */
            object-fit: cover;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/common/lightbox.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

@endsection
@section('content')


    <div class="prt-titlebar-wrapper prt-bg" style="background-image: url({{ $page_detail->image ? asset('images/page/'.$page_detail->image) : asset('assets/frontend/images/pagetitle-bg.jpg') }});">
        <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
        <div class="prt-titlebar-wrapper-inner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="prt-page-title-row-heading">
                            <div class="page-title-heading">
                                <h2 class="title"> {{ucwords(@$page_detail->name)}}</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>{{ucwords(@$page_detail->name)}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="site-main">

    @foreach($sections as $key=>$value)


            @if($value == "basic_section")
                <section class="prt-row about01-about-section clearfix">
                    <div class="container">
                        <div class="row g-0">
                            <div class="col-lg-5 res-1199-pl-15 res-1199-pr-15">
                                <div class="prt_single_image-wrapper">
                                    <img width="540" height="530" class="img-fluid lazy" data-src="{{asset('/images/section_elements/basic_section/'.@$basic_elements->image) }}" alt="single-img-7">
                                </div>
                            </div>
                            <div class="col-lg-7 align-self-center">
                                <div class="pl-50 res-1199-pr-15 res-1199-pl-30 res-991-pl-15 res-991-mt-30">
                                    <!-- section title -->
                                    <?php $split = explode(" ", @$basic_elements->heading);?>

                                    <div class="section-title mb-15">
                                        <div class="title-header">
                                            <h3>Why Choose Us</h3>
                                            <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$basic_elements->heading)}}<span class="text-base-skin"> {{$split[count($split)-1]}}</span></h2>
                                        </div>
                                        <div class="title-desc text-justify">
                                            {!! @$basic_elements->description !!}
                                        </div>
                                    </div><!-- section title end -->

                                    <div class="d-block d-sm-flex mt-15 res-991-mt-20">
                                        @if(@$basic_elements->button_link)
                                            <div class="res-575-mr-0">
                                                <a class="prt-btn prt-btn-size-sm prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor"
                                                   href="{{@$basic_elements->button_link}}"> {{ucwords(@$basic_elements->button ?? 'Discover More')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if($value == "call_to_action_1")
                <section class="prt-row about02-timeline-section prt-bg prt-bgimage-yes bg-img3 bg-base-dark clearfix">
                    <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title title-style-center_text style5" style="margin-bottom: 0px">
                                    <div class="title-header">
                                        <?php $split = explode(" ", @$call1_elements->heading);?>
                                        <h2 class="title" style="font-size: 36px;">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$call1_elements->heading)}} <span> {{$split[count($split)-1]}}</span></h2>
                                        <a class="prt-btn mt-3 prt-btn-size-sm prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor"
                                           href="{{@$call1_elements->button_link ?? '/contact-us'}}">{{ucwords(@$call1_elements->button ?? 'Get Started')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            @if($value == "call_to_action_2")
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
                                                    <?php $split = explode(" ", @$call2_elements->heading);?>
                                                    <h2 class="title" style="font-size: 30px;line-height: 40px;">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$call2_elements->heading)}} <span> {{$split[count($split)-1]}}</span></h2>
                                                </div>
                                            </div><!--section-title-end -->

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="col-bg-img-twenty prt-bg prt-col-bgimage-yes prt-right-span">
                                        <div class="prt-col-wrapper-bg-layer prt-bg-layer" style="background-image: url({{ asset('assets/frontend/images/bg-image/col-bgimage-11.jpg') }});"></div>
                                        <div class="layer-content">
                                            <div class="row g-0 h-100">
                                                <div class="col-lg-8">
                                                    <div class="bg-base-light-skin h-100">
                                                        <div class="spacing-27 h-100 d-flex flex-column justify-content-between">
                                                            <!--section-title-end -->
                                                            <div class="">
                                                                <a class="prt-btn prt-btn-size-sm prt-btn-shape-round mt-55 prt-btn-style-fill prt-btn-color-dark" href="{{@$call2_elements->button_link ?? '/contact-us'}}">
                                                                    {{ucwords(@$call2_elements->button ?? 'Reach Out')}}</a>
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
            @endif
            @if($value == "background_image_section")
                    <section class="prt-row padding_top_zero-section home02-about-us-section clearfix">
                        <div class="container">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="prt-col-bgimage-yes prt-bg col-bg-img-four prt-left-span mr_60 res-991-mr-0">
                                        <div class="prt-col-wrapper-bg-layer prt-bg-layer" style="background: url({{asset('/images/section_elements/bgimage_section/'.@$bgimage_elements->image)}})"></div>
                                    </div>
                                    <img class="img-fluid prt-equal-height-image" src="{{asset('/images/section_elements/bgimage_section/'.@$bgimage_elements->image)}}" alt="col-bgimage-4">
                                </div>
                                <div class="col-lg-6">
                                    <div class="prt-bg prt-col-bgcolor-yes bg-base-grey prt-bg prt-right-span spacing-4 z-index-2">
                                        <div class="prt-col-wrapper-bg-layer prt-bg-layer">
                                            <div class="prt-col-wrapper-bg-layer-inner"></div>
                                        </div>
                                        <div class="layer-content">
                                            <!-- section title -->
                                            <div class="section-title style4">
                                                <div class="title-header">
                                                    <?php $split = explode(" ", @$call1_elements->heading);?>
                                                    <h3>{{@$bgimage_elements->subheading ?? ''}}</h3>
                                                    <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$call1_elements->heading)}} <span>{{$split[count($split)-1]}}</span></h2>
                                                </div>
                                                <div class="title-desc">
                                                    <p>
                                                        {{ @$bgimage_elements->description }}
                                                    </p>
                                                </div>
                                            </div><!-- section title end -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
            @endif

            @if($value == "flash_cards")
                    <section class="prt-row services01-second-section clearfix">
                        <div class="container">
                            <div class="section-title title-style-center_text">
                                <div class="title-header">
                                    <?php $split = explode(" ", @$flash_elements[0]->heading);?>

                                    <h3>{{$flash_elements[0]->subheading ?? ''}}</h3>
                                    <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$call1_elements->heading)}}
                                        <span>{{$split[count($split)-1]}}</span></h2>
                                </div>
                            </div>
                            <div class="row g-0 row-equal-height prt-vertical_sep style2">
                                @foreach(@$flash_elements as $index=>$flash_element)
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-12">
                                        <div class="featured-icon-box style10 bg-base-dark res-575-pt-40">
                                            <div class="featured-icon">
                                                <div class="prt-icon prt-icon_element-size-md">
                                                    <i class="{{get_icons($index)}}"></i>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-title">
                                                    <h3> {{ucwords(@$flash_element->list_header)}}</h3>
                                                </div>
                                                <div class="featured-desc">
                                                    <p>  {{ucfirst(@$flash_element->list_description) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
            @endif

            @if($value == "simple_header_and_description")
                    <div class="sidebar prt-sidebar-left prt-blog bg-base-grey clearfix">
                        <div class="container">
                            <!-- row -->
                            <div class="row g-0">

                                <div class="col-lg-12 content-area prt-blog-single" style="padding: 5px 0px 80px 0px;">
                                    @if(@$header_descp_elements->heading!==null)
                                        <div class="section-title title-style-center_text pt-40">
                                            <div class="title-header">
                                                <h3>{{@$header_descp_elements->subheading ?? ''}}</h3>
                                                <h2 class="title"> {{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$header_descp_elements->heading)."\n"}} <span>{{$split[count($split)-1]}}</span></h2>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="prt-blog-single-content">
                                        <div class="entry-content">
                                            <div class="prt-box-desc-text custom-description">
                                                {!! @$header_descp_elements->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- row end -->
                        </div>
                    </div>
                @endif

            @if($value == "map_and_description")
                    <section class="prt-row about02-welcome-section clearfix">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                    <div class="res-1199-mb-30">
                                        <!--section-title -->
                                        <div class="section-title">
                                            <div class="title-header">
                                                <h3>{{@$map_descp->subheading ?? ''}}</h3>
                                                <?php $split = explode(" ", @$map_descp->heading);?>
                                                <span> {{$split[count($split)-1]}} </span>
                                                <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$map_descp->heading)}}<br><span>{{$split[count($split)-1]}}  </span></h2>
                                            </div>
                                            <div class="title-desc text-justify custom-description">
                                                 {!! @$map_descp->description !!}
                                            </div>
                                        </div><!--section-title-end -->
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12">
                                    <iframe src="{{@$setting_data->google_map ?? ''}}"
                                            width="600" height="650" style="border:0;"
                                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </section>
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
                    <section class="prt-row service01-services-section bg-base-grey clearfix" style="    padding: 70px 0 70px;">
                        <div class="container">
                            @if(@$heading!==null)
                                <div class="section-title title-style-center_text">
                                    <div class="title-header">
                                        <h3> {{@$subheading ?? ''}}</h3>
                                        <?php $split = explode(" ", @$heading);?>
                                        <span> </span>
                                        <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$heading)."\n"}}
                                            <span>{{$split[count($split)-1]}} </span></h2>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                @if(count(@$gallery_elements) > 0)
                                    @foreach($gallery_elements as $gallery)
                                        <div class="col-lg-4 col-md-6 col-sm-6">
                                            <!-- featured-imagebox -->
                                            <div class="featured-imagebox featured-imagebox-portfolio style1">
                                                <div class="card" style="border: none">
                                                    <div class="card-image gallery-item" style="background: #F0F5FB">
                                                        <a href="{{asset('/images/section_elements/gallery/'.@$gallery->filename)}}" data-fancybox="gallery">
                                                            <img src="{{asset('/images/section_elements/gallery/'.@$gallery->filename)}}" class="{{  $page_detail->slug =='legal-document' || $page_detail->slug =='legal-documents' ? "":"img-wrapper"   }}" alt="Image Gallery">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!-- featured-imagebox end-->
                                        </div>

                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </section>
            @endif

            @if($value == "slider_list")
                @if(count($slider_list_elements)>0))
                    <section class="prt-row home01-services-section bg-img1 bg-base-grey prt-bg prt-bgimage-yes clearfix">
                        <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
                        <div class="container" data-aos="fade-up">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-10 m-auto">
                                    <!--section-title-->
                                    <div class="section-title title-style-center_text">
                                        <div class="title-header">
                                            <h3>{{ucwords(@$slider_list_elements[0]->description)}}</h3>
                                            <?php
                                            $split = explode(" ", @$slider_list_elements[0]->heading);?>
                                            <h2 class="title">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$slider_list_elements[0]->heading)}} <span>{{$split[count($split)-1]}}</span></h2>
                                        </div>
                                    </div><!--section-title end-->
                                </div>
                            </div>
                            <div class="row slick_slider" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "arrows":false, "dots":false, "autoplay":true, "infinite":true, "responsive": [{"breakpoint":1024,"settings":{"slidesToShow": 2}} , {"breakpoint":991,"settings":{"slidesToShow": 2}}, {"breakpoint":575,"settings":{"slidesToShow": 1}}]}'>
                                @for ($i = 1; $i <=@$list_3; $i++)
                                    <div class="col-lg-6">
                                        <!-- featured-imagebox-post -->
                                        <div class="featured-imagebox featured-imagebox-services style1">
                                            <!-- featured-thumbnail -->
                                            <div class="featured-thumbnail">
                                                <img class="img-fluid" src="{{ asset('/images/section_elements/list_1/thumb/thumb_'.$slider_list_elements[$i-1]->list_image) }}" alt="blog_img">
                                            </div><!-- featured-thumbnail end-->
                                            <div class="featured-details-wrap">
                                                <div class="featured-content">
                                                    <div class="featured-title">
                                                        <h3><a href="{{route('slider.single',@$slider_list_elements[$i-1]->subheading)}}" tabindex="0">
                                                                {{ucwords(@$slider_list_elements[$i-1]->list_header)}}
                                                            </a></h3>
                                                    </div>
                                                </div>
                                                <div class="featured-explore-more">
                                                    <a href="{{route('slider.single',@$slider_list_elements[$i-1]->subheading)}}">Explore more</a>
                                                </div>
                                            </div>
                                            <div class="services-details-wrap">
                                                <div class="services-details-box">
                                                    <div class="services-content">
                                                        <div class="services-title">
                                                            <h3><a href="{{route('slider.single',@$slider_list_elements[$i-1]->subheading)}}" tabindex="0"> {{ucwords(@$slider_list_elements[$i-1]->list_header)}}</a></h3>
                                                        </div>
                                                        <div class="services-desc">
                                                            <p>{{ elipsis( strip_tags(@$slider_list_elements[$i-1]->list_description) )}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="services-explore-more">
                                                        <a href="{{route('slider.single',@$slider_list_elements[$i-1]->subheading)}}">Explore more</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- featured-imagebox-post end -->
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </section>
                    @endif
            @endif


        @endforeach

    </div>


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script>
      $( document ).ready(function() {
          let selector = $('.custom-description').find('table').length;
          if(selector>0){
              $('.custom-description').find('table').addClass('table table-bordered');
          }
      });
      $('[data-fancybox="gallery"]').fancybox({
          buttons: [
              "slideShow",
              "zoom",
              "close"
          ],
          loop: true,
          protect: true
      });
  </script>
@endsection
