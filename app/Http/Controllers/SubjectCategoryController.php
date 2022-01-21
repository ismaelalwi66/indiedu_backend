<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\SubjectCategory;

class SubjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $subjectcategory = SubjectCategory::where('id', $id)->firstOrFail();
            $subject = Subject::where('subject_category_id', $subjectcategory->id)->get();
            $data = ['subject category' => $subjectcategory, 'subject' => $subject];
            return response()->json([
                'data' => $data,
                'status' => '200'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '404',
            ], 404);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
