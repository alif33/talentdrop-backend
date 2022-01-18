<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobController extends Controller
{
    public function index()
    {
        return Job::orderBy('id', 'DESC')->get();
    }

    public function store(Request $request)
    {   

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|string|between:2,30|unique:jobs',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $job = Job::create(
            array_merge(
                $validator->validated()
            )
        );

        $job->tags()->attach($request->tags);

        if ($job) {
            return response()->json([
                'success' => true,
                'message' => 'Job created successfully.'
            ], 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => 'required|string|between:2,30',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [$validator->errors()],
                422
            );
        }

        $category = Tag::findOrFail($id)->update(
            array_merge(
                [
                    'tag_slug' => Str::slug($request->tag_name, '-')
                ],
                $validator->validated()
            )
        );

        if ($category) {
            return response()->json([
                'success' => true,
                'message' => 'Tag updated successfully.'
            ], 201);
        }
    }
    
    public function destory($id)
    {
       $tag = Tag::findOrFail($id);

       if($tag)
       {
           $tag->delete();
           return response()->json(
                ['message'=>'Tag deleted successfully.'],
                422
            );
       } 
    }
}
