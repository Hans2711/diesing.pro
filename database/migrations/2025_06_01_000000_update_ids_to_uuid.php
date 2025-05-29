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
        // Users
        Schema::table('users', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('cv')->nullable()->change();
        });

        Schema::table('sessions', function (Blueprint $table) {
            $table->uuid('user_id')->nullable()->change();
        });

        // Notes
        Schema::table('note', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user')->nullable()->change();
        });

        // Redirects
        Schema::table('redirect', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user')->nullable()->change();
        });

        Schema::table('redirect_hit', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('redirect')->nullable()->change();
        });

        // Portfolio
        Schema::table('portfolio', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user')->nullable()->change();
        });

        // Files
        Schema::table('file_reference', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('foreign_id')->change();
        });

        // CV
        Schema::table('cv', function (Blueprint $table) {
            $table->uuid('id')->change();
        });

        Schema::table('list', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('cv')->change();
        });

        // Timetrack
        Schema::table('timetrack', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user')->nullable()->change();
        });

        // Test related
        Schema::table('testobject', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('user')->nullable()->change();
        });

        Schema::table('testrun', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('testobject_id')->change();
        });

        Schema::table('testinstance', function (Blueprint $table) {
            $table->uuid('id')->change();
            $table->uuid('testrun_id')->change();
        });

        Schema::table('diffstore', function (Blueprint $table) {
            $table->uuid('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting the column types back would require knowledge of the
        // previous integer types. Implement as needed.
    }
};
