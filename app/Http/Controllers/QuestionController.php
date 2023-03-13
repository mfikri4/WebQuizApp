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
            return redirect('question/'.$id)->with('success', 'Berhasil menambah data!');
        }

        return redirect('question/'.$id)->with('error', 'Gagal Menambah data!');
        
    }

    public function update(Request $request,$id)
    {
        $d = Question::find($id);
        if ($d == null){
            return redirect('question')->with('error', 'Data tidak Ditemukan !');
        }

        $req = $request->all();

        $data = Question::find($id)->update($req);
        if($data){
            return redirect('question')->with('success', 'question Berhasil diedit !');
        }

        return redirect('question')->with('error', 'Gagal edit data question!');
        
    }

    public function delete($id)
    {
    $data = Question::find($id);
    if ($data == null) {
        return redirect()->back()->with('error', 'Data tidak ditemukan !');
    }
    
    $delete = $data->delete();
    if ($delete) {
        return redirect()->back()->with('success', 'Berhasil hapus question !');
    }
    return redirect()->back()->with('error', 'Gagal hapus question !');
    }
}
