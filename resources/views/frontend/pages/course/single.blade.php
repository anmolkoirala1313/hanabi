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
    <meta property="og:site_name" content="{{ucwords(@$setting_data->website_name ?? '')}} " />
    <meta property="og:image" content="{{asset('/images/course/'.@$row->image)}}" />
    <meta property="og:image:url" content="{{asset('/images/course/'.@$row->image)}}" />
    <meta property="og:image:size" content="300" />
@endsection

@section('content')

    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ $row->title }}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Course Detail</li>
                </ul>
            </div>
        </div>
    </section>
    <!--Start courses Details-->
    <section class="course-details">
        <div class="container">
            <div class="row flex-xl-row-reverse">
                <!--Start courses Details Content-->
                <div class="col-xl-8 col-lg-8">
                    <div class="courses-details__content">
                        <img src="{{ @$row->image ? asset('/images/course/'.@$row->image):''}}" alt="" />
                        <div class="sec-title text-center mb-20">
                            <h2 class="mt-4">{{ $row->title }}</h2>
                        </div>
                        <section class="product-description">
                            <div class="container pt-0 pb-90">
                                <div class="product-discription">
                                    <div class="tabs-box">
                                        <div class="tab-btn-box text-center">
                                            <ul class="tab-btns tab-buttons clearfix">

                                                @if($row->description)
                                                    <li class="tab-btn active-btn" data-tab="#tab-description">Description</li>
                                                @endif

                                                @if($row->courseDescription)
                                                    @foreach($row->courseDescription as $index=>$detail)
                                                            <li class="tab-btn {{ $detail->description ? '': ($loop->first ? 'active-btn':'') }}" data-tab="#tab-{{$index}}">{{ $detail->title }}</li>
                                                    @endforeach
                                                @endif


                                            </ul>
                                        </div>
                                        <div class="tabs-content">

                                            @if($row->description)
                                                <div class="tab active-tab" id="tab-description">
                                                    <div class="text">
                                                        <h3 class="product-description__title">Description</h3>
                                                        <div class="product-description__text1 custom-description">
                                                            {!! $row->description ?? '' !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($row->courseDescription)
                                                @foreach($row->courseDescription as $index=>$detail)
                                                    @include('frontend.pages.course.includes.course_description')
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>
                <!--End courses Details Content-->

                <!--Start courses Details Sidebar-->
                <div class="col-xl-4 col-lg-4">
                    @include('frontend.pages.course.sidebar')
                </div>
                <!--End courses Details Sidebar-->
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
