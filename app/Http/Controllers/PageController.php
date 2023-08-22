<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionElement;
use App\Models\SectionGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path;
    public function __construct()
    {
        $this->middleware('auth');
        $this->path   = public_path('/images/page');
    }

    public function index()
    {
        $pages = Page::latest('created_at')->get();
        return view('backend.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = Page::where('slug', $request->input('slug'))->first();
        if (!empty($slug)) {
            $status = 'warning';
            return response()->json(['status' => $status, 'message' => 'The page slug is already in use ! Create a new Page.']);
        } else {
            $data = [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'status' => $request->input('status'),
                'created_by' => Auth::user()->id,
            ];

            if(!empty($request->file('image'))){
                $image          = $request->file('image');
                $name           = uniqid().'_'.$image->getClientOriginalName();
                if (!is_dir($this->path)) {
                    mkdir($this->path, 0777);
                }
                $thumb          = 'thumb_'.$name;
                $path           = base_path().'/public/images/page/';
                $moved          = Image::make($image->getRealPath())->fit(1920, 400)->orientate()->save($path.$name);
                if ($moved){
                    $data['image']=$name;
                }
            }
            $status = Page::create($data);
            $sections = $request->input('sorted_sections');
            $pos = $request->position;
            $page = Page::latest()->first();
            $listval2 = ($request->input('list_number_2') == null) ? 2 : $request->input('list_number_2');
            $listval3 = ($request->input('list_number_3') == null) ? 3 : $request->input('list_number_3');
            $process_sel = ($request->input('list_number_3_process_sel') == null) ? 3 : $request->input('list_number_3_process_sel');
            $recruitment_num = ($request->input('recruitment_process_num') == null) ? 4 : $request->input('recruitment_process_num');
            $gallery_heading = $request->input('gallery_heading');
            $gallery_subheading = $request->input('gallery_subheading');

            if ($sections !== null) {
                foreach ($sections as $key => $value) {
                    $section_name = str_replace("_", " ", $value);
                    if ($value == 'accordion_section_2') {
                        $section_status = PageSection::create([
                            'section_name' => $section_name,
                            'section_slug' => $value,
                            'list_number_2' => $listval2,
                            'position' => $pos[$key],
                            'page_id' => $page->id,
                            'created_by' => Auth::user()->id,
                        ]);

                    } elseif ($value == 'small_box_description') {
                        $section_status = PageSection::create([
                            'section_name' => $section_name,
                            'section_slug' => $value,
                            'list_number_3' => $process_sel,
                            'position' => $pos[$key],
                            'page_id' => $page->id,
                            'created_by' => Auth::user()->id,
                        ]);
                    } elseif ($value == 'slider_list') {
                        $section_status = PageSection::create([
                            'section_name' => $section_name,
                            'section_slug' => $value,
                            'list_number_3' => $listval3,
                            'position' => $pos[$key],
                            'page_id' => $page->id,
                            'created_by' => Auth::user()->id,
                        ]);
                    } elseif ($value == 'recruitment_process_num') {
                        $section_status = PageSection::create([
                            'section_name' => $section_name,
                            'section_slug' => $value,
                            'list_number_1' => $recruitment_num,
                            'position' => $pos[$key],
                            'page_id' => $page->id,
                            'created_by' => Auth::user()->id,
                        ]);
                    } elseif ($value == 'gallery_section') {
                        $section_status = PageSection::create([
                            'section_name' => $section_name,
                            'section_slug' => $value,
                            'gallery_heading' => $gallery_heading,
                            'gallery_subheading' => $gallery_subheading,
                            'position' => $pos[$key],
                            'page_id' => $page->id,
                            'created_by' => Auth::user()->id,
                        ]);
                    } else {
                        $section_status = PageSection::create([
                            'section_name' => $section_name,
                            'section_slug' => $value,
                            'page_id' => $page->id,
                            'position' => $pos[$key],
                            'created_by' => Auth::user()->id,
                        ]);
                    }
                }
            } else {
                $section_status = PageSection::create([
                    'section_name' => 'basic section',
                    'section_slug' => 'basic_section',
                    'page_id' => $page->id,
                    'position' => 1,
                    'created_by' => Auth::user()->id,
                ]);
            }
            if ($status && $section_status) {
                Session::flash('success', ucfirst($page->name) . ' Page with section(s) Created Successfully');
            } else {
                Session::flash('error', 'Page with section(s) could not be created Successfully');
            }

            return route('pages.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $sections = array();
        $ordered_sections = array();
        $list1 = "";
        $list1_id = "";
        $list2 = "";
        $list2_id = "";
        $list3 = "";
        $list3_id = "";
        $list4 = "";
        $list4_id = "";
        $slider_type = "";
        $process_number = "";
        $process_id = "";
        $heading = "";
        $subheading = "";
        $recruitment_process_num = "";
        $recruitment_id = "";
        foreach ($page->sections as $section) {
            $sections[$section->id] = $section->section_slug;
            if ($section->section_slug == 'accordion_section_1') {
                $ordered_sections[$section->section_slug] = 'simple_accordian_tab.png';
                $list1 = $section->list_number_1;
                $list1_id = $section->id;
            } elseif ($section->section_slug == 'accordion_section_2') {
                $ordered_sections[$section->section_slug] = 'simple_accordian_tab2.png';
                $list2 = $section->list_number_2;
                $list2_id = $section->id;
            } elseif ($section->section_slug == 'slider_list') {
                $ordered_sections[$section->section_slug] = 'list_option_1.png';
                $list3 = $section->list_number_3;
                $list3_id = $section->id;
                $slider_type = $section->list_number_1;
            } elseif ($section->section_slug == 'icon_and_title') {
                $ordered_sections[$section->section_slug] = 'icon_and_title.png';
                $list4 = $section->list_number_4;
                $list4_id = $section->id;
            } elseif ($section->section_slug == 'small_box_description') {
                $process_number = $section->list_number_3;
                $process_id = $section->id;
                $ordered_sections[$section->section_slug] = 'small_box_description.png';
            } elseif ($section->section_slug == 'contact_information') {
                $ordered_sections[$section->section_slug] = 'contact_information.png';
            } elseif ($section->section_slug == 'gallery_section') {
                $ordered_sections[$section->section_slug] = 'gallery_section.png';
                $heading = $section->gallery_heading;
                $subheading = $section->gallery_subheading;
            } elseif ($section->section_slug == 'gallery_section_2') {
                $ordered_sections[$section->section_slug] = 'gallery_section_2.png';
            } elseif ($section->section_slug == 'simple_header_and_description') {
                $ordered_sections[$section->section_slug] = 'simple_header_descp.png';
            } elseif ($section->section_slug == 'flash_cards') {
                $ordered_sections[$section->section_slug] = 'mission_vision.png';
            } elseif ($section->section_slug == 'background_image_section') {
                $ordered_sections[$section->section_slug] = 'background_image_section.png';
            } elseif ($section->section_slug == 'call_to_action_2') {
                $ordered_sections[$section->section_slug] = 'call_to_action_2.png';
            } elseif ($section->section_slug == 'call_to_action_1') {
                $ordered_sections[$section->section_slug] = 'calltoaction.png';
            } elseif ($section->section_slug == 'recruitment_process') {
                $ordered_sections[$section->section_slug] = 'recruitment_process.png';
                $recruitment_process_num = $section->list_number_1;
                $recruitment_id = $section->id;
            } elseif ($section->section_slug == 'basic_section') {
                $ordered_sections[$section->section_slug] = 'basic_section.png';
            }
        }

        return view('backend.pages.edit', compact('page', 'recruitment_id','recruitment_process_num','heading', 'subheading', 'process_number', 'process_id', 'ordered_sections', 'slider_type', 'sections', 'list1', 'list2', 'list3', 'list1_id', 'list2_id', 'list3_id', 'list4', 'list4_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $check = Page::find($id);
        $slug = Page::where('slug', $request->input('slug'))->first();
        if (!empty($slug) && $slug->slug !== $check->slug) {
            $status = 'warning';
            return response()->json(['status' => $status, 'message' => 'The page slug is already in use !']);
        } else {
            if (!is_dir($this->path)) {
                mkdir($this->path, 0777);
            }
            $incoming_sections = $request->input('sorted_sections');
            $section = PageSection::where('page_id', $id)->get()->toArray();
            $db_section_slug = array_map(function ($item) {
                return $item['section_slug'];
            }, $section);

            $page = Page::find($id);
            $page->name = $request->input('name');
            $page->slug = $request->input('slug');
            $page->status = $request->input('status');
            $oldimage     = $page->image;
            $pos = $request->position;

            if (!empty($request->file('image'))){
                $image       = $request->file('image');
                $name1       = uniqid().'_'.$image->getClientOriginalName();
                $path        = base_path().'/public/images/page/';
                $moved       = Image::make($image->getRealPath())->fit(1920, 400)->orientate()->save($path.$name1);

                if ($moved){
                    $page->image= $name1;
                    if (!empty($oldimage) && file_exists(public_path().'/images/page/'.$oldimage)){
                        @unlink(public_path().'/images/page/'.$oldimage);
                    }
                }
            }


            $status = $page->update();

            $listval1 = ($request->input('list_number_1') == null) ? 1 : $request->input('list_number_1');
            $listval2 = ($request->input('list_number_2') == null) ? 2 : $request->input('list_number_2');
            $listval3 = ($request->input('list_number_3') == null) ? 3 : $request->input('list_number_3');
            $listval4 = ($request->input('list_number_4') == null) ? 3 : $request->input('list_number_4');
            $slider_type = ($request->input('list_number_1_slider') == null) ? 'slider_list' : $request->input('list_number_1_slider');
            $process_sel = ($request->input('list_number_3_process_sel') == null) ? 3 : $request->input('list_number_3_process_sel');
            $recruitment_process_num = ($request->input('recruitment_process_num') == null) ? 4 : $request->input('recruitment_process_num');
            $gallery_heading = $request->input('gallery_heading');
            $gallery_subheading = $request->input('gallery_subheading');

            if ($incoming_sections !== null) {
                foreach ($incoming_sections as $key => $value) {
                    $section_name = str_replace("_", " ", $value);
                    if (!in_array($value, $db_section_slug)) {
                        if ($value == 'accordion_section_1') {
                            $section_status = PageSection::create(
                                [
                                    'section_name' => $section_name,
                                    'section_slug' => $value,
                                    'list_number_1' => $listval1,
                                    'position' => $pos[$key],
                                    'page_id' => $page->id,
                                    'created_by' => Auth::user()->id,
                                ]);
                        } elseif ($value == 'accordion_section_2') {
                            $section_status = PageSection::create([
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'position' => $pos[$key],
                                'list_number_2' => $listval2,
                                'page_id' => $page->id,
                                'created_by' => Auth::user()->id,
                            ]);

                        } elseif ($value == 'small_box_description') {
                            $section_status = PageSection::create([
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'position' => $pos[$key],
                                'list_number_3' => $process_sel,
                                'page_id' => $page->id,
                                'created_by' => Auth::user()->id,
                            ]);
                        } elseif ($value == 'gallery_section') {
                            $section_status = PageSection::create([
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'gallery_heading' => $gallery_heading,
                                'gallery_subheading' => $gallery_subheading,
                                'position' => $pos[$key],
                                'page_id' => $page->id,
                                'created_by' => Auth::user()->id,
                            ]);
                        } elseif ($value == 'slider_list') {
                            $data = [
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'position' => $pos[$key],
                                'list_number_3' => $listval3,
                                'list_number_1' => $slider_type,
                                'page_id' => $page->id,
                                'created_by' => Auth::user()->id,
                            ];
                            $section_status = PageSection::create($data);
                        } elseif ($value == 'icon_and_title') {
                            $data = [
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'position' => $pos[$key],
                                'list_number_4' => $listval4,
                                'page_id' => $page->id,
                                'created_by' => Auth::user()->id
                            ];
                            $section_status = PageSection::create($data);
                        } elseif ($value == 'recruitment_process') {
                            $data = [
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'position' => $pos[$key],
                                'list_number_1' => $recruitment_process_num,
                                'page_id' => $page->id,
                                'created_by' => Auth::user()->id
                            ];
                            $section_status = PageSection::create($data);
                        } else {
                            $section_status = PageSection::updateOrCreate([
                                'section_name' => $section_name,
                                'section_slug' => $value,
                                'page_id' => $page->id,
                                'position' => $pos[$key],
                                'created_by' => Auth::user()->id,
                            ]);
                        }
                    } else {

                        if ($value == 'accordion_section_1') {
                            $section_element = PageSection::find($request->input('list_1_id'));
                            $section_element->list_number_1 = $request->input('list_number_1');
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        } elseif ($value == 'small_box_description') {
                            $section_element = PageSection::find($request->input('process_sel_id'));
                            $section_element->list_number_3 = $process_sel;
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        } elseif ($value == 'accordion_section_2') {
                            $section_element = PageSection::find($request->input('list_2_id'));
                            $section_element->list_number_2 = $request->input('list_number_2');
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        } elseif ($value == 'slider_list') {
                            $section_element = PageSection::find($request->input('list_3_id'));
                            $section_element->list_number_3 = $request->input('list_number_3');
                            $section_element->list_number_1 = $slider_type;
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        } elseif ($value == 'icon_and_title') {
                            $section_element = PageSection::find($request->input('list_4_id'));
                            $section_element->list_number_4 = $request->input('list_number_4');
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        }elseif ($value == 'recruitment_process') {
                            $section_element = PageSection::find($request->input('recruitment_id'));
                            $section_element->list_number_1 = $request->input('recruitment_process_num');
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        } elseif ($value == 'gallery_section') {
                            $section_element = PageSection::where('page_id', $id)->where('section_slug', $value)->first();
                            $section_element->gallery_heading = $gallery_heading;
                            $section_element->gallery_subheading = $gallery_subheading;
                            $section_element->position = $pos[$key];
                            $section_status = $section_element->update();
                        } else {
                            $update_section = PageSection::where('page_id', $id)->where('section_slug', $value)->first();
                            $update_section->position = $pos[$key];
                            $section_status = $update_section->update();
                        }
                    }
                }


                foreach ($db_section_slug as $dbs) {
                    if (!in_array($dbs, $incoming_sections)) {
                        $delete_section = PageSection::where('page_id', $id)->where('section_slug', $dbs);
                        $sections = PageSection::with('elements')->where('page_id', $id)->where('section_slug', $dbs)->get();
                        foreach ($sections as $section) {
                            if ($section->section_slug == 'basic_section') {
                                $basic_element = SectionElement::where('page_section_id', $section->id)
                                    ->first();
                                if (!empty($basic_element->image) && file_exists(public_path() . '/images/section_elements/basic_section/' . $basic_element->image)) {
                                    @unlink(public_path() . '/images/section_elements/basic_section/' . $basic_element->image);
                                }
                            }
                            if ($section->section_slug == 'background_image_section') {
                                $bgimage_element = SectionElement::where('page_section_id', $section->id)
                                    ->first();
                                if (!empty($bgimage_element->image) && file_exists(public_path() . '/images/section_elements/bgimage_section/' . $bgimage_element->image)) {
                                    @unlink(public_path() . '/images/section_elements/bgimage_section/' . $bgimage_element->image);
                                }
                            }
                            if ($section->section_slug == 'slider_list') {
                                $list1_element = SectionElement::where('page_section_id', $section->id)
                                    ->get();
                                foreach ($list1_element as $elements) {
                                    if (!empty($elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/' . $elements->list_image)) {
                                        @unlink(public_path() . '/images/section_elements/list_1/' . $elements->list_image);
                                    }
                                    if (!empty('thumb_' . $elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/thumb/thumb_' . $elements->list_image)) {
                                        @unlink(public_path() . '/images/section_elements/list_1/thumb/thumb_' . $elements->list_image);
                                    }
                                }
                            }
                            if ($section->section_slug == 'icon_and_title') {
                                $icon = SectionElement::where('page_section_id', $section->id)
                                    ->get();
                                foreach ($icon as $elements) {
                                    if (!empty($elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/' . $elements->list_image)) {
                                        @unlink(public_path() . '/images/section_elements/list_1/' . $elements->list_image);
                                    }
                                }
                            }
                            if ($section->section_slug == 'small_box_description') {
                                $process = SectionElement::where('page_section_id', $section->id)
                                    ->get();
                                foreach ($process as $elements) {
                                    if (!empty($elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/' . $elements->list_image)) {
                                        @unlink(public_path() . '/images/section_elements/list_1/' . $elements->list_image);
                                    }
                                }
                            }
                            if ($section->section_slug == 'gallery_section') {
                                $gallery_element = SectionGallery::where('page_section_id', $section->id)
                                    ->get();
                                foreach ($gallery_element as $elements) {
                                    if (!empty($elements->filename) && !empty($elements->resized_name) && file_exists(public_path() . '/images/section_elements/gallery/' . $elements->filename) && file_exists(public_path() . '/images/section_elements/gallery/' . $elements->resized_name)) {
                                        @unlink(public_path() . '/images/section_elements/gallery/' . $elements->filename);
                                        @unlink(public_path() . '/images/section_elements/gallery/' . $elements->resized_name);
                                    }
                                }
                            }
                            if ($section->section_slug == 'gallery_section_2') {
                                $gallery_element_2 = SectionGallery::where('page_section_id', $section->id)
                                    ->get();
                                foreach ($gallery_element_2 as $elements) {
                                    if (!empty($elements->filename) && !empty($elements->resized_name) && file_exists(public_path() . '/images/section_elements/gallery_2/' . $elements->filename) && file_exists(public_path() . '/images/section_elements/gallery_2/' . $elements->resized_name)) {
                                        @unlink(public_path() . '/images/section_elements/gallery_2/' . $elements->filename);
                                        @unlink(public_path() . '/images/section_elements/gallery_2/' . $elements->resized_name);
                                    }
                                }
                            }

                        }
                        $delete_status = $delete_section->delete();
                    }
                }
            } else {
                $delete_section = PageSection::where('page_id', $id);
                $delete_status = $delete_section->delete();
                $section_status = PageSection::create([
                    'section_name' => 'basic section',
                    'section_slug' => 'basic_section',
                    'position' => 1,
                    'page_id' => $page->id,
                    'created_by' => Auth::user()->id,
                ]);
            }

            if ($status) {
                Session::flash('success', ucfirst($page->name) . ' Page with section(s) is Updated.');
            } else {
                Session::flash('error', 'Page with section(s) could not be updated.');
            }

            return route('pages.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Page::with('sections')->find($id);
        $pageid = $delete->id;
        $oldimage = $delete->image;
        $menuitems = MenuItem::where('page_id', $pageid)->get();
        $menuname = [];

        if (count($menuitems) > 0) {
            foreach ($menuitems as $items) {
                $menu = Menu::find($items->menu_id);
                array_push($menuname, ucwords($menu->name));
            }
            $status = 'Warning';
            return response()->json(['status' => $status, 'message' => 'This page is attached to menu(s). Please remove menu item first to delete this page.', 'name' => $menuname]);
        }

        if (!empty($oldimage) && file_exists(public_path().'/images/page/'.$oldimage)){
            @unlink(public_path().'/images/page/'.$oldimage);
        }

        foreach ($delete->sections as $section) {
            if ($section->section_slug == 'basic_section') {
                $basic_element = SectionElement::where('page_section_id', $section->id)
                    ->first();
                if (!empty($basic_element->image) && file_exists(public_path() . '/images/section_elements/basic_section/' . $basic_element->image)) {
                    @unlink(public_path() . '/images/section_elements/basic_section/' . $basic_element->image);
                }
            }
            if ($section->section_slug == 'background_image_section') {
                $bgimage_element = SectionElement::where('page_section_id', $section->id)
                    ->first();
                if (!empty($bgimage_element->image) && file_exists(public_path() . '/images/section_elements/bgimage_section/' . $bgimage_element->image)) {
                    @unlink(public_path() . '/images/section_elements/bgimage_section/' . $bgimage_element->image);
                }
            }
            if ($section->section_slug == 'small_box_description') {
                $process = SectionElement::where('page_section_id', $section->id)
                    ->get();
                foreach ($process as $elements) {
                    if (!empty($elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/' . $elements->list_image)) {
                        @unlink(public_path() . '/images/section_elements/list_1/' . $elements->list_image);
                    }
                }
            }
            if ($section->section_slug == 'slider_list') {
                $list1_element = SectionElement::where('page_section_id', $section->id)
                    ->get();
                foreach ($list1_element as $elements) {
                    if (!empty($elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/' . $elements->list_image)) {
                        @unlink(public_path() . '/images/section_elements/list_1/' . $elements->list_image);
                    }
                    if (!empty('thumb_' . $elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/thumb/thumb_' . $elements->list_image)) {
                        @unlink(public_path() . '/images/section_elements/list_1/thumb/thumb_' . $elements->list_image);
                    }
                }
            }
            if ($section->section_slug == 'gallery_section') {
                $gallery_element = SectionGallery::where('page_section_id', $section->id)
                    ->get();
                foreach ($gallery_element as $elements) {
                    if (!empty($elements->filename) && !empty($elements->resized_name) && file_exists(public_path() . '/images/section_elements/gallery/' . $elements->filename) && file_exists(public_path() . '/images/section_elements/gallery/' . $elements->resized_name)) {
                        @unlink(public_path() . '/images/section_elements/gallery/' . $elements->filename);
                        @unlink(public_path() . '/images/section_elements/gallery/' . $elements->resized_name);
                    }
                }
            }
            if ($section->section_slug == 'icon_and_title') {
                $icon = SectionElement::where('page_section_id', $section->id)
                    ->get();
                foreach ($icon as $elements) {
                    if (!empty($elements->list_image) && file_exists(public_path() . '/images/section_elements/list_1/' . $elements->list_image)) {
                        @unlink(public_path() . '/images/section_elements/list_1/' . $elements->list_image);
                    }
                }
            }
            if ($section->section_slug == 'gallery_section_2') {
                $gallery_element_2 = SectionGallery::where('page_section_id', $section->id)
                    ->get();
                foreach ($gallery_element_2 as $elements) {
                    if (!empty($elements->filename) && !empty($elements->resized_name) && file_exists(public_path() . '/images/section_elements/gallery_2/' . $elements->filename) && file_exists(public_path() . '/images/section_elements/gallery_2/' . $elements->resized_name)) {
                        @unlink(public_path() . '/images/section_elements/gallery_2/' . $elements->filename);
                        @unlink(public_path() . '/images/section_elements/gallery_2/' . $elements->resized_name);
                    }
                }
            }
        }

        $remove = $delete->delete();
        if ($remove) {
            $status = 'success';
            return response()->json(['status' => $status, 'message' => 'Page has been removed successfully!']);
        } else {
            $status = 'error';
            return response()->json(['status' => $status, 'message' => 'Page could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $page = Page::find($id);
        $page->status = $request->status;
        $status = $page->update();
        if ($status) {
            $confirmed = "yes";
        } else {
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
