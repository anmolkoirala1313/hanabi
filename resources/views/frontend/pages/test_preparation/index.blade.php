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

    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Test Preparation</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Test Preparation</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="services-details">
        <div class="container">
            <div class="row">
                <!--Start Services Details Sidebar-->
                <div class="col-xl-4 col-lg-4">
                   @include('frontend.pages.test_preparation.sidebar')
                </div>
                <!--End Services Details Sidebar-->

                <!--Start Services Details Content-->
                <div class="col-xl-8 col-lg-8">
                    <div class="row">
                        @foreach(@$rows as $index=>$latest)
                            <div class="training-block-two col-lg-6 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ route('test-preparation.single', $latest->slug) }}">
                                                <img class="lazy" data-src="{{ @$latest->image ? asset('/images/test_preparation/thumb/thumb_'.@$latest->image):''}}" alt=""></a>
                                        </figure>
                                        <div class="info-box">
                                            <h5 class="title"><a href="{{ route('test-preparation.single', $latest->slug) }}">
                                                    {{ $latest->title ?? ''}}
                                                </a></h5>
                                            <div class="text">
                                                {{ elipsis( strip_tags($latest->summary ?? '') )}}
                                            </div>
                                            <a href="{{ route('test-preparation.single', $latest->slug) }}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="service-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                            {{ $rows->links('vendor.pagination.simple-bootstrap-4') }}
                        </div>
                    </div>

                </div>
                <!--End Services Details Content-->
            </div>
        </div>
    </section>

@endsection
