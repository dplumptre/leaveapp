@extends('layouts.app')

@section('content')
<div class="container">

       
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          @include('layouts.errors')

        <div class="panel panel-primary">
            <div class="panel-heading">
                 <div class="panel-title"> EDIT LOAN APPLICATION</div>
            </div>

                <div class="panel-body">

                           
@foreach($users as $user)


<form method="post" action="/update_loan_edit/{{$user->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}


    <div style="padding: 20px 0 30px 0;">
        <label class="control-label col-md-4"> Applicant Name: </label>
        <label class="control-label col-md-6"> <span class=" btn-success btn-sm"><?php getName($user->user_id); ?> </span></label><small>{{ date('d-M-Y ', strtotime($user->created_at)) }} </small>
    </div>

    <div class="form-group{{ $errors->has('leave_starts') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Amount Applied for:  </label>
        <div class="form-group col-md-12 ">

            <div class="input-group">
              <div class="input-group-addon">₦</div>
              <input type="text"  class="form-control" name="amount" value="{{$user->amount}}">
              <div class="input-group-addon">.00</div>
          </div>
              <em style="color: #ccc">Please do not include a comma</em>
      </div>
    </div>


    
    <div class="form-group{{ $errors->has('purpose') ? ' has-error' : '' }}">
        <label class="control-label col-md-12"> Purpose/Reason For the Loan * </label>
        <div class="controls col-md-12 ">  
        <textarea class="input-md  textinput textInput form-control"  name="purpose" style="margin-bottom: 10px" type="text" value="{{old('purpose')}}" >{{$user->purpose}}</textarea>
            
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
              <input type="text"  class="form-control" name="installment" value="{{$user->installment}}">
              <div class="input-group-addon">.00</div>
          </div>
              <em style="color: #ccc">Please do not include a comma</em>
      </div>
    </div>




    <div class="form-group">
        <label class="control-label col-md-12"> Deduction should take effect from * </label>
        <div class="controls col-md-12 ">  
            <input class="input-md  textinput textInput form-control" name="deduction_start"  style="margin-bottom: 10px" type="date" value="{{ date('d M Y ', strtotime($user->deduction_start)) }}" />
        </div>
    </div>


@endforeach

<div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Update Changes" class="btn btn-info btn btn-block" />
    </div>
</div> 

</form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
