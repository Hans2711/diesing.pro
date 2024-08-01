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
        Schema::table('note', function (Blueprint $table) {
            if (!Schema::hasColumn('note', 'share')) {
                $table->integer('share')->default(0)->nullable();
            }
            if (!Schema::hasColumn('note', 'slug')) {
                $table->string('slug')->default('')->nullable(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('note', function (Blueprint $table) {
            if (Schema::hasColumn('note', 'share')) {
                $table->dropColumn('share');
            }
            if (Schema::hasColumn('note', 'slug')) {
                $table->dropColumn('slug');
            }
        });
    }
};

