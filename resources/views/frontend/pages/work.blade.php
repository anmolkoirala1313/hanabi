@extends('frontend.layouts.master')
@section('title') Our Works @endsection
@section('css')
<style>
  /*CSS buttons*/
    .grid {
        width: 100%;
        max-width: 1100px;
        margin: auto;
    }
    .button-group {
        margin: 20px auto;
        display: table;
    }
    .button {
        padding: 10px 15px;
        border-radius: 5px;
        border: 0;
        color: #333;
        cursor: pointer;
        background-color: #eee;
        margin: 0 3px;
    }
    .button:hover {
        background-color: #ccc;
        color: #fff;
    }
    .button.is-checked {
        background: #2F72A3;
        color: #fff;
    }
    .element-item {
        background-color: #fff;
        padding: 0;
        margin: 10px;
        width: calc(33% - 20px);
        display: inline-block;
    }
    .item-image {
        width: 100%;
        padding-bottom: 60%;
        background-size: cover;
    }
    .item-title {
        margin: 0;
        text-align: center;
        padding: 10px;
        height: 40px;
        text-transform: capitalize;
        overflow: hidden;
        font-size: 18px;
    }

    /* end gallery style */

</style>
@endsection
@section('content')
	<!-- PAGE HERO
    ============================================= -->	
    <div id="faqs-page" class="page-hero-section division">
        <div class="page-hero-overlay division">
            <div class="container">	
                <div class="row justify-content-center">	
                    <div class="col-lg-10 col-xl-8">
                        <div class="hero-txt text-center white-color">

                            <!-- Title -->
                            <h2 class="h2-xs">Our Works</h2>

                            <!-- Text -->	
                            <p class="p-xl">
                            </p>

                        </div>
                    </div>	
                </div>	  <!-- End row -->
            </div>	   <!-- End container --> 
        </div>	 <!-- End hero-overlay -->


        <!-- WAVE SHAPE BOTTOM -->	
        <div class="wave-shape-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80"><path fill="#ffffff" fill-opacity="1" d="M0,32L120,42.7C240,53,480,75,720,74.7C960,75,1200,53,1320,42.7L1440,32L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
        </div>
        

       

    </div>	<!-- END PAGE HERO -->	

    <section id="faqs-2" class="wide-60 faqs-section division">				
        <div class="container">
        
        <div class="button-group filters-button-group">
            <button class="button is-checked" data-filter="*">All</button>
            @foreach($our_works as $work)
                <button class="button" data-filter=".{{str_replace(' ','-',$work->category->name)}}">{{ ucwords($work->category->name) }}</button>

            @endforeach
        </div>

        <div class="grid">
            @foreach($our_works as $work)

            <div class="element-item transition {{str_replace(' ','-',$work->category->name)}}" data-category="transition">
                <div class="item-image" style="background-image: url('{{asset('images/work/'.$work->image)}}')"></div>
                <h3 class="item-title">{{$work->title}}</h3>  
            </div>
            @endforeach
          
        </div>
           
        </div>
    </section>

@endsection

@section('js')
<script src="{{asset('assets/frontend/js/isotope.pkgd.min.js')}}" ></script>

  <script>
    
        var iso = new Isotope( '.grid', {
        itemSelector: '.element-item',
        layoutMode: 'fitRows'
        });

        // filter functions
        var filterFns = {
        // show if name ends with -ium
        ium: function( itemElem ) {
            var name = itemElem.querySelector('.name').textContent;
            return name.match( /ium$/ );
        }
        };

        // bind filter button click
        var filtersElem = document.querySelector('.filters-button-group');
        filtersElem.addEventListener( 'click', function( event ) {
        // only work with buttons
        if ( !matchesSelector( event.target, 'button' ) ) {
            return;
        }
        var filterValue = event.target.getAttribute('data-filter');
        // use matching filter function
        filterValue = filterFns[ filterValue ] || filterValue;
        iso.arrange({ filter: filterValue });
        });

        // change is-checked class on buttons
        var buttonGroups = document.querySelectorAll('.button-group');
        for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
        var buttonGroup = buttonGroups[i];
        radioButtonGroup( buttonGroup );
        }
        function radioButtonGroup( buttonGroup ) {
        buttonGroup.addEventListener( 'click', function( event ) {
            // only work with buttons
            if ( !matchesSelector( event.target, 'button' ) ) {
            return;
            }
            buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
            event.target.classList.add('is-checked');
        });
        }


  </script>
@endsection