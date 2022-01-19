<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function countries()
    {
        return DB::table('countries')->get();
    }

    public function states($id)
    {
        return DB::table('states')->where('country_id', $id)->get();
    }

    // public function cities($id)
    // {
    //     return DB::table('cities')->where('country_id', $id)->get();
    // }
}
