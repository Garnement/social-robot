<?php

use Illuminate\Database\Seeder;

class RobotTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        /*
         * Je récupère le nombre de tags dans la table tags
         */
        $nbTags = App\Tag::all()->count();

        // dans la méthode each je passe au scope de la fonction le nombre de $nbTags pour y avoir accès
        factory(App\Robot::class, 10)->create()->each(function ($robot) use ($nbTags) {

            $indices = [];  // création d'un tableau d'indice vide

            $max = rand(1, $nbTags); // par exemple si on a 5 => tableau de 5 valeurs toutes différentes

          // création du tableau des indices unique aléatoire
            while (count($indices) != $max) {
                $i = rand(1, $max);

                while (in_array($i, $indices)) {
                    $i = rand(1, $max);
                }

                $indices[] = $i;
            }

            $robot->tags()->attach($indices);

        });
    }
}
