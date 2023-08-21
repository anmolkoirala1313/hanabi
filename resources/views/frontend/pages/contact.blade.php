@extends('frontend.layouts.master')
@section('title') Contact Us @endsection
@section('css')
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
                                <h2 class="title">Contact Us</h2>
                            </div>
                            <div class="breadcrumb-wrapper">
                                <i class="flaticon-home"></i>
                                <span>
                                        <a title="Homepage" href="/">Home</a>
                                    </span>
                                <div class="prt-sep"> - </div>
                                <span>Contact</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-main">

        <!-- contact-form-section -->
        <section class="prt-row padding_bottom_zero-section contact-us-contact-form-section clearfix">
            <div class="container">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="col-bg-img-thirty-seven prt-bg prt-col-bgimage-yes col-bg-img-six">
                            <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                            <div class="layer-content"></div>
                        </div>
                        <img class="img-fluid prt-equal-height-image" src="{{ asset('assets/frontend/images/bg-image/col-bgimage-37.png') }}" alt="col-bgimage-37">
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-base-grey spacing-25">
                            <!-- section title -->
                            <div class="section-title style7">
                                <div class="title-header">
                                    <h2 class="title">Have any question? <br>feel free to <span>Contact</span></h2>
                                </div>
                            </div><!-- section title end -->
                            <form action="{{route('contact.store')}}" class="contact_form clearfix" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="name" type="text" value="" placeholder="Your Full Name" required="required">
                                    </div>

                                    <div class="col-md-12">
                                        <input name="email" type="text" value="" placeholder="Email Address" required="required">
                                    </div>

                                    <div class="col-md-6">
                                        <input name="phone" type="text" value="" placeholder="Phone" />
                                    </div>
                                    <div class="col-md-6">
                                        <input name="subject" type="text" value="" placeholder="Subject" />
                                    </div>
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="select"><select id="selectbox" class="select-hidden">--}}
{{--                                                <option value="hide">Services</option>--}}
{{--                                                <option value="Babies">WordPress security</option>--}}
{{--                                                <option value="Nannies">software integration</option>--}}
{{--                                                <option value="Babies and nannies duo">Other</option>--}}
{{--                                            </select><div class="select-styled">Services</div><ul class="select-options"><li rel="hide">Services</li><li rel="Babies">WordPress security</li><li rel="Nannies">software integration</li><li rel="Babies and nannies duo">Other</li></ul></div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-12">
                                        <textarea name="message" rows="4" placeholder="Your Message" required="required"></textarea>
                                    </div>
                                    <div class="mt-5">
                                        <button class="submit prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor" type="submit" value="submit">Submit Here</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-form-section-end -->

        <!-- contact-us-iconbox-section -->
        <section class="prt-row contact-us-iconbox-section clearfix">
            <div class="container">
                <div class="row g-0 prt-vertical_sep">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="featured-icon-box icon-align-top-content style19">
                            <div class="featured-icon">
                                <div class="prt-icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h3>call us on</h3>
                                </div>
                                <div class="featured-desc">
                                    <a href="tel:{{@$setting_data->phone ?? $setting_data->mobile  ?? ''}}">{{@$setting_data->phone ?? $setting_data->mobile  ?? ''}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="featured-icon-box icon-align-top-content style19">
                            <div class="featured-icon">
                                <div class="prt-icon">
                                    <i class="flaticon-email"></i>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h3>Email</h3>
                                </div>
                                <div class="featured-desc">
                                    <a href="mailto:{{@$setting_data->email ?? ''}}">{{@$setting_data->email ?? ''}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="featured-icon-box icon-align-top-content style19">
                            <div class="featured-icon">
                                <div class="prt-icon">
                                    <i class="flaticon-location"></i>
                                </div>
                            </div>
                            <div class="featured-content">
                                <div class="featured-title">
                                    <h3>Address</h3>
                                </div>
                                <div class="featured-desc">
                                    <span>{{@$setting_data->address ?? ''}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-us-iconbox-section-end -->

    </div>

    @if(@$setting_data->google_map)
        <section>
            <div class="container-fluid p-0">
                <div class="row">
                    <!-- Google Map HTML Codes -->
                    <iframe src="{{@$setting_data->google_map}}" data-tm-width="100%" height="500" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>
        </section>
    @endif
@endsection
@section('js')
    <!-- For Contact Form -->
    <script src="{{asset('assets/frontend/js/contact.form.js')}}"></script>

    @include('frontend.partials.toast_alert')

@endsection
