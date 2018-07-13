<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">

@extends('layouts.app')

@section('content')
<div class="container">
   
  <div class="row">
        <div class="col-md-10 col-md-offset-1">
<div class="panel-heading" align="center">   @include('layouts.errors') </div>
           
            <div class="panel panel-default">
        




           

                        
                <div class="panel-heading"><i class="fa fa-users fa-2x"  style="padding-right: 10px"></i> 

                ALL EMPLOYEES </div>

                <div class="panel-body">
                                  


<table id="myTable"  class="table-responsive table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Dept</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Date of Hire</th>
                            <th class="text-center"><a href="/admins/create" data-toggle="tooltip" title="Create New User"> 
                           <i class="fa fa-user-plus fa-2" ></i> </th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($employees as $employee)
          <tr>
                <td class="text-center" style="width: 1%" >{{$rows = $rows + 1 }}</td>
                <td class="text-center" style="width: 30%" > {{ $employee->name }}</td>
                <td class="text-center">{{ $employee->departments->name }}</td>
                <td class="text-center">{{ $employee->role }}</td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($employee->date_of_hire)) }} </small></td>
    <td class="text-center">
        <a href="/admins/users/{{$employee->id}}" data-toggle="tooltip" title="View User">
            <i class="fa fa-eye fa-2" style="padding-right: 8px; padding-left: 8px;"></i> 
        </a>
        <a href="/admins/{{$employee->id}}/edit" data-toggle="tooltip" title="Edit User">
            <i class="fa fa-edit fa-2" style="padding-right: 8px; padding-left: 8px;"></i> 
        </a>
        <a href="/admins/{{$employee->id}}/delete" onclick="javascript:return confirm('Are you sure to delete user')"  data-toggle="tooltip" title="Delete User">
            <i class="fa fa-trash fa-2" style="padding-right: 8px; padding-left: 8px; color: red"></i> 
        </a>
                    
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

    </td>
         
  </tr>


                    @endforeach

     
        </tbody>
    </table>



   
</div>
@endsection
