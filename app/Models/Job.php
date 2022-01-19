<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_slug',
        'job_bounty',
        'company_id',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
