@extends("layouts.app")

@section("content")
@if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif

@include("layouts.sidebar")

<div class="container">
    <h1>Add New Job Post</h1>
<form action="{{route('post.store')}}" method="POST">
  @csrf
  @method("POST")
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Post Title</label>
      <input type="text" class="form-control" id="inputEmail4" name="title" placeholder="Enter The Post Title" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Post Description</label>
      <textarea cols=10 class="form-control" id="inputPassword4" name="description" placeholder="Enter The Post Description" required></textarea>
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Company name</label>
    <input type="text" class="form-control" id="inputAddress" name="company_name" placeholder="Enter The Company Name" required>
  </div>


  <div class="form-row">
  <div class="form-group col-md-4">
      <label for="worktype">Work Type</label>
      <select id="worktype" name="work_type" class="form-control" required="required">
        <option selected value="" disabled="disabled">Choose...</option>
        <option>Full Time</option>
        <option>Part Time</option>
        <option>Freelance</option>
        <option>Internship</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState" type="location">Location</label>
      <select id="inputState" name="location"  class="form-control" required="required">
        <option selected value="" disabled="disabled">Choose...</option>
        
      </select>
     
    </div>

    
  </div>
  <div class="form-group">
    <label for="expiry_date">Add Expiry Date:</label>
   
  <input type="date" id="expiry_date" name="expiry_date" min="{{ date("Y-m-d") }}">
 
  </div>
  <button type="submit" class="btn btn-primary">Add Post</button>
</form>
</div>

<script rel="javascript" type="text/javascript" href="js/jquery-1.11.3.min.js">


    getCountries();

    function getCountries(){

 
    $.ajax({
        async : false,
        type:'GET',
        url:"https://restcountries.com/v3.1/region/asia",
        success:function(data){
            console.log(data);
            data.forEach(function (e) {
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
