@extends('layouts.app')
@section('content')
<div class="container"> 
  <div  class="d-flex justify-content-around">
    <div class="d-flex flex-column">
      <ul id="sortable1" class="connectedSortable">
          <li class="list-group-item list-group-item-success text-center" style="pointer-events:none" ><b>todo</b></li>
        @if ($todotasks->count()>0)
        @foreach ($todotasks as $task)
      <li class="list-group-item" id='id_{{$task->id}}' data-toggle="tooltip"  data-placement="right" title="{{$task->descr}}">{{$task->name}}</li>
        @endforeach
      @endif
      <br>
    <li id="add" class="list-group-item">+</li>
          <li id="addform" class="list-group-item invisible"><div>
            {{ Form::open(array('action' => 'TasksController@add','id'=>'addform','method'=> 'get')) }}
            <input name="task" id='addtask' type="text" autocomplete="off" autofocus>
            {{ Form::close() }}
            </div></li>  
        </ul>  
    </div>
    <div  class="d-flex flex-column ">
       <ul id="sortable2" class="connectedSortable">
          <li class="list-group-item list-group-item-success text-center" style="pointer-events:none" ><b>doing</b></li>
        @if ($doing->count()>0)
        @foreach ($doing as $task)
       <li class="list-group-item" id='id_{{$task->id}}' data-toggle="tooltip"  data-placement="right" title="{{$task->descr}}" >{{$task->name}}</li>
        @endforeach
      @endif
        </ul>
    </div>
        <div  class="d-flex flex-column ">
       <ul id="sortable3"  class="connectedSortable">
          <li class="list-group-item list-group-item-success text-center" style="pointer-events:none" ><b>done</b></li>
        @if ($donetasks->count()>0)
        @foreach ($donetasks as $task)
            <li class="list-group-item " id='id_{{$task->id}}' >{{$task->name}}</li>
        @endforeach
      @endif
          </ul>
        </div>
  </div>
  <div class="text-center">
  <button id="save_btn" type="button" class="btn btn-success ">Save</button>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    var todo=$('#sortable1');
    var doing=$('#sortable2');
    var done=$('#sortable3');
    $("button").click(function(){
      var sort_data=$(todo).sortable('serialize');
      var sort_1=$(doing).sortable('serialize');
      var sort_2=$(done).sortable('serialize');
    //   var sort_data="he;";
      console.log(sort_data);
      $.ajax({
        data:{todo:sort_data,_token :' {{Session::token()}}',doing:sort_1,done:sort_2},
        type:'post',
        url:"{{ route('ajaxRequest.post') }}",
        success:function(data){
              //  alert(data.success);
              console.log(data.success);
           },
           error: function(data) {
            var errors = data.responseJSON;
            console.log(errors);
        }
      });
    })
    $('[data-toggle="tooltip"]').tooltip(); 
    $('#add').on("hover", function(){
    $(this).css("cursor", "pointer");
});
   $('#add').click(function(){
      $("#addform").removeClass("invisible").addClass("visible");
      $('#addtask').focus();
   });
   $('#addtask').keydown(function(event) {
    // enter has keyCode = 13, change it if you want to use another button
    if (event.keyCode == 13) {
      this.form.submit();
      $("#addform").removeClass("visible").addClass("invisible");
    }

    //
  
  });

});
  </script>
@endsection