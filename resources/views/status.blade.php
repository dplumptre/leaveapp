@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                  @if (Session::has('status'))
                    <div class="panel-heading"  align="center" style="color: green">{{ Session::get('status') }}</div>
                @endif
                        
                <div class="panel-heading">Leave Status</div>

                <div class="panel-body">
                                  
@if($users->leaves()->count()==0)
    <div class="panel-heading" align="center" style="color: red"> <h5> You have not applied for any leave </h5></div>

@else
<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">From</th>
                                        <th class="text-center">To</th>
                                        <th class="text-center">Days</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR/Admin</th>
                                        <th class="text-center">Leave Return Form</th>
        <th class="text-center"><img src="{{ asset('info_status.jpg') }}" alt="Leave Return Form"></th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
  <?php $rows = 0; ?>                                 
 @foreach($users->leaves() as $user)
          <tr>
                <td class="text-center">{{ $rows = $rows + 1 }}</td>
                <td class="text-center">{{ $user->name }}</td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($user->leave_starts)) }} </small></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($user->leave_ends)) }} </small></td>
                <td class="text-center">{{ $user->working_days_no }} </td>
                <td class="text-center"><div class=<?php status($user->approval_status); ?> > {{ $user->approval_status }} </td>
                <td class="text-center"><div class=<?php status1($user->admin_approval_status); ?> > {{ $user->admin_approval_status }} </td>
    <td class="text-center"><a href="/leave_return/{{$user->id}}/edit"><img src="{{ asset('edit_user.jpg') }}" alt="Leave Return Form"></a></td>
                <td class="text-center"> {{ $user->admin_remark }} </td>
                
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
