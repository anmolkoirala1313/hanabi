@extends('frontend.layouts.seo_master')
@section('title') Job List @endsection
@section('css')
@endsection
@section('seo')
    <title>{{ucfirst(@$singleJob->name)}} | {{ucwords(@$setting_data->website_name ?? 'Careerlink')}}</title>
    <meta name='description' itemprop='description'  content='{{ucfirst(@$singleJob->meta_description)}}' />
    <meta name='keywords' content='{{ucfirst(@$singleJob->meta_tags)}}' />
    <meta property='article:published_time' content='{{@$singleJob->updated_at ?? @$singleJob->created_at}}' />
    <meta property='article:section' content='article' />
    <meta property="og:description" content="{{ucfirst(@$singleJob->meta_description)}}" />
    <meta property="og:title" content="{{ucfirst(@$singleJob->meta_title)}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="Coperation" />
    <meta property="og:locale" content="en-us" />
    <meta property="og:locale:alternate"  content="en-us" />
    <meta property="og:site_name" content="{{ucwords(@$setting_data->website_name ?? 'Careerlink')}}" />
    <meta property="og:image" content="{{asset('/images/job/'.@$singleJob->image)}}" />
    <meta property="og:image:url" content="{{asset('/images/job/'.@$singleJob->image)}}" />
    <meta property="og:image:size" content="300" />
@endsection
@section('content')

    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs img6">
        <div class="container">
            <div class="breadcrumbs-inner">
                <h1 class="page-title">Job Details</h1>
            </div>
        </div>
    </div>
    <!-- Breadcrumbs End -->
    <div class="rs-slider style4 pt-30 pb-30">
        <div class="container">
            <div class="slider-img">
                <img class="lazy" data-src="{{ ($singleJob->image !== null) ? asset('/images/job/'.@$singleJob->image): asset('assets/frontend/images/career.png')}}" alt="">
            </div>
        </div>
    </div>
    <div class="rs-project pb-110 md-pt-70 md-pb-7">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 pr-60 md-pr-15">
                    <div class="sec-title mb-64">
                        <h2 class="title title4 pb-30">
                            {{ ucwords(@$singleJob->name) }}
                        </h2>
                        <div class="margin-0 custom-description">{!! $singleJob->description !!}</div>
                        <div class="rs-counter style1 project-single bg23">
                            <div class="container">
                                <div class="row">
                                    <h3 class="title title4" style="padding-bottom: 0px!important;font-size: 20px; margin-bottom: 4px;">
                                        Share
                                    </h3>
                                    <div class="col-lg-12">
                                        <ul class="footer-social md-mb-30">
                                            <li>
                                                <a href="#"><i class="fab fa-facebook" onclick='fbShare("{{route('job.single',$singleJob->slug)}}")'></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fab fa-twitter" onclick='twitShare("{{route('job.single',$singleJob->slug)}}","{{ $singleJob->title }}")'></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fab fa-whatsapp" onclick='whatsappShare("{{route('job.single',$singleJob->slug)}}","{{ $singleJob->title }}")'></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="project-information bg24">
                        <div class="sec-title">
                            <h2 class="title title4 pb-30">
                                {{ ucfirst(@$singleJob->title ?? 'General Details')}}
                            </h2>
                            <div class="title-inner mb-25">
                                <h4 class="title-small">Expires on</h4>
                                <p class="margin-0">{{date('M j, Y',strtotime(@$singleJob->end_date))}}</p>
                            </div>
                            @if(@$singleJob->getJobCategories(@$singleJob->category_ids) !== 'N/A')
                                <div class="title-inner mb-25">
                                    <h4 class="title-small">Company</h4>
                                    <p class="margin-0">{{ucwords(@$singleJob->getJobCategories($singleJob->category_ids))}}</p>
                                </div>
                            @endif
                            @if($singleJob->extra_company)
                                <div class="title-inner mb-25">
                                    <h4 class="title-small">Completed</h4>
                                    <p class="margin-0">{{ $singleJob->extra_company ?? '' }}</p>
                                </div>
                            @endif
                            @if($singleJob->min_qualification)
                                <div class="title-inner mb-25">
                                    <h4 class="title-small">Min. Qualification</h4>
                                    <p class="margin-0">{{ucwords(@$singleJob->min_qualification)}}</p>
                                </div>
                            @endif
                            @if($singleJob->salary)
                                <div class="title-inner">
                                    <h4 class="title-small">Salary</h4>
                                    <p class="margin-0">{{ucwords(@$singleJob->salary)}}</p>
                                </div>
                            @endif
                            @if($singleJob->required_number)
                                <div class="title-inner">
                                    <h4 class="title-small">Required number</h4>
                                    <p class="margin-0">{{ucwords(@$singleJob->required_number)}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
