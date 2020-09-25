@extends('layouts.app')
@section('content')
    <div class="container">
      
  <div class="row">
    <div class="col">
        <div class="card text-center">
            <div class="card-body" style="background:#e8e0e0">
              <h4 class="card-title">Team A</h4>
            <p class="card-text">{{$scoreA}}</p>  
            </div>
          </div>
      @foreach ($t1 as $item)
      <div class="card-body" style="background:#e8e0e0">
      <h4 class="card-title">{{$item['name']}}</h4>
        <p class="card-text">{{$item['score']}}</p>  
        </div>
      @endforeach
    </div>
    <div class="col">
        <div class="card text-center">
            <div class="card-body" style="background:#e8e0e0">
              <h4 class="card-title">Team B</h4>
              <p class="card-text">{{$scoreB}}</p>
            </div>
          </div>
        @foreach ($t2 as $item)
        <div class="card-body" style="background:#e8e0e0">
        <h4 class="card-title">{{$item['name']}}</h4>
          <p class="card-text">{{$item['score']}}</p>  
          </div>
        @endforeach
      </div>
  </div>
@endsection