<link rel="stylesheet" href="<?php echo asset('side.css')?>" type="text/css">

<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Job Seekers</h3>
        </div>
      
        <ul class="list-unstyled components">
            <p>Welcome {{ Auth::user()->name }} </p>
            {{-- <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Job Posts</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="" style="text-decoration: none; color:black"> Add New Job Post</a>
                    </li>
                    <li>
                        <a href="" style="text-decoration: none; color:black">Manage Job Posts</a>
                    </li>

                </ul>
            </li> --}}
            <li>
                <a href="{{ route('seekers.home') }}">Job Posts</a>
            </li>
       
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">My Applications</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{ route('seeker.myApplications') }}">View All My Applications</a>
                    </li>
                    
                </ul>
            </li>
        
            <li>
                <a href="#">Contact</a>
            </li>
            <li>
                <div class="" aria-labelledby="">
                    <a class="" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>

            </li>
        </ul>
    </nav>

    <!-- Page Content -->

