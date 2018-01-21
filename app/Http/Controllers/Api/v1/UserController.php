<?php namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response(['data' => $validator->errors()->all() , 'status' => 400 ] , 400);
        }


        if(! auth()->validate(['email' => $request->input('email') , 'password' => $request->input('password')])) {
            return response(['data' => 'Unauthenticate' , 'status' => 401] , 401);
        }

        $user = User::whereEmail($request->input('email'))->first();
        $token = $user->createToken('Roocket App Android')->accessToken;

        return response(['data' => $token , 'status' => 200]);
    }
}