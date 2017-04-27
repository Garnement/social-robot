<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class LoginController extends Controller
{
    public function login(Request $request){

      if ($request->isMethod('post') == true)
      {

        $this->validate($request, [
          'email' => 'required|email', //rules
          'password' => 'required'
        ]);

        //Récupération en même temps des champs email et password
        $credentials = $request->only('email', 'password');

        /* ou
        $credentials = ['email' => $request->email, 'password' => $request->password];
        */

        $remember = true;

        // Auth classe de Laravel qui permet de faire la requête sur la table Users et de vérifier le couple email/password

        if(Auth::attempt($credentials, $remember))
          {

            return redirect()->intended('dashboard/profile'); // redirige vers la page profile

          } else 
          {

            return back()->withInput($request->only('email')); // redirige vers la page login

          }
        }

    return view('auth.login');
  }


  public function logout()
  {
    auth()->logout();
    
    return redirect()->route('home');
  }
}
