<?php
// app/Models/Option.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';
    
    public $timestamps = false;

    protected $fillable = [
        'question_id',
        'option_letter',
        'option_en',
        'option_si',
        'option_ta'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}