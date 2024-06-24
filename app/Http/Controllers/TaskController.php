<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 15);

        $tasks = Task::with('meeting', 'created_by', 'status', 'assigned_to', 'reviewed_by')->paginate($perPage);

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meeting_id' => 'required|integer',
            'start_date' => 'required|date',
            'estimated_time' => 'required|integer',
            'units' => 'required|string',
            'task_description' => 'required|string',
            'assigned_to' => 'required|string',
            'observations' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'reviewed_by' => 'nullable|integer',
            'review_date' => 'nullable|date'
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
            $task->observations = $request->observations;
            $task->created_by = $request->created_by;
            $task->creation_date = \Carbon\Carbon::now();
            $task->reviewed_by = $request->reviewed_by;
            $task->review_date = $request->review_date;
            $task->status = 2;

            $task->save();

            $task->load('meeting', 'created_by', 'status', 'assigned_to', 'reviewed_by');

            return response()->json(['message' => 'Task creado correctamente.', 'task' => $task], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar task.', 'exception' => $e->getMessage()], 500);
        }
    }

    public function view($task_id)
    {
        $task = Task::with('meeting', 'created_by', 'status', 'assigned_to', 'reviewed_by')->findOrFail($task_id);
        return response()->json(['task' => $task]);
    }

    public function update(Request $request, $task_id)
    {

        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|string',
            'estimated_time' => 'nullable|integer',
            'units' => 'nullable|string',
            'type_id' => 'required|integer',
            'task_description' => 'required|string',
            'observations' => 'nullable|string',
            'reviewed_by' => 'nullable|integer',
            'review_date' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $task = Task::findORfail($task_id);
            $task->update([
                'start_date' => $request->start_date,
                'estimated_time' => $request->estimated_time,
                'units' => $request->units,
                'type_id' => $request->type_id,
                'task_description' => $request->task_description,
                'observations' => $request->observations,
                'reviewed_by' => $request->reviewed_by,
                'review_date' => $request->review_date,
            ]);
            return response()->json(['message' => 'Task actualizado correctamente.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar actualizar task.', 'exception' => $e->getMessage()], 500);
        }
    }

    public function delete($obligation_id)
    {
        $obligation = Task::findORfail($obligation_id);
        $obligation->update([
            'status' => 1
        ]);
        return response()->json(['message' => 'Task eliminado correctamente.']);
    }
}
