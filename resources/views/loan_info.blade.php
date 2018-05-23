@extends('layouts.app')

@section('content')
<div class="container">

       
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          @include('layouts.errors')

        <div class="panel panel-info">
          <div class="panel-heading">
           <div class="panel-title"> LOAN DETAILS  
            <a style="text-decoration: none;" href="/loan_status/{{$users[0]->user_id}}"  data-toggle="tooltip" title="View Loan History">
              <span class=" btn-default btn-sm" style="float: right;"> <?php getName($users[0]->user_id); ?> </span>
            </a>
           
          </div>
        </div>

                <div class="panel-body">
                           
@foreach($users as $user)



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



  
    <div class="form-group{{ $errors->has('mgt_comment') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Payroll Manager Comment </label>
        <div class="controls col-md-12 ">  
        <textarea class="input-md  textinput textInput form-control"  name="mgt_comment" style="margin-bottom: 10px" type="text" value="{{old('mgt_comment')}}" readonly>{{$user->mgt_comment}}</textarea>
            
            @if ($errors->has('mgt_comment'))
                <span class="help-block">
                    <strong>{{ $errors->first('mgt_comment') }}</strong>
                </span>
             @endif
        </div>
    </div>
    





@if($user->gm_status == "Approved")
  <label style="padding: 5px 5px 5px 5px;"></label>


<label class="control-label col-md-12" style="padding-left: 35%"> <span class="btn-default" style="padding: 10px">GM APPROVAL DETAILS</span></label>
    <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Amount Approved * </label>
        <div class="form-group col-md-12 ">

             <div class="input-group">
              <div class="input-group-addon">₦</div>
              <input type="text" readonly class="form-control" name="installment" value="<?php echo number_format($user->amount_approved, 2); ?>" style="color: red">
              <div class="input-group-addon">.00</div>
          </div>
      </div>
    </div>

@endif

@endforeach


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
