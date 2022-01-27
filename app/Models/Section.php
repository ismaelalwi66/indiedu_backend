<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\SubSection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subjects()
    {
    return $this->belongsTo(Subject::class);
    }

    public function subsections()
    {
    return $this->hasMany(SubSection::class);
    }
}
