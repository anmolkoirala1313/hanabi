<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuitems          = '';
        $desiredMenu        = '';
        $menuTitle          = '';
        $pages              = Page::all();
        $services           = Service::all();
        $menus              = Menu::all();
        $blogs              = Blog::all();
        if(isset($_GET['slug']) && $_GET['slug'] != 'new'){
            $id = $_GET['slug'];
            $desiredMenu = Menu::where('slug',$id)->first();
            $menuTitle   = $desiredMenu->title;
            if($desiredMenu->content != ''){
                $menuitems = json_decode($desiredMenu->content);
                if(@$menuitems[0] != null){
                    $menuitems = $menuitems[0];
                    foreach($menuitems as $menu){
                        $menu->title    = MenuItem::where('id',$menu->id)->value('title');
                        $menu->name     = MenuItem::where('id',$menu->id)->value('name');
                        $menu->slug     = MenuItem::where('id',$menu->id)->value('slug');
                        $menu->target   = MenuItem::where('id',$menu->id)->value('target');
                        $menu->type     = MenuItem::where('id',$menu->id)->value('type');
                        if(!empty($menu->children[0])){
                            foreach ($menu->children[0] as $child) {
                                $child->title   = MenuItem::where('id',$child->id)->value('title');
                                $child->name    = MenuItem::where('id',$child->id)->value('name');
                                $child->slug    = MenuItem::where('id',$child->id)->value('slug');
                                $child->target  = MenuItem::where('id',$child->id)->value('target');
                                $child->type    = MenuItem::where('id',$child->id)->value('type');
                                if(!empty($child->children[0])){
                                    foreach ($child->children[0] as $minichild) {
                                        $minichild->title   = MenuItem::where('id',$minichild->id)->value('title');
                                        $minichild->name    = MenuItem::where('id',$minichild->id)->value('name');
                                        $minichild->slug    = MenuItem::where('id',$minichild->id)->value('slug');
                                        $minichild->target  = MenuItem::where('id',$minichild->id)->value('target');
                                        $minichild->type    = MenuItem::where('id',$minichild->id)->value('type');
                                    }
                                }
                            }
                        }
                    }
                }else{
                    $desiredMenu->content = null;
                    $desiredMenu->update();
                }
            }else{
                $menuitems = MenuItem::where('menu_id',$desiredMenu->id)->get();
            }
        }
        else{
            $desiredMenu = Menu::orderby('id','DESC')->first();
            if($desiredMenu !== null){
                $menuTitle   = $desiredMenu->title;
            }else{
                $menuTitle   = "";
            }
            if($desiredMenu){
                if($desiredMenu->content != ''){
                    $menuitems = json_decode($desiredMenu->content);
                    if(@$menuitems[0] != null){
                        $menuitems = $menuitems[0];
                        foreach($menuitems as $menu){
                            $menu->title    = MenuItem::where('id',$menu->id)->value('title');
                            $menu->name     = MenuItem::where('id',$menu->id)->value('name');
                            $menu->slug     = MenuItem::where('id',$menu->id)->value('slug');
                            $menu->target   = MenuItem::where('id',$menu->id)->value('target');
                            $menu->type     = MenuItem::where('id',$menu->id)->value('type');
                            if(!empty($menu->children[0])){
                                foreach ($menu->children[0] as $child) {
                                    $child->title   = MenuItem::where('id',$child->id)->value('title');
                                    $child->name    = MenuItem::where('id',$child->id)->value('name');
                                    $child->slug    = MenuItem::where('id',$child->id)->value('slug');
                                    $child->target  = MenuItem::where('id',$child->id)->value('target');
                                    $child->type    = MenuItem::where('id',$child->id)->value('type');
                                    if(!empty($child->children[0])){
                                        foreach ($child->children[0] as $minichild) {
                                            $minichild->title   = MenuItem::where('id',$minichild->id)->value('title');
                                            $minichild->name    = MenuItem::where('id',$minichild->id)->value('name');
                                            $minichild->slug    = MenuItem::where('id',$minichild->id)->value('slug');
                                            $minichild->target  = MenuItem::where('id',$minichild->id)->value('target');
                                            $minichild->type    = MenuItem::where('id',$minichild->id)->value('type');
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        $desiredMenu->content = null;
                        $desiredMenu->update();
                    }
                }else{
                    $menuitems = MenuItem::where('menu_id',$desiredMenu->id)->get();
                }
            }
        }

        return view('backend.menu.index',compact('pages','services','menuTitle','blogs','menus','desiredMenu','menuitems'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
            'name'                => $request->input('name'),
            'title'               => $request->input('title'),
            'slug'               => $request->input('slug'),
            'created_by'          => Auth::user()->id,
        ];
        $menu = Menu::create($data);
        if($menu){
            Session::flash('success','Menu Created Successfully');
            $newdata = Menu::orderby('id','DESC')->first();
            return redirect("auth/manage-menus?id=$newdata->id");
        }
        else{
            Session::flash('error','Something went wrong. Menu cannot be created');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete    = Menu::find($request->id);
        $status = $delete->delete();
        if($status){
            Session::flash('success','Menu deleted Successfully');
        }else{
            Session::flash('error','Menu could not be deleted');
        }
        return redirect()->route('menu.index');

    }

    public function addPage(Request $request){
        $data       = $request->all();
        $menuid     = $request->menuid;
        $ids        = $request->ids;
        $menu       = Menu::findOrFail($menuid);
        if($menu->content == ''){
//            dd('content empty');
            foreach($ids as $id){
                $page = Page::find($id);
                $data =[
                    'title'          => $page->name,
                    'slug'          => $page->slug,
                    'page_id'        => $id,
                    'type'          => 'page',
                    'menu_id'       => $menuid,
                    'created_by'    => Auth::user()->id,
                ];
                $status = MenuItem::create($data);
            }

        }
        else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                $page = Page::find($id);
                $data =[
                    'title'          => $page->name,
                    'slug'          => $page->slug,
                    'page_id'       => $id,
                    'type'          => 'page',
                    'menu_id'       => $menuid,
                    'created_by'    => Auth::user()->id,
                ];
                $status = MenuItem::create($data);
            }
            foreach($ids as $id){
                $page = Page::find($id);
                $array['title']         = $page->name;
                $array['slug']          = $page->slug;
                $array['page_id']       = $id;
                $array['type']          = 'page';
                $array['id']            = MenuItem::where('slug',$array['slug'])->where('type',$array['type'])->value('id');
                $array['children']      = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $status = $menu->update(['content'=>$olddata]);
            }
        }
        if($status){
            Session::flash('success','Page added in Menu');
        }else{
            Session::flash('error','Page could not be added in Menu');
        }
    }

    public function addService(Request $request){
        $data       = $request->all();
        $menuid     = $request->menuid;
        $ids        = $request->ids;
        $menu       = Menu::findOrFail($menuid);
        if($menu->content == ''){
//            dd('content empty');
            foreach($ids as $id){
                $service = Service::find($id);
                $data = [
                    'title'          => $service->title,
                    'slug'           => $service->slug,
                    'service_id'     => $id,
                    'type'           => 'service',
                    'menu_id'        => $menuid,
                    'created_by'     => Auth::user()->id,
                ];
                $status = MenuItem::create($data);
            }

        }
        else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                $service = Service::find($id);
                $data =[
                    'title'         => $service->title,
                    'slug'          => $service->slug,
                    'service_id'    => $id,
                    'type'          => 'service',
                    'menu_id'       => $menuid,
                    'created_by'    => Auth::user()->id,
                ];
                $status = MenuItem::create($data);
            }
            foreach($ids as $id){
                $service = Service::find($id);
                $array['title']         = $service->title;
                $array['slug']          = $service->slug;
                $array['service_id']    = $id;
                $array['type']          = 'service';
                $array['id']            = MenuItem::where('slug',$array['slug'])->where('type',$array['type'])->value('id');
                $array['children']      = [[]];
                array_push($olddata[0],$array);
                $oldata = json_encode($olddata);
                $status = $menu->update(['content'=>$olddata]);
            }
        }
        if($status){
            Session::flash('success','Service added in Menu');
        }else{
            Session::flash('error','Service could not be added in Menu');
        }
    }

    public function addPost(Request $request){
        $data           = $request->all();
        $menuid         = $request->menuid;
        $ids            = $request->ids;
        $menu           = Menu::findOrFail($menuid);
        if($menu->content == ''){
            foreach($ids as $id){
                $post = Blog::find($id);
                $data =[
                    'title'         => $post->title,
                    'slug'          => $post->slug,
                    'blog_id'       => $id,
                    'type'          => 'post',
                    'menu_id'       => $menuid,
                    'created_by'    => Auth::user()->id,
                ];
                $status  = MenuItem::create($data);
            }
        }else{
            $olddata = json_decode($menu->content,true);
            foreach($ids as $id){
                $post = Blog::find($id);
                $data =[
                    'title'         => $post->title,
                    'slug'          => $post->slug,
                    'blog_id'       => $id,
                    'type'          => 'post',
                    'menu_id'       => $menuid,
                    'created_by'    => Auth::user()->id,
                ];
                $status  = MenuItem::create($data);
            }
            foreach($ids as $id){
                $post               = Blog::find($id);
                $array['title']     = $post->title;
                $array['slug']      = $post->slug;
                $array['blog_id']   = $post->id;
                $array['type']      = 'post';
                $array['id']        = MenuItem::where('slug',$array['slug'])->where('type',$array['type'])->orderby('id','DESC')->value('id');
                $array['children']  = [[]];
                array_push($olddata[0],$array);
                $oldata             = json_encode($olddata);
                $status             = $menu->update(['content'=>$olddata]);
            }
        }

        if($status){
            Session::flash('success','Post added in Menu');
        }else{
            Session::flash('error','Posts could not be added in Menu');
        }
    }

    public function addCustomLink(Request $request){
        $data       = $request->all();
        $menuid     = $request->menuid;
        $menu       = Menu::findOrFail($menuid);
        if($menu->content == ''){
            $data =[
                'title'         => $request->url_text,
                'slug'          => $request->url,
                'type'          => 'custom',
                'menu_id'       => $menuid,
                'created_by'    => Auth::user()->id,
            ];
            $status = MenuItem::create($data);
        }else{
            $olddata = json_decode($menu->content,true);
            $data =[
                'title'         => $request->url_text,
                'slug'          => $request->url,
                'type'          => 'custom',
                'menu_id'       => $menuid,
                'created_by'    => Auth::user()->id,
            ];
            MenuItem::create($data);
            $array = [];
            $array['title']     = $request->url_text;
            $array['slug']      = $request->url;
            $array['type']      = 'custom';
            $array['id']        = MenuItem::where('slug',$array['slug'])->where('type',$array['type'])->orderby('id','DESC')->value('id');
            $array['children']  = [[]];
            array_push($olddata[0],$array);
            $oldata = json_encode($olddata);
            $status = $menu->update(['content'=>$olddata]);
        }

        if($status){
            Session::flash('success','Custom link added in Menu');
        }else{
            Session::flash('error','Custom link could not be added in Menu');
        }
    }

    public function updateMenu(Request $request){
        $newdata                = $request->all();
        $menu                   = Menu::findOrFail($request->menuid);
        $content                = $request->data;
        $newdata                = [];
        $newdata['location']    = $request->location;
        $newdata['title']       = $request->title;
        $newdata['content']     = json_encode($content);
        $status = $menu->update($newdata);
        if($status){
            Session::flash('success','Menu Updated Successfully');
        }else{
            Session::flash('error','Menu could not be updated');
        }
    }

    public function updateMenuItem(Request $request){
        $data           = $request->all();
        $target         = $request->input('target');
        $item           = MenuItem::findOrFail($request->id);
        if($target == null){
            $data['target'] = NULL;
        }
        $status         = $item->update($data);
        if($status){
            Session::flash('success','Menu Item Updated Successfully');
        }else{
            Session::flash('error','Menu Item could not be updated');
        }
        return redirect()->back();
    }

    public function deleteMenuItem($id,$key,$in='',$inside=''){
        $menuitem       = MenuItem::findOrFail($id);
        $menus          = Menu::where('id',$menuitem->menu_id)->first();


        if($menus->content != ''){
            $data       = json_decode($menus->content,true);
            if($in == ''){

                //collecting the inner child ID to remove them from table
                $childarray = array();
                if(array_key_exists('children', $data[0][$key])) {
                    //first child of the main menu (second layer)
                    foreach ($data[0][$key]['children'][0] as $k=>$child){
                        $childarray[] = $child['id'];
                        //looping through that child list to check if it has inner child (third layer)
                        if (array_key_exists('children', $data[0][$key]['children'][0][$k])){
                            //if second layer has children, then looping through them to get its ID
                            foreach ($data[0][$key]['children'][0][$k]['children'][0] as $l=>$inner){
                                $childarray[] = $inner['id'];
                            }
                        }
                    }
                }

                if($childarray){
                    //removing the collected item list ID here
                    foreach ($childarray as $id){
                        $childitem = MenuItem::find($id);
                        $childitem->delete();
                    }
                }

                unset($data[0][$key]);
                //removing the ID from the structure
                $newdata = json_encode($data);
                $menus->update(['content'=>$newdata]);
            }
            else if($inside == ''){

                //checking if the removed menu child item has additional child or not.
                if(array_key_exists('children', $data[0][$key]['children'][0][$in])){
                    //if it does, looping over value to get the menu items ID and keeping it in array to remove them later.
                    foreach ($data[0][$key]['children'][0][$in]['children'][0] as $child) {
                        foreach ($child as $c){
                            $childitem = MenuItem::findOrFail($c);
                            $childitem->delete();
                        }
                    }
                }
                //removing the deleted menu item and its children from the menu content structure
                unset($data[0][$key]['children'][0][$in]);
                $newdata = json_encode($data);
                $menus->update(['content'=>$newdata]);
            }else{
                unset($data[0][$key]['children'][0][$in]['children'][0][$inside]);
                $newdata = json_encode($data);
                $menus->update(['content'=>$newdata]);
            }
        }

        //deleting the menu item here
        $status = $menuitem->delete();
        if($status){
            Session::flash('success','Menu Item Deleted Successfully');

        }else{
            Session::flash('error','Menu Item could not be Deleted');
        }
        return redirect()->back();
    }

}
