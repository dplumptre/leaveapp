@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h4> Search User


       
                </h4></div>

                <div class="panel-body">
<div align="center">             
    <form class="form-inline" action="/admins/search_result" method="post">
                         {{ csrf_field() }}
      <div><img src="{{ asset('search.jpg') }}"></div>
<input type="text" class="btn-sm" id="search" name="search" placeholder=" Enter Name to search " required> 
<button type="submit" class="btn btn-primary btn-sm">Search User</button>
    </form>      
</div>           

      </div>
            </div>
        </div>
    </div>
</div>
@endsection
