@extends('formbuilder::front_layout')
@section('title') {{ ucfirst($pageTitle) }} @endsection
@section('css')

    <style>
        /* .footable .btn .caret {
            margin-left: 0;
            display: none;
        } */

        .rendered-form h1{
            font-family: 'Kumbh Sans', sans-serif;
            margin-bottom: 25px;
            font-weight: 700;
            color: #293043;
            line-height: 1.22;
            font-size: 35px;
        }
        .card-title{
            color: #27aae1;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            display: -ms-inline-flexbox;
            display: inline-flex;
        }

        .card-title::before{
            content: url(/assets/frontend/images/shapes/section-subtitle-line.png);
            margin: -15px 15px 0 -25px;
            float: left;
            line-height: 0;
            font-size: 40px;
            font-weight: 300;
            font-family: 'Font Awesome 5 Pro';
        }
        .rendered-form .form-control {
            padding: 17px 17px 17px 17px!important;
            color: #000000!important;
            border-style: solid!important;
            border-width: 1px 1px 1px 1px!important;
            border-color: #EBEBEB!important;
            background-color: #F1F1F1!important;
            width: 100%;
            max-width: 100%;
            opacity: 1;
        }
        .rendered-form p{
            margin: 0px 0 10px!important;
        }

        .rendered-form label{
            font-size: 15px!important;
            color: #454545!important;
            font-family: 'Poppins', sans-serif!important;
        }

        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 1px solid #EED3D7;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;
            color: #B94A48;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .topbar-items .social-icons li a i {
            line-height: 50px;
        }
        .parsley-errors-list.filled {
            opacity: 1;
        }

        .rendered-form .fb-radio-group .radio label {
            display: inline;
        }

        .rendered-form .fb-radio-group .radio-inline label {
            display: inline ;
            margin-bottom: 0;
        }

        input[type=checkbox], input[type=radio] {
            box-sizing: border-box;
            padding: 0;
        }

        .rendered-form .fb-radio-group .radio input{
            position: absolute !important;
            margin-top: 0.3rem !important;
            margin-left: -1.25rem !important;
        }
        .rendered-form .fb-radio-group .radio-inline input {
            position: static !important;
            margin-top: 0 !important;
            margin-right: 0.3125rem !important;
            margin-left: 0 !important;
        }

        .rendered-form .fb-radio-group .radio {
            position: relative;
            display: block;
            padding-left: 1.25rem !important;
        }

        .rendered-form .fb-radio-group .radio-inline {
            display: -ms-inline-flexbox;
            display: inline-flex;
            -ms-flex-align: center;
            align-items: center;
            padding-left: 0;
            margin-right: 0.75rem;
            position: relative;
        }

        .rendered-form .fb-checkbox-group .checkbox {
            position: relative;
            display: block;
            padding-left: 1.25rem !important;
        }

        .rendered-form .fb-checkbox-group .checkbox input {
            position: absolute !important;
            margin-top: 0.3rem !important;
            margin-left: -1.25rem !important;
        }

        .rendered-form .fb-checkbox-group .checkbox label {
            display: inline-block;
            margin-bottom: 0;
        }

        .rendered-form .fb-file input {
            padding: 10px 0px 40px 25px!important;
        }

        .rendered-form .fb-checkbox-group .checkbox-inline {
            display: -ms-inline-flexbox;
            display: inline-flex;
            -ms-flex-align: center;
            align-items: center;
            padding-left: 0;
            margin-right: 0.75rem;
            position: relative;
        }

        .rendered-form .fb-checkbox-group .checkbox-inline input {
            position: static !important;
            margin-top: 0 !important;
            margin-right: 0.3125rem !important;
            margin-left: 0 !important;
        }

        .rendered-form .fb-checkbox-group .checkbox-inline label {
            display: inline-block;
            margin-bottom: 0;
        }

        .card {
            position: relative !important;
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-box-orient: vertical !important;
            -webkit-box-direction: normal !important;
            -ms-flex-direction: column !important;
            flex-direction: column !important;
            min-width: 0 !important;
            word-wrap: break-word !important;
            background-color: var(--vz-card-bg) !important;
            background-clip: border-box !important;
            border: 0 solid rgba(0,0,0,.125) !important;
            border-radius: 0.25rem !important;
        }
        .card-header:first-child {
            border-radius: 0.25rem 0.25rem 0 0 !important;
        }

        .card-header {
            padding: 1rem 1rem !important;
            margin-bottom: 0 !important;
            background-color: var(--vz-card-cap-bg) !important;
            border-bottom: 0 solid rgba(0,0,0,.125) !important;
        }

        .card-footer:last-child {
            border-radius: 0 0 0.25rem 0.25rem !important;
        }

        .card-footer {
            padding: 1rem 1rem !important;
            background-color: var(--vz-card-cap-bg) !important;
            border-top: 0 solid rgba(0,0,0,.125) !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #405189 !important;
            border-color: #405189 !important;
        }

        .btn {
            color: #fff;
            font-size: 17px;
            line-height: 26px;
            font-weight: 600;
            text-transform: capitalize;
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: all 0.4s;
            z-index: 1;
            background-color: transparent;
        }
    </style>
@endsection
@section('content')

    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs img10">
        <div class="container">
            <div class="breadcrumbs-inner">
                <h1 class="page-title">{{ $form->name }}</h1>
            </div>
        </div>
    </div>

    <div class="rs-contact contact-style2 bg9 pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec-title md-mb-25">
                        <h2 class="title pb-20">
                            {{ ucwords($pageTitle) }}
                        </h2>
                    </div>
                    <div class="sec-title mb-45 md-mb-25">
                        <h2 class="title pb-20">
                            Your Response was submitted <span>Successfully.</span>
                        </h2>
                        <p class="margin-0">We will get back to you soon with appropriate response. Thank you for your patience.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Icon Section Start -->
        <div class="rs-contact main-home">
            <div class="container">
                <div class="contact-icons-style box-address pt-100 md-pt-70">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 md-mb-30">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/frontend/images/contact/icons/1.png') }}" alt="images">
                                </div>
                                <div class="content-text">
                                    <h2 class="title"><a>Office</a></h2>
                                    <p class="services-txt">{{@$setting_data->address}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 xs-mb-30">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/frontend/images/contact/icons/3.png') }}" alt="images">
                                </div>
                                <div class="content-text">
                                    <h2 class="title"><a href="mailto:{{@$setting_data->email}}">Email us</a></h2>
                                    <a href="mailto:{{@$setting_data->email}}">{{@$setting_data->email}}</a><br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="contact-item">
                                <div class="contact-icon">
                                    <img src="{{ asset('assets/frontend/images/contact/icons/4.png') }}" alt="images">
                                </div>
                                <div class="content-text">
                                    <h2 class="title"><a href="tel:{{@$setting_data->phone ?? $setting_data->mobile}}">Call us</a></h2>
                                    <a href="tel:{{@$setting_data->phone}}">{{@$setting_data->phone}}</a><br>
                                    <a href="tel:{{@$setting_data->mobile}}">{{@$setting_data->mobile}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Icon Section End -->
    </div>

@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
<script type="text/javascript">
    window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
</script>
@include('frontend.partials.toast_alert')

<script src="{{ asset('vendor/formbuilder/js/render-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush
