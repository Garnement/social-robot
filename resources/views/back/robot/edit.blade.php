@extends ('layouts.admin')

@section ('content')

<h2>Editer le robot</h2>

<div class="row">
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <p>Une erreur est survenue.</p>
    </div>
  @endif

  <form class="col s12" action="{{route('robot.update', $robot->id)}}" method="post" enctype="multipart/form-data">

<!-- token indispensable -->
    <div class="row">
    {{csrf_field()}}
<!-- Utilisation de la méthode PUT -->
    {{ method_field('PUT') }}
   </div>

<!-- nom du robot -->
    <div class="row">
      <div class="input-field col s6">
        <input placeholder="Sopor Eternus" id="name" type="text" class="validate" name="name" value="{{$robot->name}}">
        <label for="name">Nom du robot</label>
        @if ($errors->has('name')) <span> {{$errors->first('name')}}</span> @endif
      </div>
      <div class="col s1">
        <a class="waves-effect waves-light blue lighten-5"><i class="small material-icons">mode_edit</i></a>
      </div>
    </div>

<!-- description du robot -->
    <div class="row">
      <div class="input-field col s11">
        <textarea id="description" type="text" class="materialize-textarea" placeholder="{{($robot->description != null) ? $robot->description : 'Ajouter une description au robot'}}" name="description" value="{{$robot->description}}" >{{$robot->description}}</textarea>
        <label for="description">Description</label>
        @if ($errors->has('description')) <span> {{$errors->first('description')}}</span> @endif
      </div>
      <div class="col s1">
        <a class="waves-effect waves-light blue lighten-5"><i class="small material-icons">mode_edit</i></a>
      </div>
    </div>
   
  
<!-- categorie du robot -->
    <div class="row">
      <div class="input-field col s12">
       <select name="category_id">
         <option value="0" selected>Aucune catégorie</option>
         @foreach ($category as $id => $title)
          <option {{ ($robot->category?  $robot->category->id == $id : false) ? 'selected' : '' }} value="{{$id}}">{{$title}}</option>
         @endforeach
       </select>
       <label>Catégorie du robot</label>
       @if ($errors->has('category_id')) <span> {{$errors->first('category_id')}}</span> @endif
     </div>
   </div>

<!-- image du robot -->
  <div class="row">
    <div class="input-field col s12">
      <img src="{{ ($robot->link) ? '/images/' . $robot->link : '/images/default.jpg'}}">
    </div>
  </div>
  
  <div class="row">
    <div class="file-field input-field col s12">
      <div class="btn blue lighten-2 small">
        <span>{{($robot->link) ? 'Modifier' : 'Ajouter'}}</span>
        <input name="link" type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="{{($robot->link) ? 'Modifier l\'image' : 'Ajouter une image au robot'}}" />
      </div>
  </div>
      
      @if ($robot->link)
        <div class="row">
          <div class="input-field col s12">
            <input type="checkbox" name="delete" id="delete">
            <label for="delete">Supprimer la photo</label>
          </div>
        </div>
      @endif
        
    </div>
   </div>

<!-- tags du robot -->
   <div class="row">
     <p><label class="input-field col s12">Tags du robot</label></p>
      
       @foreach ($tags as $id => $name)
        <div class="col s3">
                <input type="checkbox" id="{{$id}}" name="tags[]" value="{{$id}}" {{ $robot->isTag($id) ? 'checked' : '' }}  />
          <label for="{{$id}}">{{$name}}</label>
        </div>
      @endforeach
      @if ($errors->has('tags')) <span> {{$errors->first('tags')}}</span> @endif
   </div>

<!-- publication du robot -->
   <div class="row">
       <label class="input-field col s12">Publier le robot</label>

       <div class="switch">
         <label class="input-field col s12">
           Non
           <input type="checkbox" name="published_at" value="on" {{ ($robot->published_at != 'Non publié') ? 'checked' : ''}}>
           <span class="lever"></span>
           Oui
         </label>
       </div>
    </div>

<!-- bouton soumission -->
  <div class="row">
    <div class="input-field col s12">
      <button class="btn waves-effect waves-light red darken-2" type="submit" name="action">Modifier
        <i class="material-icons right">mode_edit</i>
      </button>
    </div>
  </form>
</div>
</div>



@endsection