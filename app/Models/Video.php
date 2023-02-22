<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'course_id', 'name', 'slug', 'episode', 'intro', 'video_code'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
