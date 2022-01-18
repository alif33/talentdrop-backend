<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company', ['except' => ['login', 'register']]);

    }

    protected function guard()
    {
        return Auth::guard('company');
    }

    protected function respondWithToken($token)
    {
        return response()->json(
            [   
                'success'        => true,
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL() * 60),
            ]
        );

    }

public function login(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]
    );

    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $token_validity = (24 * 60);

    $this->guard()->factory()->setTTL($token_validity);


    // return $this->guard()->attempt($validator->validated());

    if (!$token = $this->guard()->attempt($validator->validated())) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid Creadentials'
        ], 401);
    }

    return $this->respondWithToken($token);

}


public function apply(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'company_name'     => 'required|string|between:2,100',
            'website_url'    => 'required|string|between:2,300',
            'email'    => 'required|string|between:2,300',
        ]
    );

    if ($validator->fails()) {
        return response()->json(
            [$validator->errors()],
            422
        );
    }
}


public function register(Request $request)
{   

    $validator = Validator::make(
        $request->all(),
        [
            'name'     => 'required|string|between:2,100',
            'email'    => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:6',
        ]
    );

    if ($validator->fails()) {
        return response()->json(
            [$validator->errors()],
            422
        );
    }

    $user = Company::create(
        array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        )
    );

    return response()->json(['message' => 'Admin created successfully', 'user' => $user]);

}

public function reports(){
    return Report::orderBy('id', 'DESC')->get();
}

public function logout()
{
    $this->guard()->logout();

    return response()->json(['message' => 'User logged out successfully']);

}

public function profile()
{
    return response()->json($this->guard()->user());

}

public function refresh()
{
    return $this->respondWithToken($this->guard()->refresh());
}
}


