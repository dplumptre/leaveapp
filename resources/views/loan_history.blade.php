<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white">
    <div class="row">
        


<div class="panel-heading">
                <h3> <i class="fa fa-calendar fa-2x"  style="padding-right: 10px"></i> {{$users->name}} 
                      <div class="pull-right"> <a href="/admins/users/{{$users->id}}" data-toggle="tooltip" title="View full User datail"> 
                        </a> 
                      </div>
                </h3>
            </div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<div class="panel panel-default">
    <div class="panel-heading">
               
        <?php
            $LeaveEntitlement = $users->entitled;
            $Total_working_days= $users->leaves()->sum('days_hr_approved') ;
            $Balance = $LeaveEntitlement - $Total_working_days ;
            $Alert = "Staff Leave for the year is complete!";
            $Alert1 = "Staff has taken more leave than entitled!";
        ?>

<h5><i class="fa fa-calculator fa-2x"  style="padding-right: 10px"></i>  Leave Entitlement: <a href="#" class="btn btn-info btn-sm" style="margin-right: 10px"> <?php echo $LeaveEntitlement ?> </a> 
Days gone on leave: <a href="#" class="btn btn-success btn-sm" style="margin-right: 10px"> <?php echo $Total_working_days ?></a> Balance: <a href="#" class="btn btn-warning btn-sm"> <?php echo  $Balance; ?> </a>

    <b style="color: red; padding-left: 20px">
        <?php 

            if (($Total_working_days > $LeaveEntitlement)){
              echo $Alert1;
            }
            elseif (($Total_working_days == $LeaveEntitlement)){
              echo $Alert;
            }
            else{
              echo "";
            }

        ?>
    </b>

</h5>
                        
    </div>
</div>


      <div class="panel-body">

<table id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($users->leaves() as $request)
          <tr>
                <td class="text-center" style="width: 1%" >{{$rows = $rows + 1 }}</td>
                <td class="text-center" style="width: 20%" ><a href="/supervisor/{{$request->id}}/edit"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center"> {{ $request->working_days_no }}</td>
                <td class="text-center" style="width: 20%" > {{ $request->reason }}</td>
                <td class="text-center">
                    <a style="text-decoration: none; color: #ffffff" href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Unit Head Approval" style> 
                        <div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} 
                    </a> 
                </td>
                <td class="text-center">
                     <a style="text-decoration: none; color: #ffffff" href="/admins/{{$request->id}}/admin_edit"  data-toggle="tooltip" title="HR Approval">
                <div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} 
                </a> 
                </td>
<td class="text-center">
  @if(Auth::user()->role == "admin")
      <a href="/admins/{{$request->id}}/admin_edit"  data-toggle="tooltip" title="Click to Approve/Dissaprove">
        <small><i class="fa fa-check-circle fa-2x"></i> </small>
      </a>

  @endif
   
</td>

</tr>
                    @endforeach
            
        </tbody>
    </table>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>



  



    </div>
</div>







@endsection
