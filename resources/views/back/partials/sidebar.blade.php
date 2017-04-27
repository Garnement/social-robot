<div class="container blue lighten-5 col s12">
    <div class="row col s12">
        <h1>Hello <small>{{$user->name}}</small></h1>
        <p>Connecté avec l'email : {{$user->email}}<br/>
    </div>
    <div class="row col s12">
        <div class="col s12">
            <img src="http://127.0.0.1:8000/images/batman.jpg" class="circle">
        </div>
    </div>
    <div class="row">
        <p><i>"Does I look like a badass guy ?"</i>
        <blockquote>La route est longue mais la voie est libre</blockquote></p>
        <p>Avec le temps, il me faudra trouver le moyen d'injecter $user dans la vue.</p>
    </div>
    <a href="{{route('robot.index')}}">Retour à la liste</a>
</div>
