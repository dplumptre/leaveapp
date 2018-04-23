<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
   
    <title>TFOLC LEAVE PORTAL</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('logo.png') }}">  
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
<ul class="nav navbar-nav">


<li><a href="{{ url('/') }}">TFOLC LEAVE APP</a></li>

 @if(Auth::user() && (Auth::user()->role == "admin"))
            <li><a href="{{ url('/') }}" data-toggle="tooltip" title="Home">Home</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Manage <span class="caret"></span> 
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>               
                <a href="/admins/create">Create New User</a>
                <a href="/admins/users">View All Users</a>
                <a href="/admins/departments">Departments</a>
                <a href="/admins/grades">Grade Levels</a>
                <a href="/admins/employee_type">Employee Types</a>
                <a href="/admins/reset">RESET</a>
            </li>
        </ul>
    </li>


    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Apply <span class="caret"></span> 
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>               
                <a href="{{ url('/apply') }}" data-toggle="tooltip" title="New Leave application">Apply For Leave</a>
                <a href="{{ url('/loan_application') }}" data-toggle="tooltip" title="New Loan application">Apply For Loan</a>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            View Applications <span class="caret"></span> 
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>               
                <a href="/admins/requests" data-toggle="tooltip" title="View all Leave request">Leave Applications</a>
@if(Auth::user() && (Auth::user()->loan_roles_id == "1") || (Auth::user()->loan_roles_id == "2") || (Auth::user()->loan_roles_id == "3"))
                <a href="/admins/loan_applications" data-toggle="tooltip" title="View all Loan Applications">Loan Applications</a>
@endif
            </li>
        </ul>
    </li>

          <li><a href="/admins/return" data-toggle="tooltip" title="View all Leave request"> Leave Return Details</a></li>
         

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

 @elseif(Auth::user() && (Auth::user()->role == "supervisor"))
            <li><a href="{{ url('/') }}" data-toggle="tooltip" title="Home">Home</a></li>
            
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Apply <span class="caret"></span> 
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>               
                <a href="{{ url('/apply') }}" data-toggle="tooltip" title="New Leave application">Apply For Leave</a>
                <a href="{{ url('/loan_application') }}" data-toggle="tooltip" title="New Loan application">Apply For Loan</a>
            </li>
        </ul>
    </li>

            <li><a href="{{ url('/supervisor_approval') }}" data-toggle="tooltip" title="Approve Leave">Approve</a></li>
 
 @elseif(Auth::user() && (Auth::user()->role == "staff"))
            <li><a href="{{ url('/') }}" data-toggle="tooltip" title="Home">Home</a></li>
            
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Apply <span class="caret"></span> 
        </a>

        <ul class="dropdown-menu" role="menu">
            <li>               
                <a href="{{ url('/apply') }}" data-toggle="tooltip" title="New Leave application">Apply For Leave</a>
                <a href="{{ url('/loan_application') }}" data-toggle="tooltip" title="New Loan application">Apply For Loan</a>
            </li>
        </ul>
    </li>

 @else
    
@endif

</ul>

           

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                         
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span> 
                            </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>               
                                        <li><a href="/profile/{{ Auth::user()->id }}"> Profile</a></li>
                                        <li><a href="/status/{{ Auth::user()->id }}"> Leave Status</a></li>
                                        <li><a href="/user_loan_status/{{ Auth::user()->id }}"> Loan Status</a></li>
                                        <li><a href="{{ url('/logout') }}"> Logout</a></li>
                                
                                    </li>
                    @endif
        </ul>

            </div>
        </div>
    </nav>



    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}




 <!-- DATATABLES    -->      
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
        $('#myTable').DataTable( {
        "scrollX": true,
        "iDisplayLength": 25,
        "lengthMenu": [ [20, 25, 50, -1], [20, 25, 50, "All"] ]
        } );
        } );
        </script>

</body>
</html>
