@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if (Session::has('status'))
                    <div class="panel-heading"  align="center" style="color: green">{{ Session::get('status') }}</div>
                @endif
                        
                <div class="panel-heading"><img src="{{ asset('view_details.jpg') }}" style="padding-right: 10px">LEAVE APPLICATIONS</div>

                <div class="panel-body">
                                  

@if($requests->count()==0)
    <div class="panel-heading" align="center" style="color: red"> <h5> No leave application to approve </h5></div>

@else
<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                        <th class="text-center">Resumed ?</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Confirm</th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"><a href="/supervisor/{{$request->id}}/edit"   data-toggle="tooltip" title="Click to Approve Leave"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center">{{ $request->reason }}</td>
                <td class="text-center"><div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} </td>
                <td class="text-center"><div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} </td>
                <td class="text-center"><a href="/uh_confirmation/{{$request->id}}/edit"> <small>

                <?php
                    $status = $request->returnee_signature;
                    if ($status == "") {
                        echo "";
                    }
                    else{
                        echo "Yes";
                    }
                ?>
                </a></td></small>

                <td class="text-center"> 

                <?php
                    $uh_status = $request->super_confirm_signature;
                    if ($uh_status == "") {
                        echo "";
                    }
                    else{
                        echo "*";
                    }
                ?>


                </a></td>
                <td class="text-center"><a href="/uh_confirmation/{{$request->id}}/edit"  data-toggle="tooltip" title="Confirm Staff Resumption"> 
                	<img src="{{ asset('check1.jpg') }}" </a></td>
            </tr>



<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>


@endforeach
            
            <tr>
                <td colspan="10" align="center">
                    <div  class="btn btn-xs">  <?php //echo $requests->links(); ?> </div>
                </td>
            </tr>
        </tbody>
    </table>

@endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
