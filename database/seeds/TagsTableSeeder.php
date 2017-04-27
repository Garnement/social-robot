<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tags')->insert([
               ['name' => 'Blindé'],
               ['name' => 'Furtif'],
               ['name' => 'Deep Blue'],
               ['name' => 'Nucléaire'],
               ['name' => 'Solar Impulse'],
               ['name' => 'Optimus'],
               ['name' => 'Sentinelle'],
               ['name' => 'BumbleBee'],
               ['name' => 'Droïd'],
               ['name' => 'Hyperdrive'],
               ['name' => 'Clockwork'],
               ['name' => 'Lightsaber']
       ]);

    }
}
