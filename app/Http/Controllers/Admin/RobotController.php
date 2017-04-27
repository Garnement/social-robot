<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\RobotRequest;

use App\Robot;
use DB;
use App\Category;
use App\Tag;
use Auth;
use File;

class RobotController extends Controller
{
      public function __construct()
      {
        view()->composer('partials.nav', function($view){

        $categories = DB::table('categories')->select('title', 'id', 'slug')->get(); // SELECT title, id, slug FROM categories; queries builder

        $view->with('categories', $categories);
        });


        view()->composer('back.partials.sidebar', function($view){

        $user = Auth::user();

        $view->with('user', $user);
        });
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $robots = Robot::paginate(5);

      return view('back.robot.index', ['robots' => $robots]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $category = DB::table('categories')->select('id', 'title')->get();
        // $tags     = DB::table('tags')->select('id', 'name')->get();


          $category   = Category::pluck('title', 'id'); //Récupère le titre  et l'id en renvoyant un tableau Array_collection
          $tags       = Tag::pluck('name', 'id');


        return view('back.robot.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RobotRequest $request)
    {
        $robot = Robot::create( $request->all() );

        // On utilise une fonction saveTags crée dans le modèle Robot.
        $robot->saveTags($request->tags); // On peut mettre de la logique métier dans le modèle.

        /*$robot->tags()->attach($request->tags); // Relation ManyToMany, on associe des tags à notre robot.*/


        if ( $request->hasFile('link'))
        {
            //Link correspond au nom du champ dans le formulaire (ici l'image uploadé)

            //Récupération de l'extension
            $ext = $request->link->extension();

            //Configuration du nom du fichier
            $linkName = str_random(12) . '.' . $ext;

            //Stockage du fichier dans le dossier image
            $request->link->storeAs('images', $linkName);

            //On rempli le champ "link" par $linkName dans la BDD
            $robot->link = $linkName;
            $robot->save();
        }


        session()->flash('flashMessage', 'Le robot a été crée');

        //return redirect('dashboard/robot');
      return redirect()->route('robot.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return view('back.robot.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //récupération des infos du robot
        $robot      = Robot::find($id);

        $idtag = [];
        foreach($robot->tags as $tag){
           $idtag[] = $tag->id;
        }

        //nécéssaire à la génération du formulaire
        $category   = Category::pluck('title','id');
        $tags       = Tag::pluck('name', 'id');

        return view('back.robot.edit', compact('robot', 'category', 'tags', 'idtag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RobotRequest $request, $id)
    {
        $robot = Robot::find($id);

        $robot->update($request->all());


        // sync() a besoin d'un tableau pour fonctionner
        // $request->tags est un tableau envoyé par notre formulaire.
        $tags = $request->tags ? $request->tags : [] ;
        $robot->tags()->sync($tags);

        // Modification de la photo

        // Si la case supprimée est cochée
        if ($request->delete == 'on')
        {
            $fileName = '/images\/' . $robot->link; // Stockage du chemin du fichier

            if( File::exists($fileName) )
            {
                File::delete($fileName);
            }
            //Supprimer le lien dans la table
            $robot->link=null;
            $robot->save();
        }


        //Si une nouvelle image est envoyée
        if ( $request->hasFile('link') )
        {

            $fileName = '/images\/' . '.' . $robot->link;

            //Suppression de l'ancien fichier s'il existe
            if( File::exists($fileName) )
            {
                File::delete($fileName);
            }

            //Ajout du nouveau fichier

            //Récupération de l'extension
            $ext = $request->link->extension();

            //Configuration du nom du fichier
            $linkName = str_random(12) . '.' . $ext;

            //Stockage du fichier dans le dossier image
            $request->link->storeAs('images', $linkName);

            //On rempli le champ "update" par $linkName dans la BDD
            $robot->link = $linkName;
            $robot->save();

        }

        session()->flash('flashMessage', 'Modification enregistrée');

        return redirect()->route('robot.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Récupération du robot - a optimiser pour ne récupérer que $robot->link;
        $robot = Robot::find($id);
        //dump($robot); die;

        //Suppression de l'image si le robot en poosède une'
        if ($robot->link)
        {
           $fileName = $robot->link;

            if ( File::exists($fileName) )
            {
                File::delete($fileName);
            }
        }
        //Suppression du robot en fonction de son ID
        Robot::destroy($id);

        //Flashmessage de confirmation
        session()->flash('flashMessage', 'Suppression effecutée');

        //Redirection sur l'index
        return redirect()->route('robot.index');
    }
}
