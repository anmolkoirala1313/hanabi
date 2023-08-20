<?php

namespace App\Http\Controllers;


use App\Models\Job;
use App\Models\TestPreparation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;


class TestPreparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $path;
    private $thumbpath;
    protected TestPreparation $model;
    public function __construct(TestPreparation $testPreparation)
    {
        $this->middleware('auth');
        $this->path         = public_path('/images/test_preparation');
        $this->thumbpath    = public_path('/images/test_preparation/thumb');
        $this->model        = $testPreparation;
    }
    public function index()
    {
        $rows      = $this->model->orderBy('created_at','desc')->get();

        return view('backend.test_preparation.index',compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('backend.test_preparation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->request->add(['created_by' => auth()->user()->id ]);
            $request->request->add(['slug' => $this->model->changeToSlug($request->input('title')) ]);

            if(!empty($request->file('image_input'))){
                $image        = $request->file('image_input');
                $name         = uniqid().'_test_'.$image->getClientOriginalName();
                if (!is_dir($this->path)) {
                    mkdir($this->path, 0777);
                }
                if (!is_dir($this->thumbpath)) {
                    mkdir($this->thumbpath, 0777);
                }
                $thumb         = 'thumb_'.$name;
                $path          = base_path().'/public/images/test_preparation/';
                $thumb_path    = base_path().'/public/images/test_preparation/thumb/';
                $moved         = Image::make($image->getRealPath())->fit(775, 400)->orientate()->save($path.$name);
                $thumb         = Image::make($image->getRealPath())->fit(370, 238)->orientate()->save($thumb_path.$thumb);

                if ($moved && $thumb){
                    $request->request->add(['image' => $name ]);
                }
            }

            $this->model->create($request->all());

            DB::commit();

            Session::flash('success','Test Preparation details Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            Session::flash('error','Test Preparation details Creation Failed');
        }

        return redirect()->route('test-preparation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit($id)
    {
        $edit           = $this->model->find($id);

        return view('backend.test_preparation.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $test                        = $this->model->find($id);
        DB::beginTransaction();
        try {
            $request->request->add(['updated_by' => auth()->user()->id ]);
            $request->request->add(['slug' => $this->model->changeToSlug($request->input('title')) ]);

            $oldimage                      = $test->image;
            $thumbimage                    = 'thumb_'.$test->image;
            if (!empty($request->file('image_input'))){
                $image                = $request->file('image_input');
                $name                 = uniqid().'_'.$image->getClientOriginalName();
                $thumb                = 'thumb_'.$name;
                $path                 = base_path().'/public/images/test_preparation/';
                $thumb_path           = base_path().'/public/images/test_preparation/thumb/';
                $moved                = Image::make($image->getRealPath())->fit(775, 400)->orientate()->save($path.$name);
                $thumb                = Image::make($image->getRealPath())->fit(370, 238)->orientate()->save($thumb_path.$thumb);

                if ($moved && $thumb){
                    $request->request->add(['image'=> $name]);

                    if (!empty($oldimage) && file_exists(public_path().'/images/test_preparation/'.$oldimage)){
                        @unlink(public_path().'/images/test_preparation/'.$oldimage);
                    }

                    if (!empty($thumbimage) && file_exists(public_path().'/images/test_preparation/thumb/'.$thumbimage)){
                        @unlink(public_path().'/images/test_preparation/thumb/'.$thumbimage);
                    }
                }
            }

            $test->update($request->all());

            DB::commit();
            Session::flash('success','Test Preparation details was updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error','Test Preparation details was not updated. Something went wrong.');
        }

        return redirect()->route('test-preparation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete       = TestPreparation::find($id);
        $rid          = $delete->id;
        $thumbimage   = 'thumb_'.$delete->image;

        if (!empty($delete->image) && file_exists(public_path().'/images/test_preparation/'.$delete->image)){
            @unlink(public_path().'/images/test_preparation/'.$delete->image);
        }
        if (!empty($thumbimage) && file_exists(public_path().'/images/test_preparation/thumb/'.$thumbimage)){
            @unlink(public_path().'/images/test_preparation/thumb/'.$thumbimage);
        }
        $recuuu          = $delete->delete();
        if($recuuu){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Test Preparation details has been removed! ']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Test Preparation details could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id){
        $course          = TestPreparation::find($id);
        $course->status  = $request->status;
        $status          = $course->update();
        $new_status      = ($course->status == 'draft') ? "Draft":"Published";
        $value           = ($course->status == 'draft') ? "publish":"draft";
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id,'value'=>$value]);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id,'value'=>$value]);
        }

        return response()->json($confirmed);

    }
}
