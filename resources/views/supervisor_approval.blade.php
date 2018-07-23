<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
             <div class="panel-heading" align="center">   @include('layouts.errors') </div>
            <div class="panel panel-default">
                
                        
                <div class="panel-heading"><img src="{{ asset('view_details.jpg') }}" style="padding-right: 10px">LEAVE APPLICATIONS</div>

                <div class="panel-body">
                                  

@if($requests->count()==0)
    <div class="panel-heading" align="center" style="color: red"> <h5> No leave application to approve </h5></div>

@else
<table id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Confirm</th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center" style="width: 20%" ><a href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Click to Approve Leave"> {{ $request->name }}</a></td>
                <td class="text-center" style="width: 12%" ><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-c.enter" style="width: 12%" ><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center" style="width: 15%" >{{ $request->reason }}</td>
                <td class="text-center" style="width: 11%" >
                    <a href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Click to Approve Leave"> 
                        <div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} </div>
                    </a>
                </td>
                <td class="text-center"><div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} </td>
                <td class="text-center"><small><em>
                   @if($request->returnee_signature)
                    Resumed
                   @endif
                </td></small></em>

                <td class="text-center"> 
                    @if($request->super_confirm_signature)
                        <i class="fa fa-check-circle" style="color: green"></i>
                    @endif
                </td>
                <td class="text-center">
                    @if($request->returnee_timestamp)
                    <a href="/uh_confirmation/{{$request->id}}/edit"  data-toggle="tooltip" title="Confirm Staff Resumption"> 
                	<i class="fa fa-check-circle fa-2x"></i> </a>
                    @endif
                </td>
            </tr>



<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>


@endforeach
            
        </tbody>
    </table>

@endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
