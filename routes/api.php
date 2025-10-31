<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/login', function (Request $request){
    if (!Auth::attempt($request->only('email', 'password')))
        return response()->json(['message' => 'Invalid credentials'], 401);
    $user = Auth::user();
    return response()->json([
        'token' => $user->createToken('api')->accessToken
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
