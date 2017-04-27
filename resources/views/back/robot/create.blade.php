@extends('layouts.admin')

@section ('content')
<h1>Créer un nouveau robot</h1>
<div class="row">
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <p>Une erreur est survenue.</p>
    </div>
  @endif

  <form class="col s12" action="{{route('robot.store')}}" method="post" enctype="multipart/form-data">

<!-- token indispensable -->
    <div class="row">
    {{csrf_field()}}
   </div>

<!-- nom du robot -->
    <div class="row">
      <div class="input-field col s6">
        <input placeholder="Sopor Eternus" id="name" type="text" class="validate" name="name" value="{{old('name')}}">
        <label for="name">Nom du robot</label>
        @if ($errors->has('name')) <span> {{$errors->first('name')}}</span> @endif
      </div>
    </div>

<!-- description du robot -->
    <div class="row">
      <div class="input-field col s12">
        <input id="description" type="text" class="validate textarea" placeholder="Description du robot en quelques mots" name="description" value="{{old('description')}}">
        <label for="description">Description</label>
        @if ($errors->has('description')) <span> {{$errors->first('description')}}</span> @endif
      </div>
    </div>

<!-- categorie du robot -->
    <div class="row">
      <div class="input-field col s12">
       <select name="category_id">
         <option value="0" selected>Aucune catégorie</option>
         @foreach ($category as $id => $title)
          <option {{ ( old('category_id') == $id) ? 'selected' : '' }} value="{{$id}}">{{$title}}</option>
         @endforeach
       </select>
       <label>Catégorie du robot</label>
       @if ($errors->has('category_id')) <span> {{$errors->first('category_id')}}</span> @endif
     </div>
   </div>
   
<!-- image du robot -->
   <div class="row">
    <div class="file-field input-field col s12">
      <div class="btn blue lighten-2 small">
        <span>Fichiers</span>
        <input name="link" type="file">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Ajouter une image au robot" >
      </div>
    </div>
   </div>

<!-- tags du robot -->
   <div class="row">
     <p><label class="input-field col s12">Tags du robot</label></p>
       @foreach ($tags as $id => $name)
        <div class="col s3">
          <input type="checkbox" id="{{$id}}" name="tags[]" value="{{$id}}" {{ ( !empty(old('tags')) && in_array($id, old('tags')) ? 'checked' : '' )}} />
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
           <input type="checkbox" name="published_at" value="on" {{ ( old('published_at') == 'on' ) ? 'checked' : ''}}>
           <span class="lever"></span>
           Oui
         </label>
       </div>
    </div>

<!-- bouton soumission -->
  <div class="row">
    <div class="input-field col s12">
      <button class="btn waves-effect waves-light orange darken-2" type="submit" name="action">Créer
        <i class="material-icons right">mode_edit</i>
      </button>
    </div>
  </form>
</div>
</div>

@endsection
