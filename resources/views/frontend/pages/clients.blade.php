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
            color: var(--base-white);
            background-color: var(--base-skin);
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


    <div class="prt-titlebar-wrapper prt-bg">
        <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
        <div class="prt-titlebar-wrapper-inner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="prt-page-title-row-heading">
                            <div class="page-title-heading">
                                <h2 class="title">Our Clients</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Our Clients</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-main">

        <!--services-section-->
        <section class="prt-row service01-services-section clearfix" style="padding: 90px 0 90px;">
            <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
            <div class="container">
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
                                        <a href="#"><img class="img-fluid" src="{{asset('/images/clients/'.@$client->image)}}" alt=""></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

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
