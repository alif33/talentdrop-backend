<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin', ['except' => ['index']]);
    // }

    public function index()
    {
        return Company::orderBy('id', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'facebook_url'  => 'required|string',
                'twitter_url' => 'string',
                'linkedin_url' => 'string',
                'instagram_url' => 'string',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                'company_name' => 'required|string|between:2,50',
                'company_description' => 'required|string',
                'company_logo' => 'required',
                'website_url' => 'required|string',
                'employee_number' => 'required|string',
                'founded_date' => 'required',
                'timezone_id' => 'numeric',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $social = Social::create(
            $validator->validated()
        );

        $company = Company::create(
            array_merge(
                [
                    'social_id' => $social->id,
                ],
                $validator->validated()
            )
        );

        if ($company) {
            return response()->json([
                'success' => true,
                'message' => 'Tag created successfully.'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'facebook_url'  => 'required|string',
                'twitter_url' => 'string',
                'linkedin_url' => 'string',
                'instagram_url' => 'string',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                'company_name' => 'required|string|between:2,50',
                'company_description' => 'required|string',
                'company_logo' => 'required',
                'website_url' => 'required|string',
                'employee_number' => 'required|string',
                'founded_date' => 'required',
                'timezone_id' => 'numeric',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        // $social = Social::create(
        //     $validator->validated()
        // );

        // $company = Company::findOrFail($id)->update(
        //     array_merge(
        //         [
        //             'social_id' => $social->id,
        //         ],
        //         $validator->validated()
        //     )
        // );

        // if ($company) {
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Company updated successfully.'
        //     ], 201);
        // }
    }
    
    public function destory($id)
    {
       $tag = Company::findOrFail($id);

       if($tag)
       {
           $tag->delete();
           return response()->json(
                ['message'=>'Company deleted successfully.'],
                422
            );
       } 
    }

}


