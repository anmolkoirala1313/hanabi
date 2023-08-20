<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $careers        = Career::orderBy('created_at','desc')->get();

        return view('backend.career.index',compact('careers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data=[
            'name'              => $request->input('name'),
            'open_position'     => $request->input('open_position'),
            'end_date'          => $request->input('end_date'),
            'from_link'         => $request->input('from_link'),
            'salary'            => $request->input('salary'),
            'type'              => $request->input('type'),
            'created_by'        => Auth::user()->id,
        ];
        $career = Career::create($data);
        if($career){
            Session::flash('success','Career created successfully !');
        } else{
            Session::flash('error','Something went wrong. Career could not be created!');
        }

        return redirect()->back();
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
     * @return JsonResponse
     */
    public function edit($id)
    {
        $edit         = Career::find($id);
        $end          = Carbon::createFromFormat('Y-m-d', $edit->end_date)->format('d/m/Y');

        return response()->json(["edit"=>$edit,"end"=>$end]);
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
        $career                  = Career::find($id);
        $career->name            = $request->input('name');
        $career->open_position   = $request->input('open_position');
        $career->from_link       = $request->input('from_link');
        $career->end_date        = $request->input('end_date');
        $career->salary          = $request->input('salary');
        $career->type            = $request->input('type');
        $career->updated_by      = Auth::user()->id;

        $status                  = $career->update();
        if($status){
            Session::flash('success','Career was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Career could not be Updated');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        $delete       = Career::find($id);
        $remove       = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Career has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Career could not be removed. Try Again later !']);
        }
    }
}
