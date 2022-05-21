<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts  = Post::all();
        return view('dashboard.posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view("dashboard.posts.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $input = $request->all();
        $validator = Validator::make($input,[
            'title' => 'required',
            'description' => 'required',
            'company_name' => 'required',
            'work_type' => 'required',
            'location' => 'required',
            'expiry_date' => 'required',

        ]);
        if($validator->fails())
        {
            Session::flash('message', $validator->errors()->first()); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect()->back();
        }
        
        $post = Post::create($input);
        Session::flash('message', "Successfully Added New Post  "); 
        Session::flash('alert-class', 'alert-class'); 
         return redirect()->back();
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('dashboard.posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        // dd($request);   
       $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'company_name' => 'required',
            'work_type' => 'required',
            'location' => 'required',
            'expiry_date' =>'required',

        ]);
        $post->title        = $request->title;
        $post->description  = $request->description;
        $post->company_name = $request->company_name;
        $post->work_type    = $request->work_type;
        $post->location     = $request->location;
        $post->expiry_date  = $request->expiry_date;
        $post->save();
         return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
         return redirect()->route('post.index');
    }
}
