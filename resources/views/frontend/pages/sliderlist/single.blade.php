@extends('frontend.layouts.master')
@section('title')  {{ucwords(@$singleSlider->list_header)}} @endsection
@section('css')
@endsection


@section('content')

    <div class="rs-breadcrumbs img4">
        <div class="container">
            <div class="breadcrumbs-inner">
                <h1 class="page-title">{{ucwords(@$singleSlider->list_header)}}</h1>
            </div>
        </div>
    </div>

    <div class="rs-inner-blog pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-4 col-md-12 order-last">
                    @include('frontend.pages.sliderlist.sidebar')
                </div>
                <div class="col-lg-8 pr-35 md-pr-15 md-mt-50">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="blog-details">
                                <div class="bs-img mb-35">
                                    <img class="lazy" data-src="{{ asset('/images/section_elements/list_1/'.$singleSlider->list_image) }}" alt="">
                                </div>
                                <div class="blog-full">
                                    <ul class="single-post-meta">
                                        <li>
                                            <span class="p-date"><i class="fa fa-calendar-check-o"></i>
                                                {{date('j M, Y',strtotime(@$singleSlider->created_at))}}
                                            </span>
                                        </li>
                                    </ul>
                                    <h3>{{ ucwords(@$singleSlider->list_header ) }}</h3>
                                    <div class="custom-description">
                                        {!! @$singleSlider->list_description !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
