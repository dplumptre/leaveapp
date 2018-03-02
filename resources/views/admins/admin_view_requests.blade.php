s@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">LEAVE REQUESTS

               <form class="form-inline pull-right" action="/admins/search" method="post">
                     {{ csrf_field() }}
  
      <input type="text" class="btn-xs" id="search" name="search" placeholder="search employee" required>
    
  <button type="submit" class="btn btn-primary btn-xs">Search</button>
</form>

                </div>

                <div class="panel-body">
                
                  <table class="table table-striped">
                      <tr>
                        <th>Employee Name</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Days</th>
                        <th>Available</th>
                        <th>Status</th>
                        <th>Reason</th>
                        <th> </th>
                      </tr>
                      @foreach($requests as $request)
                      <tr>
                        <td><li> <a href="/leaves/{{$request->id}}/hod_edit"> {{ $request->name }}</li> </a></td>
                        <td> {{ $request->leave_starts }}</td>
                        <td> {{ $request->leave_ends }}</td>
                        <td> {{ $request->working_days_no }}</td>
                        <td> {{ $request->balance }}</td>
                        <td style="font-style: italic; color: red"> {{ $request->approval_status }}</td>
                        <td> {{ $request->reason }}</td>
                        <td>
                        <div class="pull-right">
                          
                          <a href="/leaves/{{$request->user_id}}/history" class="btn btn-default btn-xs">View History</a>

                        </div>
                        </td>
                      </tr>  
                    @endforeach
                      <tr>
                          <td colspan="4" align="center">
                            <div  class="btn btn-xs">  <?php echo $requests->links(); ?> </div>
                         </td>
                      </tr>
              </table>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
