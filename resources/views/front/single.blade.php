@extends('layouts.master')

@section('content')
<div class="card">
  <div class="card-image waves-effect waves-block waves-light">
    <img src="{{ ($robot->link) ? '/images/' . $robot->link : '/images/default.jpg' }}" class="circle activator"></li>
  </div>

  <div class="card-content">
    <span class="card-title activator grey-text text-darken-4">{{$robot->name}}<i class="material-icons right">more_vert</i></span>
    <p><a href="{{route('home')}}">Retour</a></p>
  </div>

  <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">{{$robot->name}}<i class="material-icons right">close</i></span>
      <p>
        <ul>
          <li><u>Catégorie:</u> <br/>{{($robot->category) ? $robot->category->title : 'Sans catégorie' }}</li>
          <li><u>Description:</u><br/>{{$robot->description}}</li>
        </ul>
      </p>
    </div>
  </div>
      <p>
        @include('partials.meta')
      </p>
  </div>
</div>
@endsection
