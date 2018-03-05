@extends('layouts.app')

@section('content')
<div class="container">
                         
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel-heading" align="center">   @include('layouts.errors') </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">EDIT PROFILE </div>
            </div>


<div class="panel-body" >
       
<form method="post" action="/profile/{{ $user->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
                  
 <input type="hidden" name="id" id="author_id" value="{{ $user->id }}">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Name * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="name" placeholder="Enter Name" style="margin-bottom: 10px" type="text" value="{{ $user->name }}" readonly required/>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
             @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Email Address * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" id="email" name="email" placeholder="choose email Address" style="margin-bottom: 10px" type="text" value="{{ $user->email }}" readonly=""  required/>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
             @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Job Title * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="job_title"  placeholder="Enter Job Title" style="margin-bottom: 10px" type="text"  value="{{ $user->job_title }}" />
             @if ($errors->has('job_title'))
                <span class="help-block">
                    <strong>{{ $errors->first('job_title') }}</strong>
                </span>
             @endif
        </div>
    </div>


     <div class="form-group{{ $errors->has('entitled') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Leave Entitlement * </label>
        <div class="controls col-md-5 ">  
            <input class="input-md  textinput textInput form-control" name="entitled" placeholder="Leave Entitlement" style="margin-bottom: 10px" type="text"  value="{{ $user->entitled }}" readonly="" />
             @if ($errors->has('entitled'))
                <span class="help-block">
                    <strong>{{ $errors->first('entitled') }}</strong>
                </span>
             @endif
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-md-4"> Marital Status * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="marital_status" value="{{ $user->marital_status }}"  style="margin-bottom: 10px" required >
                <option value="{{ $user->marital_status }}"> --Select Status -- </option>
                <option value="Single">Single</option>
                <option value="Married">Married </option>
                <option value="Single Parent">Single Parent </option>
                <option value="Widowed">Widowed </option>
                <option value="Divorced">Divorced </option>
            </select>
        </div>             
    </div>
                         
      <div class="form-group">
        <label class="control-label col-md-4"> Gender * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="gender" value="{{ $user->gender }}" required  style="margin-bottom: 10px">
                    <option  value="{{ $user->gender }}">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
            </select>   
        </div>             
    </div> 

    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Date of Birth * </label>
        <div class="controls col-md-5 ">  
            <input class="input-md  textinput textInput form-control" name="dob" placeholder="DD/MM/YYY" style="margin-bottom: 10px" type="date"  value="{{ $user->dob }}" required />
             @if ($errors->has('dob'))
                <span class="help-block">
                    <strong>{{ $errors->first('dob') }}</strong>
                </span>
             @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Phone Number* </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="mobile" placeholder="080xxxxxxxx" style="margin-bottom: 10px" type="text"  value="{{ $user->mobile }}" required />
             @if ($errors->has('mobile'))
                <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
             @endif
        </div>
    </div>
    


    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Address* </label>
        <div class="controls col-md-6 ">  
        <textarea class="input-md  textinput textInput form-control" name="address" placeholder="Enter Address" style="margin-bottom: 10px" type="text"  value="{{ $user->address }}" required >{{ $user->address }}</textarea>
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
             @endif
        </div>
    </div>
    

   <div class="form-group"> <div class="aab controls col-md-4 "></div>
    <div class="controls col-md-8 ">
        <input type="submit" name="create" value="Update Profile" class="btn btn-primary" />
    </div>
</div> 
                            
</form>


            </div>
        </div>
    </div> 
</div>
    



</div>
@endsection
