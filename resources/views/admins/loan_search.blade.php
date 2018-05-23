@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Search Approved Loans </div>

        <div class="panel-body" align="center">
            
                    <strong>@include('layouts.errors')</strong>  


          <form class="form-inline" method="POST" action="/admins/loan_result">
            {{ csrf_field() }}

            
            <div class="form-group{{ $errors->has('search_from') ? ' has-error' : '' }}">
              <label class="control-label col-md-12"> Search From * </label>
              <div class="controls col-md-12 ">  
                <input class="input-md  textinput textInput form-control" name="search_from"  style="margin-bottom: 10px" type="date" value="{{old('search_from')}}" required/>
                @if ($errors->has('search_from'))
                <span class="help-block">
                  <strong>{{ $errors->first('search_from') }}</strong>
                </span>
                @endif
              </div>
            </div>


            <div class="form-group{{ $errors->has('search_to') ? ' has-error' : '' }}">
              <label class="control-label col-md-12"> Search To * </label>
              <div class="controls col-md-12 ">  
                <input class="input-md  textinput textInput form-control" name="search_to"  style="margin-bottom: 10px" type="date" value="{{old('search_to')}}" required/>
                @if ($errors->has('search_to'))
                <span class="help-block">
                  <strong>{{ $errors->first('search_to') }}</strong>
                </span>
                @endif
              </div>
            </div>


<div class="form-group"> <div class="controls col-md-4 "></div>
    <div class="controls col-md-12 ">
        <input type="submit" name="create" value="Search" class="btn btn-primary btn btn-block" />
    </div>
</div> 

        </form>



        </div>
      </div>
    </div>
  </div>
</div>


@endsection
