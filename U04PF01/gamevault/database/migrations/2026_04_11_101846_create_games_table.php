<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            // id únic del videojoc
            $table->id();

            // títol del joc
            $table->string('title');

            // plataforma (PC, PS5, Xbox...)
            $table->string('platform');

            // any de llançament
            $table->integer('release_year');

            // descripció opcional del joc
            $table->text('description')->nullable();

            // relació amb la taula genres (cada joc té un gènere)
            $table->foreignId('genre_id')
                ->constrained()
                ->onDelete('cascade'); // si s’elimina el gènere, també s’eliminen els jocs associats

            // relació amb la taula users (propietari del joc)
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade'); // si s’elimina l’usuari, s’eliminen els seus jocs

            // timestamps automàtics
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
