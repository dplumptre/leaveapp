@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel-heading" align="center">   @include('layouts.errors') </div>
                         
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title" align="center">LEAVE RETURN FORM </div>
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

    <tr> <td><b>Resumption Date</td> <td><div  class="btn btn-info btn-xs"> {{ date('d-M-Y ', strtotime($users->resumption_date)) }} </td> <td><b>Date Resumed</td>  <td><div  class="btn btn-danger btn-xs"> {{ $users->resumed_on }} </td></tr>

    <tr> <td><b>Reason <b></td> <td>{{ $users->reason_unable }} </td>  <td></td> <td></td></tr>
    <tr> <td><b>Mobile <b></td> <td>{{ $users->mobile }} </td>  <td></td> <td></td></tr>
</div>

<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
</table>          


<form method="post" action="/uh_confirmation/{{$users->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

<input type="hidden" readonly name="supervisor_confirmation" value="{{ Auth::user()->name }}">

<table class="table" style="border: none;">
<tr class="danger" align="center"> <td colspan="4"> <b>UNIT HEAD CONFIRMATION </b></td> </tr>
</table>

<div class="form-group{{ $errors->has('super_confirm_signature') ? ' has-error' : '' }}">
         <div id="div_id_terms" class="checkbox required">
            <label for="super_confirm_signature" class=" requiredField">
                <input class="input-ms checkboxinput" id="super_confirm_signature" name="super_confirm_signature" style="margin-bottom: 10px;" align="center" type="checkbox" value="{{ Auth::user()->email }}"  required />
                          I <em class="info" style="color: red; padding-right: 10px"> {{ Auth::user()->name }} </em> confirm that the above named person has resumed duties in the department </em> 

                          @if ($errors->has('super_confirm_signature'))
                <span class="help-block">
                    <strong>{{ $errors->first('super_confirm_signature') }}</strong>
                </span>
             @endif
            </label>
        </div>                             
</div> 



<input type="hidden" name="date_signed" value="<?php echo date('d-m-y h:i');?>" >

<div class="form-group"> <div class="aab controls col-md-4 "></div>
    <div class="controls col-md-8 ">
        <input type="submit" name="create" value="Submit" class="btn btn-primary btn btn-info btn-lg" />
    </div>
</div> 
         
</form>

        </div>
    </div>
</div>
@endsection
