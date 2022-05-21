@extends('layouts.public.app')
@section('content')
@include('layouts.public.sidebar')
<div class="container p-4">
    <h1>Job Details</h1>
  
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1" id="x1">{{ $post->title }}</h5>
            <small>{{ $post->created_at }}</small>
        </div>
        <small style="font-weight: 600">{{ $post->company_name }}</small>
        <p class="mb-1" id="x2">{{ $post->description }}
        </p>
        <div class="row">
            <div class="col pt-1">
                <small>{{ $post->location }}</small>

                <i class="fas fa-location-arrow"></i>
                -
                <small>{{ $post->work_type }}</small>

                <i class="fas fa-briefcase"></i>
            </div>
            
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <form action="{{ route("seeker.app",$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file"  name="resume"  accept="application/pdf" required>    
                    <button class="btn btn-success">Apply   </button>
                </form>
                </div>
            </div>
        </div>
        
    
</div>
@endsection