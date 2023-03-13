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
        if ($request->duration < 15){
            return redirect()->back()->with('error','Quiz: '.$request->title.' gagal ditambahkan. Durasi kurang dari 15 menit!');
        }
        if (Quiz::create([
            'title'     =>$request->title,
            'from_time' =>$request->from_time,
            'to_time'   =>$request->to_time,
            'duration'  =>$request->duration,
        ])){
            return redirect('quiz')->with('success','Quiz: '.$request->title.' berhasil ditambahkan!');
        }
        return redirect()->back()->with('error','Quiz: '.$request->title.' gagal ditambahkan. Ada sesuatu yang salah!');
    }

    public function edit($id){

        $data = Quiz::find($id);
        return view('quiz.edit', compact('data'));
    }


    public function delete($id)
    {
    $data = Quiz::find($id);
    if ($data == null) {
        return redirect()->back()->with('status', 'Data tidak ditemukan !');
    }
    
    $delete = $data->delete();
    if ($delete) {
        return redirect()->back()->with('status', 'Berhasil hapus quiz !');
    }
    return redirect()->back()->with('status', 'Gagal hapus quiz !');
    }
}
