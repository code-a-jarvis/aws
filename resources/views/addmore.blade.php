@extends('layouts.app')
@section('content')
    
<div class="container">
    <h3>Tooltip Example</h3>
    <a href="#" data-toggle="tooltip" data-placement="right" title="Hooray!">Hover over me</a>
  </div>
  
  <script>
  $(document).ready(function(){
    $("script[src='js/jquery-ui.js']").remove()
    $('[data-toggle="tooltip"]').tooltip();   
  });
  </script>
@endsection

@section('styles')
<style>
.ui-tooltip {
  max-width: 200px;
  padding: 3px 8px;
  color: #fff;
  text-align: center;
  background-color: red;
  border-radius: .25rem;
}
</style>
@endsection