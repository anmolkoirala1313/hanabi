<div class="course-sidebar">
    <div class="latest-course mb-30">
        <h4 class="latest-course-title mb-30">Latest Courses</h4>
        @foreach(@$latestCourses as $latest)
            <div class="latest-course-item">
            <div class="latest-course-img">
                <img class="thumbnail lazy" data-src="{{ @$latest->image ? asset('/images/course/thumb/thumb_'.@$latest->image):''}}" alt="">
            </div>
            <div class="latest-course-content">
                <span class="latest-course-author"><i class="fas fa-calendar-alt"></i>
                    <span>{{date('d M Y', strtotime($latest->created_at))}}</span>
                </span>
                <h5><a href="{{ route('study-abroad.single',$latest->slug ) }}">{{ $latest->title ?? '' }}</a></h5>
            </div>
        </div>
        @endforeach
    </div>

    <div class="course-details-price">
        <p class="course-details-price-text">For more information</p>
        <p class="course-details-price-amount">Reach out</p>
        <a href="tel:{{$setting_data->phone ?? $setting_data->mobile ?? ''}}" class="theme-btn btn-style-one course-details-price-btn">
            <span class="btn-title">{{$setting_data->phone ?? $setting_data->mobile ?? ''}}</span>
        </a>
    </div>
</div>
