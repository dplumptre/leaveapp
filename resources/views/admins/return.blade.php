@extends('layouts.app')

@section('content')
    
<div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 @if (Session::has('status'))
                    <div class="panel-heading" align="center" style="color: green">{{ Session::get('status') }}</div>
                @endif
                        
                <div class="panel-heading"><img src="{{ asset('cal_sm.jpg') }}" style="padding-right: 10px">
                LEAVE RETURN DETAILS</div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Resumption Date</th>
                                        <th class="text-center">Resumed on</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">HOD Signature</th>
                                        <th class="text-center">HR/Admin Signature</th>
                                        <th class="text-center">Remark</th>
<th class="text-center"> <img src="{{ asset('confirm.png') }}" alt="Leave Return Confirmation"></th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center">{{ $request->name }} </td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->resumption_date)) }} </small></td>
                <td class="text-center"><small>{{ date($request->resumed_on) }} </small></td>
                <td class="text-center"><b style="color: red">

                <?php
                    $resumption_date = $request->resumption_date;
                    $resumed_on = $request->resumed_on;

                    if (($resumed_on != "") && ($resumption_date != $resumed_on)) {
                        echo "?";
                    }
                    
                ?>


                </b></td>
                <td class="text-center"> {{ $request->reason_unable }}</td>
            <td class="text-center" style="color: green"> {{ $request->super_confirm_signature }}</td>
                <td class="text-center"> {{ $request->hr_confirm_signature }} </td>
                <td class="text-center"> {{ $request->admin_remark }} </td>

         
<td class="text-center">
   
    <a href="/admins/{{$request->id}}/admin_confirm"  data-toggle="tooltip" title="HR Leave Return Confirmation">
        <img src="{{ asset('check1.jpg') }}" alt="Leave Return Confirmation">
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
