@extends('backend.layouts.master')
@section('title', "Menu")
@section('css')
    <link rel="stylesheet" href="{{asset('assets/backend/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/custom_css/datatable_style.css')}}">
    <link href="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .disabled{pointer-events: none; opacity: 0.7;}
        .hidden{
            display: none;
        }
        .pull-right{
            float: right;
        }
        .menu-item-bar{cursor: move;display: block;}
        #serialize_output{display: none;}
        body.dragging, body.dragging * {cursor: move !important;}
       .list-group-item{
           position: unset;
           padding: 0.9rem 0.7rem 0.7rem 0.7rem;
       }

    </style>
@endsection
@section('content')
    <div class="page-content">
        <?php
        $slug_to_disable = [];
        if($desiredMenu !== null){
            $slug_to_disable = get_slugs_to_disable($desiredMenu->slug);
        }
        ?>
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Manage Menu</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Manage Menu</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row g-4">
                @if(count($menus) > 0)
                <div class="col-sm-auto">
                    <div>
                        <button data-bs-toggle="modal" data-bs-target="#createMenu" class="btn btn-success">
                            <i class="ri-add-fill align-bottom me-1"></i> Create Menu</button>
                    </div>
                </div>
                <div class="col-sm">
                    {!! Form::open(['route' => 'menu.index','method'=>'get','class'=>'needs-validation','id'=>'basic-form','novalidate'=>'']) !!}

                    <div class="d-flex justify-content-sm-end gap-2">
                        <select class="form-control w-md" name="slug" data-choices="" data-choices-search-false="">
                            <option value disabled selected>Select Menu</option>
                            @foreach($menus as $menu)
                                @if($desiredMenu !== '')
                                    <option value="{{$menu->slug}}" @if($menu->id == $desiredMenu->id) selected @endif>{{ucwords(@$menu->name)}}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="gap-2">
                            <button type="submit" class="btn btn-success"><i class=" ri-check-double-fill me-1 align-bottom"></i> Select</button>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
                @else
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end gap-2">
                            <div>
                                <h5 class="fs-14 mb-2">Create your menu and items here.</h5>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h5 class="fs-16">Menu Items</h5>
                                </div>
                            </div>

                        </div>

                        <div class="accordion accordion-flush">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingBrands">
                                    <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="false" aria-controls="flush-collapseBrands">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Pages </span> <span class="badge bg-success rounded-pill align-middle ms-1">{{count($pages)}}</span>
                                    </button>
                                </h2>

                                <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands" style="">
                                    <div class="accordion-body {{(count($menus) == 0) ? 'disabled':''}} text-body pt-0" id="page-list">
                                        <div class="d-flex flex-column gap-2 mt-3">
                                            @if(count($pages) !== 0)
                                                @foreach($pages as $page)
                                                    <div class="form-check form-check-outline form-check-success {{(in_array($page->slug, $slug_to_disable)) ? 'disabled':''}}">
                                                        <input class="form-check-input" type="checkbox" id="pages-{{$page->id}}" value="{{$page->id}}" name="select-page[]" {{(count($menus) == 0 || in_array($page->slug, $slug_to_disable)) ? 'disabled':''}}>
                                                        <label class="form-check-label {{(in_array($page->slug, $slug_to_disable)) ? 'disabled':''}}" for="pages-{{$page->id}}"> {{ucfirst($page->name)}}</label>
                                                    </div>
                                                @endforeach
                                                @else
                                                    <div class="pb-2">
                                                        <span class="h6">Please <a href="{{route('pages.index')}}">create a page</a> to add in menu.</span>
                                                    </div>
                                                @endif


                                            <div class="{{(count($pages) == 0) ? 'disabled':''}}">
                                                <label class="btn btn-light btn-sm bg-gradient waves-effect waves-light text-decoration-none"><input type="checkbox" id="select-all-pages" class="hidden"> Select All</label>
                                                <button type="button" class="pull-right btn btn-light bg-gradient waves-effect waves-light btn-sm text-decoration-none pull-right" id="add-pages">Add to Menu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingBrands">
                                    <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="false" aria-controls="flush-collapseBrands">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Services </span> <span class="badge bg-success rounded-pill align-middle ms-1">{{count($services)}}</span>
                                    </button>
                                </h2>

                                <div id="flush-collapseBrands" class="accordion-collapse collapse" aria-labelledby="flush-headingBrands" style="">
                                    <div class="accordion-body {{(count($menus) == 0) ? 'disabled':''}} text-body pt-0" id="service-list">
                                        <div class="d-flex flex-column gap-2 mt-3">
                                            @if(count($services) !== 0)
                                                @foreach($services as $service)
                                                    <div class="form-check form-check-outline form-check-success {{(in_array($service->slug, $slug_to_disable)) ? 'disabled':''}}">
                                                        <input class="form-check-input" type="checkbox" id="service-{{$service->id}}" value="{{$service->id}}" name="select-service[]" {{(count($menus) == 0 || in_array($service->slug, $slug_to_disable)) ? 'disabled':''}}>
                                                        <label class="form-check-label {{(in_array($service->slug, $slug_to_disable)) ? 'disabled':''}}" for="service-{{$service->id}}"> {{ucfirst($service->title)}}</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="pb-2">
                                                    <span class="h6">Please <a href="{{route('services.index')}}">create a service</a> to add in menu.</span>
                                                </div>
                                            @endif


                                            <div class="{{(count($services) == 0) ? 'disabled':''}}">
                                                <label class="btn btn-light btn-sm bg-gradient waves-effect waves-light text-decoration-none"><input type="checkbox" id="select-all-services" class="hidden"> Select All</label>
                                                <button type="button" class="pull-right btn btn-light bg-gradient waves-effect waves-light btn-sm text-decoration-none pull-right" id="add-service">Add to Menu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingDiscount">
                                    <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Posts</span> <span class="badge bg-success rounded-pill align-middle ms-1">{{count($blogs)}}</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseDiscount" class="accordion-collapse collapse" aria-labelledby="flush-headingDiscount">
                                    <div class="accordion-body {{(count($menus) == 0) ? 'disabled':''}} text-body pt-1"  id="posts-list">
                                        <div class="d-flex flex-column gap-2">
                                            @if(count($blogs) !== 0)
                                                @foreach($blogs as $blog)
                                                    <div class="form-check form-check-outline form-check-success {{(in_array($blog->slug, $slug_to_disable)) ? 'disabled':''}}">
                                                        <input class="form-check-input" name="select-post[]" value="{{$blog->id}}" type="checkbox" id="posts-{{$blog->id}}" {{(count($menus) == 0 || in_array($blog->slug, $slug_to_disable)) ? 'disabled':''}} >
                                                        <label class="form-check-label {{(in_array($blog->slug, $slug_to_disable)) ? 'disabled':''}}" for="posts-{{$blog->id}}">
                                                            {{$blog->title}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="pb-2">
                                                    <span class="h6">Please <a href="{{route('blog.index')}}">create a blog</a> to add in menu.</span>
                                                </div>
                                            @endif
                                                <div  class="{{(count($blogs) == 0) ? 'disabled':''}}">
                                                    <label class="btn btn-light bg-gradient waves-effect waves-light btn-sm text-decoration-none"><input type="checkbox" id="select-all-posts" class="hidden"> Select All</label>
                                                    <button type="button" class="pull-right btn btn-light bg-gradient waves-effect waves-light btn-sm text-decoration-none pull-right" id="add-posts">Add to Menu</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingRating">
                                    <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false" aria-controls="flush-collapseRating">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Custom Links</span>
                                    </button>
                                </h2>

                                <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                                    <div class="accordion-body text-body {{(count($menus) == 0) ? 'disabled':''}}">
                                        <div class="d-flex flex-column gap-2">
                                            <div>
                                                <label for="borderInputURL" class="form-label">URL</label>
                                                <input type="url" name="url" class="form-control border-dashed" id="borderInputURL" placeholder="Enter your URL">
                                                <div class="invalid-feedback" id="custom-slug">
                                                    Please enter the url.
                                                </div>
                                            </div>
                                            <div>
                                                <label for="borderInputURLtext" class="form-label">URL Text</label>
                                                <input type="url" name="url_text" class="form-control border-dashed" id="borderInputURLtext" placeholder="Enter your URL Text">
                                                <div class="invalid-feedback" id="custom-name">
                                                    Please enter the url text.
                                                </div>
                                            </div>
                                            <div class="{{(count($menus) == 0) ? 'disabled':''}}">
                                                <button type="button" class="pull-right btn btn-light bg-gradient waves-effect waves-light btn-sm text-decoration-none pull-right" id="add-custom-link">Add to Menu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-8 col-lg-8">
                    <div>
                        <div class="card">
                            <div class="card-header border-bottom-dashed">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="fs-16">Menu Structure</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($desiredMenu == '')
                                    {!! Form::open(['route' => 'menu.store','method'=>'post','id'=>'menu-form','class'=>'needs-validation','novalidate'=>'']) !!}
                                        <div class="mb-3">
                                            <label for="menuname" class="form-label">Menu Name</label>
                                            <input type="text" name="name" class="form-control border-dashed" id="menuname"
                                                   onclick="slugMaker('menuname','menuslug')"
                                                   placeholder="Enter menu name" required>
                                            <div class="invalid-feedback">
                                                Please enter the url text.
                                            </div>
                                        </div>

                                         <div class="mb-3">
                                            <label for="menutitle" class="form-label">Menu Title (for frontend display)</label>
                                            <input type="text" class="form-control border-dashed" id="menutitle" name="title" placeholder="Enter menu title" required>
                                             <div class="invalid-feedback">
                                                 Please enter the menu title.
                                             </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="menuslug" class="form-label">Menu Slug</label>
                                            <input type="text" class="form-control border-dashed" id="menuslug" name="slug" placeholder="Enter menu slug" readonly required>
                                            <div class="invalid-feedback">
                                                Please enter the menu slug.
                                            </div>
                                        </div>
                                        <div class="text-end mt-4 mb-2">
                                            <button type="submit" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Create Menu</button>
                                        </div>
                                    {!! Form::close() !!}
                                @else
                                    <div id="menu-content">
                                        <div style="min-height: 240px;">
                                            <h6 class="mb-2">Select <span class="fw-semibold">Posts, pages or add custom links</span> to menus</h6>
                                            @if($desiredMenu != '')
                                                <ul class="list-group nested-list ui-sortable" id="menuitems">
                                                    @if(!empty($menuitems))
                                                        @foreach(@$menuitems as $key=>$item)
                                                            @if(!empty($item))
                                                            <li data-id="{{@$item->id}}" class="list-group-item nested-1">
                                                                <span class="menu-item-bar"><i class="ri-drag-move-fill align-bottom handle"></i>
                                                                    @if(empty(@$item->name)) {{@$item->title}} @else {{@$item->name}} @endif
                                                                    <a class="pull-right d-block collapsed" data-bs-toggle="collapse"
                                                                            aria-controls="collapse{{@$item->id}}"
                                                                            data-bs-target="#collapse{{@$item->id}}" style="cursor: pointer"><i class="ri-menu-fill"></i></a></span>
                                                                    <div class="mt-2 list-group nested-list collapse" aria-labelledby="collapse{{@$item->id}}" id="collapse{{@$item->id}}">
                                                                        <div class="card list-group-item nested-3">
                                                                            <div class="" id="basic3">
                                                                                <a class="d-block text-dark bold">
                                                                                    Edit details
                                                                                </a>
                                                                            </div>
                                                                            <div class="card-body p-2">
                                                                                {!! Form::open(['method'=>'post','url'=>route('menu.updatemenuitem', @$item->id),'class'=>'needs-validation','novalidate'=>'']) !!}
                                                                                <div class="form-group mb-3">
                                                                                    <label>Link Name </label>
                                                                                    <input type="text" class="form-control border-dashed" name="name" value="@if(empty(@$item->name)) {{@$item->title}} @else {{@$item->name}} @endif">
                                                                                    <div class="invalid-feedback">
                                                                                        Please enter the Link Name.
                                                                                    </div>
                                                                                </div>

                                                                                @if(@$item->type == 'custom')
                                                                                    <div class="form-group mb-3">
                                                                                        <label>URL </label>
                                                                                        <input type="text" class="form-control  border-dashed" name="slug" value="{{$item->slug}}" required>
                                                                                        <div class="invalid-feedback">
                                                                                            Please enter the URL.
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" name="target" value="_blank" id="main-{{@$item->id}}"  @if(@$item->target == '_blank') checked @endif class="custom-control-input">
                                                                                    <label class="custom-control-label" for="main-{{@$item->id}}">
                                                                                        <span class="h6">Open in a new tab</span>
                                                                                    </label>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="{{url('auth/delete-menuitem')}}/{{$item->id}}/{{$key}}" class="btn btn-danger btn-sm btn-label">
                                                                                        <i class=" ri-delete-bin-6-line label-icon align-middle fs-16 me-2"></i>Remove</a>

                                                                                    <button type="submit" class="btn btn-success btn-sm btn-label pull-right ">
                                                                                        <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Save</button>
                                                                                </div>

                                                                                {!! Form::close() !!}

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <ul class="list-group col nested-list children-content">
                                                                    @if(isset($item->children))
                                                                        @foreach(@$item->children as $m)
                                                                            @foreach($m as $in=>$data)
                                                                                <li data-id="{{$data->id}}" class="list-group-item nested-2 menu-item">
                                                                                    <span class="menu-item-bar">
                                                                                        <i class="ri-drag-move-fill align-bottom handle"></i> @if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif
                                                                                        <a class="pull-right d-block collapsed" data-bs-toggle="collapse"
                                                                                           aria-controls="collapse{{$data->id}}" data-bs-target="#collapse{{$data->id}}" style="cursor: pointer"><i class="ri-menu-fill"></i></a></span>
                                                                                    <div class="list-group nested-list collapse" aria-labelledby="collapse{{$data->id}}" id="collapse{{$data->id}}">
                                                                                        <div class="card list-group-item nested-3">
                                                                                            <div class="" id="basic4">
                                                                                                <a class="d-block text-dark">
                                                                                                    Edit details
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="card-body p-2">
                                                                                                {!! Form::open(['method'=>'post','url'=>route('menu.updatemenuitem', @$data->id),'class'=>'needs-validation','novalidate'=>'']) !!}
                                                                                                <div class="form-group mb-3">
                                                                                                    <label>Link Name </label>
                                                                                                    <input type="text" class="form-control border-dashed" name="name" value="@if(empty($data->name)) {{$data->title}} @else {{$data->name}} @endif">
                                                                                                    <div class="invalid-feedback">
                                                                                                        Please enter the Link Name.
                                                                                                    </div>
                                                                                                </div>

                                                                                                @if($data->type == 'custom')
                                                                                                    <div class="form-group mb-3">
                                                                                                        <label>URL </label>
                                                                                                        <input type="text" class="form-control border-dashed" name="slug" value="{{$data->slug}}" required>
                                                                                                        <div class="invalid-feedback">
                                                                                                            Please enter the URL.
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endif
                                                                                                <div class="custom-control custom-checkbox mb-3">
                                                                                                    <input type="checkbox" name="target" value="_blank" id="main-{{$data->id}}"  @if($data->target == '_blank') checked @endif class="custom-control-input">
                                                                                                    <label class="custom-control-label" for="main-{{$data->id}}">
                                                                                                        <span class="h6">Open in a new tab</span>
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <a href="{{url('auth/delete-menuitem')}}/{{$data->id}}/{{$key}}/{{$in}}" class="btn btn-danger btn-sm btn-label">
                                                                                                        <i class=" ri-delete-bin-6-line label-icon align-middle fs-16 me-2"></i>Remove</a>

                                                                                                    <button type="submit" class="btn btn-success btn-sm btn-label pull-right ">
                                                                                                        <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Save</button>
                                                                                                </div>

                                                                                                {!! Form::close() !!}

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <ul class="list-group nested-list children-content">
                                                                                        @if(isset($data->children))
                                                                                            @foreach($data->children as $o)
                                                                                                @foreach($o as $keys=>$data1)
                                                                                                    <li data-id="{{$data1->id}}" class="menu-item mt-2 list-group-item nested-3">
                                                                                                        <span class="menu-item-bar"><i class="ri-drag-move-fill align-bottom handle"></i> @if(empty($data1->name)) {{$data1->title}} @else {{$data1->name}} @endif

                                                                                                            <a class="pull-right d-block collapsed" data-bs-toggle="collapse"
                                                                                                               aria-controls="collapse{{$data1->id}}" data-bs-target="#collapse{{$data1->id}}" style="cursor: pointer"><i class="ri-menu-fill"></i></a>
                                                                                                        </span>
                                                                                                        <div class="list-group nested-list collapse" aria-labelledby="collapse{{$data1->id}}" id="collapse{{$data1->id}}">
                                                                                                            <div class="card list-group-item nested-3">
                                                                                                                <div class="" id="basic4">
                                                                                                                    <a class="d-block text-dark">
                                                                                                                        Edit details
                                                                                                                    </a>
                                                                                                                </div>
                                                                                                                <div class="card-body p-2">
                                                                                                                    {!! Form::open(['method'=>'post','url'=>route('menu.updatemenuitem', @$data1->id),'class'=>'needs-validation','novalidate'=>'']) !!}
                                                                                                                    <div class="form-group mb-3">
                                                                                                                        <label>Link Name </label>
                                                                                                                        <input type="text" class="form-control border-dashed" name="name" value="@if(empty($data1->name)) {{$data1->title}} @else {{$data1->name}} @endif">
                                                                                                                        <div class="invalid-feedback">
                                                                                                                            Please enter the Link Name.
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                    @if($data1->type == 'custom')
                                                                                                                        <div class="form-group mb-3">
                                                                                                                            <label>URL </label>
                                                                                                                            <input type="text" class="form-control border-dashed" name="slug" value="{{$data1->slug}}" required>
                                                                                                                            <div class="invalid-feedback">
                                                                                                                                Please enter the URL.
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    @endif
                                                                                                                    <div class="custom-control custom-checkbox mb-3">
                                                                                                                        <input type="checkbox" name="target" value="_blank" id="main-{{$data1->id}}"  @if($data1->target == '_blank') checked @endif class="custom-control-input">
                                                                                                                        <label class="custom-control-label" for="main-{{$data1->id}}">
                                                                                                                            <span class="h6">Open in a new tab</span>
                                                                                                                        </label>
                                                                                                                    </div>
                                                                                                                    <div>
                                                                                                                        <a href="{{url('auth/delete-menuitem')}}/{{$data1->id}}/{{$key}}/{{$in}}/{{$keys}}" class="btn btn-danger btn-sm btn-label">
                                                                                                                            <i class=" ri-delete-bin-6-line label-icon align-middle fs-16 me-2"></i>Remove</a>

                                                                                                                        <button type="submit" class="btn btn-success btn-sm btn-label pull-right ">
                                                                                                                            <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Save</button>
                                                                                                                    </div>

                                                                                                                    {!! Form::close() !!}

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </ul>
                                                                                </li>
                                                                            @endforeach
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            @endif
                                        </div>
                                        @if($desiredMenu != '')

                                            <div class="mb-3 mt-3">
                                                <label for="edit-title" class="form-label">Edit Title (for frontend display)</label>
                                                <input type="text" name="title" class="form-control border-dashed" id="edit-title" value="{{@$menuTitle}}" placeholder="Enter menu title" required>
                                                <div class="invalid-feedback">
                                                    Please enter the menu title.
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <label class="form-label">Select Menu Location: </label>

                                                <div class="col-lg-2">
                                                    <div class="form-check form-radio-outline form-radio-success mb-3 ">
                                                        <input class="form-check-input" type="radio" name="location" id="header-one" value="1" @if($desiredMenu->location == 1) checked @endif>
                                                        <label class="form-check-label" for="header-one">
                                                            Header Menu
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10">
                                                    <div class="form-check form-radio-outline form-radio-success mb-3">
                                                        <input class="form-check-input" type="radio" name="location" id="footer-one" value="2" @if($desiredMenu->location == 2) checked @endif>
                                                        <label class="form-check-label" for="footer-one">
                                                            Footer Menu
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <a href="{{route('menu.delete',$desiredMenu->id)}}" id="deleteMenu" class="btn btn-danger btn-label">
                                                    <i class=" ri-delete-bin-6-line label-icon align-middle fs-16 me-2"></i>Remove Menu</a>

                                                <button type="button" id="saveMenu" class="btn btn-success btn-label pull-right @if(count(@$slug_to_disable) == 0  ) disabled @endif">
                                                    <i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Save Menu</button>
                                            </div>

                                        @endif

                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="serialize_output">@if(@$desiredMenu){{@$desiredMenu->content}}@endif</div>

    @include('backend.menu.modals.create')



@endsection

@section('js')
    <script src="{{asset('assets/backend/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/pages/form-validation.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/backend/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/jquery-sortable.js')}}"></script>
    <script>

        //settings for sortable JS
        var group = $("#menuitems").sortable({
            group: 'serialization',
            isValidTarget: function ($item, container) {
                //for limiting the depth of the UL child
                var depth = 1, // Start with a depth of one (the element itself)
                    maxDepth = 3,
                    children = $item.find('ul').first().find('li');


                // Add the amount of parents to the depth
                depth += container.el.parents('ul').length;

                // Increment the depth for each time a child
                while (children.length) {
                    depth++;
                    children = children.find('ul').first().find('li');
                }

                return depth <= maxDepth;
            },
            onDrop: function ($item, container, _super) {
                var data = group.sortable("serialize").get();
                var jsonString = JSON.stringify(data, null, ' ');
                $('#serialize_output').text('').text(jsonString);
                //for animation
                var $clonedItem = $('<li/>').css({height: 0});
                $item.before($clonedItem);
                $clonedItem.animate({'height': '3'});

                $item.animate($clonedItem.position(), function  () {
                    $clonedItem.detach();
                    _super($item, container);
                });
            },
            //for animation
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
            var $data = group.sortable("serialize").get();
            var jsonString = JSON.stringify($data, null, ' ');
            $('#serialize_output').text('').text(jsonString);
        });

        $('#select-all-pages').click(function(event) {
            if(this.checked) {
                $('#page-list :checkbox:not(:disabled)').each(function() {
                    this.checked = true;
                });
            }else{
                $('#page-list :checkbox:not(:disabled)').each(function() {
                    this.checked = false;
                });
            }
        });

        $('#select-all-services').click(function(event) {
            if(this.checked) {
                $('#service-list :checkbox:not(:disabled)').each(function() {
                    this.checked = true;
                });
            }else{
                $('#service-list :checkbox:not(:disabled)').each(function() {
                    this.checked = false;
                });
            }
        });

        $('#select-all-posts').click(function(event) {
            if(this.checked) {
                $('#posts-list :checkbox:not(:disabled)').each(function() {
                    this.checked = true;
                });
            }else{
                $('#posts-list :checkbox:not(:disabled)').each(function() {
                    this.checked = false;
                });
            }
        });

        @if($desiredMenu)
            $('#add-pages').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var n       = $('input[name="select-page[]"]:checked').length;
                var array   = $('input[name="select-page[]"]:checked');
                var ids     = [];

                if(n == 0){
                    return false;
                }

                for(var i=0;i<n;i++){
                    ids[i] =  array.eq(i).val();
                }

                if(ids.length == 0){
                    return false;
                }

                $.ajax({
                    type:"get",
                    data: {menuid:menuid,ids:ids},
                    url: "{{route('menu.page')}}",
                    success:function(res){
                        location.reload();
                    }
                });
            });

            $('#add-service').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var n       = $('input[name="select-service[]"]:checked').length;
                var array   = $('input[name="select-service[]"]:checked');
                var ids     = [];

                if(n == 0){
                    return false;
                }

                for(var i=0;i<n;i++){
                    ids[i] =  array.eq(i).val();
                }

                if(ids.length == 0){
                    return false;
                }

                $.ajax({
                    type:"get",
                    data: {menuid:menuid,ids:ids},
                    url: "{{route('menu.service')}}",
                    success:function(res){
                        location.reload();
                    }
                });
            });

            $('#add-posts').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var n       = $('input[name="select-post[]"]:checked').length;
                var array   = $('input[name="select-post[]"]:checked');
                var ids     = [];

                if(n == 0){
                    return false;
                }

                for(var i=0;i<n;i++){
                    ids[i] =  array.eq(i).val();
                }

                if(ids.length == 0){
                    return false;
                }

                $.ajax({
                    type:"get",
                    data: {menuid:menuid,ids:ids},
                    url: "{{route('menu.post')}}",
                    success:function(res){
                        location.reload();
                    }
                });

            });

            $("#add-custom-link").click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var url = $('#borderInputURL').val();
                var url_text = $('#borderInputURLtext').val();

                if(url_text !== ''){
                    $("#custom-name").hide();
                }else{
                    $("#custom-name").show();
                }

                if(url !== ''){
                    $("#custom-slug").hide();
                    $.ajax({
                        type:"get",
                        data: {menuid:menuid,url:url,url_text:url_text},
                        url: "{{route('menu.custom')}}",
                        success:function(res){
                            location.reload();
                        }
                    });
                } else {
                    $("#custom-slug").show();
                }
            });

            $('#saveMenu').click(function(){
                var menuid  = "{{$desiredMenu->id}}";
                var location = $('input[name="location"]:checked').val();
                var title = $('input[name="title"]').val();
                if(title == ""){
                    Toastify({ newWindow: !0, text: "Please enter the title to save the menu !", gravity: 'top', position: 'center', stopOnFocus: !0, duration: 3000, close: "close",className: "bg-warning" }).showToast();
                    return false;
                }
                if(location == null){
                    Toastify({ newWindow: !0, text: "Please enter the location to save the menu !", gravity: 'top', position: 'center', stopOnFocus: !0, duration: 3000, close: "close",className: "bg-warning" }).showToast();
                    return false;
                }
                var data = JSON.parse($("#serialize_output").text());
                $.ajax({
                    type:"get",
                    data: {menuid:menuid,data:data,location:location,title:title},
                    url: "{{route('menu.updateMenu')}}",
                    success:function(res){
                        window.location.reload();
                    }
                });
            });
        @endif

    </script>

@endsection
