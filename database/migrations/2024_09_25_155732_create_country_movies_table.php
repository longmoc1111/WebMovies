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
        Schema::create('country_movies', function (Blueprint $table) {
            $table->id("CountryMovieID");
            $table->unsignedBigInteger("MovieID");
            $table->unsignedBigInteger("CountryID");
            $table->foreign("CountryID")->references("CountryID")->on("countries");
            $table->foreign("MovieID")->references("MovieID")->on("movies");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_movies');
    }
};
