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
        Schema::create('director_movies', function (Blueprint $table) {
            $table->id("DirectorMovieID");
            $table->unsignedBigInteger("MovieID");
            $table->unsignedBigInteger("DirectorID");
            $table->foreign("DirectorID")->references("DirectorID")->on("directors");
            $table->foreign("MovieID")->references("MovieID")->on("movies");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director_movies');
    }
};
