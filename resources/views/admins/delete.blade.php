@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">

                  <form action="/{{$users->id}}/delete" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                    <input type="hidden" name="id" id="id" value="{{ $users->id }}"><br />

                            <h4 align="center">Are you sure you want to delete this user with all its record?
                            <br/> Please note that you cannot undo this action!</h4>

                        <div class="panel-body">
                            <button type="submit" class="btn btn-danger btn-lg btn-block pull-right">Confirm Delete
                         </div>

                  </form>
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
