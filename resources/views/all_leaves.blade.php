@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 @if (Session::has('status'))
                    <div class="panel-heading">{{ Session::get('status') }}</div>
                @endif
                        
                <div class="panel-heading"><img src="{{ asset('chart.jpg') }}" style="padding-right: 10px">ALL LEAVE APPLICATION</div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR</th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"><a href="/supervisor/{{$request->id}}/edit"> {{ $request->name }}</a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->leave_ends)) }} </small></td>
                <td class="text-center"><div class=<?php status($request->approval_status); ?> > {{ $request->approval_status }} </td>
                <td class="text-center"><div class=<?php status1($request->admin_approval_status); ?> > {{ $request->admin_approval_status }} </td>
            </tr>
                    @endforeach
            
            <tr>
                <td colspan="6" align="center">
                    <div  class="btn btn-xs">  <?php echo $requests->links(); ?> </div>
                </td>
            </tr>
        </tbody>
    </table>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
