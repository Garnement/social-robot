@extends('layouts.master')


@section('content')
{{$robots->links()}}
@foreach ($robots as $robot)
<ul>
  <h1><a href="{{url('robot', $robot->id)}}">{{$robot->name}}</a></h1>
  <li><img src="{{url('images', $robot->link)}}"></li>
  <li>{{$robot->description}}</li>
  @include('partials.meta')
</ul>
  @endforeach
{{$robots->links()}}

@endsection
