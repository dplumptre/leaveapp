<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">

@extends('layouts.app')

@section('content')
    
<div class="row">
        <div class="col-md-10 col-md-offset-1">
             <div class="panel-heading" align="center">   @include('layouts.errors') </div>
            <div class="panel panel-default">
                        
                <div class="panel-heading"><img src="{{ asset('cal_sm.jpg') }}" style="padding-right: 10px">
                ALL LEAVE REQUESTS</div>

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
                                        <th class="text-center"><strike>N</strike>? </th>

                                        @if(Auth::user()->loan_roles->slug !== 'hr-admin' )

                                        @else
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"  style="width: 20%"><a href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Approve/Dissaprove leave as supervisor"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center"> {{ $request->working_days_no }}</td>
                <td class="text-center"> {{ $request->reason }}</td>
                <td class="text-center" style="width: 3%"> <small><?php   getAllowance($request->allowance) ?></small></td>



                @if(Auth::user()->loan_roles->slug !== 'hr-admin' )

                @else


                <td class="text-center" style="width: 9%">
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
    <a href="/admins/{{$request->user_id}}/history"  data-toggle="tooltip" title="View Leave History">
        <i class="fa fa-calendar fa-3"  style="padding-right: 10px"></i>
    </a>
    <a href="/admins/{{$request->id}}/admin_edit"  data-toggle="tooltip" title="Approve/Dissaprove Leave as HR">
        <i class="fa fa-check-circle fa-3" ></i>
    </a>
   
</td>
@endif
</tr>
                    @endforeach

        </tbody>
    </table>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection
