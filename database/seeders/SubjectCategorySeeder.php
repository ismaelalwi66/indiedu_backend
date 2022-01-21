<?php

namespace Database\Seeders;

use App\Models\SubjectCategory;
use Illuminate\Database\Seeder;

class SubjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubjectCategory::create([
            'name' => 'Matematika',
        ]);
    }
}
