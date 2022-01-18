<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
