<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <strong>@include('layouts.errors')</strong>  
    </div>
</div>


@if(Auth::user() && (Auth::user()->loan_roles_id == "1") || (Auth::user()->loan_roles_id == "2") || (Auth::user()->loan_roles_id == "3"))

<div class="container" style="background-color: white">
    <div class="row">
        <div class="panel-heading">
            <h4> <i class="fa fa-calendar fa-2x"  style="padding-right: 10px"></i> 
                All Loan Applications
            </h4>
        </div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>




      <div class="panel-body">

<table id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Loan Amount</th>
                                        <th class="text-center">Monthly Deductions</th>
                                        <th class="text-center">HR Status</th>
                                        <th class="text-center">MGT Head</th>
                                        <th class="text-center">GM Status</th>
                                    @if(Auth::user() && (Auth::user()->loan_roles_id == "2"))
                                        <th class="text-center">Repayed Loan?</th>
                                    @endif
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($users as $user)
          <tr>
                <td class="text-center" style="width: 1%" >{{$rows = $rows + 1 }}</td>
               
                <td class="text-center"> 
                     <a style="text-decoration: none;" href="/loan_status/{{$user->user_id}}"  data-toggle="tooltip" title="View Loan History">
                        <?php getName($user->user_id); ?> 
                    </a>
                </td>

                <td class="text-center"><a href="/loan_info/{{$user->id}}"   data-toggle="tooltip" title="View Loan Details">₦<?php echo number_format($user->amount, 2); ?> </a> </td>
                <td class="text-center" style="width: 15%" > ₦<?php echo number_format($user->installment, 2); ?></td>
                
                <td class="text-center">
                    @if(Auth::user() && (Auth::user()->loan_roles_id == "1"))
                     <a style="text-decoration: none; color: #ffffff" href="/admins/{{$user->id}}/admin_loan_edit"  data-toggle="tooltip" title="HR click to Approve">
                    @endif
                <div class=<?php status1($user->hr_status); ?> > {{ $user->hr_status }} 
                </a> 
                </td>
                
                <td class="text-center">
                    @if(Auth::user() && (Auth::user()->loan_roles_id == "2"))
                     <a style="text-decoration: none; color: #ffffff" href="/admins/{{$user->id}}/admin_loan_edit"  data-toggle="tooltip" title="Payroll Mgt click to Approve">
                    @endif
                <div class=<?php status1($user->mgt_status); ?> > {{ $user->mgt_status }} 
                </a> 
                </td>
                
                <td class="text-center">
                    @if(Auth::user() && (Auth::user()->loan_roles_id == "3"))
                     <a style="text-decoration: none; color: #ffffff" href="/admins/{{$user->id}}/admin_loan_edit"  data-toggle="tooltip" title="GM click to Approve">
                    @endif
                <div class=<?php status1($user->gm_status); ?> > {{ $user->gm_status }} 
                </a> 
                </td>
 @if(Auth::user() && (Auth::user()->loan_roles_id == "2"))
<td class="text-center">

    @if(($user->repayment_status == "1") && ($user->complete_status == 1))
        <small><i class="fa fa-check-circle fa-sm" style="color: green"   data-toggle="tooltip" title="Payment Completed"></i> </small>
    @elseif(($user->complete_status == 1))
    <form class="form-inline" method="post" action="/repayment_status/{{$user->id}}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

          <div class="form-group">
            <select class="form-control input-sm" name="repayment_status" value="{{ $user->repayment_status }}" style="width: 100%;">
                <option value="{{ $user->repayment_status }}"> <?php getStatus($user->repayment_status); ?></option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default btn-sm">Submit</button>
    </form>
    @else
   <span style="color: red"> *</span>
    @endif
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



  



    </div>
</div>

@else

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ACCESS DENIED </div>

                <div class="panel-body" align="center" style="color: red">
                <div><img src="{{ asset('access_denied.jpg') }}"></div>
                You do not have permission to view this page <br/>
                    Please contact your Administrator
                </div>
            </div>
        </div>
    </div>
</div>


@endif


@endsection
