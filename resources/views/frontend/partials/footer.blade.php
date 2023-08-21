<!-- footer start -->
<footer class="footer widget-footer clearfix">
    <div class="second-footer prt-bgimage-yes bg-footer prt-bg bg-base-dark">
        <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 widget-area">
                    <div class="widget">
                        <div class="widgte-text">
                            <div class="widget-title">
                                <h3>About us</h3>
                            </div>
                            <div class="text-justify">
                                {!! ucfirst(@$setting_data->website_description ?? '') !!}
                            </div>
                        </div>

                        <div class="widget_social">
                            <div class="social-icons social-hover">
                                <ul class="social-icons d-flex">
                                    @if(@$setting_data->facebook)
                                        <li><a class="prt-social-facebook" href="{{@$setting_data->facebook}}"><i class="fab fa-facebook"></i></a></li>
                                    @endif
                                    @if(@$setting_data->youtube)
                                        <li><a class="prt-social-instagram" href="{{@$setting_data->youtube}}"><i class="fab fa-youtube-play"></i></a></li>
                                    @endif
                                    @if(@$setting_data->instagram)
                                        <li><a class="prt-social-instagram" href="{{@$setting_data->instagram}}"><i class="fab fa-instagram"></i></a></li>
                                    @endif
                                    @if(@$setting_data->linkedin)
                                        <li><a class="prt-social-linkedin" href="{{@$setting_data->linkedin}}"><i class="fab fa-linkedin"></i></a></li>
                                    @endif
                                    @if(!empty(@$setting_data->ticktock))
                                        <li><a class="prt-social-tick" href="{{ @$setting_data->ticktock }}"><i class="fa-brands fa-tiktok"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 widget-area">
                    <div class="widget">
                        <div class="enhanced-text-widget en-1">
                            <div class="widget-title">
                                <h3></h3>
                            </div>
                            <div class="widget_nav_menu">
                                @if($footer_nav_data1!==null)
                                    <div class="widget-title">
                                        <h3>{{ $footer_nav_title1 ?? '' }}</h3>
                                    </div>
                                    <ul class="menu-footer-quick-links">
                                        @foreach(@$footer_nav_data1 as $nav)
                                            @if(empty(@$nav->children[0]))
                                                <li>
                                                    <a href="{{get_menu_url(@$nav->type, @$nav)}}" target="{{@$nav->target ? '_blank':''}}">
                                                        <i class="fa fa-plus"></i>{{ @$nav->name ?? @$nav->title ?? ''}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="">
                                <a class="prt-btn prt-btn-size-md prt-btn-color-white btn-inline mt-30" href="{{ route('contact') }}"> Get in touch! </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 widget-area">
                    <div class="widget">
                        <div class="enhanced-text-widget en-1">
                            <div class="widget-title">
                                <h3></h3>
                            </div>
                            <div class="widget_nav_menu">
                                @if($footer_nav_data2!==null)
                                    <div class="widget-title">
                                        <h3>{{ $footer_nav_title1 ?? '' }}</h3>
                                    </div>
                                    <ul class="menu-footer-quick-links">
                                        @foreach(@$footer_nav_data2 as $nav)
                                            @if(empty(@$nav->children[0]))
                                                <li>
                                                    <a href="{{get_menu_url(@$nav->type, @$nav)}}" target="{{@$nav->target ? '_blank':''}}">
                                                        <i class="fa fa-plus"></i>{{ @$nav->name ?? @$nav->title ?? ''}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 widget-area">
                    <div class="widget">
                        <div class="enhanced-text-widget">
                            <div class="widget-title">
                                <h3>Get In Touch</h3>
                            </div>
                            <div class="res-767-pb-18">
                                <p>{{@$setting_data->address ?? ''}}</p>
                                <p>Call: <strong><a href="tel:{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}">{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}</a></strong></p>
                                <p>Email: <strong><a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}</a></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer-text prt-bg copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-left">
                        <span class="cpy-text"> Copyright © 2023 <a href="/" class=" font-weight-500">  {{$setting_data->website_name ?? 'Hanabi'}} </a> by <a href="https://www.canosoft.com.np/" target="_blank">Canosoft Techonology</a> All Rights Reserved.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer><!-- footer end -->

<!-- back-to-top start -->
<a id="totop" href="#top">
    <i class="fa fa-angle-up"></i>
</a>
<!-- back-to-top end -->

</div><!-- page end -->

<!-- Javascript -->
<script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-migrate-3.3.2.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('assets/frontend/js/aos.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-validate.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-waypoints.js') }}"></script>
<script src="{{ asset('assets/frontend/js/numinate.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/imagesloaded.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-isotope.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.twentytwenty.js') }}"></script>
<script src="{{ asset('assets/frontend/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>
<script src="{{asset('assets/common/lazyload.js')}}"></script>

<!-- Revolution Slider -->
<script src='{{ asset('assets/frontend/revolution/js/revolution.tools.min.js') }}'></script>
<script src='{{ asset('assets/frontend/revolution/js/rs6.min.js') }}'></script>
<script src="{{ asset('assets/frontend/revolution/js/slider.js') }}"></script>
<!-- Javascript end-->
@yield('js')
@stack('scripts')
</body>
</html>
