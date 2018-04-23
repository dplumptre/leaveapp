@extends('layouts.app')

@section('content')
<div class="container">
            
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2"> @include('layouts.errors')
        
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">EDIT USER PROFILE </div>
            </div>


<div class="panel-body" >
        

<form method="post" action="/admins/{{ $user->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
                  
 <input type="hidden" name="id" id="author_id" value="{{ $user->id }}">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Name * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="name" placeholder="Enter Name" style="margin-bottom: 10px" type="text" value="{{ $user->name }}" required/>
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
         



    <div class="form-group">
        <label class="control-label col-md-4"> Department * </label>
        <div class="controls col-md-8 ">  
            <select class="input-md  textinput textInput form-control"  name="department"  style="margin-bottom: 10px">
                <option value="{{ $user->department }}"> {{ $user->department }} </option>
                @foreach($departments as $department) 
                    <option value="{{ $department->name }}"> {{ $department->name }} </option>
                @endforeach
            </select>
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

 <div class="form-group">
        <label class="control-label col-md-4"> Role * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="role" value="{{ $user->role }}"  style="margin-bottom: 10px"  >
                    <option  value="{{ $user->role }}">{{ $user->role }}</option>
                    <option value="admin">Administrator</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="staff">Staff</option>
            </select>   
        </div>             
    </div>


                            <!-- Loan Role Section  -->
<!-- This portion toggles whether the Loan role  -->
<!-- will show or not base on what is checked. Please don't change -->

<div class="form-group">
    <div class="col-md-12 btn-info" style="padding: 5px;">
        <label style="padding: 0 20px 0 10px;">Can User Manage Loan Application? * </label>
        <label style="padding-right: 10px;"><input type="radio" name="search" value="standard" onClick="show_hide('standard', 'advanced')" checked /> No </label>
        <label style="padding-left: 10px;"><input type="radio" name="search" value="advanced" onClick="show_hide('advanced', 'standard')" /> Yes</label>

    </div>      
</div>


<div class="form-group">
    <div class="controls col-md-12 ">  
        <div class="form-group" id="standard" style="display: block;"> </div>
    </div>             
</div>


<div class="form-group">
    <div id="advanced" style="display: none;">
        <label class="control-label col-md-4"> Assign Loan Role * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="loan_roles_id" value="{{ $user->loan_roles_id }}"  style="margin-bottom: 10px"  >
                <option  value="{{ $user->loan_roles_id }}"><?php getLoanRole($user->loan_roles_id) ; ?></option>
                <option value="0">None</option>
                <option value="1">HR Admin</option>
                <option value="2">Payroll MGT</option>
                <option value="3">General Manager</option>
            </select>   
        </div>             
    </div>
</div>


<script>
    function show_hide(show, hide)
{
document.getElementById(show).style.display="block";
document.getElementById(hide).style.display="none";
}
</script>



<!-- End of Loan Role Section -->


    


    <div class="form-group" style="padding-bottom: 5%">
        <label class="control-label col-md-4"> Grade * </label>
        <div class="controls col-md-5 ">  
            <select class="input-md  textinput textInput form-control"  name="grade"  value="{{old('grade')}}"  style="margin-bottom: 10px" >
                <option value="{{ $user->grade }}" > {{ $user->grade }} </option>
                @foreach($grades as $grade) 
                    <option value="{{ $grade->level }}"> {{ $grade->level }} </option>
                @endforeach
            </select>
        </div>             
    </div>   

    
    <div class="form-group" style="padding-bottom: 5%">
        <label class="control-label col-md-4"> Employee Type * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control" name="employee_type"  value="{{old('employee_type')}}"  style="margin-bottom: 10px" >
                <option value="{{ $user->employee_type }}" > {{ $user->employee_type }} </option>
                 @foreach($employee_types as $type) 
                    <option value="{{ $type->employee_type }}"> {{ $type->employee_type }} </option>
                @endforeach
            </select>
        </div>             
    </div>


    <div class="form-group{{ $errors->has('date_of_hire') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Date of Hire * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="date_of_hire" placeholder="Date of Hire" style="margin-bottom: 10px" type="date"  value="{{ $user->date_of_hire }}" />
             @if ($errors->has('date_of_hire'))
                <span class="help-block">
                    <strong>{{ $errors->first('date_of_hire') }}</strong>
                </span>
             @endif
        </div>
    </div>


     <div class="form-group{{ $errors->has('entitled') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Leave Entitlement * </label>
        <div class="controls col-md-5 ">  
            <input class="input-md  textinput textInput form-control" name="entitled" placeholder="Days" style="margin-bottom: 10px" type="text"  value="{{ $user->entitled }}" />
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
            <select class="input-md  textinput textInput form-control"  name="marital_status" value="{{ $user->marital_status }}"  style="margin-bottom: 10px">
                <option value="{{ $user->marital_status }}"> {{ $user->marital_status }} </option>
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
        <div class="controls col-md-5 ">  
            <select class="input-md  textinput textInput form-control"  name="gender" value="{{ $user->gender }}"  style="margin-bottom: 10px">
                    <option  value="{{ $user->gender }}">{{ $user->gender }}</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
            </select>   
        </div>             
    </div> 

    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Date of Birth * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" name="dob" placeholder="DD/MM/YYY" style="margin-bottom: 10px" type="date"  value="{{ $user->dob }}"  />
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
            <input class="input-md  textinput textInput form-control" name="mobile" placeholder="080xxxxxxxx" style="margin-bottom: 10px" type="text"  value="{{ $user->mobile }}"  />
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
        <textarea class="input-md  textinput textInput form-control" name="address" placeholder="Enter Address" style="margin-bottom: 10px" type="text"  value="{{ $user->address }}"  >{{ $user->address }}</textarea>
            @if ($errors->has('address'))
                <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
             @endif
        </div>
    </div>
    




   <div class="form-group"> <div class="aab controls col-md-4 "></div>
    <div class="controls col-md-8 ">
        <input type="submit" name="create" value="Update Details" class="btn btn-primary" />
    </div>
</div> 
                            
</form>


            </div>
        </div>
    </div> 
</div>
    
   
</div>



@endsection
