<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SubSection;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    public function store(Request $request)
    {
        try {
            Section::create([
                'title' => $request->title,
                'decription' => $request->decription,
                'subject_id' => $request->subject_id,
            ]);

            return response()->json([
                'message' => 'success',
                'status' => '201',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'status' => '404',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $data = Section::with('subsections')->where('id', $id)->first();
            return response()->json([
                'message' => 'success',
                'status' => '200',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'status' => '404',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            Section::findOrfail($id)->update([
                'title' => $request->title,
                'decription' => $request->decription,
            ]);

            return response()->json([
                'message' => 'success',
                'status' => '200',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'status' => '404',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            Section::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Delete Success',
                'status' => '200',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'status' => '404',
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
