@extends('layouts.app')

@section('content')
<div class="container">
                         
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
   <div class="panel-heading" align="center">   @include('layouts.errors') </div>
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title" align="center">STAFF LEAVE DETAILS</div>
            </div>
<div class="panel-body" >
     

<table class="table" style="border: none;">

<div>
    <tr> <td><b>Name</td> <td><div  class="btn btn-success btn-xs">{{ $users->name }} </td> <td></td> <td></td></tr>
    <tr> <td><b>Department</td> <td>{{ $users->department }} </td> <td></td>  <td></td></tr>


    <tr> <td><b>Leave Type</td> <td>{{ $users->leave_type }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Leave Starts</td> <td><div  class="btn btn-info btn-xs">{{ date('d-M-Y ', strtotime($users->leave_starts)) }}  </td>  <td>Leave Ends:</td><td><div  class="btn btn-danger btn-xs">{{ date('d-M-Y ', strtotime($users->leave_ends)) }} </td></tr>
    <tr> <td><b>Reason for going on leave</td> <td>{{ $users->reason }} </div></td> <td></td> <td> </td> </tr>

  
    <tr> <td><b>No of days </td> <td><div  class="btn btn-warning btn-xs">{{ $users->working_days_no }} </td>  <td></td> <td></td></tr>

    <tr> <td><b>Resumption Date</td> <td><div  class="btn btn-info btn-xs"> {{ date('d-M-Y ', strtotime($users->resumption_date)) }} </td> <td></td>  <td></td></tr>



    <tr> <td><b>Mobile <b></td> <td>{{ $users->mobile }} </td>  <td></td> <td></td></tr>
</div>

<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
<tr class="danger" align="center"> <td colspan="4"> <b>LEAVE RETURN FORM</b></td> </tr>
<tr  align="center"> <td colspan="4"> 
<div style=" color: red; text-align: center;"> Please note that extension of leave days is a breach of policy and may attract sanctions in addition to loss of pay for the unauthorized days  

</div></td> </tr>
</table>          


         

<form method="post" action="/leave_return/{{$users->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}


<div style="margin-bottom: 10px; padding-left: 15px">
I <em class="info" style="color: red; padding-right: 10px"> {{ Auth::user()->name }} </em> commenced leave on <div class="btn btn-info btn-xs">{{ date('d-M-Y ', strtotime($users->leave_starts)) }}</div>
</div>


<div style="margin-bottom: 10px; padding-left: 15px">
    <b>I resumed from leave on: </b><input class="input-md  textinput textInput form-control col-md-3" id="resumed_on" name="resumed_on" placeholder="Resumed from leave on" style="margin-bottom: 10px" type="date" />
</div>




<div style="margin-bottom: 10px; padding-left: 15px">
    <b>I was unable to resume on the said date because of the following reasons: </b>
    <textarea class="input-md  textinput textInput form-control"  id="reason_unable" name="reason_unable" placeholder="Reason for not resuming on time" style="margin-bottom: 10px" type="text" rows="4" cols="7"></textarea> 
</div>


<input type="hidden" name="returnee_timestamp" value="<?php echo date('d-m-y h:i');?>">
 




<div class="form-group{{ $errors->has('returnee_signature') ? ' has-error' : '' }}">
         <div id="div_id_terms" class="checkbox ">
            <label for="returnee_signature" class=" requiredField">
                <input class="input-ms checkboxinput" id="returnee_signature" name="returnee_signature" style="margin-bottom: 10px;" align="center" type="checkbox" value="{{ Auth::user()->email }}"  required />
                          <em class="info" style="color: red; padding-right: 10px">Tick this box to confirm resumption <br></em> 

            @if ($errors->has('returnee_signature'))
                <span class="help-block">
                    <strong>{{ $errors->first('returnee_signature') }}</strong>
                </span>
            @endif
            </label>
        </div>                             
</div> 




<div class="form-group"> <div class="aab controls col-md-4 "></div>
    <div class="controls col-md-8 ">
        <input type="submit" name="create" value="Submit" class="btn btn-primary btn btn-info btn-lg" />
    </div>
</div> 
         
</form>



</div>
@endsection
