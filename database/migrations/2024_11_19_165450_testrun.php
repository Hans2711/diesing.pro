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
        Schema::create('testrun', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('testobject_id'); // Updated type

            $table->foreign('testobject_id')
                ->references('id')
                ->on('testobject')
                ->onDelete('cascade'); // Optional: cascade delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testrun');
    }
};
