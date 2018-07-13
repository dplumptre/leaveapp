@extends('layouts.app')

@section('content')
<div class="container">
       <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        @include('layouts.errors')
        
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">Edit DEPARTMENT</div>
            </div>


    <div class="panel-body" >
            <div style="color: green" align="center">
                @if (Session::has('status'))
                    {{ Session::get('status') }}
                 @endif
            </div>



  



        <form action="{{ route('admin.update.department', $data->id) }}" method="post">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}  

                  
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Name of Department </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="name" value="{{ $data->name }}"placeholder="Enter Name of Department" style="margin-bottom: 10px" type="text" />
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
             @endif
        </div>
    </div>



     <div class="form-group"> <div class="controls col-md-4 "></div>
        <div class="controls col-md-8 ">
            <input type="submit" name="create" value="Edit Department" class="btn btn-primary btn btn-info" />
        </div>
    </div> 

  </form>

    </div>

</div>

@endsection
