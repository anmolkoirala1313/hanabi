<div class="prt-blog-sidebar-content">
    <aside class="widget widget-search with-title">
        <h3 class="widget-title">Search</h3>
        <form role="search" method="get" class="search-form" action="{{route('searchBlog')}}">
            <label>
                <span class="screen-reader-text">Search for:</span>
                <input type="search" class="input-text" placeholder="Search …" value="" name="s"   oninvalid="this.setCustomValidity('Type a keyword')" oninput="this.setCustomValidity('')" required>
            </label>
            <button class="btn prt-btn prt-btn-size-md prt-btn-shape-square prt-btn-style-fill prt-btn-color-skin" type="submit"></button>
        </form>
    </aside>
    <aside class="widget widget-categories with-title">
        <h3 class="widget-title">Categories</h3>
        <ul>
            @foreach(@$bcategories as $bcategory)
                <li><a href="{{route('blog.category',$bcategory->slug)}}">{{ucwords(@$bcategory->name)}} ({{$bcategory->blogs->count()}})</a></li>
            @endforeach
        </ul>
    </aside>
    <aside class="widget widget-recent-post with-title">
        <h3 class="widget-title">Latest Posts</h3>
        <ul class="widget-post prt-recent-post-list">
            @foreach($latestPosts as $index => $latest)
                <li>
                    <div class="post-img">
                        <img width="80" height="80" class="lazy" data-src="{{(@$latest->image) ? asset('/images/blog/thumb/thumb_'.@$latest->image):''}}"  alt="">
                    </div>
                    <div class="post-detail">
                        <span class="post-date">{{date('d M Y', strtotime($latest->created_at))}}</span>
                        <a href="{{route('blog.category',$bcategory->slug)}}">
                            {{ucwords(@$latest->title)}}
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </aside>
</div>
