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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            //longtext for the content of the publication
            $table->longText('content');
            //foreign key to the users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //foreign key to the categories table
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            //image path for the publication
            $table->string('image_path')->nullable();
            //file path for the publication
            $table->string('file_path')->nullable();
            //boolean to check if the publication is published or not
            $table->boolean('is_published')->default(true);
            //boolean to check if the publication is featured or not
            $table->boolean('is_featured')->default(false);
            //

            //
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
