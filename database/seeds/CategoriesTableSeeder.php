<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
        ['title' => 'Medical', 'slug' => str_slug('Medical')],
        ['title' => 'Space explorer', 'slug' => str_slug('Space Explorer')],
        ['title' => 'Army', 'slug' => str_slug('Army')]
      ]);

    }
}
