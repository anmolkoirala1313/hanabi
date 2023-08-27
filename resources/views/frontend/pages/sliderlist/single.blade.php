@extends('frontend.layouts.master')
@section('title')  {{ucwords(@$singleSlider->list_header)}} @endsection
@section('css')
@endsection


@section('content')

    <div class="prt-titlebar-wrapper prt-bg">
        <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
        <div class="prt-titlebar-wrapper-inner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="prt-page-title-row-heading">
                            <div class="page-title-heading">
                                <h2 class="title">{{ucwords(@$singleSlider->list_header)}}</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>List Detail</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-main">

        <!--sidebar-->
        <div class="sidebar prt-sidebar-left prt-blog bg-base-grey clearfix">
            <div class="container">
                <!-- row -->
                <div class="row g-0">
                    <div class="col-lg-4 widget-area sidebar-left">
                        @include('frontend.pages.sliderlist.sidebar')
                    </div>
                    <div class="col-lg-8 content-area prt-blog-single">
                        <div class="prt-blog-single-content">
                            <div class="prt_single_image-wrapper">
                                <img class="img-fluid lazy" width="1200" height="720" data-src="{{ asset('/images/section_elements/list_1/'.$singleSlider->list_image) }}" alt="">
                            </div>
                            <div class="entry-content">
                                <div class="prt-box-desc-text">
                                    <h3 class="comment-reply-title">{{ ucwords(@$singleSlider->list_header ) }}</h3>
                                    <div class="pt-10 custom-description text-justify">
                                        {!! @$singleSlider->list_description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!--sidebar end-->
    </div><!-- site-main end-->
@endsection
