<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'document_number' => 'required',
            'user_type' => 'required'
        ]);

        $user  = new User();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->document_number = $request->document_number;
        $user->user_type = $request->user_type;
        $user->status = 2;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'registrado correctamente']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;

            // Oculta campos sensibles
            $user->makeHidden(['password', 'remember_token']);

            return response()->json([
                'token' => $token,
                'user'  => $user,
            ], Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Credenciales invalidas'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('cookie_token');
        return response(['message' => 'Cierre de session correcto'])->withCookie($cookie);
    }
}
