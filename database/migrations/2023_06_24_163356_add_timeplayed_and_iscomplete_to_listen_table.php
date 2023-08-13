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
        Schema::table('listens', function (Blueprint $table) {
            $table->float('time_played')->nullable();
            $table->float('ratio_played')->nullable();
            $table->boolean('isComplete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listens', function (Blueprint $table) {
            $table->dropColumn('time_played');
            $table->dropColumn('ratio_played');
            $table->dropColumn('isComplete');
        });
    }
};
