<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCandidate extends Model
{
    use HasFactory;
    protected $table = 'exam_candidate';
    protected $primaryKey = "id_exam_candidate";
    protected $fillable=[
      'user_id',
      'quiz_id'
    ];
}
