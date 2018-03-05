@extends('layouts.app')

@section('content')
<div class="container">
   
  <div class="row">
        <div class="col-md-10 col-md-offset-1">
             @include('layouts.errors')
        
            <div class="panel panel-default">
                        
                <div class="panel-heading"><img src="{{ asset('users.jpg') }}" style="padding-right: 10px">
                EMPLOYEE TYPES</div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Employee Type</th>
                        <th class="text-center"><a href="/admins/add_employee_type" data-toggle="tooltip" title="Add Employee Type">    <i class="fa fa-plus-circle fa-2x"></i> 
                        </th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($employee_types as $type)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center">{{ $type->employee_type }}</td>
                <td class="text-center">
    <a href="/admins/{{$type->id}}/delete_employee_type" onclick="javascript:return confirm('Are you sure to delete employee type?')"  data-toggle="tooltip" title="Delete Employee Type">
            <i class="fa fa-trash fa-2" style="color: red"></i> 
    </a>
                </td>

             
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

  </tr>


                    @endforeach

  
        </tbody>
    </table>



   
</div>
@endsection
