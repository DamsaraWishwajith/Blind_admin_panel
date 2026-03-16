<?php
// database/migrations/2026_03_13_120000_add_timestamps_to_math_questions_table.php

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
        Schema::table('math_questions', function (Blueprint $table) {
            $table->timestamps(); // This adds both created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('math_questions', function (Blueprint $table) {
            $table->dropTimestamps(); // This removes both created_at and updated_at columns
        });
    }
};