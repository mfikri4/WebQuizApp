<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultOption extends Model
{
    use HasFactory;
    public $table = 'question_result';

    protected $fillable = [
        'result_id',
        'question_id',
        'option_id',
        'point',
    ];
}
