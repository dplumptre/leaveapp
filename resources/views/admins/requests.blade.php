@extends('layouts.app')

@section('content')
    
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 @if (Session::has('status'))
                    <div class="panel-heading" align="center" style="color: green">{{ Session::get('status') }}</div>
                @endif
                        
                <div class="panel-heading"><img src="{{ asset('cal_sm.jpg') }}" style="padding-right: 10px">
                ALL LEAVE REQUESTS</div>

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
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"><a href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Approve/Dissaprove leave as supervisor"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center"> {{ $request->working_days_no }}</td>
                <td class="text-center"> {{ $request->reason }}</td>
                <td class="text-center"> {{ $request->unit_head_name }}</td>
                <td class="text-center"><div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} </td>

            <td class="text-center"><div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} </td>
<td class="text-center">
    <a href="/admins/{{$request->user_id}}/history"  data-toggle="tooltip" title="View Leave History">
        <img src="{{ asset('info2.jpg') }}" alt="View Leave History" style="padding-right: 10px">
    </a>
    <a href="/admins/{{$request->id}}/admin_edit"  data-toggle="tooltip" title="Approve/Dissaprove Leave as HR">
        <img src="{{ asset('approve_user.jpg') }}" alt="Approve/Dissaprove"  style="padding-right: 10px">
    </a>
   
</td>

</tr>
                    @endforeach
            
            <tr>
                <td colspan="10" align="center">
                    <div  class="btn btn-xs">  <?php echo $requests->links(); ?> </div>
                </td>
            </tr>
        </tbody>
    </table>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

@endsection
