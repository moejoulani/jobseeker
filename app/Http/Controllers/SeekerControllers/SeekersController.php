<?php

namespace App\Http\Controllers\SeekerControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Application;
use Illuminate\Support\Facades\Session;
class SeekersController extends Controller
{
    public function index()
    {
        
      
        return view('SeekersViews.home');
    }
    public function isApplied($id)
    {
     $value =    Application::where('user_id',auth()->user()->id)->where('post_id',$id)->exists();
        return $value;
    }
    public function filterJobs(Request $request)
    {
        $workType = $request->work_type;
        $location = $request->location;
    
        if($workType != null && $location != null)
        {
            $posts = Post::where('work_type',$workType)
            ->where('location',$location)
            ->get();
                $response =[
                "success" => true,
                "response" => array(
                    "code" => 200,
                    "list" => $posts,
                ),
                ];
                return  response()->json($response);

        }
        else{
            if($workType == null)
            {
                $posts = Post::where('location',$location)->get();
                        $response =[
                            "success" => true,
                            "response" => array(
                                "code" => 200,
                                "list" => $posts,
                            ),
                        ];
                        return  response()->json($response);

            }
            else{
                $posts = Post::where('work_type',$workType)->get();
                        $response =[
                            "success" => true,
                            "response" => array(
                                "code" => 200,
                                "list" => $posts,
                            ),
                        ];
                        return  response()->json($response);

            }
        }
        $posts = Post::where('work_type',$workType)
                     ->where('location',$location)
                     ->get();
        $response =[
            "success" => true,
            "response" => array(
                "code" => 200,
                "list" => $location,
            ),
        ];
        return  response()->json($response);
    

    }
    public function search(Request $request)
    {
        $txt = $request->txt;
        $posts = Post::orWhere('title','LIKE',"%{$txt}%")->get();
                        $response =[
                            "success" => true,
                            "response" => array(
                                "code" => 200,
                                "list" => $posts,
                            ),
                        ];
                        return  response()->json($response);
    }
    public function getAllJobs()
    {
        $posts = Post::where('expiry_date','>=',date("Y-m-d"))->get();
        $post = [];
        $count=0;
        foreach ($posts as $postItem) {
           
            $post[$count] = [
                'id' =>$postItem->id,
                'created_at' =>$postItem->created_at,
                'title' =>$postItem->title,
                'description' =>$postItem->description,
                'work_type' =>$postItem->work_type,
                'location' =>$postItem->location,
                'company_name' =>$postItem->company_name,
                'applied' => $this->isApplied($postItem->id),
            ];
            $count++;
        }
       



      //  $posts = Post::all();
        
        $response =[
            "success" => true,
            "response" => array(
                "code" => 200,
                "list" => $post,
            ),
        ];
        return  response()->json($response);
    }
    public function jobApply($id)
    {
        $post = Post::find($id);
        
        return view('SeekersViews.apply')->with('post',$post);
    }
    public function apply(Request $request,$id)
    {
    //  dd(auth()->user()->id);
        if(!Application::where('post_id',$id)->where('user_id',auth()->user()->id)->exists())
        {
            
            if($request->hasFile('resume')){
                
                $file = $request->file('resume');
              
                $fileName = $file->getClientOriginalName();
                
                $file->storeAs('/resumes'.auth()->user()->id,$fileName,'s3');
                $application = Application::create(
                    [
                        'user_id' => auth()->user()->id,
                        'post_id' => $id,
                        'resume' => $fileName
                    ]
                );
                Session::flash('successmessage', "Applied Successfully To The Job"); 
                Session::flash('alert-class', 'alert-class'); 
                 return redirect('/seekers');  
            }
            else{
                Session::flash('cvMessage', "You Should Upload Your CV"); 
                Session::flash('alert-class', 'alert-class'); 
                 return redirect('/seekers');  
            }
       
           
        }
        else{
            
            Session::flash('appliedmessage', "Already Applied To This Job Post"); 
            Session::flash('alert-class', 'alert-class'); 
             return redirect('/seekers');   
        }
       
    }
    public function myApplications()
    {
        
        $application = Application::where('user_id',auth()->user()->id)->get();
        //$post = $application->post;
        
        return view('SeekersViews.myapplication',compact('application'));
    }
}
