@if ($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @if ( !empty($header) && $header === true )
        <h4><i class="icon fa fa-ban"></i> Form Errors</h4>
        @endif
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif


@if(session()->has('message.level'))
<div class="alert alert-{{ session('message.level') }}"> 
{!! session('message.content') !!}
</div>
@endif


