<div class="prt-blog-sidebar-content">
    @if(count($slider_lists)>0)
        <aside class="widget widget-categories with-title">
            <h3 class="widget-title">Latest</h3>
            <ul>
                @foreach($slider_lists as $index => $latest)
                    <li><a href="{{url('/slider-list/'.$latest->subheading)}}">{{ucwords(@$latest->list_header)}}</a></li>
                @endforeach

            </ul>
        </aside>
    @endif

    <aside class="widget widget-banner">
        <div class="prt_single_image-wrapper">
            <img width="1024" height="686" class="img-fluid" src="{{asset('assets/frontend/images/single-img-11.png')}}" alt="">
        </div>
    </aside>
    <aside class="widget widget-contact-info with-title">
        <h3 class="widget-title">Contact-info</h3>
        <div class="widget-contact">
            <div class="featured-icon-box featured-icon-box-widget">
                <div class="featured-icon">
                    <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-sm">
                        <i class="flaticon-location"></i>
                    </div>
                </div>
                <div class="featured-content">
                    <div class="featured-title">
                        <h3>Address :</h3>
                    </div>
                    <div class="featured-desc">
                        <p>{{@$setting_data->address ?? ''}}</p>
                    </div>
                </div>
            </div>
            <div class="featured-icon-box featured-icon-box-widget">
                <div class="featured-icon">
                    <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-sm">
                        <i class="flaticon-call"></i>
                    </div>
                </div>
                <div class="featured-content">
                    <div class="featured-title">
                        <h3>Call Us :</h3>
                    </div>
                    <div class="featured-desc">
                        <p><a href="tel:{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}">{{@$setting_data->phone ?? $setting_data->mobile ?? ''}}</a></p>
                    </div>
                </div>
            </div>
            <div class="featured-icon-box featured-icon-box-widget">
                <div class="featured-icon">
                    <div class="prt-icon prt-icon_element-onlytxt prt-icon_element-size-sm">
                        <i class="flaticon-email"></i>
                    </div>
                </div>
                <div class="featured-content">
                    <div class="featured-title">
                        <h3>Email :</h3>
                    </div>
                    <div class="featured-desc">
                        <p><a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>


