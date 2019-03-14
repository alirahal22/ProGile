<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>@yield('title', 'Reem Raha')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- Bootstrap core CSS     -->
    <link href="{{ asset("dashboard/css/bootstrap.min.css") }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset("dashboard/css/animate.min.css") }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset("dashboard/css/light-bootstrap-dashboard.css?v=1.4.0") }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ asset("dashboard/css/demo.css") }}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href={{ asset("assets/css/pe-icon-7-stroke.css") }} rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="{{ asset('dashboard/img/sidebar-5.jpg') }}">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/home" class="simple-text">
                    {{ Auth::user()->username }}
                </a>
            </div>
            <ul class="nav">

        
        @if(!$admin)


            {{-- If logged in user is a coach --}}
            @if($coach != null)

                <li class="{{ $option =='project' ? 'active' : '' }}">
                    <a href="{{ route('project') }}">
                        <i class="pe-7s-user"></i>
                        <p>Project</p>
                    </a>
                </li>
                <li class="{{ $option =='team' ? 'active' : '' }}">
                    <a href="{{ route('team') }}">
                        <i class="pe-7s-graph"></i>
                        <p>Team Members</p>
                    </a>
                </li>
                <li class="{{ $option =='questions' ? 'active' : '' }}">
                    <a href="{{ route('questions') }}">
                        <i class="pe-7s-note2"></i>
                        <p>Create Questionnaire</p>
                    </a>
                </li>
                <li class="{{ $option =='answers' ? 'active' : '' }}">
                        <a href="{{ route('answers') }}">
                            <i class="pe-7s-bell"></i>
                            <p>Questions</p>
                        </a>
                    </li>            
                <li class="{{ $option =='statistics' ? 'active' : '' }}">
                    <a href="{{ route('statistics') }}">
                        <i class="pe-7s-bell"></i>
                        <p>Statistics</p>
                    </a>
                </li>


                
            {{-- If logged in user is a regular member --}}
            @else

                    <li class = "active">
                        <a href="{{ route('member') }}">
                            <i class="pe-7s-bell"></i>
                            <p>Questions</p>
                        </a>
                    </li>


            @endif


        {{-- If logged in user is a coach --}}
        @else
            <li class="active">
                <a href="{{ route('admin') }}">
                    <i class="pe-7s-user"></i>
                    <p>Admin</p>
                </a>
            </li>
        @endif
                </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('project') }}">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        
                        <li>
                            <a href="{{ route('logout') }}" 
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <p>Log out</p>
                            </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

    @yield('content')
    

    <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Alone
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Ali Rahal & Reem Atwi</a>
                </p>
            </div>
        </footer>

    </div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ asset("dashboard/js/jquery.3.2.1.min.js") }}" type="text/javascript"></script>
	<script src="{{ asset("dashboard/js/bootstrap.min.js") }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="dashboard/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset("dashboard/js/bootstrap-notify.js") }}"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{ asset('dashboard/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{ asset("dashboard/js/demo.js") }}"></script>
    

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.js"></script> --}}

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>Raha and Reem Agile Project</b> - An easy way to improve your team's productivity."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>


</html>
