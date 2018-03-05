@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel-heading" align="center">   @include('layouts.errors') </div>
                         
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">UNIT HEAD APPROVAL </div>
            </div>
<div class="panel-body" >
     

<table class="table" style="border: none;">

<div>
    <tr> <td><b>Name</td> <td><div  class="btn btn-success btn-xs">{{ $users->name }} </td> <td></td> <td></td></tr>
    <tr> <td><b>Department</td> <td>{{ $users->department }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Unit Head</td> <td>{{ $users->unit_head_name }} </td> <td></td>  <td></td></tr>

</div>
<tr class="info"> <td> <b>Leave Details </b></td> <td> </td>  <td></td> <td></td></tr>
<div>

    <tr> <td><b>Leave Type</td> <td>{{ $users->leave_type }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Leave Starts</td> <td><div  class="btn btn-info btn-xs">{{ date('d-M-Y ', strtotime($users->leave_starts)) }}  </td>  <td>Leave Ends:</td><td><div  class="btn btn-danger btn-xs">{{ date('d-M-Y ', strtotime($users->leave_ends)) }} </td></tr>
    <tr> <td><b>Reason for going on leave</td> <td>{{ $users->reason }} </div></td> <td></td> <td> </td> </tr>

  
    <tr> <td><b>No of days </td> <td><div  class="btn btn-warning btn-xs">{{ $users->working_days_no }} </td>  <td></td> <td></td></tr>

    <tr> <td><b>Resumption Date</td> <td><div  class="btn btn-info btn-xs"> {{ date('d-M-Y ', strtotime($users->resumption_date)) }} </td> <td></td>  <td></td></tr>

<tr> <td><b>Name of Reliever</td> <td>{{$users->reliever_name }} </td> <td></td>  <td></td></tr>


    <tr> <td><b>Mobile <b></td> <td>{{ $users->mobile }} </td>  <td></td> <td></td></tr>
</div>

<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
<tr class="danger" align="center"> <td colspan="4"> <b>APPROVE/DISSAPROVE </b></td> </tr>
</table>           
         


<form method="post" action="/supervisor/{{$users->id}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}


<div class="form-group{{ $errors->has('signature') ? ' has-error' : '' }}">
         <div id="div_id_terms" class="checkbox required">
            <label for="signature" class=" requiredField">
                <input class="input-ms checkboxinput" id="signature" name="signature" style="margin-bottom: 10px;" align="center" type="checkbox" value="{{ Auth::user()->email }}"  required />
                         I <em class="info" style="color: red; padding-right: 10px"> {{ Auth::user()->name }} </em> Approves/Dissaproves this leave request

                          @if ($errors->has('signature'))
                <span class="help-block">
                    <strong>{{ $errors->first('signature') }}</strong>
                </span>
             @endif
            </label>
        </div>                             
</div>  



    <div class="form-group">
        <label class="control-label col-md-4"> Approval Status * </label>
        <div class="controls col-md-8 ">  
            <select class="input-md  textinput textInput form-control"  name="approval_status" value="{{old('approval_status')}}" style="margin-bottom: 10px" required>
                    <option>{{ $users->approval_status }}</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
            </select>   
        </div>             
    </div>   




<input type="hidden" name="date_unithead_approved" value="<?php echo date('d-m-y h:i');?>">

<input type="hidden" name="unit" value="{{$users->department}}" readonly="">    
<input type="hidden" name="applicant_name" value="{{$users->name}}" readonly="">                         
<input type="hidden" name="user_id" value="{{$users->user_id}}" readonly="">  


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
