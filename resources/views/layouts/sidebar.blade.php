<link rel="stylesheet" href="<?php echo asset('side.css')?>" type="text/css">
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Dashboard</h3>
        </div>

        <ul class="list-unstyled components">
        
            <li class="">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Job Posts</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="{{ route('post.create') }}" style="text-decoration: none;"> Add New Job Post</a>
                    </li>
                    <li>
                        <a href="{{ route('post.index') }}" style="text-decoration: none;">Manage Job Posts</a>
                    </li>

                </ul>
            </li>
       
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Applications</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="{{ route("application.index") }}">View Applications</a>
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

