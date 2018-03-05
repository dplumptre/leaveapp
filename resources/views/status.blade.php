<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
             <div class="panel-heading" align="center">   @include('layouts.errors') </div>
            <div class="panel panel-default">
                  
                        
                <div class="panel-heading">Leave Status</div>

                <div class="panel-body">
                                  
@if($users->leaves()->count()==0)
    <div class="panel-heading" align="center" style="color: red"> <h5> You have not applied for any leave </h5></div>

@else
<table  id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR/Admin</th>
                                        <th class="text-center">Form</th>
                                        <th class="text-center"><i class="fa fa-comments fa-2"></i> </th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
  <?php $rows = 0; ?>                                 
 @foreach($users->leaves() as $user)
          <tr>
                <td class="text-center" style="width: 1%" >{{ $rows = $rows + 1 }}</td>
                <td class="text-center" style="width: 20%" >{{ $user->name }}</td>
                <td class="text-center" style="width: 12%" ><small>{{ date('d-M-Y ', strtotime($user->leave_starts)) }} </small></td>
                <td class="text-center" style="width: 12%" ><small>{{ date('d-M-Y ', strtotime($user->leave_ends)) }} </small></td>
                <td class="text-center">{{ $user->working_days_no }} </td>
                <td class="text-center" style="width: 12%" ><div class=<?php status($user->approval_status); ?> > {{ $user->approval_status }} </td>
                <td class="text-center"><div class=<?php status1($user->admin_approval_status); ?> > {{ $user->admin_approval_status }} </td>
    <td class="text-center"style="width: 5%" >
        @if(($user->approval_status == "Approved") && ($user->admin_approval_status == "Approved"))
        <a href="/leave_return/{{$user->id}}/edit"  data-toggle="tooltip" title="Leave return form">
            <i class="fa fa-table fa-2"></i> 
        </a>
       @if($user->resumed_on) <i class="fa fa-check-circle fa-2"></i> @endif
        @endif
    </td>
                <td class="text-center"style="width: 15%" > {{ $user->admin_remark }} </td>
                
                    @endforeach

     

        </tbody>
    </table>



<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


@endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
