@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ACCESS DENIED </div>

                <div class="panel-body" align="center" style="color: red">
                <div><img src="{{ asset('access_denied.jpg') }}"></div>
                You do not have permission to view this page <br/>
                    Please contact your Administrator
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
