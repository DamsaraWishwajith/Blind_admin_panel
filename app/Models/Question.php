<?php
// app/Models/Question.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';
    
    // Disable timestamps
    public $timestamps = false;

    // Disable auto-increment since your table might not have it set properly
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id', // Allow id to be mass-assigned
        'subject',
        'question_en',
        'question_si',
        'question_ta'
    ];

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id');
    }

    public function correctAnswer()
    {
        return $this->hasOne(CorrectAnswer::class, 'question_id');
    }
}