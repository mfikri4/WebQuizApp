<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Question;
use App\Http\Resources\QuestionResource;

class QuestionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Question::latest()->get();
        return response()->json([QuestionResource::collection($data), 'Soal dan jawaban berhasil ditampilkan']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'desc' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $program = Question::create([
            'name' => $request->name,
            'desc' => $request->desc
         ]);
        
        return response()->json(['Program created successfully.', new QuestionResource($program)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Question::find($id);
        if (is_null($result)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new QuestionResource($result)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $program)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'desc' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $program->name = $request->name;
        $program->desc = $request->desc;
        $program->save();
        
        return response()->json(['Program updated successfully.', new QuestionResource($program)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $program)
    {
        $program->delete();

        return response()->json('Program deleted successfully');
    }
}
