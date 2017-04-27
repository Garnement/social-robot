<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// Queries builder de Laravel intégré au framework
use DB;
use App\User;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $nbPaginate;

    // on récupère automatiquement toutes les catégories
      public function __construct() {

        // On rappelle la variable d'environnement du .env
        // Sinon, par défaut la pagination sera de 2
        $this->nbPaginate = env('NUMBER_PAGINATE', 2);


        view()->composer('partials.nav', function($view){

        $categories = DB::table('categories')->select('title', 'id', 'slug')->get(); // SELECT title, id, slug FROM categories; queries builder
          // ou $categories = Category::pluck('id', 'title');

        $view->with('categories', $categories);


        //Injection des User dans la vue (views/partials/sidebar.blade.php)
        view()->composer('partials.sidebar', function($view) {

        $users = User::all();

        $view->with('users', $users);

            });
        });
      }

}
