<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livres', function (Blueprint $table) {
            $table->id();
            $table->integer('auteur_id');
            $table->integer('genre_id');
            $table->string('titre'); 
            $table->string('langue_livre');
            $table->decimal('isbn');
            $table->decimal('annee'); 
            $table->decimal('nbr_pages');
            $table->dateTime('date_achat');
            $table->dateTime('date_parution');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('livres');
    }
}
