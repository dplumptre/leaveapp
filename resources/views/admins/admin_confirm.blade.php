@extends('layouts.app')

@section('content')
<div class="container">    
                
    <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
         @include('layouts.errors')

        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">Leave return detail of {{ $users->name }}</div>
            </div>


<div class="panel-body" >

<table class="table" style="border: none;">

<div>
    <tr> <td><b>Name</td> <td><div  class="btn btn-success btn-xs">{{ $users->name }} </td> <td></td> <td></td></tr>
    <tr> <td><b>Department</td> <td>{{ $users->department }} </td> <td></td>  <td></td></tr>

</div>
<tr class="info"> <td> <b>Leave Details </b></td> <td> </td>  <td></td> <td></td></tr>
<div>

    <tr> <td><b>Leave Type</td> <td>{{ $users->leave_type }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Leave Starts</td> <td><div  class="btn btn-info btn-xs"><small>{{ date('d-M-Y ', strtotime($users->leave_starts)) }} </small> </td>  <td>Leave Ends:</td><td><div  class="btn btn-danger btn-xs"><small>{{ date('d-M-Y ', strtotime($users->leave_ends)) }} </small> </td></tr>
    <tr> <td><b>Reason for going on leave</td> <td>{{ $users->reason }} </div></td> <td></td> <td> </td> </tr>
  
    <tr> <td><b>No of days</td> <td><div  class="btn btn-warning btn-xs">{{ $users->working_days_no }} </td>  <td></td> <td></td></tr>
    
    <tr> <td><b>Date supposed to resume</td> <td><div  class="btn btn-info btn-xs"><small>{{ date('d-M-Y ', strtotime($users->resumption_date)) }} </small> </td> <td><b>Date resumed</td>  <td><div  class="btn btn-info btn-xs"><small>{{ date('d-M-Y ', strtotime($users->resumed_on)) }} </small></td></tr>


    <tr> <td><b>Reason</td> <td>{{ $users->reason_unable }}  </td> <td></td>  <td></td></tr>


    <tr> <td><b>Mobile <b></td> <td>{{ $users->mobile }} </td>  <td></td> <td></td></tr>
</div>

<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
<tr class="danger"> <td colspan="4"> <b>Unit Head Confirmation Status </b></td></tr>
     <tr> <td><b>Confirmed by:</td> <td><div  class="btn btn-success btn-xs">{{ $users->supervisor_confirmation }} </div></td> <td></td> <td> </td> </tr>

<tr> <td><b>Date Confirmed:</td> <td>{{ $users->date_signed }} </div></td> <td></td> <td> </td> </tr>

<tr> <td><b>Signature:</td> <td>{{ $users->super_confirm_signature }} </div></td> <td></td> <td> </td> </tr>


<tr class="default"> <td> <b></b></td> <td> </td>  <td></td> <td></td></tr>
<tr class="success"> <td colspan="4" align="center"> <b>ADMIN CONFIRMATION </b></td></tr>

</table>           
         

<form method="post" action="/admins/{{$users->id}}/admin_confirm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

<div style="margin-bottom: 10px; padding-left: 15px">
    <b>HR manager's comment: </b>
    <textarea class="input-md  textinput textInput form-control"  id="admin_remark" name="admin_remark" placeholder="HR manager's comment" style="margin-bottom: 10px" type="text" rows="4" cols="7"></textarea> 
</div>


<div class="form-group{{ $errors->has('hr_confirm_signature') ? ' has-error' : '' }}">
         <div id="div_id_terms" class="checkbox required" align="center">
            <label for="hr_confirm_signature" class=" requiredField">
                <input class="input-ms checkboxinput" id="hr_confirm_signature" name="hr_confirm_signature" style="margin-bottom: 10px" type="checkbox" value="{{ Auth::user()->email }}"/>
                         <em class="info" style="color: red; padding-right: 10px""> Please tick the box to append your signature / date </em>

                          @if ($errors->has('hr_confirm_signature'))
                <span class="help-block">
                    <strong>{{ $errors->first('hr_confirm_signature') }}</strong>
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
        </div>
    </div> 
</div>
    






@endsection


