@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white">
    <div class="row">
        


<div class="panel-heading">
                <h3> <img src="{{ asset('cal.jpg') }}" alt="Leave History of"> {{$users->name}} 
                      <div class="pull-right"> <a href="/admins/users/{{$users->id}}" data-toggle="tooltip" title="View full User datail"> 
                        <img src="{{ asset('user.jpg') }}" alt="Staff detail"></a> 
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

<h5><img src="{{ asset('storage2.jpg') }}"  style="margin-right: 10px"> 
Leave Entitlement: <a href="#" class="btn btn-info btn-sm" style="margin-right: 10px"> <?php echo $LeaveEntitlement ?> </a> 
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




<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">HOD</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($users->leaves() as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"><a href="/supervisor/{{$request->id}}/edit"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center"> {{ $request->working_days_no }}</td>
                <td class="text-center"> {{ $request->reason }}</td>
                <td class="text-center"> {{ $request->unit_head_name }}</td>
                <td class="text-center"><div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} </td>
                <td class="text-center"><div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} </td>
<td class="text-center">
  @if(Auth::user()->role == "admin")
      <a href="/admins/{{$request->id}}/admin_edit"  data-toggle="tooltip" title="Click to Approve/Dissaprove">
        <img src="{{ asset('approve_user.jpg') }}" alt="Approve/Dissaprove">
      </a>

  @endif
   
</td>

</tr>
                    @endforeach
            
            <tr>
                <td colspan="10" align="center">
                    <div  class="btn btn-xs">  <?php  echo $users->leaves()->links(); ?> </div>
                </td>
            </tr>
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
