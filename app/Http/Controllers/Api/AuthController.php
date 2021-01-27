<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login (Request $request){
        $creds = $request->only('email','password');


        $token = auth()->
        claims(['email' => $request->get('email')])->
        attempt($creds);

        $payload = auth()->payload();
        return response()->json(['token' => $payload]);
    }

}
