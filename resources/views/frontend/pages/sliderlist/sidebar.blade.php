<div class="widget-area">
    <div class="recent-posts">
        <div class="widget-title">
            <h3 class="title">Recent List</h3>
        </div>
        @foreach($slider_lists as $index => $latest)
            <div class="recent-post-widget {{ $loop->first ? 'no-border':'' }}">
                <div class="post-img">
                    <a href="{{url('/slider-list/'.$latest->subheading)}}">
                        <img class="lazy"
                             data-src="{{ asset('/images/section_elements/list_1/thumb/thumb_'.$latest->list_image) }}" alt=""></a>
                </div>
                <div class="post-desc">
                    <a href="{{url('/slider-list/'.$latest->subheading)}}">
                        {{ucwords(@$latest->list_header)}} </a>
                    <span class="date-post"> <i class="fa fa-calendar"></i>{{date('j M, Y',strtotime(@$latest->created_at))}} </span>
                </div>
            </div>
        @endforeach
    </div>
</div>

