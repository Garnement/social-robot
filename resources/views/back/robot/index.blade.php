@extends ('layouts.admin')

@section('content')
<p>
<a class="waves-effect waves-orange btn blue lighten-3" href="{{route('robot.create')}}">Créer un robot</a>
</p>
{{$robots->links()}}
@if ( $flash = session('flashMessage') )
  <div class="chip {{($flash == 'Suppression effecutée') ? 'red' : 'green'}} lighten-3" id="flash">
   <div class="col s12" id="flash">{{$flash}}</div>
  </div>
@endif
<table class="striped">
       <thead>
         <tr>
             <th>Selection</th>
             <th>Nom</th>
             <th>Utilisateur</th>
             <th>Categorie</th>
             <th>Tags</th>
             <th>Image</th>
             <th>Publication</th>
             <th>Action</th>
         </tr>
       </thead> 
    <tbody>
@foreach ($robots as $robot)
          <tr>
            <td><input type="checkbox" name="selected" id="{{$robot->id}}"><label for="{{$robot->id}}"></label></td>
            <td>{{$robot->name}}</td>
            <td>{{ ($robot->user != null) ? $robot->user->name : ''}}</td>
            <td>{{ ($robot->category != null) ? $robot->category->title : 'Sans catégorie' }}</td>
            <td>@forelse ($robot->tags as $tag)
                  <small class="chip">{{$tag->name}}</small>
                @empty
                  <small>Pas de tag</small>
                @endforelse
            </td>
            <td>{{ ($robot->link) ? 'Oui':'Non'}}
            <td>{{$robot->published_at}}</td>
            <td>
              <a href="{{route('robot.edit', $robot->id)}}"><button class="waves-effect waves-blue btn blue lighten-3"><i class="material-icons">mode_edit</i></button></a>
              <form action="{{route('robot.destroy', $robot->id)}}" method="post">
                <!-- insertion du token -->
                <div class="row">
                  {{csrf_field()}}
                <!-- Utilisation de la méthode DELETE -->
                  {{ method_field('DELETE') }}
                </div>
                <button type="submit" name="action" class="waves-effect waves-orange btn red lighten-3"><i class="material-icons">delete</i></a></button>
              </form>
            </td>
          </tr>
@endforeach
  </tbody>
</table>
{{$robots->links()}}
@endsection
