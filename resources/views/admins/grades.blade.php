@extends('layouts.app')

@section('content')
<div class="container">
   
  <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 @if (Session::has('status'))
                    <div class="panel-heading" style="color: green" align="center">{{ Session::get('status') }}</div>
                @endif
                        
                <div class="panel-heading"><img src="{{ asset('chart.jpg') }}" style="padding-right: 10px">
                ALL GRADE LEVELS</div>

                <div class="panel-body">
                                  


<table class="table-responsive table table-bordered table-striped  js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th class="text-center">Grade Levels</th>
                            <th class="text-center"><a href="/admins/add_grade" data-toggle="tooltip" title="Add New Grade Level"> 
                            <img src="{{ asset('add_small.jpg') }}" alt="New Grade Level"></th>
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
            <img src="{{ asset('delete_small.jpg') }}"  alt="Delete Grade">
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
