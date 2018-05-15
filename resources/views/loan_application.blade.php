@extends('layouts.app')

@section('content')
<div class="container">

       
    <div id="signupbox" style=" margin-top:30px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          <strong>@include('layouts.errors')</strong>

        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">NEW LOAN APPLICATION</div>
            </div>

                <div class="panel-body">
                           

@if( (date("d") > 10) && ($status[0]->status  == "OFF") )
  <!-- Application form Closes from the 1st to 10th of every month -->
<p style="color: red; text-align: center"> 
  You cannot apply for loan at this time. 
  <br>You can only apply from 1st to 10th of every month 
</p>

@elseif( (date("d") > 10) && ($status[0]->status  == "ON") )
  <!-- Application form opened by admin even though the Date is more than 11th  by changing the status to ON -->
  

  <form method="post" action="/store_loan">
          {{ csrf_field() }}

      <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
          <label class="control-label col-md-12"> How much are you applying for? * </label>
          <div class="form-group col-md-12 ">

              <div class="input-group">
                <div class="input-group-addon">₦</div>
                <input type="text" class="form-control" name="amount" placeholder="Amount">
                <div class="input-group-addon">.00</div>
            </div>
            <em style="color: #ccc">Please do not include a comma</em>
        </div>
      </div>


      
      <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
          <label class="control-label col-md-12"> Purpose/Reason For the Loan * </label>
          <div class="controls col-md-12 ">  
          <textarea class="input-md  textinput textInput form-control"  name="purpose"placeholder="purpose for taking loan" style="margin-bottom: 10px" type="text" value="{{old('purpose')}}" required></textarea>
              
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
                <input type="text" class="form-control" name="installment" placeholder="Amount">
                <div class="input-group-addon">.00</div>
            </div>
            <em style="color: #ccc">Please do not include a comma</em>
        </div>
      </div>




      <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
          <label class="control-label col-md-12"> Deduction should take effect from * </label>
          <div class="controls col-md-12 ">  
              <input class="input-md  textinput textInput form-control" name="deduction_start"  style="margin-bottom: 10px" type="date" value="{{old('leave_starts')}}" required/>
              @if ($errors->has('leave_starts'))
                  <span class="help-block">
                      <strong>{{ $errors->first('leave_starts') }}</strong>
                  </span>
               @endif
          </div>
      </div>



    
  <input type="hidden" name="loan_status" value="Pending" readonly="">
  <input type="hidden" name="user_id" value="<?php echo Auth::user()->id ?>" readonly="">

    
  <div class="form-group"> <div class="controls col-md-4 "></div>
      <div class="controls col-md-12 ">
          <input type="submit" name="create" value="Apply For Loan" class="btn btn-primary btn btn-block" />
      </div>
  </div> 
           

  </form>


@else
  <!-- Application form displays from the 11th of every month -->

  <form method="post" action="/store_loan">
          {{ csrf_field() }}




      <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
          <label class="control-label col-md-12"> How much are you applying for? * </label>
          <div class="form-group col-md-12 ">

              <div class="input-group">
                <div class="input-group-addon">₦</div>
                <input type="text" class="form-control" name="amount" placeholder="Amount">
                <div class="input-group-addon">.00</div>
            </div>
            <em style="color: #ccc">Please do not include a comma</em>
        </div>
      </div>


      
      <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
          <label class="control-label col-md-12"> Purpose/Reason For the Loan * </label>
          <div class="controls col-md-12 ">  
          <textarea class="input-md  textinput textInput form-control"  name="purpose"placeholder="purpose for taking loan" style="margin-bottom: 10px" type="text" value="{{old('purpose')}}" required></textarea>
              
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
                <input type="text" class="form-control" name="installment" placeholder="Amount">
                <div class="input-group-addon">.00</div>
            </div>
            <em style="color: #ccc">Please do not include a comma</em>
        </div>
      </div>




      <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
          <label class="control-label col-md-12"> Deduction should take effect from * </label>
          <div class="controls col-md-12 ">  
              <input class="input-md  textinput textInput form-control" name="deduction_start"  style="margin-bottom: 10px" type="date" value="{{old('leave_starts')}}" required/>
              @if ($errors->has('leave_starts'))
                  <span class="help-block">
                      <strong>{{ $errors->first('leave_starts') }}</strong>
                  </span>
               @endif
          </div>
      </div>



    
  <input type="hidden" name="loan_status" value="Pending" readonly="">
  <input type="hidden" name="user_id" value="<?php echo Auth::user()->id ?>" readonly="">

    
  <div class="form-group"> <div class="controls col-md-4 "></div>
      <div class="controls col-md-12 ">
          <input type="submit" name="create" value="Apply For Loan" class="btn btn-primary btn btn-block" />
      </div>
  </div> 
           

  </form>


@endif




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
