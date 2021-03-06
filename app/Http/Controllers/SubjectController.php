<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

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
            'message' => 'Success',
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
        Subject::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'success',
            'status' => '200'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subject)
    {
        // $data = Subject::where('name', $subject)->first();
        $subject = Subject::where('name', $subject)->first();
        $data = Section::where('subject_id', $subject->id)->get();
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subject)
    {

        $data = Subject::where('name', $subject)->update(['name'=> $request->name]);
        return response()->json([
            'message' => 'Success',
            'status' => '200',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject)
    {
        $data = Subject::where('name', $subject)->delete();
        return response()->json([
            'message' => 'Delete Success',
            'status' => '200',
        ]);
    }
}
