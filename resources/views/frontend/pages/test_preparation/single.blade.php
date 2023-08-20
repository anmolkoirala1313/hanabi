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

    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ $row->title }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Test Preparation</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="services-details">
        <div class="container">
            <div class="row">
                <!--Start Services Details Sidebar-->
                <div class="col-xl-4 col-lg-4">
                    @include('frontend.pages.test_preparation.sidebar')
                </div>
                <!--End Services Details Sidebar-->

                <!--Start Services Details Content-->
                <div class="col-xl-8 col-lg-8">
                    <div class="services-details__content">
                        <img src="{{ @$row->image ? asset('/images/test_preparation/'.@$row->image):''}}" alt="" />
                        <h2 class="mt-4">{{ $row->title }}</h2>
                        <div class="custom-description">
                           {!!  $row->description ?? '' !!}
                        </div>
                    </div>
                </div>
                <!--End Services Details Content-->
            </div>
        </div>
    </section>
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
