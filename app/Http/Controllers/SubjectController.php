<?php

namespace App\Http\Controllers;


use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subject::all();

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'status' => '200',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $cover = $request->cover->store('/images', 's3', 'public');
            $cover_url = Storage::disk('s3')->url($cover);

            $data = Subject::create([
                'title' => $request->title,
                'description' => $request->description,
                'cover' => basename($cover),
                'cover_url' => $cover_url,
                'slug' => Str::kebab($request->title),
                'teacher_id' => Auth::id(),
                'grade_id' => $request->grade_id,
                'subject_category_id' => $request->subject_category_id,
            ]);

            return response()->json([
                'message' => 'Create Success',
                'status' => '200',
                'data' => $data,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Create Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
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
        $data = Subject::where('id', $id)->first();
        if ($data == null) {
            return response()->json([
                'message' => 'Gagal ditampilkan',
                'status' => '400',
                'data' => 'null',
            ], 400);
        } else {
            return response()->json([
                'message' => 'Berhasil ditampilkan',
                'status' => '200',
                'data' => $data,
            ], 200);
        }
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
        try {
            $cover = $request->cover->store('/images', 's3', 'public');
            $cover_url = Storage::disk('s3')->url($cover);

            $data = Subject::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'cover' => basename($cover),
                'cover_url' => $cover_url,
                'slug' => Str::kebab($request->title),
                'teacher_id' => Auth::id(),
                'grade_id' => $request->grade_id,
                'subject_category_id' => $request->subject_category_id,
            ]);

            return response()->json([
                'message' => 'Update Subject Success',
                'status' => '200',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Update Subject Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Subject::where('id', $id)->first()->delete();
            return response()->json([
                'message' => 'Subject Deleted Success',
                'status' => '200',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Subject Delete Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }
}
