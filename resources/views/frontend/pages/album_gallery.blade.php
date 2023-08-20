@extends('frontend.layouts.master')
@section('title') {{ucwords(@$singleAlbum->name)}} | Album @endsection
@section('css')
    <style>
        .card-image img {
            width: 370px; /* Set your preferred maximum width */
            height: 345px; /* Set your preferred maximum height */
          object-fit: cover;
        }

        /*.card-image a:hover:after, .gallery-item a:hover:before {*/
        /*    -webkit-transform: scale(1);*/
        /*    transform: scale(1);*/
        /*    opacity: 1;*/
        /*    visibility: visible;*/
        /*}*/
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

@endsection
@section('content')

    <section class="page-title" style="background-image: url({{ asset('assets/frontend/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{ucwords(@$singleAlbum->name)}}'s Gallery</h1>
                <ul class="page-breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>Album Gallery</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <div class="auto-container">
            <div class="row">
            @if(count(@$singleAlbum->gallery) > 0)
                @foreach($singleAlbum->gallery as $index=>$gallery)
                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3 wow fadeInUp">
                        <div class="card" style="border: none">
                            <div class="card-image gallery-item">
                                <a href="{{asset('/images/albums/gallery/'.@$gallery->filename)}}" data-fancybox="gallery">
                                    <img src="{{asset('/images/albums/gallery/'.@$gallery->filename)}}" class="img-wrapper" alt="Image Gallery">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
             @endif
            </div>
        </div>
    </section>




@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>// Fancybox Config
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "slideShow",
                "zoom",
                "close"
            ],
            loop: true,
            protect: true
        });
    </script>
@endsection
