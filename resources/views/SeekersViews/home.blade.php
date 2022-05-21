@extends('layouts.public.app')

@section('content')
    @include('layouts.public.sidebar')


    <style>
        small {
            font-size: 90%;
        }
        .fff{
            display: none;
        }

    </style>
    <div class="container-fluid p-2">
        @if (Session::has('successmessage'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('successmessage') }}</strong> We wish you all the best
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(Session::has('appliedmessage'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('appliedmessage') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1 style="text-align: center;">Jobs</h1>
        <div class="container p-4">
            <div class=" flex-column align-items-start ">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="txt" placeholder="Search...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-secondary" onclick="searchText()" type="button">Search For Title Keyword</button>
                    </div>
                  </div>
                <div class="row">
                <div class="form-group col-md-4">
                    <label for="worktype">Work Type</label>
                    <select id="worktype" name="work_type" class="form-control" required="required">
                        <option selected value="" >Choose...</option>
                        <option>Full Time</option>
                        <option>Part Time</option>
                        <option>Freelance</option>
                        <option>Internship</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState" type="location">Location</label>
                    <select id="inputState" name="location" class="form-control" required="required">
                        <option selected value="" >Choose...</option>

                    </select>

                </div>
            </div>

                <button onclick="search()" class="btn btn-success mt-2 mb-2">Search</button>
                <div class="dis">

                </div>
                <div class="row justify-content-center">
                  <div id="fff" style="display: none;">  <img id="loading" src="{{ asset('images/loading.gif') }} "width="30px" height="30px"style="" ></div>
                </div>

            </div>
            <div class="list-group">
                {{-- <div class="list-group-item list-group-item-action flex-column align-items-start ">
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
                        <select id="inputState" name="location" class="form-control" required="required">
                            <option selected value="" disabled="disabled">Choose...</option>

                        </select>

                    </div>

                    <button onclick="search()" class="btn btn-success">Search</button>

                </div> --}}

            </div>
        </div>
        <script>
                document.getElementById("fff").style.display = "block";
            getAllJobsApi();
            getCountries();
        

            $(document).ready(function() {
       
       
    });
          
            function searchText()
            {
                var txt = document.getElementById('txt').value;
                document.getElementById("fff").style.display = "block";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                async:false,
                type: 'POST',
                url: '{{ url('seekers/search') }}',
                data:{
                    'txt':txt,
                },
                success:function(data)
                {
                    document.getElementById("fff").style.display = "none";
                        var string1 = JSON.stringify(data);
                        var obj = JSON.parse(string1);
                       
                       displayData(obj);
                },
                error:function(error)
                {
                    console.log(error);
                }

            });
            }
            function search() {
                var workType = document.getElementById('worktype').value;
                var location = document.getElementById('inputState').value;
                
                document.getElementById("fff").style.display = "block";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                async:false,
                type: 'POST',
                url: '{{ url('seekers/filterJobs') }}',
                data:{
                    'location':location,
                    'work_type':workType,
                },
               
                success:function(data)
                {
                    document.getElementById("fff").style.display = "none";
                        var string1 = JSON.stringify(data);
                        var obj = JSON.parse(string1);
                        displayData(obj);
                },
                error:function(error)
                {
                    console.log(error);
                }

            });
            }

            function getAllJobsApi() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({

                    async: false,
                    type: 'POST',
                    url: '{{ url('/seekers/getJobs') }}',
                    success: function(data) {
                        var string1 = JSON.stringify(data);
                        var obj = JSON.parse(string1);
                        document.getElementById("fff").style.display = "none";
                        displayData(obj);
                        console.log(data);
                        // obj['response']['list'].forEach(element => {
                        //     console.log(element['description']);
                        //     var newDate = element['created_at'];
                        //     var buttonText = 'Apply Now';
                        //     var buttonType = 'success';
                        //     var appliedMessage = '';
                        //     if (element['applied']) {
                        //         buttonText = 'View Details';
                        //         appliedMessage = 'You Already Applied For This Job ';
                        //         buttonType = 'info';
                        //     }

                        //     var idx = element['id'];
                        //     var url = '{{ route('seeker.apply', ':id') }}';
                        //     url = url.replace(':id', idx);


                        //     $('.list-group').append(
                        //         ' <a href="#" class="list-group-item list-group-item-action flex-column align-items-start "><div class="d-flex w-100 justify-content-between"><h5 class="mb-1" id="x1">' +
                        //         element['title'] + '</h5> <small>' + element['created_at'] +
                        //         '</div><small style="font-weight: 700; font-size:90%">' + element[
                        //             'company_name'] +
                        //         '</small> </div> <p class="mb-1" id="x2">' + element['description'] +
                        //         '</p> <div class="row"> <div class="col pt-1"> <small>' + element[
                        //             'location'] +
                        //         '</small> <i class="fas fa-map-marker-alt"></i> - <small>' + element[
                        //             'work_type'] + ' ' +
                        //         '</small><i class="fas fa-briefcase"></i></div> <form action=' + url +
                        //         ' method="POST">@csrf <div class="col"><button type="submit" class="btn btn-' +
                        //         buttonType + ' float-right"  >' + buttonText +
                        //         '</button> </div></form>' +
                        //         '</div> <p class="text-center">' + appliedMessage + '</p> </a>');
                        // });



                        /// console.log(data['response']['list']);

                    }
                });
            }
            function displayData(obj)
            {
                $('.list-group').empty();

                obj['response']['list'].forEach(element => {
                            console.log(element['description']);
                            var newDate = element['created_at'];
                            var buttonText = 'Apply Now';
                            var buttonType = 'success';
                            var appliedMessage = '';
                            if (element['applied']) {
                                buttonText = 'View Details';
                                appliedMessage = 'You Already Applied For This Job ';
                                buttonType = 'info';
                            }

                            var idx = element['id'];
                            var url = '{{ route('seeker.apply', ':id') }}';
                            url = url.replace(':id', idx);

                            
                            $('.list-group').append(
                                ' <a href="#" class="list-group-item list-group-item-action flex-column align-items-start "><div class="d-flex w-100 justify-content-between"><h5 class="mb-1" id="x1">' +
                                element['title'] + '</h5> <small>' + element['created_at'] +
                                '</div><small style="font-weight: 700; font-size:90%">' + element[
                                    'company_name'] +
                                '</small> </div> <p class="mb-1" id="x2">' + element['description'] +
                                '</p> <div class="row"> <div class="col pt-1"> <small>' + element[
                                    'location'] +
                                '</small> <i class="fas fa-map-marker-alt"></i> - <small>' + element[
                                    'work_type'] + ' ' +
                                '</small><i class="fas fa-briefcase"></i></div> <form action=' + url +
                                ' method="POST">@csrf <div class="col"><button type="submit" class="btn btn-' +
                                buttonType + ' float-right"  >' + buttonText +
                                '</button> </div></form>' +
                                '</div> <p class="text-center">' + appliedMessage + '</p> </a>');
                        });

            }
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
