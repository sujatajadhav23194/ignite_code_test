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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('gutenberg_id')->unique();
            $table->string('title');
            $table->json('authors')->nullable();
            $table->string('language', 10)->nullable();
            $table->json('subjects')->nullable();
            $table->json('bookshelves')->nullable();
            $table->integer('downloads')->default(0);
            $table->json('formats')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
