<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $application = Application::all();
        return view('dashboard.applications.index',compact('application'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::find($id);
        $resume =  Storage::disk('s3')->response('resumes'.$application->user->id.'/'.$application->user->resume);
        $url = "https://jobseeker-upload-resumes.s3.us-west-2.amazonaws.com/resumes".$application->user->id."/".$application->resume;
        
        $data =[
            'application' => $application,
            'url' => $url,
        ];
    
        $details = [
            'title' => 'Mail from JobSeeker',
            'body' => 'The Admin Views Your Application'
        ];
       
        \Mail::to($application->user->email)->send(new \App\Mail\SendEmail($details));
        return view("dashboard.applications.show")->with($data);
        
    }
    public function changeToSeen(Request $request)
    {
        // dd("xxx");
        $id = $request->id;
       
      
        
       Application::where('id',$id)->update(['status_seen' => 1]);
     //  dd('after');
      //  basic_email();
     // redirect->route('send-mail');
     
   
    }
    public function basic_email() {
        // $data = array('name'=>"Virat Gandhi");
        
     
        // Mail::send(['text'=>'mail'], $data, function($message) {
        //    $message->to('mjtech256@gmail.com', 'Tutorials Point')->subject
        //       ('Laravel Basic Testing Mail');
        //    $message->from('xyz@gmail.com','Virat Gandhi');
        // });
        
        // echo "Basic Email Sent. Check your inbox.";
     }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
    }
}
