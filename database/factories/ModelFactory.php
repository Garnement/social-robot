<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\User::class, function (Faker\Generator $faker){
  static $password;

  return [
    'name'           => $faker->name,
    'email'          => $faker->unique()->safeEmail,
    'password'       => $password ?: $password = bcrypt('secret'),
    'remember_token' => str_random(10),
  ];
});


$factory->define(App\Robot::class, function (Faker\Generator $faker) {
    static $password;

    // Determination d'un paramètre au hasard
    $param     = ['published', 'unpublished', 'draft'];
    $randParam = array_rand($param);

    // Autre méthode de paramètre au hasard
    $alea = mt_rand() / mt_getrandmax();


    return [
        'category_id'   => rand(1,3),
        'user_id'       => rand(1,10),
        'name'          => $faker->name,
        'description'   => $faker->text(rand(60,200)),
        'published_at'  => $faker->dateTime(),
        'status'        => $param[$randParam],
        'captor'        => ($alea < .33) ? 'motor' : ($alea < .66 ) ? 'detector' : 'lcd'
    ];
});
