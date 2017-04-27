<ul>
@forelse ($robot->tags as $tag)

  {{--$name == $tag->name exemple: est ce "nucléaire" ($name) est égal à "nuclaire" ($tag->name)--}}

  @if ( isset($name) && $name == $tag->name )
  <a class="btn disabled">{{$tag->name}}</a>
  @else
  <a class="waves-effect waves-light btn orange darken-2" href="{{route('tags', $tag->id)}}">{{$tag->name}}</a>
  @endif

  @empty <p>Ce robot n'a pas de tags</p>
@endforelse
</ul>
