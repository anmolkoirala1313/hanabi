<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\CourseDescription;
use App\Models\Job;
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
use CountryState;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private $path;
    private $thumbpath;
    protected Course $model;
    public function __construct(Course $course)
    {
        $this->middleware('auth');
        $this->path         = public_path('/images/course');
        $this->thumbpath    = public_path('/images/course/thumb');
        $this->model       = $course;

    }
    public function index()
    {
        $courses      = $this->model->orderBy('created_at','desc')->get();
        return view('backend.course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        $countries    = CountryState::getCountries();
        return view('backend.course.create',compact('countries'));
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
            $data = [
                'title'                 => $request->input('title'),
                'slug'                  => $this->model->changeToSlug($request->input('title')),
                'code'                  => strtok($request['title'], " ").'-COR-'.rand(1,500),
                'country'               => $request->input('country'),
                'description'           => $request->input('description'),
                'status'                => $request->input('status'),
                'image'                 => $request->input('image'),
                'meta_title'            => $request->input('meta_title'),
                'meta_tags'             => $request->input('meta_tags'),
                'meta_description'      => $request->input('meta_description'),
                'created_by'            => Auth::user()->id,
            ];

            if(!empty($request->file('image'))){
                $image        = $request->file('image');
                $name         = uniqid().'_job_'.$image->getClientOriginalName();
                if (!is_dir($this->path)) {
                    mkdir($this->path, 0777);
                }
                if (!is_dir($this->thumbpath)) {
                    mkdir($this->thumbpath, 0777);
                }
                $thumb         = 'thumb_'.$name;
                $path          = base_path().'/public/images/course/';
                $thumb_path    = base_path().'/public/images/course/thumb/';
                $moved         = Image::make($image->getRealPath())->fit(775, 400)->orientate()->save($path.$name);
                $thumb         = Image::make($image->getRealPath())->fit(896, 590)->orientate()->save($thumb_path.$thumb);

                if ($moved && $thumb){
                    $data['image']= $name;
                }
            }

            $course = $this->model->create($data);

            if(count($request['detail_title']) > 0) {
                $this->createCourseDetails($course, $request);
            }

            DB::commit();
            Session::flash('success','Course details Created Successfully');
        }catch (\Exception $e){
            DB::rollBack();
            Session::flash('error','Course details Creation Failed');
        }

        return redirect()->route('course.index');
    }



    public function createCourseDetails($course, $request)
    {
        foreach ($request['detail_title'] as $index=>$title){
            if ($title){
                CourseDescription::create([
                    'course_id'     => $course->id,
                    'title'         => $title,
                    'description'   => $request['detail_description'][$index] ?? null,
                ]);
            }
        }
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
        $edit         = Course::find($id);
        $countries    = CountryState::getCountries();

        return view('backend.course.edit',compact('edit','countries'));
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
        $course                        = Course::find($id);
        DB::beginTransaction();
        try {
            $course->title                 = $request->input('title');
            $course->code                  = strtok($request->input('title'), " ").'-COR-'.rand(1,500);
            $course->slug                  = $this->model->changeToSlug($request->input('title'));
            $course->country               = $request->input('country');
            $course->description           = $request->input('description');
            $course->status                = $request->input('status');
            $course->meta_title            = $request->input('meta_title');
            $course->meta_tags             = $request->input('meta_tags');
            $course->meta_description      = $request->input('meta_description');
            $course->updated_by            = Auth::user()->id;
            $oldimage                      = $course->image;
            $thumbimage                    = 'thumb_'.$course->image;

            if (!empty($request->file('image'))){
                $image                = $request->file('image');
                $name                 = uniqid().'_'.$image->getClientOriginalName();
                $thumb                = 'thumb_'.$name;
                $path                 = base_path().'/public/images/course/';
                $thumb_path           = base_path().'/public/images/course/thumb/';
                $moved                = Image::make($image->getRealPath())->fit(775, 400)->orientate()->save($path.$name);
                $thumb                = Image::make($image->getRealPath())->fit(896, 590)->orientate()->save($thumb_path.$thumb);

                if ($moved && $thumb){
                    $course->image = $name;
                    if (!empty($oldimage) && file_exists(public_path().'/images/course/'.$oldimage)){
                        @unlink(public_path().'/images/course/'.$oldimage);
                    }

                    if (!empty($thumbimage) && file_exists(public_path().'/images/course/thumb/'.$thumbimage)){
                        @unlink(public_path().'/images/course/thumb/'.$thumbimage);
                    }
                }
            }

            $course->update();

            if(count($request['detail_title']) > 0) {

                $db_values = $course->courseDescription ? $course->courseDescription->pluck('id'):[];

                foreach ($request['detail_title'] as $index=>$title){
                    if ($title){
                        $data = [
                            'course_id'     => $course->id,
                            'title'         => $title,
                            'description'   => $request['detail_description'][$index] ?? null,
                        ];
                        if($request['detail_id'][$index]){
                            $course_description = CourseDescription::find($request['detail_id'][$index]);
                            $course_description->update($data);
                        }else{
                            CourseDescription::create($data);
                        }
                    }
                }

                foreach ($db_values as $key=>$value){
                    if(!in_array($value,$request->input('detail_id'))){
                        $delete_element = CourseDescription::find($value);
                        $status         = $delete_element->delete();
                    }
                }
            }


            DB::commit();
            Session::flash('success','Course details was updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error','Course details was not updated. Something went wrong.');
        }

        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $delete       = Course::find($id);
        $rid          = $delete->id;
        $thumbimage   = 'thumb_'.$delete->image;


        if (!empty($delete->image) && file_exists(public_path().'/images/course/'.$delete->image)){
            @unlink(public_path().'/images/course/'.$delete->image);
        }
        if (!empty($thumbimage) && file_exists(public_path().'/images/course/thumb/'.$thumbimage)){
            @unlink(public_path().'/images/course/thumb/'.$thumbimage);
        }
        $recuuu          = $delete->delete();
        if($recuuu){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Course details has been removed! ']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Course details could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id){
        $course          = Course::find($id);
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
