@extends('frontend.layouts.master')
@section('title') {{ucwords(@$cat_name)}} | Blog @endsection
@section('css')
<style>
.home-one a.active {
    color: #27aae1;
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
                                <h2 class="title"> {{ucwords($cat_name)}}</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Blog category</span>
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
                                @foreach($allPosts as $index=>$post)
                                    <div class="col-lg-12">
                                        <div class="featured-imagebox featured-imagebox-blog style4">
                                            <div class="row g-0 row-equal-height">
                                                <div class="col-sm-4">
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
                                                <div class="col-sm-8">
                                                    <div class="featured-content">
                                                        <div class="post-meta">
                                                            <a href="{{route('blog.single',$post->slug)}}">
                                                                <span>{{ucfirst(@$post->category->name)}}</span>
                                                            </a>
                                                        </div>
                                                        <div class="featured-title">
                                                            <h3><a href="{{route('blog.single',$post->slug)}}">
                                                                    {{ucfirst(@$post->title)}}
                                                                </a></h3>
                                                        </div>
                                                        <div class="prt-horizontal_sep"></div>
                                                        <div class="featured-desc">
                                                            <p> {{ elipsis( strip_tags($post->description ?? '') )}}</p>
                                                        </div>
                                                        <div class="featured-bottom">
                                                            <a class="prt-btn btn-inline prt-btn-color-dark" href="{{route('blog.single',$post->slug)}}">View More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="pagination-block">
                                    {{ $allPosts->links('vendor.pagination.default') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 widget-area sidebar-right">
                        @include('frontend.pages.blogs.sidebar')
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!--sidebar end-->

    </div>

@endsection
