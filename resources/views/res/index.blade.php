@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
        <h1  class="col text-responsive">  Resources</h1> 
        <input class="form-control float-right w-50" id="myInput" type="text" style='width:100px;position:relative;margin-right:10px' placeholder="Search..">
        </div>
        <table class="table table-striped">
            <thead>
                <tr class="table-success">
                    <th>Category/sub</th>
                    <th>Description</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($resources as $resource)
                    <tr>
                    <td>{{$resource->category}}<br> {{$resource->sub}}</td>
                    <td>{{$resource->descr}}</td>
                    <td><a href={{$resource->url}} target='_blank' class="btn btn-primary  active" role="button" aria-pressed="true">Checkout</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
@endsection
{{-- @section('jsfiles')
<script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
@endsection --}}