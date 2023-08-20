@extends('backend.layouts.master')
@section('title') Service Category @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        /*for dropdown list design*/

        .hidden{
            display: none;
        }
        .list > ul {
            list-style-type: none;
            width:220px;
            padding-left: 0px;
        }
        .list > ol {
            list-style-type: none;
            padding-left: 0px;
            margin-bottom: 0px;
            width:220px
        }

        .list > ul > li {
            display: block;
            white-space: break-spaces;
        }

        .list > ol > li {
            display: block;
            white-space: break-spaces;
        }

        .list > ul > li:nth-child(3) ~ li {
            padding: 0;
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: 0.5s ease;
            box-sizing: padding-box;
        }

        .list > ol > li:nth-child(3) ~ li {
            padding: 0;
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: 0.5s ease;
            box-sizing: padding-box;
        }

        .list > ul > li ~ li.visible {
            opacity: 1;
            max-height: 70px;
        }
        .list > ol > li ~ li.visible {
            opacity: 1;
            max-height: 70px;
        }

        /* ADDITIONAL STYLES */

        div.list {
            width: 256px;
            margin: auto;
            display: flex;
            background: #fff;
            border-radius: 8px;
            padding: 12px 16px;
            flex-direction: column;
            border: 1px solid #ccc;
        }


        div.list ~ div.list {
            margin-top: 16px;
        }

        .list > ul > li,
        .list > ul > li ~ li.visible {
            padding: 8px 0;

        }
        .list > ol > li,
        .list > ol > li ~ li.visible {
            padding: 8px 0;
        }

        .list > ul > li ~ li {
            box-shadow: 0 -1px 0 #eee;
        }
        .list > ol > li ~ li {
            box-shadow: 0 -1px 0 #eee;
        }
        /* end of dropdown list design */
    </style>
@endsection
@section('content')


    <div class="page-content">
        <div class="container-fluid" style="position:relative;">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Clients</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Service Category</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'service-category.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-7">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Service Category details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label>Category Name <span class="text-muted text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="catname"  onclick="slugMaker('catname','catslug')" required>
                                <div class="invalid-feedback">
                                    Please enter the category name.
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Category Slug <span class="text-muted text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="catslug"  required>
                                <div class="invalid-feedback">
                                    Please enter the category slug.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Category list <span class="text-muted text-danger">*</span></label>
                                <textarea class="form-control" rows="8" name="list" id="editor" required></textarea>
                                <span class="ctm-text-sm">* Use bullet and numbering to write the list from the options.</span>
                                <div class="invalid-feedback">
                                    Please enter the post description.
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card ctm-border-radius shadow-sm grow flex-fill">
                        <div class="card-header">
                            <h4 class="card-title mb-0">
                                Service Category Image <span class="text-muted text-danger">*</span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div style="margin: auto;width: 60%;">
                                <img  id="current-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                <input  type="file" accept="image/png, image/jpeg" hidden
                                        id="profile-foreground-img-file-input" onchange="loadbasicFile('profile-foreground-img-file-input','current-img',event)" name="image" required
                                        class="profile-foreground-img-file-input" >

                                <div class="invalid-feedback" >
                                    Please select a image.
                                </div>
                                <span class="ctm-text-sm">*use image minimum of 850 x 420px</span>

                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light feature-image-button">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Add Image
                                </label>
                            </div>
                            <div class="form-group mb-3">
                                <label>Short Description </label>
                                <textarea class="form-control" rows="6" name="short_description" ></textarea>
                                <div class="invalid-feedback">
                                    Please write the short description about service category.
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success w-sm mt-4" >Add Category</button>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="col-md-12">
                    <div class="company-doc">
                        <div class="card ctm-border-radius shadow-sm grow">
                            <div class="card-header">
                                <h4 class="card-title d-inline-block mb-0">
                                    Service Category List
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-1">
                                    <table id="client-index" class="table align-middle table-nowrap table-striped">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Category Image</th>
                                            <th>Name</th>
                                            <th>Name</th>
                                            <th>List</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="blog-list">
                                        @if(@$categories)
                                            @foreach($categories as  $category)
                                                <tr>
                                                    <td class="align-middle pt-6 pb-4 px-6">
                                                        <img src="<?php if(!empty($category->image)){ echo '/images/service_categories/'.$category->image; } else{  echo 'assets/backend/images/users/user-dummy-img.jpg'; } ?>" alt="{{@$category->name}}" class="figure-img rounded avatar-lg">

                                                    </td>
                                                    <td>{{$category->name}}</td>
                                                    <td style="white-space: break-spaces;">{{$category->short_description}}</td>
                                                    <td>
                                                        <div class="list">
                                                            {!! $category->list !!}
                                                            <button class="btn btn-success w-sm" value="1" data-show="More" data-hide="Less">More</button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">

                                                            <div class="col text-center dropdown">
                                                                <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i class="ri-more-fill fs-17"></i>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                                    <li><a class="dropdown-item action-edit" href="#" hrm-update-action="{{route('service-category.update',$category->id)}}" hrm-edit-action="{{route('service-category.edit',$category->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>
                                                                    <li><a class="dropdown-item action-delete" cs-delete-route="{{route('service-category.destroy',$category->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editClient" tabindex="-1" aria-hidden="true">
        <form action="#" method="post" id="deleted-form" >
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
        </form>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 ps-4 bg-soft-success">
                    <h5 class="modal-title" id="myModalLabel">Page Structure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
                    {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateclient','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                    <div class="modal-body">
                        <h4 class="modal-title mb-3">Edit Clients</h4>
                        <div class="row">

                            <div class="col-md-7">
                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">
                                            Client Details
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Category Name <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="editname" onclick="slugMaker('editname','editslug')" required>
                                            <div class="invalid-feedback">
                                                Please enter the category name.
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Category Slug <span class="text-muted text-danger">*</span></label>
                                            <input type="text" class="form-control" name="slug" id="editslug" required>
                                            <div class="invalid-feedback">
                                                Please enter the category name.
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Short Description </label>
                                            <textarea class="form-control" rows="6" name="short_description" id="short_description" ></textarea>
                                            <div class="invalid-feedback">
                                                Please write the short description about service category.
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Category list <span class="text-muted text-danger">*</span></label>
                                            <textarea class="form-control" rows="8" name="list" id="edit-editor" required></textarea>
                                            <span class="ctm-text-sm">* Use bullet and numbering to write the list from the options.</span>
                                            <div class="invalid-feedback">
                                                Please enter the post description.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card ctm-border-radius shadow-sm flex-fill">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">
                                            Client Image Details <span class="text-muted text-danger">*</span>
                                        </h4>
                                    </div>
                                    <div class="card-body">

                                        <div style="margin: auto;width: 60%;">
                                            <img id="current-edit-img"  src="{{asset('images/default-image.jpg')}}" class="position-relative img-fluid img-thumbnail blog-feature-image" >
                                            <input  type="file" accept="image/png, image/jpeg" hidden
                                                    id="image-edit" onchange="loadbasicFile('image-edit','current-edit-img',event)" name="image"
                                                    class="profile-foreground-img-file-input" >
                                            <div class="invalid-feedback" >
                                                Please select a image.
                                            </div>
                                            <span class="ctm-text-sm">*use image minimum of 850 x 420px</span>

                                            <label for="image-edit" class="profile-photo-edit btn btn-light feature-image-button">
                                                <i class="ri-image-edit-line align-bottom me-1"></i> Update Image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-success w-sm mt-4">Update</button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/backend/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <script type="text/javascript">

        var loadbasicFile = function(id1,id2,event) {
            var image       = document.getElementById(id1);
            var replacement = document.getElementById(id2);
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        function slugMaker(title, slug){
            $("#"+ title).keyup(function(){
                var Text = $(this).val();
                Text = Text.toLowerCase();
                var regExp = /\s+/g;
                Text = Text.replace(regExp,'-');
                $("#"+slug).val(Text);
            });
        }

        $(document).ready(function () {
            createEditor('editor');
            createEditor('edit-editor');

            $('#client-index').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            });

            $(document).on('click', '.action-edit', function (e) {
                e.preventDefault();
                var url = $(this).attr('hrm-edit-action');
                // console.log(action)
                var id = $(this).attr('id');
                var action = $(this).attr('hrm-update-action');

                $.ajax({
                    url: $(this).attr('hrm-edit-action'),
                    type: "GET",
                    cache: false,
                    dataType: 'json',
                    success: function (dataResult) {
                        // $('#id').val(data.id);
                        $("#editClient").modal("toggle");
                        $('#editname').attr('value',dataResult.name);
                        $('#editslug').attr('value',dataResult.slug);
                        $('#short_description').text(dataResult.short_description);
                        $('#current-edit-img').attr("src",'/images/service_categories/'+dataResult.image );
                        editor.setData( dataResult.list );
                        $('.updateclient').attr('action', action);

                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });

            $(document).on('click','.action-delete', function (e) {
                e.preventDefault();
                var form = $('#deleted-form');
                var action = $(this).attr('cs-delete-route');
                form.attr('action',action);
                var url = form.attr('action');
                var form_data = form.serialize();
                Swal.fire({
                    html: '<div class="mt-2">' +
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                        'style="width:120px;height:120px"></lord-icon>' +
                        '<div class="mt-4 pt-2 fs-15">' +
                        '<h4>Are your sure? </h4>' +
                        '<p class="text-muted mx-4 mb-0">' +
                        'You want to Remove this Record ?</p>' +
                        '</div>' +
                        '</div>',
                    showCancelButton: !0,
                    confirmButtonClass: "btn btn-primary w-xs me-2 mt-2",
                    cancelButtonClass: "btn btn-danger w-xs mt-2",
                    confirmButtonText: "Yes!",
                    buttonsStyling: !1,
                    showCloseButton: !0
                }).then(function(t)
                {
                    t.value
                        ?
                        $.post( url, form_data)
                            .done(function(response) {
                                if(response.status == "success") {
                                    Swal.fire({
                                        html: '<div class="mt-2">' +
                                            '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json"' +
                                            'trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                                            '</lord-icon>' +
                                            '<div class="mt-4 pt-2 fs-15">' +
                                            '<h4>Success !</h4>' +
                                            '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                            '</div>' +
                                            '</div>',
                                        timerProgressBar: !0,
                                        timer: 2e3,
                                        showConfirmButton: !1
                                    });
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2500);
                                }else{
                                    Swal.fire({
                                        html: '<div class="mt-2">' +
                                            '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                            ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                            'style="width:120px;height:120px"></lord-icon>' +
                                            '<div class="mt-4 pt-2 fs-15">' +
                                            '<h4>Oops...! </h4>' +
                                            '<p class="text-muted mx-4 mb-0">' + response.message +'</p>' +
                                            '</div>' +
                                            '</div>',
                                        timerProgressBar: !0,
                                        timer: 3000,
                                        showConfirmButton: !1
                                    });
                                }
                            })
                            .fail(function(response){
                                console.log(response)
                            })

                        :
                        t.dismiss === Swal.DismissReason.cancel &&
                        Swal.fire({
                            title: "Cancelled",
                            text: "Service Categories was not removed.",
                            icon: "error",
                            confirmButtonClass: "btn btn-primary mt-2",
                            buttonsStyling: !1
                        });
                });



            });

        });

        function createEditor(id){
            ClassicEditor.create(document.querySelector("#"+id))
                .then( editor => {
                    window.editor = editor;
                    editor.ui.view.editable.element.style.height="200px";
                    editor.model.document.on( 'change:data', () => {
                        $( '#' + id).text(editor.getData());
                    } );
                } )
                .catch(function(e){console.error(e)});
        }


        document.addEventListener("DOMContentLoaded", function() {
            this.querySelectorAll("div.list").forEach(list => {
                let listnum = list.querySelectorAll("li").length;
                if(listnum <= 3){
                    list.querySelector("button").classList.add('hidden');
                }else{
                    list.querySelector("button").classList.remove('hidden');
                }
                list.querySelector("button").addEventListener("click", function() {
                    let blocks = list.querySelectorAll("li");
                    switch(this.value) {
                        case "1":
                            blocks.forEach(block => {
                                if (!block.offsetHeight) block.classList.add("visible");
                            });
                            this.value = 0;
                            this.innerText = this.dataset.hide;
                            break;
                        case "0":
                            blocks.forEach(block => {
                                block.classList.remove("visible");
                            });
                            this.value = 1;
                            this.innerText = this.dataset.show;
                            break;
                    }
                });
            });
        });

    </script>
@endsection



