<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rss_feed', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->uuid('user');
            $table->string('url');
            $table->string('last_title')->nullable();
            $table->timestamp('last_checked_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rss_feed');
    }
};
