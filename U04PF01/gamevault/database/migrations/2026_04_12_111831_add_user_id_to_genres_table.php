<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Aquí afegeixo user_id a la taula genres només si encara no existeix.
     * Ho faig així per evitar errors si la columna ja es va crear abans.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('genres', 'user_id')) {
            Schema::table('genres', function (Blueprint $table) {
                // Afegeixo la columna user_id i la relaciono amb la taula users
                $table->foreignId('user_id')
                      ->after('id')
                      ->constrained()
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Aquí elimino la clau forana i la columna user_id només si existeix.
     */
    public function down(): void
    {
        if (Schema::hasColumn('genres', 'user_id')) {
            Schema::table('genres', function (Blueprint $table) {
                // Elimino primer la clau forana
                $table->dropForeign(['user_id']);

                // Després elimino la columna
                $table->dropColumn('user_id');
            });
        }
    }
};