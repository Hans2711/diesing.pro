<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams_state', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->uuid('user')->nullable();
            $table->json('players')->nullable();
            $table->json('teams')->nullable();
            $table->integer('number_of_teams')->default(2);
            $table->boolean('teams_locked')->default(false);
            $table->json('games')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams_state');
    }
};
