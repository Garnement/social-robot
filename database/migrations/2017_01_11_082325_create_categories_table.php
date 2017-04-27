<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATE TABLE categories
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); // id PK auto_increment (Primary Key)
            $table->string('title', 100); // ici on définit un champ title VARCHAR(100)
            $table->string('slug', 100); // champ slug VARCHAR(100)
            $table->timestamps(); // Deux champs qui sont ajoutés nécéssaires pour le modèle Laravel
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
