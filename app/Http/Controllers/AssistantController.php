<?php

namespace App\Http\Controllers;

use App\Models\MeetingAssistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssistantController extends Controller
{
    public function list()
    {
        $assistants = MeetingAssistant::all();
        return response()->json($assistants);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'worker_id' => 'required|integer',
            'stamp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $assistant = new MeetingAssistant();
            $assistant->worker_id = $request->worker_id;
            $assistant->stamp = $request->stamp;
            $assistant->status = 2;

            $assistant->save();

            return response()->json(['message' => 'Assistant creado correctamente.', 'assistant' => $assistant], 201);
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar assistant.', 'exception' => $e->getMessage()], 500);
        }
    }

    public function delete($meeting_id)
    {
        $assistant = MeetingAssistant::findORfail($meeting_id);
        $assistant->update([
            'status' => 1
        ]);
        return response()->json(['message' => 'Assistant eliminado correctamente.']);
    }
}
