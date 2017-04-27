<?php

use Illuminate\Database\Seeder;

class RobotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $uploads = public_path('images'); // fonction laravel qui donne le chemin du dossier public => public/image

      //récupère les noms des images dans le dossier dans un tableau
      $files = File::allFiles($uploads);

      foreach($files as $file)
      {
        File::delete($file); // suprrime les images dans le dossier
      }


        // ici nous utilisons "use($uploads)" à cause de la limitation du scope de la fonction
      factory(App\Robot::class, 50)->create()->each(function($robot) use($uploads)
      {

        $arr=array(1,2,3,4,5,6,7,8,9,10,11,12);
        shuffle($arr); // mélange les indices mais ne retourne pas un tableau

        $id = array_slice($arr, 0, rand(1,5));

        // $robot c'est une instance du modèle Robot représentant la ressource qui
        // vient d'être ajoutée dans la table robots
        $robot->tags()->attach($id);

        // détermination du nom du fichier par une string aléatoire de 12 char
        $uri = str_random(12) . '.jpg';

        // récupération via file_get_contents des images distantes dans une variable.
        $filename = file_get_contents('http://lorempicsum.com/futurama/400/200/'.rand(1,9));

        // ici on place les images dans le dossier public/images
        File::put($uploads.'/'.$uri, $filename);

        // ici on détermine que link prend la valeur de $uri
        $robot->link = $uri;

        // sauvegarde de l'image
        $robot->save();

      });
    }
}
