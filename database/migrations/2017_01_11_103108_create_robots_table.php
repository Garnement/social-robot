<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robots', function (Blueprint $table) {
            $table->increments('id'); // PK auto_increment

            // on pourra créer un robot sans nécéssairement l'associer à une catégorie.
            // attention à bien mettre unsigned car vos clés PK et FK doivent être du même type
            $table->integer('category_id')->unsigned()->nullable(); //pour l'option de la contrainte

            // user_id peut valoir "null" donc on peut insérer un robot sans le relier à un utilisateur;
            $table->integer('user_id')->unsigned()->nullable(); // unsigned() => l'integer ne peut être négatif;
            $table->string('name', 100); // string, varchar(100);
            $table->text('description');
            $table->dateTime('published_at')->nullable();
            $table->enum('status', ['published', 'unpublished', 'draft'])->default('unpublished');
            $table->enum('captor', ['motor', 'detector', 'lcd']);

            # création clé secondaire qui pointe vers une clé primaire

            // l'option -onDelete('Cascade') permet de faire la suppression en cascade du robots si on supprime la catégorie associé /!\
            //$table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');

            // avec cette option si on supprime une catégorie alors le champ category_id des robots reliés
            // à cette catégorie on aura la valeur NULL à la place de category_id.
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');

            // impossible de supprimer un utilisateur relié à un robot ou des robots
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('robots');
    }
}
