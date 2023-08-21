@extends('frontend.layouts.master')
@section('title') Our Team @endsection
@section('css')
    <style>
        .team-member:after{
            height: 340px;
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
                                <h2 class="title">Our Team</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Teams</span>
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
                    @foreach($teams as $team)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                        <!-- featured-imagebox-team -->
                        <div class="featured-imagebox featured-imagebox-team style1">
                            <div class="featured-imagebox-inner">
                                <div class="featured-thumbnail">
                                    <img width="500" height="500" class="img-fluid" src="{{$team->image ? asset('/images/teams/'.$team->image ):''}}" alt="image">
                                </div>
                                <div class="featured-content">
                                    <div class="featured-title">
                                        <h3><a>{{ucfirst(@$team->name)}}</a></h3>
                                        <span class="team-position">{{ucfirst(@$team->post)}}</span>
                                    </div>
                                    @if(!empty(@$team->fb) || !empty(@$team->twitter) || !empty(@$team->linkedin) || !empty(@$team->insta))
                                        <div class="prt-media-link">
                                            <div class="media-block">
                                                <div class="media-btn">
                                                    <i class="icon-share"></i>
                                                </div>
                                                <ul class="social-icons list-inline d-flex">
                                                    @if(!empty(@$team->fb))
                                                        <li class="social-facebook"><a href="{{ $team->fb }}"><i class="icon-facebook"></i></a></li>
                                                    @endif
                                                    @if(!empty(@$team->twitter))
                                                        <li class="social-twitter"><a href="{{ $team->twitter }}"><i class="icon-twitter"></i></a></li>
                                                    @endif
                                                    @if(!empty(@$team->linkedin))
                                                        <li class="social-linkedin"><a href="{{ $team->linkedin }}"><i class="icon-linkedin"></i></a></li>
                                                    @endif
                                                    @if(!empty(@$team->insta))
                                                        <li class="social-instagram"><a href="{{ $team->insta }}"><i class="icon-instagram"></i></a></li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div><!-- featured-imagebox-team end-->
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- team-section-end -->
    </div>

@endsection
@section('js')
@endsection
