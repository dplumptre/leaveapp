@extends('layouts.app')

@section('content')
<div class="container">
   
  <div class="row">
        <div class="col-md-10 col-md-offset-1">
             @include('layouts.errors')
        
            <div class="panel panel-default">
                        
                <div class="panel-heading"><img src="{{ asset('chart.jpg') }}" style="padding-right: 10px">
                ALL GRADE LEVELS</div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Grade Levels</th>
                            <th class="text-center"><a href="/admins/add_grade" data-toggle="tooltip" title="Add New Grade Level"> 
                               <i class="fa fa-plus-circle fa-2x"></i> 
                                    </tr>
                                </thead>
                                
                                 
                                <tbody>
                            <?php $rows = 0; ?>         
 @foreach($grades as $grade)
          <tr>
                <td class="text-center">{{$rows = $rows + 1 }}</td>
                <td class="text-center">{{ $grade->level }}</td>
                <td class="text-center">
    <a href="/admins/{{$grade->id}}/delete_grade" onclick="javascript:return confirm('Are you sure to delete grade level?')"  data-toggle="tooltip" title="Delete Grade Level">
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
