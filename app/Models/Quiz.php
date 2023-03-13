<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $primaryKey = "id_quiz";
    protected $fillable=[
      'title',
      'duration',
      'from_time',
      'to_time'
    ];

    public function question(){
        $this->hasMany(Question::class);
    }

    public function result(){
        $this->hasMany(Result::class);
    }
}
