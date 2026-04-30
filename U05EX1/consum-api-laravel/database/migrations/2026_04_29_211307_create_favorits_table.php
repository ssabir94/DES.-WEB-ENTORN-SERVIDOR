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
        Schema::create('favorits', function (Blueprint $table) {
            $table->id();

            // Guardo l'ID del post que ve de l'API externa
            $table->integer('post_id');

            // Guardo el títol del post favorit
            $table->string('title');

            // Guardo automàticament quan es crea o s'actualitza
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorits');
    }
};
