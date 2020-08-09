@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-columns">
<div class="card text-center">
    <img class="card-img-top img-fluid" src="images/progress.png" alt="Card image" style="width:100%;height:12vw">
    <div class="card-body" style="background:#e8e0e0">
      <h4 class="card-title">ProgessBar</h4>
      <p class="card-text">See the exact percentage of approach towards the goal</p>
      <a href="/progress" class="btn btn-primary ">Surf</a>
    </div>
  </div>

<div class="card text-center">
    <img class="card-img-top" src="images/resources.jpg" alt="Card image" style="width:100%">
    <div class="card-body" style="background:#e8e0e0">
      <h4 class="card-title">Resources</h4>
      <p class="card-text">Saved web-links which can be viewed later for the easy approach</p>
      <a href="/resources" class="btn btn-primary">Surf</a>
    </div>
  </div>

<div class="card text-center">
    <img class="card-img-top img-fluid" src="images/tasks.jpg" alt="Card image" style="width:100%">
    <div class="card-body" style="background:#e8e0e0">
      <h4 class="card-title">Tasklist</h4>
      <p class="card-text">Keep an eye on the present and future tasks</p>
      <a href="/tasks" class="btn btn-primary">Surf</a>
    </div>
  </div>

  <div class="card text-center">
  <img class="card-img-top" src="images/write.jpg" alt="Card image" style="width:100%">
  <div class="card-body" style="background:#e8e0e0">
    <h4 class="card-title">Write</h4>
    <p class="card-text">Put your day into words</p>
    <a href="/posts/create" class="btn btn-primary">Surf</a>
  </div>
</div>

</div>
</div>

@endsection



