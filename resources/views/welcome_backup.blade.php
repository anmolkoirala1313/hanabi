@extends('frontend.layouts.master')
@section('title') Home @endsection
@section('css')

@endsection
@section('content')
    @if(count($sliders) > 0)
        <section class="banner-section-two">
            <div class="banner-carousel owl-carousel owl-theme">
                @foreach(@$sliders as $index=>$slider)
                    <div class="slide-item">
                    <div class="bg-image" style="background-image: url({{ asset('/images/sliders/'.$slider->image) }});"></div>
                    <div class="auto-container">
                        <div class="content-box">
                            <?php $split = explode(" ", @$slider->heading);?>
                            <span class="text-last"></span>
                            <span class="sub-title animate-1">{{preg_replace('/\W\w+\s*(\W*)$/', '$1', @$slider->heading)."\n"}}</span>
                            <div class="inner">
                                <h1 class="title animate-2">{{$split[count($split)-1]}}</h1>
                                <h3 class="animate-3">{{@$slider->subheading ?? ''}}</h3>
                                @if(@$slider->link)
                                    <div class="btn-box animate-4">
                                        <a href="{{@$slider->link ?? ''}}" class="theme-btn btn-style-one"><span class="btn-title">{{@$slider->button ?? 'Start Exploring'}}</span></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="features-section-three">
        <div class="row g-0">
            <!-- Feature Block Three -->
            <div class="feature-block-three col-xl-4 col-lg-6 col-md-12 wow fadeInUp">
                <div class="inner-box ">
                    <div class="content-box">
                        <i class="far fa-flag"></i>
                        <h4 class="title"><a>Our Mission</a></h4>
                        <span class="sub-title"> {{ ucfirst(@$homepage_info->mission) }}</span>
                    </div>
                </div>
            </div>
            <!-- Feature Block Three -->
            <div class="feature-block-three col-xl-4 col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="400ms">
                <div class="inner-box ">
                    <div class="content-box">
                        <i class="icon flaticon-group"></i>
                        <h4 class="title"><a>Our Vision</a></h4>
                        <span class="sub-title">{{ ucfirst(@$homepage_info->vision) }}</span>
                    </div>
                </div>
            </div>
            <!-- Feature Block Three -->
            <div class="feature-block-three col-xl-4 col-lg-6 col-md-12 wow fadeInUp" data-wow-delay="800ms">
                <div class="inner-box ">
                    <div class="content-box">
                        <i class="icon flaticon-life-insurance"></i>
                        <h4 class="title"><a>Our Value</a></h4>
                        <span class="sub-title">{{ ucfirst(@$homepage_info->value) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(!empty($homepage_info->welcome_description))
        <section class="about-section-three">
            <div class="anim-icons">
                <span class="icon icon-object-1"></span>
                <span class="icon icon-object-4"></span>
            </div>
            <div class="auto-container">
                <div class="row">
                    <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12 order-2 wow fadeInRight" data-wow-delay="600ms">
                        <div class="inner-column">
                            <div class="sec-title">
                                <span class="sub-title">{{$homepage_info->welcome_subheading ?? ''}}</span>
                                <h2>{{  @$homepage_info->welcome_heading }}</h2>
                                <div class="text">
                                    {{ ucfirst(@$homepage_info->welcome_description) }}
                                </div>
                            </div>
                            @if(@$homepage_info->welcome_link)
                                <div class="content-box">
                                    <a href="{{@$homepage_info->welcome_link}}" class="theme-btn btn-style-one"><span class="btn-title">{{ @$homepage_info->welcome_button }}</span></a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                        <div class="inner-column wow fadeInLeft">
                            <span class="icon-dots bounce-y"></span>
                            <figure class="image-1 overlay-anim wow fadeInUp"><img class="lazy" data-src="{{ @$homepage_info->welcome_image ? asset('/images/home/welcome/'.@$homepage_info->welcome_image):''}}" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($latestServices) > 0)
        <section class="training-section">
            <div class="bg-layer"></div>
            <div class="auto-container">
                <div class="sec-title text-center">
                    <span class="sub-title">What we offer</span>
                    <h2>The services we provide<br>for you.</h2>
                </div>

                <div class="carousel-outer">
                    <div class="training-carousel owl-carousel owl-theme">
                        @foreach(@$latestServices as $index=>$service)
                            <div class="training-block">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{route('service.single',$service->slug)}}">
                                                <img class="lazy" data-src="{{asset('/images/service/thumb/thumb_'.@$service->banner_image)}}" alt="">
                                            </a>
                                        </figure>
                                        <div class="info-box">
                                            <h5 class="title"><a href="{{route('service.single',$service->slug)}}"> {{ucwords(@$service->title)}}</a></h5>
                                            <a href="{{route('service.single',$service->slug)}}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="overlay-content">
                                        <div class="info-box">
                                            <h5 class="title"><a href="{{route('service.single',$service->slug)}}"> {{ucwords(@$service->title)}}</a></h5>
                                            <div class="text">{{ elipsis( strip_tags($service->description) )}}</div>
                                            <a href="{{route('service.single',$service->slug)}}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="call-to-action-two pull-up" style="background-image: url( {{ asset('assets/frontend/images/cta/01.jpeg') }})">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="title-box">
                        <h2 class="title">We provide counselling students <br>to get study visa</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="video-box">
                        <div class="inner">
                            <a href="{{ route('contact') }}" class="theme-btn btn-style-one light"><span class="btn-title">Contact us</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($latestcourses) > 0)
        <section class="services-section">
            <div class="anim-icons">
                <span class="icon icon-object-2"></span>
                <span class="icon icon-object-3"></span>
            </div>
            <div class="auto-container">
                <div class="sec-title">
                    <div class="row">
                        <div class="col-lg-7">
                            <span class="sub-title">Start your journey</span>
                            <h2>Study Abroad with <br>our programme.</h2>
                        </div>
                        <div class="col-lg-5">
                            <div class="text">Enrolling in Study Abroad Programs offers you the chance to embrace the world as your educational playground.</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach(@$latestcourses as $index=>$latest)
                        <div class="service-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a href="{{ route('study-abroad.single', $latest->slug) }}">
                                            <img class="lazy" data-src="{{ @$latest->image ? asset('/images/course/thumb/thumb_'.@$latest->image):''}}" alt=""></a>
                                    </figure>
                                    <div class="icon-box"><i class="icon fa fa-graduation-cap"></i></div>
                                </div>
                                <div class="content-box">
                                    <h5 class="title"><a href="{{ route('study-abroad.single', $latest->slug) }}">
                                            {{ $latest->title ?? '' }}
                                        </a></h5>
                                    <div class="text">
                                        {{ elipsis( strip_tags($latest->description ?? '') )}}
                                    </div>
                                    <a href="{{ route('study-abroad.single',$latest->slug) }}" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="training-section pb-0">
                    <div class="bottom-text"><a href="{{ route('study-abroad.list') }}">View all of our programme here</a> </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($latesttests) > 0)
        <section class="training-section-two">
            <div class="bg-layer"></div>
            <div class="outer-box pull-up">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="sec-title">
                                <span class="sub-title">Training & Tests</span>
                                <h2>Get the best trainings <br> you deserve.</h2>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="video-box">
                                <div class="inner">
                                    <a href="{{ route('test-preparation.list') }}" class="theme-btn btn-style-one light"><span class="btn-title">View All</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach(@$latesttests as $index=>$latest)
                            <div class="training-block-two col-lg-4 col-md-6 col-sm-12">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ route('test-preparation.single', $latest->slug) }}">
                                                <img class="lazy" data-src="{{ @$latest->image ? asset('/images/test_preparation/thumb/thumb_'.@$latest->image):''}}" alt=""></a>
                                        </figure>
                                        <div class="info-box">
                                            <h5 class="title"><a href="{{ route('test-preparation.single', $latest->slug) }}">
                                                    {{ $latest->title ?? ''}}
                                                </a></h5>
                                            <div class="text">
                                                {{ elipsis( strip_tags($latest->summary ?? '') )}}
                                            </div>
                                            <a href="{{ route('test-preparation.single', $latest->slug) }}" class="read-more"><i class="fa fa-long-arrow-alt-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($clients) > 0)
        <section class="training-section-three">
            <div class="auto-container">
                <div class="sec-title text-center">
                    <span class="sub-title">Our affiliation</span>
                    <h2>Institutions We Proudly <br>Represent.</h2>
                </div>
                <div class="sponsors-outer">
                    <!--clients carousel-->
                    @foreach($clients->chunk(5) as $chunk)
                        <ul class="clients-carousel owl-carousel owl-theme mt-5">
                            @foreach($chunk as $client)
                                <li class="slide-item">
                                    <a href="{{ $client->link ?? '#' }}" target="{{ ($client->link !== null) ? '_blank':'' }}">
                                        <img class="lazy" data-src="{{asset('/images/clients/'.@$client->image)}}" alt="">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach

                    <div class="text-center mt-5">
                        <a href="{{ route('test-preparation.list') }}" class="theme-btn btn-style-one light"><span class="btn-title">View All</span></a>
                    </div>

                </div>
            </div>
        </section>
    @endif

    @if(!empty($homepage_info->why_heading))
        <section class="about-section-four">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-xl-6 col-lg-12 wow fadeInRight" data-wow-delay="600ms">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="sub-title">Why choose us</span>
                            <h2>{{ @$homepage_info->why_heading ?? '' }}</h2>
                            <div class="text">
                                {{ucfirst(@$homepage_info->why_description)}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="about-block col-lg-6 col-md-6">
                                <div class="inner">
                                    <i class="icon flaticon-check-list"></i>
                                    <div class="text"><strong>{{@$homepage_info->project_completed ?? '450'}}</strong> Project Completed</div>
                                </div>
                            </div>

                            <div class="about-block col-lg-6 col-md-6">
                                <div class="inner">
                                    <i class="icon flaticon-rating"></i>
                                    <div class="text"><strong>{{@$homepage_info->happy_clients ?? '660'}}</strong> Happy Clients</div>
                                </div>
                            </div>
                            <div class="about-block col-lg-6 col-md-6">
                                <div class="inner">
                                    <i class="icon flaticon-passport-16"></i>
                                    <div class="text"><strong>{{@$homepage_info->visa_approved ?? '340'}}</strong> Visa Approved</div>
                                </div>
                            </div>
                            <div class="about-block col-lg-6 col-md-6">
                                <div class="inner">
                                    <i class="icon flaticon-cooperation"></i>
                                    <div class="text"><strong>{{@$homepage_info->success_stories ?? '987'}}</strong> Success Stories</div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('contact') }}" class="theme-btn btn-style-one"><span class="btn-title">Reach out</span></a>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-xl-6 col-lg-12">
                    <div class="inner-column wow fadeInLeft">
                        <figure class="image overlay-anim wow fadeInUp">
                            <img src="{{asset('/images/home/welcome/'.@$homepage_info->what_image5)}}" alt="">
                        </figure>
                        @if($homepage_info->why_subheading)
                            <div class="experience bounce-y">
                                <div class="video-box">
                                    <div class="inner">
                                        <a href="{{ $homepage_info->why_subheading }}" class="play-now-two lightbox-image"><i class="icon fa fa-play"></i></a>
                                        <h4 class="title style-font">Play Video</h4>
                                        <span class="sub-title">Watch our video</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <div class="call-to-action">
        <div class="auto-container">
            <div class="inner-container">
                <h5 class="title">Want to get started with counselling ? Just Call us!</h5>
                <a href="tel:{{ $setting_data->phone ?? $setting_data->mobile ?? ''  }}" class="info-btn"><i class="fa fa-phone"></i> {{ $setting_data->phone ?? $setting_data->mobile ?? ''  }}</a>
            </div>
        </div>
    </div>

    @if(@$recruitments[0]->heading)
        <section class="process-section-two">
            <div class="anim-icons full-width">
                <span class="icon icon-cards"></span>
                <span class="icon icon-object-1"></span>
            </div>
            <div class="auto-container">
                <div class="sec-title text-center">
                    <span class="sub-title">Our work process</span>
                    <h2>Achieve your Dreams With These <br> Simple Steps.</h2>
                </div>
                <div class="row">
                @foreach(@$recruitments as $index=>$recruitment)
                        <div class="process-block-two col-xl-3 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ $index+2  }}00ms">
                            <div class="inner-box">
                                <div class="icon-box">
                                    <i class="icon {{ recruitment_process_icons($index) }}"></i>
                                    <span class="count"> {{ $index+1 }} </span>
                                </div>
                                <div class="info-box">
                                    <h5 class="title">{{@$recruitment->title}}</h5>
                                    <div class="text"> {{ $recruitment->icon_description ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(count($testimonials) > 0)
        <section class="testimonial-section-three">
            <div class="bg-layer"></div>
            <div class="auto-container">
                <div class="row">
                    <div class="title-column col-lg-4 col-md-12">
                        <div class="sec-title">
                            <span class="sub-title">Our Success Stories</span>
                            <h2>Hear what our students say have to say.</h2>
                        </div>
                    </div>
                    <div class="testimonial-column col-lg-8 col-md-12">
                        <div class="carousel-outer">
                            <div class="testimonial-carousel-two owl-carousel owl-theme">
                                @foreach($testimonials as $testimonial)
                                    <div class="testimonial-block-three">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img class="lazy" data-src="{{asset('/images/testimonial/'.@$testimonial->image)}}" alt=""></figure>
                                            </div>
                                            <div class="content-box">
                                                <div class="text">{{ucfirst($testimonial->description)}}</div>
                                                <div class="info-box">
                                                    <h5 class="name">{{ucfirst($testimonial->name)}}</h5>
                                                    <span class="designation">{{ucfirst($testimonial->position)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($latestPosts) > 0)
        <section class="news-section-two">
            <span class="wide-map"></span>
            <div class="anim-icons">
                <span class="icon icon-object-1"></span>
                <span class="icon icon-shape-4"></span>
            </div>
            <div class="auto-container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="sec-title">
                            <span class="sub-title">recent news feed</span>
                            <h2>Latest News & Articles <br>From the Blog.</h2>
                        </div>
                    </div>
                    <div class="btn-column text-end col-lg-4">
                        <a href="{{ route('blog.frontend') }}" class="theme-btn btn-style-one bg-theme-color4 mb-4"><span class="btn-title">View All news</span></a>
                    </div>
                </div>

                <div class="row">
                    @foreach(@$latestPosts as $index=>$post)
                        <div class="news-block-two col-lg-4 col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="{{$index+2}}00ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        <a href="{{route('blog.single',$post->slug)}}">
                                            <img class="lazy" data-src="{{asset('/images/blog/thumb/thumb_'.@$post->image)}}" alt="">
                                        </a>
                                    </figure>
                                    <span class="date"><b>{{date('d', strtotime($post->created_at))}}</b> {{date('M Y', strtotime($post->created_at))}}</span>
                                </div>
                                <div class="content-box">
                                    <ul class="post-info">
                                        <li><i class="fa fa-list"></i> {{ucfirst(@$post->category->name)}} </li>
                                    </ul>
                                    <h4 class="title">
                                        <a href="{{route('blog.single',@$post->slug)}}">
                                            {{ucfirst(@$post->title)}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
@section('js')
    <script src="{{asset('assets/frontend/js/lightbox.min.js')}}"></script>
@endsection
