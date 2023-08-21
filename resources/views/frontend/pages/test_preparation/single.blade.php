@extends('frontend.layouts.seo_master')
@section('css')
    <style>

    .custom-editor .media{
        display: block;
    }

    .custom-editor{
        font-size: 1.1875rem;
    }
    .canosoft-listing ul,.canosoft-listing ol {
        padding: 0;
        margin-left: 15px;
    }
		.home-one a.active {
		color: #fc653c !important;
	}

    </style>
@endsection
@section('seo')
    <title>{{ucfirst(@$row->title)}} | {{ucwords(@$row->website_name ?? '')}}   </title>
    <meta name='description' itemprop='description'  content='{{ucfirst(@$row->meta_description)}}' />
    <meta name='keywords' content='{{ucfirst(@$row->meta_tags)}}' />
    <meta property='article:published_time' content='{{@$row->updated_at ?? @$row->created_at}}' />
    <meta property='article:section' content='article' />
    <meta property="og:description" content="{{ucfirst(@$row->meta_description)}}" />
    <meta property="og:title" content="{{ucfirst(@$row->meta_title)}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="Coperation" />
    <meta property="og:locale" content="en-us" />
    <meta property="og:locale:alternate"  content="en-us" />
    <meta property="og:site_name" content="{{ucwords(@$row->website_name ?? '')}} " />
    <meta property="og:image" content="{{asset('/images/test_preparation/'.@$row->banner_image)}}" />
    <meta property="og:image:url" content="{{asset('/images/test_preparation/'.@$row->banner_image)}}" />
    <meta property="og:image:size" content="300" />
@endsection

@section('content')

    <div class="prt-titlebar-wrapper prt-bg">
        <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
        <div class="prt-titlebar-wrapper-inner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="prt-page-title-row-heading">
                            <div class="page-title-heading">
                                <h2 class="title">{{ $row->title }}</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Test Preparation</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--site-main start-->
    <div class="site-main">

        <!--sidebar-->
        <div class="sidebar prt-sidebar-left prt-blog bg-base-grey clearfix">
            <div class="container">
                <!-- row -->
                <div class="row g-0">
                    <div class="col-lg-4 widget-area sidebar-left">
                        @include('frontend.pages.test_preparation.sidebar')
                    </div>
                    <div class="col-lg-8 content-area prt-blog-single">
                        <div class="prt-blog-single-content">
                            <div class="prt_single_image-wrapper">
                                <img class="img-fluid lazy" width="1200" height="720" data-src="{{ @$row->image ? asset('/images/test_preparation/'.@$row->image):''}}" alt="">
                            </div>
                            <div class="entry-content">
                                <div class="prt-box-desc-text">
                                    <h3 class="comment-reply-title">{{ $row->title }}</h3>
                                    <div class="pt-10 custom-description text-justify">
                                        {!!  $row->description ?? '' !!}
                                    </div>

                                    <div class="blog-tag-and-media-block">
                                        <div class="social-media-block">

                                        </div>
                                        <div class="prt-social-share-wrapper align-self-center res-575-mt-15">
                                            <ul class="social-icons square">
                                                <li class="social-facebook">
                                                    <a href="#" tabindex="0" rel="noopener" aria-label="facebook"><i onclick='fbShare("{{route('test-preparation.single',$row->slug)}}","{{ $row->title }}")' class="fab fa-facebook" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="social-twitter">
                                                    <a href="#" tabindex="0" rel="noopener" aria-label="twitter"><i onclick='twitShare("{{route('test-preparation.single',$row->slug)}}","{{ $row->title }}")' class="fab fa-twitter" aria-hidden="true"></i></a>
                                                </li>
                                                <li class="social-pinterest">
                                                    <a href="#" tabindex="0" rel="noopener" aria-label="pinterest"><i onclick='whatsappShare("{{route('test-preparation.single',$row->slug)}}","{{ $row->title }}")' class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!--sidebar end-->
    </div><!-- site-main end-->
@endsection
@section('js')
<script>
    function fbShare(url) {
      window.open("https://www.facebook.com/sharer/sharer.php?u=" + url, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=200, left=500, width=600, height=400");
    }
    function twitShare(url, title) {
        window.open("https://twitter.com/intent/tweet?text=" + encodeURIComponent(title) + "+" + url + "", "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=200, left=500, width=600, height=400");
    }
    function whatsappShare(url, title) {
        message = title + " " + url;
        window.open("https://api.whatsapp.com/send?text=" + message);
    }
    $( document ).ready(function() {
        let selector = $('.custom-description').find('table').length;
        if(selector>0){
            $('.custom-description').find('table').addClass('table table-bordered');
        }
    });
</script>
@endsection
