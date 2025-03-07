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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('movieName');
            $table->string('movieOriginName');
            $table->string('staticURL');
            $table->string('poster');
            $table->string('description');
            $table->string('annotation');
            $table->string('showtimes');
            $table->string('trailerURL');
            $table->string('duration');
            $table->integer('currentOfEpisodes');
            $table->integer('totalOfEpisodes');
            $table->integer('releaseYear');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
