<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("portfolio", function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string("name");
            $table->string("url");
            $table->longText("description");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("portfolio");
    }
};
