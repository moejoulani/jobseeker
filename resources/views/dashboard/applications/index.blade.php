@extends('layouts.app')
@section('content')
@include('layouts.sidebar')
<div class="container-fluid p-2">

    <h1 style="text-align: center;">Applications</h1>
    <div class="container p-4">
        @if (count($application) == 0)
        <div class="col justify-content-center" style="text-align: center" >
             <h1>There Is No Applications Yet</h1>

             <img src="{{ asset('images/empty.png') }} "width="200px" height="200px">
        </div>
       @else
        <div class="list-group">
            @foreach ($application as $item)
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1" id="x1">{{ $item->user->name }} Applied For {{ $item->post->title }} Position At {{ $item->post->company_name }}</h5>
                    <small>Application Date : {{ $item->created_at }}</small>
                </div>
                <small style="font-weight: 600">{{ $item->post->location }}</small>
                {{-- <p class="mb-1" id="x2">{{ $item->post->description }}</p> --}}
                <div class="row">
                    {{-- <div class="col pt-1">
                        <small>{{ $item->post->location }}</small>

                        <i class="fas fa-map-marker-alt"></i>
                        -
                        <small>{{ $item->post->work_type }}</small>

                        <i class="fas fa-briefcase"></i>
                    </div> --}}
                    <div class="col">
                        <div class=" float-left"><small>
                            @if ($item->status_seen)
                           
                            @else
                            <span>New</span>
                            <i class="fa fa-circle" style="font-size:13px; color:green"></i>


                            @endif
                            </i></small></div>

                    </div>
                    <form action="{{ route('application.show',$item->id) }}" method="POST">
                        @csrf
                    <div class="center">
                        <button type="submit" class="btn btn-info">View</button>
                    </div>
                </form>
                </div>

            </a>
                
            @endforeach
          

        </div>
        @endif
    </div>
@endsection