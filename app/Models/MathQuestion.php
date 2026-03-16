<?php
// app/Models/MathQuestion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MathQuestion extends Model
{
    use HasFactory;

    protected $table = 'math_questions';

    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'difficulty',
        'question_en',
        'question_si',
        'question_ta',
        'answer_en',
        'answer_si',
        'answer_ta'
    ];

    protected $casts = [
        'answer_en' => 'array',
        'answer_si' => 'array',
        'answer_ta' => 'array',
    ];

    // Accessor for answer_en as string
    public function getAnswerEnStringAttribute()
    {
        $answers = $this->answer_en;
        if (is_array($answers)) {
            return implode(', ', $answers);
        }
        return $answers ?? '';
    }

    // Accessor for answer_si as string
    public function getAnswerSiStringAttribute()
    {
        $answers = $this->answer_si;
        if (is_array($answers)) {
            return implode(', ', $answers);
        }
        return $answers ?? '';
    }

    // Accessor for answer_ta as string
    public function getAnswerTaStringAttribute()
    {
        $answers = $this->answer_ta;
        if (is_array($answers)) {
            return implode(', ', $answers);
        }
        return $answers ?? '';
    }
}