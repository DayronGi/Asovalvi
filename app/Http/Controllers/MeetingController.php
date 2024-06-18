<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function list()
    {
        $meetings = Meeting::all();
        return response()->json(['meetings' => $meetings]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meeting_id' => 'required|integer',
            'meeting_date' => 'required|date',
            'start_hour' => 'nullable|date',
            'department_id' => 'required|integer',
            'called_by' => 'required|integer',
            'placement' => 'nullable|string',
            'meeting_description' => 'required|string',
            'empty_field' => 'nullable|string',
            'topics' => 'required|string',
            'created_by' => 'nullable|integer',
            'creation_date' => 'required|date',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $meeting = new Meeting();
            $meeting->meeting_id = $request->meeting_id;
            $meeting->meeting_date = $request->meeting_date;
            $meeting->start_hour = $request->start_hour;
            $meeting->department_id = $request->department_id;
            $meeting->called_by = $request->called_by;
            $meeting->placement = $request->placement;
            $meeting->meeting_description = $request->meeting_description;
            $meeting->empty_field = $request->empty_field;
            $meeting->topics = $request->topics;
            $meeting->created_by = $request->created_by;
            $meeting->creation_date = $request->creation_date;
            $meeting->status = $request->status;

            $meeting->save();

            return response()->json(['message' => 'meeting creada correctamente.', 'meeting' => $meeting], 201);
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar meeting.', 'exception' => $e->getMessage()], 500);
        }
    }
}