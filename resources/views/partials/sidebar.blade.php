<div class="collection">
@foreach ($users as $user)
  <a href="{{route('user', $user->id)}}" class="collection-item">{{$user->name}}<br/><small> {{$user->robots ? $user->robots->count() : 0 }} robots</small></a>
@endforeach
</div>
