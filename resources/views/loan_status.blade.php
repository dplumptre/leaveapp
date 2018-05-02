<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')


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
                                        <th class="text-center">MGT </th>
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
  @if($user->repayment_status == "1")
       <i class="fa fa-check-circle fa-sm" style="color: blue"   data-toggle="tooltip" title="MGT Loan Repayment confirmation"></i> 
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


    </div>
</div>







@endsection
