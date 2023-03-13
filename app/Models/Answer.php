<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'question_options';
    protected $primaryKey = "id_option";

    protected $fillable = [
        'question_id',
        'option_text',
        'point',
    ];

    public static $rules = [
        'question_id'       => 'required',
        'option_text'       => 'required',
        'point'              => 'required',
    ]; 

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
