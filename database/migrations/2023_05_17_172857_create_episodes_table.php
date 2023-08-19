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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('sequence');
            $table->string('audio_path');
            $table->float('audio_length');

            $table->foreignId('podcast_id')
            ->constrained()
            ->onDelete('cascade');
            $table->foreignId('creator_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
