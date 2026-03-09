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
        Schema::create('iq_questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_en');
            $table->text('question_si');
            $table->text('question_ta');
            $table->longText('answer_en');
            $table->longText('answer_si');
            $table->longText('answer_ta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iq_questions');
    }
};
