<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state_id',
        'company_name',
        'company_description',
        'company_logo',
        'website_url',
        'employee_number',
        'founded_date',
        'timezone_id',
        'crunchbase_url',
        'status',
        'social_id'
    ];

}
