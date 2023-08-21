@extends('frontend.layouts.master')
@section('title') Study Abroad @endsection
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
                                <h2 class="title">Study Abroad</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Course List</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-main">

        <!--sidebar-->
        <div class="sidebar prt-sidebar-right prt-blog bg-base-grey clearfix">
            <div class="container">
                <!-- row -->
                <div class="row g-0">
                    <div class="col-lg-8 content-area prt-blog-classic">
                        <div class="prt-blog-classic-content">
                            <div class="row">
                                @foreach($rows as $index=>$latest)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="feaured-imagebox featured-imagebox-services style2">
                                            <div class="prt-box-view-overlay prt-portfolio-box-view-overlay">
                                                <div class="featured-thumbnail">
                                                    <img class="img-fluid" src="{{ @$latest->image ? asset('/images/course/thumb/thumb_'.@$latest->image):''}}" alt="">
                                                </div>
                                                <div class="featured-content">
                                                    <div class="featured-title">
                                                        <h3><a href="{{ route('study-abroad.single',$latest->slug) }}" tabindex="0"> {{ $latest->title ?? '' }}</a></h3>
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
                                <div class="pagination-block">
                                    {{ $rows->links('vendor.pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 widget-area sidebar-right">
                        @include('frontend.pages.course.sidebar')
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!--sidebar end-->

    </div><!-- site-main end-->

@endsection
