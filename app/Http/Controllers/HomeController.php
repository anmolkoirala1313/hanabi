<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allusers  = User::take(7)->get();
        $menus     = Menu::all()->count();
        $blog_cat  = BlogCategory::all()->count();
        $sliders   = Slider::all()->count();
        $pages     = Page::all()->count();
        $services  = Service::take(5)->latest()->get();
        $nav_services  = Service::take(6)->latest()->get();
        $feeds     = Blog::take(5)->latest()->get();
        return view('backend.dashboard', compact('allusers','nav_services','services','feeds','menus','blog_cat','pages','sliders'));
    }

    public function filemanager()
    {
        return view('backend.filemanager.index');
    }



}
