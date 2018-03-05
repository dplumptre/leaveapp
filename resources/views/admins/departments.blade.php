@extends('layouts.app')

@section('content')
<div class="container">
   
  <div class="row">
        <div class="col-md-10 col-md-offset-1">
             @include('layouts.errors')
        
            <div class="panel panel-default">
                        
                <div class="panel-heading"><img src="{{ asset('setting.jpg') }}" style="padding-right: 10px">
                ALL DEPARTMENTS</div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Departments</th>
                            <th class="text-center"><a href="/admins/add_dept" data-toggle="tooltip" title="Add New Department"> 
                               <i class="fa fa-plus-circle fa-2x"></i> 
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($departments as $department)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center">{{ $department->name }}</td>
                <td class="text-center">
    <a href="/admins/{{$department->id}}/delete_dept" onclick="javascript:return confirm('Are you sure to delete department?')"  data-toggle="tooltip" title="Delete Department">
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
