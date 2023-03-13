<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Quiz;
use App\Models\ExamCandidate;
use App\Models\Result;
use Carbon\Carbon;
use Auth;

class TestController extends Controller
{
    
    public function index(){
        
        return view('test.index')->with('data',Quiz::all());
    }
    
    public function start_quiz($id){

        if (count(ExamCandidate::where('quiz_id',$id)->where('user_id','=',Auth::user()->id)->get())>0){
            return redirect()->back()->with('error','Anda sudah berpartisipasi dalam test ini!');
        }

        if (time()>=strtotime(Quiz::where('id_quiz',$id)->value('to_time'))){
            return redirect()->back()->with('error','Test sudah berakhir');
        }
        if (time()<strtotime(Quiz::where('id_quiz',$id)->value('from_time'))){
            return redirect()->back()->with('error','Test belum tersedia. Tunggu hingga waktu test dimulai!');
        }

        if (count(Result::where('user_id',Auth::user()->id)->get())>0){
            return redirect()->back()->with('error','Anda sudah berpartisipasi dalam test ini!');
        }

        ExamCandidate::create([
           'user_id'=>Auth::user()->id,
           'quiz_id'=>$id
        ]);

        return view('test.start')->with('quiz',Quiz::where('id_quiz',$id)->first())
            ->with('questions',Question::where('quiz_id',$id)->get())
            ->with('start_time',Carbon::now());
    }

    
    public function store(Request $request){

        $i=1;
        $db_answers = Question::where('quiz_id',$request['quiz_id'])->get();
        $correct=0;
        $total=0;
        foreach ($db_answers as $db_answer){
            if ($db_answer->correct_option==$request->answer[$i]){
                $correct++;
            }
            else{
            }
            $i++;
            $total++;
        }
        Result::create([
            'user_id'=>Auth::user()->id,
            'quiz_id'=>$request['quiz_id'],
            'quiz_score'=>$total,
            'achieved_score'=>$correct
        ]);

        return redirect('result')->with('success','Tes selesai dab data tersimpan');
    }
}
