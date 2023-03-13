<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamCandidate;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Carbon\Carbon;

class QuizController extends Controller
{

    public function index(){
        return view('quiz.index')->with('data',Quiz::all());
    }

    public function create(){
        return view('quiz.create');
    }

    public function insert(Request $request){

        if (Quiz::create([
            'title'     =>$request->title,
            'from_time' =>$request->from_time,
            'to_time'   =>$request->to_time,
            'duration'  =>$request->duration,
        ])){
            return redirect()->back()->with('success','Quiz: '.$request->title.' berhasil ditambahkan!');
        }
        return redirect()->back()->with('error','Quiz: '.$request->title.' gagal ditambahkan. Ada sesuatu yang salah!');
    }

    public function edit($id){

        $data = Quiz::find($id);
        return view('quiz.edit', compact('data'));
    }

    public function update(Request $request,$id)
    {
        $d = Question::find($id);
        if ($d == null){
            return redirect('question')->with('status', 'Data tidak Ditemukan !');
        }

        $req = $request->all();

        $data = Question::find($id)->update($req);
        if($data){
            return redirect('question')->with('status', 'question Berhasil diedit !');
        }

        return redirect('question')->with('status', 'Gagal edit data question!');
        
    }
}
