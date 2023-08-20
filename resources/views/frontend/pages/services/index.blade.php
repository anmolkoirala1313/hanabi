@extends('frontend.layouts.master')
@section('title') Our Services @endsection
@section('css')

@endsection
@section('content')


    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Our Services</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Service</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="news-section">
        <div class="auto-container">
            <div class="row">
                @foreach(@$allservices as $index=>$service)
                    <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><a href="{{route('service.single',$service->slug)}}">
                                        <img src="{{asset('/images/service/thumb/thumb_'.@$service->banner_image)}}" alt=""></a></figure>
                            </div>
                            <div class="content-box">
                                <h4 class="title"><a href="{{route('service.single',$service->slug)}}">{{ucwords(@$service->title)}}</a></h4>
                                <a href="{{route('service.single',$service->slug)}}" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="service-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    {{ $allservices->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>


@endsection
