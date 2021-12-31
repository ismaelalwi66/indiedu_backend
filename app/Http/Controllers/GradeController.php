<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Js;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Grade::all();
            return response()->json([
                'message' => 'Berhasil ditampilkan',
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menampilkan data',
            ]);
        }
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:20',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'Error! Mohon kolom diisi dengan benar',
                'errors'=>$validator->errors()
            ], 404);
        }else{
        Grade::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Tingkat kelas berhasil dibuat',
        ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade = Grade::find($id);
        return response()->json([
            'message'=>'Berhasil didapatkan',
            'data'=>$grade,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        $grade->update([
            'name'=>$request->name,
        ]);
        return response()->json([
            'message'=>'Update Success',
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Grade::find($id)->delete();
        return response()->json([
            'message' => 'Berhasil dihapus'
        ]);
    }
}
