<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;


class AnswerController extends Controller
{
    public function index()
    {
        $data = Answer::join('question', 'question.id_question', '=', 'question_options.question_id')
                    ->select('question.*', 'question_options.*')
                    ->get();
        return view('answer.index', compact('data'));
    }

    public function create()
    {
        $question = Question::get();
        return view('answer.create', compact('question'));
    }

    public function insert(Request $request)
    {
        $request->validate(Answer::$rules);
        $requests = $request->all();
    
        $cat = Answer::create($requests);
        if($cat){
            return redirect('answer')->with('status', 'Berhasil menambah data!');
        }

        return redirect('answer')->with('status', 'Gagal Menambah data!');
        
    }

    public function update(Request $request,$id)
    {
        $d = Answer::find($id);
        if ($d == null){
            return redirect('answer')->with('status', 'Data tidak Ditemukan !');
        }

        $req = $request->all();

        $data = Answer::find($id)->update($req);
        if($data){
            return redirect('answer')->with('status', 'answer Berhasil diedit !');
        }

        return redirect('answer')->with('status', 'Gagal edit data answer!');
        
    }

    public function edit($id)
    {
        $data = Answer::find($id);
        $question = Question::get();
        return view('answer.edit', compact('data','question'));
    }

    public function delete($id)
    {
    $data = Answer::find($id);
    if ($data == null) {
        return redirect('answer')->with('status', 'Data tidak ditemukan !');
    }
    
    $delete = $data->delete();
    if ($delete) {
        return redirect('answer')->with('status', 'Berhasil hapus answer !');
    }
    return redirect('answer')->with('status', 'Gagal hapus answer !');
    }
}
