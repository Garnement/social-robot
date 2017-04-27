<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // création de 10 utilisateurs
      factory(App\User::class, 10)->create();
      DB::table('users')->insert([
        [
        'name' => 'Batman',
        'email' => 'batman@gotham.com',
        'password' => bcrypt('batman')
      ],

    ]);

    }
}
