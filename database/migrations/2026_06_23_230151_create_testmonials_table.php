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
        Schema::create('testmonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //slug column
            $table->string('slug')->unique();
            $table->longText('content');
            // Add any other columns you need for the testimonials table
            $table->string('position')->nullable();
            //foreign id to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //image column
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testmonials');
    }
};
