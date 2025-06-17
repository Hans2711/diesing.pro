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
        Schema::table('redirect', function (Blueprint $table) {
            $table->index('slug');
            $table->index('user');
        });

        Schema::table('note', function (Blueprint $table) {
            $table->index('slug');
            $table->index('user');
        });

        Schema::table('rss_feed', function (Blueprint $table) {
            $table->index('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('redirect', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['user']);
        });

        Schema::table('note', function (Blueprint $table) {
            $table->dropIndex(['slug']);
            $table->dropIndex(['user']);
        });

        Schema::table('rss_feed', function (Blueprint $table) {
            $table->dropIndex(['user']);
        });
    }
};
