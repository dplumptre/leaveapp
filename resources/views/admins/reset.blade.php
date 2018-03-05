@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <div class="panel-heading" align="center">   @include('layouts.errors') </div>
            <div class="panel panel-default">
                <div class="panel-heading"><h4> LEAVE RESET 
       
                </h4></div>

                <div class="panel-body">
<div align="center">             
    <form class="form-inline" action="/admins/reset_leave" method="post">
                         {{ csrf_field() }}
      <div style="margin-bottom: 10px" align="center"><img src="{{ asset('access_denied.jpg') }}"></div>
      <h3>Please read the informations below carefully before you click the reset button!</h3>
      
         <h4 style="margin-bottom: 10px; color: red" align="center"> The LEAVE RESET should be done once in a year. (preferably 01-01-20XX)                                  <br>
           Please note that you can not undo this action                          <br>
           Click the RESET button below if you are sure you want to carry out the reset for all users?         <br></h4>
        
     

<button type="submit"  onclick="javascript:return confirm('Are you sure you want to perform RESET?')"   class="btn btn-primary btn-lg" style="margin-top: 30px">RESET LEAVE COUNTER</button>
    </form>      
</div>           

      </div>
            </div>
        </div>
    </div>
</div>
@endsection
