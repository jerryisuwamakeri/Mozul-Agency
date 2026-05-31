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
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('viewable_type');
            $table->unsignedBigInteger('viewable_id');
            $table->string('session_id', 64)->nullable();
            $table->string('ip_hash', 64)->nullable();
            $table->string('country')->nullable();
            $table->string('country_code', 5)->nullable();
            $table->string('referer')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->index('created_at');
            $table->index(['viewable_type', 'viewable_id']);
            $table->index('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
