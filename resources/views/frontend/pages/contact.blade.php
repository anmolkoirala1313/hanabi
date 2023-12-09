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
                                    <h2 class="title">Have any question? <br>feel free to <span>Contact Us</span></h2>
                                </div>
                            </div><!-- section title end -->
                            <form action="{{route('contact.store')}}" class="contact_form clearfix" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input name="name" type="text" value="" placeholder="Your Full Name" required="required">
                                    </div>

                                    <div class="col-md-6">
                                        <input name="email" type="text" value="" placeholder="Email Address" required="required">
                                    </div>

                                    <div class="col-md-6">
                                        <input name="phone" type="text" value="" placeholder="Phone" required="required"/>
                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <input name="subject" type="text" value="" placeholder="Subject" />--}}
{{--                                    </div>--}}
                                    <div class="col-md-6">
                                        <select id="qualification" name="qualification" required="required">
                                            <option value="">Select Qualification</option>
                                            <option value="SEE/SLC">SEE/SLC</option>
                                            <option value="A Levels">A Levels</option>
                                            <option value="10+2/PCL">10+2/PCL</option>
                                            <option value="Bachelors (3 Years)">Bachelors (3 Years)</option>
                                            <option value="Bachelors (4 Years)">Bachelors (4 Years)</option>
                                            <option value="Master's and Above">Master's and Above</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="preparation_class" name="preparation_class" required="required">
                                            <option value="">Preparation Class</option>
                                            <option value="IELTS">IELTS</option>
                                            <option value="PTE">PTE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="preferred_location" name="preferred_location" required="required">
                                            <option value="">Location You Prefer</option>
                                            <optgroup label="Kathmandu Office">
                                                <option value="Putalisadak">Putalisadak</option>
                                                <option value="Baneswor">Baneswor</option>
                                                <option value="Kumaripati">Kumaripati</option>
                                            </optgroup>
                                            <option value="Pokhara">Pokhara</option>
                                            <option value="Butwal">Butwal</option>
                                            <option value="Chitwan">Chitwan</option>
                                            <option value="Birtamode">Birtamode</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="interested_country" name="interested_country" required="required">
                                            <option value="">Interested Country</option>
                                            <option value="Japan">Japan</option>
                                            <option value="UK">UK</option>
                                            <option value="USA">USA</option>
                                            <option value="Canada">Canada</option>
                                            <option value="New Zealand">New Zealand</option>
                                        </select>
                                    </div>
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
