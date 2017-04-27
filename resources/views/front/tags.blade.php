@extends('layouts.master')


@section('content')

  {{$robots->links()}}

  <h1>{{$name}}</h1>
  <ul>
    @foreach ($robots as $robot)

      <li><h3><a href="{{route('robot', $robot->id)}}">{{$robot->name}}</a><h3></li>
      <li><img src="{{url('images', $robot->link)}}"></li>
      <li>{{$robot->description}}</li>

      @include('partials.meta')

    @endforeach
  </ul>

  {{$robots->links()}}

@endsection
