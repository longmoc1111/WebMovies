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
        Schema::create('servers', function (Blueprint $table) {
            $table->id("ServerID");
            $table->string("ServerName");
            $table->text("Link_embed")->nullable();
            $table->text("Link_m3u8")->nullable();
            $table->unsignedBigInteger("EpisodeID");
            $table->foreign("EpisodeID")->references("EpisodeID")->on("episodes");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
