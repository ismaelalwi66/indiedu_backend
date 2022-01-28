<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SubSection;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            Section::create([
                'title' => $request->title,
                'description' => $request->description,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $section = Section::findOrFail($id);
            $subsection = SubSection::where('section_id', $section->id)->get();
            $data = ['section' => $section, 'subsection' => $subsection];
            return response()->json([
                'message' => 'success',
                'status' => '200',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'status' => '404',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /** komen
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            Section::findOrfail($id)->update([
                'title' => $request->title,
                'description' => $request->description,
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
