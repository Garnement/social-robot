<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use DB;

class DashboardController extends Controller
{
  public function __construct()
  {
        view()->composer('partials.nav', function($view){

        $categories = DB::table('categories')->select('title', 'id', 'slug')->get();

        $view->with('categories', $categories);

        });
  

  }
  public function profile()
  {
    $user = Auth::user();

    return view('back.profile', compact('user'));
  }
}
