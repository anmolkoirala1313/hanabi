@extends('frontend.layouts.master')
@section('title') Video Gallery @endsection
@section('styles')
@endsection
@section('content')

    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs img10">
        <div class="container">
            <div class="breadcrumbs-inner">
                <h1 class="page-title">Our Video Gallery</h1>
            </div>
        </div>
    </div>

    <!-- Project Section Start -->
    <div class="rs-project style3 pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row">
                @foreach($videoGalleries as $video)
                    <div class="col-lg-4 mt-3">
                        <div class="rs-videos choose-video">
                            <div class="images-video">
                                <img src="{{ getYoutubeThumbnail(@$video->url) }}" alt="images">
                            </div>
                            <div class="animate-border">
                                <a class="popup-border" href="{{@$video->url}}">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col-lg-12 pt-60 text-center">
                        <div class="pagination-area">
                            {{ $videoGalleries->links('vendor.pagination.default') }}
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- Project Section End -->
    </div>
@endsection


