<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ResultOption;
use App\Http\Resources\ResultResource;

class ResultController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ResultOption::latest()->get();
        return response()->json([ResultResource::collection($data), 'Soal dan jawaban berhasil ditampilkan']);
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

        $program = ResultOption::create([
            'name' => $request->name,
            'desc' => $request->desc
         ]);
        
        return response()->json(['ResultOption created successfully.', new ResultResource($program)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ResultOption::find($id);
        if (is_null($result)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ResultResource($result)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultOption $program)
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
        
        return response()->json(['ResultOption updated successfully.', new ResultResource($program)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultOption $program)
    {
        $program->delete();

        return response()->json('ResultOption deleted successfully');
    }
}
