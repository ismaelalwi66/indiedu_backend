<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SubSection;
use Illuminate\Support\Str;
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
        $data = Section::all();

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'status' => '200',
            'data' => $data
        ]);
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
            'title' => $request->section_title,
            'description'=> $request->section_description,
            'cover' => $request->cover,
            'cover_url' => $request->cover_url,
            'slug' => Str::kebab($request->section_title),
            'grade_id' => $request->grade_id,
            'subject_id' => $request->subject_id
        ]);
        $section = Section::where('cover_url', $request->cover_url)->first();

        SubSection::create([
            'title' => $request->subsection_title,
            'description' => $request->subsection_description,
            'article' => $request->article,
            'article_url' => $request->article_url,
            'video' => $request->video,
            'video_url' => $request->video_url,
            'section_id' => $section->id,
        ]);

        return response()->json([
            'message' => 'Success',
            'status' => '200',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            $section = Section::where('id', $id)->first(),
            $section = Subsection::where('id', $id)->first(),
        ];
        return response()->json([
            'message' => 'Berhasil ditampilkan',
            'status' => '200',
            'data' => $data,
        ]);
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
        $data = [
            $section = Section::where('id', $id)->first(),
            $section = Subsection::where('id', $id)->first(),
        ];
        $data->update([
            'title' => $request->section_title,
            'description'=> $request->section_description,
            'cover' => $request->cover,
            'cover_url' => $request->cover_url,
            'slug' => Str::kebab($request->section_title),
            'grade_id' => $request->grade_id,
            'subject_id' => $request->subject_id,
            'title' => $request->subsection_title,
            'description' => $request->subsection_description,
            'article' => $request->article,
            'article_url' => $request->article_url,
            'video' => $request->video,
            'video_url' => $request->video_url,
            'section_id' => $section->id,
        ]);
        return response()->json([
            'message' => 'Update Success',
            'status' => '200',
            'data' => $data,

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

    }
}
