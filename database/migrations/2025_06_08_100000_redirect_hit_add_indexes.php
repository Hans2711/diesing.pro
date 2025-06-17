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
        Schema::table('redirect_hit', function (Blueprint $table) {
            $table->index('redirect');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('redirect_hit', function (Blueprint $table) {
            $table->dropIndex(['redirect']);
            $table->dropIndex(['created_at']);
        });
    }
};
