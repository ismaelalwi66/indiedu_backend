<?php

namespace App\Http\Controllers;

use App\Models\SubSection;
use Illuminate\Http\Request;

class SubSectionController extends Controller
{
    public function store(Request $request)
    {
        try {

            SubSection::create([
                'title' => $request->subsection_title,
                'description' => $request->subsection_description,
                'article' => $request->subsection_article,
                'article_url' => $request->subsection_article_url,
                'video' => $request->subsection_video,
                'video_url' => $request->subsection_video_url,
                'section_id' => $request->section_id,
            ]);

            return response()->json([
                'message' => 'Create Success',
                'status' => '201',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Create Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $data = Subsection::findOrFail($id);
            return response()->json([
                'message' => 'Berhasil ditampilkan',
                'status' => '200',
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Gagal ditampilkan',
                'status' => '400',
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            SubSection::where('id', $id)->update([
                'title' => $request->subsection_title,
                'description' => $request->subsection_description,
                'article' => $request->subsection_article,
                'article_url' => $request->subsection_article_url,
                'video' => $request->subsection_video,
                'video_url' => $request->subsection_video_url,
            ]);

            return response()->json([
                'message' => 'Update Success',
                'status' => '201',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Update Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            SubSection::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Subsection Deleted Success',
                'status' => '200',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Subection Delete Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }
}
