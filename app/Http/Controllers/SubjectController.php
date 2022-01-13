<?php

namespace App\Http\Controllers;

// use App\Models\Section;
use App\Models\Subject;
// use App\Models\SubSection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
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
            Subject::create([
                'title' => $request->section_title,
                'description' => $request->section_description,
                'cover' => $request->cover,
                'cover_url' => $request->cover_url,
                'slug' => Str::kebab($request->section_title),
                'teacher_id' => Auth::id(),
                'grade_id' => $request->grade_id,
                'subject_id' => $request->subject_id,
            ]);

            // $section = Section::where('cover_url', $request->cover_url)->first();

            // SubSection::create([
            //     'title' => $request->subsection_title,
            //     'description' => $request->subsection_description,
            //     'article' => $request->article,
            //     'article_url' => $request->article_url,
            //     'video' => $request->video,
            //     'video_url' => $request->video_url,
            //     'section_id' => $section->id,
            // ]);

            return response()->json([
                'message' => 'Create Success',
                'status' => '200',
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
        try {
            $data = [
                Subject::find($id)->first(),
                // Subsection::find($id)->first(),
            ];
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
            $section = Subject::find($id)->update([
                'title' => $request->section_title,
                'description' => $request->section_description,
                'cover' => $request->cover,
                'cover_url' => $request->cover_url,
                'slug' => Str::kebab($request->section_title),
                'teacher_id' => Auth::id(),
                'grade_id' => $request->grade_id,
                'subject_id' => $request->subject_id,
            ]);

            return response()->json([
                'message' => 'Update Section Success',
                'status' => '200',
                'data' => $section,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Update Section Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }

    // public function updateSubsection(Request $request, $id)
    // {
    //     try {
    //         $subsection = Subsection::find($id)->update([
    //             'title' => $request->subsection_title,
    //             'description' => $request->subsection_description,
    //             'article' => $request->article,
    //             'article_url' => $request->article_url,
    //             'video' => $request->video,
    //             'video_url' => $request->video_url,
    //         ]);
    //         return response()->json([
    //             'message' => 'Update Success',
    //             'status' => '200',
    //             'data' => $subsection,

    //         ], 200);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'message' => 'Delete Success',
    //             'status' => '400',
    //             'error' => $th,
    //         ], 400);
    //     }
    // }
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
                'message' => 'Section Deleted Success',
                'status' => '200',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Section Delete Failed',
                'status' => '400',
                'error' => $th,
            ], 400);
        }
    }
}
