@extends('layouts.app')

@section('content')
<div class="container">
   
  <div class="row">
        <div class="col-md-10 col-md-offset-1">



        @if ( Session::has('flash_message') )
            
             <div class="text-center alert {{ Session::get('flash_type') }}">
                 <h3>{{ Session::get('flash_message') }}</h3>
             </div>
             
           @endif

           
            <div class="panel panel-default">
        




           

                        
                <div class="panel-heading"><img src="{{ asset('all_users.jpg') }}" style="padding-right: 10px">
                ALL EMPLOYEES </div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Dept</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Date of Hire</th>
                                        <th class="text-center" style="width: 10%;">Actions</th>
                            <th class="text-center"><a href="/admins/create" data-toggle="tooltip" title="Create New User"> 
                            <img src="{{ asset('add_small.jpg') }}" alt="New User"></th>
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($employees as $employee)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center"> {{ $employee->name }}</td>
                <td class="text-center">{{ $employee->department }}</td>
                <td class="text-center">{{ $employee->role }}</td>
                <td class="text-center"><small>{{ date('d-M-Y ', strtotime($employee->date_of_hire)) }} </small></td>
    <td class="text-center">

        <a href="/admins/users/{{$employee->id}}" data-toggle="tooltip" title="View User">
            <img src="{{ asset('view.jpg') }}" alt="View">
        </a>
        <a href="/admins/{{$employee->id}}/edit" data-toggle="tooltip" title="Edit User">
            <img src="{{ asset('edit_user.jpg') }}"  alt="Edit" style="padding-right: 8px; padding-left: 8px;">
        </a>
        <a href="/admins/{{$employee->id}}/delete" onclick="javascript:return confirm('Are you sure to delete user')"  data-toggle="tooltip" title="Delete User">
            <img src="{{ asset('delete_small.jpg') }}"  alt="Delete">
        </a>
                    
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

    </td>
         <td class="font-w600"></td>
  </tr>


                    @endforeach

     
<tr>
   <td colspan="6" align="center">
      <div  class="btn btn-xs"> <?php echo $employees->links()  ; ?> </div>
   </td>
                      
                     
</tr>
        </tbody>
    </table>



   
</div>
@endsection
