<?php

namespace App\Http\Controllers;

use App\Models\MeetingTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meeting_id' => 'required|integer',
            'type' => 'required|string',
            'topic' => 'required|string',
            'created_by' => 'required|integer',
            'creation_date' => 'required|string',
            'status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $topic = new MeetingTopic();
            $topic->meeting_id = $request->meeting_id;
            $topic->type = $request->type;
            $topic->topic = $request->topic;
            $topic->created_by = $request->created_by;
            $topic->creation_date = \Carbon\Carbon::now();
            $topic->status = 2;

            $topic->save();

            return response()->json(['message' => 'topic creado correctamente.', 'topic' => $topic], 201);
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar topic.', 'exception' => $e->getMessage()], 500);
        }
    }

    public function delete($meeting_id)
    {
        $meeting = MeetingTopic::findORfail($meeting_id);
        $meeting->update([
            'status' => 1
        ]);
        return response()->json(['message' => 'Topic eliminado correctamente.']);
    }
}
