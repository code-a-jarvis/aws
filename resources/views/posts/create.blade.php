@extends('layouts.app')

@section('content')
    <h1 class="text-center">Write...</h1>
    <div class="container">
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Highlight')}}
            {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'thought of the day'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'wassup')}}
            {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'spit it out'])}}
        </div>
    </div>
     <div class="text-center">
        {{Form::submit('Submit', ['class'=>'btn btn-primary text-center'])}}
     </div>
    {!! Form::close() !!}
@endsection