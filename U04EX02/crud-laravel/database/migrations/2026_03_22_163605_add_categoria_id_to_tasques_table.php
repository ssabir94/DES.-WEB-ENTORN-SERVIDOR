<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasques', function (Blueprint $table) {
             $table->foreignId('categoria_id')->nullable()->constrained()->onDelete('set null');
        }); //He afegit categoria_id a tasques, és nullable i té clau forana cap a categorias. Si s’elimina 
            //una categoria, la tasca no s’elimina: la categoria passa a null.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasques', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
};
