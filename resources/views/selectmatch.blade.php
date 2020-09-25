@extends('layouts.app')
@section('content')
{{ Form::open(array('action' => 'PagesController@test','id'=>'addform','method'=> 'get')) }}
<div class="container">
    <div class="form-group">
        <label for="sel1">Select the match:</label>
        <select class="form-control" name="id" id="sel1">
         @foreach ($matches as $match)
        <option value="{{$match['unique_id']}}" name="id">{{$match['team-1']}} Vs {{$match['team-2']}}</option>
         @endforeach
        </select>
      </div>
</div>
<div  class="text-center">
<input type="submit" class="btn-success"> 
</div>
{{ Form::close() }}
@endsection