@extends('layouts.app')

@section('content')
<div class="container">

       
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          @include('layouts.errors')

        <div class="panel panel-primary">
            <div class="panel-heading">
                 <div class="panel-title">LOAN APPROVAL</div>
            </div>

                <div class="panel-body">
                           
@foreach($users as $user)



    <div style="padding: 20px 0 50px 0;">
        <label class="control-label col-md-4"> Applicant Name: </label>
        <label class="control-label col-md-6"> 
            <span class=" btn-success btn-sm">
            <a style="text-decoration: none; color: white" href="/loan_status/{{$users[0]->user_id}}"  data-toggle="tooltip" title="View Loan History"> <?php getName($user->user_id); ?> 
            </a></span></label>
    </div>

    <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Amount Applied for:  <span style="float: right;"> {{ date('d-M-Y ', strtotime($user->created_at)) }} </span></label>
        <div class="form-group col-md-12 ">

            <div class="input-group">
              <div class="input-group-addon">₦</div>
              <input type="text" readonly class="form-control" name="amount" value="<?php echo number_format($user->amount, 2); ?>">
              <div class="input-group-addon">.00</div>
          </div>
      </div>
    </div>


    
    <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Purpose/Reason For the Loan * </label>
        <div class="controls col-md-12 ">  
        <textarea class="input-md  textinput textInput form-control"  name="purpose" style="margin-bottom: 10px" type="text" value="{{old('purpose')}}" readonly>{{$user->purpose}}</textarea>
            
            @if ($errors->has('purpose'))
                <span class="help-block">
                    <strong>{{ $errors->first('purpose') }}</strong>
                </span>
             @endif
        </div>
    </div>
    




    <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Amount to be deducted on a monthly basis * </label>
        <div class="form-group col-md-12 ">

            <div class="input-group">
              <div class="input-group-addon">₦</div>
              <input type="text" readonly class="form-control" name="installment" value="<?php echo number_format($user->installment, 2); ?>">
              <div class="input-group-addon">.00</div>
          </div>
      </div>
    </div>




    <div class="form-group">
        <label class="control-label col-md-12"> Deduction should take effect from * </label>
        <div class="controls col-md-12 ">  
            <input class="input-md  textinput textInput form-control" name="deduction_start"  style="margin-bottom: 10px" type="text" value="{{ date('M Y ', strtotime($user->deduction_start)) }}" readonly/>
        </div>
    </div>

  <label style="padding: 25px 5px 5px 5px;"></label>



<!-- hr Approval Form -->

@if(Auth::user() && (Auth::user()->loan_roles_id == "1"))

<form method="post" action="/admins/{{$user->id}}/admin_loan_approve">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}


    <div class="form-group">
        <label class="control-label col-md-12 " style="padding-left: 40%"> <span class="btn-warning" style="padding: 10px">HR APPROVAL</span> </label>
        <div class="controls col-md-12 " style="padding-top: 20px">  
            <select class="input-md  textinput textInput form-control" id="hr_status"  name="hr_status" value="{{ $user->hr_status }}" onblur="copyValue()" required  style="margin-bottom: 10px">
                    <option >{{ $user->hr_status }}</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
            </select>   
        </div>             
    </div>   
  
<div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Submit" class="btn btn-info btn btn-block" />
    </div>
</div> 
     
</form>

@endif
<!-- hr Approval Form End -->





<!-- Payroll MGT Approval Form -->
@if(Auth::user() && (Auth::user()->loan_roles_id == "2"))

<form method="post" action="/admins/{{$user->id}}/mgt_loan_approve">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

    <div class="form-group">
        <label class="control-label col-md-12" style="padding-left: 35%"> <span class="btn-warning" style="padding: 10px">PAYROLL MGT APPROVAL</span> </label>
        <div class="controls col-md-12 " style="padding-top: 20px">  
            <select class="input-md  textinput textInput form-control" id="mgt_status"  name="mgt_status" value="{{ $user->mgt_status }}" onblur="copyValue()" required  style="margin-bottom: 10px">
                    <option >{{ $user->mgt_status }}</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
            </select>   
        </div>             
    </div>   
  
<div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Submit" class="btn btn-info btn btn-block" />
    </div>
</div> 
     
@endif
</form>
<!-- Payroll MGT Approval Form End -->


<!-- GM Approval Form -->

@if(Auth::user() && (Auth::user()->loan_roles_id == "3"))

<form method="post" action="/admins/{{$user->id}}/gm_loan_approve">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

<label class="control-label col-md-12" style="padding-left: 40%"> <span class="btn-warning" style="padding: 10px">GM APPROVAL </span></label>
    <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Amount Approved * </label>
        <div class="form-group col-md-12 ">

            <div class="input-group">
              <div class="input-group-addon">₦</div>
              <input type="text"  class="form-control" name="amount_approved" placeholder="Enter Amount to Approve">
              <div class="input-group-addon">.00</div>
          </div>
      </div>
    </div>


    <div class="form-group">
       <label class="control-label col-md-12"> Approval Status * </label>
        <div class="controls col-md-12" >  
            <select class="input-md  textinput textInput form-control" id="gm_status"  name="gm_status" value="{{ $user->gm_status }}" onblur="copyValue()" required  style="margin-bottom: 10px">
                    <option >{{ $user->gm_status }}</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
            </select>   
        </div>             
    </div>   
  
<div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Submit" class="btn btn-info btn btn-block" />
    </div>
</div> 

</form>

@endif
<!-- GM Approval Form End -->





@endforeach


                </div>
            </div>
        </div>
    </div>
</div>
@endsection