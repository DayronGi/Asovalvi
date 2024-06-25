<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return response()->json(['message' => 'register ok']);
    }

    public function login(Request $request)
    {
        return response()->json(['message' => 'login ok']);
    }

    public function logout(Request $request)
    {
        return response()->json(['message' => 'logout ok']);
    }
}
