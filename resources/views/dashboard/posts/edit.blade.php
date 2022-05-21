@extends('layouts.app')

@section('content')
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    @include('layouts.sidebar')

    <div class="container">
        <h1>Edit Job Post</h1>
        <form action="{{ route('post.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Post Title</label>
                    <input type="text" class="form-control" id="inputEmail4" value="{{ $post->title }}" name="title"
                        placeholder="Enter The Post Title" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Post Description</label>
                    <textarea cols=10 class="form-control" id="inputPassword4" name="description" placeholder="Enter The Post Description"
                        required>{{ $post->description }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Company name</label>
                <input type="text" class="form-control" id="inputAddress" value="{{ $post->company_name }}"
                    name="company_name" placeholder="Enter The Company Name" required>
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="worktype">Work Type</label>
                    <select id="worktype" name="work_type" class="form-control" required="required">
                        <option selected value="{{ $post->work_type }}">{{ $post->work_type }}</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Freelance">Freelance</option>
                        <option value="Internship">Internship</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState" type="location">Location</label>
                    <select id="inputState" name="location" class="form-control" required="required">
                        {{-- <option selected value="{{ $post->location }}">{{ $post->location }}</option> --}}
                        
                    </select>

                </div>

            </div>
            <div class="form-group">
                <label for="expiry_date">Add Expiry Date:</label>
               
              <input type="date" id="expiry_date" value="{{ $post->expiry_date }}" name="expiry_date" min="{{ date("Y-m-d") }}">
             
              </div>
            <button type="submit" class="btn btn-primary">Edit Post</button>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Delete Post
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you Sure You Want To Delete This Post ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a style="text-decoration: none; " href="{{ route('post.destroy', $post->id) }}"> <button
                                    type="button" class="btn btn-danger">Delete </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script rel="javascript" type="text/javascript" href="js/jquery-1.11.3.min.js">
       
        getCountries();
        document.getElementById("inputState").value ="{{$post->location}}";
        function getCountries() {


            $.ajax({
                async: false,
                type: 'GET',
                url: "https://restcountries.com/v3.1/region/asia",
                success: function(data) {
                    console.log(data);
                    data.forEach(function(e) {
                        console.log(e['capital']);
                        $('#inputState').append($('<option>', {
                            value: e['capital'],
                            text: e['capital']
                        }));
                    });
                }
            });
        }
    </script>
@endsection
