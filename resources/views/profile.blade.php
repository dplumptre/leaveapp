@extends('layouts.app')

@section('content')
<div class="container">
   
 <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

    <div class="panel-heading">
        <h4> {{$users->name}}   </h4>
    </div>
                

        <div class="panel-body">  

                    <table class="table" style="border: none;">
<tr class="info"> <td> <b>WORK DETAILS </b></td> <td> </td>  <td></td> <td><div class="pull-right">
    <a href="/profile/{{$users->id}}/edit" class="btn btn-primary btn-xs">Edit</a>
</div></td></tr>
<div>
    <tr> <td><b>Email</td> <td><div  class="btn btn-success btn-xs">{{ $users->email }} </td> <td></td> <td></td></tr>
    <tr> <td><b>Department</td> <td>{{ $users->department }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Job Title</td> <td>{{ $users->job_title }} </td>  <td></td><td></td></tr>
    <tr> <td><b>Role</td> <td><div  class="btn btn-info btn-xs">{{ $users->role }} </div></td> <td></td> <td> </td> </tr>
    <tr> <td><b>Grade</td> <td>{{ $users->grade }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Employee Type</td> <td>{{ $users->employee_type }} </td> <td></td>  <td></td></tr>
    <tr> <td><b>Date of Hire</td> <td>{{ $users->date_of_hire }} </td>  <td></td> <td></td></tr>
    <tr> <td><b>Leave Entitlement</td> <td><div  class="btn btn-danger btn-xs">{{ $users->entitled }} </td>  <td></td> <td></td></tr>
    <tr> <td><b></td> <td></td>  <td></td> <td></td></tr>
</div>

<tr class="danger"> <td> <b>CONTACT DETAILS </b></td> <td> </td>  <td></td> <td></td></tr>
<div>
    <tr> <td><b>Gender</td> <td>{{ $users->gender }} </td>  <td></td> <td></td></tr>
    <tr> <td><b>Date of Birth</td> <td>{{ $users->dob }} </td>  <td></td> <td></td></tr>
    <tr> <td><b>Marital Status</td> <td>{{ $users->marital_status }} </td>  <td></td> <td></td></tr>
    <tr> <td><b>Phone No.</td> <td>{{ $users->mobile }} </td>  <td></td> <td></td></tr>
    <tr> <td><b>Address</td> <td>{{ $users->address }} </td>  <td></td> <td></td></tr>
                          
</div>

</table>           
                  
                
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection
