@extends ('layouts.master')


@section('content')
<h1>{{$user->name}}</h1>
<p>Cet ingénieur a travaillé sur les robots suivants:
<ul>
  @foreach ($user->robots as $robot)
  <li><a href="{{route('robot', $robot->id)}}">{{$robot->name}}</a></li>
  @endforeach
</ul>
</p>


@endsection
