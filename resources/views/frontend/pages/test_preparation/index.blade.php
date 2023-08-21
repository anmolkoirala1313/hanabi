@extends('frontend.layouts.master')
@section('title') Test Preparation @endsection
@section('css')
    <style>

    .corpkit-content > .corpkit-content-inner {
        padding-top: 0;
        padding-bottom: 0;
    }
</style>
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
                                <h2 class="title">Test Preparation</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Test Preparation</span>
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
                        @include('frontend.pages.test_preparation.sidebar')
                    </div>
                    <div class="col-lg-8 content-area prt-blog-single">
                        <div class="row">
                            @foreach(@$rows as $index=>$latest)
                                <div class="col-lg-6 col-md-6">
                                    <!-- featured-imagebox -->
                                    <div class="featured-imagebox featured-imagebox-tab">
                                        <div class="featured-thumbnail">
                                            <img class="img-fluid lazy" width="656" height="484" data-src="{{ @$latest->image ? asset('/images/test_preparation/thumb/thumb_'.@$latest->image):''}}" alt="">
                                        </div>
                                        <div class="featured-content" style="background-color: #fff;height: 155px;">
                                            <div class="featured-title">
                                                <h3><a href="{{ route('test-preparation.single', $latest->slug) }}">  {{ $latest->title }}</a></h3>
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
                            <div class="pagination-block">
                                {{ $rows->links('vendor.pagination.default') }}
                            </div>
                        </div>

                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!--sidebar end-->
    </div><!-- site-main end-->
@endsection
