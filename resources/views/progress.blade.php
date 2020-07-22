@extends('layouts.app')

@section('styles')
<style>

p {
margin: 0px;
margin-top: 6%;
margin-left: 1%;
position: relative;
}

#clip {
/*  background: linear-gradient(to right, rgba(127, 127, 127, 1) 23%, rgba(234, 85, 7, 1) 20%, rgba(234, 85, 7, 1) 57%, rgba(127, 127, 127, 1) 59%); */
background: linear-gradient(to right,yellow {{$percentage}}%, #deccccba {{100-$percentage}}%);
background-attachment: fixed;
-webkit-text-fill-color: transparent;
-webkit-background-clip: text;
font-size: 8vw;
font-weight: bold;
text-align: center;
}


</style>
@endsection
@section('content')
<div class="container">
  <div class="progress" style="height:90px;margin-top:125px">
  <div class="progress-bar bg-success" style="width:{{$percentage}}%;height:90px">{{$percentage}}</div>
  </div>
  <p id='clip'>Progress </p>
  <a href='/progress/update' class="btn btn-success  active" role="button" aria-pressed="true">One more</a>
  <button type="button" class="btn btn-danger float-right">Collapse</button>
</div>

@endsection