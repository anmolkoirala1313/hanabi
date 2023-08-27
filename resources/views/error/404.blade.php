@extends('frontend.layouts.master')
@section('title')  Page Not Found @endsection
@section('content')

    <div class="site-main">

        <!--error-404-->
        <section class="error-404">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 res-991-mt-30 order-last order-lg-first">
                        <div class="text-center text-lg-start">
                            <div class="page-content">
                                <h2>Error</h2>
                                <h3><span>Opps!</span> Somethings gone missing</h3>
                                <p>Sorry, This page may has been moved,deleted or maybe you just mis-typed the URL.</p>
                            </div>
                            <div class="">
                                <a class="prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor" href="/">Go To Home Pages</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="prt-404-img text-center text-lg-start">
                            <img width="701" height="258" class="img-fluid" src="{{asset('assets/frontend/images/error.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--error-404 end-->

    </div>
@endsection
