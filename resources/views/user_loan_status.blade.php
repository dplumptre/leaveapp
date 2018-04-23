<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')


@if($user_loan_status == 0)
<div class="container" style="background-color: white">
    <div class="row">
        
        <div class="panel-heading">
            <h4> <i class="fa fa-calendar fa-2x"  style="padding-right: 10px"></i> 
                <?php // getName($users[0]->user_id); ?> Loan History
            </h4>
        </div>


<div class="panel-body">
   
<div class="panel-heading" align="center" style="color: red"> 
     <img src="{{ asset('logo.png') }}"> 
    <h4> You have not applied for any Loan </h4>
</div>

@else


<div class="container" style="background-color: white">
    <div class="row">
        

        <div class="panel-heading">
            <h4> <i class="fa fa-calendar fa-2x"  style="padding-right: 10px"></i> 
                <?php  getName($users[0]->user_id); ?> Loan History
                
            </h4>
        </div>


<div class="panel-body">

<table id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Amount Applied For</th>
                                        <th class="text-center">Deduction Starts</th>
                                        <th class="text-center">Monthly Deduction</th>
                                        <th class="text-center">HR </th>
                                        <th class="text-center">Payroll MGT</th>
                                        <th class="text-center">GM </th>
                                        <th class="text-center">Repayed Loan?</th>
                                        <th class="text-center"> HR </th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($users as $user)

          <tr>
                <td class="text-center" style="width: 1%" >{{$rows = $rows + 1 }}</td>
                <td class="text-center"><a href="/loan_info/{{$user->id}}"   data-toggle="tooltip" title="View Loan Details">₦<?php echo number_format($user->amount, 2); ?> </a></td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($user->deduction_start)) }} </small></td>
                <td class="text-center"> ₦<?php echo number_format($user->installment, 2); ?></td>
                 
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

<td class="text-center">
    @if($user->complete_status == "1")
        <small><i class="fa fa-check-circle fa-sm"   data-toggle="tooltip" title="Loan Repayment Verification"></i> </small>

    @elseif(($user->hr_status == "Approved") && ($user->mgt_status == "Approved") && ($user->gm_status == "Approved"))
    <form class="form-inline" method="post" action="/complete_status/{{$user->id}}">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

          <div class="form-group">
            <select class="form-control input-sm" name="complete_status" value="{{ $user->complete_status }}" style="width: 100%;">
                <option value="{{ $user->complete_status }}"> <?php getStatus($user->complete_status); ?></option>
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>
        <button type="submit" class="btn btn-default btn-sm">Submit</button>
    </form>

    @elseif($user->hr_status == "Approved")
       <i class="fa fa-question-circle fa-sm" style="color: red"   data-toggle="tooltip" title="Pending Loan">
    @else
    
    <a href="/loan_edit/{{$user->id}}"   data-toggle="tooltip" title="Edit Loan Application"><i class="fa fa-edit fa-lg" style="color: blue"></i> </a>
    @endif
</td>

<td class="text-center">
  @if($user->repayment_status == "1")
       <i class="fa fa-check-circle fa-sm" style="color: blue"   data-toggle="tooltip" title="HR Loan Repayment confirmation"></i> 
  @endif
   
</td>

</tr>

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







@endsection
