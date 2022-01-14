<?php

namespace Database\Seeders;

use App\Models\SubSection;
use Illuminate\Database\Seeder;

class SubsectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubSection::create([

            'title' => 'Subsection title',
            'description' => 'Subsection description',
            'article' => 'article name',
            'article_url' => 'article url',
            'video' => 'video name',
            'video_url' => 'video url',
            'section_id' => '1',
        ]);
    }
}
