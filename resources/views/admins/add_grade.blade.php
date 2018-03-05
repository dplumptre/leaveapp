@extends('layouts.app')

@section('content')
<div class="container">
       <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> @include('layouts.errors')
        
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">ADD GRADE LEVEL</div>
            </div>


    <div class="panel-body" >
            <div style="color: green" align="center">
                @if (Session::has('status'))
                    {{ Session::get('status') }}
                 @endif
            </div>


<form method="post" action="/admins/new_grade">
        {{ csrf_field() }}
         
                  
    <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Grade Level </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" id="level" name="level" placeholder="Enter Name of Department" style="margin-bottom: 10px" type="text" />
            @if ($errors->has('level'))
                <span class="help-block">
                    <strong>{{ $errors->first('level') }}</strong>
                </span>
             @endif
        </div>
    </div>

     <div class="form-group"> <div class="controls col-md-4 "></div>
        <div class="controls col-md-8 ">
            <input type="submit" name="create" value="Add New Grade Level" class="btn btn-primary btn btn-info" />
        </div>
    </div> 

  </form>

    </div>

</div>

@endsection
