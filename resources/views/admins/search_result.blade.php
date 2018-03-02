@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4> Search Result


       <form class="form-inline pull-right" action="/admins/search_result" method="post">
                     {{ csrf_field() }}
  
      <input type="text" class="btn-xs" id="search" name="search" placeholder="search employee" required>
    
  <button type="submit" class="btn btn-primary btn-xs">Search</button>
</form>
                </h4></div>

                <div class="panel-body">
                  
                    <table class="table">
                      <tr>
                        <th>User Name</th>
                        <th>Department</th>
                        <th>Email</th>
                      </tr>
@foreach($users as $user)
                  <tr>
                    <td><a href="/admins/users/{{$user->id}}"> {{ $user->name }} </a> </td>
                        <td>{{ $user->department }} </a> </td>
                        <td>{{ $user->email }} </a> </td>
                  </tr>
@endforeach
                    </table>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
