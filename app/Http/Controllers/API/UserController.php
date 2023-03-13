<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::latest()->get();
        return response()->json([UserResource::collection($data), 'List User berhasil ditampilkan.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required|string|max:255',
    //         'desc' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors());       
    //     }

    //     $program = User::create([
    //         'name' => $request->name,
    //         'desc' => $request->desc
    //      ]);
        
    //     return response()->json(['User created successfully.', new UserResource($program)]);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = User::find($id);
        if (is_null($program)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new UserResource($program)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, User $program)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required|string|max:255',
    //         'desc' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors());       
    //     }

    //     $program->name = $request->name;
    //     $program->desc = $request->desc;
    //     $program->save();
        
    //     return response()->json(['User updated successfully.', new UserResource($program)]);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $program)
    // {
    //     $program->delete();

    //     return response()->json('User deleted successfully');
    // }
}
