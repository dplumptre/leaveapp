@extends('layouts.app')

@section('content')
<div class="container">

       


    <div id="signupbox" style=" margin-top:30px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
          @include('layouts.errors')

        <div class="panel panel-info">
            <div class="panel-heading">
                 <div class="panel-title">SHOW / HIDE LOAN APPLICATION FORM</div>
            </div>

                <div class="panel-body">
        

<form method="post" action="/admins/{{$form_status[0]->id}}/activate">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        

    <div class="form-group">
        <div class="controls col-md-8" >  
            <select class="input-md  textinput textInput form-control" id="status"  name="status" value="{{ $form_status[0]->status }}"required  style="margin-bottom: 10px">
                    <option >{{ $form_status[0]->status }}</option>
                    <option value="ON">SHOW FORM</option>
                    <option value="OFF">HIDE FORM</option>
            </select>   
        </div>  

        <div class="controls col-md-4 "> 
            <input type="submit" name="create" value="Save Changes" class="btn btn-primary btn btn-block" /> </div>
        </div>            
    </div>   
  
</form>

                </div>
            </div>
        </div>
    </div>


@endsection
