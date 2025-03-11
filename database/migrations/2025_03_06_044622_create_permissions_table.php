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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->boolean('login')->default(false);
            $table->boolean('editLogin')->default(false);
            $table->foreignId('movie_permissions_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_permissions_id')->constrained()->cascadeOnDelete();
            $table->foreignId('genre_permissions_id')->constrained()->cascadeOnDelete();
            $table->foreignId('region_permissions_id')->constrained()->cascadeOnDelete();
            $table->foreignId('actor_permissions_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
