@extends('layouts.app')

@section('content')
    @include('layouts.sidebar')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->user_type == 1)
                            <h1>Find Your Job Now Here </h1>
                        @else
                            {{ __('You are logged in!') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
