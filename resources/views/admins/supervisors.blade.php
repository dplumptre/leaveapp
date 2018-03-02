@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">All Unit heads</div>

                <div class="panel-body">
               
                @foreach($unit_heads as $unit_head)
                    <li> {{ $unit_head->firstname }} </li>               
                 @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
