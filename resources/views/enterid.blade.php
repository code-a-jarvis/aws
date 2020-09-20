@extends('layouts.app')
@section('content')
{{ Form::open(array('action' => 'PagesController@test','id'=>'addform','method'=> 'get')) }}
    <input type="text" name="id">
    <input type=submit>
    {{ Form::close() }}
@endsection