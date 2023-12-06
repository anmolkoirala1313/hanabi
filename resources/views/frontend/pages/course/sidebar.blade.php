<div class="prt-blog-sidebar-content">
    <aside class="widget widget-recent-post with-title">
        <h3 class="widget-title">Latest Course</h3>
        <ul class="widget-post prt-recent-post-list">
            @foreach($latestCourses as $index => $latest)
                <li>
                    <div class="post-img">
                        <img width="60" height="60" class="lazy" data-src="{{ @$latest->image ? asset('/images/course/thumb/thumb_'.@$latest->image):''}}"  alt="">
                    </div>
                    <div class="post-detail">
{{--                        <span class="post-date">{{date('d M Y', strtotime($latest->created_at))}}</span>--}}
                        <a href="{{ route('study-abroad.single',$latest->slug ) }}">
                            {{ $latest->title ?? '' }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
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
    <aside class="widget widget-search with-title">
        <h3 class="widget-title">Apply Now</h3>
        <form role="search" method="get" class="search-form row" action="{{route('contact.store')}}">
            <div class="col-md-6 mb-2">
                <input name="name" type="text" value="" placeholder="Full Name" required="required" />
            </div>
            <div class="col-md-6">
                <input name="phone" type="text" value="" placeholder="Phone" required="required" />
            </div>
            <div class="col-md-12 mb-2">
                <input name="subject" type="text" value="" placeholder="Subject" required="required" />
            </div>
            <div class="col-md-12">
                <textarea name="message" rows="2" placeholder="Message" required="required"></textarea>
            </div>
            <div class="mt-3">
                <button class="submit prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor"
                        type="submit" value="submit">Submit Here</button>
            </div>
        </form>
    </aside>
</div>

