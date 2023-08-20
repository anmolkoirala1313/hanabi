<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $video_section_elements = VideoGallery::all();
      return view('backend.video_gallery.index',compact('video_section_elements'));

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
        $type = count($request->input('url'));
        for ($i=0;$i<$type;$i++){
            $data=[
                'url'       => $request->input('url')[$i],
                'type'            => $request->input('type')[$i],
                'created_by'      => Auth::user()->id,
            ];
            $status = VideoGallery::create($data);
        }
        if($status){
            Session::flash('success','Video gallery was created successfully');
        }
        else{
            Session::flash('error','Video gallery could not be created.');
        }
        return redirect()->back();
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

    }

    public function videoUpdate(Request $request)
    {
        $type            = count($request->input('url'));
        $db_elements     = json_decode($request->input('video_elements'),true);
        $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);
        for ($i=0;$i<$type;$i++){
            if($request->input('id')[$i] == null){
                $data=[
                    'url'            => $request->input('url')[$i],
                    'type'           => $request->input('type')[$i],
                    'created_by'     => Auth::user()->id,
                ];
                $status = VideoGallery::create($data);
            }
            else{
                $video               = VideoGallery::find($request->input('id')[$i]);
                $video->url          = $request->input('url')[$i];
                $video->type         = $request->input('type')[$i];
                $video->updated_by   = Auth::user()->id;
                $status              = $video->update();
            }
        }
        foreach ($db_elements_id as $key=>$value){
            if(!in_array($value,$request->input('id'))){
                $delete_element = VideoGallery::find($value);
                $status         = $delete_element->delete();
            }
        }
        if($status){
            Session::flash('success','Video gallery was updated successfully');
        }
        else{
            Session::flash('error','Video gallery could not be updated.');
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
