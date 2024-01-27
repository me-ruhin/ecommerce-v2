<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    //

    public function login(Request $request)
    {
        $credentails = [
            "email" => $request->email,
            "password" => $request->password
        ];
        $user = Auth::attempt($credentails);
        if (!$user) {
            return response('Invalid Credentials', 401);
        }

        $token = $request->user()->createToken("test token");

        return response()->json([
            'user' => new UserResource(auth()->user()),
            "type" => "Bearer",
            "access_token" => $token->plainTextToken
        ], 200);
        // return ['token' => $token->plainTextToken];

        // if(Auth::attempt($credentails))
    }
}
