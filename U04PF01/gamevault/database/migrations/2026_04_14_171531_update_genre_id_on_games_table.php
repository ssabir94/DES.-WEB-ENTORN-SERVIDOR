<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Primer elimino la clau forana actual de genre_id
        // perquè ara mateix té onDelete('cascade') i elimina els jocs
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
        });

        // Després faig que el camp genre_id pugui ser NULL
        // així un joc pot existir sense categoria
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('genre_id')->nullable()->change();
        });

        // Torno a crear la clau forana, però amb comportament diferent:
        // quan s'esborra un gènere, genre_id es posa a NULL (no s'esborra el joc)
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        // Reverteixo els canvis per tornar a l'estat anterior

        // Elimino la clau forana actual
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
        });

        // Torno a deixar genre_id com obligatori (no nullable)
        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('genre_id')->nullable(false)->change();
        });

        // Recupero el comportament original:
        // si s'esborra el gènere, també s'esborra el joc
        Schema::table('games', function (Blueprint $table) {
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->onDelete('cascade');
        });
    }
};