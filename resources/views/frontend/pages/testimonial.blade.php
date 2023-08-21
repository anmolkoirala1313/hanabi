@extends('frontend.layouts.master')
@section('title') Our Stories @endsection
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
                                <h2 class="title">Our stories</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Testimonials</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-main">

        <!-- team-section -->
        <section class="prt-row home02-team-section clearfix">
            <div class="container">
                <div class="row">
                    @foreach($testimonials as $testimonial)
                        <div class="col-lg-6 col-md-6 col-sm-6 d-flex align-items-stretch">
                            <div class="testimonials style2 bg-grey">
                                <div class="testimonial-wrapper">
                                    <div class="testimonial-info">
                                        <div class="testimonial-avatar">
                                            <div class="testimonial-img">
                                                <img class="img-fluid lazy" data-src="{{asset('/images/testimonial/'.@$testimonial->image)}}"  alt="" width="72" height="72">
                                            </div>
                                        </div>
                                        <div class="testimonial-caption">
                                            <h3>{{ucfirst($testimonial->name)}}</h3>
                                            <label>{{ucfirst($testimonial->position)}}</label>
                                        </div>
                                    </div>
                                    <div class="testimonial-content">
                                        <blockquote class="testimonial-text">
                                            {{ucfirst($testimonial->description)}}
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="pagination-block">
                        {{ $testimonials->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </section>
        <!-- team-section-end -->
    </div>
@endsection
@section('js')
@endsection
