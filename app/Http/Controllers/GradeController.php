<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index()
    {
        try {
            $data = Grade::all();
            return response()->json([
                'message' => 'Berhasil ditampilkan',
                'status' => '200',
                'data' => $data,
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal menampilkan data',
            ],400);
        }
    }

    public function store(Request $request)
    {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|min:1|max:20',
                'type' => 'required|string|min:1|max:20',
            ]);
            if($validator->fails()){
                return response()->json([
                    'message'=>'Error! Mohon kolom diisi dengan benar',
                    'errors'=>$validator->errors()
                ], 404);
            }else{
                Grade::create([
                    'name' => $request->name,
                    'type' => $request->type,
                ]);

                return response()->json([
                    'message' => 'Tingkat kelas berhasil dibuat',
                ], 201);
            }
    }

    public function show($id)
    {
        try {
            $grade = Grade::find($id)->first();
            return response()->json([
                'message'=>'Berhasil didapatkan',
                'data'=>$grade,
            ],200);
        } catch (\Throwable $th) {
           return response()->json([
               'message' => 'Data tidak ada',
               'status' => '400',
               'error' => $th,
           ],400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $grade = Grade::find($id);
            $grade->update([
                'name'=>$request->name,
                'type'=>$request->type,
            ]);
            return response()->json([
                'message'=>'Update Success',
                'status'=>'200',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Update Gagal',
                'status' => '400',
                'error' => $th,
            ],400);
        }
    }

    public function destroy($id)
    {
        try {
            Grade::find($id)->delete();
            return response()->json([
                'message' => 'Berhasil dihapus'
            ], 200);
        } catch (\Throwable $th) {
          return response()->json([
              'message' => 'Gagal dihapus',
              'status' => '400',
              'error' => $th,
          ], 400);
        }
      }
}
