<?php

namespace App\Http\Controllers;

use App\Models\Obligation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObligationController extends Controller
{
    public function list()
    {
        $obligations = Obligation::all();
        return response()->json(['obligations' => $obligations]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'obligation_id' => 'required|integer',
            'obligation_description' => 'required|string',
            'type_id' => 'required|integer',
            'category_id' => 'required|integer',
            'server_name' => 'nullable|string',
            'quantity' => 'required|integer',
            'period' => 'required|string',
            'alert_time' => 'required|integer',
            'department_id' => 'required|integer',
            'created_by' => 'required|integer',
            'last_payment' => 'nullable|numeric',
            'expiration_date' => 'nullable|date',
            'observations' => 'required|string',
            'internal_reference' => 'nullable|string',
            'reviewed_by' => 'nullable|integer',
            'review_date' => 'nullable|date',
            'status' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $obligation = new Obligation();
            $obligation->obligation_id = $request->obligation_id;
            $obligation->obligation_description = $request->obligation_description;
            $obligation->type_id = $request->type_id;
            $obligation->category_id = $request->category_id;
            $obligation->server_name = $request->server_name;
            $obligation->quantity = $request->quantity;
            $obligation->period = $request->period;
            $obligation->alert_time = $request->alert_time;
            $obligation->department_id = $request->department_id;
            $obligation->created_by = $request->created_by;
            $obligation->last_payment = $request->last_payment;
            $obligation->expiration_date = $request->expiration_date;
            $obligation->observations = $request->observations;
            $obligation->internal_reference = $request->internal_reference;
            $obligation->reviewed_by = $request->reviewed_by;
            $obligation->review_date = $request->review_date;
            $obligation->status = $request->status;

            $obligation->save();

            return response()->json(['message' => 'Obligation creado correctamente.', 'obligation' => $obligation], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar obligation.', 'exception' => $e->getMessage()], 500);
        }
    }
}