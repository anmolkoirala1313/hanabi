<div class="widget-area">
    <div class="search-widget mb-50">
        <div class="search-wrap">
            <form method="get" id="searchform" action="{{route('searchJob')}}">
                <input type="search" id="s"
                       name="s" placeholder="Search Jobs.."  class="search-input"
                       oninvalid="this.setCustomValidity('Type a keyword')" oninput="this.setCustomValidity('')" required>
                <button type="submit" value="Search"><i class="flaticon-search"></i></button>
            </form>
        </div>
    </div>

    <div class="recent-posts">
        <div class="widget-title">
            <h3 class="title">Latest Jobs</h3>
        </div>
        @foreach($latestJobs as $index => $latest)
            <div class="recent-post-widget {{ $loop->first ? 'no-border':'' }}">
                <div class="post-img">
                    <a href="{{route('job.single',@$latest->slug)}}">
                        <img class="lazy"  data-src="{{(@$latest->image) ? asset('/images/job/thumb/thumb_'.@$latest->image):  asset('assets/frontend/images/career.png') }}"
                             alt=""></a>
                </div>
                <div class="post-desc">
                    <a href="{{route('job.single',@$latest->slug)}}">
                        {{ucwords(@$latest->name)}} </a>
                    <span class="date-post"> <i class="fa fa-calendar"></i>
                         @if(@$latest->end_date >= $today)
                            Expires on - {{date('M j, Y',strtotime(@$latest->end_date))}}
                        @else
                            Expired
                        @endif
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>
