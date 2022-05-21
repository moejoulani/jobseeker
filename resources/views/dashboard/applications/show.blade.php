@extends('layouts.app')
@section('content')
    @include('layouts.sidebar')
    <div class="container p-4">
        <h1>Application Details</h1>
        
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1" id="x1">{{ $application->post->title }}</h5>
            <small>{{ $application->post->created_at }}</small>
        </div>
        <small style="font-weight: 600">{{ $application->post->company_name }}</small>
        <p class="mb-1" id="x2">{{ $application->post->description }}
        </p>
        <div class="row">
            <div class="col pt-1">
                <small>{{ $application->post->location }}</small>

                <i class="fas fa-location-arrow"></i>
                -
                <small>{{ $application->post->work_type }}</small>

                <i class="fas fa-briefcase"></i>
            </div>

        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="row">
                    <h4> Applied By : {{ $application->user->name }} - {{ $application->user->email }}</h4>
                </div>
               
            </div>
           <a href="{{ $url }}"> <button class="btn btn-success">Open The CV</button> </a>
        </div>


    </div>
    <script>
        changeStatus();
        function changeStatus() {
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                async:false,
                type: 'POST',
                url: '{{ url('dashboard/application/changeStatus') }}',
                data:{
                    'id':{{ $application->id }}
                },
               
                success:function(data)
                {
                    console.log("Xx");
                },
                error:function(error)
                {
                    console.log(error);
                }

            });
        }
    </script>
@endsection
