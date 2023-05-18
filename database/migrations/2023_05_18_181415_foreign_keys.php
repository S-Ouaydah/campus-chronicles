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
        // Foreign key constraints
        Schema::table('podcasts', function (Blueprint $table) {
        $table->foreign('creator_id')
        ->references('id')
            ->on('users')
            ->onDelete('cascade');
        $table->foreign('category_id')
        ->references('id')
            ->on('podcast_categories')
            ->onDelete('cascade');
        });
        Schema::table('episodes', function (Blueprint $table) {
            $table->foreignId('podcast_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
