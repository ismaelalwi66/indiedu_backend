<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

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
        Section::create([
            'title' => $request->title,
            'decription' => $request->decription,
            'subject_id' => $request->subject_id
        ]);

        return response()->json([
            'message' => 'success',
            'status' => '200',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Section::findOrFail($id)->first();

        return response()->json([
            'message' => 'success',
            'status' => '200',
            'data' => $data
        ], 200);
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
        Section::where('id', $id)->update([
            'title' => $request->title,
            'decription' => $request->decription,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Section::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Delete Success',
            'status' => '200',
        ], 200);
    }
}
