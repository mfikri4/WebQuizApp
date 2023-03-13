<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultOption extends Model
{
    use HasFactory;
    public $table = 'result_option';
    protected $primaryKey = "id_result_option";
    protected $fillable=[
      'result_id',
      'question',
      'correct',
      'answer',
      'ans_correct'
    ];

}
