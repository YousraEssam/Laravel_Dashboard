<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Dashboard v.2</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/plugins/jasny/jasny-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('status.css')}}" rel="stylesheet">
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

</head>

<body>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="logo-element">
                            IN+
                        </div>
                        <div class="dropdown profile-element"> 
                            <span>
                                <img alt="image" class="img-circle" src="{{ asset('theme/img/profile_small.jpg') }}" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> 
                                    <span class="block m-t-xs"> 
                                        <strong class="font-bold">{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</strong>
                                    </span>
                                    <span class="text-muted text-xs block">{{ Auth::user()->email }}
                                        <b class="caret"></b>
                                    </span> 
                                </span> 
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a href="login.html">Logout</a></li>
                            </ul>
                        </div>
                        <li class="">
                            <a href="{{ route('home') }}">
                                <i class="fa fa-th-large"></i> 
                                <span class="nav-label">Dashboard</span> 
                            </a>
                        </li>
                    </li>
                    @can('role-list')
                    <li class="">
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Roles</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('roles.index') }}">All</a></li>
                            @can('role-create')
                            <li><a href="{{ route('roles.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('city-list')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Cities</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('cities.index') }}">All</a></li>
                            @can('city-create')
                            <li><a href="{{ route('cities.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('job-list')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Jobs</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('jobs.index') }}">All</a></li>
                            @can('job-create')
                            <li><a href="{{ route('jobs.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('staffmember-list')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Staff Members</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('staff_members.index') }}">All</a></li>
                            @can('staffmember-create')
                            <li><a href="{{ route('staff_members.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('visitor-list')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Visitors</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('visitors.index') }}">All</a></li>
                            @can('visitor-create')
                            <li><a href="{{ route('visitors.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('news-list')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">News</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('news.index') }}">All</a></li>
                            @can('news-create')
                            <li><a href="{{ route('news.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('events-list')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Events</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('events.index') }}">All</a></li>
                            @can('event-create')
                            <li><a href="{{ route('events.create') }}">Add</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('folder-add')
                    <li>
                        <a href="">
                            <i class="fa fa-th-large"></i> 
                            <span class="nav-label">Folders</span> 
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level" style="">
                            <li><a href="{{ route('library.folders.index') }}">All</a></li>
                            <li><a href="{{ route('library.folders.create') }}">Add</a></li>
                        </ul>
                    </li>
                    @endcan
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li><a class="fa fa-sign-out dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>

                </nav>
            </div>
            <h1>HOME PAGE WELCOME BABY </h1>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    @yield('maintitle')
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        @yield('titlebreadcrumb')
                    </ol>
                </div>
            </div>
            @yield('content')

            <div class="footer">
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('theme/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/flot/jquery.flot.time.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('theme/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('theme/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('theme/js/inspinia.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('theme/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Jvectormap -->
    <script src="{{ asset('theme/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- DataTables  -->
    <script src="{{ asset('theme/js/plugins/dataTables/datatables.min.js') }}"></script>

    <!-- iCheck -->
    <script src="{{ asset('theme/js/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('theme/js/plugins/select2/select2.full.min.js') }}"></script>

    <!-- DROPZONE -->
    <script src="{{ asset('theme/js/plugins/dropzone/dropzone.js') }}"></script>
    
    <!-- Chosen -->
    <script src="{{ asset('theme/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    
    <!-- CkEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

    <!-- Jasny -->
    <script src="{{ asset('theme/js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

    <!-- Data picker -->
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    
    <script src="{{ asset('app.js') }}"></script>

    <!-- Page-Level Scripts -->
    @yield('Imagedropzone')
    @yield('Filedropzone')
    @yield('MapScript')
    @yield('uploadVideoScript')
    @stack('JSValidatorScript')
    @stack('scripts')
</body>
</html>