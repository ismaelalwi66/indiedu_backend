<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SubSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class SectionController extends Controller
{
    public function store(Request $request)
    {
        try {
            Section::create([
                'title' => $request->title,
                'description' => $request->description,
                'slug' => Str::kebab($request->title),
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

    public function show(Section $section)
    {
        try {

            $subsection = SubSection::where('section_id', $section->id)->get();
            $data = ['section' => $section, 'subsection' => $subsection];
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
