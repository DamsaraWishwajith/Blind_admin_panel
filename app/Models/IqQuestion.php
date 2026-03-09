<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IqQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_en',
        'question_si',
        'question_ta',
        'answer_en',
        'answer_si',
        'answer_ta'
    ];
}
