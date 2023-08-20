@extends('frontend.layouts.master')
@section('title') Album @endsection
@section('styles')
@endsection
@section('content')


    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Our Albums</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Albums</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="news-section-two">
        <div class="auto-container">
            <div class="row">
                @foreach($albums as $index=>$album)
                    <div class="news-block-two col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="{{$index+2}}00ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{route('album.gallery',$album->slug)}}">
                                        <img class="lazy" data-src="{{asset('/images/albums/'.@$album->cover_image)}}" alt="">
                                    </a>
                                </figure>
                            </div>
                            <div class="content-box">
                                <ul class="post-info">
                                    <li><i class="fa fa-image"></i> Images: ({{count(@$album->gallery)}}) </li>
                                </ul>
                                <h4 class="title">
                                    <a href="{{route('album.gallery',$album->slug)}}">
                                        {{ ucfirst($album->name) }}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection


