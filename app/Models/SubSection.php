<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prophecy\Exception\Doubler\ReturnByReferenceException;

class SubSection extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sections()
    {
    return $this->belongsTo(Section::class);
    }
}
