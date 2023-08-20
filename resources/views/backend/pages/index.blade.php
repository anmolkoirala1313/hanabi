@extends('backend.layouts.master')
@section('title') Pages @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        /*for image*/
        .avatar-upload{
            max-width: 505px!important;
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
        .image-checkbox .fa {
            position: absolute;
            color: #4A79A3;
            background-color: #fff;
            padding: 5px;
            top: -4px;
            right: -3px;
            border: 4px solid #4A79A3;
            font-size: 21px;
        }
        .image-checkbox-checked .fa {
            display: block !important;
        }

        /*end of checklist design*/

        /*for dropdown list design*/

        .table-responsive {
            white-space: inherit !important;
        }

        .list > ul {
            list-style-type: none;
            width:220px;
            padding-left: 0.5rem;
        }
        .list > ol {
            list-style-type: none;
            padding-left: 0px;
            margin-bottom: 0px;
            width:220px
        }

        .list > ul > li {
            display: block;
            word-wrap: break-word;
        }

        .list > ol > li {
            display: block;
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
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dynamic Pages</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dynamic Pages</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row g-4">
                            <div class="col-sm-auto">
                                <h4 class="card-title mb-0">Page List</h4>

                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div>
                                        <a href="{{route('pages.create')}}" class="btn btn-success"><i class="ri-add-line align-bottom me-1"></i>New Page</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row" >

                            <div class="table-responsive  mt-3 mb-1">
                                <table id="page-index" class="table align-middle table-nowrap table-striped">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Page Name</th>
                                        <th>Slug</th>
                                        <th>Page Sections</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="page-list">
                                    @if(@$pages)
                                        @foreach($pages as  $page)
                                            <td><a href="{{route('section-elements.create',$page->id)}}">{{ucfirst($page->name)}}</a></td>
                                            <td>{{$page->slug}}</td>
                                            <td>

                                                <div class="list">
                                                    <ul>
                                                        @foreach($page->sections as $section)
                                                            <li>{{ucfirst($section->section_name)}}</li>
                                                        @endforeach

                                                    </ul>
                                                    <button class="btn btn-success w-sm" value="1" data-show="More" data-hide="Less">More</button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group view-btn" id="user-status-button-3">
                                                    <button class="btn btn-light dropdown-toggle" style="width: 10em;" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                                        {{(($page->status == 'active') ? "Active":"De-active")}}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside" style="">
                                                        @if($page->status == 'active')
                                                            <li>
                                                                <a class="dropdown-item status-update" hrm-update-action="{{route('pages-status.update',$page->id)}}" href="#" id="deactive"> De-active </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a class="dropdown-item status-update" hrm-update-action="{{route('pages-status.update',$page->id)}}" href="#" id="active"> Active </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>
                                            <td class="">
                                                <div class="col dropdown">
                                                    <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                        <li><a class="dropdown-item" href="{{route('page',$page->slug)}}" target="_blank"><i class=" ri-eye-line align-middle"></i> Frontend View </a></li>
                                                        <li><a class="dropdown-item" href="{{route('pages.edit',$page->id)}}"><i class="ri-edit-line me-2 align-middle"></i>Edit Page</a></li>
                                                        <li><a class="dropdown-item action-delete" hrm-delete-per-action="{{route('pages.destroy',$page->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

{{--                                    <tbody id="service-list">--}}
{{--                                    @if(!empty($services))--}}
{{--                                        @foreach($services as  $service)--}}
{{--                                            <tr id="service-individual-{{@$service->id}}">--}}
{{--                                                <td >--}}
{{--                                                    <img src="{{asset('/images/service/'.@$service->banner_image)}}" alt="{{@$blog->title}}" class="figure-img rounded avatar-lg">--}}
{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    {{ ucwords(@$service->title) }}--}}
{{--                                                </td><td >--}}
{{--                                                    {{ @$service->slug}}--}}
{{--                                                </td>--}}
{{--                                                <td >--}}
{{--                                                    <div class="row">--}}

{{--                                                        <div class="col text-center dropdown">--}}
{{--                                                            <a href="javascript:void(0);" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                                <i class="ri-more-fill fs-17"></i>--}}
{{--                                                            </a>--}}
{{--                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">--}}
{{--                                                                <li><a class="dropdown-item" href="{{route('services.edit',$service->id)}}"><i class="ri-pencil-fill me-2 align-middle"></i>Edit</a></li>--}}
{{--                                                                <li><a class="dropdown-item cs-service-remove" cs-delete-route="{{route('services.destroy',$service->id)}}"><i class="ri-delete-bin-6-line me-2 align-middle"></i>Delete</a></li>--}}
{{--                                                            </ul>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                    </tbody>--}}
                                </table>
                            </div>
                        </div><!--end row-->
                        <form action="#" method="post" id="deleted-form">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->
</div>
@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function () {
            $('#page-index').DataTable({
                paging: true,
                searching: true,
                ordering:  false,
                lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            });

        });

        $(document).on('click','.action-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-per-action');
            form.attr('action',$(this).attr('hrm-delete-per-action'));
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
                            }else if(response.status == 'Warning')
                                Swal.fire({
                                    html: '<div class="mt-2">' +
                                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json"' +
                                        ' trigger="loop" colors="primary:#f06548,secondary:#f7b84b" ' +
                                        'style="width:120px;height:120px"></lord-icon>' +
                                        '<div class="mt-4 pt-2 fs-15">' +
                                        '<h4>'+response.status+' </h4>' +
                                        '<p class="text-muted mx-4 mb-0">' + response.message+'<p> Related Menu: '+response.name+'</p></p>' +
                                        '</div>' +
                                        '</div>',
                                    timerProgressBar: !0,
                                    timer: 3000,
                                    showConfirmButton: !1
                                });

                            else{
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
                        text: "Client was not removed.",
                        icon: "error",
                        confirmButtonClass: "btn btn-primary mt-2",
                        buttonsStyling: !1
                    });
            });



        });

        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == 'deactive'){
                swal({
                    title: "Are You Sure?",
                    text: "Setting the Page status to de-active will prevent them from displaying. \n \n Set their status to Publish to enable the displaying feature!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    statusupdate(url,status);
                });
            }else{
                statusupdate(url,status);
            }

        });

        //end of blog

        function statusupdate(url,status){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "PATCH",
                cache: false,
                data:{
                    status: status,
                },
                success: function(dataResult){
                    if(dataResult == "yes"){
                        swal("Success!", "Page Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Page status",
                            type: "error",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        }, function(){
                            //window.location.href = ""
                            swal.close();
                        })
                    }
                },
                error: function() {
                    swal({
                        title: 'Blog Warning',
                        text: "Error. Could not confirm the status of the Page.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        }


        // image gallery
        // init the state from the input
        $(".image-checkbox").each(function () {
            if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
                $(this).addClass('image-checkbox-checked');
            }
            else {
                $(this).removeClass('image-checkbox-checked');
            }
        });

        // sync the state to the input
        $(".image-checkbox").on("click", function (e) {
            $(this).toggleClass('image-checkbox-checked');
            var $checkbox = $(this).find('input[type="checkbox"]');
            $checkbox.prop("checked",!$checkbox.prop("checked"))

            e.preventDefault();
        });

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



