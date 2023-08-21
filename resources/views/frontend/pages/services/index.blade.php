@extends('frontend.layouts.master')
@section('title') Our Services @endsection
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
                                <h2 class="title">Our Category</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Category</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--site-main start-->
    <div class="site-main">

        <!--sidebar-->
        <div class="sidebar prt-sidebar-left prt-blog bg-base-grey clearfix">
            <div class="container">
                <!-- row -->
                <div class="row g-0">
                    <div class="col-lg-4 widget-area sidebar-left">
                        @include('frontend.pages.services.sidebar')
                    </div>
                    <div class="col-lg-8 content-area prt-blog-single">
                        <div class="row">
                            @foreach(@$allservices as $index=>$service)
                                <div class="col-lg-6 col-md-6">
                                    <!-- featured-imagebox-post -->
                                    <div class="featured-imagebox featured-imagebox-services style1" style="margin-top: 0px">
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
                            <div class="pagination-block">
                                {{ $allservices->links('vendor.pagination.default') }}
                            </div>
                        </div>

                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!--sidebar end-->
    </div><!-- site-main end-->
@endsection
