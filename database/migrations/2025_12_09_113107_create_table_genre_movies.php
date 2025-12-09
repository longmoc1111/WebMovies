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
        Schema::create('genre_movies', function (Blueprint $table) {
            $table->id("GenreMovieID");
            $table->unsignedBigInteger("MovieID");
            $table->unsignedBigInteger("GenreID");
            $table->foreign("MovieID")->references("MovieID")->on("movies");
            $table->foreign("GenreID")->references("GenreID")->on("genres");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_type_movies');
    }
};
