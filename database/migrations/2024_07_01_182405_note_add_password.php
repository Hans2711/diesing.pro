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
            if (!Schema::hasColumn('note', 'enable_password')) {
                $table->integer('enable_password')->default(0);
            }
            if (!Schema::hasColumn('note', 'password')) {
                $table->string('password')->default('')->nullable(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('note', function (Blueprint $table) {
            if (Schema::hasColumn('note', 'enable_password')) {
                $table->dropColumn('enable_password');
            }
            if (Schema::hasColumn('note', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};

