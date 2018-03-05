@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body" align="center">
                @if(Auth::guest())
                <i class="fa fa-leaf fa-5x" style="color: green"></i>
                   <h4 style="line-height: 30px">Welcome to The Fountain Of Life Church <br />
                    Leave Application Portal. <br /> 
                   Kindly <a href="{{ url('/login') }}">Login</a> to Begin</h4>
                 @endif
@if(Auth::user())                                 
<a href="{{ url('/apply') }}" data-toggle="tooltip" title="Apply For leave">
   <div style="margin:30px 0px 30px 0px "class="col-md-4"><i class="fa  fa-5x fa-pencil-square-o "></i> <br /> LEAVE APPLICATION</div>
</a>
<a href="/status/{{ Auth::user()->id }}" data-toggle="tooltip" title="View leave History/Status"> 
   <div style="margin:30px 0px 30px 0px "class="col-md-4"><i class="fa  fa-5x fa-calendar "></i> <br /> LEAVE STATUS </div>
</a>

<a href="/profile/{{ Auth::user()->id }}" data-toggle="tooltip" title="View/Edit Your Profile"> 
   <div style="margin:30px 0px 30px 0px " class="col-md-4"><i class="fa  fa-5x fa-eye "></i>  <br /> VIEW PROFILE</div>
</a>

 @if(Auth::user() && (Auth::user()->role == "admin"))
 <a href="/admins/create" data-toggle="tooltip" title="Create New User"> 
  <div style="margin:30px 0px 30px 0px " class="col-md-4"><i class="fa  fa-5x fa-user-plus "></i> <br />CREATE USER</div>
</a>

 <a href="/admins/users" data-toggle="tooltip" title="View All Users"> 
  <div style="margin:30px 0px 30px 0px " class="col-md-4"><i class="fa  fa-5x fa-users "></i> <br />VIEW USERS</div>
</a>

 <a href="/admins/requests" data-toggle="tooltip" title="Approve Leave Applications"> 
  <div style="margin:30px 0px 30px 0px " class="col-md-4"><i class="fa  fa-5x fa-check-circle "></i> <br />APPROVE LEAVE</div>
</a>
@endif

@endif
                </div>
            </div>
        </div>
    </div>





</div>


@endsection
