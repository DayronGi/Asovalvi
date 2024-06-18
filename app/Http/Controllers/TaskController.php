<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function list()
    {
        $tasks = Task::all();
        return response()->json(['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_id' => 'required|integer',
            'meeting_id' => 'nullable|integer',
            'start_date' => 'required|date',
            'estimated_time' => 'nullable|integer',
            'units' => 'nullable|string',
            'type_id' => 'required|integer',
            'task_description' => 'required|string',
            'assigned_to' => 'nullable|integer',
            'department_id' => 'required|integer',
            'observations' => 'nullable|string',
            'created_by' => 'required|integer',
            'creation_date' => 'required|date',
            'reviewed_by' => 'nullable|integer',
            'review_date' => 'nullable|date',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $task = new Task();
            $task->task_id = $request->task_id;
            $task->meeting_id = $request->meeting_id;
            $task->start_date = $request->start_date;
            $task->estimated_time = $request->estimated_time;
            $task->units = $request->units;
            $task->type_id = $request->type_id;
            $task->task_description = $request->task_description;
            $task->assigned_to = $request->assigned_to;
            $task->department_id = $request->department_id;
            $task->observations = $request->observations;
            $task->created_by = $request->created_by;
            $task->creation_date = $request->creation_date;
            $task->reviewed_by = $request->reviewed_by;
            $task->review_date = $request->review_date;
            $task->status = $request->status;

            $task->save();

            return response()->json(['message' => 'Task creada correctamente.', 'task' => $task], 201);
        } catch (\Exception $e) {

            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar task.', 'exception' => $e->getMessage()], 500);
        }
    }
}