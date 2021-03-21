@extends('layouts.app')
@section('content')
    <div class="container text-center">
        {{ Form::open(array('action' => 'PagesController@addToBirthday','id'=>'addform','method'=> 'get')) }}
            <input type="text" name="name" autofocus="autofocus">
              <input type="date" name="bdate">
              <input type="submit" style="width:60px" name="submit">
            {{ Form::close() }}
    </div>
@endsection