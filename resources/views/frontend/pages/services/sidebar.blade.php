<div class="service-sidebar">
@if(count($latestServices)>0)
    <!--Start Services Details Sidebar Single-->
        <div class="sidebar-widget service-sidebar-single">
            <div class="service-sidebar wow fadeInUp"
                 data-wow-delay="0.1s" data-wow-duration="1200m">
                <div class="service-list">
                    <ul>
                        @foreach($latestServices as $index => $latest)
                            <li><a href="{{route('service.single',$latest->slug)}}">
                                    <i class="fas fa-angle-right"></i><span>{{ $latest->title ?? '' }}</span></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
@endif
</div>
