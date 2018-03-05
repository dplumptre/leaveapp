@extends('layouts.app')

@section('content')
<div class="container">

       
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          @include('layouts.errors')

        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">NEW LEAVE APPLICATION</div>
            </div>

                <div class="panel-body">
                           

<form method="post" action="/apply">
        {{ csrf_field() }}

    <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> leave Starts * </label>
        <div class="controls col-md-6 ">  
            <input class="input-md  textinput textInput form-control" id="leave_starts" name="leave_starts" placeholder="Leave Starts" style="margin-bottom: 10px" type="date" value="{{old('leave_starts')}}" required/>
            @if ($errors->has('leave_starts'))
                <span class="help-block">
                    <strong>{{ $errors->first('leave_starts') }}</strong>
                </span>
             @endif
        </div>
    </div>


    <div class="form-group{{ $errors->has('leave_ends') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Leave Ends * </label>
        <div class="controls col-md-6 ">  
            <input class="input-md  textinput textInput form-control" id="leave_ends" name="leave_ends" placeholder="Leave ends" style="margin-bottom: 10px" type="date" value="{{old('leave_ends')}}"  required/>
            @if ($errors->has('leave_ends'))
                <span class="help-block">
                    <strong>{{ $errors->first('leave_ends') }}</strong>
                </span>
             @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('working_days_no') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> No of working days * </label>
        <div class="controls col-md-5 ">  
            <input class="input-md  textinput textInput form-control"  id="working_days_no" name="working_days_no" placeholder="No of working days" style="margin-bottom: 10px" type="text" required value="{{old('working_days_no')}}"/>
            @if ($errors->has('working_days_no'))
                <span class="help-block">
                    <strong>{{ $errors->first('working_days_no') }}</strong>
                </span>
             @endif
        </div>
    </div>



 <div class="form-group{{ $errors->has('resumption_date') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Resumption Date * </label>
        <div class="controls col-md-5 ">  
            <input class="input-md  textinput textInput form-control" id="resumption_date" name="resumption_date" placeholder="Enter resumption date DD-MM-YYYY" style="margin-bottom: 10px" type="date" value="{{old('leave_ends')}}"  required/>
            @if ($errors->has('resumption_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('resumption_date') }}</strong>
                </span>
             @endif
        </div>
    </div>




 <div class="form-group">
        <label class="control-label col-md-4"> Leave Type * </label>
        <div class="controls col-md-8 ">  
            <select class="input-md  textinput textInput form-control" id="leave_type" name="leave_type" style="margin-bottom: 10px"  required>
                    <option  value="">Select Leave Type</option>
                    <option value="Annual">Annual</option>
                    <option value="Casual">Casual</option>
            </select>   
        </div>             
    </div>


    <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Reason * </label>
        <div class="controls col-md-6 ">  
        <textarea class="input-md  textinput textInput form-control"  id="reason" name="reason" placeholder="Reason for going on leave" style="margin-bottom: 10px" type="text" value="{{old('reason')}}" required></textarea>
            
            @if ($errors->has('reason'))
                <span class="help-block">
                    <strong>{{ $errors->first('reason') }}</strong>
                </span>
             @endif
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-4"> Name of Reliever * </label>
        <div class="controls col-md-6 ">  
            <select class="input-md  textinput textInput form-control"  name="reliever_name" required  style="margin-bottom: 10px">
                <option value=""> -- Select Reliever -- </option>
                @foreach($relievers as $reliever) 
                    <option value="{{ $reliever->name }}"> {{ $reliever->name }} </option>
                @endforeach
            </select>
        </div>           
    </div>

   
<div class="form-group{{ $errors->has('leave_address') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Leave Address * </label>
        <div class="controls col-md-8 ">  
        <textarea class="input-md  textinput textInput form-control"  id="leave_address" name="leave_address" placeholder="Address during leave" style="margin-bottom: 10px" type="text" value="{{old('leave_address')}}" required></textarea>
            @if ($errors->has('leave_address'))
                <span class="help-block">
                    <strong>{{ $errors->first('reason') }}</strong>
                </span>
             @endif
        </div>
    </div>

 <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
        <label class="control-label col-md-4"> Mobile Number * </label>
        <div class="controls col-md-8 ">  
            <input class="input-md  textinput textInput form-control" id="mobile" name="mobile" placeholder="Mobile No. during leave" style="margin-bottom: 10px" type="text" value="{{old('mobile')}}"  required/>
            @if ($errors->has('mobile'))
                <span class="help-block">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
             @endif
        </div>
    </div>


    @if($allowance > 0)
      
    @else
        <div class="form-group">
            <label class="control-label col-md-4"> Do you want to be paid your leave allowance now? * </label>
            <div class="controls col-md-6 ">  
                <label style="margin: 20px 20px 0px 0px;"><input type="radio" name="allowance"   value="1" checked > YES</label> 
                <label><input type="radio" name="allowance" value="0" > NO</label> 
            </div>           
        </div>
    @endif  
  
<input type="hidden" name="approval_status" value="pending" readonly="">
@foreach($requests as $request)
    <input type="hidden" name="unit_head_name" value="{{$request->name}}" readonly="">
    <input type="hidden" name="unit_head_email" value="{{$request->email}}" readonly="">
@endforeach
  
<div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Apply For Leave" class="btn btn-primary btn btn-block" />
    </div>
</div> 
         

</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
