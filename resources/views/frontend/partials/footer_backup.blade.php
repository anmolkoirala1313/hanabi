<!--End Clients Section -->
<!-- Main Footer -->
<footer class="main-footer">
{{--    <div class="auto-container">--}}
{{--        <div class="upper-box">--}}
{{--            <div class="logo"><a href="index.html"><img src="images/logo-2.png" alt=""></a></div>--}}
{{--            <div class="subscribe-form">--}}
{{--                <h5 class="title">Subscribe to Newsletter</h5>--}}
{{--                <form method="post" action="#">--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="email" name="email" class="email" value="" placeholder="Email Address" required="">--}}
{{--                        <button type="button" class="theme-btn btn-style-one"><span class="btn-title">Subscribe</span></button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!--Widgets Section-->
    <div class="widgets-section">
        <div class="auto-container">
            <div class="row">
                <!--Footer Column-->
                <div class="footer-column col-xl-4 col-lg-4">
                    <div class="footer-widget about-widget">
                        <h5 class="widget-title">About us</h5>
                        <div class="text">
                            {!! ucfirst(@$setting_data->website_description ?? '') !!}
                        </div>
                    </div>
                </div>
                <!--Footer Column-->
                <div class="footer-column col-xl-8 col-lg-8 col-md-12 mb-0">
                    <div class="footer-widget links-widget">
                        <div class="row">
                            @if($footer_nav_data1!==null)
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <h5 class="widget-title">{{ $footer_nav_title1 ?? '' }}</h5>
                                    <ul class="user-links">
                                        @foreach(@$footer_nav_data1 as $nav)
                                            @if(empty(@$nav->children[0]))
                                                <li>
                                                    <a href="{{get_menu_url(@$nav->type, @$nav)}}" target="{{@$nav->target ? '_blank':''}}">
                                                        {{ @$nav->name ?? @$nav->title ?? ''}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($footer_nav_data2!==null)
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <h5 class="widget-title">Visa</h5>
                                    <ul class="user-links">
                                        @foreach(@$footer_nav_data2 as $nav)
                                            @if(empty(@$nav->children[0]))
                                                <li>
                                                    <a href="{{get_menu_url(@$nav->type, @$nav)}}" target="{{@$nav->target ? '_blank':''}}">
                                                        {{ @$nav->name ?? @$nav->title ?? ''}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <h5 class="widget-title">Contact Info</h5>
                                <ul class="contact-info">
                                    <li><i class="fa fa-address-book"></i> <a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->address ?? ''}}</a><br></li>
                                    <li><i class="fa fa-envelope"></i> <a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}</a><br></li>
                                    <li><i class="fa fa-phone-square"></i> <a href="tel:{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}">
                                            {{@$setting_data->phone ?? $setting_data->mobile ?? ''}}
                                        </a><br>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Footer Bottom-->
    <div class="footer-bottom">
        <div class="auto-container">
            <div class="inner-container">
                <div class="copyright-text">&copy; Copyright 2023 by <a href="/">© 2023 {{$setting_data->website_name ?? 'Unity Center'}}</a>
                    - by <a href="https://www.canosoft.com.np/" target="_blank">Canosoft Techonology</a> All Rights Reserved.
                </div>
                <ul class="social-icon-two">
                    @if(@$setting_data->facebook)
                        <li><a href="{{@$setting_data->facebook}}"><i class="fab fa-facebook"></i></a></li>
                    @endif
                    @if(@$setting_data->youtube)
                        <li><a href="{{@$setting_data->youtube}}"><i class="fab fa-youtube-square"></i></a></li>
                    @endif
                    @if(@$setting_data->instagram)
                       <li><a href="{{@$setting_data->instagram}}"><i class="fab fa-instagram"></i></a></li>
                   @endif
                    @if(@$setting_data->linkedin)
                        <li><a href="{{@$setting_data->linkedin}}"><i class="fab fa-linkedin"></i></a></li>
                    @endif
                    @if(!empty(@$setting_data->ticktock))
                        <li><a href="{{ @$setting_data->ticktock }}"><i class="fa-brands fa-tiktok"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--End Main Footer -->
</div><!-- End Page Wrapper -->
<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
<script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
<script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/frontend/js/wow.js') }}"></script>
<script src="{{ asset('assets/frontend/js/appear.js') }}"></script>
<script src="{{ asset('assets/frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.js') }}"></script>
<script src="{{ asset('assets/frontend/js/script.js') }}"></script>
<script src="{{asset('assets/common/lazyload.js')}}"></script>
@yield('js')
@stack('scripts')
</body>
</html>
