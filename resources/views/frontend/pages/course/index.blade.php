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

    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Study Abroad</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Course List</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="row">
                @foreach(@$rows as $index=>$latest)
                    <div class="service-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="{{ route('study-abroad.single', $latest->slug) }}">
                                        <img class="lazy" data-src="{{ @$latest->image ? asset('/images/course/'.@$latest->image):''}}" alt=""></a>
                                </figure>
                                <div class="icon-box"><i class="icon fa fa-graduation-cap"></i></div>
                            </div>
                            <div class="content-box">
                                <h5 class="title"><a href="{{ route('study-abroad.single', $latest->slug) }}">
                                        {{ $latest->title ?? '' }}
                                    </a></h5>
                                <div class="text">
                                    {{ elipsis( strip_tags($latest->description ?? '') )}}
                                </div>
                                <a href="{{ route('study-abroad.single',$latest->slug) }}" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="service-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    {{ $rows->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>




@endsection
