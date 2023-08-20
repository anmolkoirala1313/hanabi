<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use Validator;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $photos_path;
    private $album;

    public function __construct()
    {
        $this->middleware('auth');
        $this->album   = public_path('/images/albums/');
        $this->photos_path   = public_path('/images/albums/gallery');
    }



    public function index()
    {
        $albums = Album::with('gallery')->get();
        return view('backend.album.index',compact('albums'));
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
        $rules = ['name' => 'required','slug' => 'required', 'cover_image'=>'required|image'];

        $input = ['name' => null];


        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
          return redirect()->route('album.index')->withErrors($validator)->withInput();
        }

        $file = $request->file('cover_image');
        $random_name = uniqid();
        if (!is_dir($this->album)) {
            mkdir($this->album, 0777);
        }
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }

        $destinationPath = base_path().'/public/images/albums/';
        $extension = $file->getClientOriginalExtension();
        $filename=$random_name.'_cover.'.$extension;
        $uploadSuccess = Image::make($file->getRealPath())->orientate()->fit('500','500')->save($destinationPath.$filename);
        $album = Album::create(array(
          'name' => $request->get('name'),
          'slug' => $request->get('slug'),
          'cover_image' => $filename,
          'created_by'        => Auth::user()->id,

        ));

        if($album){
            Session::flash('success','Your Album was Created Successfully');
        }
        else{
            Session::flash('error','Your Album Creation Failed');
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
        $album = Album::with('gallery')->find($id);
        $albums = Album::with('gallery')->get();
        //dd($album);
        return view('backend.album.show',compact('album','albums'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit   = Album::find($id);
        return response()->json(["edit"=>$edit]);
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

        $album                      =  Album::find($id);
        $album->name               =  $request->input('name');
        $album->slug               =  $request->input('slug');
        $album->updated_by          = Auth::user()->id;
        $oldimage                  = $album->cover_image;


        if (!empty($request->file('cover_image'))){
            $rules = ['cover_image'=>'image'];

            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
              return redirect()->route('album.index')->withErrors($validator)->withInput();
            }

            $image       = $request->file('cover_image');
            $name1       = uniqid().'_cover.'.$image->getClientOriginalExtension();
            $path        = base_path().'/public/images/albums/';
            $moved       = Image::make($image->getRealPath())->orientate()->fit('500','500')->save($path.$name1);

            if ($moved){
                $album->cover_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/albums/'.$oldimage)){
                    @unlink(public_path().'/images/albums/'.$oldimage);
                }

            }
        }

        $status = $album->update();
        if($status){
            Session::flash('success','Your Album was updated successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Your Album could not be Updated');
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
        $deletealbum      = Album::find($id);
        $rid             = $deletealbum->id;

        if (!empty($deletealbum->cover_image) && file_exists(public_path().'/images/albums/'.$deletealbum->cover_image)){
            @unlink(public_path().'/images/albums/'.$deletealbum->cover_image);
        }

        foreach ($deletealbum->gallery as $elements) {
            if (!empty($elements->filename) && !empty($elements->resized_name) && file_exists(public_path() . '/images/albums/gallery/' . $elements->filename) && file_exists(public_path() . '/images/albums/gallery/' . $elements->resized_name)) {
                @unlink(public_path() . '/images/albums/gallery/' . $elements->filename);
                @unlink(public_path() . '/images/albums/gallery/' . $elements->resized_name);
            }
        }
        $delete = $deletealbum->delete();
        if($delete){
            $status ='success';
                return response()->json(['status'=>$status,'message'=>'Album and its gallery has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Album and its gallery could not be removed. Try Again later !']);
        }
        return '#album'.$rid;
    }

    public function uploadGallery(Request $request,$id)
    {
        $album                 =  Album::with('gallery')->find($id);
        if($album==null || $album=="null"){

             return Response::json([
                'message' => 'Album ID Not Found'
            ], 400);
        }

        $photos = $request->file('file');

        if (!is_array($photos)) {
            $photos = [$photos];
        }

        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path, 0777);
        }


        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = $album->name."album_gallery_".date('YmdHis') . uniqid();
            $save_name = $name . '.' . $photo->getClientOriginalExtension();


            Image::make($photo)
                ->orientate()
                ->save($this->photos_path . '/' . $save_name);


            $upload = new AlbumGallery();
            $upload->album_id = $album->id;
            $upload->upload_by = Auth::user()->id;
            $upload->filename = $save_name;
            $upload->resized_name = $save_name;
            $upload->original_name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $upload->save();
        }

        return response()->json(['success'=>$save_name]);

    }


    public function deleteGallery(Request $request)
    {
        $filename = $request->get('filename');
        $uploaded_image = AlbumGallery::where('filename', $filename)->first();

        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $this->photos_path . '/' . $uploaded_image->filename;

        if (file_exists($file_path)) {
            @unlink($file_path);
        }



        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }

        return Response::json(['success' => $filename], 200);
    }

    public function getGallery(Request $request,$id)
    {
        $images = AlbumGallery::where('album_id',$id)->get()->toArray();
        if (count($images) > 0){
            foreach($images as $image){
                $tableImages[] = $image['filename'];
            }
            $storeFolder = public_path('images/albums/gallery/');
            $file_path = public_path('images/albums/gallery/');
            $files = scandir($storeFolder);
            foreach ( $files as $file ) {
                if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                    $obj['name'] = $file;
                    $file_path = public_path('images/albums/gallery/').$file;
                    $obj['size'] = filesize($file_path);
                    $obj['path'] = url('/images/albums/gallery/'.$file);
                    $data[] = $obj;
                }

            }
            return response()->json($data);
        }
    }
}
