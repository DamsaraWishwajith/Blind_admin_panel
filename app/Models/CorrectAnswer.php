<?php
// app/Models/CorrectAnswer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    use HasFactory;

    protected $table = 'correct_answers';
    
    public $timestamps = false;
    protected $primaryKey = 'question_id';
    public $incrementing = false;

    protected $fillable = [
        'question_id',
        'answer_letter',
        'answer_text_en',
        'answer_text_si',
        'answer_text_ta'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}