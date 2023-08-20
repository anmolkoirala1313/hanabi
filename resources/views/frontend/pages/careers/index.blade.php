@extends('frontend.layouts.master')
@section('title') Career @endsection
@section('content')
            <!-- Breadcrumbs Start -->
            <div class="rs-breadcrumbs img10">
                <div class="container">
                    <div class="breadcrumbs-inner">
                        <h1 class="page-title">Career</h1>
                    </div>
                </div>
            </div>

            <div class="rs-process style2 gray-bg2 pt-100 pb-100 md-pt-70 md-pb-70">
                <div class="container custom">
                    <div class="row y-middle mb-50">
                        <div class="col-lg-5">
                            <div class="sec-title md-mb-30">
                                <h2 class="title">
                                    Job opportunities
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if(count($careers) > 0)
                            @foreach($careers as $index=>$career)
                                <div class="col-lg-4 col-md-6 mb-30">
                                    <div class="rs-addon-number">
                                        <div class="number-part">
                                            <div class="number-area"> <span class="number-prefix"> {{ $index + 1 }} </span></div>
                                            <div class="number-title">
                                                <h3 class="title">{{ucwords(@$career->name)}}</h3>
                                            </div>
                                            <div class="number-txt">
                                                <div class="loac-text">
                                                    <strong>Position:</strong>
                                                    @if(@$career->type=="part_time")
                                                        Part Time
                                                    @else
                                                        Full Time
                                                    @endif
                                                </div>
                                                @if(@$career->end_date)
                                                    <div class="loac-text">
                                                        <strong>Apply until:</strong> {{date('M j, Y',strtotime(@$career->end_date))}}
                                                    </div>
                                                @else
                                                    <div class="loac-text">
                                                        <strong>Apply until:</strong> {{date('M j, Y', strtotime('+3 days', strtotime(date("Y-m-d"))))}}
                                                    </div>
                                                @endif
                                                @if(@$career->salary)
                                                    <div class="loac-text">
                                                        <strong>Salary:</strong> {{$career->salary}}
                                                    </div>
                                                @endif

                                            </div>

                                            <div class="btn-part">
                                                @if($career->from_link)
                                                    <a class="readon apply" href="{{$career->from_link}}">Apply Now</a>
                                                @else
                                                    <a class="readon apply" href="{{ route('contact') }}">Contact us</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <div class="col-lg-12">
                                    <div class="pagination-area">
                                        {{ $careers->links('vendor.pagination.default') }}
                                    </div>
                                </div>
                        @endif
                    </div>
                </div>
            </div>
@endsection
