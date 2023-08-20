@extends('frontend.layouts.master')
@section('title') Clients @endsection
@section('css')
    <style>
        .tile {
            display: none;
        }
        .btn-filter {
            position: relative;
            display: inline-block;
            font-size: 14px;
            text-transform: uppercase;
            color: #1e2434;
            text-align: center;
            padding: 14px 30px;
            background-color: #fff;
            border: 1px solid #e1e8e4;
            cursor: pointer;
            margin: 0px 8.5px;
            margin-bottom: 15px;
            -webkit-transition: all 500ms ease;
            transition: all 500ms ease;
        }

        .btn-filter.active{
            color: var(--text-color-bg-theme-color1);
            background-color: var(--theme-color1);
        }
        .scale-anm img{
            -webkit-transition: all 300ms ease;
            transition: all 300ms ease;
            -webkit-box-shadow: 0 10px 60px rgba(0, 0, 0, 0.07);
            box-shadow: 0 10px 60px rgba(0, 0, 0, 0.07);
            padding: 15px;
        }
    </style>
{{--    <link rel="stylesheet" href="{{asset('assets/frontend/css/plugins/lightbox.css')}}">--}}
@endsection
@section('content')


    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Our Clients</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Our Clients</li>
                </ul>
            </div>
        </div>
    </section>

    <!--Start courses Details-->
    <section class="course-details">
        <div class="container">
            <div class="row flex-xl-row-reverse">
                <!--Start courses Details Content-->
                <div class="col-xl-12 col-lg-12">
                    <div class="courses-details__content">
                        <section class="product-description">
                            <div class="container pt-0 pb-90">
                                <div class="product-discription">
                                    <div class="tabs-box">
                                        <div id="filters" class="toolbar mb2 mt2">
                                            <button class="btn-filter fil-cat filter active"  data-filter="all">All</button>
                                            @foreach($country as $index=>$cn)
                                                <button class="btn-filter fil-cat filter" data-rel="{{$index}}" data-filter=".{{$index}}">{{ ucfirst($cn) }}</button>
                                            @endforeach
                                        </div>
                                        <div id="portfolio"  class="row">
                                            @foreach($clients as $client)
                                                <div class="mt-4 col-lg-3 col-md-3 tile scale-anm {{$client->country}}">
                                                        <a href="#"><img src="{{asset('/images/clients/'.@$client->image)}}" alt=""></a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
    <script>
        $('#portfolio').mixItUp({

            selectors: {
                target: '.tile',
                filter: '.filter',
                sort: '.sort-btn'
            },

            animation: {
                animateResizeContainer: false,
                effects: 'fade scale'
            }

        });
    </script>
@endsection
