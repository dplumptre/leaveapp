<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
@extends('layouts.app')

@section('content')
    
<div class="row">
        <div class="col-md-10 col-md-offset-1">
                    <div class="panel-heading" align="center">   @include('layouts.errors') </div>
            <div class="panel panel-default">
                    
                        
                <div class="panel-heading"><i class="fa fa-calendar fa-2x"  style="padding-right: 10px"></i> 
                LEAVE RETURN DETAILS</div>

                <div class="panel-body">
                                  


<table  id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Resumption</th>
                                        <th class="text-center">Date Resumed</th>
                                        <th class="text-center"></th>
                                        <th class="text-center">Reason</th>
                                        <th class="text-center">Unit Head</th>
                                        <th class="text-center">HR/Admin</th>
                                        <th class="text-center">Remark</th>
<th class="text-center"> <i class="fa fa-check-circle" > </i> </th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($requests as $request)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center" style="width: 20%" >{{ $request->name }} </td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($request->resumption_date)) }} </small></td>
                <td class="text-center" style="width: 12%" ><small>{{ date($request->resumed_on) }} </small></td>
                <td class="text-center"><b style="color: red">

                <?php
                    $resumption_date = $request->resumption_date;
                    $resumed_on = $request->resumed_on;

                    if (($resumed_on != "") && ($resumption_date != $resumed_on)) {
                        echo "?";
                    }
                    
                ?>


                </b></td>
                <td class="text-center" style="width: 15%" > {{ $request->reason_unable }}</td>
            <td class="text-center"  style="width: 9%; color: green"> 
                @if($request->super_confirm_signature)
                    <i class="fa fa-check-circle" style="padding-left: 15px;"> </i> 
                @else 
                @endif
            </td>
                <td class="text-center"> 
                    @if($request->hr_confirm_signature)
                        <i class="fa fa-check" style="padding-left: 15px;"> </i> 
                    @else 
                    @endif
                </td>
                <td class="text-center"> {{ $request->admin_remark }} </td>

         
<td class="text-center">
   <a style="text-decoration: none; color: #ffffff" href="/admins/{{$request->id}}/admin_confirm"   data-toggle="tooltip" title="HR Confirmation" style> 
       <div class="btn btn-warning btn-xs" > Confirm
   </a> 
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

@endsection
