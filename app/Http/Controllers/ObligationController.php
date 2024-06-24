<?php

namespace App\Http\Controllers;

use App\Models\Obligation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObligationController extends Controller
{
    public function list(Request $request)
    {
        $perPage = $request->input('per_page', 15);

        $obligations = Obligation::with('reviewed_by', 'created_by', 'status')->paginate($perPage);

        return response()->json($obligations);
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
            $obligation->created_by = $request->created_by;
            $obligation->last_payment = $request->last_payment;
            $obligation->expiration_date = $request->expiration_date;
            $obligation->observations = $request->observations;
            $obligation->internal_reference = $request->internal_reference;
            $obligation->reviewed_by = $request->reviewed_by;
            $obligation->review_date = $request->review_date;
            $obligation->status = 2;

            $obligation->save();

            $obligation->load('reviewed_by', 'created_by', 'status');

            return response()->json(['message' => 'Obligation creado correctamente.', 'obligation' => $obligation], 201);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar guardar obligation.', 'exception' => $e->getMessage()], 500);
        }
    }

    public function view($obligation_id)
    {
        $obligation = Obligation::with('reviewed_by', 'created_by', 'status')->findORfail($obligation_id);
        return response()->json(['obligation' => $obligation]);
    }

    public function update(Request $request, $obligation_id)
    {

        $validator = Validator::make($request->all(), [
            'obligation_description' => 'required|string',
            'type_id' => 'required|integer',
            'category_id' => 'required|integer',
            'server_name' => 'nullable|string',
            'quantity' => 'required|integer',
            'period' => 'required|string',
            'alert_time' => 'required|integer',
            'created_by' => 'required|integer',
            'last_payment' => 'nullable|numeric',
            'expiration_date' => 'nullable|date',
            'observations' => 'required|string',
            'internal_reference' => 'nullable|string',
            'reviewed_by' => 'nullable|integer',
            'review_date' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $obligation = Obligation::findORfail($obligation_id);
            $obligation->update([
                'obligation_description' => $request->obligation_description,
                'type_id' => $request->type_id,
                'category_id' => $request->category_id,
                'server_name' => $request->server_name,
                'quantity' => $request->quantity,
                'period' => $request->period,
                'alert_time' => $request->alert_time,
                'created_by' => $request->created_by,
                'last_payment' => $request->last_payment,
                'expiration_date' => $request->expiration_date,
                'observations' => $request->observations,
                'internal_reference' => $request->internal_reference,
                'reviewed_by' => $request->reviewed_by,
                'review_date' => $request->review_date,
            ]);
            return response()->json(['message' => 'Obligation actualizado correctamente.']);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Error al intentar actualizar obligation.', 'exception' => $e->getMessage()], 500);
        }
    }

    public function delete($obligation_id)
    {
        $obligation = Obligation::findORfail($obligation_id);
        $obligation->update([
            'status' => 1
        ]);
        return response()->json(['message' => 'Obligation eliminado correctamente.']);
    }
}