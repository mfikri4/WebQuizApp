<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    
    public function index($id)
    {
        $quiz_id = $id;
        $data = Question::join('quiz','id_quiz','=','question.quiz_id')
                    ->select('quiz.*','question.*')
                    ->get();
        return view('quiz.question', compact('data','quiz_id'));
    }

    public function insert(Request $request)
    {
        // $request->validate(Question::$rules);
        $requests = $request->all();
    
        $id = $requests['quiz_id'];
        $cat = Question::create($requests);
        if($cat){
            return redirect('question/'.$id)->with('status', 'Berhasil menambah data!');
        }

        return redirect('question/'.$id)->with('status', 'Gagal Menambah data!');
        
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

    public function delete($id)
    {
    $data = Question::find($id);
    if ($data == null) {
        return redirect()->back()->with('status', 'Data tidak ditemukan !');
    }
    
    $delete = $data->delete();
    if ($delete) {
        return redirect()->back()->with('status', 'Berhasil hapus question !');
    }
    return redirect()->back()->with('status', 'Gagal hapus question !');
    }
}
