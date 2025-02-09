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
            $table->id("MovieID");
            $table->string("MovieName");
            $table->string("MovieYear");
            $table->text("MovieDescription");
            $table->string("MovieEvaluate");
            $table->string("MovieStatus");
            $table->string("MovieImage");
            $table->string("MovieLink");
            $table->unsignedBigInteger("GenreID");
            $table->foreign("GenreID")->references("GenreID")->on("genres");
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
