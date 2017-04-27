@extends('layouts.master')

@section('title', 'Home page')

@section('content')
  {{$robots->links()}}
  @foreach ($robots as $robot)
  <ul>
    <h2><a href="{{url('robot', $robot->id)}}">{{$robot->name}}</a></h2>
    <img src="{{ ($robot->link) ? '/images/' . $robot->link : 'images/default.jpg' }}">
    <li>Catégorie: {{ ($robot->category) ? $robot->category->title : 'Sans catégorie' }}</li>
    @include('partials.meta')
  </ul>
  @endforeach
  {{$robots->links()}}
@endsection
