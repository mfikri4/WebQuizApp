<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'question';
    protected $primaryKey = "id_question";

    protected $fillable = [
        'quiz_id',
        'question_text',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'correct_option',
    ];

    public static $rules = [
        'quiz_id'           => 'required',
        'question_text'     => 'required',
        'option_a'          => 'required',
        'option_b'          => 'required',
        'option_c'          => 'required',
        'option_d'          => 'required',
        'correct_option'    => 'required',
    ]; 

    public function quiz(){
        $this->belongsToMany(Quiz::class);
    }
    
}
