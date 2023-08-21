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

    <div class="prt-titlebar-wrapper prt-bg">
        <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
        <div class="prt-titlebar-wrapper-inner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="prt-page-title-row-heading">
                            <div class="page-title-heading">
                                <h2 class="title">{{ucwords(@$singleAlbum->name)}}'s Gallery</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Album Gallery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="site-main">

        <!--services-section-->
        <section class="prt-row service01-services-section clearfix" style="    padding: 70px 0 70px;">
            <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
            <div class="container">
                <div class="row">
                    @if(count(@$singleAlbum->gallery) > 0)
                        @foreach($singleAlbum->gallery as $index=>$gallery)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <!-- featured-imagebox -->
                                <div class="featured-imagebox featured-imagebox-portfolio style1">
                                    <div class="card" style="border: none">
                                        <div class="card-image gallery-item">
                                            <a href="{{asset('/images/albums/gallery/'.@$gallery->filename)}}" data-fancybox="gallery">
                                                <img src="{{asset('/images/albums/gallery/'.@$gallery->filename)}}" class="img-wrapper" alt="Image Gallery">
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- featured-imagebox end-->
                            </div>

                        @endforeach
                     @endif
                </div>
            </div>
        </section>
        <!--services-section end-->
    </div>




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
