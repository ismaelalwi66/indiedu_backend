<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectCategory;

class SubjectCategoryController extends Controller
{
    public function index()
    {
        try {
            $data = SubjectCategory::all();

            return response()->json([
                'message' => 'Success',
                'status' => '200',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '404',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            SubjectCategory::create([
                'name' => $request->name,
            ]);

            return response()->json([
                'message' => 'success',
                'status' => '200'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '404',
            ], 404);
        }
    }

    public function show($id)
    {
        try {
            $subjectcategory = SubjectCategory::where('id', $id)->firstOrFail();
            $subject = Subject::where('subject_category_id', $subjectcategory->id)->get();
            $data = ['subject category' => $subjectcategory, 'subject' => $subject];
            return response()->json([
                'data' => $data,
                'status' => '200',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '404',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            SubjectCategory::findOrFail($id)->update(['name' => $request->name]);
            return response()->json([
                'message' => 'Success',
                'status' => '200',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '404',
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            SubjectCategory::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Delete Success',
                'status' => '200',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '404',
            ], 404);
        }
    }
}
