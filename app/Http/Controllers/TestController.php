<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Quiz;
use App\Models\ExamCandidate;
use App\Models\Result;
use App\Models\ResultOption;
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
        
        $quiz       = Quiz::where('id_quiz',$id)->first();
        $questions  = Question::where('quiz_id',$id)->inRandomOrder()->get();
        $start_time = Carbon::now();

        return view('test.start',compact('quiz','questions','start_time'));

    }

    
    public function store(Request $request){

        $i=1;
        $db_answers = Question::where('quiz_id',$request['quiz_id'])->get();
        $correct=0;
        $total=0;
        $dt_result = Result::create([
            'user_id'=>Auth::user()->id,
            'quiz_id'=>$request['quiz_id'],
            'quiz_score'=>$total,
            'achieved_score'=>$correct
        ]);
        $result_id = $dt_result['id_result'];

        foreach ($db_answers as $db_answer){
            $ans_correct = 0;
            if ($db_answer->correct_option==$request->answer[$i]){
                $correct++;
                $ans_correct = 1;
            }
            else{
                $ans_correct = 0;
            }
            ResultOption::create([
                'result_id'     =>$result_id,
                'question'     =>$db_answer->question,
                'correct'     =>$db_answer->correct_option,
                'answer'       =>$request->answer[$i],
                'ans_correct'   =>$ans_correct
            ]);
            $i++;
            $total++;
        }
        
        Result::find($result_id)->update([
            'user_id'=>Auth::user()->id,
            'quiz_id'=>$request['quiz_id'],
            'quiz_score'=>$total,
            'achieved_score'=>$correct
        ]);

        return redirect('result-user')->with('success','Tes selesai dab data tersimpan');
    }
}
