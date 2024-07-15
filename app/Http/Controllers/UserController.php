<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'document_number' => 'required|string',
            'user_type' => 'required|string',
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $user = USer::findORfail($id);
            $user->update([
                'first_name' => $request->fisrt_name,
                'last_name' => $request->last_name,
                'document_number' => $request->document_number,
                'user_type' => $request->user_type,
                'email' => $request->email,
            ]);
            return response()->json(['message' => 'User actualizado correctamente.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar actualizar user.', 'exception' => $e->getMessage()], 500);
        }
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
