<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'title' => 'Matematika Kelas 1',
            'description' => 'ini section percobaan',
            'cover' => 'nama cover',
            'cover_url'=> 'url.coma',
            'slug' => 'matematika-kelas-satu',
            'price' => '100000',
            'status' => 'Unpublish',
            'grade_id' => '1',
            'teacher_id' => '1',
            'subject_category_id' => '1',
        ]);
    }
}
