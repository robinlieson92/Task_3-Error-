@extends("layouts.application")
@section("content")
  <h3>Edit a Gallery</h3>
  {!! Form::model($galleries, ['route' => ['galleries.update', $galleries->id], 'method' => 'put', 'class' => 'form-horizontal', 'role' => 'form']) !!}
    @include('galleries.form')
  {!! Form::close() !!}
@stop