<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function view($id)
    {
        $user = User::findORfail($id);
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = User::findORfail($id);
        $user->update([
            'status' => 1
        ]);
        return response()->json(['message' => 'User eliminado correctamente.']);
    }
}
