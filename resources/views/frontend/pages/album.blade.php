@extends('frontend.layouts.master')
@section('title') Album @endsection
@section('styles')
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
                                <h2 class="title">Our Albums</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Our Albums</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-main">

        <!--services-section-->
        <section class="prt-row service01-services-section clearfix" style="    padding: 70px 0 70px;">
            <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
            <div class="container">
                <div class="row">
                    @foreach($albums as $index=>$album)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <!-- featured-imagebox -->
                            <div class="featured-imagebox featured-imagebox-portfolio style1">
                                <div class="featured-imagebox-wrapper">
                                    <div class="featured-thumbnail">
                                        <img width="656" height="484" class="img-fluid lazy" data-src="{{asset('/images/albums/'.@$album->cover_image)}}" alt="image">
                                    </div>
                                    <div class="featured-content">
                                        <div class="featured-title">
                                            <h3><a href="{{route('album.gallery',$album->slug)}}">  {{ ucfirst($album->name) }} </a></h3>
                                            <h4>Images: ({{count(@$album->gallery)}})</h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- featured-imagebox end-->
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--services-section end-->
    </div>
@endsection


