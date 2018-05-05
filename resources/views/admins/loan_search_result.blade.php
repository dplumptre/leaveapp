<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')
<div id="divContents">

<div class="container">
    <div class="row">
        <strong>@include('layouts.errors')</strong>  
    </div>
</div>


<div class="container" style="background-color: white">
    <div class="row">
        <div class="panel-heading">
            <h4>Approved Loans From<small>
                <span style="padding: 0 10px 0 10px;">{{ date('d-M-Y ', strtotime($start)) }}</span> - <span style="padding: 0 10px 0 10px;">{{ date('d-M-Y ', strtotime($end)) }}</span> 
            </small> </h4>
        </div>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>



<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>




<div class="panel-body">




<table class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Loan Amount</th>
                                        <th class="text-center">Monthly Deductions</th>
                                        <th class="text-center"> Approved Amount</th>
                                        <th class="text-center">Deduction Start</th>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($users as $user)
          <tr>
                <td class="text-center" style="width: 1%" >{{$rows = $rows + 1 }}</td>
               
                <td class="text-center"> 
                        <?php getName($user->user_id); ?> 
                </td>

                <td class="text-center">₦<?php echo number_format($user->amount, 2); ?>  </td>
                <td class="text-center" style="width: 15%" > ₦<?php echo number_format($user->installment, 2); ?></td>
                
                <td class="text-center">
                    {{ $user->amount_approved }}
                </a> 
                </td>
                
                <td class="text-center">
                   
                 <small>{{ date('d-M-Y ', strtotime($user->deduction_start)) }} </small>
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


</div> <!-- dvContents close -->

<div  style="padding: 30px 0 0 600px">
<button onclick="printContent('divContents')" class="btn btn-danger"> Print Form</button>
</div>

@endsection
