<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;
use Auth;

class ResultController extends Controller
{
    public function index(){
        return view('result.index')->with('results',Result::join('quiz','result.quiz_id','quiz.id_quiz')
            ->where('user_id',Auth::user()->id)->get());
    }

    public function result(){
        $results = Result::join('quiz','result.quiz_id','quiz.id_quiz')
                        ->leftjoin('users','result.user_id','users.id')
                        ->get();
        return view('result.index',compact('results'));
    }
    
    public function show($id){
        $results = Result::join('quiz','result.quiz_id','quiz.id_quiz')
                        ->leftjoin('users','result.user_id','users.id')
                        ->get();
        $data = Result::join('quiz','result.quiz_id','quiz.id_quiz')
                        ->leftjoin('result_option','result.id_result','result_option.result_id')
                        ->select('result.*','quiz.*','result_option.*')
                        ->get();
        return view('result.show',compact('data','results'));
    }
}
