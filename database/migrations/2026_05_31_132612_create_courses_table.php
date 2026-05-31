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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('cover_image')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency', 10)->default('NGN');
            $table->enum('status', ['draft', 'published', 'coming_soon'])->default('draft');
            $table->string('duration')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->nullable();
            $table->string('category')->nullable();
            $table->string('enrollment_url')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
