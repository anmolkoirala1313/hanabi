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

    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Our Team</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Teams</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="auto-container">
            <div class="row">
                @foreach($teams as $team)
                    <div class="team-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image"><a href="page-team-details.html">
                                    <img src="{{$team->image ? asset('/images/teams/'.$team->image ):''}}" alt=""></a></figure>
                            @if(!empty(@$team->fb) || !empty(@$team->twitter) || !empty(@$team->linkedin) || !empty(@$team->insta))
                                <span class="share-icon fa fa-share-alt"></span>
                                <div class="social-links">
                                    @if(!empty(@$team->fb))
                                        <a href="{{ $team->fb }}"><i class="fab fa-facebook-f"></i></a>
                                    @endif
                                    @if(!empty(@$team->twitter))
                                        <a href="{{ $team->twitter }}"><i class="fab fa-twitter"></i></a>
                                    @endif
                                    @if(!empty(@$team->linkedin))
                                        <a href="{{ $team->linkedin }}"><i class="fab fa-linkedin"></i></a>
                                    @endif
                                    @if(!empty(@$team->insta))
                                        <a href="{{ $team->insta }}"><i class="fab fa-instagram"></i></a>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="info-box">
                            <h4 class="name"><a>{{ucfirst(@$team->name)}}</a></h4>
                            <span class="designation">{{ucfirst(@$team->post)}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
@endsection
