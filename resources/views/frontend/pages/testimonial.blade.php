@extends('frontend.layouts.master')
@section('title') Our Stories @endsection
@section('css')
@endsection
@section('content')
    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Our stories</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Testimonials</li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <div class="container pb-90">
            <div class="row">
                @foreach($testimonials as $testimonial)
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <!-- Testimonial Block -->
                        <div class="testimonial-block-two mb-md-30">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('/images/testimonial/'.@$testimonial->image)}}" alt=""></figure>
                                </div>
                                <div class="content-box">
                                    <div class="text">
                                        {{ucfirst($testimonial->description)}}
                                    </div>
                                    <div class="info-box">
                                        <h5 class="name">{{ucfirst($testimonial->name)}}</h5>
                                        <span class="designation">{{ucfirst($testimonial->position)}}</span>
                                        <span class="icon icon-quote-2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="service-block col-lg-12 col-md-12 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    {{ $testimonials->links('vendor.pagination.simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
@endsection
