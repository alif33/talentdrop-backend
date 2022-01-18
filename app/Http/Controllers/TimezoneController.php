<?php

namespace App\Http\Controllers;

use App\Models\Timezone;
use Illuminate\Http\Request;

class TimezoneController extends Controller
{
    public function index()
    {
        return Timezone::all();
    }
}
