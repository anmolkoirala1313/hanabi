<div class="service-sidebar">
    @if(count($latestTests)>0)
        <!--Start Services Details Sidebar Single-->
        <div class="sidebar-widget service-sidebar-single">
            <div class="service-sidebar wow fadeInUp"
                 data-wow-delay="0.1s" data-wow-duration="1200m">
                <div class="service-list">
                    <ul>
                        @foreach($latestTests as $latest)
                            <li><a href="{{ route('test-preparation.single',$latest->slug) }}">
                                    <i class="fas fa-angle-right"></i><span>{{ $latest->title ?? '' }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!--End Services Details Sidebar Single-->
    <div class="sidebar-widget banner-widget">


        <div class="widget-content" style="background-image: url({{asset('assets/frontend/images/resource/contact.jpg')}});">
            <div class="shape" style="background-image: url({{asset('assets/frontend/images/resource/overlay-shape.png')}});"></div>
            <div class="content-box">
                <div class="icon-box">
                    <i class="lnr lnr-icon-pie-chart"></i>
                </div>
                <h3>Need information about a particular test?</h3>
                <a href="{{ route('contact') }}" class="theme-btn btn-style-one light"><span class="btn-title"> Contact us</span></a>
            </div>
        </div>
    </div>

    <!--Start Services Details Sidebar Single-->
    <div class="sidebar-widget service-sidebar-single mt-5">
        <div class="service-sidebar-single-btn wow fadeInUp"
             data-wow-delay="0.5s" data-wow-duration="1200m">
            <a href="tel:{{$setting_data->phone ?? $setting_data->mobile ?? ''}}" class="theme-btn btn-style-one d-grid"><span class="btn-title">

                    {{$setting_data->phone ?? $setting_data->mobile ?? ''}}</span></a>
        </div>
    </div>
    <!--End Services Details Sidebar Single-->
</div>
