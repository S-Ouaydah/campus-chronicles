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
        //many2many table between users and podcasts
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('podcast_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['podcast_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
