@extends('layouts.app')
@section('content')
{{ Form::open(array('action' => 'PagesController@getscores','id'=>'addform','method'=> 'get')) }}
<div class="container">
    <div class="row">
<div id="teamA" class="col text-center">
        @foreach ($team1 as $player)
<input type="checkbox" id="id_{{$player['pid']}}" name="id1[]" value="{{$player['pid']}}">
<label for="id_{{$player['pid']}}">{{$player['name']}} </label><br>
          @endforeach
</div>
<div class="col text-center">
          @foreach ($team2 as $player)
          <input type="checkbox" id="id_{{$player['pid']}}" name="id1[]" value="{{$player['pid']}}">
          <label for="id_{{$player['pid']}}">{{$player['name']}} </label><br>
                    @endforeach
</div>    
                   
<div id="teamB" class="col text-center">
        @foreach ($team1 as $player)
<input type="checkbox" id="id_{{$player['pid']}}" name="id2[]" value="{{$player['pid']}}">
<label for="id_{{$player['pid']}}">{{$player['name']}} </label><br>
          @endforeach
</div>
<div class="col text-center">
          @foreach ($team2 as $player)
          <input type="checkbox" id="id_{{$player['pid']}}" name="id2[]" value="{{$player['pid']}}">
          <label for="id_{{$player['pid']}}">{{$player['name']}} </label><br>
                    @endforeach
</div> 
    </div>
    <div class="text-center">
<input type="submit" value="Submit"> </div>
</div>
{{ Form::close() }}
@endsection