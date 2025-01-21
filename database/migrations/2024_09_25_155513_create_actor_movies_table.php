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
        Schema::create('actor_movies', function (Blueprint $table) {
            $table->id("ActorMovieID");
            $table->unsignedBigInteger("MovieID");
            $table->unsignedBigInteger("ActorID");
            $table->foreign("ActorID")->references("ActorID")->on("actors");
            $table->foreign("MovieID")->references("MovieID")->on("movies");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_movies');
    }
};
