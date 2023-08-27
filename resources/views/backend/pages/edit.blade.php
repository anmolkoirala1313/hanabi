@extends('backend.layouts.master')
@section('title') Edit a Page @endsection
@section('css')

    <style>
        /*for image*/
        .avatar-upload{
            max-width: 505px!important;
        }

        .upper-case{
            text-transform: capitalize;
        }

        .current-img{
            border: 6px solid #f3f3f3;
            border-radius: 10px;
        }

        #blog-img{
            border: 6px solid #f3f3f3;
            border-radius: 10px;
        }
        /*end for image*/

        .nopad {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        /*image gallery*/
        .image-checkbox {
            cursor: pointer;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            border: 4px solid transparent;
            margin-bottom: 0;
            outline: 0;
            position:relative;
        }
        .image-checkbox input[type="checkbox"] {
            display: none;
        }

        .hidden{
            display: none;
        }

        .image-checkbox-checked {
            border-color: #4783B0;
        }
        .image-checkbox .ri {
            position: absolute;
            color: #4A79A3;
            background-color: #fff;
            /* padding: 5px; */
            top: -4px;
            right: -3px;
            border: 4px solid #4A79A3;
            font-size: 18px;
            font-weight: 700;

        }
        .image-checkbox-checked .ri {
            display: block !important;
        }

        /*end of checklist design*/

        /*for sortable*/
        #sortable { list-style-type: none; margin: 0; padding: 0; }
        #sortable li {cursor:move; margin-top: 10px;  transition: -webkit-transform ease-out 0.3s;
            -webkit-transform-origin: 50% 50%; }
        body.dragging, body.dragging * {cursor: move !important; }
        .dragged {position: absolute;z-index: 1; transform: perspective(800px) translateZ(20px);}
        #sortable li span { position: absolute; }
        #sortable li.fixed{cursor:default; color:#959595; opacity:0.5;}

        .div-center{
            margin: auto;width: 70%;
        }


        /*end of sortable*/

    </style>
@endsection
@section('content')




    <div class="page-content">
        <div class="container-fluid">

            {!! Form::open(['method'=>'PUT','id'=>'pageedit-form','url'=>route('pages.update', $page->id),'class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="card ctm-border-radius shadow-sm flex-fill">
                        <div class="card-header">
                            <div class="row g-4">
                                <div class="col-sm-auto">
                                    <h4 class="card-title mb-0">General Details</h4>
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <div>
                                            <a href="{{route('section-elements.create',$page->id)}}" class="btn btn-primary"><i class="ri-edit-2-fill align-bottom me-1"></i>Section Details</a>
                                            <a href="{{route('pages.index')}}" class="btn btn-success"><i class="ri-list-ordered align-bottom me-1"></i>Page List</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Page Name <span class="text-muted text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$page->name}}" required>
                                <div class="invalid-feedback">
                                    Please enter the page Name.
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label>Slug <span class="text-muted text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{$page->slug}}" required>
                                <div class="invalid-feedback">
                                    Please enter the Page Slug.
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Banner Image </label>

                                <div class="col-4">
                                    <img  id="current-page-img"  src="{{ !empty(@$page->image)  ? asset('/images/page/'.@$page->image):asset('/images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                    <input  type="file" accept="image/png, image/jpeg" hidden
                                            id="page-image" onchange="loadbasicFile('page-image','current-page-img',event)" name="image"
                                            class="profile-foreground-img-file-input" >

                                    <figcaption class="figure-caption">Banner image for current basic section. (SIZE:  1920 x 400px)</figcaption>
                                    <div class="invalid-feedback" >
                                        Please select a image.
                                    </div>
                                    <label for="page-image" class="profile-photo-edit btn btn-light feature-image-button">
                                        <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card ctm-border-radius shadow-sm grow">
                        <div class="card-header">
                            <h4 class="card-title doc d-inline-block mb-0">Choose the Section for Pages </h4>
                            <br/>
                            <span class="ctm-text-sm">* Select the sections to use in the page by clicking on the section images below.</span>
                        </div>
                        <div class="card-body doc-boby">
                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Basic Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('basic_section', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/basic_section.png')}}" width="100%"/>
                                                <input type="checkbox" name="section[]" value="basic_section" id="basic_section.png" {{(in_array('basic_section', $sections) ? "checked":"")}} />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Call to Action</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('call_to_action_1', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/calltoaction.png')}}"  width="100%"/>
                                                <input type="checkbox" name="section[]" value="call_to_action_1" id="calltoaction.png" {{(in_array('call_to_action_1', $sections) ? "checked":"")}} />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Call to Action 2</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('call_to_action_2', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/call_to_action_2.png')}}" width="100%"/>
                                                <input type="checkbox" name="section[]" value="call_to_action_2" id="call_to_action_2.png" {{(in_array('call_to_action_2', $sections) ? "checked":"")}}/>
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Background Image Section</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class='image-checkbox {{(in_array('background_image_section', $sections) ? "image-checkbox-checked":"")}}'>
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/background_image_section.png')}}" width="100%"/>
                                                <input type="checkbox" name="section[]" value="background_image_section" id="background_image_section.png" {{(in_array('background_image_section', $sections) ? "checked":"")}}  />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Mission, Vision & Values</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('flash_cards', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/mission_vision.png')}}" width="100%" />
                                                <input type="checkbox" name="section[]" value="flash_cards" id="mission_vision.png" {{(in_array('flash_cards', $sections) ? "checked":"")}} />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Simple Header & Description</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('simple_header_and_description', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/simple_header_descp.png')}}" width="100%"/>
                                                <input type="checkbox" name="section[]" id="simple_header_descp.png" value="simple_header_and_description" {{(in_array('simple_header_and_description', $sections) ? "checked":"")}} />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Map and Description</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('map_and_description', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/map_and_description.png')}}" />
                                                <input type="checkbox" name="section[]" id="map_and_description.png" value="map_and_description" {{(in_array('map_and_description', $sections) ? "checked":"")}} />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Gallery Section 1 </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label>Heading </label>
                                                <input type="text" class="form-control" name="gallery_heading" value="{{@$heading}}" >
                                                <div class="invalid-feedback">
                                                    Please enter the heading.
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Subeading </label>
                                                <input type="text" class="form-control" name="gallery_subheading" value="{{@$subheading}}">
                                                <div class="invalid-feedback">
                                                    Please enter the subheading.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('gallery_section', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/gallery_section.png')}}" width="100%"/>
                                                <input type="checkbox" name="section[]" value="gallery_section" id="gallery_section.png" {{(in_array('gallery_section', $sections) ? "checked":"")}}  />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card shadow-none">
                                <div class="card-header">
                                    <h5 class="card-title text-primary mb-0">Slider Lists</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label>Number of Slider List <span class="text-muted text-danger">* When created, the number of slider list must be 3</span></label>
                                                <input type="number"  class="form-control" name="list_number_3" id="list_number_3" value="{{$list3}}">
                                                <input type="hidden" name="list_3_id" value="{{$list3_id}}">
                                                <div class="invalid-feedback">
                                                    Please enter the list number.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="image-checkbox {{(in_array('slider_list', $sections) ? "image-checkbox-checked":"")}}">
                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/list_option_1.png')}}" width="100%"/>
                                                <input type="checkbox" name="section[]" id="list_option_1.png" value="slider_list" {{(in_array('slider_list', $sections) ? "checked":"")}} />
                                                <i class="ri ri-check-line hidden"></i>
                                            </label>
                                            <span class="ctm-text-sm text-warning">* using this element will create a inner page to display individual list data. Use only when big informations are needed to be showcased</span>

                                        </div>
                                    </div>

                                </div>
                            </div>
{{--                            <div class="card shadow-none">--}}
{{--                                <div class="card-header">--}}
{{--                                    <h5 class="card-title text-primary mb-0">Box description</h5>--}}
{{--                                </div>--}}
{{--                                <div class="card-body">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label>Select number of Tab List <span class="text-muted text-danger">*</span></label>--}}
{{--                                                <select class="form-control select" name="list_number_3_process_sel" id="list_number_3_process_sel">--}}
{{--                                                    <option disabled>Select Number of Tab List</option>--}}
{{--                                                    <option value="3" {{($process_number =="3") ? "selected":""}}>Three</option>--}}
{{--                                                    <option value="6" {{($process_number =="6") ? "selected":""}}>Six</option>--}}
{{--                                                    <option value="9" {{($process_number =="9") ? "selected":""}}>Nine</option>--}}
{{--                                                </select>--}}
{{--                                                <input type="hidden" name="process_sel_id" value="{{$process_id}}">--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    Please select the number.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-md-12 mt-3">--}}
{{--                                            <label class="image-checkbox {{(in_array('small_box_description', $sections) ? "image-checkbox-checked":"")}}">--}}
{{--                                                <img class="img-responsive" src="{{asset('assets/backend/img/page_sections/small_box_description.png')}}" width="100%"/>--}}
{{--                                                <input type="checkbox" name="section[]" id="small_box_description.png" value="small_box_description" {{(in_array('small_box_description', $sections) ? "checked":"")}} />--}}
{{--                                                <i class="ri ri-check-line hidden"></i>--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}

                        </div>
                    </div>

                    <div class="text-end mb-4">
                        <input type="hidden" name="status" id="status" value="{{$page->status}}"/>

                        <button type="button" class="btn btn-success w-sm" name="btnstatus" id="status1" value="active">Active</button>
                        <button type="button" class="btn btn-warning w-sm" name="btnstatus" id="status2" value="deactive">De-Active</button>
                    </div>
                </div>
            </div>


            {!! Form::close() !!}

        </div>
    </div>

    <div class="modal fade" id="editStructure" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 modal-lg">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="myModalLabel">Page Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h4 class="modal-title mb-3">Edit Your Page Sections Structure By Dragging Them</h4>

                    <div id="items-container">
                        <ul class="ui-sortable" id="sortable">
                            {{-- list of section with their names and images are added here via jquery--}}
                        </ul>
                    </div>

                    <div class="text-center mb-3 mt-4">
                        <button id="submiteditpagedata" class="btn btn-success w-sm">Update Page</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery-sortable.js')}}"></script>
    <script type="text/javascript">
        var section_list = new Array();
        var section_names = new Array();
        <?php foreach($ordered_sections as $key=>$value){ ?>
        section_list.push({
            name: '<?php echo $key; ?>',
            image: '<?php echo $value; ?>'
        });
        section_names.push('<?php echo $key; ?>');
        <?php } ?>

        var loadbasicFile = function(id1,id2,event) {
            var image       = document.getElementById(id1);
            var replacement = document.getElementById(id2);
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        //settings for sortable JS
        $("#sortable").sortable({
            onDrop: function ($item, container, _super) {
                //for animation
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': $item.height()});

                $item.animate($clonedItem.position(), function  () {
                    $clonedItem.detach();
                    _super($item, container);
                });
            },
            onDragStart: function ($item, container, _super) {
                var offset = $item.offset(),
                    pointer = container.rootGroup.pointer;

                adjustment = {
                    left: pointer.left - offset.left,
                    top: pointer.top - offset.top
                };

                _super($item, container);
            },
            //for animation
            onDrag: function ($item, position) {
                $item.css({
                    left: position.left - adjustment.left,
                    top: position.top - adjustment.top
                });
            }
        });
        //settings for sortable JS
        $("#name").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            var regExp = /\s+/g;
            Text = Text.replace(regExp,'-');
            $("#slug").val(Text);
        });

        // $(document).ready(function () {
        //
        //
        // });

        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }

        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))

            e.preventDefault();
        });

        $('#status1, #status2').click(function(event){
            event.preventDefault();
            var form = $('#pageedit-form')[0];
            if (!form.reportValidity()) {return false;}
            var status         = $(this).val();
            $('#status').val(status);
            var namelist = new Array();
            var newaddition = new Array();
            $("input:checkbox:checked").each(function() {
                //creating the array of section names only to check with db section names
                namelist.push($(this).val());
                //comparing all the selected sections from this edit page with original section list of DB
                //creating array of newly added sections only
                if($.inArray($(this).val(), section_names) == -1){
                    newaddition.push({
                        name: $(this).val(),
                        image:  $(this).attr("id")
                    });
                }
            });
            $("#editStructure").modal("toggle");//activate the modal
            $('#sortable').empty();//empty the sortable div data to avoid repetition
            let i = 1; //counter for the original section list
            section_list.forEach(function(item) {
                var name = item.name;
                var newname = name.replace(new RegExp('_', 'g')," ");
                //adding the original sections that were created with the page in the list first
                var dbsection = '<li class="'+item.name+'" id="' + i + '">' +
                    '<div class="col-md-10 div-center">' +
                    '<label class="upper-case">' + newname + '</label>' +
                    '<img width="90%" src="/assets/backend/img/page_sections/' + item.image + '"/>' +
                    '</div>' +
                    '</li> ';
                $('#sortable').append(dbsection);
                i++;

                if($.inArray(item.name, namelist) == -1){
                    $('.'+item.name+'').remove();
                    //checking in the arrary if any of the original section is removed and if yes,
                    //removing them from the UL list as well
                }
            });

            //starting the counter where the first counter for already existing sections ended
            let j = i;
            //looping through the new sections which do not exist in the original section list from database
            newaddition.forEach(function(item) {
                var name = item.name;
                var newname = name.replace(new RegExp('_', 'g')," ");
                var replacements = '<li class="'+item.name+'" id="' + j + '">' +
                    '<div class="col-md-10 div-center">' +
                    '<label class="upper-case">' + newname + '</label>' +
                    '<img width="90%" src="/assets/backend/img/page_sections/' + item.image + '"/>' +
                    '</div>' +
                    '</li> ';
                $('#sortable').append(replacements);
                j++;
                //populate the div by appending the image and section name from loop
            });
        });

        //submit the data from previous form and the values of sortable field on button click
        $('#submiteditpagedata').click(function(){
            var form       = $('#pageedit-form')[0];
            var form_data  = new FormData(form); //Creates new FormData object
            var section_name        = $('#sortable li').map(function(i) {
                return $(this).attr('class'); }).get();
            //get the names of the section present as class in sortable UL's li

            for (var i = 0; i < section_name.length; i++) {
                form_data.append('position[]', i+1);//send the position array in terms of number of li present in sortable UL
                form_data.append('sorted_sections[]', section_name[i]);//send the section names listed in sortable UL
            }
            var post_url       = $('#pageedit-form').attr("action"); //get form action url
            var request_method = $('#pageedit-form').attr("method"); //get form GET/POST method

            $.ajax({
                url : post_url,
                type: request_method,
                data : form_data,
                contentType: false,
                cache: false,
                processData:false
            }).done(function(response){
                if(response.status=='warning'){
                    toastr.warning(response.message);
                }else{
                    //when the response is received, it will redirect to the dynamic route sent from controller
                    window.location.replace(response);
                }
            });
        });


    </script>
@endsection



