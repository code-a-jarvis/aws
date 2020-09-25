@extends('layouts.app')
@section('content')
    <div class="container" style="padding-top:15%;padding-left:26%;">
      <div class="row">
            <div class="card text-center">
                    <div class="card-body" style="background:#e8e0e0">
                      <h4 class="card-title">Team A</h4>
                    <p class="card-text">{{$scoreA}}</p>  
                    </div>
                  </div>
                <br>  
                  <div class="card text-center">
                        <div class="card-body" style="background:#e8e0e0">
                          <h4 class="card-title">Team B</h4>
                          <p class="card-text">{{$scoreB}}</p>
                        </div>
                      </div>
  </div>
@endsection