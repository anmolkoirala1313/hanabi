<?php

namespace App\Http\Controllers;

use App\Models\CustomerInquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CustomerInquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $inquiries      = CustomerInquiry::all();
        return view('backend.customer_inquiry.index',compact('inquiries'));
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
        $data= [
            'name'                => $request->input('name'),
            'email'               => $request->input('email'),
            'phone'               => $request->input('phone'),
            'subject'             => $request->input('subject'),
            'qualification'       => $request->input('qualification'),
            'preparation_class'   => $request->input('preparation_class'),
            'preferred_location'  => $request->input('preferred_location'),
            'interested_country'  => $request->input('interested_country'),
            'message'             => $request->input('message'),
            'status'              => 'pending',
            'created_by'          => Auth::user()->id,
        ];

        $clients = CustomerInquiry::create($data);
        if($clients){
            Session::flash('success','Customer Inquiry Created Successfully');
        }
        else{
            Session::flash('error','Something went wrong. Customer Inquiry cannot be created');
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
     * @return Response
     */
    public function edit($id)
    {
        $edit           = CustomerInquiry::find($id);
        return response()->json(["edit"=>$edit]);
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
        $inquiry                        =  CustomerInquiry::find($id);
        $inquiry->name                  =  $request->input('name');
        $inquiry->email                 =  $request->input('email');
        $inquiry->phone                 =  $request->input('phone');
        $inquiry->subject               =  $request->input('subject');
        $inquiry->qualification         =  $request->input('qualification');
        $inquiry->preparation_class     =  $request->input('preparation_class');
        $inquiry->preferred_location    =  $request->input('preferred_location');
        $inquiry->interested_country    =  $request->input('interested_country');
        $inquiry->message               =  $request->input('message');

        $status = $inquiry->update();
        if($status){
            Session::flash('success','Customer Inquiry was updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Customer Inquiry could not be Updated');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $delete       = CustomerInquiry::find($id);
        $remove       = $delete->delete();
        if($remove){
            $status ='success';
            return response()->json(['status'=>$status,'message'=>'Customer Inquiry has been removed successfully!']);
        } else{
            $status ='error';
            return response()->json(['status'=>$status,'message'=>'Customer Inquiry could not be removed. Try Again later !']);
        }
    }

    public function updateStatus(Request $request, $id): JsonResponse
    {
        $inquiry           = CustomerInquiry::find($id);
        $inquiry->status   = $request->status;
        $status            = $inquiry->update();
        $new_status        = ($inquiry->status == 'pending') ? "Pending":"Responded";
        $value             = ($inquiry->status == 'pending') ? "responded":"pending";
        if($status){
            $status ='success';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id,'value'=>$value]);
        }
        else{
            $status ='error';
            return response()->json(['status'=>$status,'new_status'=>$new_status,'id'=>$id,'value'=>$value]);
        }
    }
}
