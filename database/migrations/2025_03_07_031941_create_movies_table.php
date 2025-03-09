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
            $table->string('movieName')->unique();
            $table->string('movieOriginName')->unique();
            $table->string('staticURL')->unique();
            $table->string('poster');
            $table->string('description')->nullable();
            $table->string('annotation')->nullable();
            $table->string('showtimes')->nullable();
            $table->string('trailerURL')->nullable();
            $table->string('duration')->nullable();
            $table->integer('currentOfEpisodes')->nullable();
            $table->integer('totalOfEpisodes')->nullable();
            $table->integer('releaseYear')->nullable();
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
