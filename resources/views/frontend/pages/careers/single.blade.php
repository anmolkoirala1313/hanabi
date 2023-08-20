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
        margin-left: 30px;

    }

    .canosoft-listing ul {
        list-style: disc;
    }

    .register-form.apply-form form {
        margin: 0;
    }

    .apply-form form textarea {
        min-height: 140px;
    }

     #signup-1 {
        min-height: 100vh;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .canosoft-listing ul li,.canosoft-listing ol li {
        font-size: 1.1875rem;
    }
   .more-projects .share-social-icons li {
        width: auto !important;
        display: inline-block !important;
        vertical-align: top;
        clear: none !important;
        padding: 0;
    }
    .single-career{
        border-bottom: 1px solid #ddd;
    }

    .more-projects .share-social-icons {
        display: inline-block;
        padding-left: 0;
    }

    .more-projects .share-social-icons a {
        text-decoration: none;
    }

    .more-projects .share-social-icons a.share-ico span {
        margin-right: 15px;
    }
   
    </style>
@endsection
@section('seo')
    <title>{{ucfirst(@$singleCareer->name)}} | @if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif </title>
    <meta name='description' itemprop='description'  content='{{ucfirst(@$singleCareer->meta_description)}}' />
    <meta name='keywords' content='{{ucfirst(@$singleCareer->meta_tags)}}' />
    <meta property='article:published_time' content='<?php if(@$singleCareer->updated_at !=''){?>{{@$singleCareer->updated_at}} <?php }else {?> {{@$singleCareer->created_at}} <?php }?>' />
    <meta property='article:section' content='article' />
    <meta property="og:description" content="{{ucfirst(@$singleCareer->meta_description)}}" />
    <meta property="og:title" content="{{ucfirst(@$singleCareer->meta_title)}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:type" content="IT-Coperation" />
    <meta property="og:locale" content="en-us" />
    <meta property="og:locale:alternate"  content="en-us" />
    <meta property="og:site_name" content="@if(!empty(@$setting_data->website_name)) {{ucwords(@$setting_data->website_name)}} @else Canosoft - Let's make IT happen @endif" />
    <meta property="og:image" content="<?php if(@$singleCareer->feature_image){?>{{asset('/images/career/'.@$singleCareer->feature_image)}}<?php }?>" />
    <meta property="og:image:url" content="<?php if(@$singleCareer->feature_image){?>{{asset('/images/career/'.@$singleCareer->feature_image)}}<?php }?>" />
    <meta property="og:image:size" content="300" />
@endsection

@section('content')

	<!-- SINGLE PROJECT-1
			============================================= -->
			<section id="project-1" class="bg-snow wide-60 inner-page-hero single-project division">
				<div class="container">
					<div class="row">


						<!-- PROJECT DISCRIPTION -->
						<div class="col-lg-10 offset-lg-1 single-career">
							<div class="project-description">


								<!-- PROJECT TITLE -->
								<div class="project-title">
                                        <p class="p-sm post-tag txt-500 txt-upcase"><a href="/">Home</a> | <span class="h6-xl"><a href="{{route('career.frontend')}}">Career</a></span></p>

									<!-- Title -->	
									<h2 class="h2-xl">{{ucwords(@$singleCareer->name)}}</h2>

								</div>


								<!-- PROJECT TEXT -->
								<div class="project-txt custom-editor canosoft-listing">

									<!-- Image -->
					 				<div class="project-inner-img mb-50">
										<img class="img-fluid" src="<?php if(@$singleCareer->feature_image){?>{{asset('/images/career/'.@$singleCareer->feature_image)}}<?php }?>" alt="{{@$singleCareer->slug}}" />
									</div>

                                    {!! @$singleCareer->description !!}
									

								</div>	<!-- END PROJECT TEXT -->


								<!-- MORE PROJECTS BUTTON -->
								<div class="row more-projects">
                                    <div class="col-md-3 col-xl-4 post-share-list text-start">
                                        <ul class="share-social-icons ico-25 text-center clearfix">								
                                                <li><a href="#" class="share-ico" onclick='fbShare("{{route('career.single',$singleCareer->slug)}}")'><span class="flaticon-facebook"></span></a></li>
                                                <li><a href="#" class="share-ico" onclick='twitShare("{{route('career.single',$singleCareer->slug)}}","{{ $singleCareer->name }}")' ><span class="flaticon-twitter"></span></a></li>
                                                <li><a href="#" class="share-ico"  onclick='whatsappShare("{{route('career.single',$singleCareer->slug)}}","{{ $singleCareer->name }}")' ><span class="flaticon-whatsapp"></span></a></li>

                                            </ul>
                                    </div>
                                    <div class="col-md-9 col-xl-8  text-end"><a href="{{route('career.frontend')}}"><h3 class="h2-md txt-500">More Career</h3></a></div>
									
								</div>


							</div>
						</div>	<!-- END PROJECT DISCRIPTION -->


					</div>	  <!-- End row -->
				</div>	   <!-- End container -->	

                  	<!-- SIGN UP PAGE
			============================================= -->
			<section id="signup-1" class="signup-section division">
				<div class="container">
					<div class="row">
                        <div class="register-form apply-form">
                            <form name="signupform" class="row job-apply" id="jobform">

                                <!-- Title-->
                                <div class="col-md-12">
                                    <div class="register-form-title text-center">
                                        <h3 class="h3-xs">Apply for this job</h3>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-5 offset-md-1">	

                                    <div class="col-md-12">
                                    
                                    <input type="hidden" id="career_id" name="career_id" value="{{@$singleCareer->id}}" >

                                        <input class="form-control name" type="text" name="name" placeholder="Fullname"> 
                                    </div>

                                        <!-- Form Input -->	
                                    <div class="col-md-12">
                                        <input class="form-control phone" type="text" name="phone" placeholder="Phone"> 
                                    </div>

                                    <!-- Form Input -->	
                                    <div class="col-md-12">
                                        <input class="form-control email" type="email" name="email" placeholder="Email"> 
                                    </div>

                                        <!-- Form Input -->	
                                    <div class="col-md-12">
                                        <input class="form-control address" type="text" name="address" placeholder="Address"> 
                                    </div>
                                        
                                </div>	<!-- END SIGN UP FORM -->


                                <div class="col-md-5 col-lg-5 offset-md-1">	


                                    <div class="col-md-12">
                                        <input class="form-control attachcv" type="file" name="attachcv" placeholder="CV"> 
                                    </div>
                                    <!-- Form Input -->	
                                    <div class="col-md-12">
                                        <textarea class="form-control message" name="message" rows="6" placeholder="Message us..."></textarea>

                                    </div>

                                    <!-- Form Submit Button -->	
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-md btn-skyblue tra-black-hover submit">Apply Now</button>
                                    </div> 

                                    <!-- Checkbox -->
                                
                                                                                                                                                                                                
                                    </div>	<!-- END SIGN UP FORM -->

                                </div>
                                <!-- Contact Form Message -->
                                <div class="col-lg-12 apply-form-msg text-center">
                                    <span class="loading"></span>
                                </div>	
                            </form>	
                        </div>	  
			 		</div>	   <!-- End row -->	
			 	</div>	   <!-- End container -->		
			</section>	<!-- END SIGN UP PAGE -->


			</section>	<!-- END SINGLE PROJECT-1 -->


     


@endsection
@section('js')

<script src="{{asset('assets/frontend/js/additional-methods.min.js')}}"></script>	
<script src="{{asset('assets/frontend/js/apply-form.js')}}"></script>	
@endsection