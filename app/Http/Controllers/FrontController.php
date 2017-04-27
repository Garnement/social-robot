<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//gestion du namespace
use App\Category;
use App\Robot;
use App\Tag;
use App\User;

class FrontController extends Controller
{

    public function index(){
      $robots = Robot::paginate(5);

      return view('front.index', ['robots' => $robots]);
    }

    public function showRobotsByCat($id, $slug = null){
      //$robots = Category::find($id)->robots; récupere TOUS les robot ayant la même id
      $robots = Category::find($id)->robots()->paginate($this->nbPaginate);

      return view('front.category', compact('robots') );
    }

    public function showUserProfile($id, string $grade = null){
      if(is_null($grade)) $grade ='no grade';

      return "user id: $id grade: $grade";
    }

    // Ici on renvoi dans le dossier front la page single 'front.single'
    // compact('robot) == ['robots' => $robots]
    // $robot = correspond à une requête SQL avec l'id du robot contenu dans l'URL
    public function showRobotById(int $id){
      $robot = \App\Robot::find($id);

      return view('front.single',compact('robot'));
    }

    public function showRobotsByTags(int $id){
      $tag = \App\Tag::find($id);

      // On récupère le nom du tag, stocké dans $name
      $name = $tag->name;

      $robots = $tag->robots()->paginate($this->nbPaginate);

      // On passe dans la vue les variables $robots et $name
      return view('front.tags', compact('robots', 'name'));
    }

    public function showRobotsByUser($id){
      $user = \App\User::find($id);
      $robots = $user->robots()->paginate($this->nbPaginate);

      return view('front.user', compact('user', 'robots'));
    }

}
