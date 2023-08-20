<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCreateRequest;
use App\Http\Requests\JobUpdateRequest;
use App\Models\Client;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use CountryState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path;
    private $thumbpath;
    protected $job = null;
    public function __construct(Job $job)
    {
        $this->middleware('auth');
        $this->path   = public_path('/images/job');
        $this->thumbpath   = public_path('/images/job/thumb');
        $this->job = $job;

    }
    public function index()
    {
        $categories         = JobCategory::all();
        $jobs               = Job::orderBy('created_at','desc')->get();
        $countries          = CountryState::getCountries();
        $clients            = Client::all();
        return view('backend.job.index',compact('categories','jobs','countries','clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = JobCategory::orderBy('name', 'asc')->get();
        return view('backend.job.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $end     = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $start   = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $code    = strtok($request->input('name'), " ").'-WIN-'.rand(1,500);
        $category_id = $request->job_category_id;

        $data = [
            'lt_number'            => $request->input('lt_number'),
            'category_ids'         => ($category_id !== null) ? implode(',', $category_id):null,
            'name'                 => $request->input('name'),
            'slug'                 => $this->job->changeToSlug($request->input('name')),
            'code'                 => $code,
            'required_number'      => $request->input('required_number'),
            'formlink'               => $request->input('formlink'),
            'salary'               => $request->input('salary'),
            'min_qualification'    => $request->input('min_qualification'),
            'description'          => $request->input('description'),
            'extra_company'        => $request->input('extra_company'),
            'start_date'           => $start,
            'end_date'             => $end,
            'meta_title'           => $request->input('meta_title'),
            'meta_tags'            => $request->input('meta_tags'),
            'meta_description'     => $request->input('meta_description'),
            'status'               => $request->input('status'),
            'created_by'           => Auth::user()->id,
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
            $path          = base_path().'/public/images/job/';
            $thumb_path    = base_path().'/public/images/job/thumb/';
            $moved         = Image::make($image->getRealPath())->orientate()->save($path.$name);
            $thumb         = Image::make($image->getRealPath())->fit(520, 640)->orientate()->save($thumb_path.$thumb);

            if ($moved && $thumb){
                $data['image']= $name;
            }
        }

        $status = Job::create($data);
        if($status){
            Session::flash('success','Job details Created Successfully');
        }
        else{
            Session::flash('error','Job details Creation Failed');
        }
        return redirect()->route('job.index');
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
        $edit           = Job::find($id);
        $categories     = JobCategory::orderBy('name', 'asc')->get();
        $end            = Carbon::createFromFormat('Y-m-d', $edit->end_date)->format('d/m/Y');
        $start          = Carbon::createFromFormat('Y-m-d', $edit->start_date)->format('d/m/Y');
        return view('backend.job.edit',compact('edit','categories','start','end'));
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

        $end     = Carbon::createFromFormat('d/m/Y', $request->end_date)->format('Y-m-d');
        $start   = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $category_id = $request->job_category_id;

        $job                        = Job::find($id);
        $freecode                   = str_replace("-"," ", $job->code);
        $removed                    = strstr($freecode," ");
        $code                       = strtok($request->input('name'), " ").$removed;
        $finalcode                  = str_replace(" ","-", $code);
        $job->category_ids          = ($category_id !== null) ? implode(',', $category_id):null;
        $job->name                  = $request->input('name');
        $job->title                  = $request->input('title');
        $job->lt_number             = $request->input('lt_number');
        $job->code                  = $finalcode;
        $job->required_number       = $request->input('required_number');
        $job->formlink              = $request->input('formlink');
        $job->salary                = $request->input('salary');
        $job->min_qualification     = $request->input('min_qualification');
        $job->extra_company         = $request->input('extra_company');
        $job->description           = $request->input('description');
        $job->meta_title            = $request->input('meta_title');
        $job->meta_tags             = $request->input('meta_tags');
        $job->meta_description      = $request->input('meta_description');
        $job->start_date            = $start;
        $job->end_date              = $end;
        $job->updated_by            = Auth::user()->id;
        $oldimage                   = $job->image;
        $thumbimage                 = 'thumb_'.$job->image;

        if (!empty($request->file('image'))){
            $image                = $request->file('image');
            $name                 = uniqid().'_'.$image->getClientOriginalName();
            $thumb                = 'thumb_'.$name;
            $path                 = base_path().'/public/images/job/';
            $thumb_path           = base_path().'/public/images/job/thumb/';
            $moved                = Image::make($image->getRealPath())->orientate()->save($path.$name);
            $thumb               = Image::make($image->getRealPath())->fit(520, 640)->orientate()->save($thumb_path.$thumb);

            if ($moved && $thumb){
                $job->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/job/'.$oldimage)){
                    @unlink(public_path().'/images/job/'.$oldimage);
                }

                if (!empty($thumbimage) && file_exists(public_path().'/images/job/thumb/'.$thumbimage)){
                    @unlink(public_path().'/images/job/thumb/'.$thumbimage);
                }
            }
        }

        $status                     = $job->update();
        if($status){
            Session::flash('success','Job details was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Job details could not be Updated');
        }
        return redirect()->route('job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete       = Job::find($id);
        $rid          = $delete->id;
        $thumbimage   = 'thumb_'.$delete->image;

        if (!empty($delete->image) && file_exists(public_path().'/images/job/'.$delete->image)){
            @unlink(public_path().'/images/job/'.$delete->image);
        }
        if (!empty($thumbimage) && file_exists(public_path().'/images/job/thumb/'.$thumbimage)){
            @unlink(public_path().'/images/job/thumb/'.$thumbimage);
        }
        $recuuu          = $delete->delete();
        if($recuuu){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Job details has been removed! ']);        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Job details  could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id){
        $job           = Job::find($id);
        $job->status   = $request->status;
        $status        = $job->update();
        $new_status    = ($job->status == 'draft') ? "Draft":"Published";
        $value         = ($job->status == 'draft') ? "publish":"draft";
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
