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
        Schema::create('testinstance', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('html');
            $table->longText('headers');
            $table->unsignedBigInteger('testrun_id'); // Updated type

            $table->foreign('testrun_id')
                ->references('id')
                ->on('testrun')
                ->onDelete('cascade'); // Optional: cascade delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testinstance');
    }
};

